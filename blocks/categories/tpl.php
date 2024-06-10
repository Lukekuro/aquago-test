<?php
/**
 * categories Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-categories-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-categories c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

$list = get_field( 'list' );
if ( ! $list ) {
	$args  = [
		'post_type'      => 'product', //get type edit1
		'posts_per_page' => 10,
		'order'          => 'ASC',
	];
	$query = new WP_Query( $args );
	if ( $query->posts ) {
		$list = $query->posts;
	}
}

if ( $list ) {
	$get_terms_args  = [
		'taxonomy'      => 'product_cat',
		'hide_empty'	=> 0,
		'include' 		=> $list,
	];
}

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>

	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/categories.jpg" alt="Preview">
	</figure>

<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<?php get_template_part( 'template-parts/components/inner-text', null, [ 'heading' => 'h2' ] ); ?>
				</div>
			</div>

			<?php $terms = get_terms( $get_terms_args ); ?>
			<?php if ( $terms ) : ?>
				<div class="list">
					<?php $i = 50; foreach ( $terms as $term ) :
						$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						?>
						
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" data-aos="fade-up" data-aos-delay="<?php echo $i; ?>" data-aos-duration="700">
							<?php if ( $image ) : ?>
								<div class="img c-image">
									<img class="img-cover" src="<?php echo $image; ?>" alt="<?php echo $term->name; ?>">
								</div>
							<?php endif; ?>

							<span class="fw-700"><?php echo wp_kses_post( $term->name ); ?></span>
						</a>
					<?php $i += 50; endforeach; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>

		</div>
	</section>
	
<?php endif; ?>
