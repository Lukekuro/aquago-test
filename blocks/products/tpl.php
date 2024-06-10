<?php
/**
 * products Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-products-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-products c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

// <!-- DISPLAY ONLY IMG PRODUCT -->

$list = get_field( 'list' );
if ( ! $list ) {
	$args  = [
		'post_type'      => 'product',
		'posts_per_page' => 10,
		'order'          => 'ASC',
	];
	$query = new WP_Query( $args );
	if ( $query->posts ) {
		$list = $query->posts;
	}
}
// <!--END --- DISPLAY ONLY IMG PRODUCT -->

// <!-- OR DISPLAY CONTENT PRODUCT -->
$list = get_field( 'list' );
$args  = [
	'post_type'      => 'product',
	'posts_per_page' => 10,
	'order'          => 'ASC',
];

if ( !empty( $list ) ) {
	$args['post__in'] = $list;
}

$new_query = new WP_Query( $args );
// <!-- END --- OR DISPLAY CONTENT PRODUCT -->

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>

	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/products.jpg" alt="Preview">
	</figure>

<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<?php get_template_part( 'template-parts/components/inner-text', null, [ 'heading' => 'h2' ] ); ?>
				</div>
			</div>
			
			
			<!-- DISPLAY ONLY IMG PRODUCT -->
			<?php if ( $list ) : ?>
				<div class="b-products__list c-list"> <!-- //edit1 - c-list -->
					<?php foreach ( $list as $post ) : ?>
						<?php setup_postdata ( $post ); ?>

						<a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
							<?php echo get_the_post_thumbnail( $post, 'medium'); ?>
						</a>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
			<!--END --- DISPLAY ONLY IMG PRODUCT -->

			<!-- OR DISPLAY CONTENT PRODUCT  + SWIPER-->
			<?php if ( $new_query->have_posts() ) : ?>
				<div class="swiper swiper-products">
					<div class="swiper-wrapper">

						<?php while ( $new_query->have_posts() ) : 
							$new_query->the_post();?>
							<div class="swiper-slide">
								<?php wc_get_template_part( 'content', 'product' ); ?>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div>
					<div class="swiper-button-prev visible-md-up">
						<svg>
							<use xlink:href="#angle-left"></use>
						</svg>
					</div>
					<div class="swiper-button-next visible-md-up">
						<svg>
							<use xlink:href="#angle-right"></use>
						</svg>
					</div>
				</div>
			<?php endif; ?>
			<!-- END --- OR DISPLAY CONTENT PRODUCT + SWIPER-->

			<!-- Redirect do page products -->
			<a class="c-a-arrow hidden-md-up" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
				<?php esc_html_e( 'Wszystkie produkty', 'mario' ); ?>
				<svg><use xlink:href="#angle-right"></use></svg>
			</a>
			<!-- END - Redirect do page products -->

		</div>
	</section>
	
<?php endif; ?>
