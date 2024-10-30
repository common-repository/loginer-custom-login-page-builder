/**
 * This js file handle all the reset button funcitonality.
 *
 * @package Loginer
 */

	/**
	 * This Function handle the reset button enable or disable funcitonality.
	 */
function loginer_resetbutton( ) {
	( function() {
		var current_tab = jQuery( "#login-form-tabs .ui-tabs-nav .ui-state-active a" ).attr( 'title' );
		if (current_tab == 'pluginpages') {
			jQuery( '#reset_button' ).attr( 'disabled', 'disabled' );
		} else {
			jQuery( '#reset_button' ).removeAttr( 'disabled' );
		}

	})();
}

/**
 * This Function Creates the find the current open tab in admin backend.
 * */
jQuery( document ).ready(
	function( $ ) {
		'use strict';
		loginer_resetbutton();
		$( "#tabs" ).on(
			"click",
			function(){
				loginer_resetbutton();
			}
		);
		$( "#reset_button" ).on(
			"click",
			function(){

				var current_tab = $( "#login-form-tabs .ui-tabs-nav .ui-state-active a" ).attr( 'title' );
				var ajax_nonce  = pass_data.ajax_nonce;
				var data        = {
					'action': 'form_reset_button',
					'security': ajax_nonce,
					'activetab': current_tab
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php.
				jQuery.post(
					ajaxurl,
					data,
					function(response) {
						location.reload( true );
					}
				);

			}
		);
	}
);
