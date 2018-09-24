<?php
/**
 * Our Deals Section
 * 
 * @package Travel_Agency
 */

$defaults    = new Travel_Agency_Companion_Dummy_Array;
$obj         = new Travel_Agency_Companion_Functions;
$ed_demo     = get_theme_mod( 'ed_deal_demo', true );
$title       = get_theme_mod( 'deal_title', __( 'Deals and Discounts', 'travel-agency-companion' ) );
$content     = get_theme_mod( 'deal_desc', __( 'how the special deals and discounts to your customers here. You can customize this section from Appearance > Customize > Home Page Settings > Deals Section.', 'travel-agency-companion' ) );
$post_one    = get_theme_mod( 'deal_post_one' );
$post_two    = get_theme_mod( 'deal_post_two' );
$post_three  = get_theme_mod( 'deal_post_three' );
$label       = get_theme_mod( 'deal_readmore', __( 'Book Now', 'travel-agency-companion' ) );
$view_all    = get_theme_mod( 'deal_view_all_label', __( 'View All Deals', 'travel-agency-companion' ) );
$view_url    = get_theme_mod( 'deal_view_all_url', '#' );
$posts       = array( $post_one, $post_two, $post_three );
$posts       = array_diff( array_unique( $posts ), array('') );

$args = array( 
    'post_type'      => 'trip',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__in'       => $posts,
    'orderby'        => 'post__in'
);

$qry = new WP_Query( $args );

if( $title || $content || ( travel_agency_is_wpte_activated() && $posts && $qry->have_posts() ) ){ ?>

<section class="our-deals" id="deal_section">
	<div class="container">
		
        <?php if( $title || $content ){ ?>
        <header class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
			<?php 
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_deal_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_deal_content() ) . '</div>'; 
            ?>
		</header>
        <?php } ?>
        
        <?php 
        if( travel_agency_is_wpte_activated() && $posts && $qry->have_posts() ){ 
            $currency = $obj->get_trip_currency(); 
            $new_obj  = new Wp_Travel_Engine_Functions(); ?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
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
                                <?php }
                            ?>                        
                            </a>
        					<?php 
                                if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                    echo '<span class="price-holder"><span>';
                                    if( isset( $meta['trip_prev_price'] ) ){
                                        if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo '<strike>';
                                        if( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) echo esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_prev_price'] ) );
                                        if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo '</strike> ';    
                                    } 
                                    if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo esc_html( $currency . $new_obj->wp_travel_engine_price_format( $meta['trip_price'] ) );
                                    echo '</span></span>';
                                
                                    if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ){
                                        $diff = (int)( $meta['trip_prev_price'] - $meta['trip_price'] );
                                        $perc = (float)( ( $diff / $meta['trip_prev_price'] ) * 100 );                                    
                                        printf( __( '<span class="discount-holder"><span>%1$s&percnt; Off</span></span>', 'travel-agency-companion' ), round( $perc ) );
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
        					
                            <?php if( $label ){ ?>
                                <div class="btn-holder">
            						<a href="<?php the_permalink(); ?>" class="btn-more"><?php echo esc_html( travel_agency_companion_get_dealbtn_label() ); ?></a>
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
        }elseif( $ed_demo ){
            //default
            $deals = $defaults->default_trip_deal_posts(); ?>
            <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
				<?php foreach( $deals as $v ){ ?>
                <div class="col">
					<div class="img-holder">
						<a href="#"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo $v['title']; ?>"></a>
						<span class="price-holder"><span><strike><?php echo esc_html( $v['old_price'] ); ?></strike><?php echo esc_html( $v['sale_price'] ); ?></span></span>
						<span class="discount-holder"><span><?php echo esc_html( $v['discount'] ); ?></span></span>
					</div>
					<div class="text-holder">
						<h3 class="title"><a href="#"><?php echo esc_html( $v['title'] ); ?></a></h3>
						<div class="meta-info">
							<span class="time"><i class="fa fa-clock-o"></i><?php echo esc_html( $v['days'] ); ?></span>
						</div>
						<div class="btn-holder">
							<a href="#" class="btn-more"><?php esc_html_e( 'Book Now', 'travel-agency-companion' ); ?></a>
						</div>
					</div>
				</div>				
				<?php } ?>
			</div>
            <?php
        } 
        
        if( $view_all && $view_url ){
            echo '<div class="btn-holder deal-btn-holder"><a href="' . esc_url( $view_url ) . '" class="btn-more deal-btn-more">' . travel_agency_companion_get_deal_view_all_label() . '</a></div>';
        }
        ?>
	</div>
</section>
<?php
}