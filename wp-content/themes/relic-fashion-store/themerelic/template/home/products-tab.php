<?php
/**
 * Use: Homepage Products Tabs
 * Description: Display the products tab section. 
 * @package Relic_Fashion_Store
 */

if( ! function_exists( 'relic_fashion_store_products_tabs' ) ) {
    function relic_fashion_store_products_tabs(){
        //customizer Value
        $relic_fashion_store_products_tabs_multiple_cat     = get_theme_mod( 'relic_fashion_store_products_tabs_multiple_cat',array(relic_fashion_store_get_default_products_categories()) );
        $relic_fashion_store_products_tab_number_of_products= intval( get_theme_mod( 'relic_fashion_store_products_tab_number_of_products',6 ) );
        ?>

        <!-- product_item -->
        <section id="homepage-tab-section" class="product">
            <div class="container ">
                <div class="row products-tab-wraper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 products-tab-list">
                        <div class="product_catagory">
                            <h5 id="relic_fashion_store_products_tabs_title" itemprop="headline">
                                <?php echo relic_fashion_store_get_products_tab_section_title();  ?>
                            </h5>
                            
                            <ul  class="tabs relic-products-tab"><!-- Products Tab -->

                                <?php
                                    //Products Tab Section Hear 
                                    $category_count = 1;
                                        if(!empty($relic_fashion_store_products_tabs_multiple_cat)){
                                        foreach($relic_fashion_store_products_tabs_multiple_cat as $tab_product_cat => $tab_product_cat_id){ 
                                            $term = get_term_by( 'id', $tab_product_cat_id, 'product_cat');
                                    
                                            //term links hear
                                            if($term == null){
                                                $tab_product_cat_id = relic_fashion_store_woo_cat_id_by_slug('accessories');
                                                
                                                $term = get_term_by( 'id', $tab_product_cat_id, 'product_cat');
                                                
                                                $relic_fashion_store_products_tabs_multiple_cat  = array($tab_product_cat_id);
                                            }
                                    ?>
                                    
                                    <li select_category_id = "<?php echo esc_attr( $tab_product_cat_id ); ?>" product_count= "<?php  echo esc_attr( $relic_fashion_store_products_tab_number_of_products ); ?>"  class="tab-link relic-products-tabs-title <?php if($category_count == 1){ ?> current <?php }$category_count++; ?>" data-tab="<?php echo esc_attr( $term->slug ); ?>"><a href="#<?php echo esc_attr( $term->slug ); ?>" ><?php echo esc_attr( $term->name ); ?></a></li>
                                
                                <?php  }}  ?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 products-tab-section ">
                        
                        <div id="tab-1" class="pro_right tab-content current">
                            <div class="products-tab-slider owl-carousel owl-theme row">
                            <!-- Products Loop -->
                                <?php
                                    $product_args = array(
                                        'post_type' => 'product',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy'  => 'product_cat',
                                                'field'     => 'term_id', 
                                                'terms'     => reset( $relic_fashion_store_products_tabs_multiple_cat ) // First Element's Value                                                            
                                            ),
                                            array(
                                                'taxonomy' => 'product_visibility',
                                    			'field' => 'name',
                                    			'terms' => 'exclude-from-catalog',
                                    			'operator'	=>	'NOT IN'
                                            )
                                        ),
                                        'posts_per_page' => $relic_fashion_store_products_tab_number_of_products
                                    );
                                    $query = new WP_Query($product_args);
                                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                                ?>
                                    <div class="item col-sm-12 col-md-12 col-lg-12 products-full">
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                                    </div>
                                <?php } } wp_reset_postdata(); ?>
                            </div>
                        </div><!-- End Tab Section -->

                    </div><!-- End Tab Row -->
                </div><!-- End Tab Row -->
            </div><!-- End Tab Container -->
        </section><!-- End Tab Section -->
        

      <?php
    }
}
add_action( 'single_categry_products','relic_fashion_store_products_tabs' );