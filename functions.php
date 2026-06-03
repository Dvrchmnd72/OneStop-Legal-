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


// ============================================
// OSL CUSTOM SEO META TAGS
// ============================================
add_action('wp_head', 'osl_custom_seo_meta', 1);

add_filter('pre_get_document_title', 'osl_custom_document_title', 10);
function osl_custom_document_title($title) {
    if (is_admin() || !is_singular()) return $title;
    $custom = get_post_meta(get_the_ID(), '_osl_seo_title', true);
    if (empty($custom)) $custom = get_post_meta(get_the_ID(), '_aioseo_title', true);
    return !empty($custom) ? $custom : $title;
}
function osl_custom_seo_meta() {
    // Don't run on admin
    if (is_admin()) return;
    
    $description = '';
    $seo_title = '';
    
    if (is_singular()) {
        $post_id = get_the_ID();
        
        // Check our custom field first, then fall back to AIOSEO data
        $description = get_post_meta($post_id, '_osl_seo_description', true);
        if (empty($description)) {
            $description = get_post_meta($post_id, '_aioseo_description', true);
        }
        if (empty($description) && is_page('conveyancing-quote')) {
            $description = 'Get an instant fixed-fee conveyancing quote from OneStop Legal. Transparent pricing for buying or selling property in Queensland, with solicitor-led support and no hidden costs.';
        }
        
        $seo_title = get_post_meta($post_id, '_osl_seo_title', true);
        if (empty($seo_title)) {
            $seo_title = get_post_meta($post_id, '_aioseo_title', true);
        }
    }
    
    // Output meta description
    if (!empty($description)) {
        $description = wp_strip_all_tags(html_entity_decode($description));
        echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
    }
    
    // Output OG tags for social sharing
    if (is_singular()) {
        $title = !empty($seo_title) ? $seo_title : get_the_title();
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
        if (!empty($description)) {
            echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        }
        if (has_post_thumbnail()) {
            echo '<meta property="og:image" content="' . esc_url(get_the_post_thumbnail_url(null, 'large')) . '" />' . "\n";
        }
        echo '<meta property="og:site_name" content="OneStop Legal" />' . "\n";
    }
}

// ============================================
// OSL SEO META BOX IN WP ADMIN
// ============================================
add_action('add_meta_boxes', 'osl_seo_meta_box');
function osl_seo_meta_box() {
    $screens = array('post', 'page');
    foreach ($screens as $screen) {
        add_meta_box(
            'osl_seo_meta',
            '🔍 SEO Settings (OneStop Legal)',
            'osl_seo_meta_box_html',
            $screen,
            'normal',
            'high'
        );
    }
}

function osl_seo_meta_box_html($post) {
    wp_nonce_field('osl_seo_meta_nonce', 'osl_seo_nonce');
    
    $seo_title = get_post_meta($post->ID, '_osl_seo_title', true);
    $seo_desc = get_post_meta($post->ID, '_osl_seo_description', true);
    
    // Show AIOSEO data if our custom fields are empty
    $aioseo_title = get_post_meta($post->ID, '_aioseo_title', true);
    $aioseo_desc = get_post_meta($post->ID, '_aioseo_description', true);
    
    if (empty($seo_title) && !empty($aioseo_title)) $seo_title = $aioseo_title;
    if (empty($seo_desc) && !empty($aioseo_desc)) $seo_desc = $aioseo_desc;
    
    echo '<style>
        .osl-seo-field { width: 100%; padding: 8px 12px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 5px; }
        .osl-seo-field:focus { border-color: #C8A961; outline: none; box-shadow: 0 0 0 2px rgba(200,169,97,0.2); }
        .osl-seo-label { font-weight: 600; margin-bottom: 5px; display: block; color: #1B2E4A; }
        .osl-seo-hint { color: #888; font-size: 12px; margin-bottom: 15px; }
        .osl-seo-preview { background: #f8f8f8; border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px; margin-top: 15px; }
        .osl-seo-preview-title { color: #1a0dab; font-size: 18px; margin-bottom: 3px; }
        .osl-seo-preview-url { color: #006621; font-size: 13px; margin-bottom: 3px; }
        .osl-seo-preview-desc { color: #545454; font-size: 13px; line-height: 1.4; }
    </style>';
    
    echo '<p><label class="osl-seo-label">SEO Title</label>';
    echo '<input type="text" name="osl_seo_title" class="osl-seo-field" id="osl-seo-title" value="' . esc_attr($seo_title) . '" placeholder="Enter SEO title (shown in Google)" />';
    echo '<span class="osl-seo-hint">Recommended: 50-60 characters. Leave blank to use post title.</span></p>';
    
    echo '<p><label class="osl-seo-label">SEO Description</label>';
    echo '<textarea name="osl_seo_description" class="osl-seo-field" id="osl-seo-desc" rows="3" placeholder="Enter meta description (shown under title in Google)">' . esc_textarea($seo_desc) . '</textarea>';
    echo '<span class="osl-seo-hint">Recommended: 150-160 characters. This is what people see in Google results.</span></p>';
    
    echo '<div class="osl-seo-preview">';
    echo '<strong style="color:#888;font-size:11px;">GOOGLE PREVIEW:</strong>';
    echo '<div class="osl-seo-preview-title" id="osl-preview-title">' . esc_html($seo_title ?: get_the_title($post->ID)) . '</div>';
    echo '<div class="osl-seo-preview-url">onestoplegal.com.au/' . esc_html($post->post_name) . '/</div>';
    echo '<div class="osl-seo-preview-desc" id="osl-preview-desc">' . esc_html($seo_desc ?: 'Add a meta description...') . '</div>';
    echo '</div>';
    
    echo '<script>
    document.getElementById("osl-seo-title").addEventListener("input", function() {
        document.getElementById("osl-preview-title").textContent = this.value || "' . esc_js(get_the_title($post->ID)) . '";
    });
    document.getElementById("osl-seo-desc").addEventListener("input", function() {
        document.getElementById("osl-preview-desc").textContent = this.value || "Add a meta description...";
    });
    </script>';
}

add_action('save_post', 'osl_seo_meta_save');
function osl_seo_meta_save($post_id) {
    if (!isset($_POST['osl_seo_nonce']) || !wp_verify_nonce($_POST['osl_seo_nonce'], 'osl_seo_meta_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['osl_seo_title'])) {
        update_post_meta($post_id, '_osl_seo_title', sanitize_text_field($_POST['osl_seo_title']));
    }
    if (isset($_POST['osl_seo_description'])) {
        update_post_meta($post_id, '_osl_seo_description', sanitize_textarea_field($_POST['osl_seo_description']));
    }
}

// ============================================
// SWAP FONTS TO LEAGUE SPARTAN
// ============================================
add_action('wp_enqueue_scripts', 'osl_swap_fonts', 20);
function osl_swap_fonts() {
    // Remove old Google font
    wp_dequeue_style('osetin-google-font');
    wp_deregister_style('osetin-google-font');
    
    // Load League Spartan
    wp_enqueue_style('osl-inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
}

add_action('wp_head', 'osl_font_overrides', 999);
function osl_font_overrides() {
    echo '<style>
    body,
    p,
    span,
    div,
    a,
    li,
    td,
    th,
    input,
    textarea,
    select,
    button,
    .blog-index-item-content,
    .blog-index-item-meta,
    .blog-content-text { 
        font-family: "Inter", sans-serif !important; 
    }
    
    h1, h2, h3, h4, h5, h6,
    .page-title,
    .styled-header,
    .faq-question,
    .osl-blog-hero h1,
    .osl-blog-card-title,
    .osl-post-hero h1,
    .osl-post-content h2,
    .osl-post-content h3,
    .osl-post-content h4,
    .osl-related h2,
    .osl-related-card-body h4,
    .osl-post-cta h2,
    .svc-hero h1,
    .svc-intro h2,
    .svc-types .section-title h2,
    .svc-benefits .section-title h2,
    .svc-elements .section-title h2,
    .svc-process .section-title h2,
    .svc-faq .section-title h2,
    .svc-cta h2,
    .section-title h2 {
        font-family: "Inter", sans-serif !important;
        font-weight: 700;
    }
    
    .top-menu .menu a,
    #header-menu a,
    #mobile-header-menu a,
    .footer-menu a,
    nav a {
        font-family: "Inter", sans-serif !important;
    }
    </style>';
}

// ============================================
// LOAD GLOBAL RESPONSIVE CSS
// ============================================
add_action('wp_enqueue_scripts', 'osl_responsive_css', 30);
function osl_responsive_css() {
    wp_enqueue_style('osl-responsive', get_stylesheet_directory_uri() . '/osl-responsive.css', array(), '1.0.0');
}

// ============================================
// OSL CUSTOM CONTACT FORM (No Plugin)
// ============================================
add_action('wp_ajax_osl_contact_form', 'osl_handle_contact_form');
add_action('wp_ajax_nopriv_osl_contact_form', 'osl_handle_contact_form');
function osl_handle_contact_form() {
    // Verify nonce
    if (!isset($_POST['osl_contact_nonce']) || !wp_verify_nonce($_POST['osl_contact_nonce'], 'osl_contact_form')) {
        wp_send_json_error('Security check failed.');
    }
    
    // Honeypot check (spam trap)
    if (!empty($_POST['website_url'])) {
        wp_send_json_error('Spam detected.');
    }
    
    // Sanitize inputs
    $name    = sanitize_text_field($_POST['osl_name'] ?? '');
    $email   = sanitize_email($_POST['osl_email'] ?? '');
    $phone   = sanitize_text_field($_POST['osl_phone'] ?? '');
    $service = sanitize_text_field($_POST['osl_service'] ?? '');
    $message = sanitize_textarea_field($_POST['osl_message'] ?? '');
    
    // Validate
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill in all required fields.');
    }
    if (!is_email($email)) {
        wp_send_json_error('Please enter a valid email address.');
    }
    
    // Build email
    $to = 'info@onestoplegal.com.au';
    $subject = 'New Enquiry from ' . $name . ' — OneStop Legal Website';
    
    $body  = "New contact form submission from your website:\n\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= "Name:    " . $name . "\n";
    $body .= "Email:   " . $email . "\n";
    $body .= "Phone:   " . ($phone ?: 'Not provided') . "\n";
    $body .= "Service: " . ($service ?: 'Not specified') . "\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    $body .= "Message:\n" . $message . "\n\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= "Sent from: onestoplegal.com.au/contact-us/\n";
    $body .= "Time: " . current_time('d/m/Y g:i A') . " AEST\n";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'From: OneStop Legal Website <noreply@onestoplegal.com.au>',
    );
    
    $sent = wp_mail($to, $subject, $body, $headers);
    
    if ($sent) {
        wp_send_json_success('Thank you! Your message has been sent. We will get back to you within 24 hours.');
    } else {
        wp_send_json_error('Sorry, there was an error sending your message. Please call us on +61 7 3156 1216.');
    }
}

// ============================================
// FROSTED WHITE GLASS HEADER — Always Clean
// ============================================
// add_action('wp_head', 'osl_liquid_glass_header', 99);
function osl_liquid_glass_header() {
    echo '<style>
/* ================================================
   FROSTED WHITE HEADER — OneStop Legal 2026
   Single consistent look. No scroll change.
   ================================================ */

/* Remove top bar & theme fixed header */
.top-bar-links-box-container,
.fixed-header-w { display: none !important; }

/* ---- FIXED FULL-WIDTH HEADER ---- */
.main-header-w.main-header-version1 {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    width: 100% !important;
    z-index: 9999;
}

.main-header-w .main-header-i {
    max-width: 100% !important;
    width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
}

.main-header-w .main-header {
    background: rgba(255, 255, 255, 0.82) !important;
    backdrop-filter: blur(28px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
    border: none !important;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
    box-shadow: 0 1px 20px rgba(0, 0, 0, 0.06) !important;
    padding: 0 48px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    min-height: 70px;
    width: 100% !important;
    max-width: 100% !important;
    position: relative;
}

/* Subtle top highlight */
.main-header-w .main-header::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: rgba(255, 255, 255, 0.9);
    pointer-events: none;
    z-index: 1;
}

/* ---- LOGO ---- */
.main-header .logo {
    position: relative;
    z-index: 2;
    padding: 12px 0;
    flex-shrink: 0;
}

.main-header .logo a {
    display: flex;
    align-items: center;
    text-decoration: none !important;
}

.main-header .osl-header-logo {
    height: 40px;
    width: auto !important;
    filter: brightness(0.15) !important;
    transition: all 0.3s ease;
}

.main-header .logo:hover .osl-header-logo {
    filter: brightness(0) !important;
    transform: scale(1.02);
}

/* ---- NAV LINKS — Dark navy text ---- */
.main-header .top-menu {
    position: relative;
    z-index: 2;
}

.main-header #header-menu {
    display: flex;
    align-items: center;
    gap: 0;
    margin: 0;
    padding: 0;
    list-style: none;
}

.main-header #header-menu > li > a {
    color: #1B2E4A !important;
    font-family: "Inter", sans-serif !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    letter-spacing: 0.2px;
    text-transform: none;
    padding: 26px 22px !important;
    position: relative;
    transition: all 0.25s ease !important;
    text-decoration: none !important;
}

.main-header #header-menu > li > a:hover {
    color: #0a1628 !important;
}

.main-header #header-menu > li.current-menu-item > a {
    color: #0a1628 !important;
    font-weight: 600 !important;
}

/* Clean underline on hover */
.main-header #header-menu > li > a::after {
    content: "";
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 20px;
    height: 2px;
    background: #1B2E4A;
    border-radius: 2px;
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
}

.main-header #header-menu > li > a:hover::after,
.main-header #header-menu > li.current-menu-item > a::after {
    transform: translateX(-50%) scaleX(1);
}

/* ---- CTA BUTTON (Contact Us) — Solid navy pill ---- */
.menu-last-item-button .main-header #header-menu > li:last-child > a {
    background: #1B2E4A !important;
    color: #fff !important;
    padding: 11px 28px !important;
    border-radius: 50px !important;
    margin-left: 14px;
    font-weight: 600 !important;
    font-size: 14px !important;
    letter-spacing: 0.3px;
    border: none !important;
    box-shadow: 0 2px 8px rgba(27, 46, 74, 0.2);
    transition: all 0.3s ease !important;
}

.menu-last-item-button .main-header #header-menu > li:last-child > a::after {
    display: none !important;
}

.menu-last-item-button .main-header #header-menu > li:last-child > a:hover {
    background: #2a4268 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 16px rgba(27, 46, 74, 0.3) !important;
}

/* ---- MENU SEPARATORS (pipes between items) ---- */
.main-header #header-menu > li + li:not(:last-child)::before {
    content: "";
    display: inline-block;
    width: 1px;
    height: 14px;
    background: rgba(27, 46, 74, 0.15);
    vertical-align: middle;
    margin-right: 0;
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
}

.main-header #header-menu > li {
    position: relative;
}

/* ---- BODY PADDING ---- */
body {
    padding-top: 70px !important;
}

/* ---- DROPDOWN MENUS ---- */
.main-header .top-menu .menu .sub-menu,
.main-header #header-menu .sub-menu {
    background: rgba(255, 255, 255, 0.92) !important;
    backdrop-filter: blur(24px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(24px) saturate(180%) !important;
    border: 1px solid rgba(0, 0, 0, 0.06) !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08),
                0 0 0 1px rgba(0, 0, 0, 0.02) !important;
    padding: 6px 0 !important;
    margin-top: 0 !important;
    overflow: hidden;
}

.main-header #header-menu .sub-menu li a {
    color: #1B2E4A !important;
    padding: 10px 22px !important;
    font-size: 13.5px !important;
    transition: all 0.2s ease !important;
}

.main-header #header-menu .sub-menu li a:hover {
    color: #0a1628 !important;
    background: rgba(27, 46, 74, 0.05) !important;
    padding-left: 26px !important;
}

/* ---- MOBILE HEADER ---- */
@media(max-width: 1100px) {
    body { padding-top: 62px !important; }

    .main-header-w.main-header-version1 { display: none !important; }

    .mobile-header-w {
        position: fixed !important;
        top: 0; left: 0; right: 0;
        z-index: 9999;
        width: 100% !important;
    }

    .mobile-header {
        background: rgba(255, 255, 255, 0.88) !important;
        backdrop-filter: blur(28px) saturate(180%) !important;
        -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06) !important;
        box-shadow: 0 1px 20px rgba(0, 0, 0, 0.06) !important;
    }

    .mobile-header .mobile-menu-toggler i,
    .mobile-header .mobile-menu-search-toggler i {
        color: #1B2E4A !important;
    }

    .mobile-header img {
        filter: brightness(0.15) !important;
    }

    .mobile-header-menu-w {
        background: #fff !important;
    }

    .mobile-header-menu-w #mobile-header-menu a {
        color: #1B2E4A !important;
        border-color: rgba(0, 0, 0, 0.06) !important;
    }

    .mobile-header-menu-w #mobile-header-menu a:hover {
        color: #0a1628 !important;
        background: rgba(27, 46, 74, 0.04) !important;
    }
}

</style>';
}

/**

/**
 * Cache-bust the child theme style.css by using file modification time.
 * Prevents stale caching like style.css?ver=6.9.3.
 */
add_action('wp_enqueue_scripts', function () {
    $handle = 'osetin-style';
    $path = get_stylesheet_directory() . '/style.css';

    if (!file_exists($path)) {
        return;
    }

    $ver = filemtime($path);

    // Only update version; do NOT enqueue a second copy (avoids duplicate <link> tags)
    if (isset(wp_styles()->registered[$handle])) {
        wp_styles()->registered[$handle]->ver = $ver;
    }
}, 100);

/**
 * Enqueue OSL overrides as a separate file to bypass stale caching on style.css.
 */
add_action('wp_enqueue_scripts', function () {
    $file = get_stylesheet_directory() . '/osl-overrides-2026-03-13-0438.css';
    if (file_exists($file)) {
        wp_enqueue_style(
            'osl-overrides',
            get_stylesheet_directory_uri() . '/osl-overrides-2026-03-13-0438.css',
            array(),
            filemtime($file)
        );

        // Header-specific overrides (loads AFTER osl-overrides)
        $header_file = get_stylesheet_directory() . "/osl-header.css";
        if (file_exists($header_file)) {
            wp_enqueue_style(
                "osl-header",
                get_stylesheet_directory_uri() . "/osl-header.css",
                array("osl-overrides"),
                filemtime($header_file)
            );
        }

        // Home page hero styles (loads AFTER osl-header, front page only)
        if ( is_front_page() ) {
            $home_file = get_stylesheet_directory() . "/osl-home.css";
            if (file_exists($home_file)) {
                wp_enqueue_style(
                    "osl-home",
                    get_stylesheet_directory_uri() . "/osl-home.css",
                    array("osl-header"),
                    filemtime($home_file)
                );
            }
        }

    }
}, 110);

// ============================================
// ENQUEUE SERVICE PAGE CSS
// ============================================
add_action('wp_enqueue_scripts', function() {
    $svc_templates = array(
        'page-bfa-custom.php',
        'page-commercial-custom.php',
        'page-compensation-custom.php',
        'page-compensation-sub-custom.php',
        'page-contract-reviews-custom.php',
        'page-conveyancing-custom.php',
        'page-immigration-custom.php',
        'page-litigation-custom.php',
        'page-wills-estate-custom.php',
        'page-property-settlement-custom.php',
        'page-services-custom.php',
        'page-about-custom.php',
    );
    $current = get_page_template_slug();
    if ( in_array( basename($current), $svc_templates ) ) {
        $file = get_stylesheet_directory() . '/osl-service.css';
        wp_enqueue_style(
            'osl-service',
            get_stylesheet_directory_uri() . '/osl-service.css',
            array('osl-custom-styles'),
            file_exists($file) ? filemtime($file) : '1.0'
        );
    }
}, 120);

// OSL marketing attribution + technical SEO enhancements
add_action('wp_head', function () {
    $gtm_id = 'GTM-XXXXXXX'; // Replace with production GTM container ID.
    if (!empty($gtm_id)) {
        echo "<!-- Google Tag Manager -->\n";
        echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id=" . esc_js($gtm_id) . "'+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js($gtm_id) . "');</script>\n";
        echo "<!-- End Google Tag Manager -->\n";
    }
}, 2);

add_action('wp_body_open', function () {
    $gtm_id = 'GTM-XXXXXXX';
    echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr($gtm_id) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
}, 1);

add_action('wp_head', function () {
    if (is_page(array('login', 'register', 'support', 'terms'))) {
        echo '<meta name="robots" content="noindex,follow" />' . "\n";
        echo '<link rel="canonical" href="' . esc_url(home_url(add_query_arg(array(), $GLOBALS['wp']->request))) . '" />' . "\n";
    }
}, 5);

add_action('wp_head', function () {
    if (!is_page('conveyancing')) return;
    $schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            array('@type' => 'Organization', 'name' => 'OneStop Legal', 'url' => home_url('/')),
            array('@type' => 'LocalBusiness', 'name' => 'OneStop Legal', 'url' => home_url('/'), 'telephone' => '+61 7 3156 1216'),
            array('@type' => 'LegalService', 'name' => 'Conveyancing Services', 'provider' => array('@type' => 'Organization', 'name' => 'OneStop Legal')),
            array('@type' => 'BreadcrumbList', 'itemListElement' => array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
                array('@type' => 'ListItem', 'position' => 2, 'name' => 'Conveyancing', 'item' => home_url('/conveyancing/')),
            )),
            array('@type' => 'Review', 'reviewRating' => array('@type' => 'Rating', 'ratingValue' => '4.9', 'bestRating' => '5'), 'author' => array('@type' => 'Person', 'name' => 'Verified Client'), 'itemReviewed' => array('@type' => 'LegalService', 'name' => 'OneStop Legal Conveyancing'))
        )
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
}, 20);
