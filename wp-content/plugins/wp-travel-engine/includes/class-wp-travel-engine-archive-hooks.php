<?php
/**
 *
 * This class defines all hooks for archive page of the trip.
 *
 * @since      1.0.0
 * @package    Wp_Travel_Engine
 * @subpackage Wp_Travel_Engine/includes
 * @author     WP Travel Engine <https://wptravelengine.com/>
 */
/**
* 
*/
class Wp_Travel_Engine_Archive_Hooks
{
	
	function __construct()
	{
		add_action( 'wp_travel_engine_trip_archive_outer_wrapper', array( $this, 'wp_travel_engine_trip_archive_wrapper' ) );
		
		add_action( 'wp_travel_engine_trip_archive_wrap', array( $this, 'wp_travel_engine_trip_archive_wrap' ) );
		
		add_action( 'wp_travel_engine_trip_archive_outer_wrapper_close', array( $this, 'wp_travel_engine_trip_archive_outer_wrapper_close' ) );

	}

	/**
     * Main wrap of the archive.
     *
     * @since    1.0.0
     */
	function wp_travel_engine_trip_archive_wrapper()
	{ ?>
		<div id="wte-crumbs">
            <?php
            do_action('wp_travel_engine_breadcrumb_holder');
            ?>
		</div>
		<div id="wp-travel-trip-wrapper" class="trip-content-area">
            <div class="wp-travel-inner-wrapper">
	<?php
	}

	/**
     * Inner wrap of the archive.
     *
     * @since    1.0.0
     */
	function wp_travel_engine_trip_archive_wrap()
	{ ?>
			<div class="wp-travel-engine-archive-outer-wrap">
				<header class="page-header">
					
					<?php
						echo '<h1 class="page-title">'.__('Trips','wp-travel-engine').'</h1>';
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<?php do_action('wte_advanced_search'); ?>
				<div class="wp-travel-engine-archive-repeater-wrap">
				<?php
				global $post;
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$wte_doc_tax_post_args = array(
        			'post_type' => 'trip', // Your Post type Name that You Registered
        			'posts_per_page' => -1,
        			'order' => 'ASC',
        			'paged' => $paged
    			);
    			$wte_doc_tax_post_qry = new WP_Query($wte_doc_tax_post_args);
			    if($wte_doc_tax_post_qry->have_posts()) :
			       while($wte_doc_tax_post_qry->have_posts()) :
			            $wte_doc_tax_post_qry->the_post(); 
				// Start the Loop.
				// while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					$wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting',true );
					$wp_travel_engine_setting_option_setting = get_option( 'wp_travel_engine_settings', true ); ?>					
					
						<div class="wp-travel-engine-archive-wrap">
								<a href="<?php echo esc_url( get_the_permalink() );?>" class="trip-post-thumbnail"><?php
                                $trip_feat_img_size = apply_filters('wp_travel_engine_archive_trip_feat_img_size','trip-thumb-size');
								$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $trip_feat_img_size ); ?>
	        						<img src="<?php echo esc_url( $feat_image_url[0] );?>">
	        					</a>
								<h1 class="entry-title"><a href="<?php echo esc_url( get_the_permalink() );?>"><?php the_title();?></a></h1>
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
				                if( $cost!='' )
				                { ?>
									<div class="trip_price">
					                    <?php
						                    _e('Price: ','wp-travel-engine');
						                    if( $prev_cost!='' && isset($wp_travel_engine_setting['sale']) )
                                            {
                                                echo "<strike style='color:red'>";
                                                echo "<span style='color:#fff'>".esc_attr($currency.$obj->wp_travel_engine_price_format($prev_cost).' '.$code).'</span>';
                                                echo '</strike>';
                                            }
						                    $obj = new Wp_Travel_Engine_Functions();
						                    echo ' '.esc_attr( $currency.$obj->wp_travel_engine_price_format($cost).' '.$code );
					                    ?>
									</div>
				                <?php
				            	}
				            	if( isset( $wp_travel_engine_setting['trip_duration'] ) && $wp_travel_engine_setting['trip_duration']!='' )
				            	{ ?>
									<div class="trip_duration">
                                        <?php
                                        _e('Duration: ','wp-travel-engine');?><?php echo esc_attr($wp_travel_engine_setting['trip_duration']); if($wp_travel_engine_setting['trip_duration']>1){ _e(' days','wp-travel-engine');} else{ _e(' day','wp-travel-engine'); }
                                        ?>
                                    </div>
								<?php } 
								?>
							<div class="trip-short-content"><?php the_excerpt();?></div>
							<?php
							$wp_travel_engine_setting = get_post_meta( $post->ID,'wp_travel_engine_setting', true );
							?>
						</div>
					<?php
					endwhile; endif;?>
				</div>
			</div>
			<?php
			$obj = new Wp_Travel_Engine_Functions;
			$obj->pagination_bar( $wte_doc_tax_post_qry );
	}

	/**
     * Oter wrap of the archive.
     *
     * @since    1.0.0
     */
	function wp_travel_engine_trip_archive_outer_wrapper_close()
	{ ?>

		</div><!-- wp-travel-inner-wrapper -->
		</div><!-- .wp-travel-trip-wrapper -->
	<?php
	}
}
new Wp_Travel_Engine_Archive_Hooks();