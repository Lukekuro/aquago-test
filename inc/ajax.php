<?php
/**
 * AJAX functions
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_ajax_action/
 *
 * @package aquagoer
 */

// @codingStandardsIgnoreStart

// add_action( 'wp_ajax_it_custom_action', 'it_custom_action' );
// add_action( 'wp_ajax_nopriv_it_custom_action', 'it_custom_action' );
// function it_custom_action() {
// 	wp_die();
// }
// @codingStandardsIgnoreEnd


// add_action( 'wp_ajax_load_posts_by_cat', 'load_posts_by_cat' );
// add_action( 'wp_ajax_nopriv_load_posts_by_cat', 'load_posts_by_cat' );
function load_posts_by_cat() {

	if ( isset( $_POST['term_id'] ) ) {
		$term_id  = (int) $_POST['term_id'];
	} else {
		$term_id = get_all_category_ids();
	}

	$args_posts = array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'tax_query' => array(
			array (
				'taxonomy' => 'category',
				'terms' => $term_id,
			)
		),
	);
	$wp_query_posts = new WP_Query( $args_posts );
	if ( $wp_query_posts->have_posts() ):
	?>
		<div class="posts">
			<div class="row">
				<?php
				while ( $wp_query_posts->have_posts() ) :
					$wp_query_posts->the_post();
					?>

					<div class="col-md-6 col-lg-4">
						<?php get_template_part( 'template-parts/article' ); ?>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			
		</div>

	<?php endif; ?>

	<?php
	wp_die();
}


// add_action( 'wp_ajax_load_products_by_cat', 'load_products_by_cat' );
// add_action( 'wp_ajax_nopriv_load_products_by_cat', 'load_products_by_cat' );
function load_products_by_cat() {
	$term_id  = isset( $_POST['term_id'] ) ? (int) $_POST['term_id'] : null;

	$args_product = array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'order'          => 'ASC',
		'tax_query' => array(
			array (
				'taxonomy' => 'product_cat',
				'terms' => $term_id,
			)
		),
	);
	$wp_query_product = new WP_Query( $args_product );
	if ( $wp_query_product->have_posts() ):
	?>
		<div class="posts">
			<div class="row">
				<?php
				while ( $wp_query_product->have_posts() ) :
					$wp_query_product->the_post();
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>

	<?php endif; ?>


	<?php
	wp_die();
}


/**
 * Change to display products in archive products //edit1 for replace display products
 */
// add_action( 'wp_ajax_load_display_products', 'load_display_products' );
// add_action( 'wp_ajax_nopriv_load_display_products', 'load_display_products' );

function load_display_products() {
    $value = isset( $_POST['value'] ) ? (int)$_POST['value'] : null;

    if ( $value ) {
        // Set a transient to store the selected value
        set_transient( 'custom_display_value', $value );
    }

    wp_die();
}

/**
 *  Modify the number of products to display based on the transient value
 */ 
// add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page' );
function new_loop_shop_per_page( $products ) {
    $custom_display_value = get_transient( 'custom_display_value' );

    if ( $custom_display_value ) {
        $products = $custom_display_value;
    }

    return $products;
}
