<?php
/**
 * The file that defines the core plugin file
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Loginer
 * @subpackage Loginer/includes
 *
 * @since      1.0
 * @author     SofSter
 */

/** The file that defines the core plugin file. */
class Loginer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      Loginer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0
	 */
	public function __construct() {
		if ( defined( 'LOGINER_VERSION' ) ) {
			$this->version = LOGINER_VERSION;
		} else {
			$this->version = '1.0';
		}
		$this->plugin_name = 'loginer';

		$this->loginer_load_dependencies();
		$this->loginer_set_locale();
		$this->loginer_define_admin_hooks();
		$this->loginer_define_public_hooks();
		$this->loginer_set_global_constants();
		$this->loginer_setting_default_values();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Loginer_Loader. Orchestrates the hooks of the plugin.
	 * - Loginer_I18n. Defines internationalization functionality.
	 * - Loginer_Adminer. Defines all hooks for the admin area.
	 * - Loginer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function loginer_load_dependencies() {

		/**
		 * The class is responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes' . DIRECTORY_SEPARATOR . 'class-loginer-loader.php';

		/**
		 * The class is responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes' . DIRECTORY_SEPARATOR . 'class-loginer-i18n.php';

		/**
		 * The class is responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin' . DIRECTORY_SEPARATOR . 'class-loginer-admin.php';

		/**
		 * The class is responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-public.php';

		/**
		 * The class is responsible for defining all Backend Style Customizations
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-style.php';

		$this->loader = new Loginer_Loader();

	}

	/**
	 * Define the locale and custom style for this plugin for internationalization.
	 *
	 * Uses the Loginer_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function loginer_set_locale() {

		$plugin_i18n = new loginer_I18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin and public area functionality
	 * of the plugin.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function loginer_define_admin_hooks() {

		$plugin_admin = new Loginer_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'loginer_admin_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'loginer_admin_scripts' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'loginer_custom_admin_redirect' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'loginer_setting_options' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'loginer_register_settings' );
		$this->loader->add_action( 'wp_ajax_form_reset_button', $this, 'loginer_form_reset_button' );
		// This Filter adds Page description at page list.
		$this->loader->add_filter( 'display_post_states', $plugin_admin, 'loginer_add_display_post_states', 10, 2 );

		/**
		 * This Filter adds the links on the admin installed plugin page
		 */
		$this->loader->add_filter( 'plugin_action_links_' . LOGINER_BASENAME, $plugin_admin, 'loginer_add_action_links' );
	}

	/**
	 * Register all of the hooks related to the admin and public area functionality
	 * of the plugin.
	 *
	 * @since    1.0
	 * @access   private
	 */
	private function loginer_define_public_hooks() {

		$plugin_public = new Loginer_Public( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'loginer_public_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'loginer_public_scripts' );

		/** Actions */
		$this->loader->add_action( 'login_form_login', $plugin_public, 'loginer_login_redirect' );
		$this->loader->add_action( 'login_form_register', $plugin_public, 'loginer_registeration_redirect' );
		$this->loader->add_action( 'login_form_register', $plugin_public, 'loginer_registeration' );
		$this->loader->add_action( 'login_form_lostpassword', $plugin_public, 'loginer_forgot_password_redirect' );
		$this->loader->add_action( 'login_form_rp', $plugin_public, 'loginer_reset_password_redirect' );
		$this->loader->add_action( 'login_form_resetpass', $plugin_public, 'loginer_reset_password_redirect' );
		$this->loader->add_action( 'login_form_rp', $plugin_public, 'loginer_reset_password' );
		$this->loader->add_action( 'login_form_resetpass', $plugin_public, 'loginer_reset_password' );
		$this->loader->add_action( 'wp_logout', $plugin_public, 'loginer_logout_redirect' );
		$this->loader->add_action( 'wp', $plugin_public, 'loginer_prevent_caching' );

		/** Filter */
		$this->loader->add_filter( 'authenticate', $plugin_public, 'loginer_authentication', 101, 3 );
		$this->loader->add_filter( 'login_redirect', $plugin_public, 'loginer_login_success_redirect', 10, 3 );
		$this->loader->add_filter( 'woocommerce_login_redirect', $plugin_public, 'loginer_login_success_redirect', 10, 3 );
		$this->loader->add_filter( 'woocommerce_registration_redirect', $plugin_public, 'loginer_registeration_redirect' );
		$this->loader->add_filter( 'wp_new_user_notification_email', $plugin_public, 'loginer_user_notification_email', 10, 3 );
		$this->loader->add_filter( 'show_admin_bar', $this, 'loginer_display_adminbar' );
		$style_loader = new Loginer_Style();
		$this->loader->add_action( 'wp_head', $style_loader, 'loginer_custom_style' );
		$this->loader->add_filter( 'the_content', $plugin_public, 'loginer_get_page_content', 12 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0
	 * @return    Login_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * This functions sets the value of the global array in the global options page.
	 */
	public function loginer_set_global_constants() {
		$option_keys = array( 'pluginpages', 'headings', 'labels', 'errormsg', 'placeholder', 'formstyle', 'setting_options_group', 'submenu_setting_group', 'restricted_role', 'custom_show_page_title', 'custom_new_registration_mail', 'custom_password_strength_meter', 'custom_password_strength_meter_option_short', 'custom_password_strength_meter_option_bad', 'custom_password_strength_meter_option_good', 'custom_password_strength_meter_option_strong', 'default_login', 'default_register', 'default_lost_pass', 'default_reset_pass', 'default_account', 'default_loggedin', 'default_empty_uname', 'default_empty_pass', 'default_inval_uname', 'default_inval_email', 'default_inval_combo', 'default_wrong_pass', 'default_user_exists', 'default_email_exists', 'default_reg_closed', 'default_expired_key', 'default_invalid_key', 'default_pass_nomatch', 'custom_login_page_id', 'custom_my_account_id', 'custom_register_page_id', 'custom_lost_password_page_id', 'custom_reset_password_page_id', 'login_heading', 'register_heading', 'lost_pass_heading', 'reset_pass_heading', 'account_heading', 'username_label', 'email_label', 'password_label', 'confirm_password_label', 'new_password_label', 'repeat_new_password_label', 'already_loggedin', 'empty_username', 'empty_password', 'invalid_username', 'invalid_email', 'invalidcombo', 'incorrect_password', 'user_exists', 'email_exists', 'registeration_closed', 'expired_key', 'invalid_key', 'password_mismatch', 'email_placeholder', 'username_placeholder', 'password_placeholder', 'confirm_password_placeholder', 'new_password_placeholder', 'confirm_new_password_placeholder', 'background_color', 'border_style', 'border_color', 'border_width', 'border_radius', 'margin_top', 'margin_right', 'margin_bottom', 'margin_left', 'padding_top', 'padding_bottom', 'padding_left', 'padding_right', 'shadow_color', 'shadow_enable', 'heading_color', 'heading_border_color', 'heading_border_style', 'heading_border_width', 'heading_border_radius', 'heading_margin_top', 'heading_margin_right', 'heading_margin_bottom', 'heading_margin_left', 'heading_padding_top', 'heading_padding_right', 'heading_padding_bottom', 'heading_padding_left', 'heading_font_size', 'heading_background_color', 'paragraph_color', 'paragraph_font_size', 'label_color', 'label_font_size', 'link_color', 'link_font_size', 'link_hover_color', 'button_background_color', 'button_color', 'button_font_size', 'button_border_style', 'button_border_color', 'button_border_width', 'button_border_radius', 'button_hover_background_color', 'button_hover_color', 'input_background_color', 'input_color', 'input_font_size', 'input_border_style', 'input_border_color', 'input_border_width', 'input_border_radius', 'requiredfield_color', 'input_bottom_border', 'input_focus_background_color', 'input_focus_color', 'input_focus_border_color', 'logged_out', 'registered', 'lostpassword', 'reset_password', 'default_logged_out', 'default_registered', 'default_lostpassword', 'default_reset_password', 'emailuser_label', 'emailuser_place' );
		/** Option Keys */
		foreach ( $option_keys as $opt_key ) {
			$this->loginer_create_array_constants( strtoupper( $opt_key ), $opt_key );
		}
	}

	/**
	 * This function creates the constants which sets the global values of the array to be set by default.
	 *
	 * @param string $constant_name The name of the constant.
	 * @param string $value The value to be stored in the constant.
	 */
	private function loginer_create_array_constants( $constant_name, $value ) {
		$constant_name_prefix = 'LOGINER_';
		$constant_name        = $constant_name_prefix . $constant_name;
		if ( ! defined( $constant_name ) ) {
			define( $constant_name, $value );
		}
	}

	/** This function is used for setting default values of the elements */
	private function loginer_setting_default_values() {
		$GLOBALS[ LOGINER_DEFAULT_LOGIN ]      = __( 'Sign In', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_REGISTER ]   = __( 'Registration', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_LOST_PASS ]  = __( 'Forgot Password', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_RESET_PASS ] = __( 'Reset Password', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_ACCOUNT ]    = __( 'Profile', 'loginer' );

		$GLOBALS[ LOGINER_DEFAULT_LOGGEDIN ]     = __( 'You are Already Logged in.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_EMPTY_UNAME ]  = __( 'Username can not be Empty.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_EMPTY_PASS ]   = __( 'Password can not be Empty.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_INVAL_UNAME ]  = __( 'Invalid Username.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_INVAL_EMAIL ]  = __( 'Invalid Email.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_INVAL_COMBO ]  = __( 'No user registered with this Email.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_WRONG_PASS ]   = __( 'Incorrect Password.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_USER_EXISTS ]  = __( 'An account exists with this username.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_EMAIL_EXISTS ] = __( 'An account exists with this email address.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_REG_CLOSED ]   = __( 'Registering new users is currently not allowed.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_EXPIRED_KEY ]  = __( 'Password reset Link Expired.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_INVALID_KEY ]  = __( 'Password reset Link is Not Valid.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_PASS_NOMATCH ] = __( 'Password and Confirm Password do not match.', 'loginer' );

		$GLOBALS[ LOGINER_DEFAULT_LOGGED_OUT ]     = __( 'You are now logged out.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_REGISTERED ]     = __( 'Registration complete please check your email.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_RESET_PASSWORD ] = __( 'Your password has been reset.', 'loginer' );
		$GLOBALS[ LOGINER_DEFAULT_LOSTPASSWORD ]   = __( 'Check your email for the confirmation link.', 'loginer' );
	}

	/** Handle the request of refresh button. */
	public function loginer_form_reset_button() {
		check_ajax_referer( 'ajax_nonce', 'security' );
		if ( isset( $_POST['activetab'] ) ) {
			$activetabname = sanitize_text_field( wp_unslash( $_POST['activetab'] ) );
		}
		$option                   = get_option( LOGINER_SETTING_OPTIONS_GROUP );
		$option[ $activetabname ] = '';
		$result                   = update_option( LOGINER_SETTING_OPTIONS_GROUP, $option );

		echo esc_attr( $result );
		die();
	}
	/**
	 * To Remove the Admin Bar For the Restricted users.
	 */
	public function loginer_display_adminbar() {
		if ( is_user_logged_in() ) {
			$profileuser     = wp_get_current_user();
			$restricted_role = get_option( LOGINER_RESTRICTED_ROLE ) ? get_option( LOGINER_RESTRICTED_ROLE ) : array();
			if ( in_array( $profileuser->roles[0], $restricted_role, true ) ) {
				return false;
			} else {
				return true;
			}
		}
	}

}
