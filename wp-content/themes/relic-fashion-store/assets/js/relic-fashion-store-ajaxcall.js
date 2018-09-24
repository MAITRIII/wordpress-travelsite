

/***************************************************************************
*								Project Tab Ajax Call 
***************************************************************************/
jQuery(document).ready(function () {
    
    // Sticky Header JS
    var newsIndex = []; 
    for(var i=0, len=localStorage.length; i<len; i++){
        var key = localStorage.key(i);
        if(key == null) continue;
        var value = localStorage[key];
        if(key.search('news_section') >= 0){
            newsIndex.push(key);
        }
    }
    for(var i = 0 ; i <= newsIndex.length; i ++){
        localStorage.removeItem(newsIndex[i]);
    }

    jQuery('.relic-products-tab').on('click', 'li.relic-products-tabs-title', function(e) {
        
        e.preventDefault();
        var select_category_id = jQuery( this ).attr( 'select_category_id' );
        var tab_product_count = jQuery( this ).attr('product_count');


        var widget = jQuery(this).closest(".news_class");

        var id = jQuery(widget).attr('id');

        var storage_id = id + "-" +select_category_id;

        var data = localStorage.getItem(storage_id);

        var that = jQuery(this);

        var relic_fahion_store_tab_content = that.closest(".products-tab-wraper").find(".products-tab-section");
        relic_fahion_store_tab_content.css("background:white");

        jQuery.ajax({
            url : RELIC_FASHION_STORE.ajaxurl,
            type : 'post',
            data : {
                action : 'category_tab_products',
                post_id : select_category_id,
                prduct_count : tab_product_count
            },
            success : function( response ) {
                setTimeout(function () {
                    localStorage.setItem(storage_id, data);
                    jQuery(relic_fahion_store_tab_content).html(response);

                    jQuery(window).trigger('resize');

                    //new
                    jQuery(".products-tab-slider1").owlCarousel({
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

                }, 1000);  
                
            },
            beforeSend: function() {
                jQuery(relic_fahion_store_tab_content).html('<br /><br /><div class="ajax-loader" style="color:white;height:320px; position:absolute; left:45%"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only"></span></div>');
                }
        });
                    
    });     
});
