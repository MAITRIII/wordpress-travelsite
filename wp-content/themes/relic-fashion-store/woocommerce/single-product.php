<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

//Single products
$woocommerce_single_page_sidebar = get_theme_mod( 'relic_fashion_store_woocommerce_singlepage_sidebar','full-width' );
       
if( $woocommerce_single_page_sidebar == 'full-width' ){
    $woocommerce_single_page_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
}else{
    $woocommerce_single_page_class = 'col-lg-9 col-md-12 col-sm-12 col-xs-12';
}
?>
    
    <!-- inner-page -->
    <div class="inner-page">
        
            <?php
                /**
                 * woocommerce_before_main_content hook.
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action( 'woocommerce_before_main_content' );
            ?>
        <div class="container">
            <div class="row">
            <?php if ( $woocommerce_single_page_sidebar == 'left-sidebar' ){ get_sidebar('woocommerce'); } ?>
                <div class="<?php echo esc_attr( $woocommerce_single_page_class ); ?>">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'single-product' ); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
                <?php if ( $woocommerce_single_page_sidebar == 'right-sidebar' ){ get_sidebar('woocommerce'); } ?>
                <?php
                    /**
                     * woocommerce_after_main_content hook.
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                
                ?>
            </div>
        </div>

<?php get_footer( 'shop' );