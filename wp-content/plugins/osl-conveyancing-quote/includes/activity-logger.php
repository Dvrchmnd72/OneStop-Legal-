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


/**
 * ONE STOP QUOTE ACTIVITY EXPORT DELETE RETENTION HELPERS
 */

function osl_cq_quote_activity_allowed_events() {
    return array(
        'quote_generated',
        'quote_email_clicked',
        'quote_contact_clicked',
        'quote_phone_clicked',
        'quote_download_clicked',
        'quote_page_cta_clicked',
    );
}

function osl_cq_sanitize_quote_activity_event_filter($event_name) {
    $event_name = sanitize_key($event_name);
    return in_array($event_name, osl_cq_quote_activity_allowed_events(), true) ? $event_name : '';
}

function osl_cq_quote_activity_retention_options() {
    return array(
        'forever' => 'Keep forever',
        '90'      => '90 days',
        '180'     => '180 days',
        '365'     => '365 days',
    );
}

function osl_cq_get_quote_activity_retention() {
    $value = get_option('osl_cq_quote_activity_retention_days', 'forever');
    return array_key_exists($value, osl_cq_quote_activity_retention_options()) ? $value : 'forever';
}

function osl_cq_quote_activity_where_sql($event_filter = '') {
    $event_filter = osl_cq_sanitize_quote_activity_event_filter($event_filter);
    $where = 'WHERE 1=1';
    $params = array();

    if ($event_filter !== '') {
        $where .= ' AND event_name = %s';
        $params[] = $event_filter;
    }

    return array($where, $params);
}

function osl_cq_get_recent_quote_events_filtered($limit = 100, $offset = 0, $event_filter = '') {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        return array();
    }

    $limit = min(100, max(1, absint($limit)));
    $offset = max(0, absint($offset));

    list($where, $params) = osl_cq_quote_activity_where_sql($event_filter);

    $sql = 'SELECT * FROM ' . osl_cq_events_table_name() . ' ' . $where . ' ORDER BY created_at DESC, id DESC LIMIT %d OFFSET %d';
    $params[] = $limit;
    $params[] = $offset;

    return $wpdb->get_results($wpdb->prepare($sql, $params), ARRAY_A);
}

function osl_cq_count_quote_events_filtered($event_filter = '') {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        return 0;
    }

    list($where, $params) = osl_cq_quote_activity_where_sql($event_filter);
    $sql = 'SELECT COUNT(*) FROM ' . osl_cq_events_table_name() . ' ' . $where;

    if (!empty($params)) {
        $sql = $wpdb->prepare($sql, $params);
    }

    return absint($wpdb->get_var($sql));
}

function osl_cq_quote_activity_extra_value($event, $key) {
    if (empty($event['extra'])) {
        return '';
    }

    $extra = json_decode($event['extra'], true);
    if (!is_array($extra) || !isset($extra[$key])) {
        return '';
    }

    return sanitize_text_field($extra[$key]);
}

function osl_cq_quote_activity_admin_url($args = array()) {
    return add_query_arg(array_merge(array('page' => 'osl-cq-activity'), $args), admin_url('admin.php'));
}

function osl_cq_redirect_quote_activity($args = array()) {
    wp_safe_redirect(osl_cq_quote_activity_admin_url($args));
    exit;
}

function osl_cq_export_quote_activity_csv($event_filter = '') {
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient permissions.');
    }

    check_admin_referer('osl_cq_export_activity');

    $event_filter = osl_cq_sanitize_quote_activity_event_filter($event_filter);
    $events = osl_cq_get_recent_quote_events_filtered(100, 0, $event_filter);

    nocache_headers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=onestop-quote-activity-' . gmdate('Ymd-His') . '.csv');

    $out = fopen('php://output', 'w');

    fputcsv($out, array(
        'Date/time',
        'Event',
        'Transaction type',
        'Property type',
        'Council',
        'Suburb',
        'Page path',
        'Quote total',
        'Quote band',
        'CTA/link URL',
        'Email',
        'Phone',
        'UTM source',
        'UTM medium',
        'UTM campaign',
        'UTM term',
        'UTM content',
        'GCLID',
        'FBCLID',
    ));

    foreach ($events as $event) {
        fputcsv($out, array(
            $event['created_at'] ?? '',
            $event['event_name'] ?? '',
            $event['transaction_type'] ?? '',
            $event['property_type'] ?? '',
            $event['council'] ?? '',
            $event['suburb'] ?? '',
            $event['page_path'] ?? '',
            $event['quote_total'] ?? '',
            $event['quote_total_band'] ?? '',
            osl_cq_quote_activity_extra_value($event, 'link_url'),
            $event['email'] ?? '',
            $event['phone'] ?? '',
            $event['utm_source'] ?? '',
            $event['utm_medium'] ?? '',
            $event['utm_campaign'] ?? '',
            $event['utm_term'] ?? '',
            $event['utm_content'] ?? '',
            $event['gclid'] ?? '',
            $event['fbclid'] ?? '',
        ));
    }

    fclose($out);
    exit;
}

function osl_cq_delete_selected_quote_activity($ids) {
    global $wpdb;

    $ids = array_filter(array_map('absint', (array) $ids));
    if (empty($ids) || !osl_cq_events_table_exists()) {
        return 0;
    }

    $placeholders = implode(',', array_fill(0, count($ids), '%d'));
    $sql = 'DELETE FROM ' . osl_cq_events_table_name() . ' WHERE id IN (' . $placeholders . ')';

    return absint($wpdb->query($wpdb->prepare($sql, $ids)));
}

function osl_cq_delete_quote_activity_older_than($days) {
    global $wpdb;

    $days = absint($days);
    if (!in_array($days, array(30, 90, 180, 365), true) || !osl_cq_events_table_exists()) {
        return 0;
    }

    $cutoff = gmdate('Y-m-d H:i:s', time() - ($days * DAY_IN_SECONDS));

    return absint($wpdb->query(
        $wpdb->prepare(
            'DELETE FROM ' . osl_cq_events_table_name() . ' WHERE created_at < %s',
            $cutoff
        )
    ));
}

function osl_cq_delete_filtered_quote_activity($event_filter = '') {
    global $wpdb;

    if (!osl_cq_events_table_exists()) {
        return 0;
    }

    list($where, $params) = osl_cq_quote_activity_where_sql($event_filter);
    $sql = 'DELETE FROM ' . osl_cq_events_table_name() . ' ' . $where;

    if (!empty($params)) {
        $sql = $wpdb->prepare($sql, $params);
    }

    return absint($wpdb->query($sql));
}

function osl_cq_maybe_run_quote_activity_retention_cleanup() {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    $retention = osl_cq_get_quote_activity_retention();
    if ($retention === 'forever') {
        return;
    }

    if (get_transient('osl_cq_quote_activity_retention_ran')) {
        return;
    }

    osl_cq_delete_quote_activity_older_than(absint($retention));
    set_transient('osl_cq_quote_activity_retention_ran', 1, DAY_IN_SECONDS);
}

function osl_cq_handle_quote_activity_admin_actions() {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    if (($_GET['page'] ?? '') !== 'osl-cq-activity' && ($_POST['page'] ?? '') !== 'osl-cq-activity') {
        return;
    }

    osl_cq_maybe_install_events_table();

    $action = sanitize_key($_REQUEST['osl_cq_activity_action'] ?? '');

    if ($action === 'export') {
        osl_cq_export_quote_activity_csv($_GET['event_name'] ?? '');
    }

    if ($action === 'save_retention') {
        check_admin_referer('osl_cq_save_activity_retention');
        $retention = sanitize_text_field($_POST['retention_days'] ?? 'forever');
        if (!array_key_exists($retention, osl_cq_quote_activity_retention_options())) {
            $retention = 'forever';
        }
        update_option('osl_cq_quote_activity_retention_days', $retention, false);
        osl_cq_redirect_quote_activity(array('osl_cq_notice' => 'retention_saved'));
    }

    if ($action === 'delete_selected') {
        check_admin_referer('osl_cq_activity_bulk_delete');
        $deleted = osl_cq_delete_selected_quote_activity($_POST['activity_ids'] ?? array());
        osl_cq_redirect_quote_activity(array('osl_cq_deleted' => $deleted));
    }

    if ($action === 'delete_older_than') {
        check_admin_referer('osl_cq_activity_delete_older_than');
        $days = absint($_POST['delete_older_than_days'] ?? 0);
        $deleted = osl_cq_delete_quote_activity_older_than($days);
        osl_cq_redirect_quote_activity(array('osl_cq_deleted' => $deleted));
    }

    if ($action === 'confirm_delete') {
        check_admin_referer('osl_cq_activity_confirm_delete');
        $scope = sanitize_key($_POST['delete_scope'] ?? '');
        $event_filter = osl_cq_sanitize_quote_activity_event_filter($_POST['event_name'] ?? '');

        if ($scope === 'filtered' && $event_filter !== '') {
            $deleted = osl_cq_delete_filtered_quote_activity($event_filter);
            osl_cq_redirect_quote_activity(array('event_name' => $event_filter, 'osl_cq_deleted' => $deleted));
        }

        if ($scope === 'all') {
            $deleted = osl_cq_delete_filtered_quote_activity('');
            osl_cq_redirect_quote_activity(array('osl_cq_deleted' => $deleted));
        }
    }
}
add_action('admin_init', 'osl_cq_handle_quote_activity_admin_actions');
add_action('admin_init', 'osl_cq_maybe_run_quote_activity_retention_cleanup');
