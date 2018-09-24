<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Travel_Agency
 */

if( ! function_exists( 'travel_agency_doctype' ) ) :
/**
 * Doctype Declaration
*/
function travel_agency_doctype(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'travel_agency_doctype', 'travel_agency_doctype' );

if( ! function_exists( 'travel_agency_head' ) ) :
/**
 * Before wp_head 
*/
function travel_agency_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'travel_agency_before_wp_head', 'travel_agency_head' );

if( ! function_exists( 'travel_agency_page_start' ) ) :
/**
 * Page Start
*/
function travel_agency_page_start(){
    ?>
    <div id="page" class="site">
    <?php
}
endif;
add_action( 'travel_agency_before_header', 'travel_agency_page_start', 20 );

if( ! function_exists( 'travel_agency_header' ) ) :
/**
 * Header Start
*/
function travel_agency_header(){     
    $phone       = get_theme_mod( 'phone', __( '(888) 123-45678', 'travel-agency' ) );
    $phone_label = get_theme_mod( 'phone_label', __( 'Call us, we are open 24/7', 'travel-agency' ) );
    $ed_social   = get_theme_mod( 'ed_social_links', true );
    $ed_search   = get_theme_mod( 'ed_search', true ); 
    ?>
    <header class="site-header" itemscope itemtype="http://schema.org/WPHeader">
		
        <div class="header-holder">			
            <?php if( $ed_social || $ed_search ){ ?>
            <div class="header-t">
				<div class="container">
					<?php if( $ed_social ) travel_agency_social_links(); ?>
					<div class="tools">
						<?php if( $ed_search ) travel_agency_get_header_search(); ?>						
					</div>                     
				</div>
			</div> <!-- header-t ends -->
            <?php } ?>
            
            <div class="header-b">
				<div class="container">
					<div class="site-branding" itemscope itemtype="http://schema.org/Organization">
						<?php 
                	        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                                the_custom_logo();
                            } 
                        ?>
                        <div class="text-logo">
							<?php if ( is_front_page() ) : ?>
                                <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                            <?php endif;
                			$description = get_bloginfo( 'description', 'display' );
                			if ( $description || is_customize_preview() ) : ?>
                				<p class="site-description" itemprop="description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                			<?php
                			endif; ?>
                        </div>
            		</div><!-- .site-branding -->
                    
                    <?php if( $phone_label || $phone ){ ?>
                    <div class="right">
                        <?php
    						if( $phone_label ) echo '<span class="phone-label">' . esc_html( travel_agency_get_phone_label() ) . '</span>';
                            if( $phone ) echo '<a href="' . esc_url( 'tel:' . preg_replace( '/\D/', '', $phone ) ) . '" class="tel-link"><span class="phone">' . esc_html( travel_agency_get_header_phone() ) . '</span></a>';
                        ?>
                    </div>
                    <?php } ?>
                    
				</div>
			</div> <!-- header-b ends -->
                        
		</div> <!-- header-holder ends -->
		
        <div class="nav-holder">
			<div class="container">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link"><i class="fa fa-home"></i></a>
                <div id="primary-toggle-button"><?php esc_html_e( 'MENU', 'travel-agency' );?><i class="fa fa-bars"></i></div>
                <nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
        			<?php
        				wp_nav_menu( array(
        					'theme_location' => 'primary',
        					'menu_id'        => 'primary-menu',
                            'fallback_cb'    => 'travel_agency_primary_menu_fallback',
        				) );
        			?>
        		</nav><!-- #site-navigation --> 
			</div>
		</div> <!-- nav-holder ends -->
        
	</header> <!-- header ends -->
    <?php
}
endif;
add_action( 'travel_agency_header', 'travel_agency_header', 20 );

if( ! function_exists( 'travel_agency_breadcrumb' ) ) :
/**
 * Page Header for inner pages
*/
function travel_agency_breadcrumb(){    
    
    global $post;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'breadcrumb_home_text', __( 'Home', 'travel-agency' ) ); // text for the 'Home' link
    $delimiter  = get_theme_mod( 'breadcrumb_separator', __( '>', 'travel-agency' ) ); // delimiter between crumbs
    $before     = '<span class="current">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) && ! is_front_page() ){
        
        echo '<div class="top-bar"><div class="container"><div id="crumbs"><a href="' . esc_url( home_url() ) . '">' . esc_html( $home ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
        
        if( is_home() ){
            
            echo $before . esc_html( single_post_title( '', false ) ) . $after;
            
        }elseif( is_category() ){
            
            $thisCat = get_category( get_query_var( 'cat' ), false );
            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo ' <a href="' . esc_url( get_permalink( $post_page ) ) . '">' . esc_html( $p->post_title ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';  
            }
            
            if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' <span class="separator">' . $delimiter . '</span> ' );
            echo $before .  esc_html( single_cat_title( '', false ) ) . $after;
        
        }elseif( travel_agency_is_wpte_activated() && is_tax( array( 'activities', 'destination', 'trip_types' ) ) ){ //Trip Taxonomy pages
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            $tax = array(
                'activities'  => 'templates/template-activities.php',
                'destination' => 'templates/template-destination.php',
                'trip_types'  => 'templates/template-trip_types.php'
            );
            
            foreach( $tax as $k => $v ){
                if( is_tax( $k ) ){
                    $p_id = travel_agency_get_page_id_by_template( $v );
                    if( $p_id ){
                        echo ' <a href="' . esc_url( get_permalink( $p_id[0] ) ) . '">' . esc_html( get_the_title( $p_id[0] ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                    }else{
                        $post_type = get_post_type_object( 'trip' );
                        if( $post_type->has_archive == true ){// For CPT Archive Link
                           
                           // Add support for a non-standard label of 'archive_title' (special use case).
                           $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                           printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                           echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
            
                        }
                        
                    }
                    //For trip taxonomy hierarchy
                    $ancestors = get_ancestors( $current_term->term_id, $k );
                    $ancestors = array_reverse( $ancestors );
            		foreach ( $ancestors as $ancestor ) {
            			$ancestor = get_term( $ancestor, $k );    
            			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
            				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            			}
            		}
                }
            }
            
            echo $before . esc_html( $current_term->name ) . $after;
        }elseif( is_tag() ){
            
            echo $before . esc_html( single_tag_title( '', false ) ) . $after;
     
        }elseif( is_author() ){
            
            global $author;
            $userdata = get_userdata( $author );
            echo $before . esc_html( $userdata->display_name ) . $after;
     
        }elseif( is_search() ){
            
            echo $before . esc_html__( 'Search Results for "', 'travel-agency' ) . esc_html( get_search_query() ) . esc_html__( '"', 'travel-agency' ) . $after;
        
        }elseif( is_day() ){
            
            echo '<a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-agency' ) ) ) ) . '">' . esc_html( get_the_time( __( 'Y', 'travel-agency' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo '<a href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'travel-agency' ) ), get_the_time( __( 'm', 'travel-agency' ) ) ) ) . '">' . esc_html( get_the_time( __( 'F', 'travel-agency' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( __( 'd', 'travel-agency' ) ) ) . $after;
        
        }elseif( is_month() ){
            
            echo '<a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-agency' ) ) ) ) . '">' . esc_html( get_the_time( __( 'Y', 'travel-agency' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( __( 'F', 'travel-agency' ) ) ) . $after;
        
        }elseif( is_year() ){
            
            echo $before . esc_html( get_the_time( __( 'Y', 'travel-agency' ) ) ) . $after;
    
        }elseif( is_single() && !is_attachment() ){
            
            if( travel_agency_is_wpte_activated() && get_post_type() === 'trip' ){ //For Single Trip 
                // Check for Destination page templage
                $destination = travel_agency_get_page_id_by_template( 'templates/template-destination.php' );
                if( $destination ){
                    echo ' <a href="' . esc_url( get_permalink( $destination[0] ) ) . '">' . esc_html( get_the_title( $destination[0] ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';                                        
                }else{
                    $post_type = get_post_type_object( 'trip' );
                    if( $post_type->has_archive == true ){// For CPT Archive Link
                       
                       // Add support for a non-standard label of 'archive_title' (special use case).
                       $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                       printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                       echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
        
                    }                    
                }
                // Check for destination taxonomy hierarchy
                $terms = wp_get_post_terms( $post->ID, 'destination', array( 'orderby' => 'parent', 'order' => 'DESC' ) );                
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { //Parents terms
                    $ancestors = get_ancestors( $terms[0]->term_id, 'destination' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
            			$ancestor = get_term( $ancestor, 'destination' );    
            			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
            				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            			}
            		}                    
                    // Last child term
                    echo ' <a href="' . esc_url( get_term_link( $terms[0] ) ) . '">' . esc_html( $terms[0]->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                }
                                
                echo $before . esc_html( get_the_title() ) . $after;
                
            }elseif( get_post_type() != 'post' ){
                
                $post_type = get_post_type_object( get_post_type() );
                
                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                   echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
    
                }
                echo $before . esc_html( get_the_title() ) . $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo ' <a href="' . esc_url( get_permalink( $post_page ) ) . '">' . esc_html( $p->post_title ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';  
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
        			//Now try to find the deepest term of those that we know of
        			$use_term = key( $cat_object );
        			foreach( $cat_object as $key => $object )
        			{
        				//Can't use the next($cat_object) trick since order is unknown
        				if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
        					$use_term = $key;
        					$potential_parent = $object->term_id;
        				}
        			}
                    
        			$cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' );
                    $cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats ); //NEED TO CHECK THIS
                    echo $cats;
                }
    
                echo $before . esc_html( get_the_title() ) . $after;
                
            }
        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '">' . esc_html( $post_type->label ) . '</a>';
                echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . sprintf( __('Page %s', 'travel-agency'), get_query_var('paged') ) . $after;
            }else{
                echo $before . esc_html( $post_type->label ) . $after;
            }
    
        }elseif( is_attachment() ){
            
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ');
                echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( $parent->post_title ) . '</a>' . ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            echo  $before . esc_html( get_the_title() ) . $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
            echo $before . esc_html( get_the_title() ) . $after;
    
        }elseif( is_page() && $post->post_parent ){
            
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo $breadcrumbs[$i];
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . esc_html( get_the_title() ) . $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'travel-agency' ) . $after;
        }
        
        if( get_query_var('paged') ) echo __( ' (Page', 'travel-agency' ) . ' ' . get_query_var('paged') . __( ')', 'travel-agency' );
        
        echo '</div></div></div>';
        
    }
}
endif;
add_action( 'travel_agency_after_header', 'travel_agency_breadcrumb', 20 );

if( ! function_exists( 'travel_agency_content_start' ) ) :
/**
 * Content Start
*/
function travel_agency_content_start(){
    
    $home_sections = travel_agency_get_homepage_section();
    
    $class = is_404() ? 'error-holder' : 'row' ;
    
    if( !( is_front_page() && ! is_home() && $home_sections ) ){
    ?>
    <div id="content" class="site-content">
        <div class="container">
            <?php 
            /**
             * Page Header
             * 
             * @hooked travel_agency_page_header
            */
            do_action( 'travel_agency_page_header' );
            ?>
            <div class="<?php echo esc_attr( $class ); ?>">
    <?php
    }
}
endif;
add_action( 'travel_agency_content', 'travel_agency_content_start' );

if( ! function_exists( 'travel_agency_page_header' ) ) :
/**
 * Page Header
*/
function travel_agency_page_header(){ ?>
    <header class="page-header">
    <?php  
        if( is_archive() ){
			if( ! is_tax( array( 'destination', 'activities', 'trip_types' ) ) ){
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                if( ! is_post_type_archive( 'trip' ) ) the_archive_description( '<div class="archive-description">', '</div>' );
            }
        }
    
        if( is_search() ){ ?>            
			<h1 class="page-title"><?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'travel-agency' ), '<span>' . get_search_query() . '</span>' );
			?></h1>    		
        <?php
        }
    
        if( is_page() ){ 
            the_title( '<h1 class="page-title">', '</h1>' ); 
        }
        
        if( is_404() ) echo '<h1 class="page-title">' . esc_html__( '404', 'travel-agency' ) . '</h1>'; //For 404
        ?>
    </header><!-- .page-header -->
    <?php
}
endif;
add_action( 'travel_agency_page_header', 'travel_agency_page_header' );

if( ! function_exists( 'travel_agency_entry_header' ) ) :
/**
 * Post Entry Header
*/
function travel_agency_entry_header(){ 
    if( ! is_page() ){ ?>    
    <header class="entry-header">		
		<div class="entry-meta">
			<?php 
                travel_agency_categories();                
                travel_agency_posted_on();                
            ?>            
		</div>
        <?php 
            if( is_single() ){
                the_title( '<h2 class="entry-title" itemprop="headline">', '</h2>' );    
            }else{
                the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h2>' ); 
            }
        ?>        
	</header>
    <?php  
    }
}
endif;
add_action( 'travel_agency_before_entry_content', 'travel_agency_entry_header', 15 );

if( ! function_exists( 'travel_agency_post_thumbnail' ) ) :
/**
 * Post Thumbnail
*/
function travel_agency_post_thumbnail(){
    if( has_post_thumbnail() ){
        echo is_singular() ? '<div class="post-thumbnail">' : '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
        the_post_thumbnail( 'travel-agency-full', array( 'itemprop' => 'image' ) );
        echo is_singular() ? '</div>' : '</a>';
    }
}
endif;
add_action( 'travel_agency_before_entry_content', 'travel_agency_post_thumbnail', 20 );

if( ! function_exists( 'travel_agency_entry_content' ) ) :
/**
 * Entry Content
*/
function travel_agency_entry_content(){ ?>
    <div class="entry-content" itemprop="text">
		<?php
			
            if( ! is_singular() && false === get_post_format() ){
                the_excerpt();
            }else{
                the_content( sprintf(
    				wp_kses(
    					/* translators: %s: Name of current post. Only visible to screen readers */
    					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'travel-agency' ),
    					array(
    						'span' => array(
    							'class' => array(),
    						),
    					)
    				),
    				get_the_title()
    			) );
    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-agency' ),
    				'after'  => '</div>',
    			) );
            }
            
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'travel_agency_entry_content', 'travel_agency_entry_content', 20 );
add_action( 'travel_agency_page_entry_content', 'travel_agency_entry_content', 15 );

if( ! function_exists( 'travel_agency_entry_footer' ) ) :
/**
 * Entry Footer
*/
function travel_agency_entry_footer(){ ?>
	<footer class="entry-footer">
		<?php
        $readmore = get_theme_mod( 'readmore', __( 'Read More', 'travel-agency' ) );
        if( ! is_page() ){
            if( is_single() ){
                travel_agency_tags();
            }else{
                if( $readmore ) echo '<div class="btn-holder"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-more">' . esc_html( travel_agency_get_readmore_btn() ) . '</a></div>';
            } 
        }
        ?>        
		<div class="meta-holder">
			<div class="meta-info">
				<?php
                    if( ! is_page() ) travel_agency_posted_by();
                    travel_agency_comment_count();
                ?>                
			</div>			
		</div>
        <?php
        if ( get_edit_post_link() ){
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'travel-agency' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
        }
		?>
	</footer><!-- .entry-footer -->
	<?php            
}
endif;
add_action( 'travel_agency_entry_content', 'travel_agency_entry_footer', 25 );
add_action( 'travel_agency_page_entry_content', 'travel_agency_entry_footer', 20 );

if( ! function_exists( 'travel_agency_author' ) ) :
/**
 * Author Bio
*/
function travel_agency_author(){ 
    if(  get_the_author_meta( 'description' ) ){ ?>
    <div class="author-section">
		<div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></div>
		<div class="text-holder">
			<span class="posted-by">Posted by</span>
			<h2><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h2>				
			<?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>            
		</div>
	</div>
    <?php
    }
}
endif;
add_action( 'travel_agency_after_post_content', 'travel_agency_author', 15 );

if( ! function_exists( 'travel_agency_pagination' ) ) :
/**
 * Pagination
*/
function travel_agency_pagination(){    
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Prev Post', 'travel-agency' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Post', 'travel-agency' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'travel-agency' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }        
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous', 'travel-agency' ),
            'next_text'          => __( 'Next', 'travel-agency' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'travel-agency' ) . ' </span>',
         ) );
    }    
}
endif;
add_action( 'travel_agency_after_post_content', 'travel_agency_pagination', 20 );
add_action( 'travel_agency_after_content', 'travel_agency_pagination' );

if( ! function_exists( 'travel_agency_related_posts' ) ) :
/**
 * Related Posts
*/
function travel_agency_related_posts(){
    global $post;
    $related_title = get_theme_mod( 'related_title', __( 'You may also like...', 'travel-agency' ) );
    $ed_related    = get_theme_mod( 'ed_related', true );
    
    if( $ed_related ){
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => 3,
            'ignore_sticky_posts'   => true,
            'post__not_in'          => array( $post->ID ),
            'orderby'               => 'rand'
        );
        $cats = get_the_category( $post->ID );
        if( $cats ){
            $c = array();
            foreach( $cats as $cat ){
                $c[] = $cat->term_id; 
            }
            $args['category__in'] = $c;
        }
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){
        ?>
        <section class="related-post">
    		<?php if( $related_title ) echo '<h2 class="title">' . esc_html( travel_agency_get_related_title() ) . '</h2>'; ?>
    		<div class="grid">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <div class="col">
    				<div class="img-holder">
    					<a href="<?php the_permalink(); ?>" class="post-thumbnail">
                        <?php 
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( 'travel-agency-related', array( 'itemprop' => 'image' ) );    
                            }else{ ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/fallback-img-280-170.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" itemprop="image" />
                            <?php  
                            }
                        ?>                        
                        </a>
    					<?php travel_agency_categories(); ?>
    				</div>
    				<div class="text-holder">
    					<?php 
                            travel_agency_posted_on();
                            the_title( '<h3 class="post-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h3>' );
                        ?>
    				</div>
    			</div>
    			<?php }
                wp_reset_postdata(); ?>
    		</div>
    	</section>
        <?php
        }
    }
}
endif;
add_action( 'travel_agency_after_post_content', 'travel_agency_related_posts', 25 );

if( ! function_exists( 'travel_agency_comment' ) ) :
/**
 * Page Header
*/
function travel_agency_comment(){
    // If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
endif;
add_action( 'travel_agency_after_post_content', 'travel_agency_comment', 30 );
add_action( 'travel_agency_after_page_content', 'travel_agency_comment' );

if( ! function_exists( 'travel_agency_content_end' ) ) :
/**
 * Content End
*/
function travel_agency_content_end(){
    $home_sections = travel_agency_get_homepage_section();
    
    if( !( is_front_page() && ! is_home() && $home_sections ) ){
    ?>
            </div><!-- .row/not-found -->
        </div><!-- .container -->
    </div><!-- #content -->
    <?php
    }
}
endif;
add_action( 'travel_agency_before_footer', 'travel_agency_content_end', 20 );

if( ! function_exists( 'travel_agency_footer_start' ) ) :
/**
 * Footer Start
*/
function travel_agency_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">
        <div class="container">
    <?php
}
endif;
add_action( 'travel_agency_footer', 'travel_agency_footer_start', 20 );

if( ! function_exists( 'travel_agency_footer_top' ) ) :
/**
 * Footer Top
*/
function travel_agency_footer_top(){    
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){
    ?>
    <div class="footer-t">
		<div class="row">
			<?php if( is_active_sidebar( 'footer-one' ) ){ ?>
				<div class="column">
				   <?php dynamic_sidebar( 'footer-one' ); ?>	
				</div>
            <?php } ?>
			
            <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-two' ); ?>	
				</div>
            <?php } ?>
            
            <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-three' ); ?>	
				</div>
            <?php } ?>
            
            <?php if( is_active_sidebar( 'footer-four' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-four' ); ?>	
				</div>
            <?php } ?>
		</div>
	</div>
    <?php 
    }   
}
endif;
add_action( 'travel_agency_footer', 'travel_agency_footer_top', 30 );

if( ! function_exists( 'travel_agency_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function travel_agency_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="site-info">
			<?php
                travel_agency_get_footer_copyright();
                
                echo '<a href="' . esc_url( 'https://raratheme.com/wordpress-themes/travel-agency/' ) .'" rel="author" target="_blank">' . esc_html__( 'Travel Agency', 'travel-agency' ) . '</a>' . esc_html__( ' by Rara Theme.', 'travel-agency' );
                
                printf( esc_html__( ' Powered by %s', 'travel-agency' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'travel-agency' ) ) .'" target="_blank">WordPress</a> .' );                        
                 
            ?>                              
		</div>
        <?php 
        if ( function_exists( 'the_privacy_policy_link' ) ) {
            the_privacy_policy_link();
        }
        ?>
        <nav class="footer-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
                    'fallback_cb'    => false,
				) );
			?>
		</nav><!-- .footer-navigation -->
	</div>
    <?php
}
endif;
add_action( 'travel_agency_footer', 'travel_agency_footer_bottom', 40 );

if( ! function_exists( 'travel_agency_footer_end' ) ) :
/**
 * Footer End 
*/
function travel_agency_footer_end(){
    ?>
        </div><!-- .container -->
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'travel_agency_footer', 'travel_agency_footer_end', 50 );

if( ! function_exists( 'travel_agency_page_end' ) ) :
/**
 * Page End
*/
function travel_agency_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'travel_agency_after_footer', 'travel_agency_page_end', 20 );