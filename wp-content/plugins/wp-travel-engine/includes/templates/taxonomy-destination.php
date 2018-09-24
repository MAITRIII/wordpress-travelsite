<?php
    /**
    * The template for displaying trips archive page
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
    <div id="wp-travel-trip-wrapper" class="trip-content-area">
        <div class="wp-travel-inner-wrapper">
            <div class="wp-travel-engine-archive-outer-wrap">
                <div class="details">
                    <?php
                    $wp_travel_engine_setting_option_setting = get_option( 'wp_travel_engine_settings', true );                
                    $termID = get_queried_object()->term_id; // Parent A ID
                    $terms = get_terms('activities');

                    $a = '';
                    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
                        foreach ( $terms as $term ) {
                            $act_terms[] = $term->term_id;
                            if( $term->count > 0 )
                            {
                                $a = 1;
                            }
                        }
                    } 

                    $terms = get_terms('activities', array('orderby' => 'date', 'order' => 'ASC'));
                    $wte_trip_cat_slug = get_queried_object()->slug;
                    $wte_trip_cat_name = get_queried_object()->name;
                    ?>
                        <div class="page-header">
                            <div id="wte-crumbs">
                                <?php
                            do_action('wp_travel_engine_beadcrumb_holder');
                            ?>
                            </div>
                            <h2 class="page-title">
                                <?php echo esc_attr( $wte_trip_cat_name ); ?>
                            </h2>
                        </div>
                        <?php 
                        $term_description = term_description( $termID, 'destination' ); ?>
                        <div class="parent-desc">
                            <p>
                                <?php echo isset( $term_description ) ?  $term_description:'';?>
                            </p>
                        </div>
                        <?php
                    $default_posts_per_page = get_option( 'posts_per_page' );
                    $wte_trip_cat_slug = get_queried_object()->slug;
                    foreach( $terms as $term ) {
                        $args = array(
                            'post_type'           => 'trip',
                            'orderby'             => 'date',
                            'order'               => 'ASC',
                            'post_status'         => 'publish',
                            'posts_per_page'      => -1,
                            'tax_query'           => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy'    => 'destination',
                                    'field'       => 'slug',
                                    'terms'       => $wte_trip_cat_slug
                                ),
                                array(
                                    'taxonomy'    => 'activities',
                                    'field'       => 'slug',
                                    'terms'       => array( $term->slug )
                                )
                            )
                        );
                        $your_query = new WP_Query($args);
                        $count = $your_query->post_count;
                        $args = array(
                            'post_type'           => 'trip',
                            'orderby'             => 'date',
                            'order'               => 'ASC',
                            'post_status'         => 'publish',
                            'posts_per_page'      => $default_posts_per_page,
                            'tax_query'           => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy'    => 'destination',
                                    'field'       => 'slug',
                                    'terms'       => $wte_trip_cat_slug
                                ),
                                array(
                                    'taxonomy'    => 'activities',
                                    'field'       => 'slug',
                                    'terms'       => array( $term->slug )
                                )
                            )
                        );
                        $my_query = new WP_Query($args);
                        if ($my_query->have_posts()) { ?>
                            <h3 class="activity-title"><span><?php echo esc_attr($term->name);?></span></h3>
                            <div class="wrap">
                                <div class="child-desc">
                                    <p>
                                        <?php echo html_entity_decode(term_description( $term->term_id, 'activities' ));?>
                                    </p>
                                </div>
                                <div class="grid <?php echo esc_attr($term->slug);?>" data-id="<?php echo $my_query->max_num_pages; ?>">
                                    <?php
                                        while ($my_query->have_posts()) : $my_query->the_post(); 
                                            global $post;
                                            $wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );?>
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
                                            </div>
                                            <div class="text-holder">
                                                <h3 class="title">
                                                    <a href="<?php echo esc_url( get_the_permalink() );?>">
                                                        <?php the_title();?>
                                                    </a>
                                                </h3>
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
                                                            <a href="<?php echo esc_url( get_the_permalink() );?>" class="btn-more">
                                                                <?php _e('View Detail','wp-travel-engine');?>
                                                            </a>
                                                        </div>
                                            </div>
                                        </div>
                                        <?php
                                        endwhile;
                                        wp_reset_postdata();wp_reset_query();
                                        if( $count > $default_posts_per_page )
                                        {
                                            echo '<div class="load-destination"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                                        }
                                        ?>
                                </div>
                            </div>

                            <?php
                        } // END if have_posts loop
                        ?>

                                <?php
                //end
            }
                    if($a == '')
                    { 
                        $wte_trip_cat_slug = get_queried_object()->slug;
                        $default_posts_per_page = get_option( 'posts_per_page' );
                        $termID = get_queried_object()->term_id; // Parent A ID
                        $term = get_term_by( 'slug', $wte_trip_cat_slug, 'destination' );
                        $wte_trip_tax_post_args = array(
                            'post_type' => 'trip', // Your Post type Name that You Registered
                            'posts_per_page' => $default_posts_per_page,
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'destination',
                                    'field' => 'slug',
                                    'terms' => $wte_trip_cat_slug,
                                    'include_children' => false
                                )
                            )
                        );
                        $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
                        ?>
                        <div class="grid <?php echo $wte_trip_cat_slug; ?>" id="<?php echo $wte_trip_cat_slug; ?>" data-id="<?php echo $wte_trip_tax_post_qry->max_num_pages; ?>">
                            <?php
                                if($wte_trip_tax_post_qry->have_posts()) :
                                    while ($wte_trip_tax_post_qry->have_posts()) : $wte_trip_tax_post_qry->the_post(); 
                                        global $post;
                                        $wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );?>
                                            <div class="col">
                                                <div class="img-holder">
                                                    <a href="<?php echo esc_url( get_the_permalink() );?>" class="trip-post-thumbnail"><?php
                                                $trip_feat_img_size = apply_filters('wp_travel_engine_archive_trip_feat_img_size','trip-thumb-size');
                                                $feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $trip_feat_img_size );
                                                    if(isset($feat_image_url[0]))
                                                    { ?>
                                                        <img src="<?php echo esc_url( $feat_image_url[0] );?>">
                                                    <?php
                                                    }
                                                    else{
                                                       echo '<img src="'.esc_url(  WP_TRAVEL_ENGINE_IMG_URL . '/public/css/images/trip-listing-fallback.jpg' ).'">';
                                                    } ?>
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
                                                </div>
                                                <div class="text-holder">
                                                    <h3 class="title">
                                                        <a href="<?php echo esc_url( get_the_permalink() );?>">
                                                            <?php the_title();?>
                                                        </a>
                                                    </h3>
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
                                                            <a href="<?php echo esc_url( get_the_permalink() );?>" class="btn-more">
                                                                <?php _e('View Detail','wp-travel-engine');?>
                                                            </a>
                                                        </div>
                                                </div>
                                            </div>
                                            <?php
                                    endwhile;
                                endif;
                                if( $term->count > $default_posts_per_page )
                                {
                                    echo '<div class="load-destination"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                                }
                                wp_reset_postdata();
                                ?>
                        </div>
                    <?php    
                    }

                    $args = array(
                        'post_type'           => 'trip',
                        'orderby'             => 'date',
                        'order'               => 'ASC',
                        'post_status'         => 'publish',
                        'posts_per_page'      => $default_posts_per_page,
                        'tax_query'           => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy'    => 'destination',
                                'field'       => 'slug',
                                'terms'       => $wte_trip_cat_slug
                            ),
                            array(
                                'taxonomy'    => 'activities',
                                'field'       => 'term_id',
                                'terms'       => $act_terms,
                                'operator'    => 'NOT IN'
                            )
                        )
                    );
                    $my_query = new WP_Query($args);
                    if ($my_query->have_posts()) { ?>
                        <h3 class="activity-title"><span><?php $other_trips = apply_filters('wp_travel_engine_other_trips_title','Other Trips'); _e($other_trips,'wp-travel-engine')?></span></h3>
                        <div class="wrap">
                            <div class="child-desc">
                                <p>
                                    <?php $other_trips_desc = apply_filters('wp_travel_engine_other_trips_desc','These are other trips.'); _e($other_trips_desc,'wp-travel-engine')?>
                                </p>
                            </div>
                            <div class="grid other" data-id="<?php echo $my_query->max_num_pages; ?>">
                                <?php
                                    while ($my_query->have_posts()) : $my_query->the_post(); 
                                        global $post;
                                        $wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );?>
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
                                        </div>
                                        <div class="text-holder">
                                            <h3 class="title">
                                                <a href="<?php echo esc_url( get_the_permalink() );?>">
                                                    <?php the_title();?>
                                                </a>
                                            </h3>
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
                                                <?php 
                                                } ?>
                                            <div class="btn-holder">
                                                <a href="<?php echo esc_url( get_the_permalink() );?>" class="btn-more">
                                                    <?php _e('View Detail','wp-travel-engine');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();wp_reset_query();
                                    if( $count > $default_posts_per_page )
                                    {
                                        echo '<div class="load-destination"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                                    }
                                    ?>
                            </div>
                        </div>
                        <?php
                    } // END if have_posts loop
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php   get_footer();