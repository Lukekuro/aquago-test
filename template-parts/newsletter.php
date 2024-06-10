<?php
/**
 * Newsletter
 *
 * @package aquago
 */

$title_newsletter      = get_field( 'title_newsletter', 'option' );
$text_newsletter       = get_field( 'text_newsletter', 'option' );
$number_id_newsletter  = get_field( 'number_id_newsletter', 'option' );
$acceptance_newsletter = get_field( 'acceptance_newsletter', 'option' );
?>

<?php if ( $number_id_newsletter ) : ?>

	<div class="newsletter">
		<div class="container">
			<?php if ( $title_newsletter ) : ?>
				<h2><?php echo wp_kses_post( $title_newsletter ); ?></h2>
			<?php endif; ?>

			<?php if ( $text_newsletter ) : ?>
				<div class="editor">
					<p><?php echo wp_kses_post( $text_newsletter ); ?></p>
				</div>
			<?php endif; ?>
			
			<div class="newsletter-form">
				<?php echo do_shortcode( '[newsletter id="' . intval( $number_id_newsletter ) . '"]' ); ?>
				
				<?php if ( $acceptance_newsletter ) : ?>
					<div class="acceptance_newsletter d-none"><?php echo wp_kses_post( $acceptance_newsletter ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>

<?php endif; ?>

