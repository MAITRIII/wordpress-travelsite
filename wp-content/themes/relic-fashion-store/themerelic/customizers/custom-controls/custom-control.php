<?php
/**
 * Register Custom Controls
*/
function relic_fashion_store_controls( $wp_customize ){
    
    //Customizer Settings
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/toggle/class-toggle-control.php';
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/sortable/class-sortable-control.php';
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/multicheck/class-multicheck-control.php';
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/radio/class-control-radio.php';

    //Repeater Section
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/themerelic/customizers/custom-controls/repeater/class-control-repeater.php';

    
    $wp_customize->register_control_type( 'Relic_Fashion_Store_MultiCheck_Control' );
    $wp_customize->register_control_type( 'Relic_Fashion_Store_Toggle_Control' );
    $wp_customize->register_control_type( 'Relic_Fashion_Store_Drag_Section_Control' );
}
add_action( 'customize_register', 'relic_fashion_store_controls' );