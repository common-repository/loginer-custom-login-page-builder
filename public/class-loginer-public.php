<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Loginer
 * @subpackage Loginer/public
 */

/** This File Has the Parent class of his class */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-sub-loginer.php';
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 */
class Loginer_Public extends Sub_Loginer {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function loginer_public_styles() {

		/**
		 * This function Enqueues the Stylesheets.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Login_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __FILE__ ) . 'css/loginer-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function loginer_public_scripts() {

		/**
		 * This function Enqueues the Scripts.
		 *
		 * An instance of this is passed to the run() function
		 * defined in Login_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Login_Loader creates the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$options  = get_option( LOGINER_SUBMENU_SETTING_GROUP );
		$page_ids = $options['pluginpages'];
		if ( is_page( $page_ids ) ) {
			wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/loginer-public.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name );

			if ( 'yes' === get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER ) ) {
				wp_enqueue_script( 'password-strength-meter' );
				wp_register_script( 'password-strength-meter-mediator', plugin_dir_url( __FILE__ ) . 'js/password-strength-meter-mediator.js', array( 'jquery' ), $this->version, false );
				wp_localize_script(
					'password-strength-meter-mediator',
					'usercheck',
					array(
						'short'  => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_SHORT ),
						'bad'    => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_BAD ),
						'good'   => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_GOOD ),
						'strong' => get_option( LOGINER_CUSTOM_PASSWORD_STRENGTH_METER_OPTION_STRONG ),
					)
				);
				wp_enqueue_script( 'password-strength-meter-mediator' );
			}
		}

	}

	/**
	 * Function to send the notification mail to user
	 *
	 * @param string $user_email get the error messege of particular case.
	 * @param string $user get the email address of user.
	 * @param string $blogname get the blog name of user.
	 */
	public function loginer_user_notification_email( $user_email, $user, $blogname ) {
		$custom_login_page = $this->loginer_plugin_pages_ids( 'Sign in' );
		if ( get_option( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL ) === 'yes' ) {
			// Create the mail text.
			/* translators: %s:  blogname */
			$message  = sprintf( __( "Welcome to %s! Here's your log in credentials:" ), $blogname ) . "\r\n";
			$message .= get_permalink( $custom_login_page ) . "\r\n";
			/* translators: %s:  username */
			$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n";
			/* translators: %s:  password */
			$message .= sprintf( __( 'Password: %s' ), wp_verify_nonce( sanitize_key( isset( $_POST['password'] ) ) ) ) . "\r\n\r\n";
			/* translators: %s:  email address */
			$message .= sprintf( __( 'If you have any problems, please contact at %s.' ), get_option( 'admin_email' ) ) . "\r\n";
			/* translators: %s:  email address */
			$user_email['message'] = $message;
		}

		return $user_email;
	}

	/** Function to redirect user to the custom login page instead of wp-login. */
	public function loginer_login_redirect() {
		$custom_login_page = $this->loginer_plugin_pages_ids( 'Sign in' );
		// Nonce verification.
		if ( isset( $_POST['_wpnonce_login-nonce'] ) ) {
			wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_login-nonce'] ) ), 'login-nonce' );

		}
		$redirect_to = isset( $_REQUEST['redirect_to'] ) ? explode( ',', sanitize_text_field( wp_unslash( $_REQUEST['redirect_to'] ) ) ) : null;
		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->loginer_logged_in_user_redirect( $redirect_to[0] );
				exit;
			}

			// Redirect user to the login page.
			$redirect_url = get_permalink( $custom_login_page );

			if ( null !== $redirect_to ) {
				$redirect_url = add_query_arg( 'redirect_to', rawurlencode( $redirect_to[0] ), $redirect_url );
			}
			wp_safe_redirect( $redirect_url );
		}
	}

	/**
	 * Function to get the html of particular page.
	 *
	 * @param string $content get the previous Content of page.
	 */
	public function loginer_get_page_content( $content ) {
		global $post;
		$option = get_option( LOGINER_SUBMENU_SETTING_GROUP )['pluginpages'];
		if ( get_post_type() === 'post' ) {
			$page_id = get_option( 'page_for_posts' );
		} else {
			$page_id = (string) $post->ID;
		}
		ob_start();
		$pages    = array( 'Sign in', 'Registration', 'Profile', 'Forgot Password', 'Reset Password' );
		$template = array( 'custom-login-form', 'custom-register-form', 'custom-account-page', 'custom-lost-password-form', 'custom-reset-password-form' );
		foreach ( $pages as $index => $page ) {
			if ( function_exists( 'icl_object_id' ) ) {
				$trans_id = icl_object_id( $option[ $page ], 'page', true, ICL_LANGUAGE_CODE );
				if ( (string) $trans_id === (string) $post->ID ) {
					require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template[ $index ] . '.php';
					break;
				}
			} else {
				if ( (string) $option[ $page ] === $page_id ) {
					require plugin_dir_path( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template[ $index ] . '.php';
					break;
				}
			}
		}
		$cache_content = ob_get_contents();
		ob_end_clean();
		return $content . $cache_content;
	}

	/** Function to handle user registeration rediraction. */
	public function loginer_registeration() {
		$custom_login_page    = $this->loginer_plugin_pages_ids( 'Sign in' );
		$custom_register_page = $this->loginer_plugin_pages_ids( 'Registration' );
		check_admin_referer( 'register-nonce', '_wpnonce_register-nonce' );
		$user_login    = ( isset( $_POST['user_login'] ) ) ? sanitize_text_field( wp_unslash( $_POST['user_login'] ) ) : '';
		$user_email    = ( isset( $_POST['user_email'] ) ) ? sanitize_text_field( wp_unslash( $_POST['user_email'] ) ) : '';
		$user_password = ( isset( $_POST['password'] ) ) ? sanitize_text_field( wp_unslash( $_POST['password'] ) ) : '';
		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
			$register_url = get_permalink( $custom_register_page );
			if ( ! get_option( 'users_can_register' ) ) {
				// Registration closed, display error.
				$redirect_url = add_query_arg( 'errors', 'closed', $register_url );
			} else {
				$registerwithpass = get_option( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL );
				if ( 'yes' !== $registerwithpass ) {
					$result = $this->loginer_register_user( $user_login, $user_email );
				} else {
					$result = $this->loginer_register_user( $user_login, $user_email, $user_password );
				}
				if ( is_wp_error( $result ) ) {
					// Parse errors into a string and append as parameter to redirect.
					$errors       = join( ',', $result->get_error_codes() );
					$redirect_url = add_query_arg( 'errors', $errors, $register_url );
				} else {
					// Success, redirect to login page.
					$login_url    = get_permalink( $custom_login_page );
					$redirect_url = add_query_arg( 'registered', $user_email, $login_url );
				}
			}
			wp_safe_redirect( $redirect_url );
			exit;
		}
	}

	/**
	 *
	 * Function to handle user registeration and send mail.
	 *
	 * @param string $username get the user name.
	 * @param string $email get the email.
	 * @param string $password get the password.
	 */
	private function loginer_register_user( $username, $email, $password = '' ) {
		$errors = new WP_Error();
		check_admin_referer( 'register-nonce', '_wpnonce_register-nonce' );
		$confirm_password = ( isset( $_POST['confirm_password'] ) ) ? sanitize_text_field( wp_unslash( $_POST['confirm_password'] ) ) : '';
		// Email address is used as both username and email. It is also the only.
		// parameter we need to validate.
		if ( ! is_email( $email ) ) {
			$errors->add( LOGINER_INVALID_EMAIL, $this->loginer_get_error_message( LOGINER_INVALID_EMAIL ) );
			return $errors;
		}

		if ( username_exists( $username ) ) {
			$errors->add( LOGINER_USER_EXISTS, $this->loginer_get_error_message( LOGINER_USER_EXISTS ) );
			return $errors;
		}
		if ( email_exists( $email ) ) {
			$errors->add( LOGINER_EMAIL_EXISTS, $this->loginer_get_error_message( LOGINER_EMAIL_EXISTS ) );
			return $errors;
		}
		if ( $password !== $confirm_password ) {
			$errors->add( LOGINER_PASSWORD_MISMATCH, $this->loginer_get_error_message( LOGINER_PASSWORD_MISMATCH ) );
			return $errors;
		}

		$user_data = array(
			'user_login' => $username,
			'user_email' => $email,
			'user_pass'  => $password,
		);
		if ( ! empty( $password ) ) {
			$user_id = wp_insert_user( $user_data );
			wp_set_password( $password, $user_id );
			wp_new_user_notification( $user_id, null, 'both' );
		} else {
			$user_id = wp_insert_user( $user_data );
			wp_new_user_notification( $user_id, null, 'both' );
		}

		return $user_id;
	}

	/**
	 * Function to authenticate user and redirect if there were any errors.
	 *
	 * @param string $user Check the currently loged in user.
	 */
	public function loginer_authentication( $user ) {
		$custom_login_page = $this->loginer_plugin_pages_ids( 'Sign in' );
		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
			if ( is_wp_error( $user ) ) {
				$error_codes  = join( ',', $user->get_error_codes() );
				$login_url    = get_permalink( $custom_login_page );
				$redirect_url = add_query_arg( 'errors', $error_codes, $login_url );

				wp_safe_redirect( $redirect_url );
				exit;
			}
		}
		return $user;
	}

	/**
	 * Prevent caching on certain pages
	 */
	public function loginer_prevent_caching() {
		if ( ! is_blog_installed() ) {
			return;
		}
		$option   = get_option( LOGINER_SUBMENU_SETTING_GROUP );
		$page_ids = $option['pluginpages'];
		if ( is_page( $page_ids ) ) {
			$this->loginer_set_nocache_constants();
			nocache_headers();
		}
	}

	/**
	 * Set constants to prevent caching by some plugins.
	 *
	 * @param  mixed $return Value to return. Previously hooked into a filter.
	 * @return mixed
	 */
	public function loginer_set_nocache_constants( $return = true ) {
		$this->loginer_maybe_define_constant( 'DONOTCACHEPAGE', true );
		$this->loginer_maybe_define_constant( 'DONOTCACHEOBJECT', true );
		$this->loginer_maybe_define_constant( 'DONOTCACHEDB', true );
		return $return;
	}

	/**
	 * Define a constant if it is not already defined.
	 *
	 * @since 1.0.0
	 * @param string $name  Constant name.
	 * @param mixed  $value Value.
	 */
	private function loginer_maybe_define_constant( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}
}
