<?php
/**
 * Template Name: Wills Gold Coast
 *
 * Focused landing page targeting "wills gold coast" / "estate planning gold coast"
 */

get_header();
?>

<style>
.wgc-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);padding:90px 0;text-align:center;position:relative}
.wgc-hero::before{content:'';position:absolute;top:0;right:0;width:50%;height:100%;background:linear-gradient(135deg,transparent 0%,rgba(166,132,46,0.08) 100%);pointer-events:none}
.wgc-hero h1{font-family:'League Spartan',sans-serif;font-size:52px;font-weight:800;color:#fff;margin-bottom:15px;line-height:1.15}
.wgc-hero h1 span{color:#a6842e}
.wgc-hero .hero-subtitle{font-family:'League Spartan',sans-serif;font-size:20px;color:rgba(255,255,255,0.85);max-width:720px;margin:0 auto 35px;line-height:1.7}
.wgc-hero .hero-buttons{display:flex;justify-content:center;gap:16px;flex-wrap:wrap}
.wgc-hero .hero-cta{display:inline-flex;align-items:center;gap:10px;background:#a6842e;color:#0d1b3e;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.wgc-hero .hero-cta:hover{background:#c49a30;transform:translateY(-2px);color:#0d1b3e;text-decoration:none}
.wgc-hero .hero-cta-secondary{display:inline-flex;align-items:center;gap:10px;background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.wgc-hero .hero-cta-secondary:hover{border-color:#fff;background:rgba(255,255,255,.1);color:#fff;text-decoration:none}
.wgc-container{max-width:1200px;margin:0 auto;padding:0 20px}
.wgc-trust{background:#a6842e;padding:18px 0}
.wgc-trust-items{display:flex;justify-content:center;gap:40px;flex-wrap:wrap;max-width:1200px;margin:0 auto;padding:0 20px}
.wgc-trust-item{display:flex;align-items:center;gap:8px;font-family:'League Spartan',sans-serif;font-size:15px;font-weight:600;color:#0d1b3e}
.wgc-services{padding:70px 0;background:#fff}
.wgc-services .section-title{text-align:center;margin-bottom:45px}
.wgc-services .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.wgc-services .section-title p{font-size:17px;color:#666}
.wgc-services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.wgc-svc-card{text-align:center;padding:35px 25px;background:#f8f6f0;border-radius:12px;transition:transform .3s,box-shadow .3s;border-bottom:3px solid transparent}
.wgc-svc-card:hover{transform:translateY(-4px);box-shadow:0 8px 25px rgba(0,0,0,.08);border-bottom-color:#a6842e}
.wgc-svc-icon{font-size:40px;margin-bottom:16px}
.wgc-svc-card h3{font-family:'League Spartan',sans-serif;font-size:19px;font-weight:700;color:#0d1b3e;margin-bottom:10px}
.wgc-svc-card p{font-size:15px;line-height:1.7;color:#555;margin-bottom:0}
.wgc-pricing{padding:70px 0;background:#f8f6f0}
.wgc-pricing .section-title{text-align:center;margin-bottom:45px}
.wgc-pricing .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.wgc-pricing .section-title p{font-size:17px;color:#666}
.wgc-pricing-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;max-width:1200px;margin:0 auto}
.wgc-price-card{background:#fff;border-radius:12px;padding:40px 30px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,.06);transition:transform .3s;border-top:4px solid #e0dcd3;position:relative}
.wgc-price-card.featured{border-top-color:#a6842e;transform:scale(1.04)}
.wgc-price-card.featured::before{content:'MOST POPULAR';position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:#a6842e;color:#0d1b3e;padding:4px 18px;border-radius:20px;font-family:'League Spartan',sans-serif;font-size:12px;font-weight:700;letter-spacing:1px}
.wgc-price-card:hover{transform:translateY(-4px)}
.wgc-price-card.featured:hover{transform:scale(1.04) translateY(-4px)}
.wgc-price-card h3{font-family:'League Spartan',sans-serif;font-size:22px;font-weight:700;color:#0d1b3e;margin-bottom:8px}
.wgc-price-amount{font-family:'League Spartan',sans-serif;font-size:42px;font-weight:800;color:#a6842e;margin:15px 0 5px}
.wgc-price-amount small{font-size:16px;color:#888;font-weight:400}
.wgc-price-note{font-size:14px;color:#888;margin-bottom:20px}
.wgc-price-features{list-style:none;padding:0;margin:0 0 25px;text-align:left}
.wgc-price-features li{padding:8px 0;font-size:14px;color:#555;border-bottom:1px solid #f0ece3;display:flex;align-items:center;gap:8px}
.wgc-price-features li:last-child{border-bottom:none}
.wgc-price-cta{display:inline-block;background:#a6842e;color:#0d1b3e;padding:14px 32px;border-radius:8px;text-decoration:none;font-family:'League Spartan',sans-serif;font-size:16px;font-weight:700;transition:all .3s}
.wgc-price-cta:hover{background:#c49a30;color:#0d1b3e;text-decoration:none}
.wgc-trigger{padding:70px 0;background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%)}
.wgc-trigger .section-title{text-align:center;margin-bottom:45px}
.wgc-trigger .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#fff;margin-bottom:10px}
.wgc-trigger .section-title p{font-size:17px;color:#a6842e}
.wgc-trigger-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;max-width:1000px;margin:0 auto}
.wgc-trigger-card{text-align:center;padding:30px 15px;border:1px solid rgba(255,255,255,.12);border-radius:12px;transition:border-color .3s,background .3s}
.wgc-trigger-card:hover{border-color:#a6842e;background:rgba(255,255,255,.05)}
.wgc-trigger-icon{font-size:36px;margin-bottom:12px}
.wgc-trigger-card h3{font-family:'League Spartan',sans-serif;font-size:16px;font-weight:700;color:#fff;margin-bottom:8px}
.wgc-trigger-card p{font-size:13px;color:rgba(255,255,255,.7);line-height:1.6}
.wgc-process{padding:70px 0;background:#fff}
.wgc-process .section-title{text-align:center;margin-bottom:45px}
.wgc-process .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.wgc-process .section-title p{font-size:17px;color:#666}
.wgc-steps{display:grid;grid-template-columns:repeat(4,1fr);gap:28px;max-width:1000px;margin:0 auto}
.wgc-step{text-align:center;position:relative}
.wgc-step-num{width:50px;height:50px;background:#a6842e;color:#0d1b3e;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'League Spartan',sans-serif;font-size:22px;font-weight:800;margin:0 auto 16px}
.wgc-step h3{font-family:'League Spartan',sans-serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:8px}
.wgc-step p{font-size:14px;color:#555;line-height:1.6}
.wgc-faq{padding:70px 0;background:#f8f6f0}
.wgc-faq .section-title{text-align:center;margin-bottom:45px}
.wgc-faq .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.wgc-faq .section-title p{font-size:17px;color:#666}
.wgc-faq-list{max-width:800px;margin:0 auto}
.wgc-faq-item{background:#fff;border-radius:12px;margin-bottom:12px;box-shadow:0 2px 10px rgba(0,0,0,.04);overflow:hidden}
.wgc-faq-q{padding:20px 28px;cursor:pointer;display:flex;justify-content:space-between;align-items:center;font-family:'League Spartan',sans-serif;font-size:17px;color:#0d1b3e;font-weight:700;transition:background .3s}
.wgc-faq-q:hover{background:#f0ece3}
.wgc-faq-toggle{font-size:22px;color:#a6842e;transition:transform .3s;flex-shrink:0;margin-left:15px}
.wgc-faq-item.active .wgc-faq-toggle{transform:rotate(45deg)}
.wgc-faq-a{display:none;padding:0 28px 20px;font-size:15px;line-height:1.8;color:#555}
.wgc-faq-item.active .wgc-faq-a{display:block}
.wgc-cta{padding:70px 0;background:#a6842e;text-align:center}
.wgc-cta h2{font-family:'League Spartan',sans-serif;font-size:36px;font-weight:800;color:#0d1b3e;margin-bottom:15px}
.wgc-cta p{font-size:18px;color:#0d1b3e;opacity:.85;margin-bottom:35px;max-width:600px;margin-left:auto;margin-right:auto}
.wgc-cta-buttons{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}
<!-- HERO -->
<section class="wgc-hero">
  <div class="wgc-container">
    <h1>Wills &amp; Estate Planning <span>Gold Coast</span></h1>
    <p class="hero-subtitle">Protect your family, your assets, and your legacy with expert estate planning from a Gold Coast law firm. Fixed-fee wills from $330.</p>
    <div class="hero-buttons">
      <a href="/book/?service=Wills+%26+Estate+Planning" class="hero-cta">Book a Consultation →</a>
      <a href="tel:+61731561216" class="hero-cta-secondary" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">+61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<!-- TRUST BAR -->
<section class="wgc-trust">
  <div class="wgc-trust-items">
    <div class="wgc-trust-item">✓ Fixed Fee — No Surprises</div>
    <div class="wgc-trust-item">✓ Qualified Solicitors</div>
    <div class="wgc-trust-item">✓ Gold Coast Based</div>
    <div class="wgc-trust-item">✓ Free Initial Consultation</div>
  </div>
</section>

<!-- PRICING -->
<section class="wgc-pricing">
  <div class="wgc-container">
    <div class="section-title">
      <h2>Transparent Fixed-Fee Pricing</h2>
      <p>No hidden costs, no hourly billing — know exactly what you will pay</p>
    </div>
    <div class="wgc-pricing-grid">
      <div class="wgc-price-card">
        <h3>Simple Will</h3>
        <div class="wgc-price-amount">$330 <small>incl. GST</small></div>
        <p class="wgc-price-note">Couples: $550</p>
        <ul class="wgc-price-features">
          <li>✓ Solicitor consultation</li>
          <li>✓ Professionally drafted will</li>
          <li>✓ Asset distribution planning</li>
          <li>✓ Executor appointment</li>
          <li>✓ Guardian nomination</li>
        </ul>
        <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=simple" class="wgc-price-cta">Get Started →</a>
      </div>
      <div class="wgc-price-card featured">
        <h3>Will + EPOA Bundle</h3>
        <div class="wgc-price-amount">$495 <small>incl. GST</small></div>
        <p class="wgc-price-note">Couples: $880</p>
        <ul class="wgc-price-features">
          <li>✓ Everything in Simple Will</li>
          <li>✓ Enduring Power of Attorney</li>
          <li>✓ Financial &amp; personal matters</li>
          <li>✓ QLD compliant documents</li>
          <li>✓ Witnessing guidance</li>
        </ul>
        <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=standard" class="wgc-price-cta">Get Started →</a>
      </div>
      <div class="wgc-price-card">
        <h3>Complete Estate Plan</h3>
        <div class="wgc-price-amount">$695 <small>incl. GST</small></div>
        <p class="wgc-price-note">Couples: $1,250</p>
        <ul class="wgc-price-features">
          <li>✓ Everything in Bundle</li>
          <li>✓ Advance Health Directive</li>
          <li>✓ Comprehensive review</li>
          <li>✓ Secure document storage</li>
          <li>✓ Annual review reminder</li>
        </ul>
        <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=comprehensive" class="wgc-price-cta">Get Started →</a>
      </div>
      <div class="wgc-price-card">
        <h3>Complex Estate Plan</h3>
        <div class="wgc-price-amount">From $1,500</div>
        <p class="wgc-price-note">Tailored quote provided</p>
        <ul class="wgc-price-features">
          <li>✓ Everything in Complete Plan</li>
          <li>✓ Testamentary trust wills</li>
          <li>✓ Business succession planning</li>
          <li>✓ Blended family structures</li>
          <li>✓ SMSF death benefit nominations</li>
          <li>✓ Multi-property planning</li>
          <li>✓ Strategy session &amp; ongoing review</li>
        </ul>
        <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=complex" class="wgc-price-cta">Get a Quote →</a>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="wgc-services">
  <div class="wgc-container">
    <div class="section-title">
      <h2>Our Wills &amp; Estate Planning Services</h2>
      <p>Comprehensive estate planning for Gold Coast individuals and families</p>
    </div>
    <div class="wgc-services-grid">
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">📝</div>
        <h3>Simple Wills</h3>
        <p>A legally binding will drafted by a qualified solicitor, covering asset distribution, guardianship of children, and appointment of executors.</p>
      </div>
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">📋</div>
        <h3>Complex Wills &amp; Trusts</h3>
        <p>For blended families, business owners, and larger estates. Includes testamentary trusts, discretionary trusts, and multi-beneficiary structures.</p>
      </div>
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">🤝</div>
        <h3>Enduring Power of Attorney</h3>
        <p>Appoint a trusted person to manage your financial and personal affairs if you lose capacity. Essential for every adult in Queensland.</p>
      </div>
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">🏥</div>
        <h3>Advance Health Directive</h3>
        <p>Document your healthcare wishes and end-of-life preferences so your medical decisions are respected if you cannot communicate them.</p>
      </div>
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">⚖️</div>
        <h3>Probate &amp; Estate Administration</h3>
        <p>Guidance for executors through the probate process in Queensland, including applications to the Supreme Court and estate distribution.</p>
      </div>
      <div class="wgc-svc-card">
        <div class="wgc-svc-icon">🔄</div>
        <h3>Will Reviews &amp; Updates</h3>
        <p>Life changes — so should your will. We review and update existing wills after marriage, divorce, new children, or changes in assets.</p>
      </div>
    </div>
  </div>
</section>

<!-- DO YOU NEED A WILL? LIFE EVENT TRIGGERS -->
<section class="wgc-trigger">
  <div class="wgc-container">
    <div class="section-title">
      <h2>Do You Need a Will?</h2>
      <p>If any of these apply to you, it is time to act</p>
    </div>
    <div class="wgc-trigger-grid">
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">💍</div>
        <h3>Getting Married</h3>
        <p>Marriage revokes existing wills in Queensland. You need a new will.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">👶</div>
        <h3>New Baby</h3>
        <p>Appoint guardians and ensure your children are financially protected.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">🏠</div>
        <h3>Bought Property</h3>
        <p>Your biggest asset needs clear direction on who inherits it.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">💔</div>
        <h3>Separated or Divorced</h3>
        <p>Update your will so your ex-partner does not inherit your estate.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">👨‍👩‍👧‍👦</div>
        <h3>Blended Family</h3>
        <p>Ensure all children — biological and step — are properly provided for.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">🏢</div>
        <h3>Business Owner</h3>
        <p>Plan for business succession so your business does not die with you.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">🎂</div>
        <h3>Turned 18+</h3>
        <p>Every adult should have a will and power of attorney — regardless of age or wealth.</p>
      </div>
      <div class="wgc-trigger-card">
        <div class="wgc-trigger-icon">✈️</div>
        <h3>Travelling Overseas</h3>
        <p>Heading abroad? Make sure your affairs are in order before you go.</p>
      </div>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="wgc-process">
  <div class="wgc-container">
    <div class="section-title">
      <h2>How It Works</h2>
      <p>Your will sorted in 4 simple steps</p>
    </div>
    <div class="wgc-steps">
      <div class="wgc-step">
        <div class="wgc-step-num">1</div>
        <h3>Free Consultation</h3>
        <p>Book a free chat with our estate planning team. We will assess your situation and recommend the right plan.</p>
      </div>
      <div class="wgc-step">
        <div class="wgc-step-num">2</div>
        <h3>Gather Your Details</h3>
        <p>We send you a simple questionnaire to collect your asset, beneficiary, and executor information.</p>
      </div>
      <div class="wgc-step">
        <div class="wgc-step-num">3</div>
        <h3>We Draft Your Documents</h3>
        <p>Our solicitors draft your will and estate documents, fully compliant with Queensland law.</p>
      </div>
      <div class="wgc-step">
        <div class="wgc-step-num">4</div>
        <h3>Review, Sign &amp; Secure</h3>
        <p>We review everything with you, arrange proper signing and witnessing, and securely store your documents.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="wgc-faq">
  <div class="wgc-container">
    <div class="section-title">
      <h2>Frequently Asked Questions</h2>
      <p>Common questions about wills and estate planning on the Gold Coast</p>
    </div>
    <div class="wgc-faq-list">
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>How much does a will cost on the Gold Coast?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">A simple will starts from $330 (incl. GST) for an individual, or $550 for a couple. We offer fixed-fee pricing so you know exactly what you will pay — no hidden costs or hourly billing. For complex estates involving trusts or blended families, we provide a tailored quote after your free consultation.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>Do I need a lawyer to make a will in Queensland?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">While it is legally possible to write your own will, it is strongly recommended to use a qualified solicitor. DIY wills and will kits frequently contain errors that can make them invalid or lead to costly disputes. A solicitor ensures your will is legally sound, properly witnessed, and covers all your assets and wishes under Queensland law.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>What happens if I die without a will in Queensland?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">If you die without a will (intestate) in Queensland, your estate is distributed according to the Succession Act 1981. This statutory formula may not reflect your wishes — for example, your assets may go to relatives you would not have chosen, and your partner may not receive everything. It also causes delays, extra legal costs, and potential family disputes.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>What is an Enduring Power of Attorney in Queensland?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">An Enduring Power of Attorney (EPOA) is a legal document that allows you to appoint a trusted person to make financial and personal decisions on your behalf if you lose capacity due to illness, accident, or age. In Queensland, the EPOA must comply with the Powers of Attorney Act 1998. It is one of the most important documents every adult should have.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>Does getting married revoke my will?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">Yes. In Queensland, marriage automatically revokes any existing will unless the will was made in contemplation of that specific marriage. If you are getting married, you should make a new will either before or immediately after the wedding to ensure your assets are distributed as you intend.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>Can someone contest my will?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">Yes. Under the Succession Act 1981, eligible persons (including spouses, children, and dependents) can make a family provision application if they believe they have not been adequately provided for. A professionally drafted will with clear reasoning and proper legal advice significantly reduces the risk of a successful challenge.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>How often should I update my will?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">You should review your will every 3 to 5 years, or after any major life event — marriage, divorce, birth of a child, purchasing property, starting a business, or a significant change in your financial situation. Our Complete Estate Plan includes annual review reminders so you never forget.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>What is the difference between a will and a testamentary trust?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">A standard will distributes your assets directly to beneficiaries after you die. A testamentary trust is created within your will and holds assets in trust for your beneficiaries, offering greater control, asset protection, and potential tax benefits — particularly useful for families with minor children, blended families, or larger estates.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>Is probate required for all estates in Queensland?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">Not always. Probate (a grant of representation from the Supreme Court of Queensland) is typically required when the estate includes real property, shares, or significant bank balances. Smaller estates or jointly held assets may not require probate. Our team can advise whether probate is needed for your specific situation.</div>
      </div>
      <div class="wgc-faq-item">
        <div class="wgc-faq-q">
          <span>Can I make a will online in Queensland?</span>
          <span class="wgc-faq-toggle">+</span>
        </div>
        <div class="wgc-faq-a">While online will services exist, they carry significant risks. Queensland law has strict requirements for witnessing and execution of wills. Errors in DIY or online wills are one of the most common causes of estate disputes. We offer convenient phone and video consultations so you get proper legal advice from the comfort of your home, with a professionally drafted will that is legally valid.</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="wgc-cta">
  <div class="wgc-container">
    <h2>Protect Your Family Today</h2>
    <p>Book a consultation with our Gold Coast estate planning team. No obligation, no pressure — just expert advice.</p>
    <div class="wgc-cta-buttons">
      <a href="/book/?service=Wills+%26+Estate+Planning" class="btn-primary">Book a Consultation →</a>
      <a href="tel:+61731561216" class="btn-secondary" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">Call +61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<script>
document.querySelectorAll(".wgc-faq-q").forEach(function(q){
  q.addEventListener("click",function(){
    var item=this.parentElement;
    var wasActive=item.classList.contains("active");
    document.querySelectorAll(".wgc-faq-item").forEach(function(i){i.classList.remove("active")});
    if(!wasActive) item.classList.add("active");
  });
});
</script>

<?php get_footer(); ?>
