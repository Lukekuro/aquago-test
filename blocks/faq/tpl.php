<?php
/**
 * Block template file: blocks/faq/tpl.php
 *
 * FAQ Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'b-faq-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'b-faq c-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}

?>

<?php // Block preview
if ( ! empty( $block['data']['preview_image'] ) ) : ?>
	<figure>
		<img src="<?php echo ITM_IMG; ?>/blocks/faq.jpg" alt="Preview">
	</figure>
<?php else : ?>

	<?php if ( have_rows( 'list' ) ) : ?>
		<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
			<div class="container">
				<div class="js-accordion">
					<?php 
					$faq = []; 

					while ( have_rows( 'list' ) ) :
						the_row();
						$question = get_sub_field( 'question' );
						$answer   = get_sub_field( 'answer' );

						if ( $question && $answer ) {

							$faq[] = [
								'@type'          => 'Question',
								'name'           => wp_strip_all_tags( $question ),
								'acceptedAnswer' => [
									'@type' => 'Answer',
									'text'  => wp_strip_all_tags( $answer ),
								],
							]
							?>
							<div class="js-accordion-item b-faq__item">
								<div class="h5 js-accordion-title b-faq__item-title"><span><?php echo esc_html( wp_strip_all_tags( $question ) ); ?></span>
									<svg width="21" height="21">
										<use xlink:href="#angle-down"></use>
									</svg>
								</div>
								<div class="js-accordion-content b-faq__item-content">
									<div class="editor"><?php echo wp_kses_post( $answer ); ?></div>
								</div>
							</div>
						<?php } ?>

					<?php endwhile; ?>

					<script type="application/ld+json">
						{
							"@context": "https://schema.org",
							"@type": "FAQPage",
							"mainEntity": <?php echo wp_json_encode( $faq, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ); ?>
						}
					</script>
				</div>
			</div>
		</section>

	<?php endif; ?>

<?php endif; ?>