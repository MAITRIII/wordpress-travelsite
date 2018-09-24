<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Agency
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
    <?php
        $meta     = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
        $currency = travel_agency_get_trip_currency(); ?>
        <div class="img-holder">
            <a href="<?php the_permalink(); ?>">
            <?php
                if( has_post_thumbnail() ){        
                    the_post_thumbnail( 'travel-agency-blog', array( 'itemprop' => 'image' ) );        
                }else{ ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/fallback-img-410-250.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" itemprop="image" />            
                <?php
                }
                
                if( isset( $meta['trip_price'] ) && ! empty( $meta['trip_price'] ) ){
                    $price = $meta['trip_price'];
                }elseif( isset( $meta['trip_prev_price'] ) && ! empty( $meta['trip_prev_price'] ) ){
                    $price = $meta['trip_prev_price'];
                }else{
                    $price = false;
                }
                if( $price ) echo '<span class="price-holder"><span>' . esc_html( $currency . $price ) . '</span></span>';
            ?>
            </a>
        </div>
    
    
    <div class="text-holder">        
        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="meta-info">
			<?php 
                if( isset( $meta['trip_duration'] ) ) echo '<span class="time"><span><i class="fa fa-clock-o"></i>' . absint( $meta['trip_duration'] ) . esc_html__( ' Days', 'travel-agency' ) . '</span></span>'; 
            ?>                        
		</div>
		<div class="btn-holder">
			<a href="<?php the_permalink(); ?>" class="btn-more"><?php esc_html_e( 'View Detail', 'travel-agency' ); ?></a>
		</div>
    </div><!-- .text-holder -->
    
</article><!-- #post-<?php the_ID(); ?> -->