jQuery(document).ready(function($){
    $('.stats').find('.grid').waypoint( function() {
       var timeout = 500; 
       $('.stats').find('.grid').find('.raratheme-sc-holder').each(function(){
            var id = $(this).find('.hs-counter').attr('id');
            setTimeout(function() {
                $('.odometer'+id).html($('.odometer'+id).data('count'));
            }, timeout);
            timeout = parseInt(timeout)+500;            
       });           
    }, 
    {
        offset: 800,
        triggerOnce: true
    });
    
    if( tac_data.rtl == '1' ){
        var rtl = true;
    }else{
        rtl = false;
    }
    
    //Activities Slider
    $('#activities-slider').owlCarousel({
        margin   : 30,
        nav      : true,
        dots     : false,
        rtl      : rtl,
        lazyLoad : true,
        navText: ['<svg height="43" width="43"><circle id="circle" cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> ', ' <svg height="43" width="43"><circle cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> '],
        responsive : {
            1025 : {
                items : 4
            },
            768 : {
                items: 2
            },
            0: {
                items: 1
            }
        }
    });
    
    //popular destination slider
	$('#destination-slider').owlCarousel({
		margin   : 0,
		nav      : true,
		dots     : false,
		items    : 1,
        lazyLoad : true,
        rtl      : rtl,
        navText: ['<svg height="45" width="45"><circle id="circle" cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> ', ' <svg height="43" width="43"><circle cx="22" cy="22" r="20" transform="rotate(-90, 22, 22)"/></svg> ']
	});
});