import vars from '../_vars';

jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Toggle main menu
	 */
	$( '.icon-burger' ).on( 'click', function () {
		$( 'body' ).toggleClass( 'is-menu-open' );
		$( 'body' ).removeClass( 'scroll-down' ); //edit1 if you will use scroll up and down
	});

	$( '.main-menu li:not(.menu-item-has-children) > a' ).on( 'click', function () {
		$( 'body' ).removeClass( 'is-menu-open' );
	});

	// autoclose mobile menu when increasing window width
	function closeMobileMenu() {
		$( '.main-menu .sub-menu, .footer-links .sub-menu' ).css( 'display', '' );
		$( '.main-menu .menu-item-has-children' ).removeClass( 'active' );

		$( '.site-footer .sub-menu' ).css( 'display', '' ); //edit1 (title + ul) in footer
		$( '.site-footer .footer-menu' ).removeClass( 'active' ); //edit1 (title + ul) in footer

		if ( $(window).width() >= vars.bp.lg ) {
			if ( $( 'body' ).hasClass( 'is-menu-open' ) ) {
				$( '.icon-burger' ).trigger( 'click' );
			}
		}
	}

	$(window).on( 'resize', function (e) {
		closeMobileMenu();
	});


	//IF YOU HAVE (title + ul) in footer

	/**
	 * Toggle mobile sub menu
	 */
	$( '.main-menu .menu-item-has-children' ).on( 'click', function (e) {
		const el = $( this ),
			topEl = $( this ).parent();
		if ( $(window).width() < vars.bp.xl ) {
			e.stopPropagation();
			if (el.hasClass( 'active' )) {
				el.removeClass( 'active' );
				el.find( '> .sub-menu' ).slideUp();
			} else {
				topEl.find( '.menu-item-has-children > .sub-menu' ).slideUp();
				topEl.find( '.menu-item-has-children' ).removeClass( 'active' );
				el.addClass( 'active' );
				el.find( '> .sub-menu' ).slideDown();
			}
		}
	});
	
	/**
	 * Toggle mobile sub menu in footer - edit1 if need
	 */
	$( '.footer-menu span' ).on( 'click', function (e) {
		const topEl = $( this ).parent();
		if ( $( window ).width() < vars.bp.md ) {
			e.stopPropagation();
			if (topEl.hasClass( 'active' )) {
				topEl.removeClass( 'active' );
				topEl.find( '> .sub-menu' ).slideUp();
			} else {
				$( '.site-footer .footer-menu > .sub-menu' ).slideUp();
				$( '.site-footer .footer-menu' ).removeClass( 'active' );
				topEl.addClass( 'active' );
				topEl.find( '> .sub-menu' ).slideDown();
			}
		}
	});

	// ELSE

	/**
	 * Toggle mobile sub menu
	 */
	// $( '.main-menu .menu-item-has-children, .footer-links .menu-item-has-children' ).on( 'click', function (e) {
	// 	const el = $( this ),
	// 		topEl = $( this ).parent();
	// 	if ( $(window).width() < vars.bp.lg ) {
	// 		e.stopPropagation();
	// 		if (el.hasClass( 'active' )) {
	// 			el.removeClass( 'active' );
	// 			el.find( '> .sub-menu' ).slideUp();
	// 		} else {
	//			topEl.find( '.menu-item-has-children > .sub-menu' ).slideUp();
	// 			topEl.find( '.menu-item-has-children' ).removeClass( 'active' );
	// 			el.addClass( 'active' );
	// 			el.find( '> .sub-menu' ).slideDown();
	// 		}
	// 	}
	// });

});
