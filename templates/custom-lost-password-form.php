<?php
/** Custom-lost-password-form
 *
 * @package Loginer
 * @subpackage Loginer/templates
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

/** This File has class to be used here */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-form-error.php';
echo '<div class="custom-form">';
echo '<form method="post" action="' . esc_url( network_site_url( 'wp-login.php?action=lostpassword' ) ) . '" class="' . esc_attr( $this->loginer_get_option_values( 'formclasses' ) ) . '">';
$form_error = new Loginer_Form_Error();
$form_error->loginer_heading( LOGINER_LOST_PASS_HEADING, $GLOBALS[ LOGINER_DEFAULT_LOST_PASS ] );
if ( is_user_logged_in() ) {
	$form_error->loginer_already_login();
} else {
	require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'lost-password-form.php';
}
echo '</form>';
echo '<div class="form-margin-collepsed"> </div>';
