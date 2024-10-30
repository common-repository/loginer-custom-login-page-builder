/**
 * This js file handle flow of password strength options in backend setting page
 *
 * @package Loginer
 */

jQuery( document ).ready(
	function( $ ) {
		/*
		 * End Of Form Button Properties
		*/

		/*
		 * To Disable or Enable the Password Related checkboxes.
		*/
		$( '#custom_password_strength_meter, #custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).attr( 'disabled', 'disabled' );
		if ($( '#custom_new_registration_mail' ).prop( 'checked' ) == true) {
			$( '#custom_password_strength_meter' ).removeAttr( 'disabled' );
		}
		$( '#custom_new_registration_mail' ).click(
			function(){
				if ($( this ).prop( 'checked' ) == true) {
					$( '#custom_password_strength_meter' ).removeAttr( 'disabled' );
				} else if ($( this ).prop( 'checked' ) == false) {
					$( '#custom_password_strength_meter, #custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).attr( 'disabled', 'disabled' );
					$( '#custom_password_strength_meter, #custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).removeAttr( 'checked' );
				}
			}
		);
		// Password strength meter options.
		if ($( '#custom_password_strength_meter' ).prop( 'checked' ) == true) {
			$( '#custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).removeAttr( 'disabled' );
		}
		$( '#custom_password_strength_meter' ).click(
			function(){
				if ($( this ).prop( 'checked' ) == true) {
					$( '#custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).removeAttr( 'disabled' );
					$( '#custom_password_strength_meter_option_short' ).attr( 'checked','checked' );
				} else if ($( this ).prop( 'checked' ) == false) {
					$( '#custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).removeAttr( 'checked' );
					$( '#custom_password_strength_meter_option_short, #custom_password_strength_meter_option_bad, #custom_password_strength_meter_option_good, #custom_password_strength_meter_option_strong' ).attr( 'disabled', 'disabled' );
				}
			}
		);
	}
);
