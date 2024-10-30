<?php
/**
 * Fired during plugin deactivation
 *
 * @since      1.0
 * @author     SofSter
 * @package    Loginer
 * @subpackage Loginer/includes
 */

/**
 * Fired during plugin deactivation.
 */
class Loginer_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0
	 */
	public static function deactivate() {
		$page_signin   = get_page_by_title( 'Sign in' );
		$page_account  = get_page_by_title( 'Profile' );
		$page_register = get_page_by_title( 'Registration' );
		$page_lost     = get_page_by_title( 'Forgot Password' );
		$page_reset    = get_page_by_title( 'Reset Password' );
		wp_delete_post( $page_signin->ID );
		wp_delete_post( $page_account->ID );
		wp_delete_post( $page_register->ID );
		wp_delete_post( $page_lost->ID );
		wp_delete_post( $page_reset->ID );
		delete_option( LOGINER_SETTING_OPTIONS_GROUP );
		delete_option( LOGINER_SUBMENU_SETTING_GROUP );

	}

}
