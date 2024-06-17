<?php
/**
 * IT Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aquago
 */

add_filter( 'wpcf7_autop_or_not', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

define( 'ITM_DIR', get_template_directory() );
define( 'ITM_URL', get_template_directory_uri() );
define( 'ITM_DIST', get_template_directory_uri() . '/dist/' );
define( 'ITM_CSS', get_template_directory_uri() . '/dist/css/' );
define( 'ITM_JS', get_template_directory_uri() . '/dist/js/' );
define( 'ITM_IMG', get_template_directory_uri() . '/dist/img/' );
define( 'ITM_JUST_PIXEL', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' );

require ITM_DIR . '/inc/after-theme-setup.php'; // all hooks that needs to be done on after_theme_setup.
require ITM_DIR . '/inc/acf.php'; // ACF related functions.
require ITM_DIR . '/inc/ajax.php'; // AJAX functions.
require ITM_DIR . '/inc/custom-post-type.php'; // Custom post types.
require ITM_DIR . '/inc/disables.php'; // Disable of extra unwanted features.
require ITM_DIR . '/inc/editor.php'; // Editor functions.
require ITM_DIR . '/inc/gutenberg.php'; // Custom Gutenberg blocks and functions
require ITM_DIR . '/inc/help-func.php'; // Helper functions.
// require ITM_DIR . '/inc/lazy-load.php'; // Images and iframes lazyload.
require ITM_DIR . '/inc/login.php'; // Login screen customisation.
require ITM_DIR . '/inc/scripts-styles.php'; // Scripts and styles enqueue | dequeue.
require ITM_DIR . '/inc/svg-support.php'; // Adds support for SVG upload.
require ITM_DIR . '/inc/widgets.php'; // Sidebars and widgets.
if ( class_exists( 'WooCommerce' ) ) {
	require ITM_DIR . '/inc/woo.php'; // Woocommerce functions.
}
