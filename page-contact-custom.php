<?php
/**
 * Template Name: Contact Us - Custom
 *
 * Custom Contact Us page template for OneStop Legal
 */

get_header();
?>

<style>
/* ============================================
   CONTACT PAGE STYLES
   ============================================ */

/* Hero Section */
.contact-hero {
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
  padding: 80px 0;
  text-align: center;
}
.contact-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 52px;
  color: #ffffff;
  margin-bottom: 15px;
}
.contact-hero .hero-subtitle {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  color: #c9a84c;
  font-style: italic;
  margin-bottom: 0;
}
.contact-hero p.hero-desc {
  font-size: 18px;
  color: rgba(255,255,255,0.8);
  max-width: 700px;
  margin: 20px auto 0;
  line-height: 1.7;
}

/* Container */
.contact-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Quick Contact Bar */
.contact-quick {
  padding: 60px 0;
  background: #f8f6f0;
}
.quick-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}
.quick-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 40px 30px;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-bottom: 4px solid transparent;
  text-decoration: none;
  display: block;
  color: inherit;
}
.quick-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 40px rgba(0,0,0,0.1);
  border-bottom-color: #c9a84c;
  color: inherit;
  text-decoration: none;
}
.quick-icon {
  font-size: 44px;
  margin-bottom: 18px;
}
.quick-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  color: #0d1b3e;
  margin-bottom: 10px;
}
.quick-card p {
  font-size: 16px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 5px;
}
.quick-card .quick-link {
  font-size: 17px;
  font-weight: 600;
  color: #c9a84c;
  text-decoration: none;
}
.quick-card:hover .quick-link {
  color: #0d1b3e;
}

/* Main Contact Section - Form + Info */
.contact-main {
  padding: 80px 0;
  background: #ffffff;
}
.contact-layout {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 60px;
  align-items: start;
}

/* Form Side */
.contact-form-wrap {
  background: #f8f6f0;
  border-radius: 12px;
  padding: 50px 40px;
}
.contact-form-wrap h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  color: #0d1b3e;
  margin-bottom: 10px;
}
.contact-form-wrap .form-subtitle {
  font-size: 16px;
  color: #666;
  margin-bottom: 30px;
  line-height: 1.6;
}

/* CF7 Form Styling */
.contact-form-wrap .wpcf7-form label {
  font-size: 15px;
  font-weight: 600;
  color: #0d1b3e;
  display: block;
  margin-bottom: 6px;
}
.contact-form-wrap .wpcf7-form input[type="text"],
.contact-form-wrap .wpcf7-form input[type="email"],
.contact-form-wrap .wpcf7-form input[type="tel"],
.contact-form-wrap .wpcf7-form select,
.contact-form-wrap .wpcf7-form textarea {
  width: 100%;
  padding: 14px 18px;
  border: 2px solid #e0ddd5;
  border-radius: 8px;
  font-size: 16px;
  font-family: inherit;
  background: #ffffff;
  transition: border-color 0.3s ease;
  margin-bottom: 20px;
  box-sizing: border-box;
}
.contact-form-wrap .wpcf7-form input:focus,
.contact-form-wrap .wpcf7-form select:focus,
.contact-form-wrap .wpcf7-form textarea:focus {
  border-color: #c9a84c;
  outline: none;
}
.contact-form-wrap .wpcf7-form textarea {
  min-height: 150px;
  resize: vertical;
}
.contact-form-wrap .wpcf7-form input[type="submit"] {
  background: #0d1b3e;
  color: #ffffff;
  padding: 16px 50px;
  border: none;
  border-radius: 8px;
  font-size: 17px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
  width: 100%;
}
.contact-form-wrap .wpcf7-form input[type="submit"]:hover {
  background: #c9a84c;
  color: #0d1b3e;
}
.contact-form-wrap .wpcf7-form .wpcf7-response-output {
  border-radius: 8px;
  padding: 15px;
  margin-top: 15px;
}

/* Info Side */
.contact-info-side {
  padding-top: 10px;
}
.contact-info-side h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  color: #0d1b3e;
  margin-bottom: 30px;
}
.info-item {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 35px;
  padding-bottom: 35px;
  border-bottom: 1px solid #e0ddd5;
}
.info-item:last-of-type {
  border-bottom: none;
}
.info-icon {
  font-size: 32px;
  flex-shrink: 0;
  width: 55px;
  height: 55px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f8f6f0;
  border-radius: 12px;
}
.info-details h4 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 6px;
}
.info-details p {
  font-size: 16px;
  color: #555;
  line-height: 1.6;
  margin: 0;
}
.info-details a {
  color: #c9a84c;
  text-decoration: none;
  font-weight: 600;
  transition: color 0.3s ease;
}
.info-details a:hover {
  color: #0d1b3e;
}

/* Promise Bar */
.contact-promise {
  padding: 60px 0;
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
}
.promise-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  text-align: center;
}
.promise-item {
  padding: 20px;
}
.promise-icon {
  font-size: 36px;
  margin-bottom: 15px;
}
.promise-item h3 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  color: #ffffff;
  margin-bottom: 8px;
}
.promise-item p {
  font-size: 14px;
  color: rgba(255,255,255,0.7);
  line-height: 1.6;
}

/* Virtual Section */
.contact-virtual {
  padding: 70px 0;
  background: #c9a84c;
  text-align: center;
}
.contact-virtual h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.contact-virtual p {
  font-size: 18px;
  color: #0d1b3e;
  max-width: 700px;
  margin: 0 auto 35px;
  opacity: 0.85;
  line-height: 1.7;
}
.contact-virtual .btn-primary {
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
.contact-virtual .btn-primary:hover {
  background: #1a2a4a;
  color: #ffffff;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 992px) {
  .contact-layout {
    grid-template-columns: 1fr;
    gap: 40px;
  }
  .quick-grid, .promise-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .contact-hero h1 { font-size: 40px; }
}

@media (max-width: 600px) {
  .contact-hero { padding: 50px 0; }
  .contact-hero h1 { font-size: 32px; }
  .contact-hero .hero-subtitle { font-size: 18px; }
  .contact-main { padding: 50px 0; }
  .contact-form-wrap { padding: 30px 20px; }
  .contact-virtual h2 { font-size: 30px; }
  .quick-grid, .promise-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- HERO SECTION -->
<section class="contact-hero">
  <div class="contact-container">
    <h1>Contact Us</h1>
    <p class="hero-subtitle">We're Here to Help</p>
    <p class="hero-desc">No need to visit our offices — we can assist you wherever you are located across Australia. Get in touch today for a free consultation.</p>
  </div>
</section>

<!-- QUICK CONTACT CARDS -->
<section class="contact-quick">
  <div class="contact-container">
    <div class="quick-grid">
      <a href="tel:+61417274441" class="quick-card">
        <div class="quick-icon">📞</div>
        <h3>Call Us</h3>
        <p>Speak directly with our team</p>
        <span class="quick-link">0417 274 441</span>
      </a>
      <a href="mailto:info@onestoplegal.com.au" class="quick-card">
        <div class="quick-icon">✉️</div>
        <h3>Email Us</h3>
        <p>We'll respond within 24 hours</p>
        <span class="quick-link">info@onestoplegal.com.au</span>
      </a>
      <a href="https://www.facebook.com/OneStopLegalau" target="_blank" class="quick-card">
        <div class="quick-icon">💬</div>
        <h3>Message Us</h3>
        <p>Connect with us on social media</p>
        <span class="quick-link">Facebook →</span>
      </a>
    </div>
  </div>
</section>

<!-- MAIN CONTACT: FORM + INFO -->
<section class="contact-main">
  <div class="contact-container">
    <div class="contact-layout">

      <!-- Form Side -->
      <div class="contact-form-wrap">
        <h2>Send Us a Message</h2>
        <p class="form-subtitle">Fill out the form below and one of our team members will get back to you promptly. All enquiries are treated with the strictest confidence.</p>
        <?php echo do_shortcode('[contact-form-7 id="26" title="Contact form 1"]'); ?>
      </div>

      <!-- Info Side -->
      <div class="contact-info-side">
        <h2>Get in Touch</h2>

        <div class="info-item">
          <div class="info-icon">📞</div>
          <div class="info-details">
            <h4>Phone</h4>
            <p><a href="tel:+61417274441">0417 274 441</a></p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">✉️</div>
          <div class="info-details">
            <h4>Email</h4>
            <p><a href="mailto:info@onestoplegal.com.au">info@onestoplegal.com.au</a></p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">🕐</div>
          <div class="info-details">
            <h4>Business Hours</h4>
            <p>Monday – Friday: 9:00am – 5:00pm<br>Saturday – Sunday: By appointment</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">🌏</div>
          <div class="info-details">
            <h4>Service Area</h4>
            <p>We service clients <strong>Australia-wide</strong> via phone, video call, and email consultations.</p>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon">🔒</div>
          <div class="info-details">
            <h4>Confidentiality</h4>
            <p>All enquiries are handled with the <strong>strictest confidence</strong> and in accordance with legal professional privilege.</p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- PROMISE BAR -->
<section class="contact-promise">
  <div class="contact-container">
    <div class="promise-grid">
      <div class="promise-item">
        <div class="promise-icon">⚡</div>
        <h3>Fast Response</h3>
        <p>We aim to respond to all enquiries within 24 hours</p>
      </div>
      <div class="promise-item">
        <div class="promise-icon">🤝</div>
        <h3>Free Consultation</h3>
        <p>Initial consultations to discuss your matter at no cost</p>
      </div>
      <div class="promise-item">
        <div class="promise-icon">💡</div>
        <h3>Expert Advice</h3>
        <p>Experienced legal professionals across multiple practice areas</p>
      </div>
      <div class="promise-item">
        <div class="promise-icon">🇦🇺</div>
        <h3>Australia Wide</h3>
        <p>Servicing clients across all states and territories</p>
      </div>
    </div>
  </div>
</section>

<!-- VIRTUAL CTA -->
<section class="contact-virtual">
  <div class="contact-container">
    <h2>No Need to Visit Our Offices</h2>
    <p>We offer virtual consultations via phone, video call, or email — making legal services accessible to you wherever you are in Australia.</p>
    <a href="tel:+61417274441" class="btn-primary">📞 Call Now — 0417 274 441</a>
  </div>
</section>

<?php get_footer(); ?>
