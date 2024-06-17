<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aquago
 */

$logo            = get_field( 'logo', 'option' );
$enable_to_top   = get_field( 'enable_to_top', 'option' );
$copyright       = get_field( 'copyright', 'option' );
$number_phone    = get_field( 'number_phone', 'option' );
$contact_email   = get_field( 'contact_email', 'option' );
$top_text_footer = get_field( 'top_text_footer', 'option' );
$info_footer     = get_field( 'info_footer', 'option' );
?>

</main><!-- /.site-content -->

<footer class="site-footer">
	<svg class="footer-vector"><use xlink:href="#footer-vector"></use></svg>

	<?php if ( $top_text_footer || $contact_email || $number_phone ) : ?>

		<div class="site-footer__top">
			<div class="container">
				<div class="block">
					<?php if ( $top_text_footer ) : ?>
						<span class="h2 mb-0 text-center">
							<?php echo wp_kses_post( $top_text_footer ); ?>
						</span>
					<?php endif; ?>

					<div class="links">
						<?php if ( $contact_email ) : ?>
							<a href="mailto:<?php echo esc_html( $contact_email ); ?>" class="h4 mb-0 contact-email a-white-to-secondary-color">
								<?php echo wp_kses_post( $contact_email ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $number_phone ) : ?>
							<a href="tel:<?php echo itm_phone_cleaner( $number_phone ); ?>" class="h4 mb-0 number_phone a-white-to-secondary-color" rel="phone">
								<?php echo sprintf( "+ %s", $number_phone); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="container">

		<div class="site-footer__middle">
			<div class="logo-info">
				<?php if ( $logo ) : ?>
					<a href="<?php echo esc_url( home_url() ); ?>" class="site-logo" rel="home">
						<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
					</a>
				<?php endif; ?>
	
				<?php if ( $info_footer ) : ?>
					<div class="info editor">
						<?php echo wp_kses_post( $info_footer ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php wp_nav_menu( array(
				'theme_location'  => 'footer-menu',
				'container_class' => 'footer-links__container',
				'menu_class'      => 'footer-links sub-menu',
				'depth'           => 1,
				'fallback_cb'     => false
			) ); ?>

			<?php if ( have_rows( 'list_footer', 'option' ) ) : ?>
				<div class="list">
					<?php while ( have_rows( 'list_footer', 'option' ) ) : 
						the_row();
						$icon = get_sub_field( 'icon' );
						$link = get_sub_field( 'link' ); ?>

						<?php if ( $link ) : ?>
							<a class="a-white-to-secondary-color fw-700" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
								<?php if ( $icon ) : ?>
									<?php echo wp_get_attachment_image( $icon, 'thumbnail' ); ?>
								<?php endif; ?>

								<div class="title-arrow">
									<span><?php echo esc_html( $link['title'] ); ?></span>
									<svg><use xlink:href="#arrow-right"></use></svg>
								</div>
							</a>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="site-footer__bottom">

			<?php wp_nav_menu( array(
				'theme_location'  => 'footer-conditions',
				'container_class' => 'footer-links__container',
				'menu_class'      => 'footer-links sub-menu',
				'depth'           => 1,
				'fallback_cb'     => false	
			) ); ?> 

			<?php if ( $copyright ) : ?>
				<span class="copyright"><?php echo sprintf( '%s &copy; %s %s', $copyright, esc_html( date( 'Y' ) ), get_option('blogname') ); // @phpcs:disable ?></span>
			<?php endif; ?>

			<div class="realizations">
				<span><?php esc_html_e( 'Realizacja', 'aquago' ) ?></span>

				<div class="images">
					<img src="<?php echo ITM_IMG . 'logo-webcrafters.svg'; ?>" alt="logo-webcrafters">
					<img src="<?php echo ITM_IMG . 'logo-adeverest.svg'; ?>" alt="logo-adeverest">
				</div>
			</div>
				
		</div>
	</div>

</footer>

<?php get_template_part( 'template-parts/svg' ); ?>

<?php if ( $enable_to_top && ! is_404() ) : ?>
	<a id="to-top" href="#top">
		<svg>
			<use xlink:href="#angle-up"></use>
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Przewiń na górę', 'aquago' ); ?></span>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
