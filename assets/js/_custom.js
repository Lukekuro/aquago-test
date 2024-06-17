import vars from './_vars';

// Helper functions:
import {throttle} from './functions/throttle';

// Plugins (NPM modules and uploaded files):
import Swiper, {Navigation, Pagination, Autoplay, Thumbs} from 'swiper/bundle'; // import Swiper bundle with all modules installed
// available Swiper.js modules = [Virtual, Keyboard, Mousewheel, Navigation, Pagination, Scrollbar, Parallax, Zoom, Lazy, Controller, A11y, History, HashNavigation, Autoplay, Thumbs, FreeMode, Grid, Manipulation, EffectFade, EffectCube, EffectFlip, EffectCoverflow, EffectCreative, EffectCards]
import './vendors/jquery.nice-select.min.js'; // jQuery Nice Select
import { Fancybox } from "@fancyapps/ui"; // Fancybox
import AOS from "aos"; // AOS

jQuery(document).ready(function ($) {
	"use strict";

	AOS.init({
		once: true,
	} );
	
	/**
	 * Tweak for mobiles (full height)
	 */
	const fixFullheight = () => {
		const vh = window.innerHeight * 0.01;
		vars.htmlEl.style.setProperty( '--vh', `${vh}px` );
	};

	fixFullheight();
	const fixHeight = throttle( fixFullheight );
	window.addEventListener( 'resize', fixHeight );


	/**
	 * Force load of all lazy-loading images
	 */
	setTimeout(function () {
		$( '.lazyload.loading' ).removeClass( 'loading' ).addClass( 'loaded' );
	}, 3000);


	/**
	 * Focus, change on input
	 */
	$( '.wpcf7 input' ).on( 'change focus', function() {
        $( this ).removeClass( 'wpcf7-not-valid' ).attr( 'aria-invalid', 'false' ).parent().find( '.wpcf7-not-valid-tip' ).css( 'opacity', '0' );
    });

	/**
	 * Nice select
	 */
	// do not activate NiceSelect on those pages, where it might conflict with Select2
	if ( !$( 'body' ).hasClass( 'woocommerce-account' ) ) {
		$( 'select' ).niceSelect();
	}


	/**
	 * Trigger NiceSelect update after Woocommerce Update variations
	 */
	$( '.variations_form' ).on( 'woocommerce_variation_has_changed', function () {
		$( '.variations_form select' ).niceSelect( 'update' );
	});

	/**
	 * Mini Cart - on mobile
	 */
	var mini_cart = $( '.mini-cart' );

	mini_cart.on( 'click', function(e) {
		e.stopPropagation();
		$( this ).toggleClass( 'active' );
	} );

	/**
	 * Click to document to hidden mini cart
	 */
	$(function() {
		$( document ).click( function(event) {
			if ( ! $( event.target ).closest( '.mini-cart' ).length ) {
				mini_cart.removeClass( 'active' );
			}
		} );
	} );

	/**
	 * Function to Close Mini Cart
	 */
	function closeMiniCart() {
		mini_cart.removeClass( 'active' );
	}

	$( window ).on( 'resize', function (e) {
		closeMiniCart();
	} );

	/**
     * Get section and attr href from btn-next-section
     */
    var get_section = $('section').eq(1).attr('id');
	if ( get_section ) {
		$( '.btn-next-section' ).attr('href', "#" + get_section);
	}
	
	/**
	 * FAQ - See more  - edit1 if you need click to see more to show all text 
	 */
	// INFO - need add btn-span .b-faq__more and add class .item-hidden - place where is hidden
	$( '.b-faq__more' ).on( 'click', function (e) {
		e.preventDefault();
		var see_moreItem = $( this ).closest( '.b-faq' );
		see_moreItem.find( '.item-hidden' ).removeClass( 'item-hidden' );
		$( this ).remove();
	});

	/**
	 * Slider Images
	 */
	document.querySelectorAll( '.swiper-images' ).forEach(slider => {
		const swiper = new Swiper(slider, {
			loop: true,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			pagination: {
				el: slider.querySelector( '.swiper-pagination' ),
				clickable: true,
			},
			navigation: {
				nextEl: slider.querySelector( '.swiper-button-next' ),
				prevEl: slider.querySelector( '.swiper-button-prev' ),
			},
			on: {
				// lazy load images
				slideChange: function () {
					try {
						lazyLoadInstance.update();
					} catch (e) {
					}
				}
			}
		});
	});

	// JS Lazyload fix for images on the first screen.
	// This code should run after all the code is initiated.
	$(window).trigger( 'scroll' );

	// /**
	//  * Slider Reviews - edit1 if you need
	//  */
	// document.querySelectorAll( '.swiper-reviews' ).forEach(slider => {
	// 	const swiper = new Swiper(slider, {
	// 		loop: true,
	// 		autoplay: {
	// 			delay: 5000,
	// 			disableOnInteraction: false,
	// 			pauseOnMouseEnter: true,
	// 		},
	// 		effect: "fade",
	// 		fadeEffect: {
	// 			crossFade: true
	// 		  },
	// 		navigation: {
	// 			nextEl: slider.parentElement.querySelector( '.swiper-button-next' ),
	// 			prevEl: slider.parentElement.querySelector( '.swiper-button-prev' ),
	// 		},
	// 		pagination: {
	// 			el: slider.parentElement.querySelector( '.swiper-pagination' ),
	// 			clickable: true,
	// 		},
	// 		on: {
	// 			// lazy load images
	// 			slideChange: function () {
	// 				try {
	// 					lazyLoadInstance.update();
	// 				} catch (e) {
	// 				}
	// 			}
	// 		}
	// 	});
	// });

	/**
	* SWIPER - logos - is related with section as logos
	*/
	// const sliderlogos = document.querySelectorAll( '.swiper-logos' );
	// if (sliderlogos.length) {
	// 	sliderlogos.forEach(slider => {
	// 		var swiper = new Swiper( slider, {
	// 			slidesPerView: 4,
	// 			slidesPerGroup: 1,
	// 			loop: true,
	// 			speed: 2000,
	// 			breakpoints: {
	// 				1025: {
	// 					spaceBetween: 100,
	// 					slidesPerView: 6,
	// 				},
	// 			},
	// 			autoplay: {
	// 				delay: 1,
	// 				disableOnInteraction: false,
	// 				pauseOnMouseEnter: true,
	// 			},
	// 			on: {
	// 				slideChange: function () {
	// 					try {
	// 						lazyLoadInstance.update();
	// 					} catch (e) {
	// 					}
	// 				}
	// 			}
	// 		} );
	// 	} );
	// } 

	

});
