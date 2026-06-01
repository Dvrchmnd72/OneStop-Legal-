<?php
if (!defined('ABSPATH')) exit;

function osl_cq_events_table_name() {
    global $wpdb;
    return $wpdb->prefix . 'osl_cq_quote_events';
}

function osl_cq_install_events_table() {
    global $wpdb;

    $table_name = osl_cq_events_table_name();
    $charset_collate = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE {$table_name} (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        created_at datetime NOT NULL,
        event_name varchar(64) NOT NULL,
        page_url text NULL,
        page_path varchar(255) NULL,
        transaction_type varchar(32) NULL,
        property_type varchar(64) NULL,
        council varchar(120) NULL,
        suburb varchar(120) NULL,
        quote_total decimal(10,2) NULL,
        quote_total_band varchar(32) NULL,
        email varchar(190) NULL,
        phone varchar(64) NULL,
        user_agent_hash char(64) NULL,
        ip_hash char(64) NULL,
        utm_source varchar(120) NULL,
        utm_medium varchar(120) NULL,
        utm_campaign varchar(190) NULL,
        utm_term varchar(190) NULL,
        utm_content varchar(190) NULL,
        gclid varchar(190) NULL,
        fbclid varchar(190) NULL,
        extra longtext NULL,
        PRIMARY KEY  (id),
        KEY event_name (event_name),
        KEY created_at (created_at)
    ) {$charset_collate};";

    dbDelta($sql);
    update_option('osl_cq_events_table_version', '1.0.0', false);
}

function osl_cq_events_table_exists() {
    global $wpdb;

    $table_name = osl_cq_events_table_name();
    return $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table_name)) === $table_name;
}

function osl_cq_maybe_install_events_table() {
    if (get_option('osl_cq_events_table_version') !== '1.0.0' || !osl_cq_events_table_exists()) {
        osl_cq_install_events_table();
    }
}
add_action('admin_init', 'osl_cq_maybe_install_events_table');

function osl_cq_maybe_install_events_table_on_load() {
    if (get_option('osl_cq_events_table_version') !== '1.0.0') {
        osl_cq_install_events_table();
    }
}
add_action('plugins_loaded', 'osl_cq_maybe_install_events_table_on_load', 20);

function osl_cq_quote_total_band($total) {
    if ($total === null || $total === '') {
        return '';
    }

    $total = floatval($total);
    if ($total < 1000) {
        return 'under_1000';
    }
    if ($total < 1500) {
        return '1000_1499';
    }
    if ($total < 2000) {
        return '1500_1999';
    }
    if ($total < 2500) {
        return '2000_2499';
    }
    return '2500_plus';
}

function osl_cq_sanitize_url_path($path) {
    $path = sanitize_text_field((string) $path);
    if ($path === '') {
        return '';
    }

    return wp_parse_url($path, PHP_URL_PATH) ?: $path;
}

function osl_cq_collect_tracking_context($source = null) {
    $source = is_array($source) ? $source : $_POST;
    $page_url = isset($source['page_url']) ? esc_url_raw(wp_unslash($source['page_url'])) : '';
    $referer = wp_get_referer();

    if ($page_url === '' && $referer) {
        $page_url = esc_url_raw($referer);
    }

    $page_path = isset($source['page_path']) ? osl_cq_sanitize_url_path(wp_unslash($source['page_path'])) : '';
    if ($page_path === '' && $page_url !== '') {
        $page_path = osl_cq_sanitize_url_path($page_url);
    }

    $context = array(
        'page_url' => $page_url,
        'page_path' => $page_path,
        'suburb' => isset($source['suburb']) ? sanitize_text_field(wp_unslash($source['suburb'])) : '',
        'utm_source' => isset($source['utm_source']) ? sanitize_text_field(wp_unslash($source['utm_source'])) : '',
        'utm_medium' => isset($source['utm_medium']) ? sanitize_text_field(wp_unslash($source['utm_medium'])) : '',
        'utm_campaign' => isset($source['utm_campaign']) ? sanitize_text_field(wp_unslash($source['utm_campaign'])) : '',
        'utm_term' => isset($source['utm_term']) ? sanitize_text_field(wp_unslash($source['utm_term'])) : '',
        'utm_content' => isset($source['utm_content']) ? sanitize_text_field(wp_unslash($source['utm_content'])) : '',
        'gclid' => isset($source['gclid']) ? sanitize_text_field(wp_unslash($source['gclid'])) : '',
        'fbclid' => isset($source['fbclid']) ? sanitize_text_field(wp_unslash($source['fbclid'])) : '',
    );

    return $context;
}

function osl_cq_log_quote_event($event_name, $data = array()) {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        osl_cq_install_events_table();
    }

    $allowed_events = array(
        'quote_generated',
        'quote_email_clicked',
        'quote_contact_clicked',
        'quote_phone_clicked',
        'quote_download_clicked',
        'quote_page_cta_clicked',
    );

    $event_name = sanitize_key($event_name);
    if (!in_array($event_name, $allowed_events, true)) {
        return false;
    }

    $quote_total = array_key_exists('quote_total', $data) && $data['quote_total'] !== '' ? round(floatval($data['quote_total']), 2) : null;
    $quote_total_band = !empty($data['quote_total_band']) ? sanitize_text_field($data['quote_total_band']) : osl_cq_quote_total_band($quote_total);
    $email = !empty($data['email']) ? sanitize_email($data['email']) : '';
    $phone = !empty($data['phone']) ? sanitize_text_field($data['phone']) : '';
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? substr(sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])), 0, 500) : '';
    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    $hash_salt = wp_salt('auth');
    $extra = !empty($data['extra']) && is_array($data['extra']) ? wp_json_encode(array_map('sanitize_text_field', $data['extra'])) : null;

    $inserted = $wpdb->insert(
        osl_cq_events_table_name(),
        array(
            'created_at' => current_time('mysql'),
            'event_name' => $event_name,
            'page_url' => !empty($data['page_url']) ? esc_url_raw($data['page_url']) : '',
            'page_path' => !empty($data['page_path']) ? osl_cq_sanitize_url_path($data['page_path']) : '',
            'transaction_type' => !empty($data['transaction_type']) ? sanitize_text_field($data['transaction_type']) : '',
            'property_type' => !empty($data['property_type']) ? sanitize_text_field($data['property_type']) : '',
            'council' => !empty($data['council']) ? sanitize_text_field($data['council']) : '',
            'suburb' => !empty($data['suburb']) ? sanitize_text_field($data['suburb']) : '',
            'quote_total' => $quote_total,
            'quote_total_band' => $quote_total_band,
            'email' => is_email($email) ? $email : '',
            'phone' => $phone,
            'user_agent_hash' => $user_agent ? hash_hmac('sha256', $user_agent, $hash_salt) : '',
            'ip_hash' => $ip ? hash_hmac('sha256', $ip, $hash_salt) : '',
            'utm_source' => !empty($data['utm_source']) ? sanitize_text_field($data['utm_source']) : '',
            'utm_medium' => !empty($data['utm_medium']) ? sanitize_text_field($data['utm_medium']) : '',
            'utm_campaign' => !empty($data['utm_campaign']) ? sanitize_text_field($data['utm_campaign']) : '',
            'utm_term' => !empty($data['utm_term']) ? sanitize_text_field($data['utm_term']) : '',
            'utm_content' => !empty($data['utm_content']) ? sanitize_text_field($data['utm_content']) : '',
            'gclid' => !empty($data['gclid']) ? sanitize_text_field($data['gclid']) : '',
            'fbclid' => !empty($data['fbclid']) ? sanitize_text_field($data['fbclid']) : '',
            'extra' => $extra,
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%f', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );

    return $inserted !== false;
}

function osl_cq_get_recent_quote_events($limit = 100, $offset = 0) {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        return array();
    }

    $limit = min(100, max(1, absint($limit)));
    $offset = max(0, absint($offset));

    return $wpdb->get_results(
        $wpdb->prepare(
            'SELECT * FROM ' . osl_cq_events_table_name() . ' ORDER BY created_at DESC, id DESC LIMIT %d OFFSET %d',
            $limit,
            $offset
        ),
        ARRAY_A
    );
}

function osl_cq_count_quote_events() {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        return 0;
    }

    return absint($wpdb->get_var('SELECT COUNT(*) FROM ' . osl_cq_events_table_name()));
}
