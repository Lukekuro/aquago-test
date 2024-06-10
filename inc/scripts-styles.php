<?php
/**
 * Include scripts and styles into theme
 *
 * @link https://developer.wordpress.org/reference/functions/wp_register_style/
 * @link https://developer.wordpress.org/reference/functions/wp_register_script/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_script/
 *
 * @package aquago
 */

$ver = time(); // time() - value for development, wp_get_theme()->get( 'Version' ) - format for production.

/**
 * Enqueue scripts and styles.
 */
function itm_scripts() {
	global $ver;

	// Global Styles.
	wp_enqueue_style( 'theme-styles', ITM_CSS . 'main.css', [], $ver );

	// Global JavaScript.
	wp_enqueue_script( 'theme-js', ITM_JS . 'main.js', [ 'jquery' ], $ver, true );
	wp_localize_script(
		'theme-js',
		'wpApiSettings',
		[
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'ajax-nonce' ),
		]
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'itm_scripts' );

// Enqueue admin scripts.
add_action(
	'admin_enqueue_scripts',
	function () {
		global $ver;

		wp_enqueue_style( 'admin-styles', ITM_CSS . 'admin-styles.css', 0, $ver ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'admin-js', ITM_JS . 'admin.js', 0, $ver, true );
		wp_localize_script(
			'admin-js',
			'wpAdminSettings',
			[
				// WP already has global variable 'ajaxurl' for backend.
				'nonce' => wp_create_nonce( 'ajax-admin-nonce' ),
			]
		);
	},
	99
);
