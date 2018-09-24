<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       raratheme.com
 * @since      1.0.0
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/public/partials
 */

/**
 * Return about section title
*/
function travel_agency_companion_get_about_title(){
    return get_theme_mod( 'about_us_title', __( 'Create Your Travel Booking Website with Travel Agency Theme', 'travel-agency-companion' ) );
}

/**
 * Return about section content
*/
function travel_agency_companion_get_about_content(){
    return wpautop( get_theme_mod( 'about_us_desc', __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

            Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.
            
            It is also translation ready. So you can translate your website in any language.', 'travel-agency-companion' ) ) );
}

/**
 * Return about section btn label
*/
function travel_agency_companion_get_about_label(){
    return get_theme_mod( 'about_us_readmore', __( 'View More', 'travel-agency-companion' ) );
}

/**
 * Return activities section title
*/
function travel_agency_companion_get_activities_title(){
    return get_theme_mod( 'activities_title', __( 'Adventure Activities', 'travel-agency-companion' ) );
}

/**
 * Return activities section content
*/
function travel_agency_companion_get_activities_content(){
    return wpautop( get_theme_mod( 'activities_desc', __( 'This is the best place to tell your visitors what travel services your company provide. You can modify this section from Appearance > Customize > Home Page Settings > Adventure Activities Section on your WordPress.', 'travel-agency-companion' ) ) );
}

/**
 * Return popular section title
*/
function travel_agency_companion_get_popular_title(){
    return get_theme_mod( 'popular_title', __( 'Our Best Sellers Packages', 'travel-agency-companion' ) );
}

/**
 * Return popular section content
*/
function travel_agency_companion_get_popular_content(){
    return wpautop( get_theme_mod( 'popular_desc', __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Best Sellers Packages.', 'travel-agency-companion' ) ) );
}

/**
 * Return popular section view all
*/
function travel_agency_companion_get_popular_view_all(){
    return get_theme_mod( 'popular_view_all_label', __( 'View All Packages', 'travel-agency-companion' ) );
}

/**
 * Return why_us section title
*/
function travel_agency_companion_get_why_us_title(){
    return get_theme_mod( 'whyus_title', __( 'Why Book with Us', 'travel-agency-companion' ) );
}

/**
 * Return why_us section content
*/
function travel_agency_companion_get_why_us_content(){
    return wpautop( get_theme_mod( 'whyus_desc', __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-companion' ) ) );
}

/**
 * Return featured section title
*/
function travel_agency_companion_get_featured_title(){
    return get_theme_mod( 'feature_title', __( 'Featured Trip', 'travel-agency-companion' ) );
}

/**
 * Return featured section content
*/
function travel_agency_companion_get_featured_content(){
    return wpautop( get_theme_mod( 'feature_desc', __( 'This is the best place to show your other travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Featured Section.', 'travel-agency-companion' ) ) );
}

/**
 * Return featured section btn label
*/
function travel_agency_companion_get_featured_label(){
    return get_theme_mod( 'featured_readmore', __( 'View Detail', 'travel-agency-companion' ) );
}

/**
 * Return featured section view all btn label
*/
function travel_agency_companion_get_featured_view_all_label(){
    return get_theme_mod( 'featured_view_all', __( 'View All Trip', 'travel-agency-companion' ) );
}

/**
 * Return stat section title
*/
function travel_agency_companion_get_stat_title(){
    return get_theme_mod( 'stat_counter_title', __( 'Stats Counter', 'travel-agency-companion' ) );
}

/**
 * Return stat section content
*/
function travel_agency_companion_get_stat_content(){
    return wpautop( get_theme_mod( 'stat_counter_desc', __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > Home Page Settings > Stats Counter Settings.', 'travel-agency-companion' ) ) );
}

/**
 * Return deal section title
*/
function travel_agency_companion_get_deal_title(){
    return get_theme_mod( 'deal_title', __( 'Deals and Discounts', 'travel-agency-companion' ) );
}

/**
 * Return deal section content
*/
function travel_agency_companion_get_deal_content(){
    return wpautop( get_theme_mod( 'deal_desc', __( 'how the special deals and discounts to your customers here. You can customize this section from Appearance > Customize > Home Page Settings > Deals Section.', 'travel-agency-companion' ) ) );
}

/**
 * Return deal section btn label
*/
function travel_agency_companion_get_dealbtn_label(){
    return get_theme_mod( 'deal_readmore', __( 'Book Now', 'travel-agency-companion' ) );
}

/**
 * Return deal section view all btn label
*/
function travel_agency_companion_get_deal_view_all_label(){
    return get_theme_mod( 'deal_view_all_label', __( 'View All Deals', 'travel-agency-companion' ) );
}

/**
 * Return cta section title
*/
function travel_agency_companion_get_cta_title(){
    return get_theme_mod( 'cta_title', __( 'Get Ready', 'travel-agency-companion' ) );
}

/**
 * Return cta section content
*/
function travel_agency_companion_get_cta_content(){
    return wpautop( get_theme_mod( 'cta_desc', __( 'Keep a Call To Action button and promote your services. You can modify this section from Appearance > Customize > Home Page Settings > Call to Action Section.', 'travel-agency-companion' ) ) );
}

/**
 * Return cta section btn label
*/
function travel_agency_companion_get_ctabtn_label(){
    return get_theme_mod( 'cta_readmore', __( 'Browse Package', 'travel-agency-companion' ) );
}