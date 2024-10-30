<?php
/**
 * Contains the option functions
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @author     SofSter
 * @since      1.0
 *
 * @package    Loginer
 * @subpackage Loginer/admin/
 */

/**
 * This function adds Select Box For Font Options
 *
 * @param string $args The name of the setting option.
 */
function loginer_select_box_options( $args ) {
	$name = 'setting_options_group[' . esc_attr( 'formstyle' ) . '][' . esc_attr( $args ) . ']';
	echo "\n<select id='custom_form_" . esc_attr( $args ) . "' name='" . esc_attr( $name ) . "'>\n";
	$selected = loginer_setting_options_group( $args );
	echo "<option value='" . esc_attr( $selected ) . "'>" . esc_attr( $selected ) . "</option>\n";
	if ( strpos( $args, 'font_size' ) ) {
		for ( $i = 8; $i <= 72; $i < 12 ? $i++ : $i += 2 ) {
			if ( (string) $i !== $selected ) {
				echo "<option value='" . esc_attr( $i ) . "'>" . esc_attr( $i ) . "</option>\n";
			}
		}
	} else {
		for ( $i = 0; $i <= 10; $i++ ) {
			if ( (string) $i !== $selected ) {
				echo "<option value='" . esc_attr( $i ) . "'>" . esc_attr( $i ) . "</option>\n";
			}
		}
	}
	echo '</select>';
}

/**
 * This function adds Select Box For Border style
 *
 * @param string $args The name of the setting option.
 */
function loginer_border_style_selectbox( $args ) {
	$styles = array(
		'none'   => __( 'None', 'loginer' ),
		'solid'  => __( 'Solid', 'loginer' ),
		'double' => __( 'Double', 'loginer' ),
		'groove' => __( 'Groove', 'loginer' ),
	);
	echo "\n<select id='custom_form_" . esc_attr( $args ) . "' name='setting_options_group[formstyle][" . esc_attr( $args ) . "]'>\n";
		$selected = loginer_setting_options_group( $args );
		echo "<option value='" . esc_attr( $selected ) . "'>" . esc_attr( isset( $styles[ $selected ] ) ? $styles[ $selected ] : '' ) . "</option>\n";
	foreach ( $styles as $value => $option ) {
		if ( $value !== $selected ) {
			echo "<option value='" . esc_attr( $value ) . "'>" . esc_attr( $option ) . "</option>\n";
		}
	}
	echo '</select>';
}

/**
 * This function is used for Paragraph option Values.
 */
function loginer_paragraph_options() {
	$para_name        = __( 'Paragraph & Messages', 'loginer' );
	$para_options     = array(
		'color' => LOGINER_PARAGRAPH_COLOR,
		'font'  => LOGINER_PARAGRAPH_FONT_SIZE,
	);
	$options_values[] = $para_name;
	$options_values[] = $para_options;
	return $options_values;
}
/**
 * This function is used for Label option Values.
 */
function loginer_label_options() {
	$label_name       = __( 'Label', 'loginer' );
	$label_options    = array(
		'color' => LOGINER_LABEL_COLOR,
		'font'  => LOGINER_LABEL_FONT_SIZE,
	);
	$options_values[] = $label_name;
	$options_values[] = $label_options;
	return $options_values;
}

/**
 * This function is called On color.
 *
 * @param string $label name of the Input Label.
 *
 * @param string $field name of the Input Field.
 */
function loginer_color_options( $label, $field ) {
	echo "\n<table class='form-options'>\n";
	foreach ( $label as $ind => $color_val ) {
		$name = 'setting_options_group[' . esc_attr( 'formstyle' ) . '][' . esc_attr( $field[ $ind ] ) . ']';
		echo "<tr class='custom-sub-options-settings line'>\n";
			echo '<th><b>' . esc_attr( $color_val ) . '</b></th>';
			echo "<td><input type='text' class='login-color-picker' id='custom_form_" . esc_attr( $field[ $ind ] ) . "' name='" . esc_attr( $name ) . "' value='" . esc_attr( loginer_setting_options_group( $field[ $ind ] ) ) . "'></td>";
		echo "</tr>\n";
	}
	echo "</table>\n";
}

/**
 * This function is called On Heading, label, & Messages Settings.
 *
 * @param string $label name of the Input Label.
 *
 * @param string $field name of the Input Field.
 *
 * @param string $def_val contains Default Values.
 * @param string $section define the particular seciton of page.
 */
function loginer_text_settings( $label, $field, $def_val, $section ) {
	foreach ( $label as $ind => $label_val ) {
		$name = 'setting_options_group[' . esc_attr( $section ) . '][' . esc_attr( $field[ $ind ] ) . ']';
		echo "<div class='text-inputs'>\n";
			echo "<label class='heading'><b>" . esc_attr( $label_val ) . "</b></label>\n";
			echo "<input class='custom-heading-box' id='" . esc_attr( $field[ $ind ] ) . "' type='text' name='" . esc_attr( $name ) . "' value='" . esc_attr( loginer_setting_options_group( $field[ $ind ] ) ? loginer_setting_options_group( $field[ $ind ] ) : $def_val[ $ind ] ) . "'>\n";
		echo "</div>\n";
	}
}

/**
 * This function Returns the Value Of The Given Option
 *
 * @param string $option The name of the setting option.
 */
function loginer_setting_options_group( $option ) {
	$setting_options = get_option( LOGINER_SETTING_OPTIONS_GROUP );
	if ( is_array( $setting_options ) ) {
		foreach ( $setting_options as $section ) {
			if ( isset( $section[ $option ] ) ) {
				// sanitize text field values in array.
				return sanitize_text_field( $section[ $option ] );
			}
		}
	}
}

/** This Function contains the name and id values for Form Border options */
function loginer_form_border() {
	$loginer_form_border = array(
		'style'  => LOGINER_BORDER_STYLE,
		'radius' => LOGINER_BORDER_RADIUS,
		'width'  => LOGINER_BORDER_WIDTH,
		'color'  => LOGINER_BORDER_COLOR,
	);
	return $loginer_form_border;
}
/** This Function contains the name and id values for Form Margin options */
function loginer_form_margin() {
	$loginer_form_mar = array(
		'heading'   => __( 'Margin', 'loginer' ),
		'button_id' => 'form-margin',
		'top'       => LOGINER_MARGIN_TOP,
		'right'     => LOGINER_MARGIN_RIGHT,
		'bottom'    => LOGINER_MARGIN_BOTTOM,
		'left'      => LOGINER_MARGIN_LEFT,
	);
	return $loginer_form_mar;
}
/** This Function contains the name and id values for Form Padding options */
function loginer_form_padding() {
	$loginer_form_pad = array(
		'heading'   => __( 'Padding', 'loginer' ),
		'button_id' => 'form-padding',
		'top'       => LOGINER_PADDING_TOP,
		'right'     => LOGINER_PADDING_RIGHT,
		'bottom'    => LOGINER_PADDING_BOTTOM,
		'left'      => LOGINER_PADDING_LEFT,
	);
	return $loginer_form_pad;
}
/** This Function contains the name and id values for Heading Border options */
function loginer_heading_border() {
	$loginer_heading_bor = array(
		'style'  => LOGINER_HEADING_BORDER_STYLE,
		'radius' => LOGINER_HEADING_BORDER_RADIUS,
		'width'  => LOGINER_HEADING_BORDER_WIDTH,
		'color'  => LOGINER_HEADING_BORDER_COLOR,
	);
	return $loginer_heading_bor;
}
/** This Function contains the name and id values for Heading Margin options */
function loginer_heading_margin() {
	$loginer_heading_mar = array(
		'heading'   => __( 'Margin', 'loginer' ),
		'button_id' => 'heading-margin',
		'top'       => LOGINER_HEADING_MARGIN_TOP,
		'right'     => LOGINER_HEADING_MARGIN_RIGHT,
		'bottom'    => LOGINER_HEADING_MARGIN_BOTTOM,
		'left'      => LOGINER_HEADING_MARGIN_LEFT,
	);
	return $loginer_heading_mar;
}
/** This Function contains the name and id values for Heading Padding options */
function loginer_heading_padding() {
	$loginer_heading_pad = array(
		'heading'   => __( 'Padding', 'loginer' ),
		'button_id' => 'heading-padding',
		'top'       => LOGINER_HEADING_PADDING_TOP,
		'right'     => LOGINER_HEADING_PADDING_RIGHT,
		'bottom'    => LOGINER_HEADING_PADDING_BOTTOM,
		'left'      => LOGINER_HEADING_PADDING_LEFT,
	);
	return $loginer_heading_pad;
}
/** This Function contains the name and id values for Button Border options */
function loginer_button_border() {
	$loginer_button_bor = array(
		'style'  => LOGINER_BUTTON_BORDER_STYLE,
		'radius' => LOGINER_BUTTON_BORDER_RADIUS,
		'width'  => LOGINER_BUTTON_BORDER_WIDTH,
		'color'  => LOGINER_BUTTON_BORDER_COLOR,
	);
	return $loginer_button_bor;
}
/** This Function contains the name and id values for Input Border options */
function loginer_input_border() {
	$loginer_input_border = array(
		'style'  => LOGINER_INPUT_BORDER_STYLE,
		'radius' => LOGINER_INPUT_BORDER_RADIUS,
		'width'  => LOGINER_INPUT_BORDER_WIDTH,
		'color'  => LOGINER_INPUT_BORDER_COLOR,
	);
	return $loginer_input_border;
}
