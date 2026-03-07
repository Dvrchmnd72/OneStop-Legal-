<?php
/**
 * Template Name: News & Facts - Custom
 *
 * Custom News & Facts (Blog) page template for OneStop Legal
 * Dynamically pulls WordPress posts with category filtering and pagination
 */

get_header();

// Handle category filter
$current_cat = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Build query args
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

if (!empty($current_cat)) {
    $args['category_name'] = $current_cat;
}

$blog_query = new WP_Query($args);

// Get categories with posts
$categories = get_categories(array(
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
));
?>

<style>
/* ============================================
   NEWS & FACTS PAGE STYLES
   ============================================ */

/* Hero Section */
.news-hero {
  background: linear-gradient(135deg, #0d1b3e 0%, #1a2a4a 100%);
  padding: 80px 0;
  text-align: center;
}
.news-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 52px;
  color: #ffffff;
  margin-bottom: 15px;
}
.news-hero .hero-subtitle {
  font-family: 'Playfair Display', serif;
  font-size: 24px;
  color: #c9a84c;
  font-style: italic;
  margin-bottom: 0;
}
.news-hero p.hero-desc {
  font-size: 18px;
  color: rgba(255,255,255,0.8);
  max-width: 700px;
  margin: 20px auto 0;
  line-height: 1.7;
}

/* Container */
.news-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Category Filter */
.news-filters {
  padding: 40px 0 10px;
  background: #ffffff;
}
.filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
  align-items: center;
}
.filter-btn {
  display: inline-block;
  padding: 10px 24px;
  border-radius: 30px;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 2px solid #e0ddd5;
  color: #555;
  background: #ffffff;
}
.filter-btn:hover {
  border-color: #c9a84c;
  color: #0d1b3e;
  background: #fdf8ed;
  text-decoration: none;
}
.filter-btn.active {
  background: #0d1b3e;
  color: #ffffff;
  border-color: #0d1b3e;
}
.filter-btn.active:hover {
  background: #1a2a4a;
  color: #ffffff;
}

/* Posts Grid */
.news-grid-section {
  padding: 40px 0 80px;
  background: #ffffff;
}
.news-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 30px;
}
.news-card {
  background: #f8f6f0;
  border-radius: 12px;
  padding: 35px 30px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  border-left: 4px solid #c9a84c;
}
.news-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 40px rgba(0,0,0,0.12);
}
.news-card-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  margin-bottom: 18px;
}
.news-card-date {
  font-size: 13px;
  color: #888;
}
.news-card-cat {
  display: inline-block;
  background: #c9a84c;
  color: #0d1b3e;
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.news-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 21px;
  color: #0d1b3e;
  margin-bottom: 14px;
  line-height: 1.4;
}
.news-card h3 a {
  color: #0d1b3e;
  text-decoration: none;
  transition: color 0.3s ease;
}
.news-card h3 a:hover {
  color: #c9a84c;
}
.news-card-excerpt {
  font-size: 15px;
  line-height: 1.7;
  color: #555;
  margin-bottom: 20px;
  flex: 1;
}
.news-read-more {
  display: inline-block;
  color: #c9a84c;
  font-weight: 600;
  font-size: 15px;
  text-decoration: none;
  transition: color 0.3s ease;
}
.news-read-more:hover {
  color: #0d1b3e;
  text-decoration: none;
}

/* Pagination */
.news-pagination {
  padding: 0 0 80px;
  background: #ffffff;
}
.pagination-bar {
  display: flex;
  justify-content: center;
  gap: 8px;
  flex-wrap: wrap;
}
.pagination-bar a,
.pagination-bar span {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 44px;
  height: 44px;
  padding: 0 14px;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 2px solid #e0ddd5;
  color: #555;
  background: #ffffff;
}
.pagination-bar a:hover {
  border-color: #c9a84c;
  color: #0d1b3e;
  background: #fdf8ed;
}
.pagination-bar .current {
  background: #0d1b3e;
  color: #ffffff;
  border-color: #0d1b3e;
}

/* No Posts */
.no-posts {
  text-align: center;
  padding: 60px 20px;
}
.no-posts h3 {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.no-posts p {
  font-size: 17px;
  color: #666;
}

/* CTA Section */
.news-cta {
  padding: 70px 0;
  background: #c9a84c;
  text-align: center;
}
.news-cta h2 {
  font-family: 'Playfair Display', serif;
  font-size: 38px;
  color: #0d1b3e;
  margin-bottom: 15px;
}
.news-cta p {
  font-size: 18px;
  color: #0d1b3e;
  margin-bottom: 35px;
  opacity: 0.85;
}
.news-cta-buttons {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}
.news-cta .btn-primary {
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
.news-cta .btn-primary:hover {
  background: #1a2a4a;
  color: #ffffff;
}
.news-cta .btn-secondary {
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
.news-cta .btn-secondary:hover {
  background: #0d1b3e;
  color: #ffffff;
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 992px) {
  .news-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .news-hero h1 { font-size: 40px; }
}

@media (max-width: 600px) {
  .news-hero { padding: 50px 0; }
  .news-hero h1 { font-size: 32px; }
  .news-hero .hero-subtitle { font-size: 18px; }
  .news-grid-section { padding: 30px 0 50px; }
  .news-cta h2 { font-size: 30px; }
  .news-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<!-- HERO SECTION -->
<section class="news-hero">
  <div class="news-container">
    <h1>News &amp; Facts</h1>
    <p class="hero-subtitle">Legal Insights &amp; Updates</p>
    <p class="hero-desc">Stay informed with the latest legal news, updates, and practical insights from the OneStop Legal team.</p>
  </div>
</section>

<!-- CATEGORY FILTERS -->
<section class="news-filters">
  <div class="news-container">
    <div class="filter-bar">
      <a href="<?php echo get_permalink(); ?>" class="filter-btn <?php echo empty($current_cat) ? 'active' : ''; ?>">All Posts</a>
      <?php foreach ($categories as $cat) : ?>
        <a href="<?php echo esc_url(add_query_arg('category', $cat->slug, get_permalink())); ?>"
           class="filter-btn <?php echo ($current_cat === $cat->slug) ? 'active' : ''; ?>">
          <?php echo esc_html($cat->name); ?> (<?php echo $cat->count; ?>)
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- POSTS GRID -->
<section class="news-grid-section">
  <div class="news-container">
    <?php if ($blog_query->have_posts()) : ?>
      <div class="news-grid">
        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
          <div class="news-card">
            <div class="news-card-meta">
              <span class="news-card-date"><?php echo get_the_date('j M Y'); ?></span>
              <?php
              $post_cats = get_the_category();
              if (!empty($post_cats)) :
                $primary_cat = $post_cats[0];
              ?>
                <span class="news-card-cat"><?php echo esc_html($primary_cat->name); ?></span>
              <?php endif; ?>
            </div>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="news-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
            <a href="<?php the_permalink(); ?>" class="news-read-more">Read More →</a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <div class="no-posts">
        <h3>No Posts Found</h3>
        <p>There are no posts in this category yet. Check back soon or browse all posts.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- PAGINATION -->
<?php if ($blog_query->max_num_pages > 1) : ?>
<section class="news-pagination">
  <div class="news-container">
    <div class="pagination-bar">
      <?php
      echo paginate_links(array(
        'total'     => $blog_query->max_num_pages,
        'current'   => $paged,
        'prev_text' => '&larr; Prev',
        'next_text' => 'Next &rarr;',
        'type'      => 'plain',
      ));
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

<!-- CTA SECTION -->
<section class="news-cta">
  <div class="news-container">
    <h2>Need Legal Advice?</h2>
    <p>Our team is ready to help with your legal matters. Get in touch today.</p>
    <div class="news-cta-buttons">
      <a href="/contact-us/" class="btn-primary">Book a Free Consultation</a>
      <a href="tel:0417274441" class="btn-secondary">📞 0417 274 441</a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
