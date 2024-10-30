/**
 * This js file handle passwrod strength meter
 *
 * @package Loginer
 */

/** Function for calculate the password strenth meter */
function loginer_checkPasswordStrength( $password,
	$conform_password,
	$strengthResult,
	$submitButton,
	blacklistArray ) {
	var password         = $password.val();
	var conform_password = $conform_password.val();
	if (typeof window.wp == "undefined" ) {
	var wp = window.object_of_interest;
	}else{
		var wp = window.wp;
	}
	if(typeof window.usercheck == "undefined")
	{
		var usercheck = window.object_of_interest1;
	}else{
		var usercheck = window.usercheck;
	}
	// Reset the form & meter.
	$submitButton.attr( 'disabled', 'disabled' );
	$strengthResult.removeClass( 'short bad good strong' );
 
	// Extend our blacklist array with those from the inputs & site data.
	blacklistArray = blacklistArray.concat( wp.passwordStrength.userInputBlacklist() )

	// Get the password strength.
	var strength = wp.passwordStrength.meter( password, blacklistArray, conform_password );

	// Add the strength meter results.

	switch ( strength ) {
		case 2:
			$strengthResult.addClass( 'bad' ).html( 'Bad' );
			break;

		case 3:
			$strengthResult.addClass( 'good' ).html( 'Good' );
			break;

		case 4:
			$strengthResult.addClass( 'strong' ).html( 'Strong' );
			break;

		case 5:
			$strengthResult.addClass( 'short' ).html( 'Mismatch' );
			break;

		default:
			$strengthResult.addClass( 'short' ).html( 'Short' );
			break;

	}

	var user_choice = usercheck.short;
	// strong.
	if (user_choice === 'custom_password_strength_meter_option_strong' && 4 === strength && '' !== conform_password.trim()) {

		$submitButton.removeAttr( 'disabled' );

	} else if (user_choice === 'custom_password_strength_meter_option_short' && (1 === strength || 0 === strength || 2 === strength || 3 === strength || 4 === strength) && '' !== conform_password.trim()) {
		// short.
		$submitButton.removeAttr( 'disabled' );

	} else if (user_choice === 'custom_password_strength_meter_option_bad' && (2 === strength || 3 === strength || 4 === strength) && '' !== conform_password.trim() ) {
		// bad.
		$submitButton.removeAttr( 'disabled' );

	} else if (user_choice === 'custom_password_strength_meter_option_good' && ( 3 === strength || 4 === strength) && '' !== conform_password.trim() ) {
		// good.
		$submitButton.removeAttr( 'disabled' );

	} else if (user_choice === 'custom_password_strength_meter_option_strong' && 4 === strength && '' !== conform_password.trim() ) {
		// strong.
		$submitButton.removeAttr( 'disabled' );

	}
	return strength;
}

jQuery( document ).ready(
	function( $ ) {
			// Binding to trigger loginer_checkPasswordStrength.
			$( 'body' ).on(
				'keyup',
				'input[name=password], input[name=confirm_password]',
				function( event ) {
					{
						// var data= document.getElementById("password").value.
						// if(data.length-1){.
						loginer_checkPasswordStrength(
							$( 'input[name=password]' ),         // First password field.
							$( 'input[name=confirm_password]' ), // Second password field.
							$( '#password-strength' ),           // Strength meter.
							$( 'input[type=submit]' ),           // Submit button.
							['black', 'listed', 'word','12345']        // Blacklisted words.
						);
					}
				}
			);
	}
);
