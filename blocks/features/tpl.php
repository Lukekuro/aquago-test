<?php
/**
 * Features Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-features-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-features c-block--padding';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

?>


<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>

	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/features.jpg" alt="Preview">
	</figure>

<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<?php get_template_part( 'template-parts/components/inner-text', null, [ 'heading' => 'h2' ] ); ?>
				</div>
			</div>

			<?php if ( have_rows( 'list' ) ) : ?>
				<div class="b-features__list">

					<?php while ( have_rows( 'list' ) ) : 
						the_row(); 
						$image = get_sub_field( 'image' ); 
						$title = get_sub_field( 'title' );
						$text  = get_sub_field( 'text' );
						?>
						<div class="b-features__item d-flex-center">
							<?php if ( $image ) : ?>
								<span class="b-features__img d-flex-center">
									<?php echo wp_get_attachment_image( $image, 'medium' ); ?>
								</span>
							<?php endif; ?>

							<div class="b-features__content">
								<?php if ( $title ) : ?>
									<span class="text-md"><?php echo wp_kses_post( $title ); ?></span>
								<?php endif; ?>

								<?php if ( $text ) : ?>
									<p><?php echo wp_kses_post( $text ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
					
				</div>
			<?php endif; ?>

		</div>
	</section>
	
<?php endif; ?>
