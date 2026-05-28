/* OneStop Legal — Custom JS */
(function(){
  var toggle = document.getElementById('osl-nav-toggle');
  var nav = document.getElementById('osl-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function(){
      nav.classList.toggle('is-open');
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', !expanded);
    });
  }

  window.dataLayer = window.dataLayer || [];
  window.OSLTracking = {
    pushEvent: function(eventName, params){
      window.dataLayer.push(Object.assign({ event: eventName }, params || {}));
    }
  };
  window.QUOTE_EMAIL_GATE_STRICT = (typeof window.QUOTE_EMAIL_GATE_STRICT === 'boolean') ? window.QUOTE_EMAIL_GATE_STRICT : false;

  function getUTMs(){
    var url = new URL(window.location.href);
    return {
      utm_source: url.searchParams.get('utm_source') || '',
      utm_medium: url.searchParams.get('utm_medium') || '',
      utm_campaign: url.searchParams.get('utm_campaign') || '',
      utm_term: url.searchParams.get('utm_term') || '',
      utm_content: url.searchParams.get('utm_content') || '',
      landing_page: window.location.pathname,
      device_type: window.innerWidth <= 768 ? 'mobile' : 'desktop'
    };
  }

  function hydrateTrackingFields(form){
    var data = getUTMs();
    Object.keys(data).forEach(function(key){
      var input = form.querySelector('input[name="' + key + '"]');
      if (!input) {
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        form.appendChild(input);
      }
      input.value = data[key];
    });
  }

  document.querySelectorAll('form').forEach(function(form){
    hydrateTrackingFields(form);
    form.addEventListener('submit', function(){
      OSLTracking.pushEvent('contact_form_submission', { form_id: form.id || 'unknown' });
    });
  });

  var quoteForm = document.querySelector('#quote-section form, form[action*="quote"]');
  if (quoteForm) {
    var quoteEventsFired = {};
    var pageMeta = getUTMs();
    function trackQuoteEvent(name, extra){
      if (quoteEventsFired[name]) return;
      quoteEventsFired[name] = true;
      OSLTracking.pushEvent(name, Object.assign({
        page_path: window.location.pathname,
        utm_source: pageMeta.utm_source,
        utm_medium: pageMeta.utm_medium,
        utm_campaign: pageMeta.utm_campaign,
        device_type: pageMeta.device_type
      }, extra || {}));
    }
    var started = false;
    quoteForm.addEventListener('focusin', function(){
      if (started) return;
      started = true;
      OSLTracking.pushEvent('quote_start', { page: window.location.pathname });
    });
    quoteForm.addEventListener('submit', function(){
      OSLTracking.pushEvent('quote_submission', { page: window.location.pathname });
    });

    quoteForm.addEventListener('submit', function(){
      trackQuoteEvent('quote_calculated');
      trackQuoteEvent('quote_completed');
    });

    quoteForm.addEventListener('change', function(e){
      var t = e.target;
      if (t && t.matches('input[type="email"], input[name*="email" i]')) {
        trackQuoteEvent('email_submitted_after_quote', { email_capture_mode: window.QUOTE_EMAIL_GATE_STRICT ? 'strict' : 'soft' });
      }
    });

    quoteForm.querySelectorAll('a,button').forEach(function(el){
      el.addEventListener('click', function(){
        var label = ((el.textContent || '') + ' ' + (el.getAttribute('href') || '')).toLowerCase();
        if (label.indexOf('pdf') !== -1 || label.indexOf('download') !== -1) {
          trackQuoteEvent('quote_pdf_download');
        }
      });
    });

    setTimeout(function(){ trackQuoteEvent('quote_viewed'); }, 250);

    if (!window.QUOTE_EMAIL_GATE_STRICT) {
      var emailField = quoteForm.querySelector('input[type="email"], input[name*="email" i]');
      if (emailField) {
        emailField.required = false;
        emailField.setAttribute('data-soft-gate', 'true');
        if (!quoteForm.querySelector('.osl-quote-email-helper')) {
          var helper = document.createElement('p');
          helper.className = 'osl-quote-email-helper';
          helper.textContent = 'Where should we send your detailed quote summary? (Optional)';
          emailField.parentNode.insertBefore(helper, emailField);
        }
      }
    }
  }

  if (window.location.pathname.indexOf('/conveyancing') !== -1) {
    document.querySelectorAll('section,div,article,li').forEach(function(node){
      var text = (node.textContent || '').trim().toLowerCase();
      if (text === 'no unconditional contract, no fee policy') {
        node.remove();
      }
    });
  }

  document.querySelectorAll('a[href^="tel:"]').forEach(function(a){
    a.addEventListener('click', function(){
      OSLTracking.pushEvent('click_to_call', { phone: a.getAttribute('href').replace('tel:','') });
    });
  });

  [50, 90].forEach(function(threshold){
    var fired = false;
    window.addEventListener('scroll', function(){
      if (fired) return;
      var scrolled = ((window.scrollY + window.innerHeight) / document.body.scrollHeight) * 100;
      if (scrolled >= threshold) {
        fired = true;
        OSLTracking.pushEvent('scroll_depth', { percent: threshold });
      }
    }, { passive: true });
  });
})();
