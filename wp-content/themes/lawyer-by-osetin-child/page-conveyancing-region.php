<?php
/**
 * Template Name: Conveyancing Region Hub
 * Description: Regional hub page for non-Gold-Coast councils — schema/meta handled by plugin
 */

get_header();

$region_name  = get_post_meta(get_the_ID(), '_osl_region_name', true) ?: 'Queensland';
$region_phone = '+61 7 3156 1216';
?>
<style>
.rc-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);padding:90px 0;text-align:center;position:relative}
.rc-hero::before{content:'';position:absolute;top:0;right:0;width:50%;height:100%;background:linear-gradient(135deg,transparent 0%,rgba(166,132,46,0.08) 100%);pointer-events:none}
.rc-hero h1{font-family:'League Spartan',sans-serif;font-size:52px;font-weight:800;color:#fff;margin-bottom:15px;line-height:1.15}
.rc-hero h1 span{color:#a6842e}
.rc-hero .hero-subtitle{font-family:'League Spartan',sans-serif;font-size:20px;color:rgba(255,255,255,0.85);max-width:700px;margin:0 auto 35px;line-height:1.7}
.rc-hero .hero-buttons{display:flex;justify-content:center;gap:16px;flex-wrap:wrap}
.rc-hero .hero-cta{display:inline-flex;align-items:center;gap:10px;background:#a6842e;color:#0d1b3e;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.rc-hero .hero-cta:hover{background:#c49a30;transform:translateY(-2px);color:#0d1b3e;text-decoration:none}
.rc-hero .hero-cta-secondary{display:inline-flex;align-items:center;gap:10px;background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s}
.rc-hero .hero-cta-secondary:hover{border-color:#fff;background:rgba(255,255,255,.1);color:#fff;text-decoration:none}
.rc-container{max-width:1200px;margin:0 auto;padding:0 20px}
.rc-trust{background:#a6842e;padding:18px 0}
.rc-trust-items{display:flex;justify-content:center;gap:40px;flex-wrap:wrap;max-width:1200px;margin:0 auto;padding:0 20px}
.rc-trust-item{display:flex;align-items:center;gap:8px;font-family:'League Spartan',sans-serif;font-size:15px;font-weight:600;color:#0d1b3e}
.rc-why{padding:70px 0;background:#fff}
.rc-why .section-title{text-align:center;margin-bottom:45px}
.rc-why .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.rc-why .section-title p{font-size:17px;color:#666}
.rc-why-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.rc-why-card{text-align:center;padding:35px 25px;background:#f8f6f0;border-radius:12px;transition:transform .3s}
.rc-why-card:hover{transform:translateY(-4px)}
.rc-why-icon{font-size:40px;margin-bottom:16px}
.rc-why-card h3{font-family:'League Spartan',sans-serif;font-size:19px;font-weight:700;color:#0d1b3e;margin-bottom:10px}
.rc-why-card p{font-size:15px;line-height:1.7;color:#555}
.rc-suburbs{padding:70px 0;background:#f8f6f0}
.rc-suburbs .section-title{text-align:center;margin-bottom:40px}
.rc-suburbs .section-title h2{font-family:'League Spartan',sans-serif;font-size:34px;font-weight:800;color:#0d1b3e;margin-bottom:10px}
.rc-suburbs .section-title p{font-size:17px;color:#666;max-width:650px;margin:0 auto}
.rc-suburbs-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;max-width:1000px;margin:0 auto}
.rc-suburb-link{display:block;padding:12px 18px;background:#fff;border-radius:8px;text-decoration:none;color:#0d1b3e;font-family:'League Spartan',sans-serif;font-size:14px;font-weight:600;text-align:center;transition:all .3s;border:1px solid #e0ddd5}
.rc-suburb-link:hover{background:#a6842e;color:#0d1b3e;border-color:#a6842e;text-decoration:none;transform:translateY(-2px)}
.rc-content{padding:60px 0;background:#fff}
.rc-content h2{font-family:'League Spartan',sans-serif;font-size:28px;font-weight:800;color:#0d1b3e;margin-bottom:15px;margin-top:40px}
.rc-content h2:first-child{margin-top:0}
.rc-content p{font-size:16px;line-height:1.8;color:#444;margin-bottom:15px}
.rc-cta{padding:70px 0;background:linear-gradient(135deg,#0d1b3e 0%,#1a2a4a 100%);text-align:center}
.rc-cta h2{font-family:'League Spartan',sans-serif;font-size:36px;font-weight:800;color:#fff;margin-bottom:15px}
.rc-cta p{font-size:18px;color:rgba(255,255,255,.85);margin-bottom:35px;max-width:600px;margin-left:auto;margin-right:auto}
.rc-cta-buttons{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}
.rc-cta .btn-gold{background:#a6842e;color:#0d1b3e;padding:18px 44px;border-radius:8px;text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s;display:inline-flex;align-items:center;gap:10px}
.rc-cta .btn-gold:hover{background:#c49a30;color:#0d1b3e;text-decoration:none;transform:translateY(-2px)}
.rc-cta .btn-outline{background:transparent;color:#fff;padding:18px 44px;border-radius:8px;border:2px solid rgba(255,255,255,.4);text-decoration:none;font-size:18px;font-weight:700;font-family:'League Spartan',sans-serif;transition:all .3s;display:inline-flex;align-items:center;gap:10px}
.rc-cta .btn-outline:hover{border-color:#fff;background:rgba(255,255,255,.1);color:#fff;text-decoration:none}
@media(max-width:992px){.rc-hero h1{font-size:40px}.rc-why-grid{grid-template-columns:1fr 1fr}.rc-suburbs-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:600px){.rc-hero{padding:55px 0}.rc-hero h1{font-size:30px}.rc-hero .hero-buttons{flex-direction:column;align-items:center}.rc-hero .hero-cta,.rc-hero .hero-cta-secondary{width:100%;max-width:320px;justify-content:center}.rc-trust-items{gap:12px}.rc-trust-item{font-size:13px}.rc-why,.rc-suburbs{padding:50px 0}.rc-why .section-title h2,.rc-suburbs .section-title h2,.rc-cta h2{font-size:26px}.rc-why-grid{grid-template-columns:1fr}.rc-suburbs-grid{grid-template-columns:repeat(2,1fr)}.rc-suburb-link{font-size:13px;padding:10px 12px}.rc-cta-buttons{flex-direction:column;align-items:center}.rc-cta .btn-gold,.rc-cta .btn-outline{width:100%;max-width:320px;justify-content:center}}
</style>

<section class="rc-hero">
  <div class="rc-container">
    <h1><?php echo esc_html($region_name); ?> <span>Conveyancing</span></h1>
    <p class="hero-subtitle">Fixed-fee conveyancing for buying and selling property across all <?php echo esc_html($region_name); ?> suburbs. Get an instant quote in 30 seconds.</p>
    <div class="hero-buttons">
      <a href="/conveyancing-quote/" class="hero-cta">Get an Instant Quote &rarr;</a>
      <a href="tel:<?php echo preg_replace('/\s+/','',$region_phone); ?>" class="hero-cta-secondary">&#128222; <?php echo esc_html($region_phone); ?></a>
    </div>
  </div>
</section>

<section class="rc-trust">
  <div class="rc-trust-items">
    <div class="rc-trust-item">&#10003; Fixed Fee &mdash; No Surprises</div>
    <div class="rc-trust-item">&#10003; PEXA Certified</div>
    <div class="rc-trust-item">&#10003; Queensland Based</div>
    <div class="rc-trust-item">&#10003; Free Consultation</div>
  </div>
</section>

<section class="rc-why">
  <div class="rc-container">
    <div class="section-title">
      <h2>Why <?php echo esc_html($region_name); ?> Property Owners Choose Us</h2>
      <p>Expert conveyancing backed by a full-service Queensland law firm</p>
    </div>
    <div class="rc-why-grid">
      <div class="rc-why-card">
        <div class="rc-why-icon">&#128178;</div>
        <h3>Fixed Fee Pricing</h3>
        <p>Know exactly what you'll pay upfront. No hidden costs, no hourly billing — just a clear fixed fee for your <?php echo esc_html($region_name); ?> property transaction.</p>
      </div>
      <div class="rc-why-card">
        <div class="rc-why-icon">&#128104;&#8205;&#9878;&#65039;</div>
        <h3>Qualified Solicitors</h3>
        <p>Your matter is handled by a Queensland solicitor — not just a conveyancer — so you get real legal advice when it matters.</p>
      </div>
      <div class="rc-why-card">
        <div class="rc-why-icon">&#9889;</div>
        <h3>Fully Electronic</h3>
        <p>Everything is managed digitally via PEXA. Whether you are local to <?php echo esc_html($region_name); ?> or interstate, we handle your settlement seamlessly.</p>
      </div>
    </div>
  </div>
</section>

<section class="rc-suburbs">
  <div class="rc-container">
    <div class="section-title">
      <h2>Servicing All <?php echo esc_html($region_name); ?> Suburbs</h2>
      <p>Click your suburb for local conveyancing information and your instant fixed-fee quote.</p>
    </div>
    <div class="rc-suburbs-grid">
      <?php
      $hub_id = get_the_ID();
      $suburb_pages = get_posts(array(
          'post_type'      => 'page',
          'post_parent'    => $hub_id,
          'posts_per_page' => -1,
          'post_status'    => 'publish',
          'orderby'        => 'title',
          'order'          => 'ASC',
      ));
      foreach ($suburb_pages as $sp) {
          $stitle = get_the_title($sp->ID);
          $surl   = get_permalink($sp->ID);
          $label  = preg_replace('/^Conveyancer in /i', '', $stitle);
          $label  = preg_replace('/\s*\|.*$/', '', $label);
          echo '<a href="' . esc_url($surl) . '" class="rc-suburb-link">' . esc_html($label) . '</a>' . "\n";
      }
      ?>
    </div>
  </div>
</section>

<section class="rc-content">
  <div class="rc-container" style="max-width:900px">
    <?php
    while (have_posts()) :
        the_post();
        $region_content = apply_filters('the_content', get_the_content());
        $region_content = preg_replace('/<h1(\s[^>]*)?>/i', '<h2$1>', $region_content);
        $region_content = preg_replace('/<\/h1>/i', '</h2>', $region_content);
        echo $region_content;
    endwhile;
    ?>
  </div>
</section>

<section class="rc-cta">
  <div class="rc-container">
    <h2>Get Your <?php echo esc_html($region_name); ?> Conveyancing Quote</h2>
    <p>Use our instant quote calculator to see your fixed-fee conveyancing costs &mdash; takes 30 seconds.</p>
    <div class="rc-cta-buttons">
      <a href="/conveyancing-quote/" class="btn-gold">Get an Instant Quote &rarr;</a>
      <a href="tel:<?php echo preg_replace('/\s+/','',$region_phone); ?>" class="btn-outline">&#128222; Call <?php echo esc_html($region_phone); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
