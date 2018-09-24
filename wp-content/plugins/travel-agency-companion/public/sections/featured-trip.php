<?php
/**
 * Featured Trip Section
 * 
 * @package Travel_Agency
 */

$defaults    = new Travel_Agency_Companion_Dummy_Array;
$obj         = new Travel_Agency_Companion_Functions;
$ed_demo     = get_theme_mod( 'ed_featured_demo', true );
$title       = get_theme_mod( 'feature_title', __( 'Featured Trip', 'travel-agency-companion' ) );
$content     = get_theme_mod( 'feature_desc', __( 'This is the best place to show your other travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Featured Section.', 'travel-agency-companion' ) );
$trip_type   = get_theme_mod( 'trip_type', 'select_cat' ); 
$trip_cat    = get_theme_mod( 'featured_cat' );
$no_of_trip  = (int) get_theme_mod( 'no_of_trips', '6' );
$view_detail = get_theme_mod( 'featured_readmore', __( 'View Detail', 'travel-agency-companion' ) );
$view_all    = get_theme_mod( 'featured_view_all', __( 'View All Trip', 'travel-agency-companion' ) );
$view_all_link    = get_theme_mod( 'featured_view_all_link', '#' );
for( $i=1; $i<= $no_of_trip; $i++ ){
    $trip_posts[]  = get_theme_mod( 'choose_trip_'.$i );
}

if( $trip_type == 'select_cat' ) {
    $args = array( 
        'post_type'       => 'trip',
        'activities'      => $trip_cat,
        'post_status'     => 'publish',
        'posts_per_page'  => $no_of_trip  
    );
    $qry = new WP_Query( $args );
}else{
    $args = array( 
        'post_type'       => 'trip',
        'post__in'        => $trip_posts,
        'post_status'     => 'publish',
        'posts_per_page'  => count( $trip_posts ) 
    );
    $qry = new WP_Query( $args );
}


if( $title || $content || ( travel_agency_is_wpte_activated() && $qry->have_posts() ) ){ ?>
<section class="featured-trip" id="featured_section">
	<div class="container">
		
        <?php if( $title || $content ){ ?>
        <header class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
			<?php 
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_featured_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_featured_content() ) . '</div>'; 
            ?>
		</header>
        <?php } ?>        
        
        <?php 
        if( travel_agency_is_wpte_activated() && $qry->have_posts() ){ 
            $currency = $obj->get_trip_currency();
            $new_obj  = new Wp_Travel_Engine_Functions(); ?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s"">
    			<?php 
                    while( $qry->have_posts() ){ 
                        $qry->the_post(); 
                        $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); ?>			
            			<div class="col">            				
                            <div class="img-holder">
            					<a href="<?php the_permalink(); ?>">
                                    <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( 'travel-agency-blog' );                        
                                    }else{ ?>
                                        <img src="<?php echo esc_url( TRAVEL_AGENCY_COMPANION_URL . 'includes/images/fallback-img-410-250.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />    
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
            				</div>            				
                            <div class="text-holder">
            					<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            					<div class="meta-info">            						
                                    <?php 
                                        if( isset( $meta['trip_duration'] ) || isset( $meta['trip_duration_nights'] ) ){ 
                                            echo '<span class="time"><i class="fa fa-clock-o"></i>'; 
                                            if( $meta['trip_duration'] ) printf( esc_html__( '%s Days', 'travel-agency-companion' ), absint( $meta['trip_duration'] ) ); 
                                            if( $meta['trip_duration_nights'] ) printf( esc_html__( ' - %s Nights', 'travel-agency-companion' ), absint( $meta['trip_duration_nights'] ) ); ;
                                            echo '</span>';                                       
                                        } 
                                    ?>                        
            					</div>
            					<?php if( $view_detail ){ ?>
                                <div class="btn-holder">
            						<a href="<?php the_permalink(); ?>" class="btn-more"><?php echo esc_html( travel_agency_companion_get_featured_label() ); ?></a>
            					</div>
                                <?php } ?>
            				</div>
            			</div>
            			<?php 
                    }
                    wp_reset_postdata();
                ?>
    		</div>
        
        
            <?php            
            $term_link = ( $trip_type == 'select_cat' && $trip_cat ) ? get_term_link( $trip_cat, 'activities' ) : $view_all_link;
            
            if( $term_link && $view_all ){ ?>
      		    <div class="btn-holder featured-btn-holder">
        			<a href="<?php echo esc_url( $term_link ); ?>" class="btn-more featured-btn-more"><?php echo esc_html( travel_agency_companion_get_featured_view_all_label() ); ?></a>
        		</div>
                <?php 
            }        
        }elseif( $ed_demo ){
            //Default
            $featured = $defaults->default_trip_featured_posts();?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
				<?php foreach( $featured as $v ){ ?>
                <div class="col">
					<div class="img-holder">
						<a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ); ?>"></a>
						<span class="price-holder"><span><?php echo esc_html( $v['sale_price'] ); ?></span></span>
					</div>
					<div class="text-holder">
						<h3 class="title"><a href="#"><?php echo esc_html( $v['title'] ); ?></a></h3>
						<div class="meta-info">
							<span class="time"><i class="fa fa-clock-o"></i><?php echo esc_html( $v['days'] ); ?></span>
						</div>
						<div class="btn-holder">
							<a href="#" class="btn-more"><?php esc_html_e( 'View Detail', 'travel-agency-companion' ); ?></a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="btn-holder featured-btn-holder">
				<a href="#" class="btn-more featured-btn-more"><?php esc_html_e( 'View all trip', 'travel-agency-companion' ); ?></a>
			</div>
            <?php
        } 
        ?>
	</div>
</section>
<?php 
}