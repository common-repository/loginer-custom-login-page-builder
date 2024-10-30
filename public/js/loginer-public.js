/**
 * This js file handle all the User panel function
 *
 * @package Loginer
 */

/**
 * Function for validate the password in reset password form.
 */
function loginer_validate_pass() {
	var pass  = document.getElementById( "password" ).value;
	var rpass = document.getElementById( "conform_password" ).value;
	var bt    = document.getElementById( 'resetpass' );
	if (pass !== rpass) {
		bt.disabled = true;
	} else {
		bt.disabled = false;
	}
}
jQuery( document ).ready(
	function( $ ) {
		var user_id, current_user_id,
			select       = $( '#display_name' ),
			current_name = select.val(),
			greeting     = $( '#wp-admin-bar-my-account' ).find( '.display-name' );
		if ( select.length ) {
			$( '#first_name, #last_name, #nickname' ).bind(
				'blur.user_profile',
				function() {
					var dub = [],
					inputs  = {
						display_nickname  : $( '#nickname' ).val() || '',
						display_username  : $( '#user_login' ).val() || '',
						display_firstname : $( '#first_name' ).val() || '',
						display_lastname  : $( '#last_name' ).val() || ''
					};

					if ( inputs.display_firstname && inputs.display_lastname ) {
						inputs.display_firstlast = inputs.display_firstname + ' ' + inputs.display_lastname;
						inputs.display_lastfirst = inputs.display_lastname + ' ' + inputs.display_firstname;
					}

					$.each(
						$( 'option', select ),
						function( i, el ){
							dub.push( el.value );
						}
					);

					$.each(
						inputs,
						function( id, value ) {
							if ( ! value ) {
								return;
							}

							var val = value.replace( /<\/?[a-z][^>]*>/gi, '' );

							if ( inputs[id].length && $.inArray( val, dub ) === -1 ) {
								dub.push( val );
								$(
									'<option />',
									{
										'text': val
									}
								).appendTo( select );
							}
						}
					);
				}
			);

			/**
			 * Replaces "Howdy, *" in the admin toolbar whenever the display name dropdown is updated for one's own profile.
			 */
			select.on(
				'change',
				function() {
					if ( user_id !== current_user_id ) {
						return;
					}

					var display_name = $.trim( this.value ) || current_name;

					greeting.text( display_name );
				}
			);
		}
	}
);
