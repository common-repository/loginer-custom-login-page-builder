<?php
/** Custom-login-form
 *
 * @package Loginer
 * @subpackage Loginer/admin/partial
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

?>
<div class="custom-options-settings custom-row">
	<iframe id="preview-frame" scrolling="no"></iframe>
	<div id="form-preview" class="custom-options-settings iframe-outer">
		<div id="login-form" class="custom-column-12 custom-options">
			<div class="custom-form">
			<div class="form-margin-collepsed"> </div>
				<form class="form <?php echo esc_attr( loginer_setting_options_group( 'formclasses' ) ); ?>">
					<h2 id="demo_login_heading" class="<?php echo esc_attr( loginer_setting_options_group( 'headingclasses' ) ); ?>"><?php echo esc_attr( loginer_setting_options_group( LOGINER_LOGIN_HEADING ) ? loginer_setting_options_group( LOGINER_LOGIN_HEADING ) : $GLOBALS[ LOGINER_DEFAULT_LOGIN ] ); ?></h2>
					<div class="form-margin-collepsed"> </div>
					<div class="form-row">
					<?php
					// New option added for Email or Username.
					$username    = loginer_setting_options_group( LOGINER_EMAILUSER_LABEL ) ? loginer_setting_options_group( LOGINER_EMAILUSER_LABEL ) : __( 'Email or Username', 'loginer' );
					$placeholder = loginer_setting_options_group( LOGINER_EMAILUSER_PLACE ) ? loginer_setting_options_group( LOGINER_EMAILUSER_PLACE ) : __( 'Email or Username', 'loginer' )
					?>
						<label id="useremail-label" <?php echo 'class=' . esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>> <?php echo esc_attr( $username ); ?> </label>
						<input placeholder="<?php echo esc_attr( $placeholder ); ?>" type="text" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>">
					</div>
					<div class="form-row">
						<label class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>" id="password-label"><?php echo esc_attr( loginer_setting_options_group( LOGINER_PASSWORD_LABEL ) ? loginer_setting_options_group( LOGINER_PASSWORD_LABEL ) : __( 'Password', 'loginer' ) ); ?></label>
						<input type="password" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_PASSWORD_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_PASSWORD_PLACEHOLDER ) : 'Password' ); ?>">
					</div>
					<div class="form-row">
						<input type="submit" name="submit" class="button btn <?php echo esc_attr( loginer_setting_options_group( 'buttonclasses' ) ); ?>" value="Sign In"/>
					</div>
					<div style='height: 40px;'>
					<a class="float-left custom-link">
						<?php esc_attr_e( 'Forgot your password?', 'loginer' ); ?>
					</a>
					<a class="float-right custom-link">
						<?php esc_attr_e( 'Register Now', 'loginer' ); ?>
					</a>
					</div>
				</form>
				<div class="form-margin-collepsed"> </div>
			</div>
		</div>
		<div class="custom-column-12 custom-options" id="registration-form">
			<div class="custom-form">
				<form class="form <?php echo esc_attr( loginer_setting_options_group( 'formclasses' ) ); ?>">
					<h2 id="demo_register_heading" class="<?php echo esc_attr( loginer_setting_options_group( 'headingclasses' ) ); ?>" ><?php echo esc_attr( loginer_setting_options_group( LOGINER_REGISTER_HEADING ) ? loginer_setting_options_group( LOGINER_REGISTER_HEADING ) : $GLOBALS[ LOGINER_DEFAULT_REGISTER ] ); ?></h2>
					<div class="form-margin-collepsed"> </div>
					<div class="form-row">
						<!-- Required fiel or lable in single row -->
						<?php // Labels display inline required in case of required span (theme specific). ?>
						<div><label style="display:inline" id="username-label" class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>"><?php echo esc_attr( loginer_setting_options_group( 'labels', LOGINER_USERNAME_LABEL ) ? setting_options_group( 'labels', LOGINER_USERNAME_LABEL ) : __( 'Username', 'loginer' ) ); ?></label><span class="custom_required_Color"> * </span></div>
						<input type="text" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" placeholder="<?php echo esc_attr( loginer_setting_options_group( 'placeholder', LOGINER_USERNAME_PLACEHOLDER ) ? setting_options_group( 'placeholder', LOGINER_USERNAME_PLACEHOLDER ) : __( 'Username', 'loginer' ) ); ?>" >
					</div>
					<div class="form-row">
						<div><label style="display:inline" id="email-label" class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>" ><?php echo esc_attr( loginer_setting_options_group( LOGINER_EMAIL_LABEL ) ? loginer_setting_options_group( LOGINER_EMAIL_LABEL ) : __( 'Email', 'loginer' ) ); ?></label><span class="custom_required_Color"> * </span></div>
						<input class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" type="email" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_EMAIL_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_EMAIL_PLACEHOLDER ) : __( 'Email', 'loginer' ) ); ?>" >
					</div>
					<?php
					$registerwithpass = get_option( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL );
					if ( 'yes' !== $registerwithpass ) {
						do_action( 'register_form' );
					}
					if ( 'yes' === $registerwithpass ) {
						?>
					<div class="form-row">
						<label id="password-label" class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>"><?php echo esc_attr( loginer_setting_options_group( LOGINER_PASSWORD_LABEL ) ? loginer_setting_options_group( LOGINER_PASSWORD_LABEL ) : __( 'Password', 'loginer' ) ); ?></label>
						<input name="password" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" type="password" id="password" value="" autocomplete="off" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_PASSWORD_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_PASSWORD_PLACEHOLDER ) : __( 'Password', 'loginer' ) ); ?>" />
						<span style="text-align:center; width:100%;" id="password-strength"></span>
					</div>
					<div class="form-row">
						<label id="confirm-password-label" class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>"><?php echo esc_attr( loginer_setting_options_group( LOGINER_CONFIRM_PASSWORD_LABEL ) ? loginer_setting_options_group( LOGINER_CONFIRM_PASSWORD_LABEL ) : __( 'Confirm Password', 'loginer' ) ); ?></label>
						<input type="password" id="conform_password" autocomplete="off" name="confirm_password" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_CONFIRM_PASSWORD_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_CONFIRM_PASSWORD_PLACEHOLDER ) : __( 'Confirm Password', 'loginer' ) ); ?>" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>"/>
					</div>
					<?php } ?>
					<p><?php esc_attr_e( 'Registration confirmation will be sent by email.', 'loginer' ); ?></p>
					<div class="form-row">
						<input type="submit" name="submit" class="button btn <?php echo esc_attr( loginer_setting_options_group( 'buttonclasses' ) ); ?>" value="<?php esc_attr_e( 'Register', 'loginer' ); ?>"/>
					</div>
				</form>
				<div class="form-margin-collepsed"> </div>
			</div>
		</div>
		<div id="lost-pass-form" class="custom-column-12 custom-options">
			<div class="custom-form">
				<form class="form <?php echo esc_attr( loginer_setting_options_group( 'formclasses' ) ); ?>">
					<h2 id="demo_lost_heading" class="<?php echo esc_attr( loginer_setting_options_group( 'headingclasses' ) ); ?>" ><?php echo esc_attr( loginer_setting_options_group( LOGINER_LOST_PASS_HEADING ) ? loginer_setting_options_group( LOGINER_LOST_PASS_HEADING ) : $GLOBALS[ LOGINER_DEFAULT_LOST_PASS ] ); ?></h2>
					<div class="form-margin-collepsed"> </div>
					<div class="form-row">
						<label class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>" id="useremail-label"> <?php echo esc_attr( $username ); ?></label>
						<input type="text" name="user_login" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" id="user_login" placeholder="<?php echo esc_attr( $placeholder ); ?>">
					</div>
					<div class="form-row">
						<input type="submit" name="submit" class="button btn <?php echo esc_attr( loginer_setting_options_group( 'buttonclasses' ) ); ?>" value="Reset Password"/>
					</div>
				</form>
				<div class="form-margin-collepsed"> </div>
			</div>
		</div>
		<div id="reset-pass-form" class="custom-column-12 custom-options">
			<div class="custom-form">
				<form class="form <?php echo esc_attr( loginer_setting_options_group( 'formclasses' ) ); ?>">
					<h2 id="demo_reset_heading" class="<?php echo esc_attr( loginer_setting_options_group( 'headingclasses' ) ); ?>" ><?php echo esc_attr( loginer_setting_options_group( LOGINER_RESET_PASS_HEADING ) ? loginer_setting_options_group( LOGINER_RESET_PASS_HEADING ) : $GLOBALS[ LOGINER_DEFAULT_RESET_PASS ] ); ?></h2>
					<div class="form-margin-collepsed"> </div>
					<div class="form-row">
						<label id="new-password-label" class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>"><?php echo esc_attr( loginer_setting_options_group( LOGINER_NEW_PASSWORD_LABEL ) ? loginer_setting_options_group( LOGINER_NEW_PASSWORD_LABEL ) : __( 'New Password', 'loginer' ) ); ?></label>
						<input type="password" id="new_pass" autocomplete="off" class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_NEW_PASSWORD_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_NEW_PASSWORD_PLACEHOLDER ) : __( 'New Password', 'loginer' ) ); ?>"/>
					</div>
					<div class="form-row">
						<label class="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>" id="repeat-new-password-label"><?php echo esc_attr( loginer_setting_options_group( 'repeat_new_password_label' ) ? loginer_setting_options_group( 'repeat_new_password_label' ) : __( 'Repeat New Password', 'loginer' ) ); ?></label>
						<input class="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>" type="password" id="repeat_new_pass" autocomplete="off" placeholder="<?php echo esc_attr( loginer_setting_options_group( LOGINER_CONFIRM_NEW_PASSWORD_PLACEHOLDER ) ? loginer_setting_options_group( LOGINER_CONFIRM_NEW_PASSWORD_PLACEHOLDER ) : __( 'Confirm New Password', 'loginer' ) ); ?>"/>
					</div>
					<div class="form-row">
						<p><?php echo esc_attr( wp_get_password_hint() ); ?></p>
					</div>
					<div class="form-row">
						<input type="submit" name="submit" id="resetpass-button" class="button btn <?php echo esc_attr( loginer_setting_options_group( 'buttonclasses' ) ); ?>" value="<?php esc_attr_e( 'Reset Password', 'loginer' ); ?>" /> 
					</div>
				</form>
				<div class="form-margin-collepsed"> </div>
			</div>
		</div>
	</div>
</div>
<?php
