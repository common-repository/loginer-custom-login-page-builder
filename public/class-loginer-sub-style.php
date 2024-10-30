<?php
/**
 * The core plugin class.
 *
 * Define the admin backend classes.
 * version of the plugin.
 *
 * @package    Loginer
 * @subpackage Loginer/includes
 * @since      1.0
 * @author     SofSter
 */

/** Addition class for styling option. */
class Loginer_Sub_Style {
	/** This Function get the custom css options */
	public function loginer_style_options() {
		$style_options = get_option( LOGINER_SETTING_OPTIONS_GROUP );
		if ( isset( $style_options['formstyle'] ) ) {
			$this->style_options = $style_options['formstyle'];
		}
	}

	/** This Function is for Input Box Styling */
	public function loginer_input_focus_style() {
		$input      = array( LOGINER_INPUT_FOCUS_BACKGROUND_COLOR, LOGINER_INPUT_FOCUS_COLOR, LOGINER_INPUT_FOCUS_BORDER_COLOR );
		$form_style = "\n.custom-form input:focus:not(.button):not([type=submit])
		{\n";
		foreach ( $input as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 12 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
			}
		}
		$form_style .= "\n}\n";
		return $form_style;
	}

	/** The Custom Css Entered By the User */
	public function loginer_user_custom_css() {
		$custom_css = get_option( LOGINER_SETTING_OPTIONS_GROUP );
		$form_style = '';
		if ( is_array( $custom_css ) && isset( $custom_css['customstyle']['customcss'] ) ) {
			$form_style = $custom_css['customstyle']['customcss'];
		}
		return $form_style;
	}
}
