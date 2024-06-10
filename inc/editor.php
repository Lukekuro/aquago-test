<?php
/**
 * Editor modification
 *
 * @link https://codex.wordpress.org/TinyMCE_Custom_Styles
 *
 * @package aquago
 */

/**
 * Registers an editor stylesheet for the theme.
 */
function itm_wpdocs_theme_add_editor_styles() {
	add_editor_style( ITM_CSS . 'editor-styles.css' );
}
add_action( 'admin_init', 'itm_wpdocs_theme_add_editor_styles' );

/**
 * Add TinyMCE style formats.
 *
 * @param array $styles - array of the styles URLs.
 */
function itm_tiny_mce_style_formats( $styles ) {
	array_unshift( $styles, 'styleselect' );

	return $styles;
}
add_filter( 'mce_buttons_2', 'itm_tiny_mce_style_formats' );

/**
 * Tiny MCE formats setup.
 *
 * @param array $settings - The array of the formats.
 *
 * @return mixed
 */
function itm_tiny_mce_before_init_formats( $settings ) {
	// Define the style_formats array.
	$style_formats = [
		[
			'title' => 'Tytuł',
			'items' => [
				[
					'title'    => 'H1',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h1',
				],
				[
					'title'    => 'H2',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h2',
				],
				[
					'title'    => 'H3',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h3',
				],
				[
					'title'    => 'H4',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h4',
				],
				[
					'title'    => 'H5',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h5',
				],
				[
					'title'    => 'H6',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'h6',
				],
			],
		],
		[
			'title' => 'Tekst',
			'items' => [
				[
					'title'    => 'Tekst (duży)',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'text-lg',
				],
				[
					'title'    => 'Tekst (średni)',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'text-md',
				],
				[
					'title'    => 'Tekst (mały)',
					'selector' => 'p,h1,h2,h3,h4,h5,h6',
					'classes'  => 'text-sm',
				],
			],
		],
		[
			'title' => 'Przycisk',
			'items' => [
				[
					'title'    => 'Przycisk (główny)',
					'selector' => 'a',
					'classes'  => 'btn',
					'wrapper'  => false,
				],
				[
					'title'    => 'Przycisk (zarys)',
					'selector' => 'a',
					'classes'  => 'btn btn-outline',
					'wrapper'  => false,
				],
				[
					'title'    => 'Przycisk Grupowy',
					'classes'  => 'btn-group', // custom admin styles for this class added in editor-style.scss.
					'selector' => 'p',
				],
			],
		],
		[
			'title' => 'Lista',
			'items' => [
				[
					'title'    => 'List (sprawdzony)',
					'classes'  => 'list-check',
					'selector' => 'ul',
					'wrapper'  => false,
				],
				[
					'title'    => 'List (kropkowany)',
					'classes'  => 'list-dot',
					'selector' => 'ul',
					'wrapper'  => false,
				],
				[
					'title'    => 'List (numerowane)',
					'classes'  => 'list-number',
					'selector' => 'ol',
					'wrapper'  => false,
				],
			],
		],
		[
			'title' => 'Grubość',
			'items' => [
				[
					'title'    => '300',
					'selector' => 'p,h1,h2,h3,h4,h5,h6,a,li',
					'classes'  => 'fw-300',
					'wrapper'  => false,
				],
				[
					'title'    => '400',
					'selector' => 'p,h1,h2,h3,h4,h5,h6,a,li',
					'classes'  => 'fw-400',
					'wrapper'  => false,
				],
				[
					'title'    => '500',
					'selector' => 'p,h1,h2,h3,h4,h5,h6,a,li',
					'classes'  => 'fw-500',
					'wrapper'  => false,
				],
				[
					'title'    => '600',
					'selector' => 'p,h1,h2,h3,h4,h5,h6,a,li',
					'classes'  => 'fw-600',
					'wrapper'  => false,
				],
				[
					'title'    => '700',
					'selector' => 'p,h1,h2,h3,h4,h5,h6,a,li',
					'classes'  => 'fw-700',
					'wrapper'  => false,
				],
			],
		],
	];

	if ( isset( $settings['style_formats'] ) ) {
		$orig_style_formats = json_decode( $settings['style_formats'], true );
		$style_formats      = array_merge( $orig_style_formats, $style_formats );
	}

	$settings['style_formats'] = wp_json_encode( $style_formats );

	return $settings;
}
add_filter( 'tiny_mce_before_init', 'itm_tiny_mce_before_init_formats' );

/**
 * Add custom colors to TinyMCE editor text color selector
 *
 * @param array $init - init colors list.
 *
 * @return array $init
 */
function itm_tiny_mce_before_init_colors( $init ) {
	// By using the same array keys as the default values you'll override (replace) them.
	$custom_colors = [
		'Czarne'    => '000',
		'Białe'     => 'fff',
		'Szare'     => 'ccc',
		'Pierwotny' => 'b91c1c',
	];

	$textcolor_map = [];
	foreach ( $custom_colors as $name => $color ) {
		$textcolor_map[] = "\"$color\", \"$name\"";
	}

	if ( ! empty( $textcolor_map ) ) {
		$init['textcolor_map']  = '[' . implode( ', ', $textcolor_map ) . ']';
		$init['textcolor_rows'] = 6; // expand color grid to 6 rows.
	}

	return $init;
}
add_filter( 'tiny_mce_before_init', 'itm_tiny_mce_before_init_colors' );
