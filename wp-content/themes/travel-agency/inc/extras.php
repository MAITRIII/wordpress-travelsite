<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Travel_Agency
 */

if ( ! function_exists( 'travel_agency_posted_on' ) ) :
/**
 * Posted On
 */
function travel_agency_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
}
endif;

if( ! function_exists( 'travel_agency_posted_by' ) ) :
/**
 * Posted By
*/
function travel_agency_posted_by(){
    echo '<span class="byline"><i class="fa fa-user-o"></i><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
}
endif; 

if( ! function_exists( 'travel_agency_categories' ) ) :
/**
 * Blog Categories
*/
function travel_agency_categories(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'travel-agency' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . $categories_list . '</span>'  ); // WPCS: XSS OK.
		}	
	}
}
endif;

if( ! function_exists( 'travel_agency_tags' ) ) :
/**
 * Blog Categories
*/
function travel_agency_tags(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {	
		/* translators: used between list items, there is a space */
		$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'travel-agency' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags">' . $tags_list . '</div>' ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'travel_agency_comment_count' ) ) :
/**
 * Comments counts
 */
function travel_agency_comment_count(){	
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="fa fa-comment-o"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'travel-agency' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			), 
            __( '1', 'travel-agency' ), 
            __( '%', 'travel-agency' ) 
		);
		echo '</span>';
	}	
}
endif;

if( ! function_exists( 'travel_agency_sidebar_layout' ) ) :
/**
 * Return sidebar layouts for pages
*/
function travel_agency_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, '_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, '_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}
endif;

if( ! function_exists( 'travel_agency_comment_list' ) ) :
/**
 * Callback function for Comment List
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function travel_agency_comment_list( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    
    <?php if ( 'div' != $args['style'] ){ ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="http://schema.org/UserComments">
    <?php } ?>
        
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>                
            </div><!-- .comment-meta -->
            
            <div class="text-holder">
                <div class="top">
                
                    <?php if ( $comment->comment_approved == '0' ){ ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'travel-agency' ); ?></em>
                    <?php } ?>
                    
                    <div class="left">
                        <b class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person"><?php comment_author(); ?></b>
                        <span class="says"><?php __( 'Says:', 'travel-agency' ); ?></span>
                        <div class="comment-metadata">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf( __( '%1$s at %2$s', 'travel-agency' ), get_comment_date(),  get_comment_time() ); ?>
                        </div>
                        <?php edit_comment_link( __( '(Edit)', 'travel-agency' ), '  ', '' ); ?>                
                    </div><!-- .left -->
                    
                    <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                </div>
                <div class="comment-content"><?php comment_text(); ?></div>
                
                
            </div><!-- .text-holder -->
            
    <?php if ( 'div' != $args['style'] ){ ?>
        </div>
    <?php }
}    
endif;

if( ! function_exists( 'travel_agency_get_trip_currency' ) ) :
/**
 * Get currency for WP Travel Engine Trip
*/
function travel_agency_get_trip_currency(){
    $currency = '';
    if( travel_agency_is_wpte_activated() ){
        $wpte_setting = get_option( 'wp_travel_engine_settings', true ); 
        $code = 'USD';
        if( isset( $wpte_setting['currency_code'] ) && $wpte_setting['currency_code']!= '' ){
            $code = $wpte_setting['currency_code'];
        } 
        $obj = new Wp_Travel_Engine_Functions();
        $currency = $obj->wp_travel_engine_currencies_symbol( $code );
    }
    return $currency;
}
endif;

if( ! function_exists( 'travel_agency_get_template_part' ) ) :
/**
 * Get template from plus, companion or theme.
 *
 * @param string $template Name of the section.
 */
function travel_agency_get_template_part( $template ) {

	if( locate_template( $template . '.php' ) ){
		get_template_part( $template );
	}else{
		if( defined( 'TRAVEL_AGENCY_COMPANION_PATH' ) ){
			 if( file_exists( TRAVEL_AGENCY_COMPANION_PATH . 'public/sections/' . $template . '.php' ) ){
				require_once( TRAVEL_AGENCY_COMPANION_PATH . 'public/sections/' . $template . '.php' );
			}
		}		
	}
}
endif;

if( ! function_exists( 'travel_agency_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function travel_agency_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul id="primary-menu" class="menu">';
        echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'travel-agency' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'travel_agency_get_homepage_section' ) ) :
/**
 * Return homepage sections
*/
function travel_agency_get_homepage_section(){
    $sections  = array();
    $ed_banner = get_theme_mod( 'ed_banner', true );
    $ed_blog   = get_theme_mod( 'ed_blog_section', true );
    
    if( $ed_banner ) array_push( $sections, 'sections/banner' );
    if( $ed_blog ) array_push( $sections, 'sections/blog' );
    
    return apply_filters( 'travel_agency_home_sections', $sections );
}
endif;

if( ! function_exists( 'travel_agency_get_header_search' ) ) :
/**
 * Display search button in header
*/
function travel_agency_get_header_search(){ 
    $ed_search = get_theme_mod( 'ed_search', true );
    if( $ed_search ){ ?>
        <div class="form-section">
    		<a href="javascript:void(0);" id="btn-search"><span class="fa fa-search"></span></a>
    		<div class="form-holder">
    			<?php get_search_form(); ?>
    		</div>
    	</div><!-- .form-section -->
        <?php
    }
}
endif;

if( ! function_exists( 'travel_agency_social_links' ) ) :
/**
 * Prints social links in header
*/
function travel_agency_social_links(){
    $defaults = array(
        array(
            'font' => 'fa fa-facebook',
            'link' => 'https://www.facebook.com/',                        
        ),
        array(
            'font' => 'fa fa-twitter',
            'link' => 'https://twitter.com/',
        ),
        array(
            'font' => 'fa fa-youtube-play',
            'link' => 'https://www.youtube.com/',
        ),
        array(
            'font' => 'fa fa-instagram',
            'link' => 'https://www.instagram.com/',
        ),
        array(
            'font' => 'fa fa-google-plus-circle',
            'link' => 'https://plus.google.com',
        ),
        array(
            'font' => 'fa fa-odnoklassniki',
            'link' => 'https://ok.ru/',
        ),
        array(
            'font' => 'fa fa-vk',
            'link' => 'https://vk.com/',
        ),
        array(
            'font' => 'fa fa-xing',
            'link' => 'https://www.xing.com/',
        )
    );
    $social_links = get_theme_mod( 'social_links', $defaults );
    $ed_social    = get_theme_mod( 'ed_social_links', true ); 
    
    if( $ed_social && $social_links ){ ?>
    <ul class="social-networks">
    	<?php foreach( $social_links as $link ){ ?>
            <li><a href="<?php echo esc_url( $link['link'] ); ?>" target="_blank" rel="nofollow"><i class="<?php echo esc_attr( $link['font'] ); ?>"></i></a></li>    	   
    	<?php } ?>
	</ul>
    <?php    
    }
}
endif;

if( ! function_exists( 'travel_agency_get_page_id_by_template' ) ) :
/**
 * Returns Page ID by Page Template
*/
function travel_agency_get_page_id_by_template( $template_name ){
    $args = array(
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template_name
    );
    return $pages = get_posts( $args );    
}
endif;

/**
 * Check if Wp Travel Engine Plugin is installed
*/
function travel_agency_is_wpte_activated(){
    return class_exists( 'Wp_Travel_Engine' ) ? true : false;
}

if( ! function_exists( 'travel_agency_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 *
 * @return string
 */
function travel_agency_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;