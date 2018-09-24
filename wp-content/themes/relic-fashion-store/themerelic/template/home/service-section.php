<?php
/**
 * Use: Homepage service section
 * Description: Display the service area function
 * @package Relic_Fashion_Store
 */
 function relic_fashion_store_service_section(){
        /**
         * Use: Default Value ser for service section.
         * Description: fix the service section.
         * @array Slider Default Value Array
         */
        $defaults = array(
            array(
                'service_icons'     => 'fa fa-truck',
                'service_title'     => 'Free Shipping',
                'service_short_desc'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.'                        
            ),
            array(
                'service_icons'     => 'fa fa-close',
                'service_title'     => 'Free Cancellation',
                'service_short_desc'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.'  
            ),
            array(
                'service_icons'     => 'fa fa-user',
                'service_title'     => '24/7 Customer Support',
                'service_short_desc'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tincidunt mauris eget maximus. Pellentesque ullamcorper vel neque imperdiet vulputate.'  
            )
        );
        $service_box_items = get_theme_mod( 'relic_fashion_store_service_box_items', $defaults );
    ?>

    <!-- service section -->
    <section id="homepage-service-box" class="shipping_content">
        <div class="container">
            <div class="row">
                
                <?php 
                    //default value
                    $service_box_count = 0;
                    $service_box_color = '';

                    foreach( $service_box_items as $service_item ){ 
                         
                ?>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="shipping_item clearfix <?php echo esc_attr($service_box_color); ?>">
                            <div class="shipping_text">
                                <h4 itemprop="headline"><?php echo esc_attr( $service_item['service_title'] ); ?></h4>
                                <p class="description" itemprop="description"><?php echo esc_attr( $service_item['service_short_desc'] ); ?></p>
                            </div>
                            <div class="shipping">
                                <i class="<?php echo esc_attr( $service_item['service_icons'] ); ?>"></i>
                            </div>
                        </div>
                    </div>
                    <?php  $service_box_color = (( $service_box_count % 2 ) == 0 ) ? 'red' : 'blue'; ?>
                <?php $service_box_count++;} ?>

            </div>
        </div>
    </section>
    <!-- #service section -->
    <?php
}
add_action( 'homepage-service-section','relic_fashion_store_service_section' );