<?php
/**
 * Use: Homepage Category And Products
 * Description: Display the category and product
 * @package Relic_Fashion_Store
 */
if( ! function_exists( 'relic_fashion_store_single_category_and_products_section' ) ) {
    function relic_fashion_store_single_category_and_products_section(){
        //customizer Value
        $relic_fashion_store_single_products_cat_id_select            = intval( get_theme_mod( 'relic_fashion_store_single_category_and_products_cat_id_select', relic_fashion_store_get_default_products_categories() ) );
        
        $relic_fashion_store_single_product_btn_text                  = get_theme_mod( 'relic_fashion_store_single_product_btn_text','VIEW ALL ' );
        $relic_fashion_store_products_single_category_and_products_count = intval( get_theme_mod( 'relic_fashion_store_products_single_category_and_products_count',6 ) );
        

        // Category Term ID 
        $category_term = get_term_by( 'id', $relic_fashion_store_single_products_cat_id_select, 'product_cat');
        

        //default
        if($category_term == null){
            $relic_fashion_store_single_products_cat_id_select = relic_fashion_store_woo_cat_id_by_slug('tshirts');
            $category_term = get_term_by( 'id', $relic_fashion_store_single_products_cat_id_select, 'product_cat');
        }

        //links
        $single_category_links = get_term_link(intval( $relic_fashion_store_single_products_cat_id_select ), 'product_cat');

        //Category Image
        $thumbnail_id = get_term_meta( $relic_fashion_store_single_products_cat_id_select, 'thumbnail_id', true );
        $category_image = wp_get_attachment_url( $thumbnail_id );
        ?>
        <!-- product -->
        <section id="homepage_single_category_and_products_cat_id_select" class="product single-category-section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="pro_add">
                            <h3 itemprop="headline"><?php echo esc_html($category_term->name); ?></h3>
                            <h5 itemprop="description"><?php echo wp_kses_post($category_term->description); ?></h5>
                            <a href="<?php echo esc_url( $single_category_links ); ?>" class="view"><?php echo esc_attr( $relic_fashion_store_single_product_btn_text ); ?> <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 products-single-products">
                        <div class="products-tab-slider owl-carousel owl-theme row">
                            <?php
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
                                    'posts_per_page' => $relic_fashion_store_products_single_category_and_products_count
                                );
                                $query = new WP_Query( $product_args );
                                if( $query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                    ?>
                                        <div class="item col-sm-12 col-md-12 col-lg-12 products-full">
                                            <?php wc_get_template_part( 'content', 'product' ); ?>
                                        </div>
                                <?php } } wp_reset_postdata(); ?>
                        </div><!-- End Row -->
                    </div><!-- End Column Section -->
                </div><!-- End Main Row -->
            </div><!-- End Container -->
        </section><!-- End Section -->
      <?php
    }
}
add_action( 'single_products','relic_fashion_store_single_category_and_products_section' );