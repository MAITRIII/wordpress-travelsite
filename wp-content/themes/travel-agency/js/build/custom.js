jQuery(document).ready(function($){	
    //wow animatioin in site
	var wow = new WOW({});
	wow.init();

	//Header Search form show/hide
    $('html').click(function() {
        $('.site-header .form-holder').slideUp();
    });

    $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });
    $("#btn-search").click(function() {
        $(".site-header .form-holder").slideToggle();
        return false;
    });

    //mobile menu
    var winWidth = $(window).width();
    if (winWidth < 1025) {
        $('#site-navigation ul li.menu-item-has-children').append('<span class="fa fa-caret-down"></span>');
        $('#site-navigation ul li .fa').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#primary-toggle-button').click(function() {
            $('.main-navigation').slideToggle();
        });
    }
});