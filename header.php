<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _it_start
 */

$logo     	   = get_field( 'logo', 'option' );
$number_phone  = get_field( 'number_phone', 'option' );
$contact_email = get_field( 'contact_email', 'option' );
$text_in_btn   = get_field( 'text_in_btn_header', 'option' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- //favicon -->


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="top">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_it_start' ); ?></a>

<header class="site-header">

	<div class="top-header">
		<div class="container">

			<?php if ( have_rows( 'top_list_header', 'option' ) ) : ?>
				<div class="top-header__left">

					<?php while ( have_rows( 'top_list_header', 'option' ) ) : 
						the_row(); 
						$text = get_sub_field( 'text' );
						?>

						<?php if ( $text ) : ?>
							<span>
								<?php echo wp_kses_post( $text ); ?>
							</span>
						<?php endif; ?>
					<?php endwhile; ?>
					
				</div>
			<?php endif; ?>

			<div class="top-header__right">
				<!-- edit1 - WPML -->
				<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
					<?php dynamic_sidebar( 'language-switcher' ); ?>
				<?php endif; ?>
				<!-- edit1 - END WPML -->

				<?php if ( $contact_email ) : ?>
					<a href="mailto:<?php echo esc_html( $contact_email ); ?>" class="contact-email text-v-sm visible-md-up" rel="phone">
						<?php echo wp_kses_post( $contact_email ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="bottom-header">
		<div class="container">

			<?php if ( $logo ) : ?>
				<a href="<?php echo esc_url( home_url() ); ?>" class="site-logo" rel="home">
					<?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
					<!-- <svg><use xlink:href="#"></use></svg> -->
				</a>
			<?php endif; ?>

			<div class="bottom-header__right">
				<nav class="main-nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'main',
							'container_class' => 'main-menu__container',
							'menu_class'      => 'main-menu',
							'depth'           => 2,
							'fallback_cb'     => false,
						)
					);
					?>
	
					<?php if ( $number_phone ) : ?>
						<a href="tel:<?php echo itm_phone_cleaner( $number_phone ); ?>" class="number-phone btn btn-secondary" rel="phone"> <!-- //hidden-md-up -->
							<svg><use xlink:href="#phone"></use></svg>

							<div class="number-phone__block">
								<?php if ( $text_in_btn ) : ?>
									<span class="text-v-sm fw-400">
										<?php echo wp_kses_post( $text_in_btn ); ?>
									</span>
								<?php endif; ?>
								<?php echo sprintf( "+ %s", $number_phone); ?>
							</div>
						</a>
					<?php endif; ?>
				</nav>
				
	
				<!-- <?php if ( $number_phone ) : ?>
					<a href="tel:<?php echo itm_phone_cleaner( $number_phone ); ?>" class="number_phone visible-md-up" rel="phone">
						<svg><use xlink:href="#phone"></use></svg>
						<?php echo sprintf( "+ %s", $number_phone); ?>
					</a>
				<?php endif; ?> -->
			</div>


			<span class="icon-burger" aria-label="<?php esc_html_e( 'Toggle navigation', '_it_start' ); ?>"><i></i></span>
		</div>
	</div>

</header>

<div class="site-header_bottom">
	<div class="search">
		<div class="search__items">
			<span class="text-v-sm"><?php esc_html_e( 'Czego szukasz?', 'aquago' ); ?></span>
			<svg class="icon-search"><use xlink:href="#search"></use></svg>
		</div>
		<?php get_search_form(); ?>
	</div>

	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<a class="user-account" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>">
			<svg><use xlink:href="#user"></use></svg>
		</a>

		<?php $count = WC()->cart->get_cart_contents_count(); ?>
		<div class="mini-cart <?php echo ( 0 === $count ) ? 'mini-cart--empty' : ''; ?>">
			<svg>
				<use xlink:href="#cart"></use>
			</svg>
			<?php if ( 0 !== $count ) : ?>
				<span class="mini-cart__total"><?php echo esc_html( $count ); ?></span>
				<div class="arrow"></div>
				<div class="cart-caption">
					<div class="cart-caption__list">
						<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$get_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id  = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );?>
							
							<div class="cart-caption__item">
								<?php if ( $get_product && $get_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $get_product->is_visible() ? $get_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );?>

									<?php
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $get_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="product-title" href="%s">%s</a>', esc_url( $product_permalink ), $get_product->get_name() ), $cart_item, $cart_item_key ) );
										}
									?>
									<div class="cart-caption__block">
										<span class="product-price">
											<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $get_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
										</span>

										<div class="product-remove">
											<?php
											echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
														<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg"><path d="M15.187 2.813A8.75 8.75 0 102.813 15.189 8.75 8.75 0 0015.187 2.813zm-3.867 9.17c-.06.061-.16.061-.22 0L9 9.884l-2.1 2.1c-.06.06-.16.06-.22 0l-.663-.664a.157.157 0 010-.22l2.1-2.1-2.1-2.1a.157.157 0 010-.22l.663-.663c.06-.06.16-.06.22 0l2.1 2.1 2.1-2.1c.06-.06.16-.06.22 0l.663.663c.06.06.06.16 0 .22L9.883 9l2.1 2.1c.06.06.06.16 0 .22l-.663.663z"/></svg>
													</a>',
													esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
													esc_html__( 'Remove this item', 'woocommerce' ),
													esc_attr( $product_id ),
													esc_attr( $get_product->get_sku() )
												),
												$cart_item_key
											);
											?>
										</div>
									</div>
								<?php } ?>
								
							</div>
						<?php } ?>

						<div class="text-center">
							<a href="<?php echo wc_get_cart_url(); ?>" class="btn btn-secondary"><?php esc_html_e( 'Do koszyka', 'aquago' ); ?></a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<main class="site-content" id="content">
	
<?php if ( !is_front_page() ) : ?>
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php endif; ?>