<?php
/** Custom-reset-password-form
 *
 * @package Loginer
 * @subpackage Loginer/templates
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

/** This File contains Method Used here */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-form-error.php';
$form_display_error = new Loginer_Form_Error();
echo '<div class="custom-form">';
echo '<form method="post" name="resetForm" action="' . esc_url( site_url( 'wp-login.php?action=resetpass' ) ) . '" class="' . esc_attr( $this->loginer_get_option_values( 'formclasses' ) ) . '">';
$form_display_error->loginer_heading( LOGINER_RESET_PASS_HEADING, $GLOBALS[ LOGINER_DEFAULT_RESET_PASS ] );
if ( is_user_logged_in() ) {
	$form_display_error->loginer_already_login();
} else {
	require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'reset-password-form.php';
}
echo '</form>';
echo '<div class="form-margin-collepsed"> </div>';
