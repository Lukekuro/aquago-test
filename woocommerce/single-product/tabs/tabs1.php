<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<!-- //edti1  accordion tabs -->
	<div class="col-12 col-lg-6">
		<div class="woocommerce-tabs js-accordion">
			<?php foreach ( $product_tabs as $key => $product_tab ) :
				if ( isset( $product_tab['callback'] ) ) : ?>

					<div class="js-accordion-item">
						<div class="js-accordion-title">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
							
							<svg width="16" height="8">
								<use xlink:href="#angle-down-light"></use>
							</svg>
						</div>

						<div class="js-accordion-content">
							<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
						</div>
					</div>

				<?php endif; ?>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>
	</div>

<?php endif; ?>
