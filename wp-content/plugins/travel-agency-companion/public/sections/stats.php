<?php
/**
 * Stat Counter Section
 * 
 * @package Travel_Agency
 */

$default    = new Travel_Agency_Companion_Dummy_Array;
$title      = get_theme_mod( 'stat_counter_title', __( 'Stats Counter', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'stat_counter_desc', __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > Home Page Settings > Stats Counter Settings.', 'travel-agency-companion' ) );
$counter    = get_theme_mod( 'counter', $default->default_stat_counter() );
$bg_image   = get_theme_mod( 'stat_bg_image', TRAVEL_AGENCY_COMPANION_URL . 'includes/images/img20.jpg' ); //from customizer
$ran        = rand(1,1000); 
if( $bg_image ){
    $bg_img = ' style="background:url(' . esc_url( $bg_image ) . ') no-repeat"';
}else{
    $bg_img = '';
}

if( $title || $content || $counter ){ ?>
<section id="stat_section" class="stats"<?php echo $bg_img; ?>>
	<div class="container">
		
        <?php if( $title || $content ){ ?>
        <header class="section-header wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
			<?php 
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_stat_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_stat_content() ) . '</div>'; 
            ?>
		</header>
        <?php } ?>
        
        <?php if( $counter ){ ?>
        <div class="grid wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
            <?php foreach( $counter as $count ){ ?>
            <div class="col">
                <div class="raratheme-sc-holder">
                    <?php 
                    if( $count['title'] ) echo '<h2 class="title">' . esc_html( $count['title'] ) . '</h2>'; 
                    if( $count['icon'] ){ ?>
                        <div class="icon-holder">                            
                            <i class="fa <?php echo esc_attr( $count['icon'] ); ?>"></i>
                        </div>
                        <?php 
                    } 
                    
                    if( $count['number'] ) { 
                        $ran++;
                        $delay = ($ran/1000)*100; ?>
                        <div id="<?php echo esc_attr( $ran );?>" class="hs-counter wow fadeInDown" data-wow-duration="<?php echo esc_attr( $delay/100 . 's' ); ?>">
                            <div class="odometer odometer<?php echo esc_attr( $ran );?>" data-count="<?php echo absint( $count['number'] ); ?>">0</div>
                        </div>
                        <?php 
                    }
                    ?>
                </div>
            </div>
            <?php } ?>                
        </div>
        <?php } ?>
	</div>
</section>
<?php
}