<?php
/**
 * Map scripts
 */
$google_maps_api_key = get_field( 'google_maps_api_key', 'option' );
?>

<script type="text/javascript">

	( function( $ ) {

		$.getScript( "https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api_key; ?>", function( data, textStatus, jqxhr ) {

			/*
			 *  new_map
			 *
			 *  This function will render a Google Map onto the selected jQuery element
			 *
			 */

			function new_map( $el ) {

				// var
				var $markers = $el.find( '.marker' );

				// Create an array of styles.
				var styles = [
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#e9e9e9"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f5f5f5"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 29
							},
							{
								"weight": 0.2
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 18
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f5f5f5"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#dedede"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": 36
							},
							{
								"color": "#333333"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f2f2f2"
							},
							{
								"lightness": 19
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 17
							},
							{
								"weight": 1.2
							}
						]
					}
				];
				var styles = [];
				// Create a new StyledMapType object, passing it the array of styles,
				// as well as the name to be displayed on the map type control.
				var styledMap = new google.maps.StyledMapType( styles,
					{name: "Styled Map"} );

				// vars
				var args = {
					zoom: 15,
					center: new google.maps.LatLng( 0, 0 ),
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					gestureHandling: 'cooperative',
					scrollwheel: false,
					disableDefaultUI: false,
					// zoomControl: false,
					mapTypeControl: false,
					scaleControl: false,
					streetViewControl: false,
					rotateControl: false,
					fullscreenControl: false
				};

				// create map
				var map = new google.maps.Map( $el[0], args );

				//Associate the styled map with the MapTypeId and set it to display.
				map.mapTypes.set( 'map_style', styledMap );
				map.setMapTypeId( 'map_style' );

				// add a markers reference
				map.markers = [];
				map.infowindows = [];

				// add markers
				$markers.each( function() {

					add_marker( $( this ), map );

				} );

				// center map
				center_map( map );

				// return
				return map;

			}

			/*
			 *  add_marker
			 *
			 *  This function will add a marker to the selected Google Map
			 *
			 */

			function add_marker( $marker, map ) {

				if ( $marker.attr( 'data-marker' ) ) {
					markerUrl = $marker.attr( 'data-marker' );
				} else {
					markerUrl = '<?php echo IT_IMG; ?>point.png';
				}
				// var
				var latlng = new google.maps.LatLng( $marker.attr( 'data-lat' ), $marker.attr( 'data-lng' ) );
				var icon = {
					url: markerUrl, // url
					scaledSize: new google.maps.Size( 46, 60 ), // image width and height
					origin: new google.maps.Point( 0, 0 ), // set the base origin
					anchor: new google.maps.Point( 23, 30 ), // width/2, height/2

				};

				// create marker
				var marker = new google.maps.Marker( {
					position: latlng,
					map: map,
					icon: icon,
				} );

				// add to array
				map.markers.push( marker );

				// if marker contains HTML, add it to an infoWindow
				let last_open = false;
				if ( $marker.html() ) {
					// create info window
					var infowindow = new google.maps.InfoWindow( {
						content: $marker.html()
					} );
					map.infowindows.push( infowindow );
					// show info window when marker is click
					google.maps.event.addListener( marker, 'click', function() {
						map.infowindows.forEach(function(el, i){
							el.close();
						});
						infowindow.open( map, marker );


					} );

				}

			}


			var myoverlay = new google.maps.OverlayView();
			myoverlay.draw = function() {
				//this assigns an id to the markerlayer Pane, so it can be referenced by CSS
				this.getPanes().markerLayer.id = 'markerLayer';
			};
			myoverlay.setMap( map );

			/*
			 *  center_map
			 *
			 *  This function will center the map, showing all markers attached to this map
			 *
			 */

			function center_map( map ) {

				// vars
				var bounds = new google.maps.LatLngBounds();

				// loop through all markers and create bounds
				$.each( map.markers, function( i, marker ) {

					var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

					bounds.extend( latlng );

				} );

				// only 1 marker?
				if ( map.markers.length == 1 ) {
					// set center of map
					map.setCenter( bounds.getCenter() );
					map.setZoom( 15 );
				} else {
					// fit to bounds
					map.fitBounds( bounds );
				}

			}


		} );

	} )( jQuery );
</script>
