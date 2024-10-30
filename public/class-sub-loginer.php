<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Loginer
 * @subpackage Loginer/includes
 */

/**
 * The core plugin class which is the parent of Class Loginer_Public.
 *
 * @since      1.0.0
 * @package    Loginer
 * @subpackage Loginer/includes
 * @author     SofSter
 */
class Sub_Loginer {

	/**
	 * Function to return error message for the given error code
	 *
	 * @param string $error_code get the error messege of particular case.
	 */
	public function loginer_get_error_message( $error_code ) {
		$default = array(
			LOGINER_ALREADY_LOGGEDIN     => $GLOBALS[ LOGINER_DEFAULT_LOGGEDIN ],
			LOGINER_EMPTY_USERNAME       => $GLOBALS[ LOGINER_DEFAULT_EMPTY_UNAME ],
			LOGINER_EMPTY_PASSWORD       => $GLOBALS[ LOGINER_DEFAULT_EMPTY_PASS ],
			LOGINER_INVALID_USERNAME     => $GLOBALS[ LOGINER_DEFAULT_INVAL_UNAME ],
			LOGINER_INVALID_EMAIL        => $GLOBALS[ LOGINER_DEFAULT_INVAL_EMAIL ],
			LOGINER_INVALIDCOMBO         => $GLOBALS[ LOGINER_DEFAULT_INVAL_COMBO ],
			LOGINER_INCORRECT_PASSWORD   => $GLOBALS[ LOGINER_DEFAULT_WRONG_PASS ],
			LOGINER_USER_EXISTS          => $GLOBALS[ LOGINER_DEFAULT_USER_EXISTS ],
			LOGINER_EMAIL_EXISTS         => $GLOBALS[ LOGINER_DEFAULT_EMAIL_EXISTS ],
			LOGINER_REGISTERATION_CLOSED => $GLOBALS[ LOGINER_DEFAULT_REG_CLOSED ],
			LOGINER_EXPIRED_KEY          => $GLOBALS[ LOGINER_DEFAULT_EXPIRED_KEY ],
			LOGINER_INVALID_KEY          => $GLOBALS[ LOGINER_DEFAULT_INVALID_KEY ],
			LOGINER_PASSWORD_MISMATCH    => $GLOBALS[ LOGINER_DEFAULT_PASS_NOMATCH ],
		);
		if ( $this->loginer_get_option_values( $error_code ) ) {
			return $this->loginer_get_option_values( $error_code );
		} else {
			return $default[ $error_code ];
		}
		return esc_attr_e( 'An unknown error occurred. Please try again later.', 'loginer' );
	}

	/**
	 * Function to redirects user to the page depending user is an admin or not.
	 *
	 * @param string $redirect_to Check the redirection.
	 */
	public function loginer_logged_in_user_redirect( $redirect_to = null ) {
		$custom_my_account = $this->loginer_plugin_pages_ids( 'Profile' );
		if ( $redirect_to ) {
			wp_safe_redirect( $redirect_to[0] );
		} else {
			wp_safe_redirect( get_permalink( $custom_my_account ) );
		}
	}

	/** Function to redirect user to custom registration page */
	public function loginer_registeration_redirect() {
		$custom_register_page = $this->loginer_plugin_pages_ids( 'Register' );
		check_admin_referer( 'register-nonce', '_wpnonce_register-nonce' );
		if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
			if ( is_user_logged_in() ) {
				$this->loginer_logged_in_user_redirect();
			} else {
				wp_safe_redirect( get_permalink( $custom_register_page ) );
			}
			exit;
		}
	}

	/**
	 * Function to get URL to which the user should be redirected after login.
	 *
	 * @param string $redirect_to URL to redirect to.
	 * @param string $req_redirect_to URL the user is coming from.
	 * @param string $user check the password.
	 */
	public function loginer_login_success_redirect( $redirect_to, $req_redirect_to, $user ) {
		$custom_my_account = $this->loginer_plugin_pages_ids( 'Profile' );
		$slug              = get_post_field( 'post_name', $custom_my_account );
		$redirect_url      = $redirect_to;
		if ( ! isset( $user->ID ) ) {
			return $redirect_to;
		}
		$user_info = get_userdata( $user->ID );
		if ( admin_url() === $req_redirect_to ) {
			if ( $user_info->primary_blog ) {
				$primary_url = get_blogaddress_by_id( $user_info->primary_blog );
				if ( $primary_url ) {
					$redirect_url = $primary_url . $slug;
				}
			}
			$redirect_url = get_permalink( $custom_my_account );
		} else {
			$redirect_url = $req_redirect_to;
		}
		return wp_validate_redirect( $redirect_url );
	}

	/** Function to redirect user to custom login page after logged out. */
	public function loginer_logout_redirect() {
		$custom_login_page = $this->loginer_plugin_pages_ids( 'Sign in' );
		$login_url         = get_permalink( $custom_login_page );
		$redirect_url      = add_query_arg( 'logged_out', 'success', $login_url );
		wp_safe_redirect( $redirect_url );
		exit;
	}

	/** Function to redirect user to custom lost password form  */
	public function loginer_forgot_password_redirect() {
		$custom_lost_pass_pg = $this->loginer_plugin_pages_ids( 'Forgot Password' );
		$custom_login_page   = $this->loginer_plugin_pages_ids( 'Sign in' );
		if ( isset( $_SERVER['REQUEST_METHOD'] ) ) {
			if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
				$errors = retrieve_password();
				if ( is_wp_error( $errors ) ) {
					// Errors found.
					$redirect_url = get_permalink( $custom_lost_pass_pg );
					$redirect_url = add_query_arg( 'errors', join( ',', $errors->get_error_codes() ), $redirect_url );
				} else {
					// Email sent.
					$redirect_url = get_permalink( $custom_login_page );
					$redirect_url = add_query_arg( 'lostpassword', 'success', $redirect_url );
				}
				wp_safe_redirect( $redirect_url );
				exit;
			} else {
				if ( is_user_logged_in() ) {
						$this->loginer_logged_in_user_redirect();
						exit;
				}
				wp_safe_redirect( get_permalink( $custom_lost_pass_pg ) );
				exit;
			}
		}
	}

	/** Function to redirect user to custom reset password form  */
	public function loginer_reset_password_redirect() {
		$custom_reset_pass_pg = $this->loginer_plugin_pages_ids( 'Reset Password' );
		$custom_login_page    = $this->loginer_plugin_pages_ids( 'Sign in' );
		if ( ! isset( $_POST['_wpnonce_resetpassword_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_resetpassword_nonce'] ) ), 'resetpassword_nonce' ) ) {
				if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
					// Verify key / login combo.
					if ( isset( $_REQUEST['key'] ) && isset( $_REQUEST['login'] ) ) {
						$user = check_password_reset_key( sanitize_text_field( wp_unslash( $_REQUEST['key'] ) ), sanitize_text_field( wp_unslash( $_REQUEST['login'] ) ) );
					}
					if ( ! $user || is_wp_error( $user ) ) {
						$login_url    = get_permalink( $custom_login_page );
						$redirect_url = add_query_arg( 'errors', 'invalid_key', $login_url );
						wp_safe_redirect( $redirect_url );
						exit;
					}

					$redirect_url = get_permalink( $custom_reset_pass_pg );
					$redirect_url = add_query_arg( 'login', esc_attr( sanitize_text_field( wp_unslash( $_REQUEST['login'] ) ) ), $redirect_url );
					$redirect_url = add_query_arg( 'key', esc_attr( sanitize_text_field( wp_unslash( $_REQUEST['key'] ) ) ), $redirect_url );

					wp_safe_redirect( $redirect_url );
					exit;
				}
			}
		}
	}

	/** Function to handle user input for reset password */
	public function loginer_reset_password() {
		if ( isset( $_POST['_wpnonce_resetpassword_nonce'] ) ) {
			if ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce_resetpassword_nonce'] ) ), 'resetpassword-nonce' ) ) {
				if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
					$rp_key    = ( isset( $_REQUEST['rp_key'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['rp_key'] ) ) : '';
					$rp_login  = ( isset( $_REQUEST['rp_login'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['rp_login'] ) ) : '';
					$login_url = get_permalink( $this->loginer_plugin_pages_ids( 'Sign in' ) );
					$user      = check_password_reset_key( $rp_key, $rp_login );
					if ( is_wp_error( $user ) ) {
						$reset_url    = get_permalink( $this->loginer_plugin_pages_ids( 'Reset Password' ) );
						$redirect_url = add_query_arg( 'errors', 'expired_key', $reset_url );
						wp_safe_redirect( $redirect_url );
						exit;
					}
					$pass = ( isset( $_POST['password'] ) ) ? sanitize_text_field( wp_unslash( $_POST['password'] ) ) : '';
					// Parameter checks OK, reset password.
					reset_password( $user, $pass );
					$redirect_url = add_query_arg( 'password', 'changed', $login_url );
					wp_safe_redirect( $redirect_url );
					exit;
				}
			}
		}
	}

	/**
	 * Set constants to prevent caching by some plugins.
	 *
	 * @param  string $page index for the page to which it.
	 */
	public function loginer_plugin_pages_ids( $page ) {
		$option = get_option( LOGINER_SUBMENU_SETTING_GROUP );
		if ( is_array( $option ) ) {
			$pages_id = $option['pluginpages'];
		}
		if ( is_array( $pages_id ) && isset( $pages_id[ $page ] ) ) {
			return $pages_id[ $page ];
		}
	}

	/**
	 * This function Returns the Value Of The Given Option
	 *
	 * @param string $option The name of the setting option.
	 */
	public function loginer_get_option_values( $option ) {
		$custom_options = get_option( LOGINER_SETTING_OPTIONS_GROUP );
		if ( is_array( $custom_options ) ) {
			foreach ( $custom_options as $section ) {
				if ( isset( $section[ $option ] ) ) {
					// sanitize text field values in array.
					return sanitize_text_field( $section[ $option ] );
				}
			}
		}
	}
}
