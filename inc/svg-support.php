<?php
/**
 * Allow SVG through WordPress Media Uploader
 *
 * @package aquago
 */

/**
 * Screen check function
 * Checks if the current page is the Media Library page
 */
function itmix_svgs_specific_pages_media_library() {

	// check current page.
	$screen = get_current_screen();

	// check if we're on Media Library page.
	if ( is_object( $screen ) && 'upload' === $screen->id ) {

		return true;

	} else {

		return false;

	}
}

/**
 * Screen check function
 * Check if the current page is a post edit page
 *
 * @param string $new_edit - the page identifier.
 */
function itmix_svgs_is_edit_page( $new_edit = null ) {

	global $pagenow;

	if ( ! is_admin() ) {
		return false;
	}

	if ( 'edit' === $new_edit ) {

		return in_array( $pagenow, array( 'post.php' ), true );

	} elseif ( 'new' === $new_edit ) { // check for new post page.

		return in_array( $pagenow, array( 'post-new.php' ), true );

	} else { // check for either new or edit.

		return in_array( $pagenow, array( 'post.php', 'post-new.php' ), true );

	}

}

/**
 * Add Mime Types
 *
 * @param array $mimes - the array with allowed mime types update.
 */
function itmix_svgs_upload_mimes( $mimes = array() ) {

	global $itmix_svgs_options;

	if ( empty( $itmix_svgs_options['restrict'] ) || current_user_can( 'administrator' ) ) {

		// allow SVG file upload.
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;

	} else {

		return $mimes;
	}
}
add_filter( 'upload_mimes', 'itmix_svgs_upload_mimes', 99 );


/**
 * Check Mime Types
 *
 * @param array  $checked - File mime type, or false if the file doesn't match a mime type.
 * @param string $file - Full path to the file.
 * @param sting  $filename - The name of the file (may differ from $file due to $file being in a tmp directory).
 * @param array  $mimes - Array of mime types keyed by their file extension regex.
 */
function itmix_svgs_upload_check( $checked, $file, $filename, $mimes ) {

	if ( ! $checked['type'] ) {

		$check_filetype  = wp_check_filetype( $filename, $mimes );
		$ext             = $check_filetype['ext'];
		$type            = $check_filetype['type'];
		$proper_filename = $filename;

		if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
			$ext  = false;
			$type = false;
		}

		$checked = compact( 'ext', 'type', 'proper_filename' );
	}

	return $checked;

}
add_filter( 'wp_check_filetype_and_ext', 'itmix_svgs_upload_check', 10, 4 );

/**
 * Proper SVG resposnse for JS
 *
 * @param array       $response   Array of prepared attachment data. @see wp_prepare_attachment_for_js().
 * @param WP_Post     $attachment Attachment object.
 * @param array|false $meta       Array of attachment meta data, or false if there is none.
 */
function itmix_svgs_response_for_svg( $response, $attachment, $meta ) {

	if ( 'image/svg+xml' === $response['mime'] && empty( $response['sizes'] ) ) {

		$svg_path = get_attached_file( $attachment->ID );

		if ( ! file_exists( $svg_path ) ) {
			// If SVG is external, use the URL instead of the path.
			$svg_path = $response['url'];
		}

		$dimensions = itmix_svgs_get_dimensions( $svg_path );

		$response['sizes'] = array(
			'full' => array(
				'url'         => $response['url'],
				'width'       => $dimensions->width,
				'height'      => $dimensions->height,
				'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait',
			),
		);

	}

	return $response;

}
add_filter( 'wp_prepare_attachment_for_js', 'itmix_svgs_response_for_svg', 10, 3 );

/**
 * Helper function to get SVG dimensions
 *
 * @comment Some additional comment here.
 *
 * @param url $svg The URL to the SVG file.
 *
 * @return object
 */
function itmix_svgs_get_dimensions( $svg ) {

	$svg = simplexml_load_file( $svg );

	if ( false === $svg ) {

		$width  = '0';
		$height = '0';

	} else {

		$attributes = $svg->attributes();
		$width      = (string) $attributes->width;
		$height     = (string) $attributes->height;

	}

	return (object) array(
		'width'  => $width,
		'height' => $height,
	);

}

/**
 * Generate attachment metadata (Thanks @surml)
 *
 * Fixes Illegal String Offset Warning for Height & Width
 *
 * @param array $metadata      An array of attachment meta data.
 * @param int   $attachment_id Current attachment ID.
 */
function itmix_svgs_generate_svg_attachment_metadata( $metadata, $attachment_id ) {

	$mime = get_post_mime_type( $attachment_id );

	if ( 'image/svg+xml' === $mime ) {

		$svg_path   = get_attached_file( $attachment_id );
		$upload_dir = wp_upload_dir();
		// get the path relative to /uploads/ - found no better way.
		$relative_path = str_replace( $upload_dir['basedir'], '', $svg_path );
		$filename      = basename( $svg_path );

		$dimensions = itmix_svgs_get_dimensions( $svg_path );

		$metadata = array(
			'width'  => intval( $dimensions->width ),
			'height' => intval( $dimensions->height ),
			'file'   => $relative_path,
		);

		// Might come in handy to create the sizes array too - But it's not needed for this workaround! Always links to original svg-file => Hey, it's a vector graphic!
		$sizes = array();
		foreach ( get_intermediate_image_sizes() as $s ) {
			$sizes[ $s ] = array(
				'width'  => '',
				'height' => '',
				'crop'   => false,
			);
			if ( isset( $_wp_additional_image_sizes[ $s ]['width'] ) ) {
				// For theme-added sizes.
				$sizes[ $s ]['width'] = intval( $_wp_additional_image_sizes[ $s ]['width'] );
			} else {
				// For default sizes set in options.
				$sizes[ $s ]['width'] = get_option( "{$s}_size_w" );
			}

			if ( isset( $_wp_additional_image_sizes[ $s ]['height'] ) ) {
				// For theme-added sizes.
				$sizes[ $s ]['height'] = intval( $_wp_additional_image_sizes[ $s ]['height'] );
			} else {
				// For default sizes set in options.
				$sizes[ $s ]['height'] = get_option( "{$s}_size_h" );
			}

			if ( isset( $_wp_additional_image_sizes[ $s ]['crop'] ) ) {
				// For theme-added sizes.
				$sizes[ $s ]['crop'] = intval( $_wp_additional_image_sizes[ $s ]['crop'] );
			} else {
				// For default sizes set in options.
				$sizes[ $s ]['crop'] = get_option( "{$s}_crop" );
			}

			$sizes[ $s ]['file']      = $filename;
			$sizes[ $s ]['mime-type'] = 'image/svg+xml';
		}
		$metadata['sizes'] = $sizes;
	}

	return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'itmix_svgs_generate_svg_attachment_metadata', 10, 3 );

/**
 * Add custom CSS for back-end proper output of SVG
 */
function itmix_fix_svg_thumb() {

	?>
	<style>
			.attachment svg, .widget_media_image svg {
				max-width: 100%;
				height: auto
			}
			body #set-post-thumbnail, body #postimagediv .inside img[src$=".svg"] {
				width: 100%
			}
			td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
				width: 100% !important;
				height: auto !important
			}
	</style>
	<?php
}
add_action( 'admin_head', 'itmix_fix_svg_thumb' );

/**
 * Add ability to preview SVG
 */
function itmix_svgs_display_thumbs() {

	if ( itmix_svgs_specific_pages_media_library() ) {

		/**
		 * SVG thumbnails filter.
		 *
		 * @param string $content The SVG content.
		 *
		 * @return mixed|null
		 */
		function itmix_svgs_thumbs_filter( $content ) {

			return apply_filters( 'itm_final_output', $content );

		}

		ob_start( 'itmix_svgs_thumbs_filter' );

		/**
		 * The SVG final output.
		 *
		 * @param string $content The content to replace the SVG.
		 *
		 * @return array|string|string[]
		 */
		function itmix_svgs_final_output( $content ) {

			$content = str_replace(
				'<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
				'<# } else if ( \'svg+xml\' === data.subtype ) { #>
					<img class="details-image" src="{{ data.url }}" draggable="false" />
					<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
				$content
			);

			$content = str_replace(
				'<# } else if ( \'image\' === data.type && data.sizes ) { #>',
				'<# } else if ( \'svg+xml\' === data.subtype ) { #>
					<div class="centered">
						<img src="{{ data.url }}" class="thumbnail" draggable="false" />
					</div>
					<# } else if ( \'image\' === data.type && data.sizes ) { #>',
				$content
			);

			return $content;

		}
		add_filter( 'itm_final_output', 'itmix_svgs_final_output' );
	}

}
add_action( 'admin_init', 'itmix_svgs_display_thumbs' );
