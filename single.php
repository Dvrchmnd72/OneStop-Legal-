<?php
/**
 * Single blog post template
 */
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<style>
.osl-post-hero { background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%); padding: 60px 0; text-align: center; }
.osl-post-hero-inner { max-width: 800px; margin: 0 auto; padding: 0 20px; }
.osl-post-hero .category-badge { display: inline-block; background: rgba(200,169,97,0.2); color: #C8A961; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; text-decoration: none; }
.osl-post-hero .category-badge:hover { background: #C8A961; color: #0d1b3e; }
.osl-post-hero h1 { font-family: "Playfair Display", serif; font-size: 38px; color: #fff; margin-bottom: 20px; line-height: 1.3; }
.osl-post-hero-meta { display: flex; gap: 20px; justify-content: center; align-items: center; flex-wrap: wrap; color: rgba(255,255,255,0.7); font-size: 14px; }
.osl-post-hero-meta img { border-radius: 50%; width: 36px; height: 36px; }
.osl-post-hero-meta a { color: #C8A961; text-decoration: none; }

.osl-post-featured { max-width: 900px; margin: -30px auto 0; padding: 0 20px; position: relative; z-index: 2; }
.osl-post-featured img { width: 100%; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.15); }

.osl-post-container { max-width: 800px; margin: 0 auto; padding: 40px 20px 60px; }
.osl-post-content { font-size: 17px; line-height: 1.8; color: #444; }
.osl-post-content h2 { font-family: "Playfair Display", serif; font-size: 28px; color: #0d1b3e; margin: 40px 0 15px; }
.osl-post-content h3 { font-family: "Playfair Display", serif; font-size: 22px; color: #0d1b3e; margin: 35px 0 12px; }
.osl-post-content h4 { font-family: "Playfair Display", serif; font-size: 20px; color: #0d1b3e; margin: 30px 0 10px; }
.osl-post-content p { margin-bottom: 18px; }
.osl-post-content a { color: #C8A961; text-decoration: underline; }
.osl-post-content a:hover { color: #a6842e; }
.osl-post-content ul, .osl-post-content ol { margin-bottom: 18px; padding-left: 25px; }
.osl-post-content li { margin-bottom: 8px; }
.osl-post-content blockquote { border-left: 4px solid #C8A961; margin: 30px 0; padding: 20px 25px; background: #f8f6f0; border-radius: 0 8px 8px 0; font-style: italic; color: #555; }
.osl-post-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 20px 0; }
.osl-post-content strong { color: #1B2E4A; }

.osl-post-tags { margin-top: 40px; padding-top: 25px; border-top: 1px solid #eee; }
.osl-post-tags span { font-weight: 600; color: #0d1b3e; margin-right: 10px; }
.osl-post-tags a { display: inline-block; background: #f4f1ec; color: #666; padding: 5px 12px; border-radius: 4px; font-size: 13px; text-decoration: none; margin: 3px 5px 3px 0; transition: background 0.3s; }
.osl-post-tags a:hover { background: #C8A961; color: #fff; }

.osl-post-nav { display: flex; justify-content: space-between; gap: 20px; margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee; }
.osl-post-nav a { color: #0d1b3e; text-decoration: none; font-size: 15px; max-width: 45%; }
.osl-post-nav a:hover { color: #C8A961; }
.osl-post-nav .nav-label { font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 5px; }

.osl-related { background: #f8f6f0; padding: 60px 0; }
.osl-related-inner { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.osl-related h2 { font-family: "Playfair Display", serif; font-size: 30px; color: #0d1b3e; text-align: center; margin-bottom: 40px; }
.osl-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.osl-related-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); transition: transform 0.3s, box-shadow 0.3s; }
.osl-related-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
.osl-related-card img { width: 100%; height: 180px; object-fit: cover; }
.osl-related-card-body { padding: 20px; }
.osl-related-card-body h4 { font-family: "Playfair Display", serif; font-size: 17px; color: #0d1b3e; margin-bottom: 8px; line-height: 1.4; }
.osl-related-card-body h4 a { color: #0d1b3e; text-decoration: none; }
.osl-related-card-body h4 a:hover { color: #C8A961; }
.osl-related-card-body .date { font-size: 12px; color: #888; }

.osl-post-cta { background: #C8A961; padding: 50px 0; text-align: center; }
.osl-post-cta h2 { font-family: "Playfair Display", serif; font-size: 32px; color: #0d1b3e; margin-bottom: 15px; }
.osl-post-cta p { font-size: 17px; color: #0d1b3e; margin-bottom: 25px; opacity: 0.85; }
.osl-post-cta a { display: inline-block; background: #0d1b3e; color: #fff; padding: 14px 35px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 16px; transition: background 0.3s; }
.osl-post-cta a:hover { background: #1a2a4a; color: #fff; }

@media (max-width: 768px) {
  .osl-post-hero h1 { font-size: 28px; }
  .osl-related-grid { grid-template-columns: 1fr; }
  .osl-post-nav { flex-direction: column; }
  .osl-post-nav a { max-width: 100%; }
}
</style>

<!-- HERO -->
<section class="osl-post-hero">
  <div class="osl-post-hero-inner">
    <?php
    $cats = get_the_category();
    if ($cats) {
        echo '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '" class="category-badge">' . esc_html($cats[0]->name) . '</a>';
    }
    ?>
    <h1><?php the_title(); ?></h1>
    <div class="osl-post-hero-meta">
      <?php echo get_avatar(get_the_author_meta('ID'), 36); ?>
      <span>By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('display_name'); ?></a></span>
      <span><?php echo get_the_date('F j, Y'); ?></span>
    </div>
  </div>
</section>

<!-- FEATURED IMAGE -->
<?php if (has_post_thumbnail()) : ?>
<div class="osl-post-featured">
  <?php the_post_thumbnail('full'); ?>
</div>
<?php endif; ?>

<!-- CONTENT -->
<div class="osl-post-container">
  <div class="osl-post-content">
    <?php the_content(); ?>
  </div>

  <?php if (get_the_tags()) : ?>
  <div class="osl-post-tags">
    <span>Tags:</span>
    <?php
    $tags = get_the_tags();
    foreach ($tags as $tag) {
        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
    }
    ?>
  </div>
  <?php endif; ?>

  <div class="osl-post-nav">
    <?php
    $prev = get_previous_post();
    $next = get_next_post();
    if ($prev) {
        echo '<a href="' . get_permalink($prev) . '"><span class="nav-label">&larr; Previous</span>' . esc_html($prev->post_title) . '</a>';
    } else {
        echo '<span></span>';
    }
    if ($next) {
        echo '<a href="' . get_permalink($next) . '" style="text-align:right;"><span class="nav-label">Next &rarr;</span>' . esc_html($next->post_title) . '</a>';
    }
    ?>
  </div>
</div>

<?php endwhile; endif; ?>

<!-- RELATED POSTS -->
<?php
$related = new WP_Query(array(
    'post__not_in' => array(get_the_ID()),
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
));
if ($related->have_posts()) : ?>
<section class="osl-related">
  <div class="osl-related-inner">
    <h2>Latest Posts</h2>
    <div class="osl-related-grid">
      <?php while ($related->have_posts()) : $related->the_post(); ?>
        <div class="osl-related-card">
          <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" /></a>
          <?php endif; ?>
          <div class="osl-related-card-body">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <span class="date"><?php echo get_the_date('M j, Y'); ?></span>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; wp_reset_postdata(); ?>

<!-- CTA -->
<section class="osl-post-cta">
  <h2>Need Legal Help?</h2>
  <p>Get in touch with our experienced team for expert advice on your matter.</p>
  <a href="/book/">Book a Consultation</a>
</section>

<?php get_footer(); ?>
