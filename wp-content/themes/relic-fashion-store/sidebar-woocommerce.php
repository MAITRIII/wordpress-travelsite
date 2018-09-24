<?php
/**
 * The Woocommerce sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relic_Fashion_Store
 */

if ( ! is_active_sidebar( 'woocommerce-sidebar' ) ) {
	return;
}
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	<aside id="woocommerce-sidebar" class="widget-area " itemscope itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
	</aside><!-- #woocommerce Sidebar -->
</div>