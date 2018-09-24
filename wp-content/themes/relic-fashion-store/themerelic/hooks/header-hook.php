<?php
class Relic_Fashion_Store_header{
	
	public function __construct(){
        //Add The Action Hear
        add_action('relic-fashion-store-header-search',array($this,'relic_fashion_store_header_search_form'));
    }

    /**************************************************************************
     *                         Relic Fashion Store Search Form
    ***************************************************************************/
    public function relic_fashion_store_header_search_form() { 
        
        if( get_theme_mod('relic_fashion_store_search_box_enable',true) == true ):
        ?>
        <div id="relic_fashion_store_search_box_enable" class="search-form">
            <form class="main-form clearfix" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text"  name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search Products', 'relic-fashion-store'); ?>">
                <?php if (class_exists('WooCommerce')) : ?>
                <?php 
                    if( isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']) )
                        {
                        $optsetlect = sanitize_text_field( wp_unslash( $_REQUEST['product_cat'] ) );
                    }
                    else{
                    $optsetlect = 0;  
                    }
                    $args = array(
                                'show_option_all' => esc_html__( 'Categories', 'relic-fashion-store' ),
                                'hierarchical' => 1,
                                'class' => 'cat',
                                'echo' => 1,
                                'value_field' => 'slug',
                                'selected' => $optsetlect
                            );
                        $args['taxonomy'] = 'product_cat';
                        $args['name'] = 'product_cat';              
                        $args['class'] = 'cate-dropdown hidden-xs';
                        wp_dropdown_categories($args);
                ?>
                <input type="hidden" value="product" name="post_type">
                <?php endif; ?>
                <button type="submit" title="<?php esc_attr_e('Search', 'relic-fashion-store'); ?>" class="search-btn-bg"><img src="<?php echo  esc_url( get_template_directory_uri()."/assets/images/arrow.png" ); ?>" alt="arrow"></button>
            </form>
        </div>
    
        <?php
        endif;
    }

    /**************************************************************************
     *                    Breadcrumb Woocommerce 
     **************************************************************************/
    function relic_fashion_store_breadcrumb_woocommerce() {
        
        if( get_theme_mod('relic_fashion_store_breadcrumbs_enable',true) == true) { 
           
        ?>
        <!-- inner-page -->
        <div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-section-header">
                                <?php  if( relic_fashion_store_is_woocommerce_activated() ){ woocommerce_breadcrumb(); }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }

}
$Relic_Fashion_Store_header = new Relic_Fashion_Store_header();