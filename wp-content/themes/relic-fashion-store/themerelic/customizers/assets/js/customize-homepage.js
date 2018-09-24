
//Scroll to section
jQuery('body').on('click', 'ul#sub-accordion-panel-relic_fashion_store_homepage_panel li', function(event) {
    //li variable section
    var section_id = $(this).attr('id');
    scrollToSection( section_id );
});

//scroll funcions
function scrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {

        // Homepage Slider
        case 'accordion-section-relic_fashion_store_slider_section':
        preview_section_id = "homepage_banner_slider";
        break;

        //Homepage Service Box Section
        case 'accordion-section-relic_fashion_store_service_secction':
        preview_section_id = "homepage-service-box";
        break;

        //Homepage Tab Section
        case 'accordion-section-relic_fashion_store_products_tab_section':
        preview_section_id = "homepage-tab-section";
        break;

        //Homepage Single Products Section
        case 'accordion-section-relic_fashion_store_single_products_sec':
        preview_section_id = "homepage_single_products_sec";
        break;

        //Homepage Single Category And Products Section
        case 'accordion-section-relic_fashion_store_single_category_and_products':
        preview_section_id = "homepage_single_category_and_products_cat_id_select";
        break;

        //Homepage Category Products
        case 'accordion-section-products_and_category_slider_section':
        preview_section_id = "homepage-single-category-products";
        break;

        //Homepage Blog Section 
        case 'accordion-section-relic_fashion_store_blog_section':
        preview_section_id = "relic_fashion_blog_section";
        break;

        //Slider Instagram Feed
        case 'accordion-section-relic_fashion_store_instagram_feed':
        preview_section_id = "instagram_feed";
        break;
  
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

