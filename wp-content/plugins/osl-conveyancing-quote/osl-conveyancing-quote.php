<?php
/**
 * Plugin Name: OSL Conveyancing Quote
 * Description: Conveyancing quote calculator with central pricing management for OneStop Legal
 * Version: 1.0.0
 * Author: OneStop Legal
 */

if (!defined('ABSPATH')) exit;

define('OSL_CQ_VERSION', '1.1.0');
define('OSL_CQ_PATH', plugin_dir_path(__FILE__));
define('OSL_CQ_URL', plugin_dir_url(__FILE__));

// Include files
require_once OSL_CQ_PATH . 'includes/admin-pricing.php';
require_once OSL_CQ_PATH . 'includes/quote-engine.php';
require_once OSL_CQ_PATH . 'includes/ajax-handlers.php';
require_once OSL_CQ_PATH . 'includes/suburbs.php';
require_once OSL_CQ_PATH . 'includes/sitemap.php';

// Enqueue front-end assets
add_action('wp_enqueue_scripts', function() {
    if (is_page() || has_shortcode(get_post()->post_content ?? '', 'osl_quote_form')) {
        wp_enqueue_style('osl-cq-style', OSL_CQ_URL . 'assets/quote-form.css', array(), OSL_CQ_VERSION);
        wp_enqueue_script('osl-cq-script', OSL_CQ_URL . 'assets/quote-form.js', array('jquery'), OSL_CQ_VERSION, true);
        wp_localize_script('osl-cq-script', 'OslCQ', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('osl_cq_nonce'),
        ));
    }
});

// Register shortcode
add_shortcode('osl_quote_form', 'osl_cq_render_form');

// Activation: set default pricing
register_activation_hook(__FILE__, 'osl_cq_activate');
function osl_cq_activate() {
    $defaults = osl_cq_get_default_pricing();
    if (!get_option('osl_cq_default_pricing')) {
        update_option('osl_cq_default_pricing', $defaults);
    }
    if (!get_option('osl_cq_councils')) {
        update_option('osl_cq_councils', osl_cq_get_default_councils());
    }
    if (!get_option('osl_cq_council_overrides')) {
        update_option('osl_cq_council_overrides', array());
    }
}

function osl_cq_get_default_pricing() {
    return array(
        'purchasing' => array(
            'house' => array(
                'professional_fee' => 1210,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'registered_plan' => 45.78,
                'rates_search' => 212.55,
                'water_meter_reading' => 0,
                'land_tax' => 41.90,
                'final_title_search' => 43.47,
                'identity_check' => 19.90,
            ),
            'unit_townhouse_duplex' => array(
                'professional_fee' => 1210,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'registered_plan' => 45.78,
                'rates_search' => 212.55,
                'water_meter_reading' => 0,
                'information_certificate' => 71.75,
                'body_corporate_insurance' => 45.00,
                'community_title_cms' => 73.00,
                'cms' => 8.19,
                'bc_insurance_cert' => 56.78,
                'land_tax' => 41.90,
                'final_title_search' => 43.47,
                'identity_check' => 19.90,
            ),
            'land' => array(
                'professional_fee' => 1210,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'registered_plan' => 45.78,
                'rates_search' => 212.55,
                'water_meter_reading' => 0,
                'land_tax' => 41.90,
                'identity_check' => 19.90,
                'agent_fee' => 80.00,
            ),
        ),
        'selling' => array(
            'house' => array(
                'professional_fee' => 1089,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'identity_check' => 19.90,
                'agent_fee' => 80.00,
                'seller_disclosure' => 650.00,
            ),
            'unit_townhouse_duplex' => array(
                'professional_fee' => 1089,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'identity_check' => 19.90,
                'agent_fee' => 80.00,
                'seller_disclosure' => 650.00,
            ),
            'land' => array(
                'professional_fee' => 1089,
                'professional_fee_discount' => '',
                'discount_amount' => 0,
                'title_search' => 43.47,
                'identity_check' => 19.90,
                'agent_fee' => 80.00,
                'seller_disclosure' => 650.00,
            ),
        ),
    );
}

function osl_cq_get_default_councils() {
    return array(
        'balonne-shire' => 'Balonne Shire Council',
        'banana-shire' => 'Banana Shire Council',
        'barcaldine-regional' => 'Barcaldine Regional',
        'barcoo-shire' => 'Barcoo Shire',
        'blackhall-tambo-regional' => 'Blackhall-Tambo Regional',
        'boulia-shire' => 'Boulia Shire',
        'brisbane-city' => 'Brisbane City',
        'bulloo-shire' => 'Bulloo Shire Council',
        'bundaberg' => 'Bundaberg',
        'burdekin' => 'Burdekin',
        'burke-shire' => 'Burke Shire',
        'cairns' => 'Cairns',
        'carpentaria' => 'Carpentaria',
        'cassowary-coast-regional' => 'Cassowary Coast Regional',
        'central-highlands-regional' => 'Central Highlands Regional',
        'charters-towers-regional' => 'Charters Towers Regional',
        'cloncurry-shire' => 'Cloncurry Shire',
        'cook-shire' => 'Cook Shire',
        'croydon-shire' => 'Croydon Shire',
        'diamantina-shire' => 'Diamantina Shire',
        'douglas-shire' => 'Douglas Shire',
        'etheridge-shire' => 'Etheridge Shire',
        'flinders-shire' => 'Flinders Shire',
        'fraser-coast-regional' => 'Fraser Coast Regional',
        'gladstone-regional' => 'Gladstone Regional',
        'gold-coast' => 'Gold Coast',
        'goondiwindi-regional' => 'Goondiwindi Regional',
        'gympie-regional' => 'Gympie Regional',
        'hinchinbrook-shire' => 'Hinchinbrook Shire',
        'ipswich-city' => 'Ipswich City',
        'isaac-regional' => 'Isaac Regional',
        'livingstone-shire' => 'Livingstone Shire',
        'lockyer-valley' => 'Lockyer Valley',
        'logan-city' => 'Logan City',
        'longreach-regional' => 'Longreach Regional',
        'mackay-regional' => 'Mackay Regional',
        'maranoa-regional' => 'Maranoa Regional',
        'mareeba-shire' => 'Mareeba Shire',
        'mckinlay-shire' => 'McKinlay Shire',
        'moreton-bay-regional' => 'Moreton Bay Regional',
        'mount-isa-city' => 'Mount Isa City',
        'murweh-shire' => 'Murweh Shire',
        'noosa-shire' => 'Noosa Shire',
        'north-burnett-regional' => 'North Burnett Regional',
        'paroo-shire' => 'Paroo Shire',
        'quilpie-shire' => 'Quilpie Shire',
        'redland-city' => 'Redland City Council',
        'richmond-shire' => 'Richmond Shire',
        'rockhampton-regional' => 'Rockhampton Regional',
        'scenic-rim-regional' => 'Scenic Rim Regional',
        'somerset-regional' => 'Somerset Regional',
        'south-burnett-regional' => 'South Burnett Regional',
        'southern-downs-regional' => 'Southern Downs Regional',
        'sunshine-coast-regional' => 'Sunshine Coast Regional',
        'tablelands-regional' => 'Tablelands Regional',
        'toowoomba-regional' => 'Toowoomba Regional',
        'torres-shire' => 'Torres Shire',
        'townsville-city' => 'Townsville City',
        'weipa-town' => 'Weipa Town',
        'western-downs-regional' => 'Western Downs Regional',
        'whitsunday-regional' => 'Whitsunday Regional Council',
        'winton-shire' => 'Winton Shire Council',
    );
}
