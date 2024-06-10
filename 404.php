<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package aquago
 */

get_header();
?>

<div class="container">

	<section class="not-found">
		<h1 class="h3 not-found__title"><?php esc_html_e( 'Strona nie znaleziona.', 'aquago' ); ?></h1>
		<p class="not-found__text"><?php esc_html_e( 'Przykro nam, strona, której szukasz nie istnieje.', 'aquago' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Strona główna', 'aquago' ); ?></a>
	</section>

</div>

<?php
get_footer();
