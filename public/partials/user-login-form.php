<?php
/**
 * Provide an Public area view.
 *
 * This file has the USer LogIn Form.
 *
 * @package Loginer
 * @subpackage Loginer/partials
 * @since 1.0.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

$custom_options_page  = get_option( LOGINER_SUBMENU_SETTING_GROUP );
$custom_register_page = $custom_options_page['pluginpages']['Registration'];
$custom_lost_pass_pg  = $custom_options_page['pluginpages']['Forgot Password'];
global $interim_login;
?>
<div class="form-margin-collepsed"> </div>
	<?php
	wp_nonce_field( 'login-nonce', '_wpnonce_login-nonce' );
	?>
	<div class="form-row">
		<?php
		$username         = esc_attr( $this->loginer_get_option_values( LOGINER_EMAILUSER_LABEL ) ? $this->loginer_get_option_values( LOGINER_EMAILUSER_LABEL ) : __( 'Email or Username', 'loginer' ) );
		$emailplaceholder = esc_attr( $this->loginer_get_option_values( LOGINER_EMAILUSER_PLACE ) ? $this->loginer_get_option_values( LOGINER_EMAILUSER_PLACE ) : __( 'Email or Username', 'loginer' ) );
		?>
		<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>" for="username-email"><?php echo esc_attr( $username ); ?> &nbsp;</label>
		<input class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" type="text" name="log" id="user_login"  placeholder="<?php echo esc_attr( $emailplaceholder ); ?>">
	</div>
	<div class="form-row">
		<label for="user-password" class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_PASSWORD_LABEL ) ? $this->loginer_get_option_values( LOGINER_PASSWORD_LABEL ) : __( 'Password', 'loginer' ) ); ?>&nbsp;</label>
		<input type="password" name="pwd" id="user_pass" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_PASSWORD_PLACEHOLDER ) ? $this->loginer_get_option_values( LOGINER_PASSWORD_PLACEHOLDER ) : __( 'Password', 'loginer' ) ); ?>">
	</div>
	<div class="form-row">
	<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> <?php esc_attr_e( 'Remember Me', 'loginer' ); ?></label>
	</div>
	<?php do_action( 'login_form' ); ?>
	<div class="form-row">
		<input type="submit" class="button btn <?php echo esc_attr( $this->loginer_get_option_values( 'buttonclasses' ) ); ?>" value="<?php esc_attr_e( 'Sign In', 'loginer' ); ?>">
	</div>
	<a class="custom-link float-left"  href="<?php echo esc_url( get_permalink( $custom_lost_pass_pg ) ); ?>">
		<?php esc_attr_e( 'Forgot your password?', 'loginer' ); ?>
	</a>
	<?php if ( get_option( 'users_can_register' ) ) { ?>
	<a class="custom-link float-right"  href="<?php echo esc_url( get_permalink( $custom_register_page ) ); ?>">
		<?php esc_attr_e( 'Register Now', 'loginer' ); ?>
	</a>
	<?php } ?>
	<div style='clear:both'> </div>
	<?php // Add the redirect_to field in login form. ?>
	<?php	if ( $interim_login ) { ?>
		<input type="hidden" name="interim-login" value="1" />
	<?php	} else { ?>
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />
	<?php } ?>
		<input type="hidden" name="testcookie" value="1" />
	</p>
