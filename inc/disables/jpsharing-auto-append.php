<?php
/**
 * Disable auto append of sharing buttons after content and excerpt
 *
 * @package aquago
 */

add_action( 'init', 'itm_disable_jpsharing_append' );
/**
 * Remove filters of jpsharing
 *
 * @return void
 */
function itm_disable_jpsharing_append() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
