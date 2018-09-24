<?php
/**
 * Use: Homepage Instagram Feed
 * Description: Display instagram post images.
 * @package Relic_Fashion_Store
 */

function relic_fashion_store_instagram_feed_section(){
    /** Instagram feed customizer data */
    $relic_fashion_store_instagram_feed_tocken_id   = get_theme_mod( 'relic_fashion_store_instagram_feed_tocken_id' );
    $relic_fashion_store_instagram_feed_post_count  = intval( get_theme_mod( 'relic_fashion_store_instagram_feed_post_count',8 ) );
    
    /** Instagram feed functions call */
    $instagram_feed    = relic_fashion_store_insta_feeds( $relic_fashion_store_instagram_feed_tocken_id, $relic_fashion_store_instagram_feed_post_count );
    $count             = count( $instagram_feed['images'] );
    ?>
    <!-- instagram_feed -->
    <section id="instagram_feed" class="container" >
        <div class="instagram_feed">
            <h5><?php echo esc_html( relic_fashion_store_instagram_feed_title_callback() ); ?></h5>
            <div id="instagram" class="owl-carousel owl-theme">
                
                <?php
                    for ( $i = 0; $i < $relic_fashion_store_instagram_feed_post_count; $i ++ ) {
                        if ( $instagram_feed['images'][ $i ] ) {
                ?>
                    <div class="item">
                        <div class="instagram_feed_item">
                            <figure>
                                <img src="<?php echo esc_url( $instagram_feed['images'][ $i ][0] )  ?>" alt="instagram1" itemprop="image">
                                <figcaption>
                                    <a href="<?php echo esc_url( $instagram_feed['images'][ $i ][1] ) ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                <?php } } ?>

            </div><!-- #End instagram feed our-carouse section -->
        </div><!-- #end instagram_feed -->
    </section><!-- #end container -->
    <?php
}
add_action( 'instagram_feed', 'relic_fashion_store_instagram_feed_section' );



/**
 * Instagram Image Get
 * Use: instagram image get from instagram feed.
 * Description: 
 * version:1.0.1
 */
function relic_fashion_store_insta_feeds( $access_token, $image_num ) {    
	$count = $image_num;
	$url                = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . trim( $access_token ). '&count=' . trim( $count );
	$feeds_json         = wp_remote_fopen( $url );
	$feeds_obj          = json_decode( $feeds_json, true ); 

	$feeds_images_array = array();

	if ( 200 == $feeds_obj['meta']['code'] ) {

		if ( ! empty( $feeds_obj['data'] ) ) {

			foreach ( $feeds_obj['data'] as $data ) {
               
				array_push( $feeds_images_array, array( $data['images']['standard_resolution']['url'], $data['link'] ) );
            }

           
			$ending_array = array(
				'link'   => $feeds_obj['data'][0]['user']['username'],
				'images' => $feeds_images_array,
			);
			return $ending_array;
		}
	}
}