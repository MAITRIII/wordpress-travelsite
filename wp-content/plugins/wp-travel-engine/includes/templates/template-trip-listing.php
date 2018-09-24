<?php
   /**
    * The template for displaying trips trip listing page
    *
    * @package Wp_Travel_Engine
    * @subpackage Wp_Travel_Engine/includes/templates
    * @since 1.0.0
    */
   	get_header(); ?>
    <div id="wte-crumbs">
        <?php
        do_action('wp_travel_engine_breadcrumb_holder');
        ?>
    </div>
    <?php
    $wte_trip_tax_post_args = array(
        'post_type' => 'trip',
        'posts_per_page' => -1,
    );
    $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
    global $post;
    if($wte_trip_tax_post_qry->have_posts()) : ?>
    <div class="archive">
        <div id="wp-travel-trip-wrapper" class="trip-content-area">
            <div class="wp-travel-inner-wrapper">
                <div class="wp-travel-engine-archive-outer-wrap">
                    <div class="grid">
                        <?php
                        while($wte_trip_tax_post_qry->have_posts()) :
                            $wte_trip_tax_post_qry->the_post(); 
                            // Start the Loop.
                            // while ( have_posts() ) : the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                        
                            $wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );
                            $wp_travel_engine_setting_option_setting = get_option( 'wp_travel_engine_settings', true ); ?>
                            <div class="col">
                                <div class="img-holder">
                                    <a href="<?php echo esc_url( get_the_permalink() );?>" class="trip-post-thumbnail"><?php
                                    $trip_feat_img_size = apply_filters('wp_travel_engine_archive_trip_feat_img_size','destination-thumb-trip-size');
                                    $feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $trip_feat_img_size );
                                    if(isset($feat_image_url[0]))
                                    { ?>
                                        <img src="<?php echo esc_url( $feat_image_url[0] );?>">
                                    <?php
                                    }
                                    else{
                                       echo '<img src="'.esc_url(  WP_TRAVEL_ENGINE_IMG_URL . '/public/css/images/trip-listing-fallback.jpg' ).'">';
                                    }?>
                                    </a>
                                      <?php
                                        $code = 'USD';
                                        if( isset($wp_travel_engine_setting_option_setting['currency_code']) && $wp_travel_engine_setting_option_setting['currency_code']!='')
                                        {
                                            $code = esc_attr( $wp_travel_engine_setting_option_setting['currency_code'] );
                                        }
                                        $obj = new Wp_Travel_Engine_Functions();
                                        $currency = $obj->wp_travel_engine_currencies_symbol( $code );
                                        $cost = isset( $wp_travel_engine_setting['trip_price'] ) ? $wp_travel_engine_setting['trip_price']: '';
                                        
                                        $prev_cost = isset( $wp_travel_engine_setting['trip_prev_price'] ) ? $wp_travel_engine_setting['trip_prev_price']: '';

                                        $code = 'USD';
                                        if( isset( $wp_travel_engine_setting_option_setting['currency_code'] ) && $wp_travel_engine_setting_option_setting['currency_code']!= '' )
                                        {
                                            $code = $wp_travel_engine_setting_option_setting['currency_code'];
                                        } 
                                        $obj = new Wp_Travel_Engine_Functions();
                                        $currency = $obj->wp_travel_engine_currencies_symbol( $code );
                                        $prev_cost = isset($wp_travel_engine_setting['trip_prev_price']) ? $wp_travel_engine_setting['trip_prev_price']: '';
                                        if( $cost!='' && isset($wp_travel_engine_setting['sale']) )
                                        {
                                            $obj = new Wp_Travel_Engine_Functions();
                                            echo '<span class="price-holder"><span>'.esc_attr($currency).esc_attr( $obj->wp_travel_engine_price_format($cost) ).'</span></span>';
                                        }
                                        else{ 
                                            if( $prev_cost!='' )
                                            {
                                                $obj = new Wp_Travel_Engine_Functions();
                                                echo '<span class="price-holder"><span>'.esc_attr($currency).esc_attr( $obj->wp_travel_engine_price_format($prev_cost) ).'</span></span>';
                                            }
                                        }
                                        ?>
                                    </strong>
                                </div>
                                <div class="text-holder">
                                    <h3 class="title"><a href="<?php echo esc_url( get_the_permalink() );?>"><?php the_title();?></a></h3>
                                    <?php
                                    $nonce = wp_create_nonce( 'wp-travel-engine-nonce' );
                                    ?>
                                    <?php
                                    if( isset( $wp_travel_engine_setting['trip_duration'] ) && $wp_travel_engine_setting['trip_duration']!='' )
                                    { ?>
                                        <div class="meta-info">
                                            <span class="time">
                                                <i class="fa fa-clock-o"></i>
                                                <?php echo esc_attr($wp_travel_engine_setting['trip_duration']); if($wp_travel_engine_setting['trip_duration']>1){ _e(' days','wp-travel-engine');} else{ _e(' day','wp-travel-engine'); }
                                                ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <div class="btn-holder">
                                        <a href="<?php echo esc_url( get_the_permalink() );?>" class="btn-more"><?php _e('View Detail','wp-travel-engine');?></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile; 
                        wp_reset_postdata();
                        endif;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();