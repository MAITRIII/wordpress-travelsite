<?php
/**
 * Relic Fashion Store Demo Import Functions
 */
function relic_fashion_store_demo_import_files() {
    return array(
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Ecommerce','Fashion'),
        'import_file_url'            => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://themerelic.com/wp-content/uploads/2018/04/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'relic-fashion-store' ),
        'preview_url'                => 'http://demo.themerelic.com/relic-fashion-store/',
      ),
      array(
        'import_file_name'           => 'Default',
        'categories'                 => array( 'Ecommerce','Fashion'),
        'import_file_url'            => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/all-content.xml',
        'import_widget_file_url'     => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/widget.wie',
        'import_customizer_file_url' => 'http://demo.themerelic.com/demo-import/relic-fashion-store/default/customizer.dat',
        
        'import_preview_image_url'   => 'https://themerelic.com/wp-content/uploads/2018/04/screenshot.png',
        'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'relic-fashion-store' ),
        'preview_url'                => 'http://demo.themerelic.com/relic-fashion-store/',
      ),
      
    );
  }
add_filter( 'pt-ocdi/import_files', 'relic_fashion_store_demo_import_files' );

/**
 * After Demo Import Functions
 */
function relic_fashion_store_after_import_setup() {
  // Assign menus to their locations.
  $top_menu_options = get_term_by( 'name', 'top-menu', 'nav_menu' );
  $main_menu = get_term_by( 'name', 'menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'top-menu'      => $top_menu_options->term_id,
      'main-menu'     => $main_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Sample Page ' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'relic_fashion_store_after_import_setup' );