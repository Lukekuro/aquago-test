<?php
/**
 * form Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-form-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-form c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

$location = get_field( 'location' ); 
$info     = get_field( 'info' ); 
$form     = get_field( 'form' );

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>

	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/form.jpg" alt="Preview">
	</figure>

<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
		<div class="container">
			
			<?php if ( $location && $info ) : ?>
				<div class="b-form__map">
					<!-- // IF google maps -->
					<div class="marker" data-marker="<?php echo $marker; ?>" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>"></div>
					<?php //get_template_part( 'template-parts/map' ); ?>

					<!-- //ELSE image map -->
					<?php //if ( $map ) : ?>
						<?php //echo wp_get_attachment_image( $map, 'large' ); ?>
					<?php //endif; ?>
					<!-- //END -->

					<div class="b-form__map__info">
						<?php echo wp_kses_post( $info ); ?>
					</div>
				</div>
			
			<?php endif; ?>

			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-9">
					<?php get_template_part( 'template-parts/components/inner-text', null, [ 'heading' => 'h2' ] ); ?>

					<?php if ( $form ) : ?>
						<div class="form">
							<?php echo do_shortcode( '[contact-form-7 id="' . intval( $form ) . '"]' ) ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</section>
	
<?php endif; ?>
