<?php
/**
 * Our Features Section
 * 
 * @package Travel_Agency
 */

$default    = new Travel_Agency_Companion_Dummy_Array;
$title      = get_theme_mod( 'whyus_title', __( 'Why Book with Us', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'whyus_desc', __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-companion' ) );
$why_us     = get_theme_mod( 'why_us', $default->default_why_us() );
$bg_image   = get_theme_mod( 'whyus_bg_image', TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img13.jpg' );

if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $why_us ){ ?>
<section id="whyus_section" class="our-features"<?php echo $bg_img; ?>>
		
    <?php if( $title || $content ){ ?>
    <header class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
		<?php 
            if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_why_us_title() ) . '</h2>';
            if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_why_us_content() ) . '</div>'; 
        ?>            
	</header>
    <?php } ?>
    
    <?php if( $why_us ){ ?>
	<div class="features-holder wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
        <div class="grid">			
		<?php foreach( $why_us as $why ){ 
            if( $why['whyus-icon'] || $why['title'] || $why['description'] ){ ?>            
				<div class="col">
					<?php if( $why['whyus-icon'] ){ ?>
                    <div class="icon-holder">
						<svg width="60" height="60">
                            <circle cx="14" cy="29" r="29" transform="rotate(-90, 22, 22)"/>
                        </svg>
                        <i class="<?php echo esc_attr( $why['whyus-icon'] ); ?>"></i>
					</div>
					<?php } ?>
                    <?php if( $why['title'] || $why['description'] ){ ?>
                    <div class="text-holder">
						<?php if( $why['title'] ){ ?>
                        <h3 class="title">
                            <?php 
                            if( $why['url'] ) echo '<a href="' . esc_url( $why['url'] )  . '">';
                            echo esc_html( $why['title'] ); 
                            if( $why['url'] ) echo '</a>';
                            ?>
                        </h3>
                        <?php }
                        if( $why['description'] ) echo wp_kses_post( wpautop( $why['description'] ) );
                        ?>
					</div>
                    <?php } ?>
				</div>
            <?php 
            } 
        }?>
        </div>
	</div>
    <?php } ?>
        
</section>
<?php
}