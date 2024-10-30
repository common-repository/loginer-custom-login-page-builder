<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since 1.0
 * @author     SofSter
 * @package    Loginer
 * @subpackage Loginer/admin
 */

/** This File Has the Parent class of his class */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin' . DIRECTORY_SEPARATOR . 'class-sub-loginer-admin.php';
/**
 * The admin-specific functionality of the plugin.
 */
class Loginer_Admin extends Sub_Loginer_Admin {

	/**
	 * The version of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The ID of this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function loginer_admin_styles() {

		/**
		 * This function Enqueues the Stylesheets to Admin Area.
		 *
		 * An instance of this class is passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Login_Loader creates the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 * Css Only apply for plugin pages in admin area.
		 */
		$currentscreen = get_current_screen();
		if ( 'toplevel_page_loginer-form-setting' === $currentscreen->id || strpos( $currentscreen->id, 'loginer-form-subsetting' ) !== false ) {
			// Use minified libraries if SCRIPT_DEBUG is turned off.
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_style( 'jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui/jquery-ui' . $suffix . '.css', array(), '1.8.9', 'all' );
			wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __FILE__ ) . 'css/loginer-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function loginer_admin_scripts() {

		/**
		 * This function is Enqueues the Scripts to the Admin Area.
		 *
		 * The Login_Loader then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * An instance of this class is passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 */
		$screen = get_current_screen();
		if ( 'toplevel_page_loginer-form-setting' === $screen->id || strpos( $screen->id, 'loginer-form-subsetting' ) !== false ) {
			require_once plugin_dir_path( __DIR__ ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-style.php';
			$style = new Loginer_Style();
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'password-strength-meter' );
			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/loginer-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
			wp_localize_script(
				$this->plugin_name,
				'iFrameStyle',
				array(
					'theme_css'           => $this->loginer_output_files( get_stylesheet_directory() ),
					'admin_css'           => plugin_dir_url( __DIR__ ) . 'admin/css/loginer-admin.css',
					'public_css'          => plugin_dir_url( __DIR__ ) . 'public/css/loginer-public.css',
					'custom_css'          => $style->loginer_custom_style(),
					'custom_js'           => plugin_dir_url( __DIR__ ) . 'public/js/jquery-3.5.1.js',
					'pass_strength'       => plugin_dir_url( __DIR__ ) . 'public/js/password-strength-meter-mediator.js',
					'pass_meter_strength' => admin_url() . 'js/password-strength-meter.js',
					'pass_meter'          => plugin_dir_url( __DIR__ ) . 'admin/js/password-meter.js',
					'short'               => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT ),
					'bad'                 => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_BAD ),
					'good'                => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_GOOD ),
					'strong'              => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_STRONG ),
				)
			);
			wp_enqueue_script( $this->plugin_name );
			wp_register_script( 'reset-button', plugin_dir_url( __FILE__ ) . 'js/reset-button.js', array(), $this->version, false );
			$pass_data = array(
				'ajax_nonce' => wp_create_nonce( 'ajax_nonce' ),
			);
			wp_localize_script( 'reset-button', 'pass_data', $pass_data );
			wp_enqueue_script( 'reset-button' );
			wp_register_script( 'password_meter', plugin_dir_url( __FILE__ ) . 'js/password-meter.js', array(), $this->version, false );
			wp_enqueue_script( 'password_meter' );
		}
	}

	/** This function add the menu or submenu page in wodpress admin panel */
	public function loginer_setting_options() {
		add_menu_page( '', __( 'Loginer', 'loginer' ), 'administrator', LOGINER_FORM_SETTING, '', 'dashicons-admin-tools' );
		add_submenu_page( LOGINER_FORM_SETTING, __( 'Loginer Setting Options', 'loginer' ), __( 'Form Style', 'loginer' ), 'administrator', LOGINER_FORM_SETTING, array( $this, 'loginer_menu_callback' ), null );
		add_submenu_page( LOGINER_FORM_SETTING, __( 'Setting', 'loginer' ), __( 'Settings', 'loginer' ), 'administrator', LOGINER_FORM_SUBSETTING, array( $this, 'loginer_submenu_callback' ), null );
	}

	/** This function Registers the Required Settings And Sections */
	public function loginer_register_settings() {
		add_settings_section(
			LOGINER_SUBMENU_SETTING_GROUP,      // ID used to identify this section and with which to register options.
			__( 'Settings', 'loginer' ),                  // Title to be displayed on the administration page.
			array( $this, 'loginer_menu_callback' ), // Callback used to render the description of the section.
			__FILE__ . '/setting'                           // Page on which to add this section of options.
		);
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_RESTRICTED_ROLE );
		// Show page title.
		register_setting( LOGINER_SETTING_OPTIONS_GROUP, LOGINER_CUSTOM_SHOW_PAGE_TITLE );
		// Strength Meter Options.
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_NEW_REGISTRATION_MAIL );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_BAD );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_GOOD );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_STRONG );
		// settings validation callback array.
		$args = array(
			'type'              => 'array',
			'sanitize_callback' => array( $this, 'loginer_validate_settings' ),
		);
		register_setting( LOGINER_SETTING_OPTIONS_GROUP, LOGINER_SETTING_OPTIONS_GROUP, $args );
		register_setting( LOGINER_SUBMENU_SETTING_GROUP, LOGINER_SUBMENU_SETTING_GROUP, $args );
	}

	/**
	 * Validate settings
	 *
	 * @param string $input Input Fields Array.
	 */
	public function loginer_validate_settings( $input ) {
		$keys   = array_keys( $input );
		$length = count( $input );
		for ( $i = 0; $i < $length; $i++ ) {
			if ( is_array( $input[ $keys[ $i ] ] ) ) {
				foreach ( $input[ $keys[ $i ] ] as $key => $value ) {
					$input[ $keys[ $i ] ][ $key ] = sanitize_text_field( $value );
				}
			}
		}
		return $input;
	}
	/** This function is called On Submenu Page Of the Plugin Settings */
	public function loginer_submenu_callback() {
		require_once plugin_dir_path( __FILE__ ) . 'partials' . DIRECTORY_SEPARATOR . 'loginer-admin-submenu-option.php';

	}
	/** This function is called On Main Menu page Of the Plugin Settings */
	public function loginer_menu_callback() {
		require_once plugin_dir_path( __FILE__ ) . 'partials' . DIRECTORY_SEPARATOR . 'loginer-admin-form-option.php';
	}
	/** Function to redirect user to custom login page after logged out. */
	public function loginer_custom_admin_redirect() {
		$option = get_option( LOGINER_SUBMENU_SETTING_GROUP );
		if ( is_array( $option ) && in_array( $option['pluginpages']['Profile'], $option['pluginpages'], true ) ) {
			$custom_my_account = $option['pluginpages']['Profile'];
		}
		$profileuser     = wp_get_current_user();
		$restricted_role = get_option( LOGINER_RESTRICTED_ROLE ) ? get_option( LOGINER_RESTRICTED_ROLE ) : array();
		if ( is_user_logged_in() && ! is_super_admin() ) {
			if ( in_array( $profileuser->roles[0], $restricted_role, true ) ) {
				$user_account = esc_url( get_permalink( $custom_my_account ) );
				$redirect_url = add_query_arg( 'status', 'restricted', $user_account );
				wp_safe_redirect( $redirect_url );
			}
		}
	}
	/**
	 * This Function Fetches the all css files used in Preview Panel.
	 *
	 * @param string $dir_path    The Path Of the Directory.
	 *
	 * @since    1.0.0
	 */
	private function loginer_output_files( $dir_path ) {
		static $css_files;
		static $file_index = 1;
		if ( file_exists( $dir_path ) && is_dir( $dir_path ) ) {
			$files = glob( $dir_path . '/*' );
			if ( count( $files ) > 0 ) {
				foreach ( $files as $file ) {
					$pathinfo = pathinfo( $file );
					if ( is_file( $file ) && isset( $pathinfo['extension'] ) && 'css' === $pathinfo['extension'] ) {
						$css_files[ 'css_file' . $file_index ] = substr( get_stylesheet_directory_uri(), 0, stripos( get_stylesheet_directory_uri(), 'themes' ) ) . substr( $file, stripos( $file, 'themes' ) );
						$file_index++;
					} elseif ( is_dir( $file ) ) {
						// Recursively call the function if directories found.
						$this->loginer_output_files( $file );
					}
				}
			}
		}
		return $css_files;
	}
}
