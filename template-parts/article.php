<?php
/**
 * Article template part
 *
 * @package aquagoer
 */

?>
<article class="article">
	<a class="article__thumbnail" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large', [ 'class' => 'img-cover' ] ); ?>
		<?php else : ?>
			<?php itm_image_placeholder(); ?>
		<?php endif; ?>
	</a>
	<div class="article__content">
		<div class="entry-meta">
			<?php itm_posted_on(); ?> <?php itm_posted_by(); ?>
			<?php itm_cat_links(); ?>
			<?php itm_tag_links(); ?>
		</div>
		<h3 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="article__excerpt"><?php itm_excerpt( 15 ); ?></div>
		<a class="btn btn-primary article__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Więcej', 'aquago' ); ?></a>
	</div>
</article>
