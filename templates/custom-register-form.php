<?php
/** Custom-register-form
 *
 * @author Sofster
 * @version 1.0
 * @package Loginer
 * @subpackage Loginer/templates
 * @since 1.0
 * @copyright 2019 Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

echo '<div class="custom-form">';
echo '<form method="post" action="' . esc_url( wp_registration_url() ) . '" class="' . esc_attr( $this->loginer_get_option_values( 'formclasses' ) ) . '">';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-form-error.php';
$form_error = new Loginer_Form_Error();
$form_error->loginer_heading( LOGINER_REGISTER_HEADING, $GLOBALS[ LOGINER_DEFAULT_REGISTER ] );
if ( is_user_logged_in() && get_option( 'users_can_register' ) ) {
	echo esc_attr__( 'You are already registered', 'loginer' );
	echo '<div><a href="' . esc_url( wp_logout_url() ) . '">' . esc_attr__( 'Logout', 'loginer' ) . '</a> </div>';
} elseif ( ! get_option( 'users_can_register' ) ) {
	echo esc_attr__( 'Registering new users is currently not allowed.', 'loginer' );
	echo '</div>';
} else {
	require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'user-registration-form.php';
}
echo '</form>';
echo '<div class="form-margin-collepsed"> </div>';