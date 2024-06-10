<?php
/**
 * Gutenberg
 *
 * custom Gutenberg styles should be adjusted in theme.json
 * @link https://fullsiteediting.com/courses/full-site-editing-for-theme-developers/
 */

// Add support for Block Styles.
add_theme_support( 'wp-block-styles' );


// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'it_gutenberg_editor_assets' );
function it_gutenberg_editor_assets() {
	wp_enqueue_style( 'custom-gutenberg-editor-styles', get_theme_file_uri( '/dist/css/gutenberg-styles.css' ), false );
	wp_enqueue_script( 'custom-gutenberg-editor-scripts', get_theme_file_uri( '/dist/js/gutenberg.js' ), ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'] );
}

// Allow shortcodes in Gutenberg
add_filter( 'render_block', 'it_shortcodes_in_gutenberg', 99, 2 );
function it_shortcodes_in_gutenberg( $block_content, $block ) {
	return do_shortcode( $block_content );
}


// Register custom block category
add_filter( 'block_categories_all', 'builder_blocks', 10, 2 );
function builder_blocks( $categories, $post ) {
	$custom_block = array(
		'slug'  => 'builder-blocks',
		'title' => __( 'Custom Builder Blocks', 'aquago' ),
	);

	$categories_sorted    = array();
	$categories_sorted[0] = $custom_block;

	foreach ( $categories as $category ) {
		$categories_sorted[] = $category;
	}

	return $categories_sorted;
}

// Register custom blocks
add_action( 'init', 'it_register_custom_blocks' );
function it_register_custom_blocks() {
	$sub_dirs = glob( ITM_DIR . '/blocks/*', GLOB_ONLYDIR );
	if ( $sub_dirs ) {
		foreach ( $sub_dirs as $sub_dir ) {
			if ( file_exists( $sub_dir . '/block.json' ) ) {
				register_block_type( $sub_dir );
			}
		}
	}
}

// Add our custom SVG sprite into the page in admin
function it_custom_admin_svgs() {
	get_template_part( 'template-parts/svg' );
}
add_action('admin_footer', 'it_custom_admin_svgs');
