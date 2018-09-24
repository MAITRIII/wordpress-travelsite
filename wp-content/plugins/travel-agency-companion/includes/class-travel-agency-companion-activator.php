<?php

/**
 * Fired during plugin activation
 *
 * @link       raratheme.com
 * @since      1.0.0
 *
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Travel_Agency_Companion
 * @subpackage Travel_Agency_Companion/includes
 * @author     raratheme <raratheme.com>
 */
class Travel_Agency_Companion_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$get_theme = wp_get_theme(); // gets the current theme
        $current_template = $get_theme->get( 'Template' );
        $current_template_name = $get_theme->get( 'Name' );
        if(isset($current_template) && $current_template!='' )
        {
	        if ( strpos( $current_template, 'travel-agency' ) === false )
			{
				$theme_link = '<a href="https://raratheme.com/wordpress-themes/travel-agency-pro/" target="_blank">Travel Agency Pro</a>';
				$goback = '<a href="javascript:history.go(-1)">Go Back</a>';
				$message = sprintf( esc_html__( 'Sorry, the plugin can not be activated. The current theme is not compatible with the plugin. Please install and activate %1$s theme. %2$s', 'travel-agency-companion' ), $theme_link, $goback );
				wp_die($message. $current_template);
			}
		}
		else{
			if ( strpos( $current_template_name, 'Travel Agency' ) === false )
			{
				$theme_link = '<a href="https://raratheme.com/wordpress-themes/travel-agency-pro/" target="_blank">Travel Agency Pro</a>';
				$goback = '<a href="javascript:history.go(-1)">Go Back</a>';
				$message = sprintf( esc_html__( 'Sorry, the plugin can not be activated. The current theme is not compatible with the plugin. Please install and activate %1$s theme. %2$s', 'travel-agency-companion' ), $theme_link, $goback );
				wp_die($message.$current_template_name);
			}
		}
	}

}
