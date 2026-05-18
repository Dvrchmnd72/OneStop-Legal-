<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="el-header">
    <div class="el-header__inner">
      <div class="el-header__logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <img src="/wp-content/uploads/2024/02/Color-logo-no-background.png" alt="OneStop Legal" style="height:48px;width:auto;">
        </a>
      </div>
      <nav class="el-nav" id="osl-nav" aria-label="Primary navigation">
        <?php wp_nav_menu( array(
          'theme_location' => 'header',
          'menu_id'        => 'header-menu',
          'container'      => '',
          'items_wrap'     => '<ul class="el-nav__list">%3$s</ul>',
          'fallback_cb'    => false,
        ) ); ?>
      </nav>
      <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="el-header__cta">Contact Us</a>
      <button class="el-nav-toggle" id="osl-nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <div class="all-wrapper">
    <div class="all-wrapper-i">
