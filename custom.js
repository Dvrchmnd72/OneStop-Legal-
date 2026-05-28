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

  var quoteForm = document.querySelector('#quote-section form, form[action*="quote"]');
  if (quoteForm) {
    var started = false;
    quoteForm.addEventListener('focusin', function(){
      if (started) return;
      started = true;
      OSLTracking.pushEvent('quote_start', { page: window.location.pathname });
    });
    quoteForm.addEventListener('submit', function(){
      OSLTracking.pushEvent('quote_submission', { page: window.location.pathname });
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
