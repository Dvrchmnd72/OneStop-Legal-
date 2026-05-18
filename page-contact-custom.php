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
  font-family: 'League Spartan', sans-serif;
  font-size: 52px;
  color: #ffffff;
  margin-bottom: 15px;
  font-weight: 700;
}
.contact-hero .hero-subtitle {
  font-family: 'League Spartan', sans-serif;
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
  font-family: 'League Spartan', sans-serif;
  font-size: 22px;
  color: #0d1b3e;
  margin-bottom: 10px;
  font-weight: 700;
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
  font-family: 'League Spartan', sans-serif;
  font-size: 32px;
  color: #0d1b3e;
  margin-bottom: 10px;
  font-weight: 700;
}
.contact-form-wrap .form-subtitle {
  font-size: 16px;
  color: #666;
  margin-bottom: 30px;
  line-height: 1.6;
}

/* Our Custom Form */
.osl-form-group {
  margin-bottom: 20px;
}
.osl-form-group label {
  font-size: 15px;
  font-weight: 600;
  color: #0d1b3e;
  display: block;
  margin-bottom: 6px;
}
.osl-form-group label .required {
  color: #c9a84c;
  margin-left: 2px;
}
.osl-form-group input[type="text"],
.osl-form-group input[type="email"],
.osl-form-group input[type="tel"],
.osl-form-group select,
.osl-form-group textarea {
  width: 100%;
  padding: 14px 18px;
  border: 2px solid #e0ddd5;
  border-radius: 8px;
  font-size: 16px;
  font-family: 'League Spartan', sans-serif;
  background: #ffffff;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  box-sizing: border-box;
  -webkit-appearance: none;
}
.osl-form-group input:focus,
.osl-form-group select:focus,
.osl-form-group textarea:focus {
  border-color: #c9a84c;
  outline: none;
  box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
}
.osl-form-group textarea {
  min-height: 150px;
  resize: vertical;
}
.osl-form-group select {
  cursor: pointer;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23666' stroke-width='2' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 16px center;
  padding-right: 40px;
}
.osl-form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.osl-form-submit {
  background: #0d1b3e;
  color: #ffffff;
  padding: 16px 50px;
  border: none;
  border-radius: 8px;
  font-size: 17px;
  font-weight: 600;
  font-family: 'League Spartan', sans-serif;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s ease;
  width: 100%;
  margin-top: 10px;
}
.osl-form-submit:hover {
  background: #c9a84c;
  color: #0d1b3e;
  transform: translateY(-2px);
}
.osl-form-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

/* Honeypot */
.osl-hp { position: absolute; left: -9999px; }

/* Messages */
.osl-form-message {
  padding: 16px 20px;
  border-radius: 8px;
  margin-top: 20px;
  font-size: 15px;
  font-weight: 500;
  display: none;
}
.osl-form-message.success {
  background: #e8f5e9;
  color: #2e7d32;
  border: 1px solid #a5d6a7;
  display: block;
}
.osl-form-message.error {
  background: #fce4ec;
  color: #c62828;
  border: 1px solid #ef9a9a;
  display: block;
}

/* Info Side */
.contact-info-side {
  padding-top: 10px;
}
.contact-info-side h2 {
  font-family: 'League Spartan', sans-serif;
  font-size: 32px;
  color: #0d1b3e;
  margin-bottom: 30px;
  font-weight: 700;
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
  font-family: 'League Spartan', sans-serif;
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 6px;
  font-weight: 700;
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
  font-family: 'League Spartan', sans-serif;
  font-size: 18px;
  color: #ffffff;
  margin-bottom: 8px;
  font-weight: 700;
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
  font-family: 'League Spartan', sans-serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 15px;
  font-weight: 700;
}
.contact-virtual p {
  font-size: 18px;
  color: #0d1b3e;
  max-width: 700px;
  margin: 0 auto 35px;
  opacity: 0.85;
  line-height: 1.7;
}
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
  .osl-form-row {
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
        <div class="quick-icon"><svg viewBox="0 0 24 24" width="20" height="20" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></div>
        <h3>Call Us</h3>
        <p>Speak directly with our team</p>
        <span class="quick-link">+61 7 3156 1216</span>
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
        
        <form id="osl-contact-form" method="post">
          <?php wp_nonce_field('osl_contact_form', 'osl_contact_nonce'); ?>
          
          <!-- Honeypot (hidden spam trap) -->
          <div class="osl-hp">
            <input type="text" name="website_url" tabindex="-1" autocomplete="off">
          </div>
          
          <div class="osl-form-row">
            <div class="osl-form-group">
              <label for="osl_name">Full Name <span class="required">*</span></label>
              <input type="text" id="osl_name" name="osl_name" placeholder="Your full name" required>
            </div>
            <div class="osl-form-group">
              <label for="osl_email">Email Address <span class="required">*</span></label>
              <input type="email" id="osl_email" name="osl_email" placeholder="your@email.com" required>
            </div>
          </div>
          
          <div class="osl-form-row">
            <div class="osl-form-group">
              <label for="osl_phone">Phone Number</label>
              <input type="tel" id="osl_phone" name="osl_phone" placeholder="04XX XXX XXX">
            </div>
            <div class="osl-form-group">
              <label for="osl_service">Service Needed</label>
              <select id="osl_service" name="osl_service">
                <option value="">— Select a service —</option>
                <option value="Conveyancing">Conveyancing</option>
                <option value="Contract Reviews">Contract Reviews</option>
                <option value="Commercial Law">Commercial & Corporate Law</option>
                <option value="Compensation">Compensation</option>
                <option value="Wills & Estate Planning">Wills & Estate Planning</option>
                <option value="Binding Financial Agreements">Binding Financial Agreements</option>
                <option value="Litigation">Litigation</option>
                <option value="Immigration">Immigration</option>
                <option value="Property Settlement Agent">Property Settlement Agent</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>
          
          <div class="osl-form-group">
            <label for="osl_message">Your Message <span class="required">*</span></label>
            <textarea id="osl_message" name="osl_message" placeholder="Tell us about your legal matter..." required></textarea>
          </div>
          
          <button type="submit" class="osl-form-submit" id="osl-submit-btn">Send Enquiry</button>
          
          <div id="osl-form-response" class="osl-form-message"></div>
        </form>
      </div>

      <!-- Info Side -->
      <div class="contact-info-side">
        <h2>Get in Touch</h2>

        <div class="info-item">
          <div class="info-icon"><svg viewBox="0 0 24 24" width="20" height="20" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></div>
          <div class="info-details">
            <h4>Phone</h4>
            <p><a href="tel:+61417274441">+61 7 3156 1216</a></p>
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
    <a href="tel:+61731561216" class="btn-primary btn-phone"><span class="btn-icon" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true"><path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1v3.5a1 1 0 0 1-1 1C10.07 21.81 2.19 13.93 2.19 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.57 3.58a1 1 0 0 1-.24 1.01l-2.4 2.2z" fill="currentColor"/></svg></span><span class="btn-text">Call Now — +61 7 3156 1216</span></a>
  </div>
</section>

<!-- FORM SUBMISSION SCRIPT -->
<script>
document.getElementById('osl-contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var btn = document.getElementById('osl-submit-btn');
    var response = document.getElementById('osl-form-response');
    var form = this;
    
    // Disable button
    btn.disabled = true;
    btn.textContent = 'Sending...';
    response.className = 'osl-form-message';
    response.style.display = 'none';
    
    // Build form data
    var formData = new FormData(form);
    formData.append('action', 'osl_contact_form');
    
    // Send AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
    xhr.onload = function() {
        btn.disabled = false;
        btn.textContent = 'Send Enquiry';
        
        try {
            var result = JSON.parse(xhr.responseText);
            if (result.success) {
                response.className = 'osl-form-message success';
                response.textContent = result.data;
                response.style.display = 'block';
                form.reset();
                // Scroll to message
                response.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                response.className = 'osl-form-message error';
                response.textContent = result.data || 'Something went wrong. Please try again.';
                response.style.display = 'block';
            }
        } catch(err) {
            response.className = 'osl-form-message error';
            response.textContent = 'Something went wrong. Please call us on +61 7 3156 1216.';
            response.style.display = 'block';
        }
    };
    xhr.onerror = function() {
        btn.disabled = false;
        btn.textContent = 'Send Enquiry';
        response.className = 'osl-form-message error';
        response.textContent = 'Connection error. Please call us on +61 7 3156 1216.';
        response.style.display = 'block';
    };
    xhr.send(formData);
});
</script>

<?php get_footer(); ?>
