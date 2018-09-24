<?php
/**
 * Activities Section
 * 
 * @package Travel_Agency
 */

$default    = new Travel_Agency_Companion_Dummy_Array;
$obj        = new Travel_Agency_Companion_Functions;
$title      = get_theme_mod( 'activities_title', __( 'Adventure Activities', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'activities_desc', __( 'This is the best place to tell your visitors what travel services your company provide. You can modify this section from Appearance > Customize > Home Page Settings > Adventure Activities Section on your WordPress.', 'travel-agency-companion' ) );
$activities = get_theme_mod( 'activities', $default->default_activities() );

if( $title || $content || $activities ){ ?>
<section class="activities" id="activities_section">
	<?php if( $title || $content ){ ?>
    <header class="section-header">        
        <div class="holder">
    		<?php 
                if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_companion_get_activities_title() ) . '</h2>';
                if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_companion_get_activities_content() ) . '</div>'; 
            ?>            
    	</div>
    </header>
    <?php } ?>
	
    <?php if( $activities ){ ?>
    <div class="container">        
        <div id="activities-slider" class="owl-carousel wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">
    		<?php foreach( $activities as $activity ){ ?>            
            <div class="item">
    			<div class="img-holder">
    				<?php if( $activity['thumbnail'] ){ 
    				    $img_url = is_numeric( $activity['thumbnail'] ) ? $obj->get_image_url( $activity['thumbnail'] ) : $activity['thumbnail']; ?>    				    
                        <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $activity['name'] ); ?>" />
    				<?php }else{ ?>
    				    <img src="<?php echo esc_url( TRAVEL_AGENCY_COMPANION_URL . 'includes/images/fallback-img-300-405.jpg' ); ?>" alt="<?php echo esc_attr( $activity['name'] ); ?>" />
    				<?php } ?>
                    
    				<?php if( $activity['name'] ) echo '<div class="title-holder">' . esc_html( $activity['name'] ) . '</div>'; ?>
    				<?php if( $activity['name'] || $activity['desc'] || $activity['url'] ){ ?>
                    <div class="text-holder">
					<?php 
                        if( $activity['name'] ) echo '<h3 class="title">' . $activity['name'] . '</h3>'; 
                        if( $activity['desc'] ) echo wp_kses_post( wpautop( $activity['desc'] ) );
                        if( $activity['url'] ) echo '<a href="' . esc_url( $activity['url']) . '" class="btn-more">' . esc_html( '&rarr;' ) . '</a>';
                    ?>
    				</div>
                    <?php } ?>
    			</div>
    		</div>
            <?php } ?>
    	</div>
    </div>
    <?php } ?>
</section>
<?php
}