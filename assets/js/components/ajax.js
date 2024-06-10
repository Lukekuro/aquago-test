jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Starter name...
	 */
	// $.ajax({
	// 	url: wpApiSettings.ajaxUrl,
	// 	type: 'post',
	// 	data: {
	// 		action: 'it_custom_action',
	// 	},
	// 	success: function (data) {
	// 		console.log(data)
	// 	}
	// });

	/**
    * Load posts by category edti1
    */
	// $( '.categories .item-cat' ).on( 'click', function() {
	// 	const termID = $( this ).data( 'cat_id' );

	// 	if ( !$( this ).hasClass( 'active' ) ) {
	// 		$( '.item-cat' ).removeClass( 'active' );
	// 		$( this ).addClass( 'active' );

	// 		var list_posts = $( '.list-posts' );

	// 		if (list_posts  ) {
	// 			list_posts.find( '.posts' ).remove();
	// 			list_posts.addClass( 'is-loading' );
	// 		}
			
	// 		$.ajax({
	// 			url: wpApiSettings.ajaxUrl,
	// 			type: 'post',
	// 			data: {
	// 				action: 'load_posts_by_cat',
	// 				term_id: termID
	// 			},
	// 			success: function (data) {
	// 				list_posts.html(data);
	// 			}
	// 		});
	// 	}
	// } );

	/**
    * Load product by category - WooCommerce edti1
    */
	// $( '.shop-categories .item-cat' ).on( 'click', function() {
	// 	const termID = $( this ).data( 'cat_id' );

	// 	var product_list = $( this ).closest( '.shop-categories' ).next( '.products' );


	// 	if ( !$( this ).hasClass( 'active' ) ) {
	// 		$( '.item-cat' ).removeClass( 'active' );
	// 		$( this ).addClass( 'active' );

	// 		if ( product_list ) {
	// 			product_list.addClass( 'no-block-icons' );
	// 			product_list.removeClass( 'block-column-3' );
	// 			product_list.removeClass( 'block-column-1' );
	// 			product_list.find( 'article' ).remove();
	// 			product_list.addClass( 'is-loading' );
	// 		}

	// 		if ( termID > 0 ) {
	// 			$.ajax({
	// 				url: wpApiSettings.ajaxUrl,
	// 				type: 'post',
	// 				data: {
	// 					action: 'load_products_by_cat',
	// 					term_id: termID
	// 				},
	// 				success: function (data) {
	// 					product_list.html(data);
	// 				}
	// 			});
	// 		}
	// 	}
	// } );

	/**
    * Change to display products in archive products //edit1 for replace display products
    */
	// $( 'select.display-products' ).on( 'change', function() {
	// 	const value = $( this ).val();

	// 	if ( '' !== value && value ) {
	// 		$.ajax({
	// 			url: wpApiSettings.ajaxUrl,
	// 			type: 'post',
	// 			data: {
	// 				action: 'load_display_products',
	// 				value: value
	// 			},
	// 			success: function (data) {
	// 				location.reload();
	// 			}
	// 		});
	// 	}
	// } );
});

