<?php
/**
 * Disable gutenberg stuff
 *
 * @package aquago
 */

/**
 * Disable Gutenberg block styles
 */
function itm_remove_block_css() {
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'itm_remove_block_css', 100 );

/**
 * Removing some global styles
 *
 * @return void
 */
function itm_custom_wp_remove_global_css() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action( 'init', 'itm_custom_wp_remove_global_css' );

add_filter( 'use_block_editor_for_post', '__return_false', 10 );
