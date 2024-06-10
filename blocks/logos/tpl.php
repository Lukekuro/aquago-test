<?php
/**
 * Block template file: blocks/logos/tpl.php
 *
 * Logos Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-logos-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-logos c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>
	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/logos.jpg" alt="Preview">
	</figure>
<?php else : ?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" data-aos="fade-up" data-aos-delay="300" data-aos-duration="700">

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<?php get_template_part( 'template-parts/components/inner-text', null, [ 'heading' => 'h2' ] ); ?>
				</div>
			</div>
		</div>
			
		<?php if ( have_rows( 'list' ) ) : ?>
			<div class="main-list swiper swiper-logos">
				<div class="list swiper-wrapper">
					<?php while ( have_rows( 'list' ) ) : the_row(); 
						$image = get_sub_field( 'image' ); 
						$url   = get_sub_field( 'url' );
						?>
						
						<?php if ( $image ) : ?>
							<?php if ( false === strpos( $url, '#' ) && '' !== $url ) : ?>
								<a class="list__item swiper-slide" href="<?php echo $url; ?>" target="_blank">
									<?php echo wp_get_attachment_image( $image, 'large' ); ?>
								</a>
							<?php else: ?>
								<div class="list__item swiper-slide">
									<?php echo wp_get_attachment_image( $image, 'large' ); ?>
								</div>
							<?php endif; ?>

						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
	</section>

<?php endif; ?>