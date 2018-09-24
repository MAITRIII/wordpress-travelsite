<?php
if ( ! function_exists( 'relic_fashion_store_top_header_info' ) ) {
    /**
     * Display the Top Header Section.
     *
     * Top Header Store Info Section
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_top_header_info() {
        ?>
        <div class="quickinfo_main">
            <ul class="menu" >
                <?php
                
                    if( get_theme_mod('relic_fashion_store_top_header_address','Kathamandu, Nepal') != ''  ){ ?>
                        <li class="relic_fashion_store_top_header_address"><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php echo esc_html( relic_fashion_store_top_header_address() ); ?></span></li>
                    <?php
                    }

                    if( get_theme_mod( 'relic_fashion_store_top_header_email','themerelic@gmail.com' ) != '' ){ ?>
                        <li class="relic_fashion_store_top_header_email"><i class="fa fa-envelope"></i><span><?php echo esc_html( relic_fashion_store_top_header_email() ); ?></span></li>
                    <?php
                    }
                    if( get_theme_mod( 'relic_fashion_store_top_header_open_time','+977-1234567890' ) != '' ){ ?>
                        <li class="relic_fashion_store_top_header_phone_no"><i class="fa fa-phone"></i><span><?php echo esc_html( relic_fashion_store_top_header_phone_no() ) ?></span></li>
                    <?php
                    }
                ?>
            </ul>
        </div>
        <?php
    }
}


if ( ! function_exists( 'relic_fashion_store_top_header_menu' ) ) {
    /**
     * Display the Top Header Menu Section.
     *
     * Top Header Store Info Section Menu Section
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_top_header_menu() {
        ?>
        <div class="headerlinkmenu" itemscope itemtype="http://schema.org/SiteNavigationElement">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'top-menu',
                    'menu_id'        => 'top-menu',
                ) );
            ?>
        </div>
        <?php
    }
}


if ( ! function_exists( 'relic_fashion_store_top_header' ) ) {
    /**
     * Display the Top Header Section.
     *
     * Top Header Store 
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_top_header() {
        
        if( get_theme_mod( 'relic_fashion_store_top_header_enable',true ) == true ){
            ?>
            <div id="relic_fashion_store_top_header_enable" class="header-top">
                <div class="container clearfix">
                    <?php 
                        relic_fashion_store_top_header_info();
                        relic_fashion_store_top_header_menu(); 
                    ?>
                </div>
            </div>
            <?php
        }
    }
    add_action('relic_fashion_store_before_header','relic_fashion_store_top_header');
}


if ( ! function_exists( 'relic_fashion_store_logo' ) ) {
    /**
     * Display the Header Logo Section
     *
     * Top Header Store 
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_logo() {
        ?>
        <div class="pull-left">
            <div class="site-branding">
                <?php
                    the_custom_logo();
                    if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php
                    endif;

                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; 
                ?>
            </div><!-- .site-branding -->
        </div>
        <?php
    }
    
}


if ( ! function_exists( 'relic_fashion_store_woocommerce_logo' ) ) {
    /**
     * Display woocommerce Logo Hear Section
     *
     * Header Section Display
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_woocommerce_logo() {
        // Woocommerce Based Widgets
        if( relic_fashion_store_is_woocommerce_activated() ){
            ?>
            <div class="top-links">
                <ul>
                    <?php
                        //Create Woocommerce Object
                        $Relic_Fashion_Store_Woocommerce = new Relic_Fashion_Store_Woocommerce();

                        //Call The Woocommerce Store 
                        if( get_theme_mod( 'relic_fashion_store_main_header_wishlist_enable',true ) == true ){
                            $Relic_Fashion_Store_Woocommerce->relic_fashion_store_top_wishlist();
                        }

                        if( get_theme_mod( 'relic_fashion_store_main_header_add_cart_enable',true ) == true ){
                            $Relic_Fashion_Store_Woocommerce->relic_fashion_store_woocommerce_header_cart();
                        }
                    ?>
                </ul><!--End List-->
            </div><!-- End Top Links -->
            <?php
        }//End Relic Fashion Store Woocommerce Activated
    }
}


if ( ! function_exists( 'relic_fashion_store_social_share_section' ) ) {
    /**
     * Post Social Share Options Hear
     *
     * Social Share Section Exammple
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_social_share_section($social_share_post_id) {
        //Condtion Enable
        if( get_theme_mod('relic_fashion_store_social_share',true) == true ):
            //Social Share Title
            $relic_fashion_store_url = get_the_permalink($social_share_post_id);
            $relic_fashion_store_title = get_the_title($social_share_post_id);
            $relic_fashion_store_desc = get_the_excerpt( $social_share_post_id );
            ?>  
            <div class="blog_comment-social">
                <ul>
                    <li><a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.$relic_fashion_store_url,'relic-fashion-store'); ?>" target="_blank"><i class="fa fa-facebook-f"></i></a></li>
                    <li><a href="<?php echo esc_url('https://twitter.com/share?url='.$relic_fashion_store_url,'relic-fashion-store'); ?>&amp;text=<?php echo esc_attr($relic_fashion_store_title); ?>&amp;hashtags=simplesharebuttons" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="<?php echo esc_url('https://plus.google.com/share?url='.$relic_fashion_store_url,'relic-fashion-store'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul> 
            </div>
            <?php
        endif;
    }
}

/*********************************************************************
 *                  Body Schema Class
 *********************************************************************/
function relic_fashion_store_tag_schema() {
	$schema = 'http://schema.org/';

	// Is single post

	if ( is_single() ) {
		$type = 'WebPage';
	}
	// Is author page
	elseif ( is_author() ) {
		$type = 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope itemtype="' .esc_url( $schema  . $type ). '"';
}

/*******************************************************************
 * Relic Fashion Store Layout Setting 
 * 
 * @since Relic Fashion Store 1.0.0
 ********************************************************************/
if( !function_exists( 'relic_fashion_store_page_column' )){
    function relic_fashion_store_page_column() {
        $relic_fashion_store_layout = relic_fashion_store_get_layout();#Call them Meta Value
        
        $relic_fashion_store_archive_page_sidebar = get_theme_mod( 'relic_fashion_store_archive_page_sidebar','right-sidebar' );
        $relic_fashion_store_single_page_layout_option = get_theme_mod('relic_fashion_store_single_page_layout_option','right-sidebar');
        //Relic Fashion Store Class
        if( $relic_fashion_store_layout == 'both-sidebar' ){
            $relic_fashion_store_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
        }
        
        elseif( $relic_fashion_store_layout == 'full-width' ){
            $relic_fashion_store_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }
        
        //Archive Page full Width Sidebar Condtion
        elseif( $relic_fashion_store_archive_page_sidebar == 'full-width' && is_home() ){ #For Blog Page
            $relic_fashion_store_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }

        //Archive Page Both Sidebar Condtion
        elseif( $relic_fashion_store_archive_page_sidebar == 'both-sidebar' && is_home() ){ #For Blog Page
            $relic_fashion_store_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
        }
        
        
        //Default Values Hear
        else{
            $relic_fashion_store_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
        }

        return $relic_fashion_store_class ;
    }
}

/*******************************************************************
 * Relic Fashion Blog, Archive Page , Search Item Class
 * 
 * @since Relic Fashion Store 1.0.0
 ********************************************************************/
if( !function_exists( 'relic_fashion_store_blog_item_class' )){
    function relic_fashion_store_blog_item_class() {
        $relic_fashion_store_archive_page_sidebar = get_theme_mod( 'relic_fashion_store_archive_page_sidebar','right-sidebar' );

        //Relic Fashion Store Class
        if( $relic_fashion_store_archive_page_sidebar == 'both-sidebar' && is_home()){
            $relic_fashion_store_blog_item = ' col-lg-12 col-md-12 col-sm-12 col-xs-12';
        }elseif( $relic_fashion_store_archive_page_sidebar == 'full-width' && is_home() ){ #For Blog Page
            $relic_fashion_store_blog_item = 'col-lg-4 col-md-6 col-sm-12 col-xs-12';
        }else{
            $relic_fashion_store_blog_item = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
        }

        return $relic_fashion_store_blog_item ;
    }
}

/*******************************************************************
 * Relic Fashion Store Related Post Query 
 * 
 * @since Relic Fashion Store 1.0.0
 ********************************************************************/
if( !function_exists( 'relic_fashion_store_related_posts' )){
    function relic_fashion_store_related_posts( $post_id, $related_count, $args = array() ) {
        $terms = get_the_terms( $post_id, 'category' );
        
        if ( empty( $terms ) ) $terms = array();
        
        $term_list = wp_list_pluck( $terms, 'slug' );
        
        $related_args = array(
            'post_type' => 'post',
            'posts_per_page' => $related_count,
            'post_status' => 'publish',
            'post__not_in' => array( $post_id ),
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $term_list
                )
            )
        );

        return new WP_Query( $related_args );
    }
}


/****************************************************************************************
 *                              Single Page functions Actions
 **************************************************************************************/

if ( ! function_exists( 'relic_fashion_store_single_page_related_post' ) ) {
    /**
     * Display Releated Post on Single Page
     *
     * Single Page Display Section
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_single_page_related_post( $post_id) {
        
        // Related Posts Display
        if( get_theme_mod('single_page_related_post_enable',true) == true ){
            
            //Related Posts Custom value
            $single_page_related_post_count = get_theme_mod('relic_fashion_store_single_page_related_post_count',3);
            $single_page_related_post_title  = get_theme_mod( 'relic_fashion_store_related_post_text_change','Related' );        
        
            //Post Layout Manage Class 
            $layout = get_post_meta( $post_id, 'layout', true );
            if( $layout == 'full-width' ){
                $recent_post_class = 'col-md-4';
            }elseif( $layout == 'both-sidebar' ){
                $recent_post_class = 'col-md-12';
            }else{
                $recent_post_class = 'col-md-6';
            }
        ?>
        <?php
            //Call The Argument Section
            $related = relic_fashion_store_related_posts( get_the_ID(),$single_page_related_post_count );
            if( $related->have_posts() ){ 
        ?>
            <!-- Related Blog Display -->
            <section class="recent_blog">
                <div class="row">
                    <div class="col-md-12">
                        <h4><?php echo esc_attr( $single_page_related_post_title ); ?></h4>
                    </div>
                </div>
                <div class="row recent_blog_post"> 
                    <?php
                    
                        while ( $related->have_posts() ) { $related->the_post();
                    ?>
                        <div class="<?php echo esc_attr( $recent_post_class ); ?>" >
                            <div class="item" itemscope itemtype="http://schema.org/BlogPosting">
                                <?php do_action('relic_fashion_store_thumbnail'); ?>
                                <div class="recent-blog-text">
                                    <?php the_category(','); ?>
                                    <span itemprop="author"><?php the_author(); ?></span>
                                    <?php the_title( '<h5 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
                                    <div class="blog-content" itemprop="text"><?php the_excerpt(); ?></div>
                                    <div class="blog_comment clearfix">
                                        <div class="blog_comment_number">
                                            <a href="<?php echo esc_url( get_comments_link() ); ?>"><small><i class="fa fa-comment" aria-hidden="true"></i><?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'relic-fashion-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?></small></a>
                                        </div>
                                        <?php relic_fashion_store_social_share_section( get_the_ID() ); ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- #Column -->
                    <?php } ?>
                </div><!-- #recent_blog_post -->
            </section><!-- # Section -->
        <?php } wp_reset_query(); ?>
        <?php }
    }
}

/****************************************************************************************
 *                              Breadcrumb Section
 **************************************************************************************/
if ( ! function_exists( 'relic_fashion_store_breadcrumb_section' ) ) {
    /**
     * Relic Fashion Store WooCommerce Breadcrumbs Function
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_breadcrumb_section() {
        // Breadcrumb  Section
        $Relic_Fashion_Store_header = new Relic_Fashion_Store_header();
        $Relic_Fashion_Store_header->relic_fashion_store_breadcrumb_woocommerce();
    }

}

/** Default page Breadcrumb Section */


/** Default page Breadcrumb Section */
if ( ! function_exists( 'relic_fashion_store_default_breadcrumb' ) ) {
    /**
     * Relic Fashion Store WooCommerce Breadcrumbs Function
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_default_breadcrumb() {
        
        //Enable Breadcrumb Section 
        if( get_theme_mod('relic_fashion_store_breadcrumbs_enable',true ) == true  ){
            global $post;

            $relic_fashion_store_breadcrumb_separator = wp_kses_post( '<span class="separator">/</span>' );
            echo '<div class="inner-page">';
            if (!is_home()) {
                echo '<div class="breadcrumb-section"><div class="container">';
                
                echo '<i class="fa fa-home" aria-hidden="true"></i><a href="';
                echo esc_url( home_url( '/' ) );
                echo '">';
                echo esc_html__('Home', 'relic-fashion-store');
                echo '</a>'.$relic_fashion_store_breadcrumb_separator ;
                if ( is_category() || is_single()) {
                    the_category( $relic_fashion_store_breadcrumb_separator );
                    if (is_single()) {
                        echo ''.$relic_fashion_store_breadcrumb_separator;
                        the_title();
                    }
                } elseif ( is_page() ) {
                    if($post->post_parent){
                        $title = get_the_title();
                        
                        echo '<span title="'.esc_attr($title).'"> '.esc_html($title).'</span>';
                    } else {
                        echo '<span> '. esc_html(get_the_title()).'</span>';
                    }
                }
                elseif (is_tag()) {single_tag_title();}
                elseif (is_day()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'relic-fashion-store'), get_the_time('F jS, Y')); echo '</span>';}
                elseif (is_month()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'relic-fashion-store'), get_the_time('F, Y')); echo '</span>';}
                elseif (is_year()) {echo "<span>" . sprintf(esc_html__('Archive for %s', 'relic-fashion-store'), get_the_time('Y')); echo '</span>';}
                elseif (is_author()) {echo "<span>" . esc_html__('Author Archive', 'relic-fashion-store'); echo '</span>';}
                elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>" . esc_html__('Blog Archives', 'relic-fashion-store'); echo '</span>';}
                elseif (is_search()) {echo "<span>" . esc_html__('Search Results', 'relic-fashion-store'); echo '</span>';}
                elseif (is_404()) {echo "<span>" . esc_html__('404', 'relic-fashion-store'); echo '</span>';}
                

                echo '</div>';
            } else {
                echo '<div class="breadcrumbs-section"><div class="container">';
                
                echo '<a href="';
                echo esc_url( home_url( '/' ) );
                echo '">';
                echo esc_html__('Home', 'relic-fashion-store');
                echo '</a>'.$relic_fashion_store_breadcrumb_separator;
                
                echo esc_html__('Blog', 'relic-fashion-store');
                
                
                echo '</div>';
            }

            echo "</div></div>";
        }
    }

}




/** 10.Function to list post categories in customizer options */
if( ! function_exists( 'relic_fashion_store_get_products_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function relic_fashion_store_get_products_categories( ){
		
		/* Option list of all categories */
		$taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );

        //default value
		$categories = array();  
		
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}

/** 11.get Default category on section */
if( ! function_exists( 'relic_fashion_store_get_default_products_categories' ) ) {
	/**
	 * Defaul category section 
	*/
	function relic_fashion_store_get_default_products_categories( ){
		
		//Default cat
        $taxonomy     = 'product_cat';
        $orderby      = 'name';  
        $show_count   = 0;      
        $pad_counts   = 0;  
        $hierarchical = 1;    
        $title        = '';  
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );


        //Default Select
        foreach( $all_categories as $cat )  { 
            //Select default category Hear
           if( $cat->count >= 4 ){
                $default_product_cat = $cat->term_id; 
            }
        }

        //not category select then
        if( empty($default_product_cat) ){
            foreach( $all_categories as $cat )  { 
                //Select default category Hear
                $default_product_cat = $cat->term_id;
            }
        }


        //Return default cat
        return $default_product_cat;
	}

}


/** 11.get Post  Category */
if( ! function_exists( 'relic_fashion_store_get_post_categories' ) ) {
	/**
	 * Function to list post categories in customizer options
	*/
	function relic_fashion_store_get_post_categories( ){
		
		$all_categories = get_categories( );
		
		//default value
		$categories['all'] = 'all';  
		
		foreach( $all_categories as $category ){
			$categories[$category->term_id] = $category->name;    
		}
		
		return $categories;
	}

}
