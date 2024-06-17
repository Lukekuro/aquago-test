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
$classes = 'b-hero c-block';
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
		$dotted_bg          = get_field( 'dotted_bg' ); 
		$line_circle_bg     = get_field( 'line_circle_bg' );
		$white_green_circle = get_field( 'white-green_circle' );
		$enable_to_bottom   = get_field( 'enable_to_bottom' );
		$type_bg_color      = get_field( 'type_bg_color' );
		$text               = get_field( 'text' );
		$one_bg_color       = get_field( 'one_bg_color' );
		$two_bg_color       = get_field( 'two_bg_color' );
		$bg_image           = get_field( 'background_image' );

		if ( $type_bg_color && $one_bg_color && $two_bg_color ) {
			$bg_color_html =  'radial-gradient(circle at 75% 50%, ' . $one_bg_color . ' 0,' . $two_bg_color . ' 100%);';
		} elseif ( $one_bg_color ) {
			$bg_color_html =  $one_bg_color;
		}
	?>

	<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
		<div class="b-hero__overlay<?php echo $dotted_bg ? ' dotted_bg' : ''; ?>"<?php echo $bg_color_html ? ' style="background:' . $bg_color_html . '"' : ''; ?>>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-5 col-12">
						<div class="b-hero__content color-white">
							<?php if ( $text ) : ?>
								<div class="editor"><?php echo wp_kses_post( $text ); ?></div>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-7 col-12 text-right">
						<?php if ( $bg_image ) : ?>
							<div class="b-hero__image">
								<?php echo wp_get_attachment_image( $bg_image, 'full' ); ?>
								<div class="line_circle_bg<?php echo $line_circle_bg ? '' : ' d-none'; ?>">
									<span class="line_circle_bg__one-two"></span>
									<span class="line_circle_bg__three-four"></span>
								</div>
								
								<?php if ( $white_green_circle ) : ?>
									<span class="white_green_circle-top"></span>
									<span class="white_green_circle-bottom"></span>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<a href="" class="btn-next-section<?php echo $enable_to_bottom ? '' : ' d-none'; ?>">
			<svg><use xlink:href="#arrow-down"></use></svg>
		</a>
	</section>

<?php endif; ?>


	