<?php
/**
 * Customise login screen
 *
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 *
 * @package aquago
 */

/**
 * Changing the logo link from wordpress.org to root domain
 */
function itm_login_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'itm_login_url' );

/**
 * Changing the alt text on the logo to show your site name
 */
function itm_login_title() {
	return get_option( 'blogname' );
}
add_filter( 'login_headertext', 'itm_login_title' );

/**
 * Styles for login page
 */
function itm_login_stylesheet() {
	wp_enqueue_style( 'it-login', ITM_CSS . 'login.css', 0, wp_get_theme()->get( 'Version' ) );
}

add_action( 'login_enqueue_scripts', 'itm_login_stylesheet' );
