import {throttle} from '../functions/throttle';
import Swiper, {Navigation, Pagination, Autoplay, Thumbs} from 'swiper/bundle'; // import Swiper bundle with all modules installed
// available Swiper.js modules = [Virtual, Keyboard, Mousewheel, Navigation, Pagination, Scrollbar, Parallax, Zoom, Lazy, Controller, A11y, History, HashNavigation, Autoplay, Thumbs, FreeMode, Grid, Manipulation, EffectFade, EffectCube, EffectFlip, EffectCoverflow, EffectCreative, EffectCards]

jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Select2
	 */
	if ( $( 'body' ).hasClass( 'woocommerce-account' ) ) {
		$( '.woocommerce-MyAccount-content select, .woocommerce-form select' ).select2();
	}

	/**
	 * Product quantity update
	 */
	$(document).on( 'click', '.quantity button.btn-qty__plus, .quantity button.btn-qty__minus', function () {
		var that = $( this );
		updateProductQty( that );

		$( 'button[name="update_cart"]' ).removeAttr( 'disabled' ).attr( 'aria-disabled', 'false' );
	});

	$(document).on( 'keyup', '.quantity .qty', function () {
		var that = $( this );
		updateProductQty( that );

		$( 'button[name="update_cart"]' ).removeAttr( 'disabled' ).attr( 'aria-disabled', 'false' );
	});

	const qtyFields = $( '.quantity .qty' );
	if ( qtyFields.length ) {
		qtyFields.each( function () {
			updateProductQty( $( this ) );
		});
	}

	function updateProductQty( that ) {
		// Get current quantity values
		const max = 9999,
			min = 1,
			step = 1;
		let qty = that.closest( '.quantity' ).find( '.qty' ),
			val = parseFloat(qty.val() ),
			totalQty = val;

		// Change the value if plus or minus
		if ( that.is( '.btn-qty__plus' ) ) {
			if ( max && ( max <= val ) ) {
				qty.val( max );
				totalQty = max;
			} else {
				qty.val( val + step );
				totalQty = val + step;
			}
		} else if ( that.is( '.btn-qty__minus' ) ) {
			if ( min && ( min >= val) ) {
				qty.val( min );
				totalQty = min;
			} else if ( val > 1 ) {
				qty.val( val - step );
				totalQty = val - step;
			}
		}
		if ( 1 === totalQty ) {
			that.closest( '.quantity' ).find( '.btn-qty__minus' ).addClass( 'disabled' );
		} else {
			that.closest( '.quantity' ).find( '.btn-qty__minus' ).removeClass( 'disabled' );
		}
	}

	/**
	 *  hide both slider arrows if they are not needed
	 */ 
	function toggleSliderButtons( slider ) {
		const disabledButtons = slider.querySelectorAll( '.swiper-button-disabled' );
		if ( disabledButtons.length === 2 ) {
			disabledButtons.forEach( el => el.classList.add( 'd-none' ) );
		} else {
			slider.querySelectorAll( '.swiper-button-prev, .swiper-button-next' ).forEach( el => el.classList.remove( 'd-none' ) );
		}
	}

	/**
	 * Slider Product Thumbnails
	 */
	const sliderProductThumbs = document.querySelector( '.swiper-product-thumbs' ),
		sliderProductImage = document.querySelector( '.swiper-product-image' );
	let swiperProductThumbs,
		swiperProductImage;
	if (sliderProductImage) {
		swiperProductThumbs = new Swiper( sliderProductThumbs, {
			spaceBetween: 20,
			slidesPerView: 3,
			watchSlidesProgress: true,
			breakpoints: {
				1025: {
					slidesPerView: 4,
				},
			},
			navigation: {
				nextEl: sliderProductThumbs.querySelector( '.swiper-button-next' ),
				prevEl: sliderProductThumbs.querySelector( '.swiper-button-prev' ),
			},
			on: {
				init: function () {
					sliderProductThumbs.dataset.slides = sliderProductThumbs.querySelectorAll( '.swiper-slide' ).length;

					toggleSliderButtons( sliderProductThumbs );
				},
				// lazy load images
				slideChange: function () {
					try {
						lazyLoadInstance.update();
					} catch (e) {
					}
				}
			}
		});

		swiperProductImage = new Swiper( sliderProductImage, {
			spaceBetween: 10,
			watchSlidesProgress: true,
			navigation: {
				nextEl: sliderProductImage.querySelector( '.swiper-button-next' ),
				prevEl: sliderProductImage.querySelector( '.swiper-button-prev' ),
			},
			thumbs: {
				swiper: swiperProductThumbs,
			},
			on: {
				init: function () {
					sliderProductImage.dataset.slides = sliderProductImage.querySelectorAll( '.swiper-slide' ).length;
				},
				// lazy load images
				slideChange: function () {
					try {
						lazyLoadInstance.update();
					} catch (e) {
					}
				}
			}
		});
	}

	/**
	 * Init Woocommerce zoom on the custom product images
	 */
	if ( $( 'body' ).hasClass( 'single-product' ) && wc_single_product_params.zoom_enabled) {
		$( '.swiper-product-image .c-image' ).each(function () {
			const el = $( this );
			el.zoom({url: el.attr( 'href' )});
		});
	}

	/**
	 * Slider Products (upsells, related, etc)
	 */
	document.querySelectorAll( '.swiper-products' ).forEach(slider => {
		const swiper = new Swiper(slider, {
			spaceBetween: 20,
			slidesPerView: 2,
			breakpoints: {
				640: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
				1025: {
					slidesPerView: 4,
				},
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
				init: function () {
					slider.dataset.slides = slider.querySelectorAll( '.swiper-slide' ).length;

					toggleSliderButtons(slider);
				},
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

	window.addEventListener( 'resize', () => {
		document.querySelectorAll( '.swiper' ).forEach(slider => throttle( toggleSliderButtons(slider) ) );
	});

	/**
	 * INFO - this is from woo.php - select variables as images // edit1
	 */
	/**
	 * Product list variable
	 */
	// var form = $( 'form.variations_form' ),
	// product__list_variables = $( '.product__list-variables' ),
	// product__list_variables_input = $( '.product__list-variables input' ),
	// button = form.find( '.single_add_to_cart_button' );

	// if ( product__list_variables ) {
	// 	setTimeout(() => {
	// 		product__list_variables.removeClass( 'disabled' );
	// 	}, 500);
	// }

	// if ( product__list_variables_input ) {
	// 	product__list_variables_input.each( function() {
	// 		var this_id = $( this ).val();
			
	// 		if( this.checked  ) {
	// 			setTimeout(() => {
	// 				button.parent().find( '.variation_id' ).val( this_id );
	// 				button.removeClass( 'disabled' );
	// 				form.attr( 'current-image', $( this ).data( 'img-id' ) );
	// 			}, 500);
	// 		}
	// 	} );

	// 	product__list_variables_input.on( 'change', function() {
	// 		var this_id = $( this ).val();

	// 		if( this.checked  ) {
	// 			button.parent().find( '.variation_id' ).val( this_id );
	// 			button.removeClass( 'disabled' );
	// 			form.attr( 'current-image', $( this ).data( 'img-id' ) );
	// 		}
	// 	} );
	// }

	// if ( form.length ) {
	// 	const firstSlide = swiperProductImage.slides[0],
	// 		firstSlideThumbs = swiperProductThumbs.slides[0],
	// 		firstSlideOriginal = {
	// 			dataImageId: firstSlide.getAttribute( 'data-image-id' ),
	// 			href: firstSlide.querySelector( 'a' ).getAttribute( 'href' ),
	// 			src: firstSlide.querySelector( 'img' ).getAttribute( 'src' ),
	// 			srcset: firstSlide.querySelector( 'img' ).getAttribute( 'srcset' )
	// 		};

	// 	function resetFirstSlideToOriginal() {
	// 		// slider product image:
	// 		firstSlide.setAttribute( 'data-image-id', firstSlideOriginal.dataImageId );
	// 		firstSlide.querySelector( 'a' ).setAttribute( 'href', firstSlideOriginal.href );
	// 		firstSlide.querySelector( 'img' ).setAttribute( 'src', firstSlideOriginal.src );
	// 		firstSlide.querySelector( 'img' ).setAttribute( 'srcset', firstSlideOriginal.srcset );

	// 		// slider product thumbnails:
	// 		firstSlideThumbs.setAttribute( 'data-image-id', firstSlideOriginal.dataImageId );
	// 		firstSlideThumbs.querySelector( 'img' ).setAttribute( 'src', firstSlideOriginal.src );
	// 		firstSlideThumbs.querySelector( 'img' ).setAttribute( 'srcset', firstSlideOriginal.srcset );
	// 	}

	// 	var observer = new MutationObserver(function(mutations) {
	// 		mutations.forEach(function(mutation) {
	// 			if (mutation.attributeName === 'current-image') {
	// 				if ( '' !== $( 'input.variation_id' ).val() ) {
	// 					const varID = $( 'input.variation_id' ).val(),
	// 						variations = JSON.parse( $( 'form.variations_form' ).attr( 'data-product_variations' ) ),
	// 						filteredData = variations.filter( i => i.variation_id == varID );
		
	// 					if ( Object.keys( filteredData ).length !== 0 ) {
	// 						let imgID = null;
	// 						const varObj = filteredData[0];
	// 						imgID = varObj.image_id;
		
	// 						const slides = swiperProductImage.slides;
	// 						let slideIndexGoTo = 0;
	// 						slides.forEach( ( slide, i ) => {
	// 							if ( slide.dataset.imageId == imgID ) {
	// 								slideIndexGoTo = i;
	// 							}
	// 						});
		
	// 						if ( slideIndexGoTo === 0 ) {
	// 							// slider product image:
	// 							firstSlide.setAttribute( 'data-image-id', imgID );
	// 							firstSlide.querySelector( 'a' ).setAttribute( 'href', varObj.image.url );
	// 							firstSlide.querySelector( 'img' ).setAttribute( 'src', varObj.image.src );
	// 							firstSlide.querySelector( 'img' ).setAttribute( 'srcset', varObj.image.srcset );
		
	// 							// slider product thumbnails:
	// 							firstSlideThumbs.setAttribute( 'data-image-id', imgID );
	// 							firstSlideThumbs.querySelector( 'img' ).setAttribute( 'src', varObj.image.thumb_src );
	// 							firstSlideThumbs.querySelector( 'img' ).setAttribute( 'srcset', varObj.image.srcset );
	// 						}
		
	// 						// change active slide
	// 						swiperProductImage.slideTo( slideIndexGoTo );
	// 					}
	// 				} else {
	// 					resetFirstSlideToOriginal();
	// 				}
	// 			}
	// 		});
	// 	});
		
	// 	observer.observe(form[0], { attributes: true });
	// }

	//ELSE !!!! //edit1

	/**
	 * Single Product Variation Change
	 */
	if ( $( 'form.variations_form' ).length) {
		const firstSlide = swiperProductImage.slides[0],
			firstSlideThumbs = swiperProductThumbs.slides[0],
			firstSlideOriginal = {
				dataImageId: firstSlide.getAttribute( 'data-image-id' ),
				href: firstSlide.querySelector( 'a' ).getAttribute( 'href' ),
				src: firstSlide.querySelector( 'img' ).getAttribute( 'src' ),
				srcset: firstSlide.querySelector( 'img' ).getAttribute( 'srcset' )
			};

			

		function resetFirstSlideToOriginal() {
			// slider product image:
			firstSlide.setAttribute( 'data-image-id', firstSlideOriginal.dataImageId );
			firstSlide.querySelector( 'a' ).setAttribute( 'href', firstSlideOriginal.href );
			firstSlide.querySelector( 'img' ).setAttribute( 'src', firstSlideOriginal.src );
			firstSlide.querySelector( 'img' ).setAttribute( 'srcset', firstSlideOriginal.srcset );

			// slider product thumbnails:
			firstSlideThumbs.setAttribute( 'data-image-id', firstSlideOriginal.dataImageId );
			firstSlideThumbs.querySelector( 'img' ).setAttribute( 'src', firstSlideOriginal.src );
			firstSlideThumbs.querySelector( 'img' ).setAttribute( 'srcset', firstSlideOriginal.srcset );
		}

		$( 'input.variation_id' ).on( 'change', function () {
			if ( '' !== $( this ).val() ) {
				const varID = $( this ).val(),
					variations = JSON.parse( $( 'form.variations_form' ).attr( 'data-product_variations' ) ),
					filteredData = variations.filter( i => i.variation_id == varID );

				if ( Object.keys( filteredData ).length !== 0 ) {
					let imgID = null;
					const varObj = filteredData[0];
					imgID = varObj.image_id;

					const slides = swiperProductImage.slides;
					let slideIndexGoTo = 0;
					slides.forEach( ( slide, i ) => {
						if ( slide.dataset.imageId == imgID ) {
							slideIndexGoTo = i;
						}
					});

					if ( slideIndexGoTo === 0 ) {
						// slider product image:
						firstSlide.setAttribute( 'data-image-id', imgID );
						firstSlide.querySelector( 'a' ).setAttribute( 'href', varObj.image.url );
						firstSlide.querySelector( 'img' ).setAttribute( 'src', varObj.image.src );
						firstSlide.querySelector( 'img' ).setAttribute( 'srcset', varObj.image.srcset );

						// slider product thumbnails:
						firstSlideThumbs.setAttribute( 'data-image-id', imgID );
						firstSlideThumbs.querySelector( 'img' ).setAttribute( 'src', varObj.image.thumb_src );
						firstSlideThumbs.querySelector( 'img' ).setAttribute( 'srcset', varObj.image.srcset );
					}

					// change active slide
					swiperProductImage.slideTo( slideIndexGoTo );
				}
			} else {
				resetFirstSlideToOriginal();
			}
		});

		// reset variations
		$( '.reset_variations' ).on( 'click', function (e) {
			$( '.variations_form select' ).val( '' ).niceSelect( 'update' );
			if ( firstSlide.getAttribute( 'data-image-id' ) !== firstSlideOriginal.dataImageId ) {
				resetFirstSlideToOriginal();
			}
		});
	}
	//END  // edit1

	/**
	 * Cart page
	 */
	$(document).on( 'added_to_cart removed_from_cart updated_cart_totals updated_checkout', function () {
		try {
			lazyLoadInstance.update();
		} catch (e) {
		}
	});

	/**
	 * Auto update cart //edit1 - if you need auto update cart (without BTN as UPDATE CART) in CART PAGE
	 * then add code in geretal.scss  from parent woocommerce 
	 * form.processing a.button.alt.checkout-button,
	 * form.is-active-qty a.button.alt.checkout-button,
	* form.checkout.processing .place-order .button {
	* 	@extend .disabled;
	* }
	 */
	// var timeout;

	// if ( $( 'table.cart .quantity' ) ) {
	// 	$( 'body' ).on( 'click', 'table.cart .quantity',function(){
		// $( '.woocommerce-cart-form' ).addClass( 'is-active-qty' );
	
	// 		clearTimeout(timeout);
	
	// 		timeout = setTimeout( function () {
	
	// 			$( ".button[name='update_cart']" ).trigger( "click" );
	
	// 		}, 2000);
			
	// 	});
	// }

});
