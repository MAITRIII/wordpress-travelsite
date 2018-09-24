<?php
/**
    * The template for displaying trips according to type.
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
                    <?php
                    $termID = get_queried_object()->term_id; // Parent A ID
                    $taxonomyName = 'trip_types';
                    $termchildren = get_term_children( $termID, $taxonomyName );
                    if($termchildren) {
                        $default_posts_per_page = get_option( 'posts_per_page' );
                        $wte_trip_cat_slug = get_queried_object()->slug;
                        $wte_trip_cat_name = get_queried_object()->name;
                        ?>
                        <div class="page-header">
                            <h2 class="page-title"><?php echo esc_attr( $wte_trip_cat_name ); ?></h2>
                        </div>
                        <?php 
                        $term_description = term_description( $termID, 'trip_types' ); ?>
                        <div class="parent-desc"><?php echo isset( $term_description ) ?  $term_description:'';?></div>
                        <div class="grid <?php echo $wte_trip_cat_slug; ?>">
                            <?php
                            $wte_trip_tax_post_args = array(
                                'post_type' => 'trip', // Your Post type Name that You Registered
                                'posts_per_page' => $default_posts_per_page,
                                'order' => 'ASC',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'trip_types',
                                        'field' => 'slug',
                                        'terms' => $wte_trip_cat_slug,
                                        'include_children' => false
                                    )
                                )
                            );
                            $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
                            $category = get_term_by('name', $wte_trip_cat_name, 'trip_types');
                            $term = get_term( $category->term_id, 'trip_types' );
                            global $post;
                            if($wte_trip_tax_post_qry->have_posts()) :
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
                            if( $term->count > $default_posts_per_page )
                            {
                                echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                            }
                            ?>
                        </div>
                        <?php
                        foreach ($termchildren as $child) {
                            $term = get_term_by( 'id', $child, 'trip_types' ); 
                            $term_link = get_term_link( $term );
                            $child_term_description = term_description( $term, 'trip_types' );         
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $default_posts_per_page = get_option( 'posts_per_page' );
                            $my_query = new WP_Query( array(
                                'post_type' => 'trip', 
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomyName,
                                        'field' => 'slug',
                                        'terms' => $term->slug
                                    )
                                ),
                                'posts_per_page' => $default_posts_per_page,
                                'orderby' => 'menu_order',
                                'order' => 'ASC',
                                'paged'=> $paged

                                ));
                                ?>
                            <h2 class="child-title"><a href="<?php echo esc_url( $term_link );?>"><?php echo esc_attr( $term->name );?></a></h2>
                            <div class="child-desc"><?php echo isset( $child_term_description ) ?  $child_term_description:'';?></div>
                            <div class="grid <?php echo $term->slug;?>">
                                <?php 
                                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                    <?php
                                    global $post;
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
                                wp_reset_query();
                                if( $term->count > $default_posts_per_page )
                                {
                                    echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                                }
                                ?>
                            </div>
                        <?php
                        } 
                    }
                    else{
                        if(!isset(get_queried_object()->slug))
                            return;
                        $wte_trip_cat_slug = get_queried_object()->slug;
                        $wte_trip_cat_name = get_queried_object()->name;
                        $default_posts_per_page = get_option( 'posts_per_page' );
                        $category = get_term_by('slug', $wte_trip_cat_slug, 'trip_types');
                        $term = get_term( $category->term_id, 'trip_types' );
                        ?>
                        <div class="page-header">
                            <div id="wte-crumbs">
                                <?php
                                do_action('wp_travel_engine_beadcrumb_holder');
                                ?>
                            </div>
                            <h2 class="page-title"><?php echo esc_attr( $wte_trip_cat_name ); ?></h2>
                        </div>
                        <?php 
                            $term_description = term_description( $termID, 'trip_types' ); ?>
                            <div class="parent-desc"><?php echo isset( $term_description ) ?  $term_description:'';?></div>
                            <div class="grid <?php echo $wte_trip_cat_slug;?>">
                                <?php
                                $default_posts_per_page = get_option( 'posts_per_page' );
                                $wte_trip_tax_post_args = array(
                                    'post_type' => 'trip', // Your Post type Name that You Registered
                                    'posts_per_page' => $default_posts_per_page,
                                    'order' => 'ASC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'trip_types',
                                            'field' => 'slug',
                                            'terms' => $wte_trip_cat_slug
                                        )
                                    )
                                );
                                $wte_trip_tax_post_qry = new WP_Query($wte_trip_tax_post_args);
                                global $post;
                                if($wte_trip_tax_post_qry->have_posts()) :
                                    while($wte_trip_tax_post_qry->have_posts()) :
                                        $wte_trip_tax_post_qry->the_post(); 
                                        // Start the Loop.
                                        // while ( have_posts() ) : the_post();
                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                        $category_to_check = get_term_by( 'slug', $wte_trip_cat_slug, 'trip_types' );
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
                                                else{ ?>
                                                    <img src="<?php echo esc_url(  WP_TRAVEL_ENGINE_IMG_URL . '/public/css/images/trip-listing-fallback.jpg' );?>">
                                                <?php } ?>
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
                            if( $term->count > $default_posts_per_page )
                            {
                                echo '<div class="btn-loadmore"><span>'.__('Load More Trips','wp-travel-engine').'</span></div>';
                            }
                            ?>
                        </div>
                        <?php
                        } 
                        ?>
                    </div>
                </div>
            </div>
<?php get_footer();