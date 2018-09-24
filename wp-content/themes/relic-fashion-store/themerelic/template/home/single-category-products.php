<?php
/**
 * Use: Homepage Single Category Products
 * Description: Display the single category products all settings.
 * @package Relic_Fashion_Store
 */

if( ! function_exists( 'relic_fashion_store_single_categry_products' ) ) {
    function relic_fashion_store_single_categry_products(){
        //customizer Value
        $relic_fashion_store_single_category_id_select = intval( get_theme_mod( 'relic_fashion_store_single_category_id_select', relic_fashion_store_get_default_products_categories()  ) );
        $relic_fashion_store_single_category_porducts_count = intval( get_theme_mod( 'relic_fashion_store_single_category_porducts_count',4 ) );
        ?>

        <!-- product -->
        <section id="homepage-single-category-products" class="product">
            <div class="container">
                <div class="row">

                    <?php
                        //Products Argument
                        $product_args = array(
                            'post_type' => 'product',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'product_cat',
                                    'field'     => 'term_id', 
                                    'terms'     => $relic_fashion_store_single_category_id_select                                                                 
                                ),
                                array(
                                    'taxonomy' => 'product_visibility',
                        			'field' => 'name',
                        			'terms' => 'exclude-from-catalog',
                        			'operator'	=>	'NOT IN'
                                )
                            ),
                            'posts_per_page' => $relic_fashion_store_single_category_porducts_count
                        );
                        $query = new WP_Query($product_args);
                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <div class="col-sm-12 col-md-6 col-lg-3 products-full">
                                <?php wc_get_template_part( 'content', 'product' ); ?>
                            </div>
                    <?php } } wp_reset_postdata(); ?>
                        
                    
                </div>
            </div>
        </section>

      <?php
    }
}
add_action( 'single_categry_products','relic_fashion_store_single_categry_products' );
