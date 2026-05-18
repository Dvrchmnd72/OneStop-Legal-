<?php
/**
 * Blog listing page template
 */
get_header(); ?>

<style>
.osl-blog-hero { background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%); padding: 60px 0; text-align: center; }
.osl-blog-hero h1 { font-family: "Playfair Display", serif; font-size: 42px; color: #fff; margin-bottom: 10px; }
.osl-blog-hero p { font-size: 18px; color: #C8A961; font-style: italic; }
.osl-blog-container { max-width: 1200px; margin: 0 auto; padding: 50px 20px 80px; }
.osl-blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.osl-blog-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: transform 0.3s, box-shadow 0.3s; border-bottom: 3px solid transparent; }
.osl-blog-card:hover { transform: translateY(-5px); box-shadow: 0 8px 30px rgba(0,0,0,0.12); border-bottom-color: #C8A961; }
.osl-blog-card-image { width: 100%; height: 220px; object-fit: cover; display: block; }
.osl-blog-card-image-placeholder { display: none !important; }
.osl-blog-card-body { padding: 25px; }
.osl-blog-card-meta { display: flex; gap: 15px; align-items: center; margin-bottom: 12px; font-size: 13px; color: #888; }
.osl-blog-card-meta .category { background: #f4f1ec; color: #C8A961; padding: 3px 10px; border-radius: 4px; font-weight: 600; font-size: 11px; text-transform: uppercase; text-decoration: none; }
.osl-blog-card-meta .category:hover { background: #C8A961; color: #fff; }
.osl-blog-card-title { font-family: "Playfair Display", serif; font-size: 20px; color: #0d1b3e; margin-bottom: 12px; line-height: 1.4; }
.osl-blog-card-title a { color: #0d1b3e; text-decoration: none; }
.osl-blog-card-title a:hover { color: #C8A961; }
.osl-blog-card-excerpt { font-size: 14px; line-height: 1.7; color: #666; margin-bottom: 18px; }
.osl-blog-card-readmore { display: inline-flex; align-items: center; gap: 6px; color: #C8A961; text-decoration: none; font-weight: 600; font-size: 14px; transition: gap 0.3s; }
.osl-blog-card-readmore:hover { gap: 10px; color: #a6842e; }
.osl-blog-pagination { text-align: center; margin-top: 50px; }
.osl-blog-pagination .nav-links { display: flex; gap: 10px; justify-content: center; }
.osl-blog-pagination .nav-links a, .osl-blog-pagination .nav-links span { padding: 10px 18px; border-radius: 8px; font-size: 15px; text-decoration: none; }
.osl-blog-pagination .nav-links a { background: #f4f1ec; color: #0d1b3e; transition: background 0.3s; }
.osl-blog-pagination .nav-links a:hover { background: #C8A961; color: #fff; }
.osl-blog-pagination .nav-links .current { background: #0d1b3e; color: #fff; }
@media (max-width: 992px) { .osl-blog-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 600px) { .osl-blog-grid { grid-template-columns: 1fr; } .osl-blog-hero h1 { font-size: 32px; } }
</style>

<section class="osl-blog-hero">
  <div>
    <h1>News & Facts</h1>
    <p>Legal insights, property news & expert advice</p>
  </div>
</section>

<div class="osl-blog-container">
  <div class="osl-blog-grid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="osl-blog-card">
        <?php if (has_post_thumbnail()) : ?>
          <a href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title_attribute(); ?>" class="osl-blog-card-image" />
          </a>
        <?php else : ?>
          <a href="<?php the_permalink(); ?>">
            <div class="osl-blog-card-image-placeholder">&#x2696;</div>
          </a>
        <?php endif; ?>
        <div class="osl-blog-card-body">
          <div class="osl-blog-card-meta">
            <?php
            $cats = get_the_category();
            if ($cats) {
                echo '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '" class="category">' . esc_html($cats[0]->name) . '</a>';
            }
            ?>
            <span><?php echo get_the_date('M j, Y'); ?></span>
          </div>
          <h3 class="osl-blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p class="osl-blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
          <a href="<?php the_permalink(); ?>" class="osl-blog-card-readmore">Read More &rarr;</a>
        </div>
      </div>
    <?php endwhile; endif; ?>
  </div>

  <div class="osl-blog-pagination">
    <?php the_posts_pagination(array(
      'prev_text' => '&larr; Previous',
      'next_text' => 'Next &rarr;',
    )); ?>
  </div>
</div>

<?php get_footer(); ?>
