<?php
/**
 * Sanitization Functions
 * 
 * @package Relic_Fashion_Store_Pro
 */

/**
 * Sanitize callback for checkbox
*/
function relic_fashion_store_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize Number Section
 */
function relic_fashion_store_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}


/**
 * Sanitize callback for select
*/
function relic_fashion_store_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Image Sanitize callback
 */
function relic_fashion_store_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Multiple checkbox Sanitize callback
 */
function relic_fashion_store_sanitize_multiple_check( $value ) {                        
    $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
    return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();    
}

/**
 * Sortable Section Sanitize callback
 */
function relic_fashion_store_sanitize_sortable( $value = array() ) {
	if ( is_string( $value ) || is_numeric( $value ) ) {
		return array(
			esc_attr( $value ),
		);
	}
	$sanitized_value = array();
	foreach ( $value as $sub_value ) {
		$sanitized_value[] = esc_attr( $sub_value );
	}
	return $sanitized_value;
}



//Radio Button
function relic_fashion_store_sanitize_radio( $input, $setting ){
         
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}