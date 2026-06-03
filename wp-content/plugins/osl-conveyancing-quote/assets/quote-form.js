jQuery(document).ready(function($) {

    var quoteRequest = null;
    var quoteStarted = false;
    var lastQuoteData = {};

    function oslCqGetUrlParam(name) {
        try {
            return new URLSearchParams(window.location.search).get(name) || '';
        } catch (e) {
            return '';
        }
    }

    function oslCqPageContext() {
        var wrapper = $('#osl-cq-wrapper');
        return {
            page_path: (window.location && window.location.pathname) || (OslCQ.pagePath || ''),
            page_url: (window.location && window.location.href) || (OslCQ.pageUrl || ''),
            suburb: wrapper.data('suburb') || '',
            utm_source: oslCqGetUrlParam('utm_source'),
            utm_medium: oslCqGetUrlParam('utm_medium'),
            utm_campaign: oslCqGetUrlParam('utm_campaign'),
            utm_term: oslCqGetUrlParam('utm_term'),
            utm_content: oslCqGetUrlParam('utm_content'),
            gclid: oslCqGetUrlParam('gclid'),
            fbclid: oslCqGetUrlParam('fbclid')
        };
    }

    function oslCqFormContext(extra) {
        return $.extend({}, oslCqPageContext(), {
            transaction_type: $("input[name='osl_property_for']:checked").val() || '',
            state: $('#osl_state').val() || 'QLD',
            property_type: $('#osl_property_type').val() || '',
            council: (($('#osl_state').val() || 'QLD') === 'QLD')
                ? ($('#osl_council option:selected').text().trim() || $('#osl_council').val() || '')
                : ($('#osl_state option:selected').text().trim() || $('#osl_state').val() || '')
        }, extra || {});
    }

    function oslCqTrack(eventName, params) {
        var payload = $.extend({}, oslCqPageContext(), params || {});

        try {
            if (window.dataLayer && typeof window.dataLayer.push === 'function') {
                window.dataLayer.push($.extend({ event: eventName }, payload));
            }
        } catch (e) {}

        try {
            if (window.OSLTracking && typeof window.OSLTracking.pushEvent === 'function') {
                window.OSLTracking.pushEvent(eventName, payload);
            }
        } catch (e) {}
    }

    function oslCqEncodePayload(payload) {
        var pairs = [];

        $.each(payload || {}, function(key, value) {
            if (value === undefined || value === null) {
                return;
            }

            if (typeof value === 'object') {
                value = JSON.stringify(value);
            }

            pairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(value));
        });

        return pairs.join('&');
    }

    function oslCqLogEvent(eventName, params, preserveDuringNavigation) {
        var payload = $.extend({}, oslCqFormContext(), lastQuoteData, params || {}, {
            action: 'osl_cq_log_event',
            nonce: OslCQ.nonce,
            event_name: eventName
        });

        if (preserveDuringNavigation) {
            var encodedPayload = oslCqEncodePayload(payload);

            try {
                if (window.navigator && typeof window.navigator.sendBeacon === 'function') {
                    var beaconPayload = new Blob([encodedPayload], {
                        type: 'application/x-www-form-urlencoded;charset=UTF-8'
                    });

                    if (window.navigator.sendBeacon(OslCQ.ajaxurl, beaconPayload)) {
                        return;
                    }
                }
            } catch (e) {}

            try {
                if (window.fetch) {
                    window.fetch(OslCQ.ajaxurl, {
                        method: 'POST',
                        body: encodedPayload,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                        },
                        credentials: 'same-origin',
                        keepalive: true
                    }).catch(function() {});
                    return;
                }
            } catch (e) {}
        }

        $.ajax({
            type: 'POST',
            url: OslCQ.ajaxurl,
            data: payload,
            dataType: 'json'
        }).fail(function() {});
    }

    function oslCqMarkStarted(ctaLocation) {
        if (quoteStarted) return;
        quoteStarted = true;
        oslCqTrack('quote_started', oslCqFormContext({ cta_location: ctaLocation || 'quote_form' }));
    }

    function validateEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email);
    }

    function syncStateFields() {
        var state = $('#osl_state').val() || 'QLD';

        if (state === 'QLD') {
            $('.osl-cq-council-field').show();
        } else {
            $('.osl-cq-council-field').hide();
        }
    }

    syncStateFields();

    $(document).on('change', '#osl_state', function() {
        syncStateFields();
        $('#osl-cq-result').empty();
        lastQuoteData = {};
    });

    // Quote field interaction start tracking.
    $(document).on('focus change click', "#osl-cq-wrapper input, #osl-cq-wrapper select", function() {
        oslCqMarkStarted('quote_field');
    });

    // GET QUOTE
    $(document).on('click', '#osl-cq-get-quote', function(e) {
        e.preventDefault();
        oslCqMarkStarted('get_instant_quote_button');
        if (quoteRequest !== null) quoteRequest.abort();

        var btn = $(this);
        var data = $.extend({}, oslCqPageContext(), {
            action: 'osl_cq_calculate',
            nonce: OslCQ.nonce,
            property_for: $("input[name='osl_property_for']:checked").val(),
            state: $('#osl_state').val() || 'QLD',
            council: $('#osl_council').val(),
            property_type: $('#osl_property_type').val()
        });

        quoteRequest = $.ajax({
            type: 'POST', url: OslCQ.ajaxurl, data: data, dataType: 'json',
            beforeSend: function() {
                btn.html('<span class="osl-cq-loading"></span> Calculating...').prop('disabled', true);
                $('#osl-cq-result').html('<div style="text-align:center;padding:30px;"><span class="osl-cq-loading"></span> Loading your quote...</div>');
            },
            success: function(response) {
                btn.html('GET INSTANT QUOTE').prop('disabled', false);
                if (response.success) {
                    $('#osl-cq-result').html(response.data.html);
                    lastQuoteData = {
                        transaction_type: response.data.transaction_type || data.property_for || '',
                        state: response.data.state || data.state || $('#osl_state').val() || 'QLD',
                        property_type: response.data.property_type || data.property_type || '',
                        council: response.data.council || (($('#osl_state').val() || 'QLD') === 'QLD' ? $('#osl_council option:selected').text().trim() : $('#osl_state option:selected').text().trim()) || '',
                        suburb: response.data.suburb || oslCqPageContext().suburb || '',
                        quote_total: response.data.quote_total || '',
                        quote_total_band: response.data.quote_total_band || ''
                    };
                    oslCqTrack('quote_generated', oslCqFormContext(lastQuoteData));
                    $('html, body').animate({ scrollTop: $('#osl-cq-result').offset().top - ($(window).width() > 767 ? 100 : 10) }, 800);
                } else {
                    $('#osl-cq-result').html('<div style="color:red;padding:20px;">Error loading quote. Please try again.</div>');
                }
            },
            error: function(jqXhr, textStatus) {
                btn.html('GET INSTANT QUOTE').prop('disabled', false);
                if (textStatus !== 'abort') $('#osl-cq-result').html('<div style="color:red;padding:20px;">Error loading quote. Please try again.</div>');
            }
        });
    });

    // Optional legacy email quote flow if the email gate markup is present anywhere.
    $(document).on('click', '#osl-cq-unlock-btn', function(e) {
        e.preventDefault();
        var btn = $(this);
        var emailInput = $('#osl-cq-gate-email');
        var email = emailInput.val().trim();

        if (!email || !validateEmail(email)) {
            emailInput.addClass('osl-cq-error').attr('placeholder', 'Please enter a valid email').focus();
            return false;
        }
        emailInput.removeClass('osl-cq-error');

        var data = $.extend({}, oslCqPageContext(), {
            action: 'osl_cq_unlock',
            nonce: OslCQ.nonce,
            email: email,
            property_for: $("input[name='osl_property_for']:checked").val(),
            state: $('#osl_state').val() || 'QLD',
            council: $('#osl_council').val(),
            property_type: $('#osl_property_type').val()
        });

        $.ajax({
            type: 'POST', url: OslCQ.ajaxurl, data: data, dataType: 'json',
            beforeSend: function() {
                btn.html('<span class="osl-cq-loading"></span> Unlocking...').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    oslCqTrack('quote_email_clicked', oslCqFormContext($.extend({}, lastQuoteData, { cta_location: 'email_quote_gate', email: email })));

                    // 1. Reveal all hidden prices
                    $('.osl-cq-real-price').each(function() {
                        $(this).removeAttr('style');
                    });

                    // 2. Remove the dots
                    $('.osl-cq-dots').fadeOut(300, function() { $(this).remove(); });

                    // 3. Show total
                    $('.osl-cq-hidden-total').slideDown(500);

                    // 4. Replace gate box with confirmation
                    $('#osl-cq-gate').slideUp(500, function() {
                        $(this).replaceWith(
                            '<div class="osl-cq-confirmed" style="background:#f0faf0;border:2px solid #4CAF50;border-radius:12px;padding:25px;text-align:center;margin-top:20px;">' +
                            '<h3 style="color:#2e7d32;margin:0 0 10px 0;">&#10003; Quote Unlocked!</h3>' +
                            '<p style="color:#555;margin:0 0 15px 0;">A copy of this quote has been sent to <strong>' + email + '</strong></p>' +
                            '<p style="color:#555;margin:0 0 15px 0;">One of our conveyancing specialists will be in touch shortly.</p>' +
                            '<a href="/contact/" class="osl-cq-button osl-cq-result-contact" style="display:inline-block;">CONTACT US NOW</a>' +
                            '</div>'
                        );
                    });

                    // Scroll to total
                    setTimeout(function() {
                        $('html, body').animate({ scrollTop: $('.osl-cq-hidden-total').offset().top - 100 }, 800);
                    }, 600);
                } else {
                    btn.html('UNLOCK QUOTE').prop('disabled', false);
                    emailInput.addClass('osl-cq-error');
                }
            },
            error: function() {
                btn.html('UNLOCK QUOTE').prop('disabled', false);
            }
        });
    });

    // Enter key on gate email
    $(document).on('keypress', '#osl-cq-gate-email', function(e) {
        if (e.which === 13) { e.preventDefault(); $('#osl-cq-unlock-btn').click(); }
    });

    // Landing page action boxes
    $(document).on('click', '.osl-cq-action-box', function(e) {
        e.preventDefault();
        var target = $(this).data('for');
        var ctaLocation = $(this).data('cta-location') || 'quote_page_action_box';
        oslCqTrack('quote_page_cta_clicked', oslCqFormContext({ cta_location: ctaLocation, transaction_type: target || '' }));
        oslCqLogEvent('quote_page_cta_clicked', { cta_location: ctaLocation, transaction_type: target || '' });
        if (target) $("input[name='osl_property_for'][value='" + target + "']").prop('checked', true);
        $('html, body').animate({ scrollTop: $('.osl-cq-form-body').offset().top - ($(window).width() > 767 ? 200 : 10) }, 800);
    });

    $(document).on('click', '.osl-cq-result-contact, #osl-cq-result a[href*="/contact"]', function() {
        var payload = oslCqFormContext($.extend({}, lastQuoteData, {
            cta_location: 'quote_result',
            link_url: this.href || ''
        }));
        oslCqTrack('quote_contact_clicked', payload);
        oslCqLogEvent('quote_contact_clicked', payload, true);
    });

    $(document).on('click', '.osl-cq-result-email, #osl-cq-result a[href^="mailto:"]', function() {
        var email = (this.href || '').replace(/^mailto:/i, '').split('?')[0];
        var payload = oslCqFormContext($.extend({}, lastQuoteData, {
            cta_location: 'quote_result',
            link_url: this.href || '',
            email: email
        }));
        oslCqTrack('quote_email_clicked', payload);
        oslCqLogEvent('quote_email_clicked', payload, true);
    });

    $(document).on('click', '.osl-cq-result-phone, #osl-cq-result a[href^="tel:"]', function() {
        var phone = (this.href || '').replace(/^tel:/i, '');
        var payload = oslCqFormContext($.extend({}, lastQuoteData, {
            cta_location: 'quote_result',
            link_url: this.href || '',
            phone: phone
        }));
        oslCqTrack('quote_phone_clicked', payload);
        oslCqLogEvent('quote_phone_clicked', payload, true);
    });

    $(document).on('click', '.osl-cq-print-quote', function(e) {
        e.preventDefault();
        var payload = oslCqFormContext($.extend({}, lastQuoteData, { cta_location: 'quote_result_print_save' }));
        oslCqTrack('quote_download_clicked', payload);
        oslCqLogEvent('quote_download_clicked', payload);
        window.print();
    });
});
