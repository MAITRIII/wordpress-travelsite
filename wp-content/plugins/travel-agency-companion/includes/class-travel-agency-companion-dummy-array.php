<?php
/**
 * Array of default dummy posts
 *
 * @since      1.0.0
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/includes
 * @author     raratheme <raratheme.com>
 */
class Travel_Agency_Companion_Dummy_Array {
        
    /**
     * Default Activities
    */
    public function default_activities(){
        return apply_filters( 'travel_agency_default_activities', array(
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img3.jpg',
                    'name'      => __( 'Whitewater Rafting', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ), 
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img4.jpg',
                    'name'      => __( 'Hiking', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img5.jpg',
                    'name'      => __( 'Skiing', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img6.jpg',
                    'name'      => __( 'Cycling', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img3.jpg',
                    'name'      => __( 'Paragliding', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img4.jpg',
                    'name'      => __( 'Whitewater Rafting', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ), 
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img5.jpg',
                    'name'      => __( 'Hiking', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
                array(
                    'thumbnail' => TRAVEL_AGENCY_COMPANION_URL . '/includes/images/img6.jpg',
                    'name'      => __( 'Skiing', 'travel-agency-companion' ),
                    'desc'      => __( 'Tell your potential customers about the services that you provide here.', 'travel-agency-companion' ),
                    'url'       => '#',
                ),
            )    
        );
    }
    
    /**
     * Default Why Us
    */
    public function default_why_us(){
        return apply_filters( 'travel_agency_default_why_us', array(
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( 'TripAdvisor Multiple Award winning company', 'travel-agency-companion' ),
                    'description' => __( 'We\'ve received Certificate of Excellence award from TripAdvisor, the world\'s largest travel website.', 'travel-agency-companion' ),
                    'url'         => ''
                ),
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( '100% Customizable', 'travel-agency-companion' ),
                    'description' => __( 'Tell us about your trip requirement. We\'ll work together to customize your trip to meet your exact requirement so that you have a memorable trip.', 'travel-agency-companion' ),
                    'url'         => ''
                ),
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( 'Local Experts. Middle-man Free Pricing', 'travel-agency-companion' ),
                    'description' => __( 'We\'re a local travel agency. When you book with us, you get best possible price, which is middle-man free.', 'travel-agency-companion' ),
                    'url'         => ''
                ),
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( 'No Hidden Charges', 'travel-agency-companion' ),
                    'description' => __( 'We don\'t add hidden extras cost. All trips include travel permit, lodging and fooding. There are no surprises with hidden costs.', 'travel-agency-companion' ),
                    'url'         => ''
                ),
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( 'TripAdvisor Multiple Award winning company', 'travel-agency-companion' ),
                    'description' => __( 'We\'ve received Certificate of Excellence award from TripAdvisor, the world\'s largest travel website.', 'travel-agency-companion' ),
                    'url'         => ''
                ),
                array(
                    'whyus-icon'  => 'fa fa-check',
                    'title'       => __( '100% Customizable', 'travel-agency-companion' ),
                    'description' => __( 'Tell us about your trip requirement. We\'ll work together to customize your trip to meet your exact requirement so that you have a memorable trip.', 'travel-agency-companion' ),
                    'url'         => ''
                )
            )    
        );
    }
    
    /**
     * Default Stat Counter
    */
    public function default_stat_counter(){
        return apply_filters( 'travel_agency_default_stat_counter', array(
                array(
                    'icon'   => 'fa fa-group',
                    'title'  => __( 'Number of Customers', 'travel-agency-companion' ),
                    'number' => __( '859', 'travel-agency-companion' ),
                ),
                array(
                    'icon'   => 'fa fa-globe',
                    'title'  => __( 'Number of Trips', 'travel-agency-companion' ),
                    'number' => __( '1021', 'travel-agency-companion' ),
                ),
                array(
                    'icon'   => 'fa fa-plane',
                    'title'  => __( 'Trips Types', 'travel-agency-companion' ),
                    'number' => __( '225', 'travel-agency-companion' ),
                ),
                array(
                    'icon'   => 'fa fa-bus',
                    'title'  => __( 'Travel with Bus', 'travel-agency-companion' ),
                    'number' => __( '1020', 'travel-agency-companion' ),
                ),
            )    
        );
    }
	
    /**
	 * Default Popular posts
	 */
	public function default_trip_popular_posts( $slider = true ) {
		
        if( $slider ){
            $arr = apply_filters( 'travel_agency_default_popular_post_slider', array(
        			array(
        				'title'      => __( 'Cayo de Agua, Los Roques, Venezuela', 'travel-agency-companion' ),
                        'days' 	     => __( '5 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 1875', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img8.jpg',
        			),
                    array(
        				'title'      => __( 'A Guid To Rocky Mountain Vacations', 'travel-agency-companion'),
                        'days' 	     => __( '4 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 1775', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img8.jpg',
        			),
        			array(
        				'title'      => __( 'Everest Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '5 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 2000', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img8.jpg',
        			),
        			array(
        				'title'      => __( 'Annapurna Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '4 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 1950', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img8.jpg',
        			),
        			array(
        				'title'      => __( 'Dolpho Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '3 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 2200', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img8.jpg',
        			),
        		)
            );
        }else{
    		$arr = apply_filters( 'travel_agency_default_popular_post', array(
                    array(
        				'title'      => __( 'A Guid To Rocky Mountain Vacations', 'travel-agency-companion' ),
                        'days' 	     => __( '4 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 1775', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img9.jpg',
        			),
                    array(
        				'title'      => __( 'Everest Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '5 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 2000', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img10.jpg',
        			),
        			array(
        				'title'      => __( 'Annapurna Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '4 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 1950', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img11.jpg',
        			),
        			array(
        				'title'      => __( 'Dolpho Base Camp Trek', 'travel-agency-companion' ),
                        'days' 	     => __( '3 Days', 'travel-agency-companion' ),
                        'sale_price' => __( '$ 2200', 'travel-agency-companion' ),
        				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img12.jpg',
        			),
                )
    		);
		}
        return $arr;
	}    
    
    /**
	 * Default Feature posts
	 */
	public function default_trip_featured_posts() {		
        
		return apply_filters( 'travel_agency_default_featured_post', array(
    			array(
    				'title'      => __( 'Cayo de Agua, Los Roques, Venezuela', 'travel-agency-companion' ),
                    'days' 	     => __( '5 Days - 4 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 1875', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img14.jpg',
    			),
    			array(
                    'title'      => __( 'Cum sociis natoque penati bus et magnis', 'travel-agency-companion' ),
    				'days' 	     => __( '4 Days - 3 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 1625', 'travel-agency-companion' ),
                    'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img15.jpg',
    			),
    			array(
                    'title'      => __( 'A Guid To Rocky Mountain Vacations', 'travel-agency-companion' ),
    				'days' 	     => __( '4 Days - 3 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 1775', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img16.jpg',
    			),
    			array(
                    'title'      => __( 'Everest Base Camp Trek', 'travel-agency-companion' ),
    				'days' 	     => __( '5 Days - 4 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 2000', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img17.jpg',
    			),
    			array(
                    'title'      => __( 'Annapurna Base Camp Trek', 'travel-agency-companion' ),
    				'days' 	     => __( '4 Days - 3 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 1950', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img18.jpg',
    			),
    			array(
                    'title'      => __( 'Dolpho Base Camp Trek', 'travel-agency-companion' ),
    				'days' 	     => __( '3 Days - 2 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 2200', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img19.jpg',
    			),
            )
		);		
	}   
    
    /**
	 * Default Deals posts
	 */
	public function default_trip_deal_posts() {
        
		return apply_filters( 'travel_agency_default_deal_post', array(
    			array(
    				'title'      => __( 'Cayo de Agua, Los Roques, Venezuela', 'travel-agency-companion' ),
                    'days' 	     => __( '5 Days - 4 Nights', 'travel-agency-companion' ),
    				'sale_price' => __( '$ 1875', 'travel-agency-companion' ),
    				'old_price'	 => __( '$ 2500', 'travel-agency-companion' ),
                    'discount'   => __( '25% Off', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img21.jpg',
    			),
    			array(
    				'title'      => __( 'Everest Base Camp Trek', 'travel-agency-companion' ),
                    'days' 	     => __( '5 Days - 4 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 2000', 'travel-agency-companion' ),
    				'old_price'	 => __( '$ 3900', 'travel-agency-companion' ),
                    'discount'   => __( '49% Off', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img22.jpg',
    			),
    			array(
    				'title'      => __( 'Annapurna Base Camp Trek', 'travel-agency-companion' ),
                    'days' 	     => __( '4 Days - 3 Nights', 'travel-agency-companion' ),
                    'sale_price' => __( '$ 1950', 'travel-agency-companion' ),
    				'old_price'	 => __( '$ 3900', 'travel-agency-companion' ),
                    'discount'   => __( '50% Off', 'travel-agency-companion' ),
    				'img'		 =>	TRAVEL_AGENCY_COMPANION_URL.'/includes/images/img23.jpg',
    			)			
            )
		);
	}   
}
new Travel_Agency_Companion_Dummy_Array;