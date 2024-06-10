<?php
/**
 * ACF Options page
 *
 * @link https://www.advancedcustomfields.com/resources/options-page/
 *
 * @package aquagoer
 */

if ( function_exists( 'acf_add_options_page' ) ) {
	// Register options page.
	$option_page = acf_add_options_page(array(
		'page_title'    => __('Theme Settings'),
		'menu_title'    => __('Ustawienie motyw'),
		'menu_slug'     => 'theme-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}

/**
 * Add Google Map API key
 */
function itm_acf_init() {
	$google_maps_api_key = get_field( 'google_maps_api_key', 'option' );
	if ( $google_maps_api_key ) {
		acf_update_setting( 'google_api_key', $google_maps_api_key );
	}
}
add_action( 'acf/init', 'itm_acf_init' );

/**
 * Sanitize Anchor ID field before saving
 *
 * @param int $post_id - The post ID.
 */
function itm_acf_sanitize_anchor_id( $post_id ) {

	$builder = get_field( 'builder', $post_id );
	if ( ! empty( $builder ) ) {
		foreach ( $builder as $k => $row ) {
			if ( 'anchor' === $row['acf_fc_layout'] ) {
				$value     = $row['anchor_id'];
				$new_value = sanitize_title( $value );
				update_post_meta( $post_id, 'builder_' . $k . '_anchor_id', $new_value );
			}
		}
	}
}
add_action( 'acf/save_post', 'itm_acf_sanitize_anchor_id' );

/**
 * Disable ACFE Modules that not needed
 */
function itm_acfe_modules() {
	acf_update_setting( 'acfe/modules/ui', false );
	acf_update_setting( 'acfe/modules/taxonomies', false );
	acf_update_setting( 'acfe/modules/post_types', false );
	acf_update_setting( 'acfe/modules/author', false );
	acf_update_setting( 'acfe/modules/block_types', false );
	acf_update_setting( 'acfe/modules/forms', false );
	acf_update_setting( 'acfe/modules/multilang', false );
	acf_update_setting( 'acfe/modules/options', false );
	acf_update_setting( 'acfe/modules/options_pages', false );
	acf_update_setting( 'acfe/modules/categories', false );
}
add_action( 'acfe/init', 'itm_acfe_modules' );
