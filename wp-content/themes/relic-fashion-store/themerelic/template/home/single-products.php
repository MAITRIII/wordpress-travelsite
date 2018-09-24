<?php
/**
 * Use: Homepage Single Products
 * Description: Display the single products tab section. 
 * @package Relic_Fashion_Store
 */

if( ! function_exists( 'relic_fashion_store_single_products_section' ) ) {
    function relic_fashion_store_single_products_section(){
        //customizer Value
        $relic_fashion_store_single_products_cat_id_select            = intval( get_theme_mod( 'relic_fashion_store_single_products_and_cat_cat_id_select', relic_fashion_store_get_default_products_categories()  ) );
        
        // Category Term ID 
        $category_term = get_term_by( 'id', $relic_fashion_store_single_products_cat_id_select, 'product_cat');
        
        //term links hear
        if($category_term == null){
            $relic_fashion_store_single_products_cat_id_select = relic_fashion_store_woo_cat_id_by_slug('accessories');
            $category_term = get_term_by( 'id', $relic_fashion_store_single_products_cat_id_select, 'product_cat');
        }

        //Category Links
        $single_category_links = get_term_link(intval( $relic_fashion_store_single_products_cat_id_select ), 'product_cat');
        
        //Category Image
        $thumbnail_id = get_term_meta( $relic_fashion_store_single_products_cat_id_select, 'thumbnail_id', true );
        $category_image = wp_get_attachment_url( $thumbnail_id );
        
        ?>

        <!-- product_add -->
        <section id="homepage_single_products_sec" class="product_add">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-7">
                        <div class="product_add_item" <?php if ( $category_image ) { ?> style="background-image:url('<?php echo esc_url( $category_image ); ?>'); " <?php } ?>>
                            <div class="pro_add_text single_product_section">
                                <h2 itemprop="headline">
                                    <?php 
                                        //Products Title
                                        if( get_theme_mod('relic_fashion_store_single_product_title_text') == '' ){
                                            //Single products 
                                            echo esc_html( $category_term->name ); 
                                        }else{
                                           echo esc_html( relic_fashion_store_single_product_title_text_callback() );
                                        }
                                        
                                    ?>
                                </h2>
                                <p class="text_des" itemprop="description">
                                    <?php 
                                        
                                        //Products Title
                                        if( get_theme_mod('relic_fashion_store_single_product_description_text') == '' ){
                                            //Single products 
                                            echo esc_html( $category_term->description ); 
                                        }else{
                                           echo esc_html( relic_fashion_store_single_product_description_text_callback() );
                                        }
                                    ?>
                                </p>
                                <a class="view-all" href="<?php echo esc_url( $single_category_links ); ?>"><?php echo esc_html( relic_fashion_store_single_product_btn_text_change_sec_callback() ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-5">
                        <div class="product_add_item2">
                            <div class="row">
                                <?php
                                    //woocommerce Category Section
                                    $relic_fashion_store = new Relic_Fashion_Store_Woocommerce();

                                    //Query Section Hear
                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'term_id', 
                                                'terms'     => $relic_fashion_store_single_products_cat_id_select                                                                 
                                            ),
                                            array(
                                                'taxonomy' => 'product_visibility',
                                    			'field' => 'name',
                                    			'terms' => 'exclude-from-catalog',
                                    			'operator'	=>	'NOT IN'
                                            )
                                        ),
                                        'posts_per_page' => 1
                                    );
                                    $query = new WP_Query($product_args);
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-5">
                                        <div class="product_img">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">    
                                        <div class="product_text">
                                            <h6 itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                            <?php 
                                                $relic_fashion_store->relic_fashion_store_get_star_rating();#Relic Fashion Store Star Rating                                                
                                                woocommerce_template_loop_price();#Woocommerce Template loop Price ?>

                                                <small><?php $relic_fashion_store->relic_fashion_store_sale_percentage_loop();#Sale percentage Loop ?></small>
                                            <div class="single-category-widget-cart">
                                                <div class="cart">
                                                    <?php
                                                        woocommerce_template_loop_add_to_cart();
                                                        $relic_fashion_store->relic_fashion_products_add_wishlist();
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } wp_reset_postdata();  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

      <?php
    }
}
add_action( 'single_products','relic_fashion_store_single_products_section' );