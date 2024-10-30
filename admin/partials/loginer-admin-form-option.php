<?php
/**
 * Provide an admin area view for the form options
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @package Loginer
 * @subpackage Loginer/admin/partial
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

/** This File Contains Option Functions */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'option-functions.php';
// Section array.
$this->sections = array(
	'headings'    => __( 'Form Heading', 'loginer' ),
	'labels'      => __( 'Labels', 'loginer' ),
	'errormsg'    => __( 'Error / Success Messages', 'loginer' ),
	'placeholder' => __( 'Placeholders', 'loginer' ),
	'formstyle'   => __( 'Form Styles', 'loginer' ),
	'customstyle' => __( 'HTML Classes', 'loginer' ),
);
?>
<div class="wrap">
	<h1><?php esc_attr_e( 'Loginer Setting Options', 'loginer' ); ?></h1>
</div><br/>
<div id="form-style-options">
	<form id="form-settings" method="post" action="options.php" autocomplete="off">
		<?php settings_errors(); ?>
		<?php settings_fields( LOGINER_SETTING_OPTIONS_GROUP ); ?>
		<?php do_settings_sections( __FILE__ ); ?>
		<div id="login-form-tabs" class="ui-tabs ui-corner-all ui-widget ui-widget-content">
		<div class="tab-section">
			<ul class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" id ='tabs'>
				<?php
				foreach ( $this->sections as $section_slug => $section ) {
					echo '<li class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"><a title ="' . esc_attr( $section_slug ) . '" href="#' . esc_attr( $section_slug ) . '" class="ui-tabs-anchor">';
					echo esc_attr( $section );
					echo '</a></li>';
				}
				?>
			</ul>
			</div>
			<div class="content-section">
			<div id="headings" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<div class='outer'>
				<div class="tab-desc"><p> <?php esc_attr_e( 'Give a suitable form heading.', 'loginer' ); ?></p></div>
				<div class="form-options">
					<input type='checkbox' id='custom_show_page_title' name='custom_show_page_title' value='yes';
					<?php checked( 'yes', get_option( LOGINER_CUSTOM_SHOW_PAGE_TITLE ), true ); ?>>
					<label class='heading'>
					<b><?php esc_attr_e( 'Show Form Title', 'loginer' ); ?></b></label>
				</div>
					<?php
					$heading_label = array( __( 'Sign In', 'loginer' ), __( 'Registration', 'loginer' ), __( 'Forgot Password', 'loginer' ), __( 'Reset Password', 'loginer' ), __( 'Profile', 'loginer' ) );
					$heading_field = array( LOGINER_LOGIN_HEADING, LOGINER_REGISTER_HEADING, LOGINER_LOST_PASS_HEADING, LOGINER_RESET_PASS_HEADING, LOGINER_ACCOUNT_HEADING );
					$def_headings  = array( $GLOBALS[ LOGINER_DEFAULT_LOGIN ], $GLOBALS[ LOGINER_DEFAULT_REGISTER ], $GLOBALS[ LOGINER_DEFAULT_LOST_PASS ], $GLOBALS[ LOGINER_DEFAULT_RESET_PASS ], $GLOBALS[ LOGINER_DEFAULT_ACCOUNT ] );
					loginer_text_settings( $heading_label, $heading_field, $def_headings, 'headings' );
					?>
				</div>
			</div>
			<div id="labels" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<div class='outer'>
				<div class="tab-desc"><p><?php esc_attr_e( 'You can change labels to be shown on your form.', 'loginer' ); ?></p></div>
					<?php
					$labels_label = array( __( 'Email or Username', 'loginer' ), __( 'Username', 'loginer' ), __( 'Email', 'loginer' ), __( 'Password', 'loginer' ), __( 'Confirm Password', 'loginer' ), __( 'New Password', 'loginer' ), __( 'Repeat New Password', 'loginer' ) );
					$labels_field = array( LOGINER_EMAILUSER_LABEL, LOGINER_USERNAME_LABEL, LOGINER_EMAIL_LABEL, LOGINER_PASSWORD_LABEL, LOGINER_CONFIRM_PASSWORD_LABEL, LOGINER_NEW_PASSWORD_LABEL, LOGINER_REPEAT_NEW_PASSWORD_LABEL );
					loginer_text_settings( $labels_label, $labels_field, $labels_label, 'labels' );
					?>
				</div>
			</div>
			<div id="errormsg" class="ui-tabs-panel ui-corner-bottom ui-widget-content"> 
				<div class='outer'>
				<div class="tab-desc"><p><?php esc_attr_e( 'You can change the error/success messages that are shown on the form submission.', 'loginer' ); ?></p></div>
					<h2><?php echo esc_attr__( 'Error Messages', 'loginer' ); ?></h2>
					<?php
					$error_label   = array( __( 'Already Loggedin', 'loginer' ), __( 'Empty Username', 'loginer' ), __( 'Empty Password', 'loginer' ), __( 'Invalid Username', 'loginer' ), __( 'Invalid Email', 'loginer' ), __( 'No User Registered', 'loginer' ), __( 'Incorrect Password', 'loginer' ), __( 'User Already Exists', 'loginer' ), __( 'Email Already Exists', 'loginer' ), __( 'Registration Closed', 'loginer' ), __( 'Expired Password Reset URL', 'loginer' ), __( 'Invalid Password Reset URL', 'loginer' ), __( 'Password and Confirm Password doesn\'t Match', 'loginer' ) );
					$error_field   = array( LOGINER_ALREADY_LOGGEDIN, LOGINER_EMPTY_USERNAME, LOGINER_EMPTY_PASSWORD, LOGINER_INVALID_USERNAME, LOGINER_INVALID_EMAIL, LOGINER_INVALIDCOMBO, LOGINER_INCORRECT_PASSWORD, LOGINER_USER_EXISTS, LOGINER_EMAIL_EXISTS, LOGINER_REGISTERATION_CLOSED, LOGINER_EXPIRED_KEY, LOGINER_INVALID_KEY, LOGINER_PASSWORD_MISMATCH );
					$default_error = array( $GLOBALS[ LOGINER_DEFAULT_LOGGEDIN ], $GLOBALS[ LOGINER_DEFAULT_EMPTY_UNAME ], $GLOBALS[ LOGINER_DEFAULT_EMPTY_PASS ], $GLOBALS[ LOGINER_DEFAULT_INVAL_UNAME ], $GLOBALS[ LOGINER_DEFAULT_INVAL_EMAIL ], $GLOBALS[ LOGINER_DEFAULT_INVAL_COMBO ], $GLOBALS[ LOGINER_DEFAULT_WRONG_PASS ], $GLOBALS[ LOGINER_DEFAULT_USER_EXISTS ], $GLOBALS[ LOGINER_DEFAULT_EMAIL_EXISTS ], $GLOBALS[ LOGINER_DEFAULT_REG_CLOSED ], $GLOBALS[ LOGINER_DEFAULT_EXPIRED_KEY ], $GLOBALS[ LOGINER_DEFAULT_INVALID_KEY ], $GLOBALS[ LOGINER_DEFAULT_PASS_NOMATCH ] );
					loginer_text_settings( $error_label, $error_field, $default_error, 'errormsg' );
					?>
					<h2><?php echo esc_attr__( 'Success Messages', 'loginer' ); ?></h2>
					<?php
					$error_label   = array( __( 'Logged Out', 'loginer' ), __( 'Registered', 'loginer' ), __( 'Password Link Sent', 'loginer' ), __( 'Password Reset', 'loginer' ) );
					$error_field   = array( LOGINER_LOGGED_OUT, LOGINER_REGISTERED, LOGINER_LOSTPASSWORD, LOGINER_RESET_PASSWORD );
					$default_error = array( $GLOBALS[ LOGINER_DEFAULT_LOGGED_OUT ], $GLOBALS[ LOGINER_DEFAULT_REGISTERED ], $GLOBALS[ LOGINER_DEFAULT_LOSTPASSWORD ], $GLOBALS[ LOGINER_DEFAULT_RESET_PASSWORD ] );
					loginer_text_settings( $error_label, $error_field, $default_error, 'errormsg' );
					?>
				</div>
			</div>
			<div id="placeholder" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<div class='outer'>
				<div class="tab-desc"><p><?php esc_attr_e( 'You can change the placeholder values.', 'loginer' ); ?></p></div>
					<?php
					$place_label = array( __( 'Email or Username', 'loginer' ), __( 'Email', 'loginer' ), __( 'Username', 'loginer' ), __( 'Password', 'loginer' ), __( 'Confirm Password', 'loginer' ), __( 'New Password', 'loginer' ), __( 'Confirm New Password', 'loginer' ) );
					$place_field = array( LOGINER_EMAILUSER_PLACE, LOGINER_EMAIL_PLACEHOLDER, LOGINER_USERNAME_PLACEHOLDER, LOGINER_PASSWORD_PLACEHOLDER, LOGINER_CONFIRM_PASSWORD_PLACEHOLDER, LOGINER_NEW_PASSWORD_PLACEHOLDER, LOGINER_CONFIRM_NEW_PASSWORD_PLACEHOLDER );
					loginer_text_settings( $place_label, $place_field, $place_label, 'placeholder' );
					?>
				</div>
			</div>
			<div id="formstyle" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<div class="outer">	
				<div class="tab-desc"><p><?php esc_attr_e( 'You can personalize your login page/form with matching colors, fonts, and effects same as your theme.', 'loginer' ); ?></p></div>
				<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Form', 'loginer' ); ?></b>
						<?php echo '<span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>'; ?>
						<?php echo '<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>'; ?>
						</label>
						<div class='panel'>
							<table class="form-options">
								<tr class="custom-sub-options-settings">
									<th><b><?php esc_attr_e( 'Background Color', 'loginer' ); ?></b></th>
									<td> <input type="text" class="login-color-picker" id="custom_form_background_color" name="setting_options_group[formstyle][<?php echo esc_attr( LOGINER_BACKGROUND_COLOR ); ?>]" value="<?php echo esc_attr( loginer_setting_options_group( LOGINER_BACKGROUND_COLOR ) ); ?>"> </td>
								</tr>
								<?php
								$args = loginer_form_border();
								require plugin_dir_path( __FILE__ ) . 'border-options.php';
								?>
								<tr>
									<th colspan="2"><b><?php esc_attr_e( 'Shadow', 'loginer' ); ?></b></th>
								</tr>
								<tr class="custom-sub-options-settings">
									<th class="subheadings"><?php esc_attr_e( 'Enable Shadow', 'loginer' ); ?></th>
									<td> <input type="checkbox" id="custom_form_shadow_enable" name="setting_options_group[formstyle][<?php echo esc_attr( LOGINER_SHADOW_ENABLE ); ?>]" value="yes" <?php echo esc_attr( loginer_setting_options_group( LOGINER_SHADOW_ENABLE ) === 'yes' ) ? 'checked' : ''; ?>> </td>
								</tr>
								<tr class="custom-sub-options-settings" id="shadow-color">
									<th><b><?php esc_attr_e( 'Color', 'loginer' ); ?></b></th>
									<td> <input type="text" id="custom_form_shadow_color" class="login-color-picker" name="setting_options_group[formstyle][<?php echo esc_attr( LOGINER_SHADOW_COLOR ); ?>]" value="<?php echo esc_attr( loginer_setting_options_group( LOGINER_SHADOW_COLOR ) ); ?>"> </td>
								</tr>
							</table>
							<?php
							$args = loginer_form_margin();
							require plugin_dir_path( __FILE__ ) . 'margin-padding-options.php';
							$args = loginer_form_padding();
							require plugin_dir_path( __FILE__ ) . 'margin-padding-options.php';
							?>
						</div>
						</div>
						<div class="custom-blocks close">
						<?php echo '<label class="heading login-accordion"><b>'; ?>
						<?php esc_attr_e( 'Input Box', 'loginer' ); ?>
						<?php echo '</b>'; ?>
						<?php echo '<span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>'; ?>
						<?php echo '<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>'; ?>
						</label>
						<div class='panel'>
						<?php echo '<table class="form-options">'; ?> 
								<tr class="custom-sub-options-settings">
									<th><b><?php esc_attr_e( 'Font Size', 'loginer' ); ?></b></th>
									<td> <?php loginer_select_box_options( LOGINER_INPUT_FONT_SIZE ); ?> </td>
								</tr>
							</table>
						<table class="form-options">
							<?php
							$input_label = array( __( 'Background Color', 'loginer' ), __( 'Font Color', 'loginer' ) );
							$input_field = array( LOGINER_INPUT_BACKGROUND_COLOR, LOGINER_INPUT_COLOR );
							loginer_color_options( $input_label, $input_field );
							$input_label = array( __( 'Focus Background Color', 'loginer' ), __( 'Focus Text Color', 'loginer' ), __( 'Focus Border Color', 'loginer' ) );
							$input_field = array( LOGINER_INPUT_FOCUS_BACKGROUND_COLOR, LOGINER_INPUT_FOCUS_COLOR, LOGINER_INPUT_FOCUS_BORDER_COLOR );
							loginer_color_options( $input_label, $input_field );
							?>
							<table class="form-options">
								<?php
								$args = loginer_input_border();
								require plugin_dir_path( __FILE__ ) . 'border-options.php';
								?>
								<tr class="custom-sub-options-settings">
									<th><b><?php esc_attr_e( 'Only Bottom Border', 'loginer' ); ?></b></th>
									<td> <input type="checkbox" id="custom_form_input_bottom_border" name="setting_options_group[formstyle][<?php echo esc_attr( LOGINER_INPUT_BOTTOM_BORDER ); ?>]" value="yes" <?php echo esc_attr( loginer_setting_options_group( 'formstyle', LOGINER_INPUT_BOTTOM_BORDER ) === 'yes' ) ? 'checked' : ''; ?>> </td>
								</tr>
							</table>
						</div>
						</div>
						<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Paragraph, Messages & Label', 'loginer' ); ?></b>
						<?php echo '<span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>'; ?>
						<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>
						</label>
						<div class='panel'>
							<?php
							list( $label, $field) = loginer_paragraph_options();
							?>
							<table class="form-options">
								<tr>
							<?php
							require plugin_dir_path( __FILE__ ) . 'paragraph-label-options.php';
							list( $label, $field) = loginer_label_options();
							?>
							<tr class="line">
							<?php
							require plugin_dir_path( __FILE__ ) . 'paragraph-label-options.php';
							?>
							</tr>
						</table>
						</div>
						<div>
					</div>
					</div>
					<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Heading', 'loginer' ); ?></b><span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>
						<?php echo '<span id="arrowup" class="dashicons dashicons-arrow-down-alt2 right"></span>'; ?>
						</label>
						<div class='panel'>

						<table class="form-options">
						<tr> </tr>
								<tr class="custom-sub-options-settings">
									<th><b><?php esc_attr_e( 'Font Size', 'loginer' ); ?></b></th>
									<td> <?php loginer_select_box_options( LOGINER_HEADING_FONT_SIZE ); ?> </td>
								</tr>
						</table>
							<?php
							$heading_label = array(
								__( 'Background Color', 'loginer' ),
								__( 'Font Color', 'loginer' ),
							);
							$heading_field = array( LOGINER_HEADING_BACKGROUND_COLOR, LOGINER_HEADING_COLOR );
							loginer_color_options( $heading_label, $heading_field );
							?>
							<table class="form-options">
							<?php
							$args = loginer_heading_border();
							require plugin_dir_path( __FILE__ ) . 'border-options.php';

							$args = loginer_heading_margin();
							require plugin_dir_path( __FILE__ ) . 'margin-padding-options.php';
							$args = loginer_heading_padding();
							require plugin_dir_path( __FILE__ ) . 'margin-padding-options.php';
							?>
						</div>
						</div>
						<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Button', 'loginer' ); ?></b><span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>
						<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>
						<?php echo '</label>'; ?>
						<div class='panel'>
						<table class="form-options">
								<?php echo '<tr class="custom-sub-options-settings">'; ?>
									<th><b><?php esc_attr_e( 'Font Size', 'loginer' ); ?></b></th>

									<td> <?php loginer_select_box_options( LOGINER_BUTTON_FONT_SIZE ); ?> </td>
								</tr>
								<tr> </tr>
							</table>
							<?php
							$button_label = array( __( 'Background Color', 'loginer' ), __( 'Font Color', 'loginer' ), __( 'Hover Background Color', 'loginer' ), __( 'Hover Font Color', 'loginer' ) );
							$button_field = array( LOGINER_BUTTON_BACKGROUND_COLOR, LOGINER_BUTTON_COLOR, LOGINER_BUTTON_HOVER_BACKGROUND_COLOR, LOGINER_BUTTON_HOVER_COLOR );
							loginer_color_options( $button_label, $button_field );
							?>
							<table class="form-options">
								<?php
								$args = loginer_button_border();
								require plugin_dir_path( __FILE__ ) . 'border-options.php';
								?>
							</table>
						</div>
						</div>
						<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Link', 'loginer' ); ?></b>
						<span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>
						<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>
						</label>
						<div class='panel'>
							<?php echo '<table class="form-options">'; ?>
							<tr> </tr>
								<tr class="custom-sub-options-settings">
									<th><b><?php esc_attr_e( 'Font Size', 'loginer' ); ?></b></th>
									<td><?php loginer_select_box_options( LOGINER_LINK_FONT_SIZE ); ?></td>
								</tr>
							<?php echo '</table>'; ?>
							<?php
							$link_label = array( __( 'Font Color', 'loginer' ), __( 'Hover Font Color', 'loginer' ) );
							$link_field = array( LOGINER_LINK_COLOR, LOGINER_LINK_HOVER_COLOR );
							loginer_color_options( $link_label, $link_field );
							?>
						</div>
						</div>
						<div class="custom-blocks close">
						<label class="heading login-accordion"><b><?php esc_attr_e( 'Required Field', 'loginer' ); ?></b><span id="arrowdown" class="dashicons dashicons-arrow-up-alt2 right"></span>
						<span id="arrowup"class="dashicons dashicons-arrow-down-alt2 right"></span>
						</label>
						<div class='panel'>
							<table class="form-options">
								<tr class="custom-sub-options-settings">
									<th class="heading"><b><?php esc_attr_e( 'Color', 'loginer' ); ?></b></th>
									<td> <input type="text" id="custom_requiredfield_color" class="login-color-picker" name="setting_options_group[formstyle][<?php echo esc_attr( LOGINER_REQUIREDFIELD_COLOR ); ?>]" value="<?php echo esc_attr( loginer_setting_options_group( LOGINER_REQUIREDFIELD_COLOR ) ); ?>"> </td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="customstyle" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<?php require_once plugin_dir_path( __FILE__ ) . 'add-class.php'; ?>
			</div>
			</div>
		</div>
		<div class="buttons_area">
		<?php submit_button(); ?>
				<p class="reset_allign">
				<input id="reset_button" name="reset_button" class="button" type="button" value="<?php esc_attr_e( 'Reset All Changes', 'loginer' ); ?>">
				</p>
		</div>
		</form>
</div>
<?php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials' . DIRECTORY_SEPARATOR . 'demo-forms.php';
