    /**
 * Next Hour - Movie Tv Show & Video Subscription Portal Cms Web and Mobile App
 *
 * This file contains all template JS functions
 *
 * @package Next Hour
--------------------------------------------------------------
                   Contents
--------------------------------------------------------------

 * 01 Overlay On Click On Dropdown  
 * 02 Slide Effect
 * 03 Transform Effects
 * 04 Home Slider
 * 05 Genre Custom Slider 
 * 06 Genre Custom Slider 2
 * 07 Preloader

--------------------------------------------------------------*/
(function($) {

  // Overlay On Click On Dropdown  
  $('.prime-dropdown').on('click', function(){
    $('.body-overlay-bg').toggleClass('active');
  });

  $.protip({
    defaults: {
      placement: "border",
      animate: false,
      delayIn: 0,
      delayOut: 0,
      interactive: false,
      mixin: "css-no-transition"
    }
  });
  var mid_device = Modernizr.mq('(min-width: 1200px)');
  if (mid_device) {
    // Slide Effect
    var controller = new ScrollMagic.Controller();

    // Transform Effect
    // build tween for big main poster transform 
      var tween1 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#big-main-poster-block", 1, {top: 70}, {top: 350, ease: Linear.easeNone})
        ]);
    // build scene for big main poster transform
      var scene1 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height()})
        .setTween(tween1)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);

    // build tween big main poster blur and grayscale on offset
      var tween2 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#big-main-poster-block", 1, {'-webkit-filter':'blur(' + 0 + 'px' + ')' + 'grayscale(0)'}, {'-webkit-filter':'blur(' + 4 + 'px' + ')' + 'grayscale(80%)', ease: Linear.easeNone})
        ]);
    // build scene big main poster blur and grayscale on offset
      var scene2 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height(), offset: 200})
        .setTween(tween2)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);

    // build tween for big main poster overlay background on offset
      var tween3 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#big-main-poster-block .overlay-bg", 1, {opacity: 0}, {opacity: 1, ease: Linear.easeNone})
        ]);
    // build scene for big main poster overlay background on offset
      var scene3 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height(), offset: -400})
        .setTween(tween3)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);

    // build tween for poster thumbnail
      var tween4 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#poster-thumbnail", 1, {right: "-150%", opacity: 0}, {right: "15%", opacity: 1, ease: Linear.easeNone})
        ]);
    // build scene for poster thumbnail
      var scene4 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height(), offset: -330})
        .setTween(tween4)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);

    // build tween for full movie name
      var tween5 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#full-movie-name", 1, {fontSize: "43px"}, {fontSize: "33px", ease: Linear.easeNone})
        ]);
    // build scene for full movie name
      var scene5 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height(), offset: -280})
        .setTween(tween5)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);

    // build tween for full movie name
      var tween6 = new TimelineMax ()
        .add([
          TweenMax.fromTo("#big-main-poster-block .overlay-bg", 1, {background: "linear-gradient(0deg, rgba(17, 17, 17, 0.9) 20%, transparent 100%)"}, {backgroundColor: "rgba(17, 17, 17, 0.8)", ease: Linear.easeNone})
        ]);
    // build scene for full movie name
      var scene6 = new ScrollMagic.Scene({triggerElement: "#main-custom-wrapper", duration: $(window).height()})
        .setTween(tween6)
        // .addIndicators() // add indicators (requires plugin)
        .addTo(controller);    
  }

  // Home Slider


  // side humburger
$(document).ready(function () {
  var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;
    trigger.click(function () {
      hamburger_cross();
    });
    function hamburger_cross() {
      if (isClosed == true) {
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
  });
});
    
// screen Search
$(function () {
    $('a[href="#find"]').on('click', function(event) {
        event.preventDefault();
        $('#find').addClass('open');
        $('#find > form > input[type="find"]').focus();
    });
    $('#find, #find button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
});
     
})(jQuery);

