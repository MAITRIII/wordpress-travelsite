<?php
/**
 * The template for displaying search forms in optimum
 *
 * @package optimum
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="control-group">
		<label for='s' class="screen-reader-text"><?php _e( 'Search for:', 'optimum' ); ?></label>
		<i class="fa fa-search hide"></i>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'optimum' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" id='s' name="s" title="<?php esc_attr_x( 'Search for:', 'label', 'optimum' ); ?>">
		<input type="submit" class="search-submit screen-reader-text" value="<?php echo esc_attr_x( 'Search', 'submit button', 'optimum' ); ?>">
	</div>

</form>
