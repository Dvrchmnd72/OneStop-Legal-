<?php
if (!defined('ABSPATH')) exit;

// Add admin menu
add_action('admin_menu', function() {
    add_menu_page(
        'Conveyancing Pricing',
        'Conveyancing Pricing',
        'manage_options',
        'osl-cq-pricing',
        'osl_cq_pricing_page',
        'dashicons-calculator',
        30
    );
    add_submenu_page(
        'osl-cq-pricing',
        'Default Pricing',
        'Default Pricing',
        'manage_options',
        'osl-cq-pricing',
        'osl_cq_pricing_page'
    );
    add_submenu_page(
        'osl-cq-pricing',
        'Council Pricing',
        'Council Pricing',
        'manage_options',
        'osl-cq-overrides',
        'osl_cq_overrides_page'
    );
    add_submenu_page(
        'osl-cq-pricing',
        'Manage Councils',
        'Manage Councils',
        'manage_options',
        'osl-cq-councils',
        'osl_cq_councils_page'
    );
    add_submenu_page(
        'osl-cq-pricing',
        'Quote Activity',
        'Quote Activity',
        'manage_options',
        'osl-cq-activity',
        'osl_cq_activity_page'
    );
});

// Admin styles
add_action('admin_head', function() {
    $screen = get_current_screen();
    if (strpos($screen->id, 'osl-cq') === false) return;
    echo '<style>
        .osl-cq-wrap { max-width: 1200px; }
        .osl-cq-wrap h1 { color: #1B2E4A; }
        .osl-cq-section { background: #fff; padding: 20px; margin: 15px 0; border: 1px solid #ccd0d4; border-radius: 8px; }
        .osl-cq-section h2 { margin-top: 0; padding: 10px 0; border-bottom: 2px solid #C5A267; color: #1B2E4A; }
        .osl-cq-section h3 { color: #C5A267; margin-top: 20px; }
        .osl-cq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .osl-cq-field { display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #f9f9f9; border-radius: 4px; }
        .osl-cq-field label { font-weight: 500; min-width: 250px; }
        .osl-cq-field input[type=number], .osl-cq-field select { width: 120px; padding: 6px 10px; border: 1px solid #ccd0d4; border-radius: 4px; }
        .osl-cq-field input[type=number]:focus { border-color: #C5A267; box-shadow: 0 0 0 1px #C5A267; outline: none; }
        .osl-cq-tabs { display: flex; gap: 0; margin-bottom: 0; }
        .osl-cq-tab { padding: 12px 24px; background: #f1f1f1; border: 1px solid #ccd0d4; border-bottom: none; cursor: pointer; font-weight: 500; border-radius: 8px 8px 0 0; }
        .osl-cq-tab.active { background: #fff; border-bottom: 1px solid #fff; margin-bottom: -1px; z-index: 1; color: #C5A267; }
        .osl-cq-tab-content { display: none; }
        .osl-cq-tab-content.active { display: block; }
        .osl-cq-success { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 4px; margin: 10px 0; }
        .button-gold { background: #C5A267 !important; border-color: #B08C4A !important; color: #fff !important; }
        .button-gold:hover { background: #B08C4A !important; }
        .osl-cq-council-list { column-count: 3; column-gap: 20px; }
        .osl-cq-council-item { break-inside: avoid; padding: 6px 10px; margin: 4px 0; background: #f9f9f9; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
        .osl-cq-muted { color: #666; }
    </style>';
});

function osl_cq_build_pricing_from_post($source, &$has_value = null, $fallback_pricing = null, $field_callback = 'osl_cq_get_default_fee_fields') {
    $pricing = array();
    $has_value = false;

    foreach (array_keys(osl_cq_get_transaction_types()) as $type) {
        foreach (osl_cq_get_property_types() as $pkey => $plabel) {
            $pricing[$type][$pkey] = array(
                'professional_fee' => 0,
                'disbursements' => array(),
            );

            $fallback_flat = is_array($fallback_pricing) ? osl_cq_flatten_property_pricing($fallback_pricing[$type][$pkey] ?? array()) : array();

            foreach (call_user_func($field_callback, $type, $pkey) as $fkey => $flabel) {
                $raw = $source[$type][$pkey][$fkey] ?? '';
                $use_fallback = ($raw === '' || $raw === null) && array_key_exists($fkey, $fallback_flat);
                $value = $use_fallback ? $fallback_flat[$fkey] : $raw;

                if ($raw !== '' && $raw !== null) {
                    $has_value = true;
                }

                if ($fkey === 'professional_fee') {
                    $pricing[$type][$pkey][$fkey] = floatval($value);
                } else {
                    $pricing[$type][$pkey]['disbursements'][$fkey] = floatval($value);
                }
            }
        }
    }

    return $pricing;
}

function osl_cq_build_council_pricing_from_post($source, &$has_value = null) {
    $pricing = array();
    $has_value = false;

    foreach (osl_cq_get_property_types() as $pkey => $plabel) {
        $pricing['purchase'][$pkey] = array(
            'disbursements' => array(),
        );

        foreach (osl_cq_get_council_fee_fields('purchase', $pkey) as $fkey => $flabel) {
            $raw = $source['purchase'][$pkey][$fkey] ?? '';
            if ($raw !== '' && $raw !== null) {
                $has_value = true;
            }
            $pricing['purchase'][$pkey]['disbursements'][$fkey] = floatval($raw);
        }
    }

    return $pricing;
}

// ============================================
// DEFAULT PRICING PAGE
// ============================================
function osl_cq_pricing_page() {
    $state = osl_cq_get_default_council_state();
    $all_pricing = osl_cq_get_pricing();

    if (isset($_POST['osl_cq_save_defaults']) && check_admin_referer('osl_cq_defaults')) {
        $all_pricing['states'][$state]['default'] = osl_cq_build_pricing_from_post($_POST);
        if (!isset($all_pricing['states'][$state]['councils'])) {
            $all_pricing['states'][$state]['councils'] = array();
        }
        osl_cq_update_pricing($all_pricing);
        echo '<div class="osl-cq-success">✓ QLD default pricing saved successfully!</div>';
    }

    $pricing = $all_pricing['states'][$state]['default'] ?? osl_cq_convert_flat_pricing_to_nested(osl_cq_get_default_pricing());
    ?>
    <div class="wrap osl-cq-wrap">
        <h1>⚖️ Conveyancing Pricing — QLD Default Rates</h1>
        <p>These state-level prices apply to all QLD conveyancing quotes. Council-specific rates search and water meter reading fees are managed separately.</p>

        <form method="post">
            <?php wp_nonce_field('osl_cq_defaults'); ?>

            <div class="osl-cq-tabs">
                <?php foreach (osl_cq_get_transaction_types() as $type => $type_label): ?>
                    <div class="osl-cq-tab <?php echo $type === 'purchase' ? 'active' : ''; ?>" data-tab="<?php echo esc_attr($type); ?>"><?php echo esc_html($type_label); ?></div>
                <?php endforeach; ?>
            </div>

            <?php foreach (osl_cq_get_transaction_types() as $type => $type_label): ?>
            <div class="osl-cq-tab-content <?php echo $type === 'purchase' ? 'active' : ''; ?>" id="tab-<?php echo esc_attr($type); ?>">
                <div class="osl-cq-section">
                    <h2><?php echo esc_html($type_label); ?></h2>
                    <?php foreach (osl_cq_get_property_types() as $pkey => $plabel): ?>
                        <h3><?php echo esc_html($plabel); ?></h3>
                        <div class="osl-cq-grid">
                            <?php foreach (osl_cq_get_fee_fields($type, $pkey) as $fkey => $flabel):
                                $flat = osl_cq_flatten_property_pricing($pricing[$type][$pkey] ?? array());
                                $val = $flat[$fkey] ?? 0;
                            ?>
                                <div class="osl-cq-field">
                                    <label><?php echo esc_html($flabel); ?></label>
                                    <input type="number" step="0.01" name="<?php echo esc_attr("{$type}[{$pkey}][{$fkey}]"); ?>" value="<?php echo esc_attr($val); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <p><input type="submit" name="osl_cq_save_defaults" class="button button-primary button-gold" value="💾 Save QLD Default Pricing"></p>
        </form>
    </div>

    <script>
    jQuery(function($){
        $('.osl-cq-tab').on('click', function(){
            var tab = $(this).data('tab');
            $('.osl-cq-tab').removeClass('active');
            $(this).addClass('active');
            $('.osl-cq-tab-content').removeClass('active');
            $('#tab-'+tab).addClass('active');
        });
    });
    </script>
    <?php
}

// ============================================
// COUNCIL PRICING PAGE
// ============================================
function osl_cq_overrides_page() {
    $state = osl_cq_get_default_council_state();
    $councils = osl_cq_get_council_choices();
    $all_pricing = osl_cq_get_pricing();
    $all_pricing['states'][$state]['councils'] = $all_pricing['states'][$state]['councils'] ?? array();
    $selected_council = sanitize_text_field($_GET['council'] ?? ($_POST['council_key'] ?? ''));

    if (isset($_POST['osl_cq_save_council_pricing']) && check_admin_referer('osl_cq_council_pricing')) {
        $selected_council = sanitize_text_field($_POST['council_key'] ?? '');
        $posted_pricing = osl_cq_build_council_pricing_from_post($_POST['pricing'] ?? array(), $has_value);

        if ($selected_council !== '') {
            if ($has_value) {
                $all_pricing['states'][$state]['councils'][$selected_council] = $posted_pricing;
                echo '<div class="osl-cq-success">✓ Council pricing saved!</div>';
            } else {
                unset($all_pricing['states'][$state]['councils'][$selected_council]);
                echo '<div class="osl-cq-success">✓ Blank council pricing removed. Council rates search and water meter reading now default to $0 for this council.</div>';
            }
            osl_cq_update_pricing($all_pricing);
        }
    }

    if (isset($_GET['remove_council_pricing']) && check_admin_referer('remove_council_pricing_' . $_GET['remove_council_pricing'])) {
        $remove_key = sanitize_text_field($_GET['remove_council_pricing']);
        unset($all_pricing['states'][$state]['councils'][$remove_key]);
        osl_cq_update_pricing($all_pricing);
        if ($selected_council === $remove_key) {
            $selected_council = '';
        }
        echo '<div class="osl-cq-success">✓ Council pricing removed. Council rates search and water meter reading now default to $0.</div>';
    }

    $council_pricing = ($selected_council !== '' && isset($all_pricing['states'][$state]['councils'][$selected_council]))
        ? $all_pricing['states'][$state]['councils'][$selected_council]
        : null;
    $form_pricing = $council_pricing ?? array();
    ?>
    <div class="wrap osl-cq-wrap">
        <h1>⚖️ Council Pricing</h1>
        <p>Council pricing is limited to purchase disbursements that vary by council. If a council has no saved values, rates search and water meter reading default to $0.</p>

        <div class="osl-cq-section">
            <h2>Select Council</h2>
            <form method="get">
                <input type="hidden" name="page" value="osl-cq-overrides">
                <select name="council">
                    <option value="">— Select Council —</option>
                    <?php foreach ($councils as $key => $council): ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_council, $key); ?>>
                            <?php echo esc_html($council['name']); ?> (<?php echo esc_html($council['state']); ?>)<?php echo isset($all_pricing['states'][$state]['councils'][$key]) ? ' — custom pricing' : ' — default'; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="button">Load Council</button>
            </form>
        </div>

        <?php if ($selected_council !== ''): ?>
            <form method="post">
                <?php wp_nonce_field('osl_cq_council_pricing'); ?>
                <input type="hidden" name="council_key" value="<?php echo esc_attr($selected_council); ?>">
                <div class="osl-cq-section">
                    <h2>
                        <?php echo esc_html($councils[$selected_council]['name'] ?? $selected_council); ?>
                        <?php if ($council_pricing !== null): ?>
                            <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=osl-cq-overrides&council=' . $selected_council . '&remove_council_pricing=' . $selected_council), 'remove_council_pricing_' . $selected_council)); ?>" class="button" style="float:right;color:red;" onclick="return confirm('Remove this council pricing block?')">✕ Remove Council Pricing</a>
                        <?php endif; ?>
                    </h2>
                    <?php if ($council_pricing === null): ?>
                        <p class="osl-cq-muted">No council-specific pricing exists yet. Blank values are treated as $0 until saved.</p>
                    <?php endif; ?>

                    <?php $type = 'purchase'; ?>
                    <h3>Purchasing Council Disbursements</h3>
                    <?php foreach (osl_cq_get_property_types() as $pkey => $plabel): ?>
                        <h3><?php echo esc_html($plabel); ?></h3>
                        <div class="osl-cq-grid">
                            <?php foreach (osl_cq_get_council_fee_fields($type, $pkey) as $fkey => $flabel):
                                $flat = osl_cq_flatten_property_pricing($form_pricing[$type][$pkey] ?? array());
                                $val = $flat[$fkey] ?? '';
                            ?>
                                <div class="osl-cq-field">
                                    <label><?php echo esc_html($flabel); ?></label>
                                    <input type="number" step="0.01" name="pricing[<?php echo esc_attr($type); ?>][<?php echo esc_attr($pkey); ?>][<?php echo esc_attr($fkey); ?>]" value="<?php echo esc_attr($val); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <p><input type="submit" name="osl_cq_save_council_pricing" class="button button-primary button-gold" value="💾 Save Council Pricing"></p>
            </form>
        <?php endif; ?>
    </div>

    <script>
    jQuery(function($){
        $('.osl-cq-tab').on('click', function(){
            var tab = $(this).data('tab');
            $(this).closest('.osl-cq-section').find('.osl-cq-tab').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.osl-cq-section').find('.osl-cq-tab-content').removeClass('active');
            $('#tab-'+tab).addClass('active');
        });
    });
    </script>
    <?php
}

// ============================================
// MANAGE COUNCILS PAGE
// ============================================
function osl_cq_councils_page() {
    $councils = osl_cq_get_council_choices();
    $state = osl_cq_get_default_council_state();

    if (isset($_POST['osl_cq_save_councils']) && check_admin_referer('osl_cq_councils')) {
        if (!empty($_POST['new_council_name'])) {
            $name = sanitize_text_field($_POST['new_council_name']);
            $new_state = sanitize_text_field($_POST['new_council_state'] ?? $state);
            $existing = get_option('osl_cq_councils', array());
            $existing = osl_cq_normalize_councils($existing);
            $existing[] = array('key' => sanitize_title($name), 'name' => $name, 'state' => $new_state ?: $state);
            $existing = osl_cq_normalize_councils($existing);
            update_option('osl_cq_councils', $existing);
            $councils = osl_cq_get_council_choices();
            echo '<div class="osl-cq-success">✓ Added: ' . esc_html($name) . '</div>';
        }
    }

    if (isset($_GET['remove_council']) && check_admin_referer('remove_council_' . $_GET['remove_council'])) {
        $key = sanitize_text_field($_GET['remove_council']);
        $existing = array_values(array_filter(get_option('osl_cq_councils', array()), function($council) use ($key) {
            return osl_cq_get_council_key($council) !== $key;
        }));
        update_option('osl_cq_councils', osl_cq_normalize_councils($existing));

        $pricing = osl_cq_get_pricing();
        unset($pricing['states'][$state]['councils'][$key]);
        osl_cq_update_pricing($pricing);

        $councils = osl_cq_get_council_choices();
        echo '<div class="osl-cq-success">✓ Council removed</div>';
    }

    ?>
    <div class="wrap osl-cq-wrap">
        <h1>⚖️ Manage Councils</h1>
        <p>Add or remove councils from the quote form dropdown. Currently <strong><?php echo count($councils); ?></strong> councils.</p>

        <div class="osl-cq-section">
            <h2>Add New Council</h2>
            <form method="post">
                <?php wp_nonce_field('osl_cq_councils'); ?>
                <input type="text" name="new_council_name" placeholder="e.g. Gold Coast" style="padding:8px;width:300px;">
                <input type="hidden" name="new_council_state" value="<?php echo esc_attr($state); ?>">
                <input type="submit" name="osl_cq_save_councils" class="button button-gold" value="+ Add Council">
            </form>
        </div>

        <div class="osl-cq-section">
            <h2>Current Councils</h2>
            <div class="osl-cq-council-list">
                <?php foreach ($councils as $key => $council): ?>
                    <div class="osl-cq-council-item">
                        <span><?php echo esc_html($council['name']); ?> <small class="osl-cq-muted"><?php echo esc_html($council['state']); ?></small></span>
                        <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=osl-cq-councils&remove_council=' . $key), 'remove_council_' . $key)); ?>"
                           onclick="return confirm('Remove <?php echo esc_js($council['name']); ?>?')"
                           style="color:red;text-decoration:none;">✕</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}

// ============================================
// HELPER FUNCTIONS
// ============================================
function osl_cq_get_property_types() {
    return array(
        'house' => 'House (includes GST)',
        'unit_townhouse_duplex' => 'Unit/Townhouse/Duplex (includes GST)',
        'land' => 'Land (includes GST)',
    );
}

function osl_cq_get_default_fee_fields($type, $property_type, $state = null) {
    $type = osl_cq_normalize_transaction_type($type);
    $state = function_exists('osl_cq_normalize_state') ? osl_cq_normalize_state($state ?: osl_cq_get_default_council_state()) : 'QLD';

    if ($type === 'purchase') {
        if ($state === 'NSW') {
            $fields = array(
                'professional_fee' => 'Professional Fee',
                'title_search' => 'Title Search',
                'section_603_certificate' => 'Rate Search Section 603 Certificate',
                'special_meter_reading' => 'Special Meter Reading',
                'section_66_certificate' => 'Water Rates Section 66 Certificate',
            );

            if ($property_type === 'unit_townhouse_duplex') {
                $fields['section_184_certificate'] = 'Section 184 Certificate (Strata Information Certificate)';
            }

            $fields['identity_check'] = 'Identity Check';

            return $fields;
        }

        return array(
            'professional_fee' => 'Professional Fee',
            'title_search' => 'Title Search',
            'registered_plan' => 'Registered Plan',
            'land_tax' => 'Land Tax',
            'identity_check' => 'Identity Check',
        );
    }

    if ($state === 'NSW') {
        $fields = array(
            'professional_fee' => 'Professional Fee',
            'title_search' => 'Title Search',
            'dealings_on_title' => 'Dealings on Title per Search',
            'prepare_contract_of_sale' => 'Prepare Contract of Sale',
            'section_10_7_2_certificate' => 'Section 10.7(2) Certificate',
            'sewer_service_diagram' => 'Sewer Service Diagram',
            'service_location_print' => 'Service Location Print',
            'certificate_of_land_tax' => 'Certificate of Land Tax',
            'registered_plan' => 'Registered Plan',
        );

        if ($property_type === 'unit_townhouse_duplex') {
            $fields['title_search_common_property'] = 'Title Search Common Property';
            $fields['body_corporate_bylaws'] = 'Body Corporate Bylaws';
        }

        $fields['identity_check'] = 'Identity Check';

        return $fields;
    }

    return array(
        'professional_fee' => 'Professional Fee',
        'title_search' => 'Title Search',
        'identity_check' => 'Identity Check',
    );
}

function osl_cq_get_council_fee_fields($type, $property_type) {
    $type = osl_cq_normalize_transaction_type($type);

    if ($type !== 'purchase') {
        return array();
    }

    $water_label = ($property_type === 'land')
        ? 'Water Rates Search (if water connected)'
        : 'Water Rates Search';

    return array(
        'rates_search' => 'Council Rates Search',
        'water_meter_reading' => $water_label,
    );
}

function osl_cq_get_quote_fee_fields($type, $property_type) {
    $type = osl_cq_normalize_transaction_type($type);
    $fields = osl_cq_get_default_fee_fields($type, $property_type);

    if ($type === 'purchase') {
        $fields = array_merge($fields, osl_cq_get_council_fee_fields($type, $property_type));
    }

    return $fields;
}

function osl_cq_get_fee_fields($type, $property_type) {
    return osl_cq_get_default_fee_fields($type, $property_type);
}


// ============================================
// QUOTE ACTIVITY PAGE
// ============================================
function osl_cq_activity_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    osl_cq_maybe_install_events_table();

    $per_page = 100;
    $paged = max(1, absint($_GET['paged'] ?? 1));
    $offset = ($paged - 1) * $per_page;
    $event_filter = osl_cq_sanitize_quote_activity_event_filter($_GET['event_name'] ?? '');
    $events = osl_cq_get_recent_quote_events_filtered($per_page, $offset, $event_filter);
    $total = osl_cq_count_quote_events_filtered($event_filter);
    $total_pages = max(1, (int) ceil($total / $per_page));

    $export_args = array(
        'osl_cq_activity_action' => 'export',
    );
    if ($event_filter !== '') {
        $export_args['event_name'] = $event_filter;
    }
    $export_url = wp_nonce_url(osl_cq_quote_activity_admin_url($export_args), 'osl_cq_export_activity');

    $confirm_delete = sanitize_key($_GET['confirm_delete'] ?? '');
    ?>
    <div class="wrap osl-cq-wrap osl-cq-activity-wrap">
        <h1>
            Quote Activity
            <a class="page-title-action osl-cq-export-button" href="<?php echo esc_url($export_url); ?>">Export CSV</a>
        </h1>

        <?php if (isset($_GET['osl_cq_deleted'])): ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html(absint($_GET['osl_cq_deleted'])); ?> quote activity record(s) deleted.</p></div>
        <?php endif; ?>
        <?php if (($_GET['osl_cq_notice'] ?? '') === 'retention_saved'): ?>
            <div class="notice notice-success is-dismissible"><p>Quote activity retention setting saved.</p></div>
        <?php endif; ?>

        <p>Recent conveyancing quote generation and quote-result CTA events. Showing up to <?php echo esc_html($per_page); ?> records per page.</p>
        <p class="description">quote_generated records a completed quote. CTA clicked and Email columns populate only when a visitor clicks a result action or voluntarily supplies email details.</p>

        <div class="osl-cq-activity-toolbar">
            <form method="get" action="<?php echo esc_url(admin_url('admin.php')); ?>">
                <input type="hidden" name="page" value="osl-cq-activity">
                <label for="event_name">Filter by event</label>
                <select name="event_name" id="event_name">
                    <option value="">All events</option>
                    <?php foreach (osl_cq_quote_activity_allowed_events() as $event_name): ?>
                        <option value="<?php echo esc_attr($event_name); ?>" <?php selected($event_filter, $event_name); ?>><?php echo esc_html($event_name); ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="button">Filter</button>
                <a class="button button-primary" href="<?php echo esc_url($export_url); ?>">Export CSV</a>
            </form>
        </div>

        <div class="postbox" style="padding:14px 16px;margin-top:16px;">
            <h2 style="margin-top:0;">Retention and deletion tools</h2>

            <form method="post" style="margin-bottom:12px;">
                <input type="hidden" name="page" value="osl-cq-activity">
                <input type="hidden" name="osl_cq_activity_action" value="save_retention">
                <?php wp_nonce_field('osl_cq_save_activity_retention'); ?>
                <label for="retention_days">Automatic retention cleanup</label>
                <select name="retention_days" id="retention_days">
                    <?php foreach (osl_cq_quote_activity_retention_options() as $value => $label): ?>
                        <option value="<?php echo esc_attr($value); ?>" <?php selected(osl_cq_get_quote_activity_retention(), $value); ?>><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="button">Save retention</button>
                <p class="description">Cleanup runs from WordPress admin requests at most once daily, never on the public quote form.</p>
            </form>

            <form method="post" style="margin-bottom:12px;">
                <input type="hidden" name="page" value="osl-cq-activity">
                <input type="hidden" name="osl_cq_activity_action" value="delete_older_than">
                <?php wp_nonce_field('osl_cq_activity_delete_older_than'); ?>
                <label for="delete_older_than_days">Delete records older than</label>
                <select name="delete_older_than_days" id="delete_older_than_days">
                    <option value="30">30 days</option>
                    <option value="90">90 days</option>
                    <option value="180">180 days</option>
                    <option value="365">365 days</option>
                </select>
                <button class="button" onclick="return confirm('Delete old quote activity records?');">Delete old records</button>
            </form>

            <?php if ($event_filter !== ''): ?>
                <p><a class="button" href="<?php echo esc_url(osl_cq_quote_activity_admin_url(array('event_name' => $event_filter, 'confirm_delete' => 'filtered'))); ?>">Delete all filtered activity</a></p>
            <?php endif; ?>
            <p><a class="button" href="<?php echo esc_url(osl_cq_quote_activity_admin_url(array('confirm_delete' => 'all'))); ?>">Delete all activity</a></p>

            <?php if ($confirm_delete === 'all' || ($confirm_delete === 'filtered' && $event_filter !== '')): ?>
                <div class="notice notice-warning inline">
                    <p><strong>Confirm deletion.</strong> This permanently deletes quote activity records only.</p>
                    <form method="post">
                        <input type="hidden" name="page" value="osl-cq-activity">
                        <input type="hidden" name="osl_cq_activity_action" value="confirm_delete">
                        <input type="hidden" name="delete_scope" value="<?php echo esc_attr($confirm_delete); ?>">
                        <input type="hidden" name="event_name" value="<?php echo esc_attr($event_filter); ?>">
                        <?php wp_nonce_field('osl_cq_activity_confirm_delete'); ?>
                        <button class="button button-primary">Yes, delete <?php echo $confirm_delete === 'filtered' ? 'filtered' : 'all'; ?> activity</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <h2>
            Recent activity
            <a class="button button-primary" href="<?php echo esc_url($export_url); ?>">Export CSV</a>
        </h2>
        <p><?php echo esc_html($total); ?> event(s) logged<?php echo $event_filter ? ' for ' . esc_html($event_filter) : ''; ?>.</p>

        <form method="post">
            <input type="hidden" name="page" value="osl-cq-activity">
            <input type="hidden" name="osl_cq_activity_action" value="delete_selected">
            <?php wp_nonce_field('osl_cq_activity_bulk_delete'); ?>

            <table class="widefat striped">
                <thead>
                    <tr>
                        <th style="width:32px;"><input type="checkbox" onclick="jQuery('.osl-cq-activity-checkbox').prop('checked', this.checked);"></th>
                        <th>Date/time</th>
                        <th>Event</th>
                        <th>Transaction type</th>
                        <th>Property type</th>
                        <th>Council</th>
                        <th>Suburb / page path</th>
                        <th>Quote total / band</th>
                        <th>CTA clicked</th>
                        <th>Email</th>
                        <th>Source / medium / campaign</th>
                        <th>Page</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($events)): ?>
                        <tr><td colspan="12">No quote activity has been logged yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><input class="osl-cq-activity-checkbox" type="checkbox" name="activity_ids[]" value="<?php echo esc_attr(absint($event['id'])); ?>"></td>
                                <td><?php echo esc_html($event['created_at']); ?></td>
                                <td><code><?php echo esc_html($event['event_name']); ?></code></td>
                                <td><?php echo esc_html($event['transaction_type']); ?></td>
                                <td><?php echo esc_html($event['property_type']); ?></td>
                                <td><?php echo esc_html($event['council']); ?></td>
                                <td>
                                    <?php if (!empty($event['suburb'])): ?>
                                        <strong><?php echo esc_html($event['suburb']); ?></strong><br>
                                    <?php endif; ?>
                                    <span class="osl-cq-muted"><?php echo esc_html($event['page_path']); ?></span>
                                </td>
                                <td>
                                    <?php
                                    if ($event['quote_total'] !== null && $event['quote_total'] !== '') {
                                        echo esc_html('$' . number_format((float) $event['quote_total'], 2));
                                    }
                                    if (!empty($event['quote_total_band'])) {
                                        echo '<br><span class="osl-cq-muted">' . esc_html($event['quote_total_band']) . '</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo esc_html(osl_cq_quote_activity_extra_value($event, 'link_url')); ?></td>
                                <td><?php echo esc_html($event['email']); ?></td>
                                <td><?php echo esc_html(trim(($event['utm_source'] ?: '—') . ' / ' . ($event['utm_medium'] ?: '—') . ' / ' . ($event['utm_campaign'] ?: '—'))); ?></td>
                                <td>
                                    <?php if (!empty($event['page_url'])): ?>
                                        <a href="<?php echo esc_url($event['page_url']); ?>" target="_blank" rel="noopener">Open source page</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <p><button class="button" onclick="return confirm('Delete selected quote activity records?');">Delete selected</button></p>
        </form>

        <?php if ($total_pages > 1): ?>
            <div class="tablenav bottom">
                <div class="tablenav-pages">
                    <?php
                    echo paginate_links(array(
                        'base' => add_query_arg('paged', '%#%'),
                        'format' => '',
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                        'total' => $total_pages,
                        'current' => $paged,
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
