<?php
/**
 * Provide an Public area view.
 *
 * This file has the User Reset Password Form.
 *
 * @author Sofster
 * @package Loginer
 * @subpackage Loginer/partials
 * @since 1.0.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

?>
<div class="form-margin-collepsed"> </div>
	<?php
	wp_nonce_field( 'resetpassword-nonce', '_wpnonce_resetpassword_nonce' );
	if ( isset( $_REQUEST['login'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['login'] ) ) ) {
		$_REQUEST['login'] = sanitize_text_field( wp_unslash( $_REQUEST['login'] ) );
	}
	if ( isset( $_REQUEST['key'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['key'] ) ) ) {
		$_REQUEST['key'] = sanitize_text_field( wp_unslash( $_REQUEST['key'] ) );
	}
	?>
	<input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_REQUEST['login'] ) ) ); ?>" autocomplete="off" />
	<input type="hidden" name="rp_key" value="<?php echo esc_attr( sanitize_text_field( wp_unslash( $_REQUEST['key'] ) ) ); ?>" />
	<div class="form-row">
		<label for="new-password" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_LABEL ) ? $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_LABEL ) : __( 'New Password', 'loginer' ) ); ?></label>
		<input type="password" name="password"  id="password" autocomplete="off" onkeyup="loginer_validate_pass()" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_PLACEHOLDER ) : __( 'New Password', 'loginer' ) ); ?>" required/>
	</div>
	<div class="form-row">
		<label for="confirm-newpassword" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_REPEAT_NEW_PASSWORD_LABEL ) ? $this->loginer_get_option_values( LOGINER_REPEAT_NEW_PASSWORD_LABEL ) : __( 'Confirm New Password', 'loginer' ) ); ?></label>
		<input type="password" onkeyup="loginer_validate_pass()" name="conform_password" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" id="conform_password" autocomplete="off" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_CONFIRM_NEW_PASSWORD_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_CONFIRM_NEW_PASSWORD_PLACEHOLDER ) : __( 'Confirm New Password', 'loginer' ) ); ?>" required/>
	</div>
	<div class="form-row">
		<p><?php echo esc_url( wp_get_password_hint() ); ?></p>
	</div>
	<div class="form-row">
		<input type="submit" name="submit" id="resetpass" class="button btn <?php echo esc_attr( $this->loginer_get_option_values( 'buttonclasses' ) ); ?>" value="<?php esc_attr_e( 'Reset Password', 'loginer' ); ?>" /> 
	</div>
