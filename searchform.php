<?php
/**
 * The template for displaying search forms
 *
 * @package aquagoer
 */

?>

<form role="search" method="get" class="woocommerce-product-search search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
   <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field search-form__input" placeholder="<?php echo esc_attr__( 'Wyszukaj produkt', 'aquago' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
   <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" class="woocommerce-product-search__submit <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?> search-form__submit">
		<svg class="icon-search"><use xlink:href="#search"></use></svg>
	</button>
   <input type="hidden" name="post_type" value="product" />
</form>
