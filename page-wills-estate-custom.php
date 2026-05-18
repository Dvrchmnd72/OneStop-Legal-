<?php
/**
 * Template Name: Wills and Estate Planning - Custom
 *
 * Custom Wills and Estate Planning page template for OneStop Legal
 */

get_header();
?>


<!-- HERO -->
<section class="svc-hero">
  <div class="svc-container">
    <h1>Wills and Estate Planning</h1>
    <p class="hero-subtitle">Protect Your Legacy. Secure Your Loved Ones.</p>
    <p class="hero-description">Estate planning is not just for the wealthy. It is for anyone who wants to ensure their wishes are followed, their assets are protected, and their loved ones are taken care of.</p>
    <a href="/wills-and-estate-planning/wills-quote/" class="hero-cta">Get an Instant Quote &rarr;</a>
    <a href="/book/?service=Wills+%26+Estate+Planning" class="hero-cta" style="background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;margin-left:10px;">Book a Consultation &rarr;</a>
  </div>
</section>

<!-- LOCATION CARDS -->
<section style="padding:60px 0;background:#f8f6f0">
  <div style="max-width:1200px;margin:0 auto;padding:0 20px;text-align:center">
    <h2 style="font-family:Playfair Display,serif;font-size:38px;color:#0d1b3e;margin-bottom:10px">Wills &amp; Estate Planning by Location</h2>
    <p style="font-size:18px;color:#666;margin-bottom:40px">Click your state to see fixed-fee pricing</p>

    <!-- State selector tabs -->
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;max-width:800px;margin:0 auto 30px">
      <button onclick="oslToggleState('QLD',this)" style="display:block;width:100%;padding:25px 20px;background:#fff;border-radius:12px;text-decoration:none;color:#0d1b3e;font-family:Playfair Display,serif;font-size:18px;font-weight:700;box-shadow:0 4px 20px rgba(0,0,0,.06);transition:all .3s;border-bottom:3px solid #a6842e;cursor:pointer;border-top:none;border-left:none;border-right:none">Queensland</button>
      <button onclick="oslToggleState('NSW',this)" style="display:block;width:100%;padding:25px 20px;background:#fff;border-radius:12px;text-decoration:none;color:#0d1b3e;font-family:Playfair Display,serif;font-size:18px;font-weight:700;box-shadow:0 4px 20px rgba(0,0,0,.06);transition:all .3s;border-bottom:3px solid #a6842e;cursor:pointer;border-top:none;border-left:none;border-right:none">New South Wales</button>
      <button onclick="oslToggleState('VIC',this)" style="display:block;width:100%;padding:25px 20px;background:#fff;border-radius:12px;text-decoration:none;color:#0d1b3e;font-family:Playfair Display,serif;font-size:18px;font-weight:700;box-shadow:0 4px 20px rgba(0,0,0,.06);transition:all .3s;border-bottom:3px solid #a6842e;cursor:pointer;border-top:none;border-left:none;border-right:none">Victoria</button>
    </div>

    <!-- Pricing panels (hidden by default) -->
    <div id="osl-state-pricing" style="display:none;max-width:1000px;margin:0 auto">

      <div id="osl-pricing-label" style="font-family:Playfair Display,serif;font-size:22px;color:#0d1b3e;margin-bottom:25px;font-weight:700"></div>

      <!-- Single pricing row -->
      <div style="margin-bottom:30px">
        <h4 style="font-family:Playfair Display,serif;font-size:20px;color:#0d1b3e;margin-bottom:15px;text-align:left">👤 Single Person</h4>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #a6842e;text-align:left">
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Simple Will</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$330</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ Simple Will</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=simple" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #0d1b3e;text-align:left;position:relative">
            <div style="position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:#0d1b3e;color:#fff;font-size:11px;font-weight:700;padding:3px 12px;border-radius:20px">MOST POPULAR</div>
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Standard Package</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$550</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ Simple Will</li>
              <li>✓ Enduring Power of Attorney</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=standard" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #a6842e;text-align:left">
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Comprehensive</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$770</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ Simple Will</li>
              <li>✓ Enduring Power of Attorney</li>
              <li>✓ Advance Health Directive</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=comprehensive" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
        </div>
      </div>

      <!-- Couple pricing row -->
      <div style="margin-bottom:30px">
        <h4 style="font-family:Playfair Display,serif;font-size:20px;color:#0d1b3e;margin-bottom:15px;text-align:left">👥 Couple</h4>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #a6842e;text-align:left">
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Simple Wills</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$550</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ 2x Simple Wills</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=couple&pkg=simple" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #0d1b3e;text-align:left;position:relative">
            <div style="position:absolute;top:-10px;left:50%;transform:translateX(-50%);background:#0d1b3e;color:#fff;font-size:11px;font-weight:700;padding:3px 12px;border-radius:20px">MOST POPULAR</div>
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Standard Package</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$880</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ 2x Simple Wills</li>
              <li>✓ 2x Enduring Power of Attorney</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=couple&pkg=standard" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
          <div style="background:#fff;border-radius:12px;padding:24px 20px;box-shadow:0 4px 20px rgba(0,0,0,.06);border-top:3px solid #a6842e;text-align:left">
            <div style="font-family:Playfair Display,serif;font-size:17px;font-weight:700;color:#0d1b3e;margin-bottom:6px">Comprehensive</div>
            <div style="font-size:28px;font-weight:700;color:#a6842e;margin-bottom:12px">$1,210</div>
            <ul style="list-style:none;padding:0;margin:0 0 18px;font-size:13px;color:#555;line-height:1.8">
              <li>✓ 2x Simple Wills</li>
              <li>✓ 2x Enduring Power of Attorney</li>
              <li>✓ 2x Advance Health Directive</li>
              <li>✓ Solicitor consultation</li>
              <li>✓ Professional drafting</li>
              <li>✓ Signing appointment</li>
            </ul>
            <a href="/wills-and-estate-planning/wills-quote/?who=couple&pkg=comprehensive" style="display:block;text-align:center;background:#a6842e;color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
          </div>
        </div>
      </div>

      <!-- Complex estate -->
      <div style="background:#0d1b3e;border-radius:12px;padding:24px 30px;text-align:left;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
        <div>
          <div style="font-family:Playfair Display,serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:4px">Complex Estate</div>
          <div style="font-size:14px;color:rgba(255,255,255,.7)">Blended families · Testamentary trusts · Business succession · SMSF</div>
        </div>
        <div style="text-align:right">
          <div style="font-size:26px;font-weight:700;color:#a6842e;margin-bottom:8px">From $1,800</div>
          <a href="/wills-and-estate-planning/wills-quote/?who=single&pkg=complex" style="display:inline-block;background:#a6842e;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px">Get a Quote →</a>
        </div>
      </div>

    </div><!-- end osl-state-pricing -->
  </div>
</section>

<script>
var oslActiveBtn = null;
function oslToggleState(state, btn) {
  var panel = document.getElementById('osl-state-pricing');
  var label = document.getElementById('osl-pricing-label');
  var names = {QLD:'Queensland',NSW:'New South Wales',VIC:'Victoria'};

  if (oslActiveBtn && oslActiveBtn !== btn) {
    oslActiveBtn.style.background = '#fff';
    oslActiveBtn.style.color = '#0d1b3e';
  }

  if (panel.style.display === 'none' || oslActiveBtn !== btn) {
    panel.style.display = 'block';
    label.textContent = names[state] + ' — Fixed-Fee Pricing';
    btn.style.background = '#0d1b3e';
    btn.style.color = '#fff';
    oslActiveBtn = btn;
    panel.scrollIntoView({behavior:'smooth', block:'nearest'});
  } else {
    panel.style.display = 'none';
    btn.style.background = '#fff';
    btn.style.color = '#0d1b3e';
    oslActiveBtn = null;
  }
}
</script>

<!-- INTRO -->
<section class="svc-intro">
  <div class="svc-container">
    <div class="svc-intro-grid">
      <div class="svc-intro-text">
        <h2>Expert <span>Estate Planning</span> Services</h2>
        <p>At <strong>OneStop Legal</strong>, we understand that planning for the future is essential to ensure your wishes are respected and your loved ones are taken care of. Our wills and estate planning services provide you with peace of mind, knowing that your affairs are in order and legally sound under Australian law.</p>
        <p>Our experienced estate planning lawyers provide expert advice tailored to your unique circumstances. We help you navigate the complexities of estate planning, ensuring your assets are protected and distributed according to your wishes.</p>
        <p>We offer a <strong>full range of estate planning services</strong>, from drafting simple wills to creating complex trusts and handling probate matters. Our goal is to cover every aspect of your estate to prevent future disputes and complications.</p>
      </div>
      <div class="svc-intro-image">
        <div class="intro-icon">&#x1F4DC;</div>
      </div>
    </div>
  </div>
</section>

<!-- OUR SERVICES -->
<section class="svc-types">
  <div class="svc-container">
    <div class="section-title">
      <h2>Our Estate Planning Services</h2>
      <p>Comprehensive solutions to protect your legacy</p>
    </div>
    <div class="types-grid">
      <div class="type-card">
        <div class="type-icon">&#x1F4DD;</div>
        <h3>Wills</h3>
        <p>Drafting, reviewing, and updating wills to ensure they are legally valid and reflective of your current wishes. We make sure your assets go where you want them to.</p>
      </div>
      <div class="type-card">
        <div class="type-icon">&#x1F4CB;</div>
        <h3>Powers of Attorney</h3>
        <p>Preparing documents to appoint trusted individuals to make financial and medical decisions on your behalf if you become unable to do so.</p>
      </div>
      <div class="type-card">
        <div class="type-icon">&#x1F3E6;</div>
        <h3>Trusts</h3>
        <p>Establishing and managing trusts to protect your assets and provide for beneficiaries in a tax-efficient manner, including family trusts and testamentary trusts.</p>
      </div>
      <div class="type-card">
        <div class="type-icon">&#x2696;</div>
        <h3>Estate Administration</h3>
        <p>Assisting executors and administrators with the probate process, ensuring the smooth and efficient distribution of the deceased estate.</p>
      </div>
      <div class="type-card">
        <div class="type-icon">&#x1F476;</div>
        <h3>Guardianship</h3>
        <p>Setting up guardianship arrangements for minor children or dependents to ensure they are cared for according to your wishes if something happens to you.</p>
      </div>
      <div class="type-card">
        <div class="type-icon">&#x1F3E5;</div>
        <h3>Advance Care Directives</h3>
        <p>Creating directives that outline your preferences for medical treatment and end-of-life care, ensuring your healthcare wishes are respected.</p>
      </div>
    </div>
  </div>
</section>

<!-- WHY ESTATE PLANNING MATTERS (dark) -->
<section class="svc-elements">
  <div class="svc-container">
    <div class="section-title">
      <h2>Why Estate Planning Matters</h2>
      <p>Proper planning protects what matters most</p>
    </div>
    <div class="elements-grid">
      <div class="element-card">
        <div class="element-icon">&#x1F6E1;</div>
        <h3>Avoid Disputes</h3>
        <p>Prevent disputes and legal challenges among family members with clear, legally sound documentation.</p>
      </div>
      <div class="element-card">
        <div class="element-icon">&#x1F4B0;</div>
        <h3>Minimise Taxes</h3>
        <p>Reduce taxes and expenses associated with estate administration through strategic planning.</p>
      </div>
      <div class="element-card">
        <div class="element-icon">&#x2705;</div>
        <h3>Honour Your Wishes</h3>
        <p>Ensure your assets are distributed exactly according to your wishes, not left to default rules.</p>
      </div>
      <div class="element-card">
        <div class="element-icon">&#x1F46A;</div>
        <h3>Protect Loved Ones</h3>
        <p>Provide for the care and financial security of your family, children, and dependents.</p>
      </div>
      <div class="element-card">
        <div class="element-icon">&#x1F91D;</div>
        <h3>Appoint Decision Makers</h3>
        <p>Appoint trusted individuals to make decisions on your behalf if you become incapacitated.</p>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="svc-benefits">
  <div class="svc-container">
    <div class="section-title">
      <h2>Why Choose OneStop Legal?</h2>
      <p>What makes us different</p>
    </div>
    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon">&#x1F393;</div>
        <div>
          <h3>Expert Guidance</h3>
          <p>Our experienced estate planning lawyers provide expert advice tailored to your unique circumstances, helping you navigate the complexities of estate planning.</p>
        </div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">&#x1F3AF;</div>
        <div>
          <h3>Personalised Service</h3>
          <p>Every client is unique, and so are their estate planning needs. We take the time to understand your goals and provide personalised solutions that reflect your values.</p>
        </div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">&#x1F4CB;</div>
        <div>
          <h3>Comprehensive Planning</h3>
          <p>We cover every aspect of your estate, from wills and trusts to powers of attorney and advance care directives, preventing future disputes and complications.</p>
        </div>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">&#x1F4AC;</div>
        <div>
          <h3>Clear Communication</h3>
          <p>We explain all aspects of your estate plan in clear, simple language, ensuring you fully understand your options and decisions without confusing legal jargon.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="svc-legal">
  <div class="svc-container">
    <div class="section-title">
      <h2>The Estate Planning Process</h2>
      <p>Our straightforward approach</p>
    </div>
    <div class="legal-list">
      <div class="legal-item">
        <div class="legal-number">1</div>
        <p><strong>Initial Consultation:</strong> We start with a detailed discussion to understand your objectives and gather information about your assets and family situation.</p>
      </div>
      <div class="legal-item">
        <div class="legal-number">2</div>
        <p><strong>Tailored Advice:</strong> Based on your needs, we provide tailored advice on the best estate planning strategies to achieve your goals.</p>
      </div>
      <div class="legal-item">
        <div class="legal-number">3</div>
        <p><strong>Drafting Documents:</strong> Our legal team drafts all necessary documents, ensuring they comply with Australian law and accurately reflect your wishes.</p>
      </div>
      <div class="legal-item">
        <div class="legal-number">4</div>
        <p><strong>Review and Finalisation:</strong> We review the documents with you, make any necessary adjustments, and finalise them for signing.</p>
      </div>
      <div class="legal-item">
        <div class="legal-number">5</div>
        <p><strong>Ongoing Support:</strong> Estate planning is not a one-time event. We offer ongoing support to update your estate plan as your circumstances change.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="svc-faq">
  <div class="svc-container">
    <div class="section-title">
      <h2>Frequently Asked Questions</h2>
      <p>Common questions about wills and estate planning</p>
    </div>
    <div class="faq-list">
      <div class="faq-item">
        <div class="faq-question">
          <span>Do I really need a will?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">Yes. Without a valid will, your assets will be distributed according to intestacy laws, which may not reflect your wishes. A will ensures your assets go to the people you choose, and allows you to appoint guardians for minor children.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">
          <span>What happens if I die without a will?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">If you die without a will (known as dying intestate), your estate will be distributed according to a statutory formula set by the government. This may not align with your wishes and can lead to disputes among family members, delays, and additional costs.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">
          <span>How often should I update my will?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">You should review your will every 3 to 5 years, or whenever there is a significant change in your circumstances, such as marriage, divorce, the birth of a child, acquisition of major assets, or a change in your financial situation.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">
          <span>What is the difference between a will and a trust?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">A will takes effect after you die and directs how your assets are distributed. A trust can take effect during your lifetime or after death, and allows a trustee to manage assets on behalf of beneficiaries. Trusts can offer tax benefits, asset protection, and greater control over how and when assets are distributed.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">
          <span>What is a Power of Attorney?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">A Power of Attorney is a legal document that allows you to appoint someone you trust to make financial or personal decisions on your behalf if you become unable to do so due to illness, injury, or incapacity. It is a critical part of any comprehensive estate plan.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">
          <span>How much does estate planning cost?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">Our pricing starts from $330 for a Simple Will with fixed-fee packages and no hidden costs. <a href="/wills-and-estate-planning/wills-quote/" style="color:#C5A267;font-weight:bold;">Get an instant quote online</a> or contact us for a free consultation.</div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="svc-cta">
  <div class="svc-container">
    <h2>Secure Your Legacy Today</h2>
    <p>Book a consultation with our experienced estate planning lawyers and take the first step towards peace of mind.</p>
    <div class="svc-cta-buttons">
      <a href="/wills-and-estate-planning/wills-quote/" class="btn-primary">Get an Instant Quote &rarr;</a>
      <a href="/book/?service=Wills+%26+Estate+Planning" class="btn-primary">Book a Consultation</a>
      <a href="tel:+61731561216" class="btn-secondary" btn-phone><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">+61 7 3156 1216</span></a>
    </div>
  </div>
</section>

<script>
document.querySelectorAll(".faq-question").forEach(function(q){
  q.addEventListener("click",function(){
    var item=this.parentElement;
    var wasActive=item.classList.contains("active");
    document.querySelectorAll(".faq-item").forEach(function(i){i.classList.remove("active")});
    if(!wasActive) item.classList.add("active");
  });
});
</script>

<?php get_footer(); ?>