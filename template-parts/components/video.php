<?php
/**
 * Video component blocks part
 *
 * @package aquagoer
 */

$field_group = isset( $args['field_group'] ) ? $args['field_group'] : 'video';
$video_group = isset( get_sub_field( $field_group )['video_group'] ) ? get_sub_field( $field_group )['video_group'] : false;
?>
<?php if ( $video_group ) : ?>
	<?php
	$video_type   = $video_group['type']; // possible values: embed, file.
	$video_file   = $video_group['file'];
	$video_poster = $video_group['poster'];
	$video_embed  = $video_group['embed'];
	?>

	<?php if ( 'embed' === $video_type && $video_embed ) : ?>
		<?php // Admin backend handles safety. ?>
		<?php echo ( $video_embed ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<?php elseif ( 'file' === $video_type && $video_file ) : ?>

		<?php if ( $video_poster ) : ?>
			<a class="c-video" data-fancybox="video" href="<?php echo esc_url( $video_file ); ?>">
				<span class="c-video__poster">
					<?php echo wp_get_attachment_image( $video_poster, 'large', false, [ 'class' => 'img-cover' ] ); ?>
					<svg><use xlink:href="#play-circle"></use></svg>
				</span>
			</a>
		<?php else : ?>
			<video class="c-video" src="<?php echo esc_url( $video_file ); ?>" controls></video>
		<?php endif; ?>

	<?php endif; ?>
<?php endif; ?>
