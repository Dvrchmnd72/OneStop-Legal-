<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_osl_cq_calculate', 'osl_cq_calculate');
add_action('wp_ajax_nopriv_osl_cq_calculate', 'osl_cq_calculate');

function osl_cq_calculate() {
    check_ajax_referer('osl_cq_nonce', 'nonce');

    $type = sanitize_text_field($_POST['property_for'] ?? 'purchasing');
    $council_key = sanitize_text_field($_POST['council'] ?? '');
    $property_type = sanitize_text_field($_POST['property_type'] ?? 'house');

    $councils = get_option('osl_cq_councils', array());
    $council_name = $councils[$council_key] ?? $council_key;
    $property_types = osl_cq_get_property_types();
    $property_label = $property_types[$property_type] ?? $property_type;
    $type_label = ($type === 'purchasing') ? 'Purchase' : 'Selling';

    $fee_fields = osl_cq_get_fee_fields($type, $property_type);

    $professional_fee = floatval(osl_cq_get_price($council_key, $type, $property_type, 'professional_fee'));
    $discount_type = osl_cq_get_price($council_key, $type, $property_type, 'professional_fee_discount');
    $discount_amount = floatval(osl_cq_get_price($council_key, $type, $property_type, 'discount_amount'));

    $has_discount = !empty($discount_type) && $discount_amount > 0;
    $discounted_fee = $professional_fee;
    if ($has_discount) {
        if ($discount_type === 'fixed') {
            $discounted_fee = $professional_fee - $discount_amount;
        } else {
            $discounted_fee = $professional_fee - ($professional_fee * ($discount_amount / 100));
        }
    }

    $prof_html = '';
    if ($has_discount) {
        $prof_html .= '<tr><td>' . $type_label . ' ' . $property_label . '</td>';
        $prof_html .= '<td><del>$' . number_format($professional_fee, 2) . '</del></td></tr>';
        $dl = ($discount_type === 'fixed') ? '$' . number_format($discount_amount, 2) : $discount_amount . '%';
        $prof_html .= '<tr><td>*' . $dl . ' website discount</td>';
        $prof_html .= '<td>$' . number_format($discounted_fee, 2) . '</td></tr>';
    } else {
        $prof_html .= '<tr><td>' . $type_label . ' ' . $property_label . '</td>';
        $prof_html .= '<td>$' . number_format($professional_fee, 2) . '</td></tr>';
    }

    $disb_html = '';
    $disb_total = 0;
    $skip_fields = array('professional_fee', 'professional_fee_discount', 'discount_amount', 'seller_disclosure');
    foreach ($fee_fields as $fkey => $flabel) {
        if (in_array($fkey, $skip_fields)) continue;
        $val = floatval(osl_cq_get_price($council_key, $type, $property_type, $fkey));
        if ($val > 0) {
            $disb_total += $val;
            $disb_html .= '<tr><td>' . esc_html($flabel) . '</td>';
            $disb_html .= '<td>$' . number_format($val, 2) . '</td></tr>';
        }
    }

    $sd_fee = ($type === 'selling') ? floatval(osl_cq_get_price($council_key, $type, $property_type, 'seller_disclosure')) : 0;
    $total = $discounted_fee + $disb_total + $sd_fee;

    $html = '<div class="osl-cq-result-inner">';
    $html .= '<h2>Your Conveyancing Quote — ' . esc_html($council_name) . '</h2>';
    $html .= '<div class="osl-cq-summary"><div class="osl-cq-summary-columns"><div class="osl-cq-summary-left">';
    $html .= '<div class="osl-cq-summary-header"><h4>PROFESSIONAL FEE</h4></div>';
    $html .= '<table class="osl-cq-summary-table">' . $prof_html . '</table>';
    $html .= '<div class="osl-cq-summary-header"><h4>DISBURSEMENTS</h4></div>';
    $html .= '<table class="osl-cq-summary-table">' . $disb_html . '</table>';
    if ($type === 'selling' && $sd_fee > 0) {
        $html .= '<div class="osl-cq-disclosure-notice" style="background:#fff8e1;border-left:4px solid #C5A267;padding:14px 18px;margin:16px 0;border-radius:6px;">';
        $html .= '<strong>&#9432; Seller Disclosure Statement &mdash; $' . number_format($sd_fee, 2) . '</strong>';
        $html .= '<p style="margin:6px 0 0;font-size:0.88em;color:#555;">As of 1 August 2025, Queensland law requires all sellers to provide a Disclosure Statement to the buyer prior to signing a contract. This fee covers preparation of the statement and all required property searches. Failure to provide this can give the buyer the right to terminate the contract.</p>';
        $html .= '</div>';
    }
    $html .= '<div class="osl-cq-summary-total"><table><tr><td><h3>TOTAL</h3></td><td><h3>$' . number_format($total, 2) . '</h3></td></tr></table></div>';
    $html .= '</div>';
    $html .= '<div class="osl-cq-summary-right"><div class="osl-cq-summary-header"><h4>OPTIONAL SERVICES</h4></div>';
    $html .= '<table class="osl-cq-summary-table osl-cq-optional">';
    $html .= '<tr><td>Pre-signing contract review for standard REIQ contract</td></tr>';
    $html .= '<tr><td>Pre-signing contract review for "Off the Plan" contracts<br><small><em>(Comprehensive review of the contract and letter to client summarising key terms)</em></small></td></tr>';
    $html .= '<tr><td>Preparation of the contract for sale<br><small><em>(If you do not have an agent we can prepare the contract of sale)</em></small></td></tr>';
    $html .= '</table></div>';
    $html .= '</div></div>';
    $html .= '</div>';

    wp_send_json_success(array('html' => $html));
}

add_action('wp_ajax_osl_cq_unlock', 'osl_cq_unlock');
add_action('wp_ajax_nopriv_osl_cq_unlock', 'osl_cq_unlock');

function osl_cq_unlock() {
    check_ajax_referer('osl_cq_nonce', 'nonce');
    $email = sanitize_email($_POST['email'] ?? '');
    $type = sanitize_text_field($_POST['property_for'] ?? '');
    $council_key = sanitize_text_field($_POST['council'] ?? '');
    $property_type = sanitize_text_field($_POST['property_type'] ?? '');

    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }

    // Save the lead
    osl_cq_save_lead($email, $type, $council_key, $property_type);

    // Build and send the quote email
    $councils = get_option('osl_cq_councils', array());
    $council_name = $councils[$council_key] ?? $council_key;
    $property_types = osl_cq_get_property_types();
    $property_label = $property_types[$property_type] ?? $property_type;
    $type_label = ($type === 'purchasing') ? 'Purchase' : 'Selling';

    $fee_fields = osl_cq_get_fee_fields($type, $property_type);
    $professional_fee = floatval(osl_cq_get_price($council_key, $type, $property_type, 'professional_fee'));
    $discount_type = osl_cq_get_price($council_key, $type, $property_type, 'professional_fee_discount');
    $discount_amount = floatval(osl_cq_get_price($council_key, $type, $property_type, 'discount_amount'));

    $has_discount = !empty($discount_type) && $discount_amount > 0;
    $discounted_fee = $professional_fee;
    if ($has_discount) {
        if ($discount_type === 'fixed') {
            $discounted_fee = $professional_fee - $discount_amount;
        } else {
            $discounted_fee = $professional_fee - ($professional_fee * ($discount_amount / 100));
        }
    }

    $prof_rows = '';
    if ($has_discount) {
        $prof_rows .= '<tr><td style="padding:10px;">' . $type_label . ' ' . $property_label . ' (' . $council_name . ')</td><td style="padding:10px;text-align:right;"><del>$' . number_format($professional_fee, 2) . '</del></td></tr>';
        $dl = ($discount_type === 'fixed') ? '$' . number_format($discount_amount, 2) : $discount_amount . '%';
        $prof_rows .= '<tr><td style="padding:10px;">*' . $dl . ' website discount applied</td><td style="padding:10px;text-align:right;">$' . number_format($discounted_fee, 2) . '</td></tr>';
    } else {
        $prof_rows .= '<tr><td style="padding:10px;">' . $type_label . ' ' . $property_label . ' (' . $council_name . ')</td><td style="padding:10px;text-align:right;">$' . number_format($professional_fee, 2) . '</td></tr>';
    }

    $skip_fields = array('professional_fee', 'professional_fee_discount', 'discount_amount', 'seller_disclosure');
    $disb_rows = '';
    $disb_total = 0;
    foreach ($fee_fields as $fkey => $flabel) {
        if (in_array($fkey, $skip_fields)) continue;
        $val = floatval(osl_cq_get_price($council_key, $type, $property_type, $fkey));
        if ($val > 0) {
            $disb_total += $val;
            $disb_rows .= '<tr><td style="padding:10px;">' . $flabel . '</td><td style="padding:10px;text-align:right;">$' . number_format($val, 2) . '</td></tr>';
        }
    }
    $sd_fee = ($type === 'selling') ? floatval(osl_cq_get_price($council_key, $type, $property_type, 'seller_disclosure')) : 0;
    $total = $discounted_fee + $disb_total + $sd_fee;

    $disclosure_rows = '';
    if ($type === 'selling' && $sd_fee > 0) {
        $disclosure_rows .= '<tr><td colspan="2" style="padding:0;"><div style="background:#fff8e1;border-left:4px solid #C5A267;padding:14px 18px;margin:8px 0;border-radius:6px;">';
        $disclosure_rows .= '<strong>&#9432; Seller Disclosure Statement &mdash; $' . number_format($sd_fee, 2) . '</strong>';
        $disclosure_rows .= '<p style="margin:6px 0 0;font-size:0.88em;color:#555;">As of 1 August 2025, Queensland law requires all sellers to provide a Disclosure Statement to the buyer prior to signing a contract. This fee covers preparation of the statement and all required property searches. Failure to provide this can give the buyer the right to terminate the contract.</p>';
        $disclosure_rows .= '</div></td></tr>';
    }

    $site_url = get_option('siteurl');
    $admin_email = get_option('admin_email', 'info@onestoplegal.com.au');
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: OneStop Legal <noreply@onestoplegal.com.au>'
    );

    // Email to user
    $user_greeting = 'Hi there,<p>Thank you for using our online conveyancing quote calculator. Please find your quote summary below.</p><p>If you have any questions, contact us at <a href="mailto:' . $admin_email . '">' . $admin_email . '</a> or call us to discuss your property transaction.</p>';
    $email_body = osl_cq_build_email($prof_rows, $disb_rows, $disclosure_rows, $total, '', '', $email, '', '', $site_url);
    $user_body = str_replace('%%GREETING%%', $user_greeting, $email_body);
    wp_mail($email, 'Your Conveyancing Quote from OneStop Legal', $user_body, $headers);

    // Email to admin
    $admin_greeting = 'Hi,<p>A new lead has unlocked a conveyancing quote on the website.</p><p><strong>Email:</strong> ' . esc_html($email) . '<br><strong>Type:</strong> ' . esc_html($type_label) . ' ' . esc_html($property_label) . '<br><strong>Council:</strong> ' . esc_html($council_name) . '</p>';
    $admin_body = str_replace('%%GREETING%%', $admin_greeting, $email_body);
    wp_mail($admin_email, 'New Quote Lead: ' . $email . ' - ' . $type_label . ' ' . $property_label, $admin_body, $headers);

    // Schedule follow-up
    $follow_up_time = time() + (24 * 60 * 60);
    wp_schedule_single_event($follow_up_time, 'osl_cq_send_followup', array($email, $type, $council_key, $property_type));

    wp_send_json_success(array('message' => 'unlocked'));
}

function osl_cq_build_email($prof_rows, $disb_rows, $disclosure_rows, $total, $first_name, $last_name, $email, $mobile, $address, $site_url) {
    return '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
    <body style="background:#f1f1f1;font-family:Arial,sans-serif;font-size:14px;color:#333;margin:0;padding:0;">
    <div style="max-width:700px;margin:0 auto;padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;">
    <tr><td style="background:#1B2E4A;padding:30px;text-align:center;">
        <h1 style="color:#C5A267;margin:0;font-size:28px;">OneStop Legal</h1>
        <p style="color:#ffffff;margin:8px 0 0;font-size:14px;">Your Trusted Conveyancing Partner</p>
    </td></tr>
    <tr><td style="padding:30px;">
    %%GREETING%%
    <h3 style="color:#1B2E4A;border-bottom:2px solid #C5A267;padding-bottom:10px;">QUOTE SUMMARY</h3>
    <div style="border:1px solid #e0e0e0;border-radius:6px;overflow:hidden;margin:15px 0;">
        <div style="background:#1B2E4A;color:#fff;padding:10px 20px;"><strong>PROFESSIONAL FEE</strong></div>
        <table width="100%" cellpadding="0" cellspacing="0">' . $prof_rows . '</table>
        <div style="background:#1B2E4A;color:#fff;padding:10px 20px;"><strong>DISBURSEMENTS</strong></div>
        <table width="100%" cellpadding="0" cellspacing="0">' . $disb_rows . '</table>' . $disclosure_rows . '
        <table width="100%" cellpadding="15" cellspacing="0" style="background:#1B2E4A;">
        <tr><td style="color:#fff;"><strong style="font-size:18px;">TOTAL</strong></td><td style="color:#fff;text-align:right;"><strong style="font-size:18px;">$' . number_format($total, 2) . '</strong></td></tr>
        </table>
    </div>
    <div style="text-align:center;margin:30px 0;">
        <a href="' . $site_url . '/contact/" style="background:#C5A267;color:#fff;padding:15px 40px;border-radius:30px;text-decoration:none;font-weight:bold;font-size:16px;display:inline-block;">GET IN TOUCH</a>
    </div>
    <p style="color:#888;font-size:12px;text-align:center;">This quote is an estimate only. Final costs may vary depending on the complexity of your transaction.</p>
    </td></tr>
    <tr><td style="background:#C5A267;padding:20px;text-align:center;">
        <a href="' . $site_url . '" style="color:#fff;text-decoration:none;font-weight:bold;">onestoplegal.com.au</a>
        <p style="color:#fff;margin:5px 0 0;font-size:12px;">Your Trusted Legal Partner on the Gold Coast</p>
    </td></tr>
    </table></div></body></html>';
}

function osl_cq_save_lead($email, $type, $council, $property_type) {
    $leads = get_option('osl_cq_leads', array());
    $leads[] = array(
        'email' => $email,
        'type' => $type,
        'council' => $council,
        'property_type' => $property_type,
        'date' => current_time('mysql'),
        'status' => 'gate_unlocked',
    );
    update_option('osl_cq_leads', $leads);
}

add_action('osl_cq_send_followup', 'osl_cq_followup_email', 10, 4);

function osl_cq_followup_email($email, $type, $council, $property_type) {
    $site_url = get_option('siteurl');
    $tl = ($type === 'purchasing') ? 'purchasing' : 'selling';
    $subject = 'Your Property Transaction - How We Can Help Further';
    $body = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
    <body style="background:#f1f1f1;font-family:Arial,sans-serif;font-size:14px;color:#333;margin:0;padding:0;">
    <div style="max-width:700px;margin:0 auto;padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;">
    <tr><td style="background:#1B2E4A;padding:30px;text-align:center;">
        <h1 style="color:#C5A267;margin:0;font-size:28px;">OneStop Legal</h1>
    </td></tr>
    <tr><td style="padding:30px;">
        <h2 style="color:#1B2E4A;">Thanks for your interest in our conveyancing services</h2>
        <p>You recently got a quote for ' . $tl . ' a property. Here are our other services that may help:</p>
        <div style="background:#f9f9f9;border-left:4px solid #C5A267;padding:20px;margin:20px 0;">
            <h3 style="color:#1B2E4A;margin-top:0;">Contract Review</h3>
            <p>Let our team review your contract to ensure your interests are protected.</p>
        </div>
        <div style="background:#f9f9f9;border-left:4px solid #C5A267;padding:20px;margin:20px 0;">
            <h3 style="color:#1B2E4A;margin-top:0;">Property Due Diligence</h3>
            <p>Comprehensive property searches covering council records, flood mapping, and more.</p>
        </div>
        <div style="background:#f9f9f9;border-left:4px solid #C5A267;padding:20px;margin:20px 0;">
            <h3 style="color:#1B2E4A;margin-top:0;">Will and Estate Planning</h3>
            <p>The perfect time to update your Will and ensure your estate plan is current.</p>
        </div>
        <div style="text-align:center;margin:30px 0;">
            <a href="' . $site_url . '/contact/" style="background:#C5A267;color:#fff;padding:15px 40px;border-radius:30px;text-decoration:none;font-weight:bold;display:inline-block;">BOOK A FREE CONSULTATION</a>
        </div>
    </td></tr>
    <tr><td style="background:#C5A267;padding:20px;text-align:center;">
        <a href="' . $site_url . '" style="color:#fff;text-decoration:none;font-weight:bold;">onestoplegal.com.au</a>
    </td></tr>
    </table></div></body></html>';
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: OneStop Legal <noreply@onestoplegal.com.au>'
    );
    wp_mail($email, $subject, $body, $headers);
}

// Improve email deliverability
add_filter('wp_mail_from', 'osl_cq_mail_from');
function osl_cq_mail_from($email) {
    return 'info@onestoplegal.com.au';
}

add_filter('wp_mail_from_name', 'osl_cq_mail_from_name');
function osl_cq_mail_from_name($name) {
    return 'OneStop Legal';
}

add_filter('wp_mail_content_type', 'osl_cq_mail_content_type');
function osl_cq_mail_content_type() {
    return 'text/html';
}
