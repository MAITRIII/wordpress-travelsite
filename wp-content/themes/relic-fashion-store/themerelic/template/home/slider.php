<?php
/**
 * Use: Homepage slider section
 * Description: Relic fashion store slider all settings.
 * @package Relic_Fashion_Store
 */
 function relic_fashion_store_homepage_slider_section(){
    if( get_theme_mod('relic_fashion_store_slider_enable',true) == true ):
        /**
         * Use: Default Value set in Slider Section
         * Description: Slider Default image size Fix.
         * @array Slider Default Value Array
         */
        $defaults = array(
            array(
                'slider_text'       => 'Up To 30% Summer Sale Now Starting at $45.00',
                'slider_links'      => 'https://relic-fashion-store.com/links',
                'slider_btn_text'   => 'EXPLORE',
                'slider_image'      => '',                       
            ),
            array(
                'slider_text'   => 'The new collection  is here!',
                'slider_links'  => 'https://relic-fashion-store.com/links',
                'slider_btn_text'  => 'Shop Now',
                'slider_image'  => ''               
            )
        );
        $slider_section_items = get_theme_mod( 'relic_fashion_store_slider_items', $defaults );

        ?>
        <!-- banner -->
        <section id="homepage_banner_slider" class="banner_content">
            <div id="big-slide" class="owl-carousel owl-theme">

                <?php 
                    foreach( $slider_section_items as $slider_item ) {

                        //Image size Default image fix
                        $slider_image = $slider_item['slider_image']; 

                        if( intval($slider_image) ){
                            $slider_image = wp_get_attachment_url( $slider_image ); 
                        }else{
                            $slider_image = get_template_directory_uri().'/assets/images/homepage/slider-image-first.jpg';  
                        }
                        ?>
                        <div class="row item">
                            <div class="col-md-12">
                                <div class="banner-control">
                                    <img src="<?php echo esc_url( $slider_image ); ?>" alt="<?php echo esc_attr( $slider_item['slider_text'] ); ?>" class="img-responsive">
                                </div>
                                <div class="container">
                                    <div class="banner_item-v2">
                                        <h2><?php echo esc_attr( $slider_item['slider_text'] ); ?></h2>
                                        <a href="<?php echo esc_url( $slider_item['slider_links'] ); ?>" class="explore"><?php echo esc_html( $slider_item['slider_btn_text'] ); ?><i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                
            </div><!-- #End Owl Carousel -->
        </section><!-- #End Banner content Section --> 

        <?php
    endif;
}
add_action( 'slider-section','relic_fashion_store_homepage_slider_section' );