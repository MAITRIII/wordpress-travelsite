<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relic_Fashion_Store
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	<aside id="left-sidebar" class="widget-area" itemscope itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #left-sidebar -->
</div>
