jQuery(document).ready(function($) {
  // Mobile menu toggle
  $('.osl-mobile-toggle').on('click', function() {
    $('.osl-mobile-nav').addClass('active');
    $('.osl-mobile-overlay').addClass('active');
    $('body').css('overflow', 'hidden');
  });

  $('.osl-mobile-nav-close, .osl-mobile-overlay').on('click', function() {
    $('.osl-mobile-nav').removeClass('active');
    $('.osl-mobile-overlay').removeClass('active');
    $('body').css('overflow', '');
  });
});
