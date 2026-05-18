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
})();
