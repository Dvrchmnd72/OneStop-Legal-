#!/usr/bin/env python3
"""Read-only OneStop Legal conveyancing URL inventory and SEO health audit.

Usage:
    python3 scripts/onestop_conveyancing_url_audit.py

Optional examples:
    python3 scripts/onestop_conveyancing_url_audit.py --timeout 30 --max-workers 8
    python3 scripts/onestop_conveyancing_url_audit.py --skip-page-audit
    python3 scripts/onestop_conveyancing_url_audit.py --output-dir /tmp/osl-audit
    python3 scripts/onestop_conveyancing_url_audit.py --main-sitemap-file /tmp/sitemap.xml --conveyancing-sitemap-file /tmp/conveyancing-sitemap.xml

What it does:
    * Fetches the live OneStop Legal main sitemap and conveyancing sitemap.
    * Extracts <loc> URLs.
    * Builds a full conveyancing-related URL inventory from /sitemap.xml.
    * Compares /sitemap.xml against /conveyancing-sitemap.xml.
    * Performs a light, read-only HTTP/HTML SEO audit for each conveyancing URL.
    * Writes:
        - reports/onestop-conveyancing-url-inventory.csv
        - reports/onestop-conveyancing-url-summary.md

Important:
    * This script is read-only. It does not require WordPress database/admin access.
    * It does not change SEO output, templates, schema, redirects, tracking, or sitemaps.
    * It uses only the Python standard library.
"""

from __future__ import annotations

import argparse
import csv
import datetime as dt
import html
from html.parser import HTMLParser
import json
import os
from pathlib import Path
import re
import sys
import time
from concurrent.futures import ThreadPoolExecutor, as_completed
from typing import Dict, Iterable, List, Optional, Sequence, Set, Tuple
from urllib.error import HTTPError, URLError
from urllib.parse import urlparse
from urllib.request import Request, build_opener

SITE = "https://onestoplegal.com.au"
MAIN_SITEMAP_URL = f"{SITE}/sitemap.xml"
CONVEYANCING_SITEMAP_URL = f"{SITE}/conveyancing-sitemap.xml"

REGIONAL_SLUGS = {
    "brisbane",
    "cairns",
    "ipswich",
    "logan",
    "moreton-bay",
    "redland",
    "sunshine-coast",
    "toowoomba",
    "townsville",
}

CSV_COLUMNS = [
    "source",
    "group",
    "url",
    "in_main_sitemap",
    "in_conveyancing_sitemap",
    "http_status",
    "final_url",
    "redirected",
    "fetch_error",
    "title",
    "title_length",
    "meta_description",
    "meta_description_length",
    "canonical",
    "self_canonical",
    "robots_meta",
    "is_noindex",
    "h1_count",
    "h1_text",
    "json_ld_exists",
    "schema_types",
    "quote_marker_exists",
    "visible_word_count",
]


def normalise_url(url: str) -> str:
    return url.strip()


def fetch_url(url: str, timeout: int, accept: str = "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8") -> Tuple[int, str, str, Dict[str, str], Optional[str]]:
    """Fetch a URL with redirects enabled. Returns status, final_url, body, headers, error."""
    request = Request(
        url,
        headers={
            "User-Agent": "OneStopLegalConveyancingAudit/1.0 (+read-only SEO inventory)",
            "Accept": accept,
        },
    )
    opener = build_opener()
    try:
        with opener.open(request, timeout=timeout) as response:
            raw = response.read()
            charset = response.headers.get_content_charset() or "utf-8"
            body = raw.decode(charset, errors="replace")
            return response.status, response.geturl(), body, dict(response.headers.items()), None
    except HTTPError as exc:
        body = ""
        try:
            raw = exc.read()
            charset = exc.headers.get_content_charset() or "utf-8"
            body = raw.decode(charset, errors="replace")
        except Exception:
            pass
        return exc.code, exc.geturl() if hasattr(exc, "geturl") else url, body, dict(exc.headers.items()), str(exc)
    except URLError as exc:
        return 0, url, "", {}, str(exc)
    except Exception as exc:  # Defensive: keep report generation alive.
        return 0, url, "", {}, repr(exc)


def extract_locs(xml_text: str) -> List[str]:
    # Namespace-safe enough for simple sitemap XML. Avoids external dependencies.
    locs = re.findall(r"<\s*(?:[a-zA-Z0-9_\-]+:)?loc\s*>\s*(.*?)\s*<\s*/\s*(?:[a-zA-Z0-9_\-]+:)?loc\s*>", xml_text, flags=re.I | re.S)
    return [html.unescape(re.sub(r"\s+", "", loc)) for loc in locs]


def path_segments(url: str) -> List[str]:
    path = urlparse(url).path.strip("/")
    return [] if not path else path.split("/")


def is_conveyancing_related(url: str) -> bool:
    path = urlparse(url).path.rstrip("/") + "/"
    return path == "/conveyancing/" or path == "/conveyancing-quote/" or path.startswith("/conveyancing/")


def classify_url(url: str) -> str:
    path = urlparse(url).path.rstrip("/") + "/"
    segments = path_segments(url)

    if path == "/conveyancing/":
        return "main conveyancing page"
    if path == "/conveyancing-quote/":
        return "quote page"
    if path == "/conveyancing/gold-coast/":
        return "Gold Coast hub"

    if len(segments) == 2 and segments[0] == "conveyancing":
        second = segments[1]
        if second in REGIONAL_SLUGS:
            return "regional hubs"
        return "Gold Coast direct suburb pages"

    if len(segments) == 3 and segments[0] == "conveyancing" and segments[1] in REGIONAL_SLUGS:
        return "regional suburb pages"

    return "other conveyancing-related URLs"


class SEOHTMLParser(HTMLParser):
    def __init__(self) -> None:
        super().__init__(convert_charrefs=True)
        self.title_parts: List[str] = []
        self.in_title = False
        self.in_h1 = False
        self.current_h1_parts: List[str] = []
        self.h1s: List[str] = []
        self.meta_description = ""
        self.robots_meta = ""
        self.canonical = ""
        self.json_ld_texts: List[str] = []
        self.in_json_ld = False
        self.current_json_ld_parts: List[str] = []
        self.in_ignored = False
        self.ignored_depth = 0
        self.visible_text_parts: List[str] = []

    def handle_starttag(self, tag: str, attrs: Sequence[Tuple[str, Optional[str]]]) -> None:
        tag = tag.lower()
        attr = {k.lower(): (v or "") for k, v in attrs}

        if tag in {"script", "style", "noscript"}:
            if tag == "script" and "ld+json" in attr.get("type", "").lower():
                self.in_json_ld = True
                self.current_json_ld_parts = []
            self.in_ignored = True
            self.ignored_depth += 1

        if tag == "title":
            self.in_title = True
        elif tag == "h1":
            self.in_h1 = True
            self.current_h1_parts = []
        elif tag == "meta":
            name = attr.get("name", "").lower()
            if name == "description" and not self.meta_description:
                self.meta_description = attr.get("content", "").strip()
            elif name == "robots" and not self.robots_meta:
                self.robots_meta = attr.get("content", "").strip()
        elif tag == "link":
            rel = attr.get("rel", "").lower()
            if "canonical" in rel.split() and not self.canonical:
                self.canonical = attr.get("href", "").strip()

    def handle_endtag(self, tag: str) -> None:
        tag = tag.lower()
        if tag == "title":
            self.in_title = False
        elif tag == "h1":
            self.in_h1 = False
            text = clean_text(" ".join(self.current_h1_parts))
            if text:
                self.h1s.append(text)
            self.current_h1_parts = []
        elif tag == "script" and self.in_json_ld:
            self.in_json_ld = False
            self.json_ld_texts.append("".join(self.current_json_ld_parts).strip())
            self.current_json_ld_parts = []

        if tag in {"script", "style", "noscript"} and self.ignored_depth > 0:
            self.ignored_depth -= 1
            if self.ignored_depth == 0:
                self.in_ignored = False

    def handle_data(self, data: str) -> None:
        if self.in_title:
            self.title_parts.append(data)
        if self.in_h1:
            self.current_h1_parts.append(data)
        if self.in_json_ld:
            self.current_json_ld_parts.append(data)
        if not self.in_ignored:
            self.visible_text_parts.append(data)


def clean_text(value: str) -> str:
    return re.sub(r"\s+", " ", html.unescape(value or "")).strip()


def canonical_equivalent(url_a: str, url_b: str) -> bool:
    if not url_a or not url_b:
        return False
    def norm(u: str) -> str:
        parsed = urlparse(u)
        scheme = parsed.scheme.lower() or "https"
        netloc = parsed.netloc.lower()
        path = parsed.path or "/"
        if not path.endswith("/") and "." not in Path(path).name:
            path += "/"
        return f"{scheme}://{netloc}{path}"
    return norm(url_a) == norm(url_b)


def extract_schema_types(json_ld_texts: Iterable[str]) -> str:
    types: Set[str] = set()

    def walk(node) -> None:
        if isinstance(node, dict):
            value = node.get("@type")
            if isinstance(value, str):
                types.add(value)
            elif isinstance(value, list):
                for item in value:
                    if isinstance(item, str):
                        types.add(item)
            for value in node.values():
                walk(value)
        elif isinstance(node, list):
            for item in node:
                walk(item)

    for text in json_ld_texts:
        if not text:
            continue
        try:
            walk(json.loads(text))
        except Exception:
            # Some plugins emit multiple JSON objects or malformed fragments; ignore quietly.
            continue
    return "; ".join(sorted(types))


def quote_marker_exists(body: str) -> bool:
    lower = body.lower()
    markers = [
        "osl_quote_form",
        "osl-cq-wrapper",
        "osl-cq-get-quote",
        "quote-section",
        "start your quote",
        "get an instant quote",
        "conveyancing quote",
        "/conveyancing-quote/",
    ]
    return any(marker in lower for marker in markers)


def visible_word_count(text_parts: Sequence[str]) -> int:
    text = clean_text(" ".join(text_parts))
    return len(re.findall(r"\b[\w'-]+\b", text))


def audit_page(url: str, timeout: int) -> Dict[str, object]:
    status, final_url, body, _headers, error = fetch_url(url, timeout=timeout)
    parser = SEOHTMLParser()
    if body:
        try:
            parser.feed(body)
        except Exception:
            # html.parser is forgiving; keep partial data if it still fails.
            pass

    title = clean_text(" ".join(parser.title_parts))
    meta_description = clean_text(parser.meta_description)
    robots = clean_text(parser.robots_meta)
    canonical = clean_text(parser.canonical)
    h1_text = " | ".join(parser.h1s)
    schema_types = extract_schema_types(parser.json_ld_texts)

    return {
        "http_status": status or "",
        "final_url": final_url,
        "redirected": "yes" if final_url and not canonical_equivalent(url, final_url) else "no",
        "fetch_error": error or "",
        "title": title,
        "title_length": len(title),
        "meta_description": meta_description,
        "meta_description_length": len(meta_description),
        "canonical": canonical,
        "self_canonical": "yes" if canonical_equivalent(final_url or url, canonical) else "no" if canonical else "",
        "robots_meta": robots,
        "is_noindex": "yes" if "noindex" in robots.lower() else "no" if robots else "",
        "h1_count": len(parser.h1s),
        "h1_text": h1_text,
        "json_ld_exists": "yes" if parser.json_ld_texts else "no",
        "schema_types": schema_types,
        "quote_marker_exists": "yes" if body and quote_marker_exists(body) else "no",
        "visible_word_count": visible_word_count(parser.visible_text_parts) if body else "",
    }


def count_by(rows: Sequence[Dict[str, object]], key: str) -> Dict[str, int]:
    counts: Dict[str, int] = {}
    for row in rows:
        value = str(row.get(key, "") or "")
        counts[value] = counts.get(value, 0) + 1
    return dict(sorted(counts.items(), key=lambda item: item[0]))


def duplicate_values(rows: Sequence[Dict[str, object]], key: str) -> Dict[str, List[str]]:
    seen: Dict[str, List[str]] = {}
    for row in rows:
        value = clean_text(str(row.get(key, "") or ""))
        if not value:
            continue
        seen.setdefault(value, []).append(str(row["url"]))
    return {value: urls for value, urls in seen.items() if len(urls) > 1}


def bullet_list(items: Sequence[str], limit: int = 50) -> str:
    if not items:
        return "None found."
    shown = list(items[:limit])
    lines = [f"- `{item}`" for item in shown]
    if len(items) > limit:
        lines.append(f"- …and {len(items) - limit} more")
    return "\n".join(lines)


def issue_rows(rows: Sequence[Dict[str, object]], predicate) -> List[Dict[str, object]]:
    return [row for row in rows if predicate(row)]


def write_csv(path: Path, rows: Sequence[Dict[str, object]]) -> None:
    with path.open("w", encoding="utf-8", newline="") as handle:
        writer = csv.DictWriter(handle, fieldnames=CSV_COLUMNS, extrasaction="ignore")
        writer.writeheader()
        for row in rows:
            writer.writerow(row)


def write_summary(
    path: Path,
    rows: Sequence[Dict[str, object]],
    main_urls: Set[str],
    conv_urls: Set[str],
    conveyancing_urls: Set[str],
    fetch_errors: Sequence[str],
    thin_threshold: int,
) -> None:
    counts = count_by(rows, "group")
    non_200 = issue_rows(rows, lambda r: str(r.get("http_status")) != "200")
    redirected = issue_rows(rows, lambda r: r.get("redirected") == "yes")
    missing_title = issue_rows(rows, lambda r: not r.get("title"))
    duplicate_titles = duplicate_values(rows, "title")
    missing_desc = issue_rows(rows, lambda r: not r.get("meta_description"))
    duplicate_desc = duplicate_values(rows, "meta_description")
    missing_canonical = issue_rows(rows, lambda r: not r.get("canonical"))
    noindex = issue_rows(rows, lambda r: r.get("is_noindex") == "yes")
    missing_h1 = issue_rows(rows, lambda r: str(r.get("h1_count")) in {"", "0"})
    multiple_h1 = issue_rows(rows, lambda r: int(r.get("h1_count") or 0) > 1)
    missing_quote = issue_rows(rows, lambda r: r.get("quote_marker_exists") != "yes")
    thin = issue_rows(rows, lambda r: str(r.get("visible_word_count") or "").isdigit() and int(r.get("visible_word_count") or 0) < thin_threshold)

    missing_from_conv = sorted(conveyancing_urls - conv_urls)
    extra_in_conv = sorted(conv_urls - main_urls)

    lines: List[str] = []
    lines.append("# OneStop Legal conveyancing URL inventory summary")
    lines.append("")
    lines.append(f"Generated: {dt.datetime.now(dt.timezone.utc).isoformat()}")
    lines.append("")
    lines.append("## Scope")
    lines.append("")
    lines.append(f"- Main sitemap: `{MAIN_SITEMAP_URL}`")
    lines.append(f"- Conveyancing sitemap: `{CONVEYANCING_SITEMAP_URL}`")
    lines.append("- Mode: read-only live sitemap + light HTML audit")
    lines.append("")

    if fetch_errors:
        lines.append("## Fetch warnings")
        lines.append("")
        lines.extend([f"- {err}" for err in fetch_errors])
        lines.append("")

    lines.append("## Counts")
    lines.append("")
    lines.append(f"- Total URLs in `/sitemap.xml`: **{len(main_urls)}**")
    lines.append(f"- Total URLs in `/conveyancing-sitemap.xml`: **{len(conv_urls)}**")
    lines.append(f"- Total conveyancing-related URLs from `/sitemap.xml`: **{len(conveyancing_urls)}**")
    lines.append("")
    lines.append("### Count by group")
    lines.append("")
    lines.append("| Group | Count |")
    lines.append("|---|---:|")
    for group, count in counts.items():
        lines.append(f"| {group or '(blank)'} | {count} |")
    lines.append("")

    lines.append("## Sitemap mismatch summary")
    lines.append("")
    lines.append(f"- Conveyancing-related URLs in main sitemap missing from conveyancing sitemap: **{len(missing_from_conv)}**")
    lines.append(f"- URLs in conveyancing sitemap missing from main sitemap: **{len(extra_in_conv)}**")
    lines.append("")
    lines.append("### Main sitemap conveyancing URLs missing from conveyancing sitemap")
    lines.append("")
    lines.append(bullet_list(missing_from_conv, limit=100))
    lines.append("")
    lines.append("### Conveyancing sitemap URLs missing from main sitemap")
    lines.append("")
    lines.append(bullet_list(extra_in_conv, limit=100))
    lines.append("")
    lines.append("### Likely sitemap behaviour")
    lines.append("")
    if fetch_errors or not main_urls:
        lines.append("Sitemap behaviour could not be evaluated reliably in this run because one or both sitemap fetches failed or returned no URLs.")
    elif missing_from_conv:
        lines.append("`/conveyancing-sitemap.xml` appears partial/legacy relative to `/sitemap.xml` because it omits conveyancing-related URLs that are present in the main sitemap.")
    else:
        lines.append("No main-sitemap conveyancing URLs were missing from `/conveyancing-sitemap.xml` in this run.")
    lines.append("")

    lines.append("## SEO health issues")
    lines.append("")
    metrics = [
        ("Non-200 URLs", non_200),
        ("Redirected URLs", redirected),
        ("Missing title", missing_title),
        ("Missing meta description", missing_desc),
        ("Missing canonical", missing_canonical),
        ("Noindex URLs", noindex),
        ("Missing H1", missing_h1),
        ("Multiple H1", multiple_h1),
        ("Missing quote CTA/form marker", missing_quote),
        (f"Potential thin pages (< {thin_threshold} visible words)", thin),
    ]
    lines.append("| Issue | Count |")
    lines.append("|---|---:|")
    for label, issue in metrics:
        lines.append(f"| {label} | {len(issue)} |")
    lines.append(f"| Duplicate title values | {len(duplicate_titles)} |")
    lines.append(f"| Duplicate meta description values | {len(duplicate_desc)} |")
    lines.append("")

    for label, issue in metrics:
        lines.append(f"### {label}")
        lines.append("")
        lines.append(bullet_list([str(row["url"]) for row in issue], limit=100))
        lines.append("")

    lines.append("### Duplicate title issues")
    lines.append("")
    if duplicate_titles:
        for value, urls in list(duplicate_titles.items())[:50]:
            lines.append(f"- **{value}** ({len(urls)} URLs)")
            for url in urls[:10]:
                lines.append(f"  - `{url}`")
            if len(urls) > 10:
                lines.append(f"  - …and {len(urls) - 10} more")
    else:
        lines.append("None found.")
    lines.append("")

    lines.append("### Duplicate meta description issues")
    lines.append("")
    if duplicate_desc:
        for value, urls in list(duplicate_desc.items())[:50]:
            lines.append(f"- **{value}** ({len(urls)} URLs)")
            for url in urls[:10]:
                lines.append(f"  - `{url}`")
            if len(urls) > 10:
                lines.append(f"  - …and {len(urls) - 10} more")
    else:
        lines.append("None found.")
    lines.append("")

    lines.append("## Recommended next implementation phases")
    lines.append("")
    lines.append("1. Review this inventory CSV and confirm sitemap grouping/counts against Search Console.")
    lines.append("2. Decide whether `/conveyancing-sitemap.xml` should be expanded, renamed/re-scoped as Gold Coast-only, or retired after `/sitemap.xml` is accepted as the source of truth.")
    lines.append("3. Prioritise fixes for non-200, redirected, noindex, missing-canonical, and missing-H1 URLs before content expansion.")
    lines.append("4. Use the word-count and duplicate-title/meta findings to select regional suburb pages for content uniqueness improvements.")
    lines.append("5. Implement quote CTA/tracking improvements only after the URL inventory is accepted; do not change live SEO output from this audit alone.")
    lines.append("")

    path.write_text("\n".join(lines) + "\n", encoding="utf-8")


def main(argv: Optional[Sequence[str]] = None) -> int:
    parser = argparse.ArgumentParser(description="Read-only OneStop Legal conveyancing URL inventory audit.")
    parser.add_argument("--main-sitemap", default=MAIN_SITEMAP_URL)
    parser.add_argument("--conveyancing-sitemap", default=CONVEYANCING_SITEMAP_URL)
    parser.add_argument("--output-dir", default="reports")
    parser.add_argument("--main-sitemap-file", default="", help="Optional local XML file to use instead of fetching the main sitemap.")
    parser.add_argument("--conveyancing-sitemap-file", default="", help="Optional local XML file to use instead of fetching the conveyancing sitemap.")
    parser.add_argument("--timeout", type=int, default=25)
    parser.add_argument("--max-workers", type=int, default=8)
    parser.add_argument("--thin-word-threshold", type=int, default=300)
    parser.add_argument("--skip-page-audit", action="store_true", help="Only fetch/compare sitemaps; do not fetch every page.")
    args = parser.parse_args(argv)

    output_dir = Path(args.output_dir)
    output_dir.mkdir(parents=True, exist_ok=True)
    csv_path = output_dir / "onestop-conveyancing-url-inventory.csv"
    summary_path = output_dir / "onestop-conveyancing-url-summary.md"

    fetch_errors: List[str] = []

    if args.main_sitemap_file:
        main_xml = Path(args.main_sitemap_file).read_text(encoding="utf-8")
        main_status = 200
        main_error = None
    else:
        main_status, _main_final, main_xml, _main_headers, main_error = fetch_url(args.main_sitemap, timeout=args.timeout, accept="application/xml,text/xml,*/*")

    if args.conveyancing_sitemap_file:
        conv_xml = Path(args.conveyancing_sitemap_file).read_text(encoding="utf-8")
        conv_status = 200
        conv_error = None
    else:
        conv_status, _conv_final, conv_xml, _conv_headers, conv_error = fetch_url(args.conveyancing_sitemap, timeout=args.timeout, accept="application/xml,text/xml,*/*")

    if main_error or main_status >= 400 or main_status == 0:
        fetch_errors.append(f"Main sitemap fetch issue: status={main_status or 'n/a'} error={main_error or 'HTTP error'}")
    if conv_error or conv_status >= 400 or conv_status == 0:
        fetch_errors.append(f"Conveyancing sitemap fetch issue: status={conv_status or 'n/a'} error={conv_error or 'HTTP error'}")

    main_urls = {normalise_url(url) for url in extract_locs(main_xml)} if main_xml else set()
    conv_urls = {normalise_url(url) for url in extract_locs(conv_xml)} if conv_xml else set()
    conveyancing_urls = {url for url in main_urls if is_conveyancing_related(url)}

    rows: List[Dict[str, object]] = []
    for url in sorted(conveyancing_urls):
        rows.append({
            "source": "main sitemap",
            "group": classify_url(url),
            "url": url,
            "in_main_sitemap": "yes",
            "in_conveyancing_sitemap": "yes" if url in conv_urls else "no",
        })

    # Include any conveyancing-sitemap URL not already in the main conveyancing inventory so mismatches are visible in CSV.
    for url in sorted(conv_urls - conveyancing_urls):
        if is_conveyancing_related(url):
            rows.append({
                "source": "conveyancing sitemap only",
                "group": classify_url(url),
                "url": url,
                "in_main_sitemap": "yes" if url in main_urls else "no",
                "in_conveyancing_sitemap": "yes",
            })

    if args.skip_page_audit:
        for row in rows:
            for col in CSV_COLUMNS:
                row.setdefault(col, "")
    else:
        row_by_url = {str(row["url"]): row for row in rows}
        with ThreadPoolExecutor(max_workers=max(1, args.max_workers)) as executor:
            future_by_url = {executor.submit(audit_page, url, args.timeout): url for url in row_by_url}
            for future in as_completed(future_by_url):
                url = future_by_url[future]
                try:
                    row_by_url[url].update(future.result())
                except Exception as exc:
                    row_by_url[url].update({"fetch_error": repr(exc)})
        rows = [row_by_url[str(row["url"])] for row in rows]

    for row in rows:
        for col in CSV_COLUMNS:
            row.setdefault(col, "")

    write_csv(csv_path, rows)
    write_summary(summary_path, rows, main_urls, conv_urls, conveyancing_urls, fetch_errors, args.thin_word_threshold)

    print(f"Wrote {csv_path}")
    print(f"Wrote {summary_path}")
    print(f"Main sitemap URLs: {len(main_urls)}")
    print(f"Conveyancing sitemap URLs: {len(conv_urls)}")
    print(f"Conveyancing-related URLs: {len(conveyancing_urls)}")
    if fetch_errors:
        print("Warnings:")
        for warning in fetch_errors:
            print(f"- {warning}")
        # Reports were still generated; return success so scheduled runs can archive diagnostics.
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
