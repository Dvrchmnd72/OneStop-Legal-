<?php
/**
 * Template Name: Services - Custom
 *
 * Custom Services page template for OneStop Legal
 */

get_header();
?>

<style>
/* ============================================
   SERVICES PAGE STYLES
   ============================================ */

/* Hero Section */
.services-hero {
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
  padding: 80px 0;
  text-align: center;
}
.services-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 52px;
  color: #ffffff;
  margin-bottom: 15px;
}
.services-hero .hero-subtitle {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  color: #c9a84c;
  font-style: italic;
  margin-bottom: 0;
}
.services-hero p.hero-desc {
  font-size: 18px;
  color: rgba(255,255,255,0.8);
  max-width: 700px;
  margin: 20px auto 0;
  line-height: 1.7;
}

/* Container */
.services-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Intro Section */
.services-intro {
  padding: 70px 0;
  background: #ffffff;
  text-align: center;
}
.services-intro h2 {
  font-family: 'Playfair Display', serif;
  font-size: 36px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.services-intro h2 span {
  color: #c9a84c;
}
.services-intro p {
  font-size: 18px;
  color: #555;
  max-width: 800px;
  margin: 0 auto;
  line-height: 1.8;
}

/* Services Grid */
.services-main {
  padding: 0 0 80px;
  background: #ffffff;
}
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}
.svc-card {
  background: #f8f6f0;
  border-radius: 12px;
  padding: 45px 35px;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-bottom: 4px solid transparent;
  text-decoration: none;
  display: block;
  color: inherit;
}
.svc-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(0,0,0,0.12);
  border-bottom-color: #c9a84c;
  color: inherit;
  text-decoration: none;
}
.svc-icon {
  font-size: 50px;
  margin-bottom: 20px;
}
.svc-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.svc-card p {
  font-size: 15px;
  line-height: 1.8;
  color: #555;
  margin-bottom: 20px;
}
.svc-link {
  display: inline-block;
  color: #c9a84c;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: color 0.3s ease;
}
.svc-card:hover .svc-link {
  color: #0d1b3e;
}

/* Trust Bar */
.services-trust {
  padding: 60px 0;
  background: #f8f6f0;
}
.trust-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  text-align: center;
}
.trust-item {
  padding: 20px;
}
.trust-icon {
  font-size: 40px;
  margin-bottom: 15px;
  color: #c9a84c;
}
.trust-item h3 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 8px;
}
.trust-item p {
  font-size: 14px;
  color: #666;
  line-height: 1.6;
}

/* Process Section */
.services-process {
  padding: 80px 0;
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
}
.services-process .section-title {
  text-align: center;
  margin-bottom: 60px;
}
.services-process .section-title h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #ffffff;
  margin-bottom: 10px;
}
.services-process .section-title p {
  font-size: 18px;
  color: #c9a84c;
}
.process-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
.process-step {
  text-align: center;
  padding: 30px 20px;
  position: relative;
}
.step-number {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  background: #c9a84c;
  color: #0d1b3e;
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  font-weight: 700;
  border-radius: 50%;
  margin-bottom: 20px;
}
.process-step h3 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  color: #ffffff;
  margin-bottom: 12px;
}
.process-step p {
  font-size: 15px;
  line-height: 1.7;
  color: rgba(255,255,255,0.75);
}

/* CTA Section */
.services-cta {
  padding: 70px 0;
  background: #c9a84c;
  text-align: center;
}
.services-cta h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.services-cta p {
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 35px;
  opacity: 0.85;
}
.services-cta-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}
.services-cta .btn-primary {
  background: #0d1b3e;
  color: #ffffff;
  padding: 16px 40px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 17px;
  font-weight: 600;
  transition: background 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.services-cta .btn-primary:hover {
  background: #1a2a4a;
  color: #ffffff;
}
.services-cta .btn-secondary {
  background: transparent;
  color: #0d1b3e;
  padding: 16px 40px;
  border-radius: 8px;
  border: 2px solid #0d1b3e;
  text-decoration: none;
  font-size: 17px;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
}
.services-cta .btn-secondary:hover {
  background: #0d1b3e;
  color: #ffffff;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 992px) {
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .process-grid,
  .trust-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .services-hero h1 { font-size: 40px; }
}

@media (max-width: 600px) {
  .services-hero { padding: 50px 0; }
  .services-hero h1 { font-size: 32px; }
  .services-hero .hero-subtitle { font-size: 18px; }
  .services-intro, .services-main, .services-process { padding: 50px 0; }
  .services-intro h2, .services-process .section-title h2,
  .services-cta h2 { font-size: 30px; }
  .services-grid, .process-grid, .trust-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- HERO SECTION -->
<section class="services-hero">
  <div class="services-container">
    <h1>Our Services</h1>
    <p class="hero-subtitle">Comprehensive Legal Solutions Under One Roof</p>
    <p class="hero-desc">From property transactions to estate planning, immigration to commercial law — we provide expert legal guidance tailored to your needs.</p>
  </div>
</section>

<!-- INTRO -->
<section class="services-intro">
  <div class="services-container">
    <h2>All of Your <span>Legal Solutions</span> in One Place</h2>
    <p>At OneStop Legal, we're not your typical law firm. We're a dedicated team of professionals committed to simplifying the legal process for you. Click on any service below to learn more about how we can help.</p>
  </div>
</section>

<!-- SERVICES GRID -->
<section class="services-main">
  <div class="services-container">
    <div class="services-grid">

      <a href="/conv/" class="svc-card">
        <div class="svc-icon">🏠</div>
        <h3>Conveyancing</h3>
        <p>Our experienced team handles all aspects of property transactions, ensuring a smooth and stress-free process from start to finish. Whether you're buying, selling, or leasing property, we're here to assist you.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/wills-and-estate-planning/" class="svc-card">
        <div class="svc-icon">📜</div>
        <h3>Wills &amp; Estate Planning</h3>
        <p>Plan for the future and protect your loved ones with our wills and estate planning services. We assist with drafting wills, establishing trusts, and developing comprehensive estate plans to safeguard your assets.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/commercial-and-corporate-law/" class="svc-card">
        <div class="svc-icon">🏢</div>
        <h3>Commercial &amp; Corporate Law</h3>
        <p>From business formation to contract negotiation, our commercial and corporate law services are tailored to help businesses of all sizes navigate legal challenges and achieve their goals.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/contract-reviews/" class="svc-card">
        <div class="svc-icon">📋</div>
        <h3>Contract Reviews</h3>
        <p>Ensure your contracts are legally sound and protect your interests. We carefully examine agreements to identify potential risks and ensure compliance with relevant laws and regulations.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/i/" class="svc-card">
        <div class="svc-icon">✈️</div>
        <h3>Immigration</h3>
        <p>Navigating immigration laws can be complex, but our services make the process easier. Whether you're seeking a substantive visa, residency, or citizenship, our team will guide you through every step.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/litigation/" class="svc-card">
        <div class="svc-icon">⚖️</div>
        <h3>Litigation</h3>
        <p>When disputes arise, our skilled litigators are prepared to advocate on your behalf in court. Whether it's civil litigation, commercial disputes, or employment law matters, we'll protect your rights.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/compensation/" class="svc-card">
        <div class="svc-icon">💰</div>
        <h3>Compensation</h3>
        <p>If you've been injured due to someone else's negligence, we're here to help you seek the compensation you deserve. Our team will fight tirelessly to ensure you receive fair compensation.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/binding-financial-agreements/" class="svc-card">
        <div class="svc-icon">💍</div>
        <h3>Binding Financial Agreements</h3>
        <p>Protect your assets and financial interests with binding financial agreements. Our team can assist you in drafting and negotiating agreements to resolve financial matters in a relationship or marriage.</p>
        <span class="svc-link">Learn More →</span>
      </a>

      <a href="/property-settlement-agent/" class="svc-card">
        <div class="svc-icon">🔑</div>
        <h3>Property Settlement Agent</h3>
        <p>As a property settlement agent service provider catering to solicitors, we offer comprehensive solutions to streamline the property settlement process for your clients.</p>
        <span class="svc-link">Learn More →</span>
      </a>

    </div>
  </div>
</section>

<!-- TRUST BAR -->
<section class="services-trust">
  <div class="services-container">
    <div class="trust-grid">
      <div class="trust-item">
        <div class="trust-icon">✅</div>
        <h3>Australia Wide Service</h3>
        <p>Helping clients across the country</p>
      </div>
      <div class="trust-item">
        <div class="trust-icon">✅</div>
        <h3>Virtual Consultations</h3>
        <p>Meet us from the comfort of home</p>
      </div>
      <div class="trust-item">
        <div class="trust-icon">✅</div>
        <h3>Transparent Pricing</h3>
        <p>No hidden fees or surprises</p>
      </div>
      <div class="trust-item">
        <div class="trust-icon">✅</div>
        <h3>Experienced Team</h3>
        <p>Seasoned legal professionals</p>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="services-process">
  <div class="services-container">
    <div class="section-title">
      <h2>How It Works</h2>
      <p>Getting started is simple</p>
    </div>
    <div class="process-grid">
      <div class="process-step">
        <div class="step-number">1</div>
        <h3>Get in Touch</h3>
        <p>Contact us via phone, email, or our online form to discuss your legal needs.</p>
      </div>
      <div class="process-step">
        <div class="step-number">2</div>
        <h3>Free Consultation</h3>
        <p>We'll arrange a free consultation to understand your situation and objectives.</p>
      </div>
      <div class="process-step">
        <div class="step-number">3</div>
        <h3>Tailored Strategy</h3>
        <p>Our team develops a customised legal strategy specific to your matter.</p>
      </div>
      <div class="process-step">
        <div class="step-number">4</div>
        <h3>Resolution</h3>
        <p>We work diligently to achieve the best possible outcome for you.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="services-cta">
  <div class="services-container">
    <h2>Ready to Get Started?</h2>
    <p>Book a free consultation today and let us handle the legal details.</p>
    <div class="services-cta-buttons">
      <a href="/contact-us/" class="btn-primary">Book a Free Consultation</a>
      <a href="tel:0417274441" class="btn-secondary">📞 0417 274 441</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
