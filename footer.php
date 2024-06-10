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

$logo          = get_field( 'logo', 'option' );
$enable_to_top = get_field( 'enable_to_top', 'option' );
$copyright     = get_field( 'copyright', 'option' );
?>

</main><!-- /.site-content -->

<footer class="site-footer">
	<div class="container">
		<?php if ( $logo ) : ?>
			<a href="<?php echo esc_url( home_url() ); ?>" class="site-logo" rel="home">
				<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
			</a>
		<?php endif; ?>

		

		<!-- //if you have (title  + ul) in footer then use it - edit1 -->
		<div class="site-footer__block">
			<div class="site-footer__menus">

				<?php wp_nav_menu( array(
					'theme_location'  => 'footer-1',
					'items_wrap'      => '<div class="footer-menu"><span>' . wp_get_nav_menu_name( 'footer-1' ) . '</span><ul id="%1$s" class="%2$s">%3$s</ul></div>',
					'container_class' => 'footer-links__container',
					'menu_class'      => 'footer-links sub-menu',
					'depth'           => 1,
					'fallback_cb'     => false
				) ); ?>

				<?php wp_nav_menu( array(
					'theme_location'  => 'footer-2',
					'items_wrap'      => '<div class="footer-menu"><span>' . wp_get_nav_menu_name( 'footer-2' ) . '</span><ul id="%1$s" class="%2$s">%3$s</ul></div>',
					'container_class' => 'footer-links__container',
					'menu_class'      => 'footer-links sub-menu',
					'depth'           => 1,
					'fallback_cb'     => false	
				) ); ?> 
			</div>

			<!-- else -->
				<?php
				// wp_nav_menu(
				// 	array(
				// 		'theme_location'  => 'footer',
				// 		'container_class' => 'footer-links__container',
				// 		'menu_class'      => 'footer-links',
				// 		'fallback_cb'     => false,
				// 	)
				// );
				?>

			<!-- //end - edit1 -->

			<?php get_template_part( 'template-parts/socials' ); ?>
			<?php get_template_part( 'template-parts/conditions' ); ?>
		</div>

	</div>

	<?php if ( $copyright ) : ?>
		<div class="site-footer__copyright">
			<div class="container">
				<span><?php echo sprintf( '&copy; %s %s', esc_html( date( 'Y' ) ), $copyright ); // @phpcs:disable ?></span>
			</div>
		</div>
	<?php endif; ?>

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
