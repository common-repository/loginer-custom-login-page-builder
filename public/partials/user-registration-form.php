<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file contains the User Registration Form.
 *
 * @since 1.0.0
 * @package Loginer
 * @subpackage Loginer/partials
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

?>
<div class="form-margin-collepsed"> </div>
	<?php wp_nonce_field( 'register-nonce', '_wpnonce_register-nonce' ); ?>
	<?php do_action( 'user_new_form_tag' ); ?>
	<div class="form-row">
		<label for="username" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_USERNAME_LABEL ) ? $this->loginer_get_option_values( LOGINER_USERNAME_LABEL ) : __( 'Username', 'loginer' ) ); ?> <strong><span class="custom_required_Color"> * </span></strong></label>
		<input class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" type="text" name="user_login" id="user_login" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_USERNAME_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_USERNAME_PLACEHOLDER ) : __( 'Username', 'loginer' ) ); ?>" required >
	</div>
	<div class="form-row">
		<label for="useremail" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_EMAIL_LABEL ) ? $this->loginer_get_option_values( LOGINER_EMAIL_LABEL ) : __( 'Email', 'loginer' ) ); ?> <strong><span class="custom_required_Color"> * </span></strong></label>
		<input type="email" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" name="user_email" id="user_email" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_EMAIL_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_EMAIL_PLACEHOLDER ) : __( 'Email', 'loginer' ) ); ?>" required >
	</div>
	<?php
	$registerwithpass = get_option( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL );
	if ( 'yes' !== $registerwithpass ) {
		do_action( 'register_form' );
	}
	if ( 'yes' === $registerwithpass ) {
		?>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>" for="user-pass"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_PASSWORD_LABEL ) ? $this->loginer_get_option_values( LOGINER_PASSWORD_LABEL ) : __( 'Password', 'loginer' ) ); ?></label>
			<input type="password" value="" name="password" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" id="password" autocomplete="off" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_NEW_PASSWORD_PLACEHOLDER ) : __( 'Password', 'loginer' ) ); ?>" required />
			<span style="text-align:center; width:100%;" id="password-strength"></span>
		</div>
		<div class="form-row">
			<label for="user-confirmpass" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_CONFIRM_PASSWORD_LABEL ) ? $this->loginer_get_option_values( LOGINER_CONFIRM_PASSWORD_LABEL ) : __( 'Confirm Password', 'loginer' ) ); ?></label>
			<input type="password" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>"  name="confirm_password" id="conform_password" autocomplete="off" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_CONFIRM_PASSWORD_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_CONFIRM_PASSWORD_PLACEHOLDER ) : __( 'Confirm Password', 'loginer' ) ); ?>" required />
		</div>
	<?php } ?>
	<?php do_action( 'register_form' ); ?>
	<p><?php esc_attr_e( 'Registration confirmation will be sent by email.', 'loginer' ); ?></p>
	<div class="form-row">
		<input type="submit" name="wp-submit" id="wp-submit" class="button btn <?php echo esc_attr( $this->loginer_get_option_values( 'buttonclasses' ) ); ?>" value="<?php esc_attr_e( 'Register', 'loginer' ); ?>"/>
	</div>
