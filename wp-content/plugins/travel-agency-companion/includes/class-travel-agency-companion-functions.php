<?php
/**
* All the other required plugin functions
*/
class Travel_Agency_Companion_Functions{

    /**
     * Function to list post categories in customizer options
    */
    function travel_agency_get_categories( $select = true, $taxonomy = 'category', $slug = false ){
        
        /* Option list of all categories */
        $categories = array();
        if( $select ) $categories[''] = __( 'Choose Category', 'travel-agency-companion' );
        
        if( taxonomy_exists( $taxonomy ) ){
            $args = array( 
                'hide_empty' => false,
                'taxonomy'   => $taxonomy 
            );
            
            $catlists = get_terms( $args );
            
            foreach( $catlists as $category ){
                if( $slug ){
                    $categories[$category->slug] = $category->name;
                }else{
                    $categories[$category->term_id] = $category->name;    
                }        
            }
        }
        return $categories;
    }
    
    /**
     * Fuction to list Custom Post Type
    */
    function travel_agency_get_posts( $post_type = 'post' ){
        
        $args = array(
        	'posts_per_page'   => -1,
        	'post_type'        => $post_type,
        	'post_status'      => 'publish',
        	//'suppress_filters' => true 
        );
        $posts_array = get_posts( $args );
        
        // Initate an empty array
        $post_options = array();
        $post_options[''] = __( ' -- Choose -- ', 'travel-agency-companion' );
        if ( ! empty( $posts_array ) ) {
            foreach ( $posts_array as $posts ) {
                $post_options[ $posts->ID ] = $posts->post_title;
            }
        }
        return $post_options;
        wp_reset_postdata();
    }



    /**
     * Check if Wp Travel Engine Plugin is installed
    */
    function travel_agency_is_wpte_activated(){
        return class_exists( 'Wp_Travel_Engine' ) ? true : false;
    }
    
    /**
     * Returns image url
    */
    function get_image_url( $image_id ){
        if( ! is_numeric( $image_id ) ) return;
        
        return wp_get_attachment_image_url( $image_id, 'full' );            
    }
    
    /**
     * Returns posted on date
    */
    function travel_agency_posted_on( $icon = false ) {
    
        echo '<span class="posted-on">';
        
        if( $icon ) echo '<i class="fa fa-calendar" aria-hidden="true"></i>';
        
        printf( '<a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a>', esc_url( get_permalink() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
        
        echo '</span>';

    }
    
    /**
     * Get Trip Currency
    */
    function get_trip_currency(){
        $currency = '';
        if( $this->travel_agency_is_wpte_activated() ){
            $wpte_setting = get_option( 'wp_travel_engine_settings', true ); 
            $code = 'USD';
            if( isset( $wpte_setting['currency_code'] ) && $wpte_setting['currency_code']!= '' ){
                $code = $wpte_setting['currency_code'];
            } 
            $obj = new Wp_Travel_Engine_Functions();
            $currency = $obj->wp_travel_engine_currencies_symbol( $code );
        }
        return $currency;
    }
    
}
new Travel_Agency_Companion_Functions;