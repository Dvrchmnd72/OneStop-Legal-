<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','owl-carousel' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
// END ENQUEUE PARENT ACTION

// Enqueue custom CSS on ALL pages - bypass theme version filter
function osl_enqueue_styles() {
    $css_file = get_stylesheet_directory() . '/osl-homepage.css';
    $ver = file_exists($css_file) ? filemtime($css_file) : time();
    wp_enqueue_style( 'osl-custom-styles', get_stylesheet_directory_uri() . '/osl-homepage.css', array(), $ver );
}
add_action( 'wp_enqueue_scripts', 'osl_enqueue_styles', 9999 );

// Prevent parent theme from overriding our version
function osl_force_css_version( $src, $handle ) {
    if ( $handle === 'osl-custom-styles' ) {
        $css_file = get_stylesheet_directory() . '/osl-homepage.css';
        $ver = file_exists($css_file) ? filemtime($css_file) : time();
        $src = add_query_arg( 'ver', $ver, $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'osl_force_css_version', 9999, 2 );

// Enqueue custom JS
function osl_enqueue_scripts() {
    $js_file = get_stylesheet_directory() . '/custom.js';
    $ver = file_exists($js_file) ? filemtime($js_file) : time();
    wp_enqueue_script('osl-custom-js', get_stylesheet_directory_uri() . '/custom.js', array('jquery'), $ver, true);
}
add_action('wp_enqueue_scripts', 'osl_enqueue_scripts', 9999);
