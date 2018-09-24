<?php
/**
 * About Section
 * 
 * @package Travel_Agency
 */

$title      = get_theme_mod( 'about_us_title', __( 'Create Your Travel Booking Website with Travel Agency Theme', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'about_us_desc', __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

            Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.
            
            It is also translation ready. So you can translate your website in any language.', 'travel-agency-companion' ) );
$label      = get_theme_mod( 'about_us_readmore', __( 'View More', 'travel-agency-companion' ) );
$link       = get_theme_mod( 'about_us_readmore_link', __( '#', 'travel-agency-companion' ) );
$adcode     = get_theme_mod( 'about_us_ad_content', '<img src="' . esc_url( TRAVEL_AGENCY_COMPANION_URL. 'includes/images/img1.jpg' ) . '"/>' );
$class      = $adcode ? '' : ' no-code'; 
if( $title || $content || ( $label && $link ) || $adcode ){ ?>
<section class="about" id="about_section">
	<div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
		<div class="row">
			<?php 
                if( $title || $content || ( $label && $link ) ){ 
                    echo '<div class="text-holder' . esc_attr( $class ) . '">';
    				if( $title ) echo '<h2 class="title">' . esc_html( travel_agency_companion_get_about_title() ) . '</h2>';;
    				if( $content ) echo '<div class="content">' . wp_kses_post( travel_agency_companion_get_about_content() ) . '</div>';
                    if( $label && $link ) echo '<a href="' . esc_url( $link ) . '" class="btn-more">' . esc_html( travel_agency_companion_get_about_label() ) . '</a>';
                    echo '</div>';
    			} 
                
                if( $adcode ) echo '<div class="img-holder">' . wpautop( $adcode ) . '</div>';
            ?>            
		</div>
	</div>
</section>
<?php
}