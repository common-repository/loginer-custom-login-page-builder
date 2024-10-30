<?php
/**
 * Fired during plugin activation
 *
 * @author     SofSter
 * @since      1.0
 *
 * @package    Login
 * @subpackage Login/includes
 */

/**
 * Fired during plugin activation.
 */
class Loginer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Slug name as per the page title.
	 *
	 * @since    1.0
	 */
	public static function activate() {
		$custom_pages = array(
			'sign-in'         => array(
				'title' => 'Sign In',
			),
			'profile'         => array(
				'title' => 'Profile',
			),
			'registration'    => array(
				'title' => 'Registration',
			),
			'forgot-password' => array(
				'title' => 'Forgot Password',
			),
			'reset-password'  => array(
				'title' => 'Reset Password',
			),
		);
		foreach ( $custom_pages as $slug => $page ) {
			// Page already exist or not.
			$query = new WP_Query( 'pagename=' . $slug );
			if ( ! $query->have_posts() ) {
				// Add page using data from the above array.
				$post_id = wp_insert_post(
					array(
						'post_name'      => $slug,
						'post_title'     => $page['title'],
						'post_status'    => 'publish',
						'post_type'      => 'page',
						'ping_status'    => 'closed',
						'comment_status' => 'closed',
					)
				);

				switch ( $slug ) {
					case 'sign-in':
						$my_options['pluginpages']['Sign in'] = $post_id;
						break;
					case 'profile':
						$my_options['pluginpages']['Profile'] = $post_id;
						break;
					case 'registration':
						$my_options['pluginpages']['Registration'] = $post_id;
						break;
					case 'forgot-password':
						$my_options['pluginpages']['Forgot Password'] = $post_id;
						break;
					case 'reset-password':
						$my_options['pluginpages']['Reset Password'] = $post_id;
						break;
				}
				update_option( LOGINER_SUBMENU_SETTING_GROUP, $my_options );
			}
		}

		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$default_settings = array( 'subscriber', 'customer' );
		} else {
			$default_settings = array( 'subscriber' );
		}
		update_option( LOGINER_RESTRICTED_ROLE, $default_settings );
		update_option( LOGINER_CUSTOM_SHOW_PAGE_TITLE, 'yes' );
		// Checked the show password fields at first time.
		update_option( LOGINER_CUSTOM_NEW_REGISTRATION_MAIL, 'yes' );
	}
}
