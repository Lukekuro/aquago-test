jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Header scrolled
	 */
	function checkScrollPosition() {
		let st = $(window).scrollTop();

		if ($('body').hasClass('is-menu-open')) {
			return;
		}

		if (st > 70) {
			$('body').addClass('is-scrolled');
		} else {
			$('body').removeClass('is-scrolled');
		}
	}

	/** 
	 * Header scrolled edti1
	 */
	// var body = $('body'),
	// scrollUp = 'scroll-up',
	// scrollDown = 'scroll-down';
	// let lastScroll = 0;


	// function checkScrollPosition() {
	// 	const st = $(window).scrollTop();
		
	// 	if ( $( 'body' ).hasClass( 'is-menu-open' ) ) {
	// 		return;
	// 	}

	// 	if (st <= 0) {
	// 		body.removeClass(scrollUp);
	// 		return;
	// 	}

	// 	if (st > lastScroll && !body.hasClass(scrollDown)) {
	// 		// down
	// 		body.removeClass(scrollUp);
	// 		body.addClass(scrollDown);
	// 	} else if (st < lastScroll && body.hasClass(scrollDown)) {
	// 		// up
	// 		body.removeClass(scrollDown);
	// 		body.addClass(scrollUp);
	// 	}
	// 	lastScroll = st;
	// }

	$(window).on('load scroll', function (e) {
		checkScrollPosition();
	});

});
