<?php
/**
 * Output Yoast breadcrumbs if they are enabled, and it is not a homepage
 *
 * @package aquago
 */

if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) : ?>
	<div class="breadcrumbs">
		<div class="container">
			<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); ?>
		</div>
	</div>
<?php endif; ?>
