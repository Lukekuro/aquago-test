<?php
/**
 * Disable media slug
 *
 * @package aquago
 */

// Disable media slug.
add_filter( 'wp_unique_post_slug_is_bad_attachment_slug', '__return_true' );
