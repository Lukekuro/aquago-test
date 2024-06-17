<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aquago
 */

get_header();
the_post();
?>

	<div class="container">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( '1536x1536' ); ?>
			</div>
		<?php endif; ?>

		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">

				<header class="post-header">
					<h1 class="post-title"><?php the_title(); ?></h1>
					<div class="entry-meta">
						<?php 
							itm_posted_on(); 
							itm_posted_by();
							itm_cat_links(); itm_tag_links(); 
						?>

						<!-- // Display category edit1 -->
						<?php 
							$taxonomy_prefix = 'category';
							$terms_categories = get_the_category( $post->ID );
						?>

						<?php if ( $terms_categories ) : ?>
							<div class="categories">
								<?php foreach ( $terms_categories as $cat ) : ?>
									<span class="item-cat color-<?php echo get_field( 'color_cat', $taxonomy_prefix .'_'.  $cat->term_id); ?>"><?php echo esc_html( $cat->name ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<!-- // END category edit1 -->

					</div>
				</header>

				<div class="entry-content">
					<?php the_content();?>


					<!-- // Share edit1 -->
					<div class="share">
						<h4><?php esc_html_e( 'Nie zapomnij udostępnić', 'aquago' ); ?></h4>

						<?php 
							$get_title = get_the_title();
							$get_author = get_the_author();
							$get_short_content = wp_trim_words( get_the_content(), 1000 );
							$get_url = get_the_permalink();
						?>

						<div class="share-list">
							<a class="icon-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $get_url ); ?>" target="_blank">
								<svg><use xlink:href="#facebook"></use></svg>
							</a>
							<a class="icon-tw" href="<?php echo sprintf( 'https://twitter.com/intent/tweet?url=%s&text=%s&via=%s', esc_url( $get_url ), $get_short_content, $get_author ); ?>" target="_blank">
								<svg><use xlink:href="#twitter-x"></use></svg>
							</a>

							<a class="icon-ld" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( $get_url ); ?>" target="_blank">
								<svg><use xlink:href="#linkedin"></use></svg>
							</a>
							
							<a class="icon-mail" href="<?php echo 'mailto:?subject=' . $get_title . '&body=' . $get_short_content . '%20' . esc_url( $get_url ) . ''; ?>">
								<svg><use xlink:href="#mail"></use></svg>
							</a>
						</div>
					</div>
					<!-- // END edit1 -->

					

					<?php 
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aquago' ),
							'after'  => '</div>',
						)
					);
					?>

					<?php
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'aquago' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'aquago' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>

			</div>
		</div>

		<?php get_template_part( 'template-parts/post-related' ); ?>
	</div>

<?php
get_footer();
