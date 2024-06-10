<?php
/**
 * Custom functions which help to speed up development
 *
 * @package aquago
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function itm_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
	// Translators: %s: post date.
		esc_html_x( 'Posted on %s', 'post date', 'aquago' ),
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Prints HTML with meta information for the current author.
 */
function itm_posted_by() {
	$byline = sprintf( /* translators: %s: post author. */ esc_html_x( 'by %s', 'post author', 'aquago' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the post categories.
 */
function itm_cat_links() {
	$categories_list = get_the_category_list( esc_html__( ', ', 'aquago' ) );
	if ( $categories_list ) {
		// Translators: category list.
		printf( '<div class="cat-links">' . esc_html__( 'Posted in %1$s', 'aquago' ) . '</div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Prints HTML with meta information for the post tags.
 */
function itm_tag_links() {
	$tags_list = get_the_tag_list( '', ', ' );
	if ( $tags_list ) {
		// Translators: tags list.
		printf( '<div class="tag-links">' . esc_html__( 'Tagged %1$s', 'aquago' ) . '</div>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Limit Excerpt Length
 *
 * @param int $word_limit - the amount of the words in the excerpt you want to get.
 */
function itm_excerpt( $word_limit ) {

	$excerpt = explode( ' ', get_the_excerpt(), $word_limit );

	if ( count( $excerpt ) >= $word_limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ', $excerpt ) . '...';
	} else {
		$excerpt = implode( ' ', $excerpt );
	}

	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	echo esc_html( $excerpt );
}

/**
 * Phone number cleaner
 *
 * @param string $tel - telephone number string.
 */
function itm_phone_cleaner( $tel ) {
	return preg_replace( ['/[^+\d]+/', '/^\+/'], '', $tel );
}

/**
 * Hide email from Spam Bots using a shortcode.
 *
 * @param array  $atts - the default shortcode's attributes array.
 * @param string $content - the email you want to output.
 */
function itm_hide_email_shortcode( $atts, $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	$email = antispambot( $content );

	return sprintf( '<a href="%s">%s</a>', esc_url( "mailto:$email" ), esc_html( $email ) );
}

add_shortcode( 'email', 'itm_hide_email_shortcode' );

/**
 * Image Placeholder
 */
function itm_image_placeholder() {
	echo '<span class="img-placeholder"><svg id="image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V112c0-26.51-21.49-48-48-48zm16 336c0 8.822-7.178 16-16 16H48c-8.822 0-16-7.178-16-16V112c0-8.822 7.178-16 16-16h416c8.822 0 16 7.178 16 16v288zM112 232c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56 25.072 56 56 56zm0-80c13.234 0 24 10.766 24 24s-10.766 24-24 24-24-10.766-24-24 10.766-24 24-24zm207.029 23.029L224 270.059l-31.029-31.029c-9.373-9.373-24.569-9.373-33.941 0l-88 88A23.998 23.998 0 0 0 64 344v28c0 6.627 5.373 12 12 12h360c6.627 0 12-5.373 12-12v-92c0-6.365-2.529-12.47-7.029-16.971l-88-88c-9.373-9.372-24.569-9.372-33.942 0zM416 352H96v-4.686l80-80 48 48 112-112 80 80V352z"/></svg></span>';
}


/**
 * Inline SVG
 *
 * @param string $svg_url - the URL to your SVG file you want to inline.
 */
function itm_inline_svg( $svg_url ) {
	$svg_content = '';
	$extension   = pathinfo( $svg_url, PATHINFO_EXTENSION );

	if ( 'svg' === $extension ) { // Also I'd add some extra security check for mime type.
		if ( str_contains( $svg_url, home_url() ) ) {
			$path        = str_replace( home_url( '/' ), '', $svg_url );
			$svg_content = file_get_contents( ABSPATH . $path );
		} else {
			$remote_svg_file = wp_remote_get( $svg_url, [ 'sslverify' => false ] );
			$svg_content     = wp_remote_retrieve_body( $remote_svg_file );
		}
	} else {
		$svg_content = '<img alt="" src="' . $svg_url . '">';
	}

	return $svg_content;
}


if ( ! function_exists( 'itm_console_log' ) ) {
	/**
	 * Output like the var_dump() in the browser's JS console.
	 *
	 * @param string $content - content to display.
	 * @param string $as_text - display type: text, JS object.
	 */
	function itm_console_log( $content = null, $as_text = true ) {
		$result = '<div class="php-to-js-console-log" style="display: none!important;" data-as-text="' . esc_attr( (bool) $as_text ) . '" data-variable="' . htmlspecialchars( wp_json_encode( $content ) ) . '">' . htmlspecialchars( var_export( $content, true ) ) . '</div>'; // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_export
		echo esc_html( $result );

		$hook = is_admin() ? 'admin_footer' : 'wp_footer';
		add_action(
			$hook,
			function() {
				echo '<script>(function ($) { $(document).ready(function ($) { var phpToJsElements = $(".php-to-js-console-log").detach(); $("body").append("<div id=\"php-to-js-console-logs\" style=\"display: none!important;\"></div>"); $("#php-to-js-console-logs").append(phpToJsElements); phpToJsElements.each(function (i, el) { var $e = $(el); console.log("PHP debug is below:"); (!$e.attr("data-as-text")) ? console.log(JSON.parse($e.attr("data-variable"))) : console.log($e.text()); }); }); }(jQuery));</script>';
			},
			1
		);
	}
}

// @codingStandardsIgnoreStart
if ( ! function_exists( 'itm_log' ) ) {
	/**
	 * Log to the file
	 *
	 * @param string|array $var - variable to display.
	 * @param string $label - some label.
	 * @param string $file - log file location (website root folder by default).
	 */
	function itm_log( $var, $label = null, $file = ABSPATH . '/my.log' ) {

		$logfile       = $file;
		$date_format   = 'Y-m-d H:i:s';
		$formatted_var = print_r( $var, true );
		$output        = $date_format ? '[' . date( $date_format ) . '] ' : '';
		$output       .= $label ? '(' . $label . ') ' : '';
		$output       .= $formatted_var . "\n";

		// Open the log file, or create it if it doesn't exist.
		if ( ! $handle = fopen( $logfile, 'a' ) ) {
			return false;
		}
		if ( fwrite( $handle, $output ) === false ) {
			return false;
		}

		fclose( $handle );

		return true;
	}
}
// @codingStandardsIgnoreEnd
