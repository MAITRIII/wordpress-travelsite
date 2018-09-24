jQuery(document).ready(function() {

    /* Site Main Menu animation */
    if (jQuery(window).width() >= '751') {
        jQuery('.site-navigation nav.main-menu li').hover(function() {
            jQuery(this).children('ul').stop(true, true).slideDown(200);
        }, function() {
            jQuery(this).children('ul').stop(true, true).slideUp(200);
        });
    }

    jQuery('.site-navigation nav.main-menu li ul li a').hover(function() {
        jQuery(this).stop(true, true).velocity({
            paddingLeft: "23px"
        }, 150);
    }, function() {
        jQuery(this).stop(true, true).velocity({
            paddingLeft: "20px"
        }, 150);
    });

    /*  MeanMenu Responsive Nav */
    if (jQuery().meanmenu) {
        jQuery('nav.main-menu').meanmenu({
            meanMenuClose: '<i class="fa fa-times"></i>',
            meanExpand: "+",
            meanContract: "-",
            meanMenuContainer: '#responsive-menu-container',
            meanScreenWidth: "767",
            meanRemoveAttrs: true
        });
    }

    /* Scroll to Top */
    jQuery(function() {
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > 250) {
                jQuery('a#scroll-top').fadeIn();
            } else {
                jQuery('a#scroll-top').fadeOut();
            }
        });
        jQuery('a#scroll-top').on('click', function(event) {
            event.preventDefault();
            jQuery('html, body').velocity("scroll", {
                duration: 750,
                easing: "swing"
            });
        });
    });

    /* Owl carousel */
    if (jQuery('#home-slider .owl-carousel').length) {
        jQuery("#home-slider .owl-carousel").owlCarousel({
          items: 1,
          margin: 0,
          nav: true,
          // dots:false,
          singleItem: true,
          loop: true,
          autoplay: true,
          autoHeight:true,
          autoplayHoverPause:true,

        });
    }


}); //End jQuery
