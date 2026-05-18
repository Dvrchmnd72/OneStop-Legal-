<?php
/**
 * Template Name: Suburb Landing Page (Regional)
 * Description: Regional suburb page — back link points to council hub, schema by plugin
 */

get_header();

$hub_id    = wp_get_post_parent_id(get_the_ID());
$hub_url   = $hub_id ? get_permalink($hub_id) : '/conveyancing/';
$hub_title = $hub_id ? get_the_title($hub_id) : 'Conveyancing';
$back_label = preg_replace('/\s*\|.*$/', '', $hub_title);
?>
<style>
.suburb-page { max-width: 900px; margin: 0 auto; padding: 40px 20px 60px; }
.suburb-page h1 { color: #1B2E4A; font-size: 32px; margin-bottom: 10px; }
.suburb-page h2 { color: #1B2E4A; font-size: 24px; margin-top: 40px; margin-bottom: 15px; }
.suburb-page h3 { color: #1B2E4A; font-size: 20px; margin-top: 30px; margin-bottom: 10px; }
.suburb-page p { color: #444; font-size: 16px; line-height: 1.7; margin-bottom: 15px; }
.suburb-page ul, .suburb-page ol { color: #444; font-size: 16px; line-height: 1.8; margin-bottom: 15px; padding-left: 25px; }
.suburb-page strong { color: #1B2E4A; }
.suburb-back { max-width: 900px; margin: 0 auto; padding: 20px 20px 0; }
.suburb-back a { color: #C8A961; text-decoration: none; font-size: 14px; }
.suburb-back a:hover { text-decoration: underline; }
</style>

<div class="suburb-back">
  <a href="<?php echo esc_url($hub_url); ?>">&larr; Back to <?php echo esc_html($back_label); ?></a>
</div>

<div class="suburb-page">
  <?php while ( have_posts() ) : the_post(); ?>
  <?php the_content(); ?>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
