<?php
/**
 * Text And Media Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-text-media-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className".
$classes = 'b-text-media';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

$order = get_field( 'order' ); // possible values: text_first, text_last
$image = get_field( 'image' );

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>
	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/text-and-media.jpg" alt="Preview">
	</figure>
<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
		<div class="container">

			<div class="row<?php echo 'text_last' === $order ? ' flex-lg-row-reverse' : ''; ?>">
				<div class="col-lg-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
					<?php get_template_part( 'template-parts/components/inner-text' ); ?>
				</div>

				<?php if ( $image ) : ?>
					<div class="col-lg-6" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
						<div class="b-text-media__image">
							<?php echo wp_get_attachment_image( $image, 'large' ); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</section>

<?php endif; ?>
