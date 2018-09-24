<?php
/**
 * Common Header Banner
 */
?>

<?php $enable_home_slider = optimum_get_options('om_enable_home_page_slider', ''); ?>
<?php if($enable_home_slider && is_front_page()): ?>
<?php $home_slider_array = optimum_home_slider();  ?>
    <div id="home-slider" role="banner">
    	<div class="owl-carousel owl-theme">
    	<?php $enable_slider_overaly = (optimum_get_options('om_enable_slider_overlay_bg', '')) ? 'bg-overlay' : ' default-bg'; ?>
    	<?php foreach($home_slider_array as $home_slider_item => $home_slider_fields): ?>
    	    <?php if(optimum_get_options($home_slider_fields['image'], '')): ?>
    	    <div class="item">
    		    <div class="<?php echo $enable_slider_overaly; ?>"></div>
  		      <img src="<?php echo esc_url(optimum_get_options($home_slider_fields['image'], '')); ?>" class="gallery-post-single" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/>
        		<div class="content-wrapper clearfix">
      		    <div class="slide-content text-center clearfix">
                <?php if(optimum_get_options($home_slider_fields['description'], '')): ?>
                  <h2><?php echo esc_html(optimum_get_options($home_slider_fields['description'], '')); ?></h2>
                <?php endif; ?>
      		    </div>
        		</div>
          </div><!--.item-->
  	    <?php endif; ?>
    	<?php endforeach; ?>
    </div><!--.owl-carousel-->
  </div><!--#home-slider-->

<?php else: ?>

  <div id="banner" role="banner">
    <?php if ( get_header_image() ) : ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
          <img class="site-banner" src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
      </a>
    <?php else: ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <img src="<?php echo esc_url ( get_template_directory_uri() . '/includes/images/banner.jpg'); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"  title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
      </a>
    <?php endif; ?>
  </div>

<?php endif; ?>
