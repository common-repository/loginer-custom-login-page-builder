<?php
/** Custom-login-form
 *
 * @package Loginer
 * @subpackage Loginer/templates
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

echo '<div class="custom-form">';
echo '<form method="post" action="' . esc_url( wp_login_url() ) . '" class="' . esc_attr( $this->loginer_get_option_values( 'formclasses' ) ) . '">';
if ( isset( $_REQUEST['errors'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['errors'] ) ) ) {
	$_REQUEST['errors'] = sanitize_text_field( wp_unslash( $_REQUEST['errors'] ) );
}

	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-form-error.php';
	$form_error = new Loginer_Form_Error();
	$form_error->loginer_heading( LOGINER_LOGIN_HEADING, $GLOBALS[ LOGINER_DEFAULT_LOGIN ] );
if ( isset( $_REQUEST['redirect_to'] ) ) {
	$redirect_to = sanitize_text_field( wp_unslash( $_REQUEST['redirect_to'] ) );
} else {
	$redirect_to = admin_url();
}


if ( is_user_logged_in() ) {
	$form_error->loginer_already_login();
} elseif ( isset( $_GET['logged_out'] ) || isset( $_GET['registered'] ) || isset( $_GET['lostpassword'] ) || isset( $_GET['password'] ) ) {
	$custom_options = get_option( LOGINER_SETTING_OPTIONS_GROUP );
	echo '<div class="alert alert-success">';

	// Show Logout msg request parameters.

	// modified error messages for logout,register,password.
	if ( isset( $_REQUEST['logged_out'] ) ) {
		$logged_out_error_message = isset( $custom_options['errormsg'][ LOGINER_LOGGED_OUT ] ) ? $custom_options['errormsg'][ LOGINER_LOGGED_OUT ] : $GLOBALS[ LOGINER_DEFAULT_LOGGED_OUT ];
		echo '<p>' . esc_attr( $logged_out_error_message ) . '</p></div>';
	} elseif ( isset( $_REQUEST['registered'] ) ) {
		$registered_error_message = isset( $custom_options['errormsg'][ LOGINER_REGISTERED ] ) ? $custom_options['errormsg'][ LOGINER_REGISTERED ] : $GLOBALS[ LOGINER_DEFAULT_REGISTERED ];
		echo '<p>' . esc_attr( $registered_error_message ) . '</p></div>';
	} elseif ( isset( $_REQUEST['password'] ) ) {
		$reset_password_error_message = isset( $custom_options['errormsg'][ LOGINER_RESET_PASSWORD ] ) ? $custom_options['errormsg'][ LOGINER_RESET_PASSWORD ] : $GLOBALS[ LOGINER_DEFAULT_RESET_PASSWORD ];
		echo '<p>' . esc_attr( $reset_password_error_message ) . '</p></div>';
	} elseif ( isset( $_REQUEST['lostpassword'] ) && 'success' === $_REQUEST['lostpassword'] ) {
		$lost_passwod_error_message = isset( $custom_options['errormsg'][ LOGINER_LOSTPASSWORD ] ) ? $custom_options['errormsg'][ LOGINER_LOSTPASSWORD ] : $GLOBALS[ LOGINER_DEFAULT_LOSTPASSWORD ];
		echo '<p>' . esc_attr( $lost_passwod_error_message ) . '</p></div>';
	}
	require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'user-login-form.php';
} else {
	require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'user-login-form.php';
}
echo '</form>';
echo '<div class="form-margin-collepsed"> </div>';
