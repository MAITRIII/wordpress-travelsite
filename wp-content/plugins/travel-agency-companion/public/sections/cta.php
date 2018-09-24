<?php
/**
 * Call To Action Section
 * 
 * @package Travel_Agency
 */

$title      = get_theme_mod( 'cta_title', __( 'Get Ready', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'cta_desc', __( 'Keep a Call To Action button and promote your services. You can modify this section from Appearance > Customize > Home Page Settings > Call to Action Section.', 'travel-agency-companion' ) );
$readmore   = get_theme_mod( 'cta_readmore', __( 'Browse Package', 'travel-agency-companion' ) );
$more_link  = get_theme_mod( 'cta_link', '#' );
$bg_image   = get_theme_mod( 'cta_bg_image', TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img25.jpg' );

if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || ( $readmore && $more_link ) ){ ?>
<section id="cta_section" class="cta"<?php echo $bg_img; ?>>
	<div class="container">
		<div class="text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
			<?php 
                if( $title ) echo '<h2 class="title">' . esc_html( travel_agency_companion_get_cta_title() ) . '</h2>';
                if( $content ) echo '<div class="content">' . wp_kses_post( travel_agency_companion_get_cta_content() ) . '</div>';
                if( $readmore && $more_link ) echo '<a href="' . esc_url( $more_link ) . '" class="btn-more">' . esc_html( travel_agency_companion_get_ctabtn_label() ) . '</a>';
            ?>
		</div>
	</div>
</section>
<?php
}