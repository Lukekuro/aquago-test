<?php
/**
 * Functions which will be called on after_setup_theme
 *
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 *
 * @package aquago
 */

if ( ! function_exists( 'itm_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function itm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on IT Starter, use a find and replace
		 * to change 'aquago' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'aquago', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Register new image presets
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_image_size/
		 */
		// @phpcs:disable // add_image_size('full-hd', 1920, 1080, true);     //example.

		/**
		 * This theme uses wp_nav_menu() in one location.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus(
			[
				'main'   => esc_html__( 'Main Nav', 'aquago' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'aquago' ),
				'footer-conditions' => esc_html__( 'Footer Conditions', 'aquago' ),
			]
		);


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			]
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'itm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function itm_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'itm_content_width', 1130 );
}
add_action( 'after_setup_theme', 'itm_content_width', 0 );

/**
 * Add page slug to <body> class
 *
 * @param array $classes - The body tag classes.
 * @link https://developer.wordpress.org/reference/functions/body_class/
 */
function itm_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}

	return $classes;
}
add_filter( 'body_class', 'itm_slug_body_class' );

/**
 * Changes Gravity Forms Ajax Spinner (next, back, submit) to a transparent image
 *
 * This allows us to target the css and create a pure css spinner or add different image instead.
 *
 * @param string $image_src - URL of the image.
 * @param int    $form - The form object.
 */
function itm_spinner_url( $image_src, $form ) {
	return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; // relative to your theme images folder.
}
add_filter( 'gform_ajax_spinner_url', 'itm_spinner_url', 10, 2 );

/**
 * Remove archive title prefix
 *
 * @param string $prefix - the archive title page prefix.
 */
function itm_archive_prefix( $prefix ) {
	$prefix = '';

	return $prefix;
}
add_filter( 'get_the_archive_title_prefix', 'itm_archive_prefix' );

/**
 * Limit post excerpt length
 *
 * @link https://developer.wordpress.org/reference/hooks/excerpt_length/
 */
add_filter(
	'excerpt_length',
	function ( $length ) {
		return 20;
	}
);

// This will add a filter on `excerpt_more` that returns an empty string.
add_filter( 'excerpt_more', '__return_empty_string' );
