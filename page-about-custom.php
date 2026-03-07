<?php
/**
 * Template Name: About Us - Custom
 *
 * Custom About Us template for OneStop Legal
 */

get_header();
?>

<style>
/* ============================================
   ABOUT US PAGE STYLES
   ============================================ */

/* Hero Section */
.about-hero {
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
  padding: 80px 0;
  text-align: center;
}
.about-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 52px;
  color: #ffffff;
  margin-bottom: 15px;
}
.about-hero .hero-subtitle {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  color: #c9a84c;
  font-style: italic;
  margin-bottom: 0;
}

/* Container */
.about-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Our Story Section */
.about-story {
  padding: 80px 0;
  background: #ffffff;
}
.about-story-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}
.about-story h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 25px;
}
.about-story h2 span {
  color: #c9a84c;
}
.about-story p {
  font-size: 17px;
  line-height: 1.8;
  color: #444;
  margin-bottom: 20px;
}
.about-story-image {
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
  border-radius: 12px;
  padding: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 400px;
}
.about-story-image .story-icon {
  font-size: 120px;
  opacity: 0.3;
}

/* Values Section */
.about-values {
  padding: 80px 0;
  background: #f8f6f0;
}
.about-values .section-title {
  text-align: center;
  margin-bottom: 60px;
}
.about-values .section-title h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 10px;
}
.about-values .section-title p {
  font-size: 18px;
  color: #666;
}
.values-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
.value-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 40px 30px;
  text-align: center;
  box-shadow: 0 4px 20px rgba(0,0,0,0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.value-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}
.value-icon {
  font-size: 48px;
  margin-bottom: 20px;
}
.value-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.value-card p {
  font-size: 15px;
  line-height: 1.7;
  color: #555;
}

/* Services Overview */
.about-services {
  padding: 80px 0;
  background: #ffffff;
}
.about-services .section-title {
  text-align: center;
  margin-bottom: 60px;
}
.about-services .section-title h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 10px;
}
.about-services .section-title p {
  font-size: 18px;
  color: #666;
}
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 25px;
}
.service-card {
  background: #f8f6f0;
  border-radius: 12px;
  padding: 35px 30px;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-bottom: 3px solid transparent;
}
.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  border-bottom-color: #c9a84c;
}
.service-icon {
  font-size: 40px;
  margin-bottom: 15px;
}
.service-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  color: #0d1b3e;
  margin-bottom: 12px;
}
.service-card p {
  font-size: 14px;
  line-height: 1.7;
  color: #555;
}

/* Why Choose Us */
.about-why {
  padding: 80px 0;
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
}
.about-why .section-title {
  text-align: center;
  margin-bottom: 60px;
}
.about-why .section-title h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #ffffff;
  margin-bottom: 10px;
}
.about-why .section-title p {
  font-size: 18px;
  color: #c9a84c;
}
.why-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}
.why-card {
  text-align: center;
  padding: 30px 20px;
}
.why-icon {
  font-size: 48px;
  margin-bottom: 20px;
}
.why-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  color: #ffffff;
  margin-bottom: 12px;
}
.why-card p {
  font-size: 15px;
  line-height: 1.7;
  color: rgba(255,255,255,0.75);
}

/* CTA Section */
.about-cta {
  padding: 70px 0;
  background: #c9a84c;
  text-align: center;
}
.about-cta h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.about-cta p {
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 35px;
  opacity: 0.85;
}
.about-cta-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}
.about-cta .btn-primary {
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
.about-cta .btn-primary:hover {
  background: #1a2a4a;
  color: #ffffff;
}
.about-cta .btn-secondary {
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
.about-cta .btn-secondary:hover {
  background: #0d1b3e;
  color: #ffffff;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 992px) {
  .about-story-grid {
    grid-template-columns: 1fr;
  }
  .values-grid,
  .why-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .about-hero h1 { font-size: 40px; }
}

@media (max-width: 600px) {
  .about-hero { padding: 50px 0; }
  .about-hero h1 { font-size: 32px; }
  .about-hero .hero-subtitle { font-size: 18px; }
  .about-story, .about-values, .about-services, .about-why { padding: 50px 0; }
  .about-story h2, .about-values .section-title h2,
  .about-services .section-title h2, .about-why .section-title h2,
  .about-cta h2 { font-size: 30px; }
  .values-grid, .services-grid, .why-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- HERO SECTION -->
<section class="about-hero">
  <div class="about-container">
    <h1>About OneStop Legal</h1>
    <p class="hero-subtitle">Your Trusted Partner for Comprehensive Legal Services</p>
  </div>
</section>

<!-- OUR STORY -->
<section class="about-story">
  <div class="about-container">
    <div class="about-story-grid">
      <div class="about-story-text">
        <h2>Our <span>Story</span></h2>
        <p>At OneStop Legal, we believe navigating legal matters shouldn't be overwhelming. We were founded with a clear mission — to make quality legal services accessible, transparent, and stress-free for everyday Australians.</p>
        <p>Whether you're purchasing your first home, protecting your family's future through estate planning, resolving a commercial dispute, or navigating immigration pathways, our experienced team is here to guide you every step of the way.</p>
        <p>We offer a comprehensive range of legal services under one roof, so you never have to juggle multiple firms. Based in Australia and offering virtual consultations nationwide, we bring professional legal expertise directly to you — wherever you are.</p>
      </div>
      <div class="about-story-image">
        <div class="story-icon">⚖️</div>
      </div>
    </div>
  </div>
</section>

<!-- OUR VALUES -->
<section class="about-values">
  <div class="about-container">
    <div class="section-title">
      <h2>What We Stand For</h2>
      <p>The principles that guide every matter we handle</p>
    </div>
    <div class="values-grid">
      <div class="value-card">
        <div class="value-icon">🏛️</div>
        <h3>Integrity</h3>
        <p>We uphold the highest ethical standards in every matter, ensuring honest and principled legal representation.</p>
      </div>
      <div class="value-card">
        <div class="value-icon">💡</div>
        <h3>Transparency</h3>
        <p>No hidden fees, no surprises. We believe in clear communication and upfront pricing at every step.</p>
      </div>
      <div class="value-card">
        <div class="value-icon">🤝</div>
        <h3>Client-First</h3>
        <p>Your goals are our priority. We tailor our approach to your unique circumstances and work tirelessly to achieve the best outcome.</p>
      </div>
      <div class="value-card">
        <div class="value-icon">🎯</div>
        <h3>Excellence</h3>
        <p>We are committed to delivering outstanding results and exceeding expectations in everything we do.</p>
      </div>
    </div>
  </div>
</section>

<!-- OUR SERVICES -->
<section class="about-services">
  <div class="about-container">
    <div class="section-title">
      <h2>Our Services</h2>
      <p>Comprehensive legal solutions — all under one roof</p>
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-icon">🏠</div>
        <h3>Conveyancing</h3>
        <p>Expert handling of all property transactions — buying, selling, or leasing — for a smooth, stress-free process.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">📜</div>
        <h3>Wills &amp; Estate Planning</h3>
        <p>Protect your loved ones with professionally drafted wills, trusts, and comprehensive estate plans.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🏢</div>
        <h3>Commercial &amp; Corporate Law</h3>
        <p>From business formation to contract negotiation, helping businesses of all sizes navigate legal challenges.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">📋</div>
        <h3>Contract Reviews</h3>
        <p>Thorough examination of agreements to identify risks and ensure compliance with relevant laws.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">✈️</div>
        <h3>Immigration</h3>
        <p>Expert guidance through visa applications, residency, and citizenship pathways.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">⚖️</div>
        <h3>Litigation</h3>
        <p>Skilled advocacy for civil, commercial, and employment disputes to protect your rights.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">💰</div>
        <h3>Compensation</h3>
        <p>Fighting for fair compensation if you've been injured due to someone else's negligence.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">💍</div>
        <h3>Binding Financial Agreements</h3>
        <p>Protecting your assets and financial interests with professionally drafted agreements.</p>
      </div>
      <div class="service-card">
        <div class="service-icon">🔑</div>
        <h3>Property Settlement Agent</h3>
        <p>Comprehensive settlement solutions for solicitors to streamline property transactions.</p>
      </div>
    </div>
  </div>
</section>

<!-- WHY CHOOSE US -->
<section class="about-why">
  <div class="about-container">
    <div class="section-title">
      <h2>Why Choose OneStop Legal?</h2>
      <p>What sets us apart</p>
    </div>
    <div class="why-grid">
      <div class="why-card">
        <div class="why-icon">🌏</div>
        <h3>Australia Wide Service</h3>
        <p>No matter where you are in Australia, we're here to help with your legal needs.</p>
      </div>
      <div class="why-card">
        <div class="why-icon">💻</div>
        <h3>Virtual Consultations</h3>
        <p>Meet with our team from the comfort of your home via secure video consultations.</p>
      </div>
      <div class="why-card">
        <div class="why-icon">💲</div>
        <h3>Transparent Pricing</h3>
        <p>Clear, upfront pricing with no hidden fees. Know exactly what to expect from the start.</p>
      </div>
      <div class="why-card">
        <div class="why-icon">👨‍⚖️</div>
        <h3>Experienced Team</h3>
        <p>Seasoned legal professionals with diverse backgrounds and expertise across multiple practice areas.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="about-cta">
  <div class="about-container">
    <h2>Ready to Get Started?</h2>
    <p>Book a free consultation today and let us handle the legal details.</p>
    <div class="about-cta-buttons">
      <a href="/contact-us/" class="btn-primary">Book a Free Consultation</a>
      <a href="tel:0417274441" class="btn-secondary">📞 0417 274 441</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
