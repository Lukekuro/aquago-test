<?php
/**
 * Block template file: blocks/call_to_action/tpl.php
 *
 * Text Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-text-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-text c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

$text  = get_field( 'text' );
$width = get_field( 'width' );
?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>
	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/text.jpg" alt="Preview">
	</figure>
<?php else : ?>
	<?php if ( $text ) : ?>

		<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">

			<div class="container">
				<div class="editor<?php echo $width ? '' : ' medium-width'; ?>"><?php echo wp_kses_post( $text ); ?></div>
			</div>
			
		</section>

	<?php endif; ?>

<?php endif; ?>

