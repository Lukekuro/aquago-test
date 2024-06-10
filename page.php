<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aquago
 */

get_header();
the_post();
?>


<?php if ( has_blocks( $post->post_content ) ) {
	$blocks = parse_blocks( $post->post_content );

	foreach ( $blocks as $block ) :
		if ( isset( $block["blockName"] ) && is_string( $block["blockName"] ) && strpos( $block["blockName"], 'core' ) !== false ) :
			?>
			<div class="container">
				<?php
				if ( strpos( $block["blockName"], 'core/embed' ) !== false ) :
					echo apply_filters( 'the_content', render_block( $block ) );
				else :
					echo render_block( $block );
				endif;
				?>
			</div>
		<?php
		else :
			echo render_block( $block );
		endif;
	endforeach;
} else {
	?>
	<div class="container">
		<?php the_content(); ?>
	</div>
<?php
}?>

<?php
get_footer();
