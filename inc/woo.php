<?php
/**
 * Declares WooCommerce theme support.
 *
 * @link https://www.businessbloomer.com/category/woocommerce-tips/visual-hook-series/
 * @package aquago
 */

/**
 * Woocommerce support
 *
 * @return void
 */
function itm_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'after_setup_theme', 'itm_woocommerce_support' );

/**
 * Mini-cart update
 *
 * @param array $fragments - array of the HTML elements.
 */
function itm_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	$count = WC()->cart->get_cart_contents_count();
	?>
	<a class="mini-cart <?php echo ( 0 === $count ) ? 'mini-cart--empty' : ''; ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
		<svg>
			<use xlink:href="#cart"></use>
		</svg>
		<?php if ( 0 !== $count ) : ?>
			<span class="mini-cart__total"><?php echo esc_html( $count ); ?></span>
		<?php endif; ?>
	</a>
	<?php
	$fragments['a.mini-cart'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'itm_header_add_to_cart_fragment', 30, 1 );


/**
 * Remove WooCommerce breadcrumbs 
 */
function itm_remove_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'itm_remove_breadcrumbs' );

/**
 * INFO - if you want replace position from regular price to sale price (left to right) edit1
 */
/**
 * Swap "Regular price" and "Sale price"
 *
 * @since  3.0.0
 * @param  string $regular_price Regular price.
 * @param  string $sale_price    Sale price.
 * @return string $price Price.
 */
function itm_swap_sale_regular_price( $price, $regular_price, $sale_price )
{
    $price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins><del aria-hidden="true">' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';
    return $price;
}
// add_filter('woocommerce_format_sale_price', 'itm_swap_sale_regular_price', 10, 3);


/**
 * Append alt to image products
 */
function itm_change_attachment_image_attributes( $attr, $attachment ) {
    // Get post parent
    $parent_id = get_post_field( 'post_parent', $attachment );

    // Check if the parent post type is 'product'
    if ( $parent_id ) {
        $parent_type = get_post_field( 'post_type', $parent_id );
        
        if ( 'product' !== $parent_type ) {
            return $attr;
        }

        // Get title
        $title = get_post_field( 'post_title', $parent_id );
		if ( $title ) {
			$attr['alt'] = $title;
		}
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'itm_change_attachment_image_attributes', 20, 2);



///  - - - - - LOOP SHOP - - - - - /////
/**
 * Shop page
 */
function itm_shop_heading_start() {
	echo '<header class="shop-heading">';
}
add_action( 'woocommerce_before_shop_loop', 'itm_shop_heading_start', 17 );

/**
 * Shop heading end
 *
 * @return void
 */
function itm_shop_heading_end() {
	echo '</header>';
}
add_action( 'woocommerce_before_shop_loop', 'itm_shop_heading_end', 32 );

/**
 * Add loop product image wrapper
 */
function itm_template_loop_product_thumbnail_wrap_start() {
	echo '<div class="woocommerce-loop-product__thumbnail">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'itm_template_loop_product_thumbnail_wrap_start', 8 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5 );

/**
 * Add loop product image wrapper end
 *
 * @return void
 */
function itm_template_loop_product_thumbnail_wrap_end() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'itm_template_loop_product_thumbnail_wrap_end', 12 );

/**
 * Change loop product title tag
 */
function itm_change_products_title() {
	echo '<h3 class="h5 woocommerce-loop-product__title">' . get_the_title() . '</h3>';
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'itm_change_products_title', 10 );


/**
 * Replace text to percent on sale //edit1 - if you have to do replace text to precent
 */
function itm_custom_sale_flash() {
	global $product;

	$percentages = itm_cssigniter_woocommerce_get_product_sale_percentages( $product );

	$rounded_percentages = $percentages;
	$rounded_percentages = array_map( 'round', $percentages );
	$rounded_percentages = array_map( 'intval', $rounded_percentages );

	if ( ( empty( $percentages['min'] ) || empty( $percentages['max'] ) ) || ( $percentages['min'] === $percentages['max'] ) ) {
		/* translators: %1$d is a discount percentage. E.g. -60% */
		$label = sprintf( _x( '-%1$d%', 'product discount', 'aquago' ), max( $rounded_percentages ) );
	} else {
		/* translators: The whole string is a discount range. %1$d is the minimum discount percentage, %2$d is the maximum discount percentage. E.g. -10% / -60% */
		$label = sprintf( _x( '-%1$d% / -%2$d%', 'product discount', 'aquago' ), $rounded_percentages['min'], $rounded_percentages['max'] );
	}
    
	return '<span class="onsale">' . $label . '%</span>';  	
} 
add_filter('woocommerce_sale_flash', 'itm_custom_sale_flash');

/**
 * Function to get score of percent //edit1 - if you have to do replace text to precent
 */
function itm_cssigniter_woocommerce_get_product_sale_percentages( $product ) {
	$percentages = array(
		'min' => false,
		'max' => false,
	);

	switch ( $product->get_type() ) {
		case 'grouped':
			$children = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

			foreach ( $children as $child ) {
				if ( $child->is_purchasable() && ! $child->is_type( 'grouped' ) && $child->is_on_sale() ) {
					$child_percentage = itm_cssigniter_woocommerce_get_product_sale_percentages( $child );

					$percentages['min'] = false !== $percentages['min'] ? $percentages['min'] : $child_percentage['min'];
					$percentages['max'] = false !== $percentages['max'] ? $percentages['max'] : $child_percentage['max'];

					if ( $child_percentage['min'] < $percentages['min'] ) {
						$percentages['min'] = $child_percentage['min'];
					}

					if ( $child_percentage['max'] > $percentages['max'] ) {
						$percentages['max'] = $child_percentage['max'];
					}
				}
			}

			break;

		case 'variable':
			$prices = $product->get_variation_prices();

			foreach ( $prices['price'] as $variation_id => $price ) {
				$regular_price = (float) $prices['regular_price'][ $variation_id ];
				$sale_price    = (float) $prices['sale_price'][ $variation_id ];

				if ( $sale_price < $regular_price ) {
					$variation_percentage = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;

					$percentages['min'] = false !== $percentages['min'] ? $percentages['min'] : $variation_percentage;
					$percentages['max'] = false !== $percentages['max'] ? $percentages['max'] : $variation_percentage;

					if ( $variation_percentage < $percentages['min'] ) {
						$percentages['min'] = $variation_percentage;
					}

					if ( $variation_percentage > $percentages['max'] ) {
						$percentages['max'] = $variation_percentage;
					}
				}
			}
			break;

		case 'external':
		case 'variation':
		case 'simple':
		default:
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();

			if ( $sale_price < $regular_price ) {
				$percentages['max'] = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;
			}
	}

	return $percentages;
}

// Display the minimum price for variable products
add_filter('woocommerce_variable_sale_price_html', 'itm_custom_variable_product_price', 10, 2 );
add_filter('woocommerce_variable_price_html', 'itm_custom_variable_product_price', 10, 2 );

function itm_custom_variable_product_price( $price, $product ) {

	if ( is_product() ) {
        return $price; // Do nothing if not in the loop
    }

    // Check if it's a variable product
    if ( $product->is_type('variable') ) {
        // Get all variations for the product
        $variations = $product->get_available_variations();

		$unique_prices = array_unique( array_column( $variations, 'display_price' ) );

		if ( count( $unique_prices ) === 1 ) {
        	return $price; // Do nothing if not in the loop
		}

        // Loop through variations to find the minimum price
        $min_price = null;
        foreach ( $variations as $variation ) {
            $variation_price = floatval($variation['display_price']);

            // Set the initial minimum price or update it if a lower price is found
            if ( $min_price === null || $variation_price < $min_price ) {
                $min_price = $variation_price;
            }
        }

        // Display the minimum price
        if ( $min_price !== null ) {
            $price = 'od ' . wc_price( $min_price );
        }
    }

    return $price;
}
///  - - - - - END - LOOP SHOP - - - - - /////



///  - - - - - SINGLE PRODUCT - - - - - /////



/**
 * INFO - if you want add new tab or replace title from e.g. additional_information then to do.
 * more info - wc-remove-add-tabs-in-single-product
 */
/**
* Add a new custom product tabs
*
* @param string tabs - tabs.
*/
function itm_new_custom_product_tab( $tabs ) {

	if ( get_field( 'ingredients_single_product' ) ):
		$tabs['ingredients_single_product'] = array(
			'title'    => __( 'Składniki', 'woocommerce' ),
			'priority' => 10,
			'callback' => 'itm_ingredients_single_product_content'
		);
	endif;

	$tabs[ 'additional_information' ][ 'title' ] = 'Dodatkowe informacje'; //edit1 - replace title

	return $tabs;
}
// add_filter( 'woocommerce_product_tabs', 'itm_new_custom_product_tab' );

/**
 * INFO - If you have select variable as image then pick this // edit1
 * What you must to do?
 * 1. STYLE - SCSS -> 
 * 2. JQ -> woocommerce.js
 * 3. PHP -> woo.php (next to)
 */
/**
 * Add the price  to the dropdown options items.
 */
// add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'itm_show_price_in_attribute_dropdown', 10, 2);
function itm_show_price_in_attribute_dropdown( $html, $args ) {
    // Only if there is a unique variation attribute (one dropdown)
    if( sizeof($args['product']->get_variation_attributes()) == 1 ) :

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
    $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
    $class                 = $args['class'];

    if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[ $attribute ];
    }

	$term_variations = array();
	foreach ( $product->get_available_variations() as $variation ) {
		$attribute_value = reset( $variation['attributes'] );
		$image = $variation['image'];
		$image_url = $image['url'];
		$variation_id = $variation['variation_id'];
		$image_id = $variation['image_id'];

		$term_variations[] = array(
			'attribute_value'       => $attribute_value,
			'image_url'             => $image_url,
			'variation_id'          => $variation_id,
			'image_id'              => $image_id,
		);
	}

    $html = '<div id="' . esc_attr( $id ) . '" class="product__list-variables disabled ' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="yes">';

    if ( ! empty( $options ) ) {
        if ( $product && taxonomy_exists( $attribute ) ) {
            $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

            foreach ( $terms as $term ) {
                if ( in_array( $term->slug, $options ) ) {
					foreach ( $term_variations as $var ) {
						if ( $var['attribute_value'] === $term->slug ) {
							$html .= '<label><input value="' . esc_attr( $var['variation_id'] ) . '" data-img-id="' . esc_attr( $var['image_id'] ) . '" name="' . esc_attr( $attribute ) . '" type="radio" ' . checked( sanitize_title( $args['selected'] ), $term->slug, false ) . '/>';
							$html .= '<img src="' . esc_url( $var['image_url'] ) . '" alt="' . esc_attr($term->slug) . '" /></label>';
						}
					}
                }
            }
        } else {
            foreach ( $options as $option ) {
				foreach ( $term_variations as $var ) {
					if ( $img['attribute_value'] === $option ) {
						$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? checked( $args['selected'], sanitize_title( $option ), false ) : checked( $args['selected'], $option, false );
						$html .= '<label><input value="' . esc_attr( $var['variation_id'] ) . '" data-img-id="' . esc_attr( $var['image_id'] ) . '" name="' . esc_attr( $attribute ) . '" type="radio" ' . $selected . '/>';
						$html .= '<img src="' . esc_url( $var['image_url'] ) . '" alt="' . esc_attr( $option ) . '" /></label>';
					}
				}
            }
        }
    }
    $html .= '</div>';

    endif;

    return $html;
}

/**
 * INFO - if you have related with select variable as image then pick this //edit1
 */
/**
 * Replace price on variable products
 */
function itm_update_func_value() {
    global $product;

    if ( $product->is_type('variable') ) {
        $variations_data =[]; // Initializing

        // Loop through variations data
        foreach( $product->get_available_variations() as $variation ) {
			$variation_id = $variation['variation_id'];
			$variable_product = wc_get_product( $variation_id );
			$price = $variable_product->get_price_html();
			$sale_price = $variable_product->get_sale_price();
			$is_onsale = 'no';

			if ( !empty( $sale_price ) ) {
				$is_onsale = 'yes';
			}

			$variations_data[] = array(
				'variation_id'     => $variation_id,
				'price'            => $price,
				'is_onsale'        => $is_onsale,
			);
        }

        ?>
        <script>
			jQuery(function($) {
				var jsonData = <?php echo json_encode( $variations_data ); ?>,
				inputVID = 'input.variation_id';
				default_price = $( 'form .price' ),
				on_sale = $( '.woocommerce div.product .product__presentation span.onsale' ), //edit1 add class product__presentation in content-single-product.php where is onsale 
				product__list_variables_input = $( '.product__list-variables input' );
				on_sale.addClass( 'd-none' );

				product__list_variables_input.change( function() {
					var vid = $( this ).val(); // VARIATION ID

					// Loop through variation IDs / Data pairs
					$.each( jsonData, function( index, data ) {

						if ( data.variation_id == vid  ) {
							default_price.html( data.price );

							if ( 'no' === data.is_onsale ) {
								on_sale.addClass( 'd-none' );
							} else {
								on_sale.removeClass( 'd-none' );
							}
						}
					});
				});

				product__list_variables_input.each( function() {
					
					if ( this.checked  ) {
						var vid = $( this ).val(); // VARIATION ID

						// Loop through variation IDs / Data pairs
						$.each( jsonData, function( index, data ) {

							if ( data.variation_id == vid  ) {
								default_price.html( data.price );

								if ( 'yes' === data.is_onsale ) {
									on_sale.removeClass( 'd-none' );
								}
							}
						});
					}
				} );
			});
		</script>
        <?php
    }
}
// add_action( 'woocommerce_single_variation', 'itm_update_func_value' );

///  - - - - - END - SINGLE PRODUCT - - - - - /////




///  - - - - - CART - - - - - /////

/**
 * Add minus button before quantity
 */
function itm_display_quantity_minus() {
	echo '<button type="button" class="btn-qty btn-qty__minus"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 18 18"><path d="M9 .25a8.75 8.75 0 10.001 17.501A8.75 8.75 0 009 .25zm3.75 9.219c0 .086-.07.156-.156.156H5.406a.157.157 0 01-.156-.156V8.53c0-.086.07-.156.156-.156h7.188c.086 0 .156.07.156.156v.938z"/></svg></button>';
}
add_action( 'woocommerce_before_quantity_input_field', 'itm_display_quantity_minus' );

/**
 * Add plus button after quantity
 */
function itm_display_quantity_plus() {
	echo '<button type="button" class="btn-qty btn-qty__plus"><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 18 18"><path d="M9 .25a8.75 8.75 0 10.001 17.501A8.75 8.75 0 009 .25zm3.75 9.219c0 .086-.07.156-.156.156H9.625v2.969c0 .086-.07.156-.156.156H8.53a.157.157 0 01-.156-.156V9.625H5.406a.157.157 0 01-.156-.156V8.53c0-.086.07-.156.156-.156h2.969V5.406c0-.086.07-.156.156-.156h.938c.086 0 .156.07.156.156v2.969h2.969c.086 0 .156.07.156.156v.938z"/></svg></button>';
}
add_action( 'woocommerce_after_quantity_input_field', 'itm_display_quantity_plus', 100 );


///  - - - - - END - CART - - - - - /////


///  - - - - - ARCHIVE PRODUCT - - - - - /////

/**
 * Select count to display products in archive products
 */
function itm_select_to_display_products() {
	$products_per_page = wc_get_loop_prop( 'per_page' );

	if ( empty( $products_per_page ) ) {
		$products_per_page = 18;
	}
    ?>
		<div class="main-display-products">
			<select name="display-products" class="display-products">
				<?php
				$options = array(3, 6, 9, 12, 15, 18);
				
				foreach ( $options as $option ) {
					$selected = ( $products_per_page == $option ) ? ' selected="selected"' : '';
					$option_text = sprintf( esc_html__( 'Pokaż %d produktów', 'aquago' ), $option );

					printf( '<option value="%s"%s>%s</option>', esc_attr($option), $selected, $option_text );
				}
				?>
			</select>
		</div>
    <?php
}
// add_action( 'woocommerce_before_shop_loop', 'itm_select_to_display_products', 22 ); //edit1 if you need replace display products you will need use ajax.php and ajax.js




///  - - - - - END - ARCHIVE PRODUCT - - - - - /////

///  - - - - -  CHECKOUT- - - - - /////











///  - - - - - END - CHECKOUT - - - - - /////


///  - - - - -  THANK YOU- - - - - /////







///  - - - - - END -  THANK YOU- - - - - /////


///  - - - - - MY ACCOUNT- - - - - /////


///  - - - - - END MY ACCOUNT- - - - - /////



