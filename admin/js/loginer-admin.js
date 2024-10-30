/**
 * This js file handle all the admin panel function.
 *
 * @package Loginer
 */

/**
 * This Function Creates the Tabs of Admin Panel.
 *
 * The Currently Opened is Remain open when page reloads.
 */

function loginer_current_opentab() {
	( function() {
		jQuery( '#login-form-tabs' ).tabs();
		jQuery( 'a[role="presentation"]' ).on(
			'click',
			function(e) {
				window.localStorage.setItem( 'activeTab', jQuery( e.target ).attr( 'href' ) );
			}
		);

		var activeTab = window.localStorage.getItem( 'activeTab' );
		if (activeTab == "#headings") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 0 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#labels") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 1 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#errormsg") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 2 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#placeholder") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 3 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#formstyle") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 4 );
			window.localStorage.removeItem( "activeTab" );
		}
	} )();
}
/**
 * This Function Creates the Tabs of Sub menu admin panel.
 *
 * The Currently Opened is Remain open when page reloads.
 */
function loginer_submenu_opentab() {
	( function() {
		jQuery( '#login-form-submenu-tabs' ).tabs();
		jQuery( 'a[role="presentation"]' ).on(
			'click',
			function(e) {
				window.localStorage.setItem( 'activeTab', jQuery( e.target ).attr( 'href' ) );
			}
		);

		var activeTab = window.localStorage.getItem( 'activeTab' );
		if (activeTab == "#pluginpages") {
			jQuery( '#login-form-submenu-tabs' ).tabs( "option", "active", 1 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#setting") {
			jQuery( '#login-form-submenu-tabs' ).tabs( "option", "active", 0 );
			window.localStorage.removeItem( "activeTab" );
		}
		if (activeTab == "#customstyle") {
			jQuery( '#login-form-tabs' ).tabs( "option", "active", 6 );
			window.localStorage.removeItem( "activeTab" );
		}
	} )();
}

/** Form Title display or show work */
function loginer_show_demoheading() {
	( function() {
		if (jQuery( '#custom_show_page_title' ).prop( 'checked' ) == false) {
			jQuery( '#login_heading, #register_heading, #lost_pass_heading, #reset_pass_heading, #account_heading' ).attr( 'disabled','disabled' );
			jQuery( demoheading ).css( 'display','none' );
		} else {
			jQuery( '#login_heading, #register_heading, #lost_pass_heading, #reset_pass_heading, #account_heading' ).removeAttr( 'disabled' );
			jQuery( demoheading ).css( 'display','block' );
		}

	})();
}
/** Form Title display or show work */
function loginer_accordian() {
	( function() {
		var accItem = document.getElementsByClassName( 'custom-blocks' );
		var accHD   = document.getElementsByClassName( 'login-accordion' );
		for (i = 0; i < accHD.length; i++) {
			accHD[i].addEventListener( 'click', toggleItem, false );
		}
		function toggleItem() {
			var itemClass = this.parentNode.className;
			for (i = 0; i < accItem.length; i++) {
				accItem[i].className = 'custom-blocks close';
			}
			if (itemClass == 'custom-blocks close') {
				this.parentNode.className = 'custom-blocks open';
			}
		}

	})();
}

jQuery( document ).ready(
	function( $ ) {
		'use strict';
		loginer_current_opentab();
		loginer_submenu_opentab();
		loginer_previewForms();
		loginer_borderOptionsDisabled();
		loginer_show_demoheading();
		loginer_accordian();

		$( '.login-color-picker' ).wpColorPicker(); // Puts the default wordpress color-picker css on the element.
			/** Form Title work */
			$( '#custom_show_page_title' ).click(
				function(){
					loginer_show_demoheading();
				}
			);

		/*
		 * The code below is for Form Properties
		*/
		// Form Background Color Change.
		$( '#custom_form_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customform ).css( 'background-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				},
			}
		);
		// For Required Field.
		$( '#custom_requiredfield_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( requiredfield ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		// Form Shadow Properties.
		$( '#custom_form_shadow_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customform ).css( {'box-shadow': '0 10px 50px 0' + ui.color.toString()} );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		if ($( '#custom_form_shadow_enable' ).checked) {
			document.getElementById( 'custom_form_shadow_color' ).removeAttribute( 'disabled' );
		}

		// Form Border Properties.
		$( '#custom_form_border_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customform ).css( 'border-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_border_style, #custom_form_border_width, #custom_form_border_radius' ).change(
			function(){
				var formborderstyle = $( '#custom_form_border_style' ).val(),
				formborderwidth     = $( '#custom_form_border_width' ).val(),
				formborderradius    = $( '#custom_form_border_radius' ).val();

				if (formborderwidth && formborderwidth != 0) {
					$( '#custom_form_border_style, #custom_form_border_radius' ).removeAttr( 'disabled' );
					$( '#custom_form_border_color' ).parents( 'tr' ).removeAttr( 'style' );
				} else {
					$( '#custom_form_border_style, #custom_form_border_radius' ).attr( 'disabled','disabled' );
					$( '#custom_form_border_color' ).parents( 'tr' ).css( 'display','none' );
				}
				$( customform ).css(
					{
						'border-style': formborderstyle,
						'border-width': parseInt( formborderwidth ) ? parseInt( formborderwidth ) : 0 + 'px',
						'border-radius': parseInt( formborderradius ) + 'px'
					}
				);
			}
		);

		// Form Margin.
		$( '#custom_form_margin_top, #custom_form_margin_right, #custom_form_margin_bottom, #custom_form_margin_left' ).change(
			function(){
				var nodeEvent = $( this );
				if ( ! $( '#link-form-margin' ).hasClass( 'unlinked' ) ) {
					var value = document.getElementById( nodeEvent[0].attributes.id.nodeValue ).value;
					$( '#custom_form_margin_right, #custom_form_margin_bottom, #custom_form_margin_left, #custom_form_margin_top' ).val( value );
				}

				var margintop = $( '#custom_form_margin_top' ).val(),
				marginright   = $( '#custom_form_margin_right' ).val(),
				marginbottom  = $( '#custom_form_margin_bottom' ).val(),
				marginleft    = $( '#custom_form_margin_left' ).val();

				$( customform ).css(
					{
						'margin-top': parseInt( margintop ) + 'px',
						'margin-right': parseInt( marginright ) + 'px',
						'margin-bottom': parseInt( marginbottom ) + 'px',
						'margin-left': parseInt( marginleft ) + 'px'
					}
				);
			}
		);

		// Form Padding.
		$( '#custom_form_padding_top, #custom_form_padding_right, #custom_form_padding_bottom, #custom_form_padding_left' ).change(
			function(){

				var nodeEvent = $( this );
				if ( ! $( '#link-form-padding' ).hasClass( 'unlinked' ) ) {
					var value = document.getElementById( nodeEvent[0].attributes.id.nodeValue ).value;
					$( '#custom_form_padding_right, #custom_form_padding_bottom, #custom_form_padding_left, #custom_form_padding_top' ).val( value );
				}
				var paddingtop = $( '#custom_form_padding_top' ).val(),
				paddingright   = $( '#custom_form_padding_right' ).val(),
				paddingbottom  = $( '#custom_form_padding_bottom' ).val(),
				paddingleft    = $( '#custom_form_padding_left' ).val();

				$( customform ).css(
					{
						'padding-top': parseInt( paddingtop ) + 'px',
						'padding-right': parseInt( paddingright ) + 'px',
						'padding-bottom': parseInt( paddingbottom ) + 'px',
						'padding-left': parseInt( paddingleft ) + 'px'
					}
				);
			}
		);
		/*
		 * End Of Form Properties
		*/

		/*
		 * The code below is for Head tag Properties
		*/
		// Head Tag Color.
		$( '#custom_form_heading_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformh2 ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		$( '#custom_form_heading_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformh2 ).css( 'background-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		// Heading Border Properties.
		$( '#custom_form_heading_border_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformh2 ).css( 'border-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		$( '#custom_form_heading_border_style, #custom_form_heading_border_width, #custom_form_heading_border_radius' ).change(
			function(){

				var headborderstyle = $( '#custom_form_heading_border_style' ).val(),
				headborderwidth     = $( '#custom_form_heading_border_width' ).val(),
				headborderradius    = $( '#custom_form_heading_border_radius' ).val();

				if (headborderwidth && headborderwidth != 0) {
					$( '#custom_form_heading_border_style, #custom_form_heading_border_radius' ).removeAttr( 'disabled' );
					$( '#custom_form_heading_border_color' ).parents( 'tr' ).removeAttr( 'style' );
				} else {
					$( '#custom_form_heading_border_style, #custom_form_heading_border_radius' ).attr( 'disabled','disabled' );
					$( '#custom_form_heading_border_color' ).parents( 'tr' ).css( 'display','none' );
				}
				$( customformh2 ).css(
					{
						'border-style': headborderstyle,
						'border-width': parseInt( headborderwidth ) ? parseInt( headborderwidth ) : 0 + 'px',
						'border-radius': parseInt( headborderradius ) + 'px'
					}
				);

			}
		);

		// Form Heading Font Size.
		$( '#custom_form_heading_font_size' ).change(
			function(){
				var headsize = document.getElementById( 'custom_form_heading_font_size' ).value;
				$( customformh2 ).css( 'font-size', parseInt( headsize ) + 'px' );

			}
		);

		// Heading Margin.
		$( '#custom_form_heading_margin_top, #custom_form_heading_margin_right, #custom_form_heading_margin_bottom, #custom_form_heading_margin_left' ).change(
			function(){

				var nodeEvent = $( this );
				if ( ! $( '#link-heading-margin' ).hasClass( 'unlinked' ) ) {
					var value = document.getElementById( nodeEvent[0].attributes.id.nodeValue ).value;
					$( '#custom_form_heading_margin_right, #custom_form_heading_margin_bottom, #custom_form_heading_margin_left, #custom_form_heading_margin_top' ).val( value );
				}

				var margintop = $( '#custom_form_heading_margin_top' ).val(),
				marginright   = $( '#custom_form_heading_margin_right' ).val(),
				marginbottom  = $( '#custom_form_heading_margin_bottom' ).val(),
				marginleft    = $( '#custom_form_heading_margin_left' ).val();

				$( customformh2 ).css(
					{
						'margin-top': parseInt( margintop ) + 'px',
						'margin-right': parseInt( marginright ) + 'px',
						'margin-bottom': parseInt( marginbottom ) + 'px',
						'margin-left': parseInt( marginleft ) + 'px'
					}
				);
			}
		);

		// Heading Padding.
		$( '#custom_form_heading_padding_top, #custom_form_heading_padding_right, #custom_form_heading_padding_bottom, #custom_form_heading_padding_left' ).change(
			function(){

				var nodeEvent = $( this );
				if ( ! $( '#link-heading-padding' ).hasClass( 'unlinked' ) ) {
					var value = document.getElementById( nodeEvent[0].attributes.id.nodeValue ).value;
					$( '#custom_form_heading_padding_right, #custom_form_heading_padding_bottom, #custom_form_heading_padding_left, #custom_form_heading_padding_top' ).val( value );
				}

				var paddingtop = $( '#custom_form_heading_padding_top' ).val(),
				paddingright   = $( '#custom_form_heading_padding_right' ).val(),
				paddingbottom  = $( '#custom_form_heading_padding_bottom' ).val(),
				paddingleft    = $( '#custom_form_heading_padding_left' ).val();

				$( customformh2 ).css(
					{
						'padding-top': parseInt( paddingtop ) + 'px',
						'padding-right': parseInt( paddingright ) + 'px',
						'padding-bottom': parseInt( paddingbottom ) + 'px',
						'padding-left': parseInt( paddingleft ) + 'px'
					}
				);
			}
		);
		/*
		 * End Of Head Tag Properties
		*/

		/*
		 * The code below is for Paragraph & Messages Properties
		*/
		$( '#custom_form_paragraph_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformp ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		// This is for Paragraph & Messages Font Size.
		$( '#custom_form_paragraph_font_size' ).change(
			function(){
				var parasize = document.getElementById( 'custom_form_paragraph_font_size' ).value;
				$( customformp ).css( 'font-size', parseInt( parasize ) + 'px' );

			}
		);
		/*
		 * End Of Paragraph & Messages Properties
		*/

		/*
		 * The code below is for Form Label Properties
		*/
		$( '#custom_form_label_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformlabel ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		// This is for Label Preview.
		$( '#custom_form_label_font_size' ).change(
			function(){
				var labelsize = document.getElementById( 'custom_form_label_font_size' ).value;
				$( customformlabel ).css( 'font-size', parseInt( labelsize ) + 'px' );

			}
		);
		/*
		 * End Of Form Label Properties
		*/

		/*
		 * The code below is for Form Input Fields Properties
		*/
		$( '#custom_form_input_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customforminput ).css( 'background-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_input_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customforminput ).css( 'color', ui.color.toString() );
					head.find( 'style' ).append( '::placeholder{ color:' + ui.color.toString() + '}' );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		$( '#custom_form_input_border_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customforminput ).css( 'border-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);

		$( '#custom_form_input_focus_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( customforminput ).on(
			{'focus': function(){
				$( this ).css( 'background-color', $( '#custom_form_input_focus_background_color' ).val() );
			},
				'focusout': function(){
					$( this ).css( 'background-color', $( '#custom_form_input_background_color' ).val() );
				}
			}
		);

		$( '#custom_form_input_focus_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( customforminput ).on(
			{'focus': function(){
				$( this ).css( 'color', $( '#custom_form_input_focus_color' ).val() );
			},
				'focusout': function(){
					$( this ).css( 'color', $( '#custom_form_input_color' ).val() );
				}
			}
		);

		$( '#custom_form_input_focus_border_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( customforminput ).on(
			{
				'focus': function(){
					$( this ).css( 'border-color', $( '#custom_form_input_focus_border_color' ).val() );
				},
				'focusout': function(){
					$( this ).css( 'border-color', $( '#custom_form_input_border_color' ).val() );
				}
			}
		);

		// This is for Input & Its Border Properties Preview.
		$( '#custom_form_input_font_size, #custom_form_input_bottom_border, #custom_form_input_border_style, #custom_form_input_border_width, #custom_form_input_border_radius' ).change(
			function(){
				var inputsize = document.getElementById( 'custom_form_input_font_size' ).value;
				$( customforminput ).css( 'font-size', parseInt( inputsize ) );

				// Input Border Properties.
				var bottom_border = document.getElementById( 'custom_form_input_bottom_border' ).checked, // To check bottom border checkbox is checked or not.
				borderstyle       = $( '#custom_form_input_border_style' ).val(),
				borderwidth       = $( '#custom_form_input_border_width' ).val(),
				borderradius      = $( '#custom_form_input_border_radius' ).val();
				if ( borderwidth && borderwidth != 0 ) {
					$( '#custom_form_input_border_style, #custom_form_input_border_radius, #custom_form_input_bottom_border' ).removeAttr( 'disabled' );
					$( '#custom_form_input_border_color' ).parents( 'tr' ).removeAttr( 'style' );
				} else {
					$( '#custom_form_input_border_style, #custom_form_input_bottom_border, #custom_form_input_border_radius, #custom_form_input_bottom_border' ).attr( 'disabled','disabled' );
					$( '#custom_form_input_border_color' ).parents( 'tr' ).css( 'display','none' );
				}

				if ( ! bottom_border && borderstyle && borderstyle != '' ) {
					$( customforminput ).css(
						{
							'border-style': borderstyle,
							'border-width': parseInt( borderwidth ) ? parseInt( borderwidth ) : 0 + 'px',
							'border-radius': parseInt( borderradius ) + 'px',
							'border-color': $( '#custom_form_input_border_color' ).val(),
						}
					);
				} else if ( ( borderstyle != '' || borderstyle != 'none' ) && bottom_border ) {
					$( customforminput ).css(
						{
							'border': 'none',
							'border-bottom-style': borderstyle,
							'border-bottom-width': parseInt( borderwidth ) ? parseInt( borderwidth ) : 0 + 'px',
							'border-bottom-color': $( '#custom_form_input_border_color' ).val(),
							'border-radius': 0,
						}
					);
				}
			}
		);

		/*
		 * End Of Form Input Properties
		*/

		/*
		 * The code below is for Form Link Properties
		*/
		$( '#custom_form_link_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customforma ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_link_hover_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customforma ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( customforma ).hover(
			function(){
				$( this ).css( 'color',  $( '#custom_form_link_hover_color' ).val() );
			},
			function(){
				$( this ).css( 'color',  $( '#custom_form_link_color' ).val() );
			}
		);
		$( '#custom_form_link_font_size' ).change(
			function(){
				var linksize = document.getElementById( 'custom_form_link_font_size' ).value;
				$( customforma ).css( 'font-size', parseInt( linksize ) + 'px' );
			}
		);
		/*
		 * End Of Form Link Properties
		*/

		/*
		 * The code below is for Form Button Properties
		*/
		$( '#custom_form_button_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformbutton ).css( 'background-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_button_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformbutton ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_button_hover_background_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformbutton ).css( 'background-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_button_hover_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformbutton ).css( 'color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( customformbutton ).hover(
			function(){
				if ( $( '#custom_form_button_hover_color' ).val() ) {
					$( this ).css( {'color':  $( '#custom_form_button_hover_color' ).val(), 'background-color': $( '#custom_form_button_hover_background_color' ).val()} );
				} else {
					$( this ).css( {'color':  $( '#custom_form_button_color' ).val(), 'background-color': $( '#custom_form_button_hover_background_color' ).val()} );
				}
			},
			function(){
				$( this ).css( {'color': $( '#custom_form_button_color' ).val(), 'background-color': $( '#custom_form_button_background_color' ).val()} );
			}
		);

		// Button Border.
		$( '#custom_form_button_border_color' ).iris(
			{
				border: false,
				palettes: true,
				width: 200,
				change: function(event, ui) {
					$( customformbutton ).css( 'border-color', ui.color.toString() );
					$( '.wp-picker-open' ).css( 'background-color', ui.color.toString() );
				}
			}
		);
		$( '#custom_form_button_border_style, #custom_form_button_border_width, #custom_form_button_border_radius, #custom_form_button_font_size' ).change(
			function(){

				var buttonsize     = $( '#custom_form_button_font_size' ).val(),
				buttonborderwidth  = $( '#custom_form_button_border_width' ).val(),
				buttonborderradius = $( '#custom_form_button_border_radius' ).val(),
				buttonborderstyle  = $( '#custom_form_button_border_style' ).val();

				if ( buttonborderwidth && buttonborderwidth != 0 ) {
					$( '#custom_form_button_border_style, #custom_form_button_border_radius' ).removeAttr( 'disabled' );
					$( '#custom_form_button_border_color' ).parents( 'tr' ).removeAttr( 'style' );
				} else {
					$( '#custom_form_button_border_style, #custom_form_button_border_radius' ).attr( 'disabled','disabled' );
					$( '#custom_form_button_border_color' ).parents( 'tr' ).css( 'display','none' );
				}
				$( customformbutton ).css(
					{
						'font-size': parseInt( buttonsize ) + 'px',
						'border-style': buttonborderstyle,
						'border-width': parseInt( buttonborderwidth ) ? parseInt( buttonborderwidth ) : 0 + 'px',
						'border-radius': parseInt( buttonborderradius ) + 'px'
					}
				);
			}
		);

		/*
		 * This Displays thye shadow color element.
		*/
		$( '#custom_form_shadow_enable' ).click(
			function(){
				if ($( this ).prop( 'checked' ) == true) {
					$( '#shadow-color' ).show();
				} else if ($( this ).prop( 'checked' ) == false) {
					$( '#shadow-color' ).hide();
				}
			}
		);
		if ($( '#custom_form_shadow_enable' ).prop( 'checked' ) == true) {
			$( '#shadow-color' ).show();
		}

		/*
		 * This toggle the class unlinked on the button and hsows the respected element.
		*/
		$( '.margin-padding-link' ).click(
			function(){
				var button = $( this );
				$( this ).toggleClass( 'unlinked' );
				if ( $( this ).hasClass( 'unlinked' ) ) {
					$( button[0].children[1] ).show();
					$( button[0].children[0] ).hide();
				} else {
					$( button[0].children[0] ).show();
					$( button[0].children[1] ).hide();
				}
			}
		);

		loginer_linkButton(); // Calling of loginer_linkButton Function.
		/*
		 * This will create live preview for form heading
		*/
		$( '#headings input[type="text"]' ).keyup(
			function(){
				$( loginh2 ).text( $( '#login_heading' ).val() );
				$( registerh2 ).text( $( '#register_heading' ).val() );
				$( lostpassh2 ).text( $( '#lost_pass_heading' ).val() );
				$( resetpassh2 ).text( $( '#reset_pass_heading' ).val() );
			}
		);

		/*
		 * This will create live preview for form Labels
		*/
		$( '#labels input[type="text"]' ).keyup(
			function(){
				$( useremaillabel ).text( $( '#emailuser_label' ).val() );
				$( emaillabel ).text( $( '#email_label' ).val() );
				$( passwordlabel ).text( $( '#password_label' ).val() );
				$( conpasswordlabel ).text( $( '#confirm_password_label' ).val() );
				$( newpasswordlabel ).text( $( '#new_password_label' ).val() );
				$( repnewpasswordlabel ).text( $( '#repeat_new_password_label' ).val() );
				$( unamelabel ).text( $( '#username_label' ).val() );
			}
		);
		/*
		 * This will create live preview for form placeholders
		*/
		$( '#placeholder input[type="text"]' ).keyup(
			function(){

				$( placholderemailuser ).attr( 'placeholder', $( '#emailuser_place' ).val() );
				$( placholderemail ).attr( 'placeholder', $( '#email_placeholder' ).val() );
				$( placholderuname ).attr( 'placeholder', $( '#username_placeholder' ).val() );
				$( placholderpass ).attr( 'placeholder', $( '#password_placeholder' ).val() );
				$( placholdercpass ).attr( 'placeholder', $( '#confirm_password_placeholder' ).val() );
				$( placholdernewpass ).attr( 'placeholder', $( '#new_password_placeholder' ).val() );
				$( placholdercnewpass ).attr( 'placeholder', $( '#confirm_new_password_placeholder' ).val() );
			}
		);
		/*
		 * This will add custom css to the Forms
		*/
		$( '#customstyle input[type="text"]' ).keyup(
			function(){
				loginer_addUserClasses( $( this ), $( this ).data( 'element' ) );
			}
		);
		/*
		 * This will add custom css to the Forms
		*/
		$( '#customstyle textarea' ).keyup(
			function(){
				var css  = $( '#customcss' ).val(),
				newstyle = head.children( 'style' );
				if ( newstyle.length > 1 ) {
					newstyle[1].remove();
				}
				newstyle = head.children( 'style' );
				if ( newstyle.length <= 1 ) {
					head.append( '<style>' );
					newstyle = head.children( 'style' );
					newstyle[1].append( css );
				}
			}
		);
		loginer_clearColor(); // The color of the Respective element is removed in live Preview.

		// To Prevent the Working of the Buttons in Iframe.
		$( customformbutton ).click(
			function(event){
				event.preventDefault();
			}
		);

		// height calculation of iframe.
		jQuery(
			function($){
				var lastHeight = 0, curHeight = 0, $frame = $( 'iframe:eq(0)' );
				setInterval(
					function(){
						curHeight = $frame.contents().find( '#form-preview' ).height();
						if ( curHeight != lastHeight ) {
							$frame.css( 'height', (lastHeight = curHeight) + 'px' );
						}
					},
					500
				);
			}
		);
		loginer_display_page();
	}
);

/**
 * This function Find and appends the Various elements to iframe.
 *
 * It also sets the variables as objects with different elements.
 */
var demoheading, democustomform, customformh2, customforma, requiredfield, customformp, customformlabel, customforminput, customformbutton, loginh2, registerh2, lostpassh2, resetpassh2, emaillabel, useremaillabel, passwordlabel, conpasswordlabel, newpasswordlabel, repnewpasswordlabel, unamelabel, placholderemail, placholderemailuser, placholderuname, placholderpass, placholdercpass, placholdernewpass, placholdercnewpass, head, pluginpagevalues;
function loginer_previewForms() {
	( function() {

		// The Below Variables are used to store the coontent of the iframe.
		var body = jQuery( '#preview-frame' ).contents().find( 'body' );
		body.append( jQuery( '#form-preview' ) );
		customform          = jQuery( '#preview-frame' ).contents().find( '.custom-form form' ),
		customformh2        = jQuery( '#preview-frame' ).contents().find( '.custom-form h2' ),
		customforma         = jQuery( '#preview-frame' ).contents().find( '.custom-form a' ),
		requiredfield       = jQuery( '#preview-frame' ).contents().find( '.custom_required_Color' ),
		customformp         = jQuery( '#preview-frame' ).contents().find( '.custom-form p' ),
		customformlabel     = jQuery( '#preview-frame' ).contents().find( '.custom-form label' ),
		customforminput     = jQuery( '#preview-frame' ).contents().find( '.custom-form input[type="text"], input[type="password"], input[type="email"]' ),
		customformbutton    = jQuery( '#preview-frame' ).contents().find( '.custom-form .button' ),
		loginh2             = jQuery( '#preview-frame' ).contents().find( '#login-form h2' ),
		registerh2          = jQuery( '#preview-frame' ).contents().find( '#registration-form h2' ),
		lostpassh2          = jQuery( '#preview-frame' ).contents().find( '#lost-pass-form h2' ),
		resetpassh2         = jQuery( '#preview-frame' ).contents().find( '#reset-pass-form h2' ),
		emaillabel          = jQuery( '#preview-frame' ).contents().find( '#registration-form #email-label' ),
		useremaillabel      = jQuery( '#preview-frame' ).contents().find( '#login-form #useremail-label, #lost-pass-form #useremail-label' ),
		passwordlabel       = jQuery( '#preview-frame' ).contents().find( '#login-form #password-label, #registration-form #password-label' ),
		conpasswordlabel    = jQuery( '#preview-frame' ).contents().find( '#confirm-password-label' ),
		newpasswordlabel    = jQuery( '#preview-frame' ).contents().find( '#new-password-label' ),
		repnewpasswordlabel = jQuery( '#preview-frame' ).contents().find( '#repeat-new-password-label' ),
		unamelabel          = jQuery( '#preview-frame' ).contents().find( '#username-label' ),
		demoheading         = jQuery( '#preview-frame' ).contents().find( '#demo_login_heading, #demo_register_heading, #demo_lost_heading, #demo_reset_heading' ),
		placholderemail     = jQuery( '#preview-frame' ).contents().find( '#registration-form input[type="email"]' ),
		placholderemailuser = jQuery( '#preview-frame' ).contents().find( '#login-form input[type="text"], #lost-pass-form input[type="text"]' ),
		placholderuname     = jQuery( '#preview-frame' ).contents().find( '#registration-form input[type="text"]' ),
		placholderpass      = jQuery( '#preview-frame' ).contents().find( '#login-form input[type="password"], #registration-form #password' ),
		placholdercpass     = jQuery( '#preview-frame' ).contents().find( '#registration-form #conform_password' ),
		placholdernewpass   = jQuery( '#preview-frame' ).contents().find( '#reset-pass-form #new_pass' ),
		placholdercnewpass  = jQuery( '#preview-frame' ).contents().find( '#reset-pass-form #repeat_new_pass' );

		// Appends the various stylesheets and scripts in iframe head.
		var themestylesheet = iFrameStyle.theme_css;
		var frame = document.querySelector("#preview-frame");
		if( frame !== null )
		{
		frame.contentWindow.object_of_interest = window.wp;
		frame.contentWindow.object_of_interest1 = iFrameStyle;
		}
		head                = jQuery( '#preview-frame' ).contents().find( 'head' );
		head.append( jQuery( '<link/>', { rel: 'stylesheet', href: iFrameStyle.public_css, type: 'text/css' } ) );
		head.append( jQuery( '<link/>', { rel: 'stylesheet', href: iFrameStyle.admin_css, type: 'text/css' } ) );
		for ( var i in themestylesheet ) {
			if ( ! themestylesheet[i].includes( 'rtl' ) ) {
				head.append( jQuery( "<link/>", { rel: "stylesheet", href: themestylesheet[i], type: "text/css" } ) );
			}
		}

		head.append( jQuery( "<script/>", { src: iFrameStyle.custom_js } ) );
		head.append( jQuery( '<script/>', { src: iFrameStyle.pass_strength } ) );
		head.append( jQuery( '<style/>' ) );
		head.find( 'style' ).append( iFrameStyle.custom_css );
	} )();
}

/**
 * This is for clearing the color of the particular element in the preview panel.
 */
function loginer_clearColor() {
	( function() {
		// Clear Button Functionality.
		jQuery( '.wp-picker-clear' ).click(
			function(){
				jQuery( customform ).css( 'background-color', jQuery( '#custom_form_background_color' ).val() );
				jQuery( customform ).css( 'border-color', jQuery( '#custom_form_border_color' ).val() );
				if ( jQuery( '#custom_form_shadow_color' ).val() ) {
					jQuery( customform ).css( {'box-shadow': '0 10px 50px 0' + jQuery( '#custom_form_shadow_color' ).val()} );
				} else {
					jQuery( customform ).css( 'box-shadow', 'none' );
				}
				jQuery( requiredfield ).css( 'color', jQuery( '#custom_requiredfield_color' ).val() );
				jQuery( customformh2 ).css( 'color', jQuery( '#custom_form_heading_color' ).val() );
				jQuery( customformh2 ).css( 'background-color', jQuery( '#custom_form_heading_background_color' ).val() );
				jQuery( customformh2 ).css( 'border-color', jQuery( '#custom_form_heading_border_color' ).val() );
				jQuery( customformp ).css( 'color', jQuery( '#custom_form_paragraph_color' ).val() );
				jQuery( customformlabel ).css( 'color', jQuery( '#custom_form_label_color' ).val() );
				jQuery( customforminput ).css( 'background-color', jQuery( '#custom_form_input_background_color' ).val() );
				jQuery( customforminput ).css( 'color', jQuery( '#custom_form_input_color' ).val() );
				if ( ! jQuery( '#custom_form_input_color' ).val() ) {
					head.find( 'style' ).append( '::placeholder{ color: initial }' );
				}
				jQuery( customforminput ).css( 'border-color', jQuery( '#custom_form_input_border_color' ).val() );
				jQuery( customforma ).css( 'color', jQuery( '#custom_form_link_color' ).val() );
				jQuery( customforma ).css( 'color', jQuery( '#custom_form_link_hover_color' ).val() );
				jQuery( customformbutton ).css( 'background-color', jQuery( '#custom_form_button_background_color' ).val() );
				jQuery( customformbutton ).css( 'color', jQuery( '#custom_form_button_color' ).val() );
				jQuery( customformbutton ).css( 'background-color', jQuery( '#custom_form_button_hover_background_color' ).val() );
				jQuery( customformbutton ).css( 'color', jQuery( '#custom_form_button_hover_color' ).val() );
				jQuery( customformbutton ).css( 'border-color', jQuery( '#custom_form_button_border_color' ).val() );
			}
		);
	} )();
}
/**
 * This is for Disabling the Border options
 */
function loginer_borderOptionsDisabled() {
	( function() {
		jQuery( '#custom_form_border_style, #custom_form_border_radius, #custom_form_heading_border_style, #custom_form_heading_border_radius, #custom_form_input_border_style, #custom_form_input_border_radius, #custom_form_button_border_style, #custom_form_button_border_radius, #custom_form_input_bottom_border' ).attr( 'disabled','disabled' );
		if ( jQuery( '#custom_form_border_width' ).val() && jQuery( '#custom_form_border_width' ).val() != 0 ) {
			jQuery( '#custom_form_border_style, #custom_form_border_radius' ).removeAttr( 'disabled' );
			jQuery( '#custom_form_border_color' ).parents( 'tr' ).removeAttr( 'style' );
		}
		if ( jQuery( '#custom_form_button_border_width' ).val() && jQuery( '#custom_form_button_border_width' ).val() != 0 ) {
			jQuery( '#custom_form_button_border_style, #custom_form_button_border_radius' ).removeAttr( 'disabled' );
			jQuery( '#custom_form_button_border_color' ).parents( 'tr' ).removeAttr( 'style' );
		}
		if ( jQuery( '#custom_form_input_border_width' ).val() && jQuery( '#custom_form_input_border_width' ).val() != 0 ) {
			jQuery( '#custom_form_input_border_style, #custom_form_input_border_radius, #custom_form_input_bottom_border' ).removeAttr( 'disabled' );
			jQuery( '#custom_form_input_border_color' ).parents( 'tr' ).removeAttr( 'style' );
		}
		if ( jQuery( '#custom_form_heading_border_width' ).val() && jQuery( '#custom_form_heading_border_width' ).val() != 0 ) {
			jQuery( '#custom_form_heading_border_style, #custom_form_heading_border_radius' ).removeAttr( 'disabled' );
			jQuery( '#custom_form_heading_border_color' ).parents( 'tr' ).removeAttr( 'style' );
		}
	} )();
}

/**
 * This puts the Top Margin/Padding input Value in all the other inputs When the State of Button is change from unlinked to linked.
 */
function loginer_linkButton() {
	( function() {
		// Form Margin Linking.
		jQuery( '#link-form-margin' ).click(
			function(){
				if ( ! jQuery( '#link-form-margin' ).hasClass( 'unlinked' ) ) {
					jQuery( '#custom_form_margin_right, #custom_form_margin_bottom, #custom_form_margin_left' ).val( jQuery( '#custom_form_margin_top' ).val() );
				}

				if ( jQuery( '#link-form-margin' ).hasClass( 'unlinked' ) && ! jQuery( '#custom_form_margin_right, #custom_form_margin_bottom, #custom_form_margin_left, #custom_form_margin_top' ).val() ) {
					jQuery( '#custom_form_margin_right, #custom_form_margin_bottom, #custom_form_margin_left, #custom_form_margin_top' ).val( 0 );
				}
			}
		);

		// Form Padding Linking.
		jQuery( '#link-form-padding' ).click(
			function(){
				if ( ! jQuery( '#link-form-padding' ).hasClass( 'unlinked' ) ) {
					jQuery( '#custom_form_padding_right, #custom_form_padding_bottom, #custom_form_padding_left' ).val( jQuery( '#custom_form_padding_top' ).val() );
				}

				if ( jQuery( '#link-form-padding' ).hasClass( 'unlinked' ) && ! jQuery( '#custom_form_padding_right, #custom_form_padding_bottom, #custom_form_padding_left, #custom_form_padding_top' ).val() ) {
					jQuery( '#custom_form_padding_right, #custom_form_padding_bottom, #custom_form_padding_left, #custom_form_padding_top' ).val( 0 );
				}
			}
		);

		// Heading Margin Linking.
		jQuery( '#link-heading-margin' ).click(
			function(){
				if ( ! jQuery( '#link-heading-margin' ).hasClass( 'unlinked' ) ) {
					jQuery( '#custom_form_heading_margin_right, #custom_form_heading_margin_bottom, #custom_form_heading_margin_left' ).val( jQuery( '#custom_form_heading_margin_top' ).val() );
				}

				if ( jQuery( '#link-heading-margin' ).hasClass( 'unlinked' ) && ! jQuery( '#custom_form_heading_margin_right, #custom_form_heading_margin_bottom, #custom_form_heading_margin_left, #custom_form_heading_margin_top' ).val() ) {
					jQuery( '#custom_form_heading_margin_right, #custom_form_heading_margin_bottom, #custom_form_heading_margin_left, #custom_form_heading_margin_top' ).val( 0 );
				}
			}
		);

		// Heading Padding Linking.
		jQuery( '#link-heading-padding' ).click(
			function(){
				if ( ! jQuery( '#link-heading-padding' ).hasClass( 'unlinked' ) ) {
					jQuery( '#custom_form_heading_padding_right, #custom_form_heading_padding_bottom, #custom_form_heading_padding_left' ).val( jQuery( '#custom_form_heading_padding_top' ).val() );
				}

				if ( jQuery( '#link-heading-padding' ).hasClass( 'unlinked' ) && ! jQuery( '#custom_form_heading_padding_right, #custom_form_heading_padding_bottom, #custom_form_heading_padding_left, #custom_form_heading_padding_top' ).val() ) {
					jQuery( '#custom_form_heading_padding_right, #custom_form_heading_padding_bottom, #custom_form_heading_padding_left, #custom_form_heading_padding_top' ).val( 0 );
				}
			}
		);

		// For Form Margin.
		var formmargintop = jQuery( '#custom_form_margin_top' ).val(),
		formmarginright   = jQuery( '#custom_form_margin_right' ).val(),
		formmarginbottom  = jQuery( '#custom_form_margin_bottom' ).val(),
		formmarginleft    = jQuery( '#custom_form_margin_left' ).val();
		if ( formmargintop != formmarginright || formmargintop != formmarginbottom || formmargintop != formmarginleft ) {
			jQuery( '#link-form-margin' ).addClass( 'unlinked' );
		}
		if ( jQuery( '#link-form-margin' ).hasClass( 'unlinked' ) ) {
			jQuery( '#link-form-margin .options-unlinked' ).show();
			jQuery( '#link-form-margin .options-linked' ).hide();
		}

		// For Form Margin.
		var formpaddingtop = jQuery( '#custom_form_padding_top' ).val(),
		formpaddingright   = jQuery( '#custom_form_padding_right' ).val(),
		formpaddingbottom  = jQuery( '#custom_form_padding_bottom' ).val(),
		formpaddingleft    = jQuery( '#custom_form_padding_left' ).val();
		if ( formpaddingtop != formpaddingright || formpaddingtop != formpaddingbottom || formpaddingtop != formpaddingleft ) {
			jQuery( '#link-form-padding' ).addClass( 'unlinked' );
		}
		if ( jQuery( '#link-form-padding' ).hasClass( 'unlinked' ) ) {
			jQuery( '#link-form-padding .options-unlinked' ).show();
			jQuery( '#link-form-padding .options-linked' ).hide();
		}

		// For Heading Margin.
		var headingmargintop = jQuery( '#custom_form_heading_margin_top' ).val(),
		headingmarginright   = jQuery( '#custom_form_heading_margin_right' ).val(),
		headingmarginbottom  = jQuery( '#custom_form_heading_margin_bottom' ).val(),
		headingmarginleft    = jQuery( '#custom_form_heading_margin_left' ).val();
		if ( headingmargintop != headingmarginright || headingmargintop != headingmarginbottom || headingmargintop != headingmarginleft ) {
			jQuery( '#link-heading-margin' ).addClass( 'unlinked' );
		}
		if ( jQuery( '#link-heading-margin' ).hasClass( 'unlinked' ) ) {
			jQuery( '#link-heading-margin .options-unlinked' ).show();
			jQuery( '#link-heading-margin .options-linked' ).hide();
		}

		// For Heading Margin.
		var headingpaddingtop = jQuery( '#custom_form_heading_padding_top' ).val(),
		headingpaddingright   = jQuery( '#custom_form_heading_padding_right' ).val(),
		headingpaddingbottom  = jQuery( '#custom_form_heading_padding_bottom' ).val(),
		headingpaddingleft    = jQuery( '#custom_form_heading_padding_left' ).val();
		if ( headingpaddingtop != headingpaddingright || headingpaddingtop != headingpaddingbottom || headingpaddingtop != headingpaddingleft ) {
			jQuery( '#link-heading-padding' ).addClass( 'unlinked' );
		}
		if ( jQuery( '#link-heading-padding' ).hasClass( 'unlinked' ) ) {
			jQuery( '#link-heading-padding .options-unlinked' ).show();
			jQuery( '#link-heading-padding .options-linked' ).hide();
		}

	} )();
}
/**
 * This is for Adding User Defined Classes Live Preview
 */
function loginer_addUserClasses( element, data ) {
	( function() {
		var classes = jQuery( element ).val().split( ' ' ),
		count       = classes.length,
		elementdata = jQuery( '#preview-frame' ).contents().find( data );
		jQuery( elementdata ).removeClass();
		for ( var i = 0; i < count; i++ ) {
			jQuery( elementdata ).addClass( classes[i].replace( /[^a-zA-Z0-9-_]/ig, '' ) );
		}
	} )();
}
/**
 * This is for Dispalying And Hiding the Plugin Page Options.
 */
function loginer_display_page() {
	( function() {
		pluginpagevalues = [jQuery( '#Sign_in' ).val(), jQuery( '#Profile' ).val(), jQuery( '#Registration' ).val(), jQuery( '#Forgot_Password' ).val(), jQuery( '#Reset_Password' ).val()];
		var selectboxes  = ['#Sign_in', '#Profile', '#Registration', '#Forgot_Password', '#Reset_Password'];
		for ( var i = 0; i < selectboxes.length; i++ ) {
			for ( var j = 0; j < pluginpagevalues.length; j++ ) {
				if ( jQuery( selectboxes[i] ).val() != pluginpagevalues[j] ) {
					jQuery( selectboxes[i] + ' option[value="' + pluginpagevalues[j] + '"]' ).css( 'display','none' );
				}
			}
		}

		jQuery( '#Sign_in, #Profile, #Registration, #Forgot_Password, #Reset_Password' ).change(
			function() {
				var pagevalues = [jQuery( '#Sign_in' ).val(), jQuery( '#Profile' ).val(), jQuery( '#Registration' ).val(), jQuery( '#Forgot_Password' ).val(), jQuery( '#Reset_Password' ).val()];
				for ( var i = 0; i < selectboxes.length; i++ ) {
					for ( var j = 0; j < pluginpagevalues.length; j++ ) {
						if ( jQuery( selectboxes[i] ).val() != pagevalues[j] ) {
							jQuery( selectboxes[i] + ' option[value="' + pagevalues[j] + '"]' ).css( 'display','none' );
						}
						if (pluginpagevalues[j] != pagevalues[j]) {
							jQuery( selectboxes[i] + ' option[value="' + pluginpagevalues[j] + '"]' ).css( 'display','block' );
						}
					}
				}
			}
		);
	} )();
}
