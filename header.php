<?php
/**
 * Custom Header for OneStop Legal
 * Child theme override - clean modern header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="osl-header">
  <div class="osl-header-inner">
    <div class="osl-header-logo">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2024/02/Color-logo-no-background.png" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="osl-logo-img">
      </a>
    </div>

    <nav class="osl-header-nav">
      <?php wp_nav_menu( array(
        'theme_location' => 'header',
        'menu_id'        => 'osl-main-menu',
        'container'      => false,
        'fallback_cb'    => false,
      ) ); ?>
    </nav>

    <button class="osl-mobile-toggle" aria-label="Toggle menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>

<div class="osl-mobile-nav">
  <div class="osl-mobile-nav-close">&times;</div>
  <?php wp_nav_menu( array(
    'theme_location' => 'header',
    'menu_id'        => 'osl-mobile-menu',
    'container'      => false,
    'fallback_cb'    => false,
  ) ); ?>
</div>
<div class="osl-mobile-overlay"></div>
