<?php
$heading = isset($args['heading']) ? $args['heading'] : null; // possible values: 'h1'
$heading_level = 'h1' === $heading ? 1 : 2;

// Inner block:
$template = [
	[
		'core/heading',
		[ 'level' => $heading_level, 'placeholder' => 'Dodaj Tytuł' ]
	],
	[
		'core/paragraph',
		[ 'placeholder' => 'Dodaj treść i/lub przycisk' ]
	]
];
$allowed_blocks = [
	'core/heading',
	'core/paragraph',
	'core/buttons',
];
?>

<div class="inner-block-text editor">
	<InnerBlocks allowedBlocks="<?php echo esc_attr( wp_json_encode( $allowed_blocks ) ); ?>" template="<?php echo esc_attr( wp_json_encode( $template ) ); ?>" templateLock="false" />
</div>
