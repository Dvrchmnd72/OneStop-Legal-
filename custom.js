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

  function getUTM(param) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param) || '';
  }

  function pushTrackingEvent(eventName, extraData) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(Object.assign({
      event: eventName,
      page_path: window.location.pathname,
      page_title: document.title,
      page_location: window.location.href,
      device_type: window.innerWidth < 768 ? 'mobile' : 'desktop',
      utm_source: getUTM('utm_source'),
      utm_medium: getUTM('utm_medium'),
      utm_campaign: getUTM('utm_campaign')
    }, extraData || {}));
  }

  var quoteForm = document.querySelector('#quote-section form, form[action*="quote"]');
  if (quoteForm) {
    var quoteEventsFired = {};
    var quoteResultViewed = false;

    function trackQuoteEvent(name, extra) {
      if (quoteEventsFired[name]) return;
      quoteEventsFired[name] = true;
      pushTrackingEvent(name, extra);
    }

    function isElementVisible(el) {
      if (!el) return false;
      var style = window.getComputedStyle(el);
      return style.display !== 'none' && style.visibility !== 'hidden' && el.offsetParent !== null;
    }

    function submitEmailToCRM(email) {
      var action = quoteForm.getAttribute('action');
      if (!action) return;
      var payload = new FormData(quoteForm);
      payload.set('soft_gate_email', email);
      payload.set('submitted_after_quote', '1');
      if (quoteForm.querySelector('input[name*="email" i]')) {
        var fieldName = quoteForm.querySelector('input[name*="email" i]').name;
        payload.set(fieldName, email);
      }
      fetch(action, {
        method: (quoteForm.getAttribute('method') || 'POST').toUpperCase(),
        body: payload,
        credentials: 'same-origin'
      }).catch(function(){});
    }

    function ensureSoftGate() {
      if (document.getElementById('quote-email-soft-gate')) return;
      var quoteContainer = document.getElementById('quote-section') || quoteForm.parentElement;
      if (!quoteContainer) return;

      var wrapper = document.createElement('div');
      wrapper.id = 'quote-email-soft-gate';
      wrapper.className = 'quote-email-soft-gate';
      wrapper.innerHTML = '<div class="soft-gate-card">'
        + '<h3>Send Me a Detailed Breakdown</h3>'
        + '<p>Enter your email to receive a full PDF summary and next steps for your conveyancing.</p>'
        + '<form id="soft-gate-email-form"><div class="soft-gate-row">'
        + '<input type="email" id="soft-gate-email" name="soft_gate_email" placeholder="Your email address" required />'
        + '<button type="submit" class="btn-primary">Email My Quote</button>'
        + '</div></form>'
        + '<p class="micro-copy">No obligation. We respond within 2 business hours.</p>'
        + '</div>';

      quoteContainer.appendChild(wrapper);

      var softGateForm = document.getElementById('soft-gate-email-form');
      if (softGateForm) {
        softGateForm.addEventListener('submit', function(e) {
          e.preventDefault();
          var emailInput = document.getElementById('soft-gate-email');
          if (!emailInput || !emailInput.value) return;
          trackQuoteEvent('email_submitted_after_quote', { submitted_email: true });
          submitEmailToCRM(emailInput.value);
          this.innerHTML = '<p><strong>Thank you.</strong> Your detailed quote has been sent.</p>';
        });
      }

      var pdfLink = document.getElementById('quote-pdf-download');
      if (pdfLink) {
        pdfLink.addEventListener('click', function() {
          trackQuoteEvent('quote_pdf_download');
        });
      }
    }

    function unlockQuoteFormEmail() {
      quoteForm.querySelectorAll('input[type="email"], input[name*="email" i]').forEach(function(field) {
        field.required = false;
        field.removeAttribute('aria-required');
      });
    }

    var started = false;
    quoteForm.addEventListener('focusin', function() {
      if (started) return;
      started = true;
      OSLTracking.pushEvent('quote_start', { page: window.location.pathname });
    });

    quoteForm.addEventListener('submit', function() {
      OSLTracking.pushEvent('quote_submission', { page: window.location.pathname });
      unlockQuoteFormEmail();
      var calculatedTotal = (window.calculatedTotal || window.quoteTotal || '').toString();
      trackQuoteEvent('quote_calculated', calculatedTotal ? { quote_value: calculatedTotal } : {});
      setTimeout(function() {
        if (!quoteResultViewed) {
          quoteResultViewed = true;
          trackQuoteEvent('quote_viewed');
        }
        ensureSoftGate();
      }, 200);
    });

    unlockQuoteFormEmail();

    var observer = new MutationObserver(function() {
      if (quoteResultViewed) return;
      var result = document.querySelector('#quote-result, .quote-result, .quote-results, [data-quote-result]');
      if (result && isElementVisible(result)) {
        quoteResultViewed = true;
        trackQuoteEvent('quote_viewed');
        ensureSoftGate();
      }
    });
    observer.observe(document.body, { subtree: true, attributes: true, childList: true });
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
