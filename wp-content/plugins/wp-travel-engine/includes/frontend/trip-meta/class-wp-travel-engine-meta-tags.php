<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * The template for meta tags of the single trip.
 *
 *
 * @package    Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes/frontend/trip-meta
 * @author     WP Travel Engine <https://wptravelengine.com/>
 */
class Wp_Travel_Engine_Meta_Tags { 

    function __construct()
    {
        add_action( 'wp_travel_engine_trip_content_wrapper', array ( $this, 'wp_travel_engine_trip_content_wrapper' ) );
        add_action( 'wp_travel_engine_trip_main_content', array ( $this, 'wp_travel_engine_trip_content' ) );
        add_action( 'wp_travel_engine_trip_content_inner_wrapper_close', array ( $this, 'wp_travel_engine_trip_content_inner_wrapper_close' ) );
        add_action( 'wp_travel_engine_trip_secondary_wrap', array ( $this, 'wp_travel_engine_trip_secondary_wrap' ) );
        add_action( 'wp_travel_engine_trip_secondary_wrap_close', array ( $this, 'wp_travel_engine_trip_secondary_wrap_close' ) );
        add_action( 'wp_travel_engine_trip_price', array ( $this, 'wp_travel_engine_trip_price' ) );
        add_action( 'wp_travel_engine_trip_facts', array ( $this, 'wp_travel_engine_trip_facts' ) ); 
        add_action( 'wp_travel_engine_trip_category', array ( $this, 'wp_travel_engine_trip_category' ) ); 
        add_action( 'wp_travel_engine_primary_wrap_close', array ( $this, 'wp_travel_engine_primary_wrap_close' ) ); 
        add_action( 'wp_travel_engine_trip_facts_content', array( $this, 'wte_trip_facts_front_end' ) );
    }
    
    /**
     * Main wrap of the single trip.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_content_wrapper()
    { ?>
    <div id="wte-crumbs">
        <?php
        do_action('wp_travel_engine_breadcrumb_holder');
        ?>
    </div>
    <div id="wp-travel-trip-wrapper" class="trip-content-area">
        <div class="row">
        <div id="primary" class="content-area">

    <?php } 

    /**
     * Trip content inner wrap close.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_content_inner_wrapper_close()
    { 
        $wp_travel_engine_settings = get_option( 'wp_travel_engine_settings',true );
        
        if( !isset( $wp_travel_engine_settings['enquiry'] ) )
        {
            do_action ( 'wp_travel_engine_enquiry_form' );
        }

        if (class_exists('Wte_Trip_Review_Init'))
        {
            $obj = new Wte_Trip_Review_Init;
            if (comments_open() || get_comments_number())
            { 
                global $post;
                $wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );
                $wp_travel_engine_setting_option_setting = get_option('wp_travel_engine_settings', true);
                
                if(isset($wp_travel_engine_setting_option_setting['booking']))
                    return;

                $obj = new Wte_Trip_Review_Init();

                $cost = isset( $wp_travel_engine_setting['trip_price'] ) ? $wp_travel_engine_setting['trip_price']: '';
                
                if( $cost!='' && isset($wp_travel_engine_setting['sale']) )
                { 
                    $actual_price = $cost;
                }
                else{ 
                    $actual_price = $wp_travel_engine_setting['trip_prev_price'];
                }
                
                $comments = get_comments( array(
                    'post_id' => get_the_ID(),
                    'status' => 'approve',
                ) );
                if ( !empty( $comments ) )
                {
                    echo '<div class="review-wrap"><div class="average-rating">';
                    $comments = get_comments ( array ( 'meta_key'=> 'stars' ) );
                    $sum = 0;
                    $i = 0;
                    foreach($comments as $comment) {
                        $rating = get_comment_meta( $comment->comment_ID, 'stars', true );
                        $sum = $sum+$rating;
                        $i++;
                    }
                    $aggregate = $sum/$i;
                    echo 
                    '<script>
                        jQuery(document).ready(function($){
                            $(".agg-rating").rateYo({
                                rating: '.$aggregate.'
                            });
                        });
                    </script>';
                    echo '<div class="agg-rating"></div><div itemprop="aggregateRating" class="aggregate-rating" itemscope="" itemtype="http://schema.org/AggregateRating">
                    <span class="rating-star" itemprop="ratingValue">'.$aggregate.'</span> stars - based on <span itemprop="reviewCount">'.$i.'</span> reviews</div>';
                    echo '</div>';
                    echo '<script type="application/ld+json">
                    {
                        "@context": "http://schema.org",
                        "@type": "Review",
                        "itemReviewed": {
                            "@type": "Product",
                            "image": '.get_the_post_thumbnail().',
                            "url": ,
                            "offers": {
                                "@type": "Offer",
                                "price": '.$actual_price.',
                                "priceCurrency": "$",
                                "availability": "Available"
                            }
                        },
                        "reviewRating": {
                            "@type": "Rating",
                            "ratingValue": '.$aggregate.',
                            "bestRating": 5
                        },
                        "reviewBody": ""
                    }
                    </script>';
                    echo '<ol class="comment-list">';
                    wp_list_comments( array(
                        'callback' => array($obj,'rw_archive_comment_callback'),
                        'type'     => 'comment',
                    ), $comments );
                    echo '</ol>'.'</div>';
                }
                // comments_template();  
                $comments_args = array(
                    // change the title of send button 
                    'label_submit'=>'Send',
                    // change the title of the reply section
                    'title_reply'=>'Write a Review',
                    // remove "Text or HTML to be displayed after the set of comment fields"
                    'comment_notes_after' => '',
                    // redefine your own textarea (the comment body)
                    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Review', 'noun', 'wp-travel-engine' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
                );
                comment_form($comments_args);                  
            }
        } 
      ?>  
        </div>

    <?php
    } 
    
    /**
     * Main content of the single trip.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_content()
    { 

        require WP_TRAVEL_ENGINE_BASE_PATH . '/includes/frontend/trip-meta/trip-meta-parts/trip-tabs.php';      
    } 

    /**
     * Secondary wrip open.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_secondary_wrap()
    { 
        
        do_action('wp_travel_engine_before_secondary');
        ?>
        <div id="secondary" class="widget-area"> 
    <?php
    }        
    
    /**
     * Secondary wrap close.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_secondary_wrap_close()
    { ?>
            </div>
    <?php
    }


    /**
     * Secondary content such as pricing for single trip.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_price()
    { 
        do_action('wp_travel_engine_before_trip_price');
        require WP_TRAVEL_ENGINE_BASE_PATH . '/includes/frontend/trip-meta/trip-meta-parts/trip-price.php'; 
        do_action('wp_travel_engine_after_trip_price');
    }

    /**
     * Load trip facts frontend.
     *
     * @since 1.0.0
     */
    function wte_trip_facts_front_end()
    {
        require_once WP_TRAVEL_ENGINE_BASE_PATH . '/includes/frontend/trip-meta/trip-meta-parts/trip-facts.php';
    }

    /**
     * Secondary content such as trip facts for single trip.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_trip_facts()
    {
        do_action('wp_travel_engine_before_trip_facts');
        do_action('wp_travel_engine_trip_facts_content');
        do_action('wp_travel_engine_after_trip_facts');
    } 

    /**
     * Primary wrap close.
     *
     * @since    1.0.0
     */
    function wp_travel_engine_primary_wrap_close()
    { ?>   
        </div>
            </div>
    <?php 
    do_action ( 'wp_travel_engine_before_related_posts' );
    do_action ( 'wp_travel_engine_related_posts' );
    do_action ( 'wp_travel_engine_after_related_posts' );
    ?>
    </div>
    <?php
    }
}
new Wp_Travel_Engine_Meta_Tags();