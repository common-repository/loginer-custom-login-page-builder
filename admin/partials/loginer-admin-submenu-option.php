<?php
/**
 * Provide an html of submenu in admin area.
 *
 * @package Loginer
 * @subpackage Loginer/admin/partial
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

/** This File Contains Submenu Callback. */

$this->submenu_sections = array(
	'setting'     => __( 'General', 'loginer' ),
	'pluginpages' => __( 'Pages', 'loginer' ),

);
?>
<div class="wrap">
	<h1><?php esc_attr_e( 'Settings', 'loginer' ); ?></h1>
</div><br/>
<div class="submenustyle">
<form method="post" action="options.php">
<?php settings_errors(); ?>
			<?php settings_fields( LOGINER_SUBMENU_SETTING_GROUP ); ?>
			<?php do_settings_sections( __FILE__ . '/setting' ); ?>
			<div id="login-form-submenu-tabs" class="ui-tabs ui-corner-all ui-widget ui-widget-content">
			<div class="submenu-tab-section">
			<ul class="ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header" id ='tabs'>
				<?php
				foreach ( $this->submenu_sections as $section_slug => $submenu_section ) {
					echo '<li class="ui-tabs-tab ui-corner-top ui-state-default ui-tab"><a title ="' . esc_attr( $submenu_section ) . '" href="#' . esc_attr( $section_slug ) . '" class="ui-tabs-anchor">';
					echo esc_attr( $submenu_section );
					echo '</a></li>';
				}
				?>
			</ul>
			</div>
			<div class="submenu-content-section">
			<div id="pluginpages" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
				<div class='submenu-outer'>
				<div class="tab-desc"><p> <?php esc_attr_e( 'You can select the pages where you want to show Login/Registration form.', 'loginer' ); ?></p></div>
					<?php
					$pages_label = array( __( 'Sign in', 'loginer' ), __( 'Profile', 'loginer' ), __( 'Registration', 'loginer' ), __( 'Forgot Password', 'loginer' ), __( 'Reset Password', 'loginer' ) );
					$keys        = array( 'Sign in', 'Profile', 'Registration', 'Forgot Password', 'Reset Password' );
					loginer_pluginpages( $pages_label, 'pluginpages', $keys );
					?>
				</div>
			</div>
		<div id="setting" class="ui-tabs-panel ui-corner-bottom ui-widget-content">
		<div class='submenu-outer'>
		<div class="tab-desc"><p> <?php esc_attr_e( 'Select the role that you want to restrict from Dashboard', 'loginer' ); ?></p></div>
		<b>
		<?php esc_attr_e( 'Restrict User From Dashboard', 'loginer' ); ?></b>
			</label>
			<div class='password-options'>
				<?php
				$restricted_role = get_option( LOGINER_RESTRICTED_ROLE ) ? get_option( LOGINER_RESTRICTED_ROLE ) : array();
				// print the full list of roles with the primary one selected.
				echo "<table>\n";
				if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
					$def_restricted_role = array( 'subscriber', 'customer' );
					$new_restricted_role = array_merge( $restricted_role, $def_restricted_role );
					update_option( LOGINER_RESTRICTED_ROLE, $new_restricted_role );
				}
				foreach ( wp_roles()->role_names as $rolekey => $user_role ) {
					if ( 'administrator' !== $rolekey ) {
						?>
				<tr>
						<?php
						if ( is_plugin_active( 'woocommerce/woocommerce.php' ) && ( 'subscriber' === $rolekey || 'customer' === $rolekey ) ) {
							echo "<td><input type='checkbox' disabled value='" . esc_attr( $rolekey ) . "' checked name='restricted_role[]'  id='restricted_role[]'/></td>\n";
						} elseif ( in_array( $rolekey, $restricted_role, true ) ) {
							echo "<td><input type='checkbox' value='" . esc_attr( $rolekey ) . "' checked name='restricted_role[]'  id='restricted_role[]'/></td>\n";
						} else {
							echo "<td><input type='checkbox' value='" . esc_attr( $rolekey ) . "' name='restricted_role[]'  id='restricted_role[]'/></td>\n";
						}
						echo '<td>' . esc_attr( $user_role ) . "</td></tr>\n";
					}
				}
				?>
			</table></div>
			<div class="tab-desc">	<?php esc_attr_e( 'Select to show/hide password fields in the registration form', 'loginer' ); ?></p></div>
			<label class='heading'><b>
			<?php esc_attr_e( 'Password Field', 'loginer' ); ?>
		</b></label>
		<?php
			$pass_label = array( __( 'Show Password fields in Registration Form', 'loginer' ), __( 'Add Password Strength Meter', 'loginer' ) );
			$pass_cbox  = array( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER );
			loginer_pass_options( $pass_label, $pass_cbox );
		?>
			<div class="tab-desc">	<?php esc_attr_e( 'Set the minimum required password strength.', 'loginer' ); ?></p></div>

			<?php
			echo "<label class='heading'><b>";
			esc_attr_e( 'Choose Minimum Strength', 'loginer' );
			?>
			</b></label>
			<?php
			$pass_cbox  = array( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_BAD, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_GOOD, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_STRONG );
			$pass_label = array( __( 'Short', 'loginer' ), __( 'Bad', 'loginer' ), __( 'Good', 'loginer' ), __( 'Strong', 'loginer' ) );
			loginer_pass_strenght_options( $pass_label, $pass_cbox );
			?>
			</div>
			</div>
		</div>
			</div>
		<div class= "buttons_area">
		<?php submit_button(); ?>
		</div>

</form>
			</div>
<?php

	/**
	 * This function adds Select Box For Variuos Options
	 *
	 * @param string $pass_label name of Label.
	 *
	 * @param string $pass_cbox name of Checkbox Input.
	 */
function loginer_pass_options( $pass_label, $pass_cbox ) {
	echo "<div class='password-options'>\n";
	foreach ( $pass_label as $ind => $pass_val ) {
		if ( 'yes' === get_option( $pass_cbox[ $ind ] ) ) {
			echo "<input type='checkbox' id='" . esc_attr( $pass_cbox[ $ind ] ) . "' name='" . esc_attr( $pass_cbox[ $ind ] ) . "' value='yes' checked />\n";
		} else {
			echo "<input type='checkbox' id='" . esc_attr( $pass_cbox[ $ind ] ) . "' name='" . esc_attr( $pass_cbox[ $ind ] ) . "' value='yes'/>\n";
		}
		echo "<label class='heading'>" . esc_attr( $pass_val ) . "</label><br/>\n";
	}
	echo "</div>\n";
}

	/**
	 * This function adds Select Box For Variuos Options
	 *
	 * @param string $pass_label name of Label.
	 *
	 * @param string $pass_radio_option name of Checkbox Input.
	 */
function loginer_pass_strenght_options( $pass_label, $pass_radio_option ) {
	echo "<div class='password-options'>\n";
	foreach ( $pass_label as $ind => $pass_val ) {
		?>
			<input type='radio' id='<?php echo esc_attr( $pass_radio_option[ $ind ] ); ?>'  name='<?php echo esc_attr( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT ); ?>' value='<?php echo esc_attr( $pass_radio_option[ $ind ] ); ?>' <?php checked( esc_attr( $pass_radio_option[ $ind ] ), get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT ), true ); ?> />
			<?php
			echo "<label class='heading'>" . esc_attr( $pass_val ) . "</label><br/>\n";
	}
	echo "</div>\n";
}
	/**
	 * This function is called On Heading.
	 *
	 * @param string $label name of the Label and dropdown for pages list.
	 * @param string $section name of the page section.
	 * @param string $keys pages key in.
	 */
function loginer_pluginpages( $label, $section, $keys ) {
	foreach ( $label  as $index => $label_val ) {
		$name = 'submenu_setting_group[' . esc_attr( $section ) . '][' . $keys[ $index ] . ']';
		$p_id = str_replace( ' ', '_', $keys[ $index ] );
		echo "\n<div class='text-inputs'>
 			<label class='heading'><b>" . esc_attr( $label_val ) . "</b></label>
			<p>\n";
			$get_pages = get_pages();
			echo "<select id='" . esc_attr( $p_id ) . "' name='" . esc_attr( $name ) . "' class='pages-select-box'>";
			$selected = loginer_submenu_setting_group( $section, $keys[ $index ] );
			echo "<option value='" . esc_attr( $selected ) . "'>" . esc_attr( get_the_title( $selected ) ) . '</option>';
		foreach ( $get_pages as $pluginpage ) {
			$current_id = (string) $pluginpage->ID;
			if ( $current_id !== $selected ) {
				echo "<option value='" . esc_attr( $pluginpage->ID ) . "'>" . esc_attr( $pluginpage->post_title ) . '</option>';
			}
		}
			echo '</select>
			</p>
		</div>';
	}
}

/**
 * This function Returns the Value Of The Given Option
 *
 * @param string $section get the particular section option form array.
 * @param string $option The name of the setting option present in database.
 */
function loginer_submenu_setting_group( $section, $option ) {
	$setting_options = get_option( LOGINER_SUBMENU_SETTING_GROUP );
	if ( isset( $setting_options[ $section ] [ $option ] ) ) {
		// sanitize text field values in array.
		return sanitize_text_field( $setting_options [ $section ] [ $option ] );
	}
}
