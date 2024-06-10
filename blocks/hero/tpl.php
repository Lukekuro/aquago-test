<?php
/**
 * Block template file: blocks/hero/tpl.php
 *
 * Hero Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-hero-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}


// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-hero';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>

	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/hero.jpg" alt="Preview">
	</figure>

<?php else : ?>

	<?php
	$text             = get_field( 'text' );
	$bg_type          = get_field( 'background_type' ); // possible values: image, video, color.
	$bg_overlay_color = get_field( 'background_overlay_color' );
	$bg_image         = get_field( 'background_image' );
	$bg_video         = get_field( 'background_video' );
	$bg_color         = get_field( 'background_color' );
	$bg_color_html    = 'color' === $bg_type ? 'style="background-color: ' . $bg_color . '"' : '';

	?>
	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>"<?php echo $bg_color_html; ?>>
		<?php if ( 'image' === $bg_type && $bg_image ) : ?>
			<div class="b-hero__bg">
				<?php echo wp_get_attachment_image( $bg_image, 'full', false, [ 'class' => 'img-cover' ] ); ?>
			</div>
		<?php elseif ( 'video' === $bg_type && $bg_video ) : ?>
			<video class="b-hero__bg-video img-cover" src="<?php echo esc_url( $bg_video ); ?>" autoplay muted loop></video>
		<?php endif; ?>
		<?php if ( in_array( $bg_type, [ 'image', 'video' ], true ) && $bg_overlay_color ) : ?>
			<div class="b-hero__bg-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>"></div>
		<?php endif; ?>
		<div class="container">
			<div class="b-hero__content color-white">
				<div class="row">
					<div class="col-lg-8">
						<?php if ( $text ) : ?>
							<div class="editor"><?php echo wp_kses_post( $text ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>


	