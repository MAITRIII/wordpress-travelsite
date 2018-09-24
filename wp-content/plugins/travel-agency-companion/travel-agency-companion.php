<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              raratheme.com
 * @since             1.0.0
 * @package           Travel_Agency_Companion
 *
 * @wordpress-plugin
 * Plugin Name:       Travel Agency Companion
 * Plugin URI:        https://wordpress.org/plugins/travel-agency-companion
 * Description:       Companion for adding features to the Travel Agency Theme.
 * Version:           1.2.4
 * Author:            raratheme
 * Author URI:        raratheme.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       travel-agency-companion
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'TRAVEL_AGENCY_COMPANION_FILE_PATH', __FILE__ );
define( 'TRAVEL_AGENCY_COMPANION_BASE_PATH', dirname( __FILE__ ) );
define( 'TRAVEL_AGENCY_COMPANION_PATH', plugin_dir_path( __FILE__ ) );
define( 'TRAVEL_AGENCY_COMPANION_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-travel-agency-companion-activator.php
 */
function activate_travel_agency_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-travel-agency-companion-activator.php';
	Travel_Agency_Companion_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-travel-agency-companion-deactivator.php
 */
function deactivate_travel_agency_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-travel-agency-companion-deactivator.php';
	Travel_Agency_Companion_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_travel_agency_companion' );
register_deactivation_hook( __FILE__, 'deactivate_travel_agency_companion' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-travel-agency-companion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_travel_agency_companion() {

	$plugin = new Travel_Agency_Companion();
	$plugin->run();

}
run_travel_agency_companion();
