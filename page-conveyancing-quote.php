<?php
/**
 * Template Name: Conveyancing Quote
 *
 * Focused landing page for the conveyancing quote calculator.
 */

get_header();
?>

<style>
.cq-page{background:#fff}
.cq-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);padding:80px 0 70px;text-align:center;position:relative}
.cq-hero::before{content:'';position:absolute;top:0;right:0;width:50%;height:100%;background:linear-gradient(135deg,transparent 0%,rgba(166,132,46,.08) 100%);pointer-events:none}
.cq-container{max-width:1100px;margin:0 auto;padding:0 20px;position:relative}
.cq-hero h1{font-family:'League Spartan',sans-serif;font-size:52px;font-weight:800;color:#fff;margin:0 0 15px;line-height:1.15}
.cq-hero .hero-subtitle{font-family:'League Spartan',sans-serif;font-size:20px;color:rgba(255,255,255,.86);max-width:760px;margin:0 auto 24px;line-height:1.65}
.cq-trust{display:flex;justify-content:center;gap:18px;flex-wrap:wrap;margin-top:28px}
.cq-trust span{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);border-radius:999px;color:#fff;font-family:'League Spartan',sans-serif;font-size:14px;font-weight:700;padding:10px 16px}
.cq-intro{padding:48px 0;background:#f8f6f0}
.cq-intro-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.cq-intro-card{background:#fff;border:1px solid #e8e1d2;border-radius:12px;padding:26px;box-shadow:0 10px 24px rgba(13,27,62,.06)}
.cq-intro-card h2{font-family:'League Spartan',sans-serif;font-size:22px;font-weight:800;color:#0d1b3e;margin:0 0 10px}
.cq-intro-card p{font-size:16px;line-height:1.7;color:#4d4d4d;margin:0}
.cq-form-section{padding:64px 0;background:#fff}
.cq-form-section .section-title{text-align:center;margin-bottom:32px}
.cq-form-section .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin:0 0 10px}
.cq-form-section .section-title p{font-size:17px;color:#555;max-width:720px;margin:0 auto;line-height:1.7}
.cq-after{padding:56px 0;background:#fff}
.cq-after h2{font-family:'League Spartan',sans-serif;font-size:30px;font-weight:800;color:#0d1b3e;margin:0 0 16px;text-align:center}
.cq-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:28px}
.cq-step{border-left:4px solid #a6842e;background:#f8f6f0;border-radius:10px;padding:24px}
.cq-step h3{font-family:'League Spartan',sans-serif;font-size:20px;font-weight:800;color:#0d1b3e;margin:0 0 8px}
.cq-step p{font-size:15px;line-height:1.7;color:#555;margin:0}
@media(max-width:800px){.cq-hero{padding:56px 0}.cq-hero h1{font-size:34px}.cq-intro-grid,.cq-steps{grid-template-columns:1fr}.cq-form-section,.cq-after{padding:44px 0}}
</style>

<main class="cq-page">
  <section class="cq-hero">
    <div class="cq-container">
      <h1>Fixed-Fee Conveyancing Quote</h1>
      <p class="hero-subtitle">Get an instant fixed-fee conveyancing quote for buying or selling property in Queensland, with transparent pricing and solicitor-led support from OneStop Legal.</p>
      <div class="cq-trust" aria-label="Conveyancing quote benefits">
        <span>Instant online quote</span>
        <span>Buying or selling in Queensland</span>
        <span>Solicitor-led conveyancing</span>
        <span>No hidden costs</span>
      </div>
    </div>
  </section>

  <section class="cq-intro">
    <div class="cq-container cq-intro-grid">
      <div class="cq-intro-card">
        <h2>Clear fixed-fee pricing</h2>
        <p>Use the quote form to see the conveyancing costs for your Queensland property transaction before you decide to proceed.</p>
      </div>
      <div class="cq-intro-card">
        <h2>For buyers and sellers</h2>
        <p>Whether you are purchasing a home, selling a unit, or transferring land, the quote starts with your transaction type and local council area.</p>
      </div>
      <div class="cq-intro-card">
        <h2>Handled by solicitors</h2>
        <p>Your conveyancing matter is supported by a Queensland legal team that can guide contract, settlement, and PEXA requirements.</p>
      </div>
    </div>
  </section>

  <section class="cq-form-section" id="quote-section">
    <div class="cq-container">
      <div class="section-title">
        <h2>Start your instant quote</h2>
        <p>Select whether you are buying or selling, choose the property type and council area, then submit the form to receive your fixed-fee conveyancing estimate.</p>
      </div>
      <?php echo do_shortcode('[osl_quote_form heading="Fixed-Fee Conveyancing Quote"]'); ?>
    </div>
  </section>

  <section class="cq-after">
    <div class="cq-container">
      <h2>What happens after you submit?</h2>
      <div class="cq-steps">
        <div class="cq-step">
          <h3>1. Review your estimate</h3>
          <p>You receive transparent pricing for the selected buying or selling scenario, including relevant standard conveyancing items.</p>
        </div>
        <div class="cq-step">
          <h3>2. Speak with our team</h3>
          <p>OneStop Legal can answer questions about your quote, timing, contract status, and the next steps for your Queensland property matter.</p>
        </div>
        <div class="cq-step">
          <h3>3. Move toward settlement</h3>
          <p>If you proceed, our solicitor-led team coordinates the conveyancing process and electronic settlement requirements through to completion.</p>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
