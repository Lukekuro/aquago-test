<?php
/**
 * Related posts template
 *
 * @package aquagoer
 */

$args  = array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post__not_in'   => [ get_the_ID() ],
);
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : ?>
	<section class="post-related">
		<h2 class="post-related__title"><?php esc_html_e( 'Podobne wpisy', 'aquago' ); ?></h2>
		<div class="row">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<div class="col-md-6 col-lg-4">
					<?php get_template_part( 'template-parts/article' ); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</section>
<?php endif;
wp_reset_postdata(); ?>
