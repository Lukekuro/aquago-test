<?php
/**
 * Remove user profile fields
 *
 * @package aquagoer
 */

/**
 * Remove user profile fields.
 *
 * @param array $profile_fields - fields to disable.
 *
 * @return mixed
 */
function itm_modify_contact_methods( $profile_fields ) {
	unset( $profile_fields['facebook'] );
	unset( $profile_fields['instagram'] );
	unset( $profile_fields['linkedin'] );
	unset( $profile_fields['myspace'] );
	unset( $profile_fields['pinterest'] );
	unset( $profile_fields['soundcloud'] );
	unset( $profile_fields['tumblr'] );
	unset( $profile_fields['twitter'] );
	unset( $profile_fields['youtube'] );
	unset( $profile_fields['wikipedia'] );

	return $profile_fields;
}

add_filter( 'user_contactmethods', 'itm_modify_contact_methods' );
