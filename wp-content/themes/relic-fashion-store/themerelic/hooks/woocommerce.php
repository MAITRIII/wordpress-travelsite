<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Relic_Fashion_Store
 */
	/******************************************************************************
	 * 					Woocommerce Remove Action Hear
	 ******************************************************************************/
	$Relic_Fashion_Store__Woocommerce = new Relic_Fashion_Store_Woocommerce();
	
	/** Woo Commerce Add Content Primary Div Function */
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);#Remove Woocommerce Sidebar

	/** Woocommerce Products Item */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

	add_action( 'woocommerce_before_shop_loop_item',array($Relic_Fashion_Store__Woocommerce,'relic_fashion_store_woocommerce_before_shop_loop_item'), 10 );

	/** Woocommerce Single Products Social Share */
	if( get_theme_mod('relic_fashion_store_social_share_enable',true) == true ){
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		add_action( 'woocommerce_single_product_summary',array($Relic_Fashion_Store__Woocommerce,'relic_fashion_store_social_share'), 50 );
	}

	
	/** Woocommerce Archive Page Banner */
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	add_action( 'woocommerce_before_main_content',array($Relic_Fashion_Store__Woocommerce,'relic_fashion_store_woocommerce_shop_page_category_banner'),9 );

	/** Woocommerce Breadcrumb Section */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	add_filter( 'woocommerce_show_page_title', '__return_false' );

	//Woocommerce Breadcrumb Section
	add_action( 'woocommerce_before_main_content',array($Relic_Fashion_Store__Woocommerce,'relic_fashion_store_woocommerce_breadcrumb'), 9 );

	

class Relic_Fashion_Store_Woocommerce{
	
	public function __construct(){
		/** Add Filter */
		add_filter( 'body_class', array( $this,'relic_fashion_store_woocommerce_active_body_class' ) );#Body Class Filter
		add_filter( 'loop_shop_per_page', array( $this,'relic_fashion_store_woocommerce_products_per_page' ) );#Products Per Page Options
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
		add_filter( 'woocommerce_product_thumbnails_columns', array( $this,'relic_fashion_store_woocommerce_thumbnail_columns' ) );#fashion Store Loop Column
		add_filter( 'loop_shop_columns', array( $this,'relic_fashion_store_woocommerce_loop_columns' ) );#Loop columns Controls
		add_filter( 'woocommerce_output_related_products_args', array( $this,'relic_fashion_store_woocommerce_related_products_args' ) );#Related Products Args
		add_filter('woocommerce_add_to_cart_fragments',array( $this,'relic_fashion_store_woocommerce_header_add_to_cart_fragment' ));#Add to Cart Fragment Filter
		
		/** Add Action */
		add_action( 'after_setup_theme', array($this,'relic_fashion_store_woocommerce_setup') );
		add_action( 'wp_enqueue_scripts',array($this,'relic_fashion_store_woocommerce_scripts') );
		
		/** Remove action Hear */
		remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'relic_fashion_store_add_compare_link' ), 20 );//Compare Remove Action
		add_action('wp', create_function("", "if (is_singular('product')) remove_action( 'pixelpress_after_wc_content', 'woocommerce_get_sidebar', 10);") );
		
		/** Woocommerc Single Before Single Products */
		add_action( 'woocommerce_before_single_product_summary',array($this,'relic_fashion_store_woocommerce_before_single_product_summary'),9 );
		add_action( 'woocommerce_after_single_product_summary',array($this,'relic_fashion_store_woocommerce_after_single_product_summary'),9 );

	}

	/***********************************************************************
	 * Woocommerce Section Hear
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_setup() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	/***********************************************************************
	 * Woocommerce Quick View Example
	 **********************************************************************/
	public function relic_fashion_store_product_quickview(){
		if ( !defined( 'YITH_WCQV' )) return;

        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
		echo '
			<a title="'. esc_html( 'Quick View', 'relic-fashion-store' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '">
				<span>
					<svg width="24px" height="18px" viewBox="0 0 24 18" version="1.1" xmlns="" xmlns:xlink="">
						<defs></defs>
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<g transform="translate(-668.000000, -3144.000000)" stroke="#000000" stroke-width="0.5" fill="#000000">
							<g transform="translate(660.978105, 3033.965174)">
								<g class="eyes" transform="translate(6.736953, 110.229743)">
									<path d="M12.2339547,11.9576529 C10.5729861,11.9576529 9.21401184,10.5735124 9.21401184,8.86221146 C9.21401184,7.15091048 10.5729861,5.76676998 12.2339547,5.76676998 C13.8949233,5.76676998 15.2538976,7.15091048 15.2538976,8.86221146 C15.2538976,10.5735124 13.8949233,11.9576529 12.2339547,11.9576529 M12.2339547,4.63429139 C9.94383138,4.63429139 8.08153325,6.5469219 8.08153325,8.86221146 C8.08153325,11.2026672 9.94383138,13.0901315 12.2339547,13.0901315 C14.5240781,13.0901315 16.3863762,11.2026672 16.3863762,8.86221146 C16.3863762,6.52175571 14.5240781,4.63429139 12.2339547,4.63429139"></path>
									<path d="M12.2339547,15.6319168 C6.62189418,15.6319168 2.04164745,10.1960196 2.04164745,8.86221146 C2.04164745,7.52840334 6.62189418,2.09250611 12.2339547,2.09250611 C17.8460153,2.09250611 22.426262,7.52840334 22.426262,8.86221146 C22.426262,10.1960196 17.8460153,15.6319168 12.2339547,15.6319168 M12.2339547,0.960027524 C6.04307179,0.960027524 0.909168856,6.69791904 0.909168856,8.86221146 C0.909168856,11.0265039 6.04307179,16.7643954 12.2339547,16.7643954 C18.4248377,16.7643954 23.5587406,11.0265039 23.5587406,8.86221146 C23.5587406,6.69791904 18.4248377,0.960027524 12.2339547,0.960027524">
									</path>
								</g>
							</g>
							</g>
						</g>
					</svg>
				</span>
			</a>	
			';

	}

	/***********************************************************************
	 * Woocommerce Compare List
	 **********************************************************************/
	public function relic_fashion_store_wishlist_products() {
		if ( !defined( 'YITH_WCWL' )) return;
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

				<div class="yith-wcwl-add-button show display-block">  
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist">
						<span class="heart">
							<svg width="19px" height="17px" viewBox="0 0 19 17" >
								<desc><?php echo esc_html__('Created with Sketch.','relic-fashion-store'); ?></desc>
								<defs></defs>
								<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="homepage-2b" transform="translate(-671.000000, -3095.000000)" stroke="#000000" stroke-width="1.6">
										<g id="heart" transform="translate(660.978105, 3033.965174)">
											<path d="M15.569646,62.595271 C16.7375486,62.5929084 17.857609,63.0579432 18.6803779,63.8868154 L19.2257404,64.4380843 L19.7809469,63.8887842 C21.4983466,62.1692189 24.2848142,62.1674469 26.0043796,63.8848466 C27.723945,65.6022462 27.7257169,68.3887139 26.0083172,70.1082792 L25.8705,70.2480653 L19.2257404,76.8987314 L12.458914,70.1082792 C10.7409237,68.3908796 10.7403331,65.6061839 12.4577327,63.8879967 C13.2828642,63.0624714 14.402334,62.5988149 15.569646,62.5992086" id="Page-1-Copy"></path>
										</g>
									</g>
								</g>
							</svg>
						</span>
					</a>
				</div>

				<div class="yith-wcwl-wishlistaddedbrowse hide hidden"> 
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistexistsbrowse hide hidden">
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>

			</div>
		<?php
	}


	/**********************************************************************************
	 * 					Woocommerce Compare Product
	 **********************************************************************************/
	function relic_fashion_store_add_compare_link( $product_id = false, $args = array() ) {
		if ( !defined( 'YITH_WOOCOMPARE' )) return;
		extract( $args );

		if ( ! $product_id ) {
			global $product;
			$productid = $product->get_id();
			$product_id = isset( $productid ) ? $productid : 0;
		}
		
		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'relic-fashion-store' ) );
			yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			$button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
		}
		printf( '<a title="'. esc_html__( 'Add to Compare', 'relic-fashion-store' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><span><i class="fa fa-exchange" aria-hidden="true"></i></span></a>', '#', 'compare', intval($product_id));
	}
	

	/***********************************************************************
	 * Add 'woocommerce-active' class to the body tag.
	 * @param  array $classes CSS classes applied to the body tag.
	 * @return array $classes modified to include 'woocommerce-active' class.
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_active_body_class( $classes ) {
		$classes[] = 'woocommerce-active';
		return $classes;
	}


	/***********************************************************************
	 * Products per page.
	 * @return integer number of products.
	 *********************************************************************/
	function relic_fashion_store_woocommerce_products_per_page() {
		$woocommerce_shop_page_products_count = get_theme_mod('woocommerce_shop_page_products_count',12);
		return $woocommerce_shop_page_products_count;
	}


	/***********************************************************************
	 * Product gallery thumnbail columns.
	 *
	 * @return integer number of columns.
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_thumbnail_columns() {
		$woocommerce_shop_gallery_page_thumnbail_column = get_theme_mod( 'woocommerce_shop_gallery_page_thumnbail_column', 4 );
		return $woocommerce_shop_gallery_page_thumnbail_column;
	}


	/***********************************************************************
	 * Default loop columns on product archives.
	 *
	 * @return integer products per row.
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_loop_columns() {
		$woocommerce_shop_page_column_count = get_theme_mod( 'woocommerce_shop_page_column_count',3 );
		return $woocommerce_shop_page_column_count;
	}

	/***************************************************************************
	 * Related Products Args.
	 *
	 * @param array $args related products args.
	 * @return array $args related products args.
	 ****************************************************************************/
	public function relic_fashion_store_woocommerce_related_products_args( $args ) {
		$woocommerce_single_page_related_products_count = get_theme_mod( 'woocommerce_single_page_related_products_count',3 );
		$woocommerce_single_page_related_products_column = get_theme_mod( 'woocommerce_single_page_related_products_column',3 );
		
		$defaults = array(
			'posts_per_page' => $woocommerce_single_page_related_products_count,
			'columns'        => $woocommerce_single_page_related_products_column,
		);

		$args = wp_parse_args( $defaults, $args );

		return $args;
	}

	
	/***********************************************************************
	 * Display Header Cart.
	 *
	 * @return void
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		global $woocommerce;
		
		?>
			<li class="main-header-cart">
				<div class="header-cart" id="cart">
					<div class="mini-cart">
						<div data-toggle="collapse" data-hover="collapse" class="top_add_cart " data-target="#top-add-cart">
							<div id="cart_new" class="">
								<a href="">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									<span><?php echo intval(WC()->cart->get_cart_contents_count()); ?></span>
								</a>
							</div>
						</div>
						<div id="top-add-cart">
							<div class="top-cart-content">
								<div class="block-subtitle"><?php echo esc_html__('Recently added item(s)','relic-fashion-store'); ?></div>
								<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php 
	}


	/***********************************************************************
	 * Woocommerce Header Cart Fragment 
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_header_add_to_cart_fragment($fragments) {
		ob_start();
		global $woocommerce;
		?>
			<div id="cart_new" class="">
				<a href="">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					<span><?php echo intval(WC()->cart->get_cart_contents_count()); ?></span>
				</a>
			</div>
		<?php 
		$fragments['#cart_new'] = ob_get_clean();
		
		return $fragments;
	}

	/******************************************************************************
	 * Header Wishlist
	 ******************************************************************************/
	public function relic_fashion_store_top_wishlist() {
		if (!defined( 'YITH_WCWL' )) return;
		?>
		<li class="main-header-wishlist">
			<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url()); ?>" >
				<i class="fa fa-heart" aria-hidden="true"></i>
				<span>
					<?php 
						$wishlist_count = YITH_WCWL()->count_products();
						echo esc_html( $wishlist_count ); 
					?>
				</span>
			</a>
		</li> 
		<?php 
	}


	/***********************************************************************
	 * Products Add Cart  Section
	 **********************************************************************/
	public function relic_fashion_products_add_wishlist() {
		if ( !defined( 'YITH_WCWL' )) return;
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
		?>
			
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
				<div class="yith-wcwl-add-button show display-block">  
					
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist">
						<svg width="19px" height="17px" viewBox="0 0 19 17" version="1.1" >
							<desc><?php echo esc_html__('Created with Sketch.','relic-fashion-store'); ?></desc>
							<defs></defs>
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g transform="translate(-671.000000, -3095.000000)" stroke="#000000" stroke-width="1.6">
									<g transform="translate(660.978105, 3033.965174)">
										<path d="M15.569646,62.595271 C16.7375486,62.5929084 17.857609,63.0579432 18.6803779,63.8868154 L19.2257404,64.4380843 L19.7809469,63.8887842 C21.4983466,62.1692189 24.2848142,62.1674469 26.0043796,63.8848466 C27.723945,65.6022462 27.7257169,68.3887139 26.0083172,70.1082792 L25.8705,70.2480653 L19.2257404,76.8987314 L12.458914,70.1082792 C10.7409237,68.3908796 10.7403331,65.6061839 12.4577327,63.8879967 C13.2828642,63.0624714 14.402334,62.5988149 15.569646,62.5992086"></path>
									</g>
								</g>
							</g>
						</svg>
						<?php echo esc_html__('add to wishlist','relic-fashion-store'); ?>
					</a>
				</div>

				<div class="yith-wcwl-wishlistaddedbrowse hide hidden"> 
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistexistsbrowse hide hidden">
					<span class="feedback"><?php echo esc_html__( 'The product is already in the wishlist!', 'relic-fashion-store' ); ?></span>
				</div>

				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>

			</div>
		<?php
	}

	


	/****************************************************************************
	 * Woocommerce Rating Section 
	 ****************************************************************************/
	public function relic_fashion_store_get_star_rating(){
	    global $woocommerce, $product;
	    $average = $product->get_average_rating();
		?>
		<div class="relic-fashion-store-star-rating" itemscope itemtype="http://schema.org/AggregateRating">
			<?php
				//Rating Loop 
				for( $i = 1; $i<=5; $i++ ) {
					if ($i<=$average){
						echo '<i class="fa fa-star gold" aria-hidden="true"></i>';
					}
					else{ 
						echo '<i class="fa fa-star blank" aria-hidden="true"></i>';
					} 
				} 
			?>
		</div>
		<?php
	}
	

	/****************************************************************************
	 * User Login Section Hear
	 ****************************************************************************/
	public function relic_fashion_store_user_login(){
		?>
		<?php if (is_user_logged_in()) { ?>	
			<!-- My Account Links -->
			<li class="myaccount">
				<a title="<?php echo esc_html__("My Account", 'relic-fashion-store'); ?>" href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
					<i class="fa fa-user"></i>
				</a>
			</li>
			
			<!-- User Login Section -->
			<li class="login">
				<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
					<i class="fa fa-lock"></i>
				</a>
			</li>

		<?php } else{ ?>
		
		<!-- User Login Section -->
		<li class="login">
			<a href="<?php echo esc_url( get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
				<i class="fa fa-sign-in" aria-hidden="true">
			</a>
		</li>

		<!-- Woocommerce Account Page -->
		<li class="login">
			<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
				<i class="fa fa-user"></i>
			</a>
		</li>
		<?php } ?>
		<?php
	}

	/****************************************************************
	 * Woocommerce Shop Products Loop
	 ****************************************************************/
	public function relic_fashion_store_woocommerce_before_shop_loop_item(){
		//woocommerce Add To Cart Object	item
		$products_default_fallback = get_template_directory_uri().'/assets/images/fallback/products-fallback-image.jpg';
                                    	
		?>
			<div class=" item_pro">
				<figure>
					<a href="<?php the_permalink(); ?>">
						<?php 
							if(has_post_thumbnail()){
								the_post_thumbnail('woocommerce_thumbnail'); #Products Thumbnail 
							}else{
								?>
									<img src="<?php echo esc_url( $products_default_fallback ); ?>" alt="img" >
								<?php
							}
							
							
							$this->relic_fashion_store_sale_percentage_loop();#Sale percentage Loop
						
						?>
					</a>
					
					<figcaption>
						<div class="link"> 
							<?php
								$this->relic_fashion_store_product_quickview();
								$this->relic_fashion_store_wishlist_products(); 
								$this->relic_fashion_store_add_compare_link();
							?>
						</div>
					</figcaption>
				</figure> 
				<div class="product_detail">
					<h5 itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<?php 
						$this->relic_fashion_store_get_star_rating();#Relic Fashion Store Star Rating
						woocommerce_template_loop_price();#Woocommerce Template loop Price
					?>
					
					<div class="cart">
						<?php woocommerce_template_loop_add_to_cart(); #Button Cart ?>
					</div>
					
				</div>
			</div>
		<?php  
	}

	/***********************************************************************
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @return void
	 **********************************************************************/
	public function relic_fashion_store_woocommerce_scripts() {
		wp_enqueue_style( 'relic-fashion-store-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

		$font_path   = WC()->plugin_url() . '/assets/fonts/';
		$inline_font = '@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}';

		wp_add_inline_style( 'relic-fashion-store-woocommerce-style', $inline_font );
	}


	
	/*************************************************************************************
	 * Woocommerce Single Products Social Share
	 ************************************************************************************/
	public function relic_fashion_store_social_share() {
				// Single Page Details For Social Share
				$single_page_id = get_the_ID();
				$single_page_url = get_the_permalink($single_page_id);
				$single_page_title = get_the_title($single_page_id);
				$single_page_desc = get_the_excerpt( $single_page_id );
		?>
			<div class="share_icon">
				<a href="#"><i class="fa fa-share"></i><?php echo esc_html__('Share','relic-fashion-store'); ?></a>
				<div class="share_icon_dropdown">
					<ul>
						<li>
							<!-- Email -->
							<a href="mailto:?Subject=<?php echo esc_attr($single_page_title); ?>&amp;Body=<?php echo esc_attr( $single_page_desc ); ?> <?php echo esc_url( $single_page_url ); ?>">
								<i class="fa fa-envelope"></i>
							</a>
						</li>

						<li><!-- Facebook -->
							<a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.$single_page_url); ?>" target="_blank">
								<i class="fa fa-facebook-f"></i>
							</a>
						</li>
							
						<li><!-- Twitter -->
							<a href="<?php echo esc_url('https://twitter.com/share?url='.$single_page_url); ?>&amp;text=<?php echo esc_attr($single_page_title); ?>&amp;hashtags=simplesharebuttons" target="_blank">
								<i class="fa fa-twitter"></i>
							</a>
						</li>

						<li><!-- Google+ -->
							<a href="<?php echo esc_url('https://plus.google.com/share?url='.$single_page_url); ?>" target="_blank">
								<i class="fa fa-google-plus-g"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		<?php 
	}

	/************************************************************************************
	 * 							Woocommerce Breadcrumb Section
	 * *********************************************************************************/ 
	function relic_fashion_store_woocommerce_breadcrumb(){
		relic_fashion_store_breadcrumb_section(); //breadcrumbs Section 
	}

	/************************************************************************************
	 * 							Woocommerc Single Before Single Products
	 * *********************************************************************************/ 
	function relic_fashion_store_woocommerce_before_single_product_summary(){
		?>
		<div class="add-card-detail">
			<div class="container">
				<div class="row">
		<?php
	}
	
	function relic_fashion_store_woocommerce_after_single_product_summary(){
		?>
				</div>
			</div>
		</div>
		<?php
	}

	/*****************************************************************************
	 * 						Woocommerce Archive Page Banner
	 ****************************************************************************/
	function relic_fashion_store_woocommerce_shop_page_category_banner(){
		/**
		 * Verify the Products Categoy Section
		 */
		if ( is_product_category() ){
			global $wp_query;

			// get the query object
			$cat = $wp_query->get_queried_object();

			// get the thumbnail id using the queried category term_id
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 

			// get the image URL
			$shop_page_category_id_image_url = wp_get_attachment_url( $thumbnail_id ); 
			
			?>
			<!-- banner -->
			<section class="banner_content_catagory"  style="background-image:url('<?php echo esc_url( $shop_page_category_id_image_url); ?>');">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="banner_item-v1">
								<h2><?php echo esc_html( $cat->name ); ?></h2>
								<h3><?php echo esc_attr( $cat->description ) ?></h3>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		}#End The Function 
		
	}

	/*****************************************************************************
	 * 						Woocommerce Products Discount Show
	 ****************************************************************************/
	function relic_fashion_store_sale_percentage_loop() {
		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				$discount_price = $product->get_regular_price() - $product->get_sale_price();
				if( $discount_price > 0 )
					$max_percentage = ( $discount_price  / $product->get_regular_price() ) * 100;
				else{
					$max_percentage = 0;
				}
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					$price = $variation->get_regular_price();
					$sale = $variation->get_sale_price();
					$percentage = '';
					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}
			
			echo "<span class='feature'>" . esc_attr( round($max_percentage) ) . "%  OFF</span>";
		
		}

	}


}
new Relic_Fashion_Store_Woocommerce();


//woocommmerce category id find
function relic_fashion_store_woo_cat_id_by_slug( $slug ){
	$term = get_term_by('slug', $slug, 'product_cat', 'ARRAY_A');
	return $term['term_id'];       
}