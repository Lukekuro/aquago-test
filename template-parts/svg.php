<?php
/**
 * Inline SVG
 *
 * @package aquagoer
 */

?>
<svg width="0" height="0" style="position:absolute">
	<symbol id="search" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M17 17L13.2223 13.2156M15.3158 8.15789C15.3158 10.0563 14.5617 11.8769 13.2193 13.2193C11.8769 14.5617 10.0563 15.3158 8.15789 15.3158C6.2595 15.3158 4.43886 14.5617 3.0965 13.2193C1.75413 11.8769 1 10.0563 1 8.15789C1 6.2595 1.75413 4.43886 3.0965 3.0965C4.43886 1.75413 6.2595 1 8.15789 1C10.0563 1 11.8769 1.75413 13.2193 3.0965C14.5617 4.43886 15.3158 6.2595 15.3158 8.15789V8.15789Z" stroke-width="1.5" stroke-linecap="round"/>
	</symbol>

	<?php // Arrows / angles. ?>
	<symbol id="arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 8"><path d="M14.354 4.354a.5.5 0 000-.708L11.172.464a.5.5 0 10-.708.708L13.293 4l-2.829 2.828a.5.5 0 10.708.708l3.182-3.182zM0 4.5h14v-1H0v1z"/></symbol>

	<symbol id="arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 8"><path d="M.646 3.646a.5.5 0 000 .708l3.182 3.182a.5.5 0 10.708-.708L1.707 4l2.829-2.828a.5.5 0 10-.708-.708L.646 3.646zM15 3.5H1v1h14v-1z"/></symbol>

	<symbol id="angle-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M136.5 185.1l116 117.8c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L128 224.7 27.6 326.9c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17l116-117.8c4.7-4.6 12.3-4.6 17 .1z"/></symbol>

	<symbol id="angle-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z"/></symbol>

	<symbol id="angle-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M25.1 247.5l117.8-116c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L64.7 256l102.2 100.4c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L25 264.5c-4.6-4.7-4.6-12.3.1-17z"/></symbol>

	<symbol id="angle-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z"/></symbol>
	<?php // END - Arrows / angles. ?>

	<symbol id="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"/></symbol>

	<symbol id="play-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 504c137 0 248-111 248-248S393 8 256 8 8 119 8 256s111 248 248 248zM40 256c0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216zm331.7-18l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM192 335.8V176.9c0-4.7 5.1-7.6 9.1-5.1l134.5 81.7c3.9 2.4 3.8 8.1-.1 10.3L201 341c-4 2.3-9-.6-9-5.2z"/></symbol>

	<symbol id="cart" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M9.79688 24.0469C10.2888 24.0469 10.6875 23.6481 10.6875 23.1562C10.6875 22.6644 10.2888 22.2656 9.79688 22.2656C9.305 22.2656 8.90625 22.6644 8.90625 23.1562C8.90625 23.6481 9.305 24.0469 9.79688 24.0469Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M22.2656 24.0469C22.7575 24.0469 23.1562 23.6481 23.1562 23.1562C23.1562 22.6644 22.7575 22.2656 22.2656 22.2656C21.7737 22.2656 21.375 22.6644 21.375 23.1562C21.375 23.6481 21.7737 24.0469 22.2656 24.0469Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M2.67188 4.45312H6.23438L8.90625 19.5938H23.1562" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M8.90625 14.8438H22.7911C22.8941 14.8438 22.9939 14.8082 23.0736 14.7429C23.1533 14.6777 23.2078 14.5868 23.2281 14.4858L24.8312 6.47021C24.8441 6.40557 24.8425 6.33887 24.8266 6.27492C24.8106 6.21097 24.7806 6.15136 24.7388 6.10039C24.697 6.04943 24.6444 6.00838 24.5848 5.98021C24.5252 5.95204 24.4601 5.93745 24.3942 5.9375H7.125" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</symbol>

	<symbol id="user" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M16 20V17.6667C16 16.429 15.5786 15.242 14.8284 14.3668C14.0783 13.4917 13.0609 13 12 13H5C3.93913 13 2.92172 13.4917 2.17157 14.3668C1.42143 15.242 1 16.429 1 17.6667V20" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</symbol>

	<?php // Socials. ?>
	<symbol id="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></symbol>

	<symbol id="instagram" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></symbol>

	<symbol id="linkedin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></symbol>

	<symbol id="twitter-x" viewBox="0 0 22 23"  xmlns="http://www.w3.org/2000/svg">
		<g clip-path="url(#clip0_60_16)">
		<path d="M13.0951 9.32433L21.2865 0H19.3461L12.2305 8.09453L6.5516 0H0L8.58953 12.2415L0 22.0183H1.9404L9.44973 13.4684L15.4484 22.0183H22M2.64073 1.43293H5.62173L19.3446 20.6558H16.3629"/>
		</g>
		<defs>
		<clipPath id="clip0_60_16">
		<rect width="22" height="22.0184" fill="white"/>
		</clipPath>
		</defs>
	</symbol>

	<symbol id="xing" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M162.7 210c-1.8 3.3-25.2 44.4-70.1 123.5-4.9 8.3-10.8 12.5-17.7 12.5H9.8c-7.7 0-12.1-7.5-8.5-14.4l69-121.3c.2 0 .2-.1 0-.3l-43.9-75.6c-4.3-7.8.3-14.1 8.5-14.1H100c7.3 0 13.3 4.1 18 12.2l44.7 77.5zM382.6 46.1l-144 253v.3L330.2 466c3.9 7.1.2 14.1-8.5 14.1h-65.2c-7.6 0-13.6-4-18-12.2l-92.4-168.5c3.3-5.8 51.5-90.8 144.8-255.2 4.6-8.1 10.4-12.2 17.5-12.2h65.7c8 0 12.3 6.7 8.5 14.1z"/></symbol>

	<symbol id="youtube" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></symbol>

	
</svg>