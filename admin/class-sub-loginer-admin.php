<?php
/**
 * This Class is the parent calss of Login_Admin.
 *
 * @since 1.0.0
 * @author     SofSter
 * @package    Loginer
 * @subpackage Loginer/admin
 */

/**
 * This Class is the parent calss of Login_Admin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Sub_Loginer_Admin {

	/**
	 * Add a post display state for special WC pages in the page list table.
	 *
	 * @param array   $post_states An array of post display states.
	 * @param WP_Post $post        The current post object.
	 */
	public function loginer_add_display_post_states( $post_states, $post ) {
		$page_options = get_option( LOGINER_SUBMENU_SETTING_GROUP );
		$pageid       = (string) $post->ID;
		if ( is_array( $page_options ) ) {
			$pluginpages = $page_options['pluginpages'];
			$post_array  = array(
				'Sign in'         => __( 'Sign In Page', 'loginer' ),
				'Profile'         => __( 'Profile Page', 'loginer' ),
				'Registration'    => __( 'Registration Page', 'loginer' ),
				'Reset Password'  => __( 'Reset Password Page', 'loginer' ),
				'Forgot Password' => __( 'Forgot Password Page', 'loginer' ),
			);
			foreach ( $pluginpages as $pages => $pages_id ) {
				if ( isset( $pluginpages[ $pages ] ) && (string) $pages_id === $pageid ) {
					$post_states[ $pages ] = esc_attr( $post_array[ $pages ] );
				}
			}
			return $post_states;
		}
	}

	/**
	 * This code will run in order to add the settings link on plugin list page.
	 *
	 * @param array $links The links to show on the plugins overview page in an array.
	 */
	public function loginer_add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'admin.php?page=' . LOGINER_FORM_SETTING ) . '">' . __( 'Settings', 'loginer' ) . '</a>',
		);
		return array_merge( $links, $mylinks );
	}
}
