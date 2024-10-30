<?php
/**
 * Fired during plugin activation
 *
 * @since      1.0
 *
 * @package    Loginer
 * @subpackage Loginer/includes
 */

if ( ! class_exists( 'Loginer_Sub_Style' ) ) {
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-sub-style.php';
}

/** Handele the styling in head tag. */
class Loginer_Style extends Loginer_Sub_Style {

	/**
	 * This Function puts the styling on the head tag of form page.
	 *
	 * @since 1.0.0
	 */
	public function loginer_custom_style() {
		$this->loginer_style_options();
		echo "<style>\n";
		$style  = $this->loginer_form_style();
		$style .= $this->loginer_head_para_style();
		$style .= $this->loginer_label_anchor_style();
		$style .= $this->loginer_button_style();
		$style .= $this->loginer_input_style();
		$style .= $this->loginer_input_focus_style();
		$style .= $this->loginer_user_custom_css();
		echo esc_attr( $style );
		echo "\n</style>\n";
		return $style;
	}
	/** This Function is for Form Styling  */
	private function loginer_form_style() {
		$form       = array( LOGINER_BACKGROUND_COLOR, LOGINER_BORDER_STYLE, LOGINER_BORDER_COLOR, LOGINER_BORDER_WIDTH, LOGINER_BORDER_RADIUS, LOGINER_MARGIN_TOP, LOGINER_MARGIN_RIGHT, LOGINER_MARGIN_BOTTOM, LOGINER_MARGIN_LEFT, LOGINER_PADDING_TOP, LOGINER_PADDING_BOTTOM, LOGINER_PADDING_LEFT, LOGINER_PADDING_RIGHT );
		$form_style = '.custom-form form, .entry .custom-form form, .entry-content .custom-form form,  article.entry .entry-content .custom-form form, article.hentry .entry-content .custom-form form
		{
			width : auto;' . "\n";
		foreach ( $form as $value ) {
			if ( isset( $this->style_options[ $value ] ) && '' !== $this->style_options[ $value ] ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', $value ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px; \n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', $value ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		if ( ! empty( $this->style_options[ LOGINER_SHADOW_COLOR ] ) ) {
			$form_style .= 'box-shadow : 0px 10px 50px 0px ' . esc_attr( $this->style_options[ LOGINER_SHADOW_COLOR ] ) . ';';
		}
			$form_style .= "\n}\n";
		if ( ! empty( $this->style_options[ LOGINER_REQUIREDFIELD_COLOR ] ) ) {
			$form_style .= "\n.custom_required_Color {
				color :" . esc_attr( $this->style_options[ LOGINER_REQUIREDFIELD_COLOR ] ) .
				"\n}\n";
		}
		return $form_style;
	}
	/** This Function is for Heading And Paragraph Styling  */
	private function loginer_head_para_style() {
		$paragraph   = array( LOGINER_PARAGRAPH_COLOR, LOGINER_PARAGRAPH_FONT_SIZE );
		$heading_tag = array( LOGINER_HEADING_COLOR, LOGINER_HEADING_BORDER_COLOR, LOGINER_HEADING_BORDER_STYLE, LOGINER_HEADING_BORDER_WIDTH, LOGINER_HEADING_BORDER_RADIUS, LOGINER_HEADING_MARGIN_TOP, LOGINER_HEADING_MARGIN_RIGHT, LOGINER_HEADING_MARGIN_BOTTOM, LOGINER_HEADING_MARGIN_LEFT, LOGINER_HEADING_PADDING_TOP, LOGINER_HEADING_PADDING_RIGHT, LOGINER_HEADING_PADDING_BOTTOM, LOGINER_HEADING_PADDING_LEFT, LOGINER_HEADING_FONT_SIZE, LOGINER_HEADING_BACKGROUND_COLOR );
		$form_style  = "\n.custom-form h2, .entry .custom-form h2, article.entry .entry-content .custom-form h2, article.hentry .entry-content .custom-form h2
		{\n";
		foreach ( $heading_tag as $value ) {
			if ( isset( $this->style_options[ $value ] ) && '' !== $this->style_options[ $value ] ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 8 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 8 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
			$form_style .= "\n}
			.custom-form p
			{\n";
		foreach ( $paragraph as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 10 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 10 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
			$form_style .= "\n}\n";
			return $form_style;
	}
	/** This Function is for Label And Anchor Styling  */
	private function loginer_label_anchor_style() {
		$label      = array( LOGINER_LABEL_COLOR, LOGINER_LABEL_FONT_SIZE );
		$anchor     = array( LOGINER_LINK_COLOR, LOGINER_LINK_FONT_SIZE );
		$form_style = ".custom-form label
		{\n";
		foreach ( $label as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', ltrim( $value, 'label_' ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', ltrim( $value, 'label_' ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		$form_style .= "\n}
		.custom-form a
		{\n";
		foreach ( $anchor as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 5 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 5 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		$form_style .= "\n}";
		if ( isset( $this->style_options['link_hover_color'] ) ) {
			$form_style .= '.custom-form a:hover
			{
				color :' . esc_attr( $this->style_options['link_hover_color'] ) . ";
			}\n";
		}
		return $form_style;
	}
	/** This Function is for Button Styling  */
	private function loginer_button_style() {
		$button     = array( LOGINER_BUTTON_BACKGROUND_COLOR, LOGINER_BUTTON_COLOR, LOGINER_BUTTON_FONT_SIZE, LOGINER_BUTTON_BORDER_STYLE, LOGINER_BUTTON_BORDER_COLOR, LOGINER_BUTTON_BORDER_WIDTH, LOGINER_BUTTON_BORDER_RADIUS );
		$hover      = array( LOGINER_BUTTON_HOVER_BACKGROUND_COLOR, LOGINER_BUTTON_HOVER_COLOR );
		$form_style = "\n.custom-form .button
		{\n";
		foreach ( $button as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 7 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 7 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		$form_style .= "\n}
		.custom-form .button:hover
		{\n";
		foreach ( $hover as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 13 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 13 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		$form_style .= "\n}\n";
		return $form_style;
	}
	/** This Function is for Input Box Styling */
	private function loginer_input_style() {
		$input      = array( LOGINER_INPUT_BACKGROUND_COLOR, LOGINER_INPUT_COLOR, LOGINER_INPUT_FONT_SIZE );
		$form_style = "\n.custom-form input[type=text], .custom-form input[type=email], .custom-form input[type=password]
		{\n";
		foreach ( $input as $value ) {
			if ( ! empty( $this->style_options[ $value ] ) ) {
				if ( is_numeric( $this->style_options[ $value ] ) ) {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 6 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
				} else {
					$form_style .= esc_attr( str_replace( '_', '-', substr( $value, 6 ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
				}
			}
		}
		if ( isset( $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] ) && 'none' === $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] ) {
			$form_style .= 'border: none;';
		}
		if ( isset( $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] ) ) {
			$form_style .= $this->loginer_input_border_style();
		}
		$form_style .= "\n}";
		if ( isset( $this->style_options[ LOGINER_INPUT_COLOR ] ) ) {
			$form_style .= "::placeholder{\n" . esc_attr( str_replace( '_', '-', substr( LOGINER_INPUT_COLOR, 6 ) ) ) . ' : ' . esc_attr( $this->style_options[ LOGINER_INPUT_COLOR ] ) . ";\n}\n";
		}
		return $form_style;
	}
	/** This Function is for Input Box Border Styling */
	private function loginer_input_border_style() {
		$form_style   = '';
		$input_border = array( LOGINER_INPUT_BORDER_STYLE, LOGINER_INPUT_BORDER_COLOR, LOGINER_INPUT_BORDER_WIDTH, LOGINER_INPUT_BORDER_RADIUS );
		if ( 'none' !== $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] && ! empty( $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] ) && empty( $this->style_options[ LOGINER_INPUT_BOTTOM_BORDER ] ) ) {
			foreach ( $input_border as $value ) {
				if ( ! empty( $this->style_options[ $value ] ) ) {
					if ( is_numeric( $this->style_options[ $value ] ) ) {
						$form_style .= esc_attr( str_replace( '_', '-', ltrim( $value, 'input_' ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . "px;\n";
					} else {
						$form_style .= esc_attr( str_replace( '_', '-', ltrim( $value, 'input_' ) ) ) . ' : ' . esc_attr( $this->style_options[ $value ] ) . ";\n";
					}
				}
			}
		} elseif ( ! empty( $this->style_options[ LOGINER_INPUT_BOTTOM_BORDER ] ) && isset( $this->style_options[ LOGINER_INPUT_BORDER_WIDTH ] ) ) {
			$form_style .= 'border: none;';
			$form_style .= 'border-bottom: ' . esc_attr( $this->style_options[ LOGINER_INPUT_BORDER_WIDTH ] ) . 'px ' . esc_attr( $this->style_options[ LOGINER_INPUT_BORDER_STYLE ] ) . ' ' . esc_attr( $this->style_options[ LOGINER_INPUT_BORDER_COLOR ] ) . ';';
		}
		return $form_style;
	}
}
