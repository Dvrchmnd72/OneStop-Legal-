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
        'Council Overrides',
        'Council Overrides',
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
        .osl-cq-override-row { display: grid; grid-template-columns: 200px 1fr 80px; gap: 10px; align-items: start; padding: 15px; background: #f9f9f9; border-radius: 4px; margin: 10px 0; }
        .osl-cq-override-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .osl-cq-override-field { display: flex; justify-content: space-between; align-items: center; padding: 4px 8px; }
        .osl-cq-override-field input { width: 100px; }
        .button-gold { background: #C5A267 !important; border-color: #B08C4A !important; color: #fff !important; }
        .button-gold:hover { background: #B08C4A !important; }
        .osl-cq-council-list { column-count: 3; column-gap: 20px; }
        .osl-cq-council-item { break-inside: avoid; padding: 6px 10px; margin: 4px 0; background: #f9f9f9; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
    </style>';
});

// ============================================
// DEFAULT PRICING PAGE
// ============================================
function osl_cq_pricing_page() {
    if (isset($_POST['osl_cq_save_defaults']) && check_admin_referer('osl_cq_defaults')) {
        $pricing = array();
        foreach (array('purchasing', 'selling') as $type) {
            foreach (osl_cq_get_property_types() as $pkey => $plabel) {
                foreach (osl_cq_get_fee_fields($type, $pkey) as $fkey => $flabel) {
                    if ($fkey === 'professional_fee_discount') {
                        $pricing[$type][$pkey][$fkey] = sanitize_text_field($_POST[$type][$pkey][$fkey] ?? '');
                    } else {
                        $pricing[$type][$pkey][$fkey] = floatval($_POST[$type][$pkey][$fkey] ?? 0);
                    }
                }
            }
        }
        update_option('osl_cq_default_pricing', $pricing);
        echo '<div class="osl-cq-success">✓ Default pricing saved successfully!</div>';
    }

    $pricing = get_option('osl_cq_default_pricing', osl_cq_get_default_pricing());
    ?>
    <div class="wrap osl-cq-wrap">
        <h1>⚖️ Conveyancing Pricing — Default Rates</h1>
        <p>These prices apply to <strong>ALL councils</strong> unless overridden. Change a price here and it updates everywhere instantly.</p>

        <form method="post">
            <?php wp_nonce_field('osl_cq_defaults'); ?>

            <div class="osl-cq-tabs">
                <div class="osl-cq-tab active" data-tab="purchasing">Purchasing</div>
                <div class="osl-cq-tab" data-tab="selling">Selling</div>
            </div>

            <?php foreach (array('purchasing' => 'Purchasing a Property', 'selling' => 'Selling a Property') as $type => $type_label): ?>
            <div class="osl-cq-tab-content <?php echo $type === 'purchasing' ? 'active' : ''; ?>" id="tab-<?php echo $type; ?>">
                <div class="osl-cq-section">
                    <h2><?php echo $type_label; ?></h2>
                    <?php foreach (osl_cq_get_property_types() as $pkey => $plabel): ?>
                        <h3><?php echo $plabel; ?></h3>
                        <div class="osl-cq-grid">
                            <?php foreach (osl_cq_get_fee_fields($type, $pkey) as $fkey => $flabel):
                                $val = $pricing[$type][$pkey][$fkey] ?? 0;
                            ?>
                                <div class="osl-cq-field">
                                    <label><?php echo $flabel; ?></label>
                                    <?php if ($fkey === 'professional_fee_discount'): ?>
                                        <select name="<?php echo "{$type}[{$pkey}][{$fkey}]"; ?>">
                                            <option value="" <?php selected($val, ''); ?>>None</option>
                                            <option value="fixed" <?php selected($val, 'fixed'); ?>>Fixed ($)</option>
                                            <option value="percentage" <?php selected($val, 'percentage'); ?>>Percentage (%)</option>
                                        </select>
                                    <?php else: ?>
                                        <input type="number" step="0.01" name="<?php echo "{$type}[{$pkey}][{$fkey}]"; ?>" value="<?php echo esc_attr($val); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <p><input type="submit" name="osl_cq_save_defaults" class="button button-primary button-gold" value="💾 Save Default Pricing"></p>
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
// COUNCIL OVERRIDES PAGE
// ============================================
function osl_cq_overrides_page() {
    $councils = get_option('osl_cq_councils', array());
    $overrides = get_option('osl_cq_council_overrides', array());
    $defaults = get_option('osl_cq_default_pricing', osl_cq_get_default_pricing());

    // Save overrides
    if (isset($_POST['osl_cq_save_overrides']) && check_admin_referer('osl_cq_overrides')) {
        $new_overrides = array();
        if (!empty($_POST['override'])) {
            foreach ($_POST['override'] as $council_key => $types) {
                foreach ($types as $type => $ptypes) {
                    foreach ($ptypes as $ptype => $fields) {
                        foreach ($fields as $fkey => $fval) {
                            if ($fval !== '' && $fval !== null) {
                                if ($fkey === 'professional_fee_discount') {
                                    $new_overrides[$council_key][$type][$ptype][$fkey] = sanitize_text_field($fval);
                                } else {
                                    $clean = floatval($fval);
                                    $default_val = $defaults[$type][$ptype][$fkey] ?? 0;
                                    if ($clean != $default_val) {
                                        $new_overrides[$council_key][$type][$ptype][$fkey] = $clean;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        update_option('osl_cq_council_overrides', $new_overrides);
        $overrides = $new_overrides;
        echo '<div class="osl-cq-success">✓ Council overrides saved!</div>';
    }

    ?>
    <div class="wrap osl-cq-wrap">
        <h1>⚖️ Council Price Overrides</h1>
        <p>Only add overrides where a council's pricing <strong>differs from the defaults</strong>. Leave blank = uses default price.</p>

        <form method="post">
            <?php wp_nonce_field('osl_cq_overrides'); ?>

            <div style="margin-bottom:15px;">
                <label><strong>Add override for council:</strong></label>
                <select id="osl-add-council">
                    <option value="">— Select Council —</option>
                    <?php foreach ($councils as $key => $name): ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php echo isset($overrides[$key]) ? 'disabled' : ''; ?>>
                            <?php echo esc_html($name); ?> <?php echo isset($overrides[$key]) ? '(already added)' : ''; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="button" id="osl-add-override-btn" class="button">+ Add Override</button>
            </div>

            <div id="osl-overrides-container">
            <?php foreach ($overrides as $council_key => $council_data):
                $council_name = $councils[$council_key] ?? $council_key;
            ?>
                <div class="osl-cq-section osl-override-block" data-council="<?php echo esc_attr($council_key); ?>">
                    <h2><?php echo esc_html($council_name); ?> <button type="button" class="button osl-remove-override" style="float:right;color:red;">✕ Remove</button></h2>
                    <?php foreach (array('purchasing', 'selling') as $type): ?>
                        <h3><?php echo ucfirst($type); ?></h3>
                        <?php foreach (osl_cq_get_property_types() as $pkey => $plabel): ?>
                            <h4 style="color:#666;margin:10px 0 5px;"><?php echo $plabel; ?></h4>
                            <div class="osl-cq-grid">
                            <?php foreach (osl_cq_get_fee_fields($type, $pkey) as $fkey => $flabel):
                                $override_val = $council_data[$type][$pkey][$fkey] ?? '';
                                $default_val = $defaults[$type][$pkey][$fkey] ?? 0;
                            ?>
                                <div class="osl-cq-field">
                                    <label><?php echo $flabel; ?> <small style="color:#999;">(default: <?php echo is_numeric($default_val) ? '$'.number_format($default_val,2) : $default_val; ?>)</small></label>
                                    <?php if ($fkey === 'professional_fee_discount'): ?>
                                        <select name="override[<?php echo $council_key; ?>][<?php echo $type; ?>][<?php echo $pkey; ?>][<?php echo $fkey; ?>]">
                                            <option value="">Use default</option>
                                            <option value="fixed" <?php selected($override_val, 'fixed'); ?>>Fixed ($)</option>
                                            <option value="percentage" <?php selected($override_val, 'percentage'); ?>>Percentage (%)</option>
                                        </select>
                                    <?php else: ?>
                                        <input type="number" step="0.01" name="override[<?php echo $council_key; ?>][<?php echo $type; ?>][<?php echo $pkey; ?>][<?php echo $fkey; ?>]" value="<?php echo esc_attr($override_val); ?>" placeholder="<?php echo esc_attr($default_val); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            </div>

            <p><input type="submit" name="osl_cq_save_overrides" class="button button-primary button-gold" value="💾 Save Council Overrides"></p>
        </form>
    </div>

    <script>
    jQuery(function($){
        $('#osl-add-override-btn').on('click', function(){
            var council = $('#osl-add-council').val();
            if(!council) return alert('Please select a council');
            location.href = location.href + '&add_council=' + council;
        });
        $('.osl-remove-override').on('click', function(){
            if(confirm('Remove this council override? It will revert to default pricing.')){
                $(this).closest('.osl-override-block').remove();
            }
        });
    });
    </script>
    <?php
}

// ============================================
// MANAGE COUNCILS PAGE
// ============================================
function osl_cq_councils_page() {
    $councils = get_option('osl_cq_councils', array());

    if (isset($_POST['osl_cq_save_councils']) && check_admin_referer('osl_cq_councils')) {
        if (!empty($_POST['new_council_name'])) {
            $name = sanitize_text_field($_POST['new_council_name']);
            $key = sanitize_title($name);
            $councils[$key] = $name;
            asort($councils);
            update_option('osl_cq_councils', $councils);
            echo '<div class="osl-cq-success">✓ Added: ' . esc_html($name) . '</div>';
        }
    }

    if (isset($_GET['remove_council']) && check_admin_referer('remove_council_' . $_GET['remove_council'])) {
        $key = sanitize_text_field($_GET['remove_council']);
        unset($councils[$key]);
        update_option('osl_cq_councils', $councils);
        $overrides = get_option('osl_cq_council_overrides', array());
        unset($overrides[$key]);
        update_option('osl_cq_council_overrides', $overrides);
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
                <input type="submit" name="osl_cq_save_councils" class="button button-gold" value="+ Add Council">
            </form>
        </div>

        <div class="osl-cq-section">
            <h2>Current Councils</h2>
            <div class="osl-cq-council-list">
                <?php foreach ($councils as $key => $name): ?>
                    <div class="osl-cq-council-item">
                        <span><?php echo esc_html($name); ?></span>
                        <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=osl-cq-councils&remove_council=' . $key), 'remove_council_' . $key); ?>" 
                           onclick="return confirm('Remove <?php echo esc_js($name); ?>?')"
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

function osl_cq_get_fee_fields($type, $property_type) {
    $fields = array(
        'professional_fee' => 'Professional Fee',
    );

    if ($type === 'purchasing') {
        $fields['title_search'] = 'Title Search';
        $fields['registered_plan'] = 'Registered Plan';
        $fields['rates_search'] = 'Rates Search';

        if ($property_type === 'house') {
            $fields['water_meter_reading'] = 'Water Meter Reading';
            $fields['land_tax'] = 'Land Tax';
            $fields['final_title_search'] = 'Final Title Search';
            $fields['identity_check'] = 'Identity Check';
        } elseif ($property_type === 'unit_townhouse_duplex') {
            $fields['water_meter_reading'] = 'Water Meter Reading';
            $fields['information_certificate'] = 'Body Corporate Levies Certificate';
            $fields['land_tax'] = 'Land Tax';
            $fields['final_title_search'] = 'Final Title Search';
            $fields['identity_check'] = 'Identity Check';
        } elseif ($property_type === 'land') {
            $fields['water_meter_reading'] = 'Water Meter Reading';
            $fields['land_tax'] = 'Land Tax';
            $fields['identity_check'] = 'Identity Check';
        }
    } else {
        // Selling
        $fields['title_search'] = 'Title Search';
        $fields['identity_check'] = 'Identity Check';
    }

    return $fields;
}

function osl_cq_get_price($council_key, $type, $property_type, $fee_key) {
    $overrides = get_option('osl_cq_council_overrides', array());
    if (isset($overrides[$council_key][$type][$property_type][$fee_key])) {
        return $overrides[$council_key][$type][$property_type][$fee_key];
    }
    $defaults = get_option('osl_cq_default_pricing', array());
    return $defaults[$type][$property_type][$fee_key] ?? 0;
}
