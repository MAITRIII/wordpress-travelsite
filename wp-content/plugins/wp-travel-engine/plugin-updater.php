<?php
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( plugin_dir_path( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}
// retrieve our license key from the DB
$wp_travel_engine = get_option( 'wp_travel_engine_license' );

function wp_travel_engine_license_menu() {
	add_submenu_page( 'edit.php?post_type=trip', 'Extensions for WP Travel Engine', 'Plugin License', 'manage_options', WP_TRAVEL_ENGINE_PLUGIN_LICENSE_PAGE, 'wp_travel_engine_license_page' );
}
add_action('admin_menu', 'wp_travel_engine_license_menu');

function wp_travel_engine_license_page() {
	$wp_travel_engine = get_option( 'wp_travel_engine_license' );
	$addon_name = apply_filters( 'wp_travel_engine_addons', array() );
	$as[] = '';
	$a_name = apply_filters( 'wp_travel_engine_licenses', $as );
	foreach($a_name as $key=>$value)
	{
	    if(is_null($value) || $value == '')
	        unset($a_name[$key]);
	}
	foreach ($a_name as $key => $value) {
		$edd_updater = new EDD_SL_Plugin_Updater( WP_TRAVEL_ENGINE_STORE_URL, WP_TRAVEL_ENGINE_BASE_PATH, $value );
	}
	?>
	<div class="wrap">
		<h2><?php _e('Plugin License Options', 'wp-travel-engine'); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields('wp_travel_engine_license'); ?>
			<table class="form-table">
				<tbody>
					<input type="hidden" name="addon_name" class="addon_name" type="text" value="" />
					<?php
					if( sizeof($addon_name) == 0 )
					{
						echo '<h3 class="active-msg" style="color:#CA4A1F;">'.__('Premium Extensions not Found!', 'wp-travel-engine').'</h3>';
					}
					foreach ($addon_name as $key => $value) {
						$wte_fixed_departure_license = isset($wp_travel_engine[$value.'_license_key']) ? esc_attr($wp_travel_engine[$value.'_license_key']):false;
						$wte_fixed_departure_status  = isset( $wp_travel_engine[$value.'_license_status'] ) ? esc_attr( $wp_travel_engine[$value.'_license_status'] ):false;
						?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('License Key', 'wp-travel-engine');  ?>
							</th>
							<td>
								<input id="<?php echo $value;?>" class="wp_travel_engine_addon_license_key" name="wp_travel_engine_license[<?php echo $value;?>_license_key]" type="text" class="regular-text" value="<?php esc_attr_e( $wte_fixed_departure_license, 'wp-travel-engine' ); ?>" />
								<label class="description" for="wp_travel_engine_license[<?php echo $value;?>_license_key]"><?php _e('Enter your license key for ', 'wp-travel-engine'); echo $key; ?></label>
							</td>
						</tr>
						<?php if( $wte_fixed_departure_license ) { ?>
							<tr valign="top">
								<th scope="row" valign="top">
									<?php _e('Activate License', 'wp-travel-engine'); ?>
								</th>
								<td>
									<?php if( $wte_fixed_departure_status == 'valid' ) { ?>
										<span class="active-msg" style="color:green;"><?php _e('You license key has been activated.', 'wp-travel-engine'); ?></span>
										<?php wp_nonce_field( 'wp_travel_engine_license_nonce', 'wp_travel_engine_license_nonce' ); ?>
										<input type="submit" class="button-secondary deactivate-license" data-id="<?php echo $value; ?>" name="edd_license_deactivate" value="<?php _e('Deactivate License', 'wp-travel-engine'); ?>"/>
									<?php } else { ?>
										<span class="active-msg" style="color:red;"><?php _e('Please activate your license.', 'wp-travel-engine'); ?></span>
										<?php wp_nonce_field( 'wp_travel_engine_license_nonce', 'wp_travel_engine_license_nonce' ); ?>
										<input type="submit" class="button-secondary activate-license" data-id="<?php echo $value; ?>" name="edd_license_activate" value="<?php _e('Activate License', 'wp-travel-engine'); ?>"/>
									<?php } ?>
								</td>
							</tr>
						<?php
						} 
					}
					?>
				</tbody>
			</table>
			<?php 	if( sizeof( $addon_name ) != 0 )
					{
						submit_button(); 
					}
					else{
						echo '<a target="_blank" href="https://wptravelengine.com/downloads/category/add-ons/" class="button button-primary">'.__('Get Now','').'</a>';
					}
					?>
			<?php 
				echo 
				"<script>
					$('body').on('click', '.activate-license, .deactivate-license', function (e){
						var val = $(this).attr('data-id');
						$('.addon_name').attr('value',val);
					}); 
				</script>";
			?>
		</form>
	</div>	
	<?php
}

function wp_travel_engine_register_option() {
	// creates our settings in the options table
	register_setting('wp_travel_engine_license', 'wp_travel_engine_license', 'wpte_sanitize_license' );
}
add_action('admin_init', 'wp_travel_engine_register_option');

function wpte_sanitize_license( $new ) {
	$value = $_POST['addon_name'];
	$option = get_option( 'wp_travel_engine_license' );
	$addon_name = apply_filters( 'wp_travel_engine_addons', array() );
		$wte_fixed_departure_status  = isset( $option[$value.'_license_status'] ) ? esc_attr( $option[$value.'_license_status'] ):false;
		$arr = array();
		if(  $_POST['edd_license_activate'] && $_POST['edd_license_activate'] == 'Activate License' )
		{
			
					$new[$value.'_license_key'] = $option[$value.'_license_key'];
					$new[$value.'_license_status'] = 'valid';
			
		}
		if(  $_POST['edd_license_deactivate'] && $_POST['edd_license_deactivate'] == 'Deactivate License' )
		{
			
			$old = $option[$value.'_license_key'];
			if( $old && $old != $new[$value.'_license_key'] ) {
				$arr[$value.'_license_status'] = '';
				$wte_fixed_departure_status_new = array_merge_recursive( $option, $arr );
				update_option( 'wp_travel_engine_license', $wte_fixed_departure_status_new );
				$new[$value.'_license_key'] = $option[$value.'_license_key'];
				$new[$value.'_license_status'] = '';
			}
			
		}
		if( $_POST['submit'] ){
			foreach ($addon_name as $key => $val) {
				$new[$val.'_license_key'] = isset($_POST['wp_travel_engine_license'][$val.'_license_key']) ? esc_attr($_POST['wp_travel_engine_license'][$val.'_license_key']):false;
				$new[$val.'_license_status']  = isset( $option[$val.'_license_status'] ) ? esc_attr( $option[$val.'_license_status'] ):false;
			}
		}
	return $new;
}

function wp_travel_engine_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_license_activate'] ) ) {
		// run a quick security check
	 	if( ! check_admin_referer( 'wp_travel_engine_license_nonce', 'wp_travel_engine_license_nonce' ) )
			return; // get out if we didn't click the Activate button
		
		$wp_travel_engine = get_option( 'wp_travel_engine_license');

		$addon_name = $_POST['addon_name'];
		$addon_id = apply_filters( 'wp_travel_engine_addons_id', array() );
		// retrieve the license from the database
		$wte_fixed_departure_license = isset($wp_travel_engine[$addon_name.'_license_key']) ? esc_attr($wp_travel_engine[$addon_name.'_license_key']):false;

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $wte_fixed_departure_license,
			'item_id'    => $addon_id[$addon_name], // The ID of the item in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( WP_TRAVEL_ENGINE_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			$message =  ( is_wp_error( $response ) && ( $response->get_error_message() )!='' ) ? $response->get_error_message() : __( 'An error occurred, please try again.', 'wp-travel-engine' );

		} else {

			$wte_fixed_departure_license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $wte_fixed_departure_license_data->success ) {

				switch( $wte_fixed_departure_license_data->error ) {

					case 'expired' :

						$message = sprintf(
							__( 'Your license key expired on %s.', 'wp-travel-engine' ),
							date_i18n( get_option( 'date_format' ), strtotime( $wte_fixed_departure_license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked' :

						$message = __( 'Your license key has been disabled.', 'wp-travel-engine' );
						break;

					case 'missing' :

						$message = __( 'Invalid license.', 'wp-travel-engine' );
						break;

					case 'invalid' :
					case 'site_inactive' :

						$message = __( 'Your license is not active for this URL.', 'wp-travel-engine' );
						break;

					case 'item_name_mismatch' :

						$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'wp-travel-engine' ), EDD_SAMPLE_ITEM_NAME );
						break;

					case 'no_activations_left':

						$message = __( 'Your license key has reached its activation limit.', 'wp-travel-engine' );
						break;

					default :

						$message = __( 'An error occurred, please try again.', 'wp-travel-engine' );
						break;
				}

			}

		}

		// Check if anything passed on a message constituting a failure
		if ( ! empty( $message ) ) {
			$base_url = admin_url( 'edit.php?post_type=trip&page=wp_travel_engine_license_page' );
			$redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );
			echo $message;
			wp_redirect( $redirect );
			exit();
		}

		// $wte_fixed_departure_license_data->license will be either "valid" or "invalid"
		$options = get_option( 'wp_travel_engine_license' );
		// echo $options[$addon_name.'_license_status'];
		// die;
		$wte_fixed_departure_status  = isset( $options[$addon_name.'_license_status'] ) ? esc_attr( $options[$addon_name.'_license_status'] ):false;
		if( $wte_fixed_departure_status!= 'valid' )
		{
			$arr = array();
			// if(!isset($options[$addon_name.'_license_status']) || )
			// {
				// print_r($options);
				// die;
				$arr[$addon_name.'_license_status'] = $wte_fixed_departure_license_data->license;
				$wte_fixed_departure_status_new = array_merge_recursive( $options, $arr );
				update_option( 'wp_travel_engine_license', $wte_fixed_departure_status_new );
			// }
		}

		wp_redirect( admin_url( 'edit.php?post_type=trip&page=wp_travel_engine_license_page' ) );
		exit();
	}
}
add_action('admin_init', 'wp_travel_engine_activate_license');

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function wp_travel_engine_license_admin_notices() {
	if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {
		switch( $_GET['sl_activation'] ) {
			case 'false':
				$message = urldecode( $_GET['message'] );
				?>
				<div class="error">
					<p><?php echo $message; ?></p>
				</div>
				<?php
				break;
			case 'true': ?>
				<div id="message" class="updated inline"><p>Your license has been activated.</p></div>
			<?php
			break;
		}
	}
}
add_action( 'admin_notices', 'wp_travel_engine_license_admin_notices' );