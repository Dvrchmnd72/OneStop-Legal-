<?php
/**
 * Template Name: Conveyancing Gold Coast
 *
 * Focused landing page targeting "conveyancing gold coast" → funnels to quote calculator
 */

get_header();
?>

<style>
.gc-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);padding:90px 0;text-align:center;position:relative}
.gc-hero::before{content:'';position:absolute;top:0;right:0;width:50%;height:100%;background:linear-gradient(135deg,transparent 0%,rgba(166,132,46,0.08) 100%);pointer-events:none}
.gc-hero h1{font-family:'League Spartan',sans-serif;font-size:52px;font-weight:800;color:#fff;margin-bottom:15px;line-height:1.15}
.gc-hero h1 span{color:#a6842e}
.gc-hero .hero-subtitle{font-family:'League Spartan',sans-serif;font-size:20px;color:rgba(255,255,255,0.85);max-width:700px;margin:0 auto 35px;line-height:1.7}
.gc-hero .hero-buttons{display:flex;justify-content:center;gap:16px;flex-wrap:wrap}
.gc-hero .hero-cta{display:inline-flex;align-items:center;gap:10px;background:#a6842e;color:#0d1b3e;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.gc-hero .hero-cta:hover{background:#c49a30;transform:translateY(-2px);color:#0d1b3e;text-decoration:none}
.gc-hero .hero-cta-secondary{display:inline-flex;align-items:center;gap:10px;background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.gc-hero .hero-cta-secondary:hover{border-color:#fff;background:rgba(255,255,255,.1);color:#fff;text-decoration:none}
.gc-container{max-width:1200px;margin:0 auto;padding:0 20px}
.gc-trust{background:#a6842e;padding:18px 0}
.gc-trust-items{display:flex;justify-content:center;gap:40px;flex-wrap:wrap;max-width:1200px;margin:0 auto;padding:0 20px}
.gc-trust-item{display:flex;align-items:center;gap:8px;font-family:'League Spartan',sans-serif;font-size:15px;font-weight:600;color:#0d1b3e}
.gc-why{padding:70px 0;background:#fff}
.gc-why .section-title{text-align:center;margin-bottom:45px}
.gc-why .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.gc-why .section-title p{font-size:17px;color:#666}
.gc-why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.gc-why-card{text-align:center;padding:35px 25px;background:#f8f6f0;border-radius:12px;transition:transform .3s}
.gc-why-card:hover{transform:translateY(-4px)}
.gc-why-icon{font-size:40px;margin-bottom:16px}
.gc-why-card h3{font-family:'League Spartan',sans-serif;font-size:19px;font-weight:700;color:#0d1b3e;margin-bottom:10px}
.gc-why-card p{font-size:15px;line-height:1.7;color:#555}
.gc-suburbs{padding:70px 0;background:#f8f6f0}
.gc-suburbs .section-title{text-align:center;margin-bottom:40px}
.gc-suburbs .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.gc-suburbs .section-title p{font-size:17px;color:#666;max-width:650px;margin:0 auto}
.gc-suburbs-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;max-width:1000px;margin:0 auto}
.gc-suburb-link{display:block;padding:12px 18px;background:#fff;border-radius:8px;text-decoration:none;color:#0d1b3e;font-family:'League Spartan',sans-serif;font-size:14px;font-weight:600;text-align:center;transition:all .3s;border:1px solid #e0ddd5}
.gc-suburb-link:hover{background:#a6842e;color:#0d1b3e;border-color:#a6842e;text-decoration:none;transform:translateY(-2px)}
.gc-local{padding:65px 0;background:#fff}
.gc-local .section-title{text-align:center;margin-bottom:30px}
.gc-local .section-title h2{font-family:'League Spartan',sans-serif;font-size:32px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.gc-local .section-title p{font-size:17px;color:#555;max-width:760px;margin:0 auto;line-height:1.7}
.gc-local-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;max-width:980px;margin:0 auto}
.gc-local-card{background:#f8f6f0;border-radius:12px;padding:28px;border:1px solid #e8e1d2}
.gc-local-card h3{font-family:'League Spartan',sans-serif;font-size:21px;font-weight:800;color:#0d1b3e;margin:0 0 10px}
.gc-local-card p{font-size:16px;line-height:1.7;color:#555;margin:0}
.gc-cta{padding:70px 0;background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);text-align:center}
.gc-cta h2{font-family:'League Spartan',sans-serif;font-size:36px;font-weight:800;color:#fff;margin-bottom:15px}
.gc-cta p{font-size:18px;color:rgba(255,255,255,.85);margin-bottom:35px;max-width:600px;margin-left:auto;margin-right:auto}
.gc-cta-buttons{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}
.gc-cta .btn-gold{background:#a6842e;color:#0d1b3e;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s;display:inline-flex;align-items:center;gap:10px}
.gc-cta .btn-gold:hover{background:#c49a30;color:#0d1b3e;text-decoration:none;transform:translateY(-2px)}
.gc-cta .btn-outline{background:transparent;color:#fff;padding:18px 44px;border-radius:8px;border:2px solid rgba(255,255,255,.4);text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s;display:inline-flex;align-items:center;gap:10px}
.gc-cta .btn-outline:hover{border-color:#fff;background:rgba(255,255,255,.1);color:#fff;text-decoration:none}
@media(max-width:992px){.gc-hero h1{font-size:40px}.gc-why-grid{grid-template-columns:1fr 1fr}.gc-suburbs-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:600px){.gc-hero{padding:55px 0}.gc-hero h1{font-size:30px}.gc-hero .hero-buttons{flex-direction:column;align-items:center}.gc-hero .hero-cta,.gc-hero .hero-cta-secondary{width:100%;max-width:320px;justify-content:center}.gc-trust-items{gap:12px}.gc-trust-item{font-size:13px}.gc-why,.gc-suburbs,.gc-local{padding:50px 0}.gc-why .section-title h2,.gc-suburbs .section-title h2,.gc-local .section-title h2,.gc-cta h2{font-size:26px}.gc-why-grid,.gc-local-grid{grid-template-columns:1fr}.gc-suburbs-grid{grid-template-columns:repeat(2,1fr)}.gc-suburb-link{font-size:13px;padding:10px 12px}.gc-cta-buttons{flex-direction:column;align-items:center}.gc-cta .btn-gold,.gc-cta .btn-outline{width:100%;max-width:320px;justify-content:center}}
</style>

<!-- HERO -->
<section class="gc-hero">
  <div class="gc-container">
    <h1>Gold Coast <span>Conveyancing</span></h1>
    <p class="hero-subtitle">Fixed-fee conveyancing for buying and selling property across all Gold Coast suburbs. Get an instant quote in 30 seconds.</p>
    <div class="hero-buttons">
      <a href="/conveyancing-quote/" class="hero-cta">Get an Instant Quote →</a>
      <a href="tel:+61731561216" class="hero-cta-secondary" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">+61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<section class="gc-trust">
  <div class="gc-trust-items">
    <div class="gc-trust-item">✓ Fixed Fee — No Surprises</div>
    <div class="gc-trust-item">✓ PEXA Certified</div>
    <div class="gc-trust-item">✓ Gold Coast Based</div>
    <div class="gc-trust-item">✓ Free Consultation</div>
  </div>
</section>

<!-- WHY US -->
<section class="gc-why">
  <div class="gc-container">
    <div class="section-title">
      <h2>Why Gold Coast Property Owners Choose Us</h2>
      <p>Expert conveyancing backed by a full-service law firm</p>
    </div>
    <div class="gc-why-grid">
      <div class="gc-why-card">
        <div class="gc-why-icon">💲</div>
        <h3>Fixed Fee Pricing</h3>
        <p>Know exactly what you'll pay upfront. No hidden costs, no hourly billing — just a clear fixed fee.</p>
      </div>
      <div class="gc-why-card">
        <div class="gc-why-icon">👨‍⚖️</div>
        <h3>Qualified Solicitors</h3>
        <p>Your matter is handled by a solicitor — not just a conveyancer — so you get real legal advice when it matters.</p>
      </div>
      <div class="gc-why-card">
        <div class="gc-why-icon">⚡</div>
        <h3>Fast Turnaround</h3>
        <p>We respond quickly, keep you updated, and coordinate settlement efficiently via PEXA.</p>
      </div>
    </div>
  </div>
</section>


<!-- LOCAL PROCESS -->
<section class="gc-local">
  <div class="gc-container">
    <div class="section-title">
      <h2>Gold Coast conveyancing for buyers and sellers</h2>
      <p>We support Gold Coast property transactions with solicitor-led conveyancing, fixed-fee pricing, and electronic settlement coordination for suburbs from Coomera and Hope Island through to Southport, Broadbeach, Burleigh Heads, Palm Beach, and Coolangatta.</p>
    </div>
    <div class="gc-local-grid">
      <div class="gc-local-card">
        <h3>Buying on the Gold Coast</h3>
        <p>For purchasers, our team helps with contract review, key dates, searches, transfer documents, lender coordination, and PEXA settlement steps so you know what needs to happen before settlement day.</p>
      </div>
      <div class="gc-local-card">
        <h3>Selling Gold Coast property</h3>
        <p>For sellers, we assist with contract and disclosure requirements, discharge of mortgage coordination, buyer solicitor queries, settlement adjustments, and electronic settlement through PEXA.</p>
      </div>
      <div class="gc-local-card">
        <h3>Transparent fixed-fee quotes</h3>
        <p>Start with an instant quote to understand your conveyancing costs upfront. We keep pricing clear for common buying and selling scenarios, with no hidden hourly billing surprises.</p>
      </div>
      <div class="gc-local-card">
        <h3>Local suburbs serviced</h3>
        <p>OneStop Legal services clients across the Gold Coast, including Robina, Varsity Lakes, Mermaid Beach, Miami, Nerang, Helensvale, Pacific Pines, Carrara, Elanora, Tugun, and surrounding suburbs.</p>
      </div>
    </div>
  </div>
</section>

<!-- SUBURBS -->
<section class="gc-suburbs">
  <div class="gc-container">
    <div class="section-title">
      <h2>Servicing All Gold Coast Suburbs</h2>
      <p>Click your suburb for local conveyancing information, or get an instant quote now.</p>
    </div>
    <div class="gc-suburbs-grid">
      <a href="/conveyancing/surfers-paradise/" class="gc-suburb-link">Surfers Paradise</a>
      <a href="/conveyancing/broadbeach/" class="gc-suburb-link">Broadbeach</a>
      <a href="/conveyancing/southport/" class="gc-suburb-link">Southport</a>
      <a href="/conveyancing/robina/" class="gc-suburb-link">Robina</a>
      <a href="/conveyancing/burleigh-heads/" class="gc-suburb-link">Burleigh Heads</a>
      <a href="/conveyancing/palm-beach/" class="gc-suburb-link">Palm Beach</a>
      <a href="/conveyancing/coolangatta/" class="gc-suburb-link">Coolangatta</a>
      <a href="/conveyancing/nerang/" class="gc-suburb-link">Nerang</a>
      <a href="/conveyancing/coomera/" class="gc-suburb-link">Coomera</a>
      <a href="/upper-coomera/" class="gc-suburb-link">Upper Coomera</a>
      <a href="/conveyancing/hope-island/" class="gc-suburb-link">Hope Island</a>
      <a href="/conveyancing/helensvale/" class="gc-suburb-link">Helensvale</a>
      <a href="/oxenford/" class="gc-suburb-link">Oxenford</a>
      <a href="/pimpama/" class="gc-suburb-link">Pimpama</a>
      <a href="/ormeau/" class="gc-suburb-link">Ormeau</a>
      <a href="/mudgeeraba/" class="gc-suburb-link">Mudgeeraba</a>
      <a href="/conveyancing/varsity-lakes/" class="gc-suburb-link">Varsity Lakes</a>
      <a href="/conveyancing/mermaid-beach/" class="gc-suburb-link">Mermaid Beach</a>
      <a href="/conveyancing/miami/" class="gc-suburb-link">Miami</a>
      <a href="/currumbin/" class="gc-suburb-link">Currumbin</a>
      <a href="/bundall/" class="gc-suburb-link">Bundall</a>
      <a href="/conveyancing/benowa/" class="gc-suburb-link">Benowa</a>
      <a href="/conveyancing/ashmore/" class="gc-suburb-link">Ashmore</a>
      <a href="/conveyancing/merrimac/" class="gc-suburb-link">Merrimac</a>
      <a href="/conveyancing/molendinar/" class="gc-suburb-link">Molendinar</a>
      <a href="/conveyancing/parkwood/" class="gc-suburb-link">Parkwood</a>
      <a href="/conveyancing/worongary/" class="gc-suburb-link">Worongary</a>
      <a href="/labrador/" class="gc-suburb-link">Labrador</a>
      <a href="/runaway-bay/" class="gc-suburb-link">Runaway Bay</a>
      <a href="/sanctuary-cove/" class="gc-suburb-link">Sanctuary Cove</a>
      <a href="/conveyancing/pacific-pines/" class="gc-suburb-link">Pacific Pines</a>
      <a href="/conveyancing/carrara/" class="gc-suburb-link">Carrara</a>
      <a href="/conveyancing/elanora/" class="gc-suburb-link">Elanora</a>
      <a href="/conveyancing/tugun/" class="gc-suburb-link">Tugun</a>
      <a href="/biggera-waters/" class="gc-suburb-link">Biggera Waters</a>
      <a href="/tamborine-mountain/" class="gc-suburb-link">Tamborine Mountain</a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="gc-cta">
  <div class="gc-container">
    <h2>Get Your Gold Coast Conveyancing Quote</h2>
    <p>Use our instant quote calculator to see your fixed-fee conveyancing costs — takes 30 seconds.</p>
    <div class="gc-cta-buttons">
      <a href="/conveyancing-quote/" class="btn-gold">Get an Instant Quote →</a>
      <a href="tel:+61731561216" class="btn-outline" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">Call +61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
