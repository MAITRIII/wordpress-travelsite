
// tab 
jQuery(document).ready(function($){
	
	$('ul.tabs li').click(function(){
    var parent = $(this).parents(".product");
    var tab_id = $(this).attr('data-tab');

    parent.find('ul.tabs li').removeClass('current');
    parent.find('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
})

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');

jQuery(".quantity-button").live("click", function() {

  var $button = jQuery(this);
  var inputBox = $button.parent().parent().find("input");
  var oldValue = inputBox.val();

  if ($button.text() == "+") {
    var newVal = parseFloat(oldValue) + 1;
  } else {
   // Don't allow decrementing below zero
    if (oldValue > 0) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 0;
    }
  }

  inputBox.val(newVal);
  inputBox.trigger("change");
  

});

// mobile menu
  jQuery(document).ready(function () {
      jQuery('header nav').meanmenu();
  });


// slider
jQuery("#slide").owlCarousel({
    items : 1,
    itemsCustom : false,
    itemsDesktop : [1199, 1],
    itemsDesktopSmall : [979, 1],
    itemsTablet : [768, 1],
    itemsTabletSmall : true,
    itemsMobile : [480, 1],
    autoPlay : 4000,
    navigation : true,
    navigationText : ["<img src='img/left-arrow.png'>","<img src='img/right-arrow.png'>"]
  });

  //Products Slider items
  jQuery(".products-tab-slider").owlCarousel({
    items : 3,
    itemsCustom : false,
    itemsDesktop : [1199, 3],
    itemsDesktopSmall : [979, 2],
    itemsTablet : [768, 2],
    itemsTabletSmall : true,
    itemsMobile : [480, 1],
    autoPlay : 4000,
    navigation : false,
    
  });


  jQuery("#instagram").owlCarousel({
    items : 3,
    itemsCustom : false,
    itemsDesktop : [1199, 3],
    itemsDesktopSmall : [979, 3],
    itemsTablet : [768, 2],
    itemsTabletSmall : true,
    itemsMobile : [480, 1],
    navigation : false,
    autoPlay : 4000
  });

  
  jQuery("#big-slide").owlCarousel({
    items : 1,
    itemsCustom : false,
    itemsDesktop : [1199, 1],
    itemsDesktopSmall : [979, 1],
    itemsTablet : [768, 1],
    itemsTabletSmall : true,
    itemsMobile : [480, 1],
    navigation : false,
    autoPlay : 5000
  });


// popup login
var modal = document.getElementById('login');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// popup wishlist
var modal = document.getElementById('wishlist');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// popup detail_page
var modal = document.getElementById('detail_page');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// popup detail_page
var modal = document.getElementById('signup');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// last-margin remove
var i = 1 ;
jQuery(".recent_blog_post .item.grid-item-3").each(function(){
  if( i % 3 ==0){ jQuery(this).css("margin", 0); }
  i++;
});


// JavaScript Document
jQuery(function(){
  
  //BACK TO TOP
  jQuery("body").append('<div class="backtotop"><i class="fa fa-angle-up fa-lg" aria-hidden="true"></i></div>');
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 10) {
      jQuery('.backtotop').fadeIn();
    } else {
      jQuery('.backtotop').fadeOut();
    }
  });

  jQuery(".backtotop").click(function(){ 
     jQuery("html, body").animate({scrollTop: 0}, 1000);
  }); // END BACK TO TOP

});

