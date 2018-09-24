<?php
/**
 * Popular Destination Section
 * 
 * @package Travel_Agency
 */

$defaults   = new Travel_Agency_Companion_Dummy_Array;
$obj        = new Travel_Agency_Companion_Functions;
$ed_demo    = get_theme_mod( 'ed_popular_demo', true );
$title      = get_theme_mod( 'popular_title', __( 'Our Best Sellers Packages', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'popular_desc', __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Best Sellers Packages.', 'travel-agency-companion' ) );
$trip_cat   = get_theme_mod( 'popular_cat' );
$trip_one   = get_theme_mod( 'popular_post_one' );
$trip_two   = get_theme_mod( 'popular_post_two' );
$trip_three = get_theme_mod( 'popular_post_three' );
$trip_four  = get_theme_mod( 'popular_post_four' );
$view_all   = get_theme_mod( 'popular_view_all_label', __( 'View All Packages', 'travel-agency-companion' ) );
$view_url   = get_theme_mod( 'popular_view_all_url', '#' );

$trips = array( $trip_one, $trip_two, $trip_three, $trip_four );
$trips = array_diff( array_unique( $trips ), array('') );

if( $title || $content || ( travel_agency_is_wpte_activated() && $trip_cat && $trips ) ){ ?>
<section class="popular-destination" id="popular_section">
	<div class="container">
		
        <?php if( $title || $content ){ ?>
        <header class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
		<?php 
            if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_popular_title() ) . '</h2>';
            if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_popular_content() ) . '</div>'; 
        ?>
		</header>
        <?php } ?>
        
        <?php 
            if( travel_agency_is_wpte_activated() && $trip_cat && $trips ){                 
                
                $currency = $obj->get_trip_currency();
                $new_obj  = new Wp_Travel_Engine_Functions();
                            
                $args = array( 
                    'post_type'       => 'trip',
                    'activities'      => $trip_cat,
                    'post_status'     => 'publish',
                    'posts_per_page'  => -1  
                );
                
                $qry = new WP_Query( $args );
                
                $slider_qry = new WP_Query( $args );
                
            ?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
    			<?php if( $slider_qry->have_posts() ){ ?>
                <div class="col">
    				<div id="destination-slider" class="owl-carousel">
   					<?php 
                        while( $slider_qry->have_posts() ){
                            $slider_qry->the_post(); 
                            $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
                            ?>                            
                            <div class="item">
        						<div class="img-holder">
        							<a href="<?php the_permalink(); ?>">
                                    <?php 
                                        if( has_post_thumbnail() ){
                                            the_post_thumbnail( 'travel-agency-popular' );							 
                                        }else{ ?>
                                            <img src="<?php echo esc_url( TRAVEL_AGENCY_COMPANION_URL . 'includes/images/fallback-img-630-630.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />						      
                                            <?php 
                                        } 
                                    ?>
                                    </a>
        							<?php 
                                     if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                       
                                        if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) && ( isset( $meta['sale'] ) && $meta['sale'] ) && ( isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                            echo '<span class="price-holder"><span>';
                                                 echo esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_price'] ) );
                                            echo '</span></span>'; 
                                        }elseif( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] ) ){
                                            echo '<span class="price-holder"><span>' . esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_prev_price'] ) ) . '</span></span>'; 
                                        }
                                        else{
                                        }
                                     }
                                    ?>
        							<div class="text-holder">
        								<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        								<div class="meta-info">
        									<?php if( isset( $meta['trip_duration'] ) ) echo '<span class="destination-time"><i class="fa fa-clock-o"></i>' . absint( $meta['trip_duration'] ) . esc_html__( ' Days', 'travel-agency-companion' ) . '</span>'; ?>
        								</div>
        							</div>
        						</div>
        					</div>
    					   <?php 
                        }
                        wp_reset_postdata();
                    ?>
    				</div>
    			</div><!-- .col -->
    			<?php } ?>
                
                <?php
                    $args = array( 
                        'post_type'      => 'trip',
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                        'post__in'       => $trips,
                        'orderby'        => 'post__in'  
                    );
                    $slider_qry = new WP_Query( $args );
                    
                    if( $slider_qry->have_posts() ){
                        while( $slider_qry->have_posts() ){ 
                            $slider_qry->the_post(); 
                            $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); ?>
        					<div class="col">
        						<div class="img-holder">
        							<a href="<?php the_permalink(); ?>">
                                    <?php 
                                        if( has_post_thumbnail() ){
                                            the_post_thumbnail( 'travel-agency-popular-small' );    
                                        }else{ ?>
                                            <img src="<?php echo esc_url( TRAVEL_AGENCY_COMPANION_URL . 'includes/images/fallback-img-300-300.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />
                                            <?php
                                        }
                                    ?>                                        
                                    </a>
        							<?php 
                                     if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                        if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) && ( isset( $meta['sale'] ) && $meta['sale'] ) && ( isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                            echo '<span class="price-holder"><span>';
                                                 echo esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_price'] ) );
                                            echo '</span></span>'; 
                                        }elseif( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] ) ){
                                            echo '<span class="price-holder"><span>' . esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_prev_price'] ) ) . '</span></span>'; 
                                        }
                                        else{
                                        }
                                     }
                                    ?>
                                    <div class="text-holder">
        								<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        								<div class="meta-info">
        									<?php if( isset( $meta['trip_duration'] ) ) echo '<span class="destination-time"><i class="fa fa-clock-o"></i>' . absint( $meta['trip_duration'] ) . esc_html__( ' Days', 'travel-agency-companion' ) . '</span>'; ?>
        								</div>
        							</div>
        						</div>
        					</div>
        				    <?php 
                        }
                        wp_reset_postdata();                             
                    }
                    ?>
    		</div><!-- .grid -->
            <?php 
        }elseif( $ed_demo ){
            //Default 
            $sliders  = $defaults->default_trip_popular_posts();
            $populars = $defaults->default_trip_popular_posts( false ); ?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
				
                <div class="col">
					<div id="destination-slider" class="owl-carousel">
						<?php foreach( $sliders as $v ){ ?>
                        <div class="item">
							<div class="img-holder">
								<a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ); ?>"></a>
								<span class="price-holder"><span><?php echo esc_html( $v['sale_price'] ); ?></span></span>
								<div class="text-holder">
									<h3 class="title"><a href="#"><?php echo esc_attr( $v['title'] ); ?></a></h3>
									<div class="meta-info">
										<span class="destination-time"><i class="fa fa-clock-o"></i> <?php echo esc_html( $v['days'] ); ?></span>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<?php foreach( $populars as $v ){ ?>
                    <div class="col">
						<div class="img-holder">
							<a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ); ?>"></a>
							<span class="price-holder"><span><?php echo esc_html( $v['sale_price'] ); ?></span></span>
							<div class="text-holder">
								<h3 class="title"><a href="#"><?php echo esc_attr( $v['title'] ); ?></a></h3>
								<div class="meta-info">
									<span class="destination-time"><i class="fa fa-clock-o"></i> <?php echo esc_html( $v['days'] ); ?></span>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
					
			</div>
            <?php
        } 
        
        if( $view_all && $view_url ){
            echo '<div class="btn-holder"><a href="' . esc_url( $view_url ) . '" class="btn-more">';
            echo travel_agency_companion_get_popular_view_all();
            echo '</a></div>';            
        }
        ?>
	</div><!-- .container-large -->    
</section>
<?php
}