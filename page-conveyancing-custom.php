<?php
/**
 * Template Name: Conveyancing - Custom
 */
get_header();
?>

<section class="svc-hero svc-hero--quote-first">
  <div class="svc-container">
    <h1>Conveyancing Services</h1>
    <p class="hero-subtitle">Start your fixed-fee conveyancing quote in under 30 seconds.</p>
    <p class="hero-description">Work directly with qualified solicitors, get transparent pricing, and receive a response within 2 business hours.</p>
    <a href="#quote-section" class="hero-cta" data-track-event="quote_start" data-track-location="hero">Start Your Quote &rarr;</a>

    <div class="svc-trust-bar" aria-label="Conveyancing trust indicators">
      <span>⭐ 4.9/5 Google rating</span>
      <span>Qualified Solicitors</span>
      <span>PEXA-ready settlements</span>
      <span>Fixed-fee transparency</span>
      <span>2 business hour response SLA</span>
    </div>
    <p class="svc-testimonial">“Fast and clear updates all the way to settlement day.” — Recent Conveyancing Client</p>
  </div>
</section>

<section class="svc-quote" id="quote-section">
  <div class="svc-container">
    <div class="section-title">
      <h2>Get Your Instant Conveyancing Quote</h2>
      <p>No obligation. No hidden fees. Start in one click.</p>
    </div>
    <?php echo do_shortcode('[osl_quote_form]'); ?>
  </div>
</section>

<section class="svc-types">
  <div class="svc-container">
    <div class="section-title">
      <h2>Our Conveyancing Services</h2>
      <p>Comprehensive support for property transactions across Queensland</p>
    </div>
    <div class="types-grid">
      <div class="type-card"><h3>Conveyancing for Buyers</h3><p>Contract review, due diligence, and settlement management for confident purchases.</p></div>
      <div class="type-card"><h3>Conveyancing for Sellers</h3><p>Fast contract preparation, disclosure support, and smooth settlement execution.</p></div>
      <div class="type-card"><h3>Contract Reviews</h3><p>Identify legal and financial risks before you sign.</p></div>
      <div class="type-card"><h3>Title Transfers</h3><p>Family transfers, refinancing updates, and ownership changes handled correctly.</p></div>
    </div>
  </div>
</section>

<section class="svc-faq">
  <div class="svc-container">
    <div class="section-title"><h2>Frequently Asked Questions</h2></div>
    <div class="faq-list">
      <div class="faq-item"><div class="faq-question"><span>How quickly can I start?</span><span class="faq-toggle">+</span></div><div class="faq-answer">Immediately. Use the quote form above to begin in one click and receive your estimate instantly.</div></div>
      <div class="faq-item"><div class="faq-question"><span>Who handles my matter?</span><span class="faq-toggle">+</span></div><div class="faq-answer">Your conveyancing matter is handled by qualified solicitors with property law experience.</div></div>
      <div class="faq-item"><div class="faq-question"><span>Do you provide fixed fees?</span><span class="faq-toggle">+</span></div><div class="faq-answer">Yes. We provide clear fixed-fee pricing with transparent disbursements before you proceed.</div></div>
    </div>
  </div>
</section>

<a href="#quote-section" class="osl-sticky-quote-cta" data-track-event="quote_start" data-track-location="sticky-mobile">Start Your Quote</a>

<script>
(function(){
  document.querySelectorAll('a[href="#quote-section"]').forEach(function(a){
    a.addEventListener('click', function(e){
      e.preventDefault();
      var quoteSection = document.getElementById('quote-section');
      if (quoteSection) quoteSection.scrollIntoView({behavior:'smooth', block:'start'});
      if (window.OSLTracking) window.OSLTracking.pushEvent('quote_start',{location: a.dataset.trackLocation || 'page'});
    });
  });

  document.querySelectorAll('.faq-question').forEach(function(q){
    q.addEventListener('click', function(){
      var item=this.parentElement;
      var wasActive=item.classList.contains('active');
      document.querySelectorAll('.faq-item').forEach(function(i){i.classList.remove('active')});
      if(!wasActive) item.classList.add('active');
    });
  });
})();
</script>

<?php get_footer(); ?>
