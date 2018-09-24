<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relic_Fashion_Store
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
		<meta name="author" content="<?php bloginfo( 'author' ); ?>"/>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php relic_fashion_store_tag_schema(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html__( 'Skip to content', 'relic-fashion-store' ); ?></a>

		<!-- header -->
		<header class="clearfix header-image-background" itemscope itemtype="http://schema.org/Organization" >
			<?php //do_action('relic_fashion_store_before_header'); ?>
			<div class="header-wrap-2" >
				<div class="container clearfix">
					<div class="row">
					<div class="col-md-3 col-xs-12"><?php relic_fashion_store_logo(); //Header Logo Section  ?></div>

					<div class="col-md-6 col-xs-12"><?php do_action('relic-fashion-store-header-search'); //Header Search Box Section ?></div>
					<div class="col-md-3 col-xs-12"><?php relic_fashion_store_woocommerce_logo(); ?></div>
					</div>
				</div>
			</div>
			<nav itemscope itemtype="http://schema.org/SiteNavigationElement">
				<div class="container">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'menu_id'        => 'primary-menu',
							'menu_class'	 =>  'main-menu'
						) );
					?>
				</div>
			</nav>
		</header>
		<div id="content" class="site-content">