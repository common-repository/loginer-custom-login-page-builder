<?php
/** Custom-acount-page
 *
 * @package Loginer
 * @subpackage Loginer/templates
 * @since 1.0.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

echo '<div class="custom-form">';
echo '<form id="your-profile" method="post" action="' . esc_attr( get_page_link() ) . '" ';
do_action( 'user_edit_form_tag' );
echo 'class="' . esc_attr( $this->loginer_get_option_values( 'formclasses' ) ) . '">';
global $wp_filter, $custom_options;
$option            = get_option( LOGINER_SUBMENU_SETTING_GROUP );
$custom_my_account = $option['pluginpages']['Profile'];
// Check if the user is not restricted for admin panel then Open wp-admin.
// Otherwise open the  custom_account_page.
$profileuser = wp_get_current_user();
$my_action   = '';
$user_id     = $profileuser->ID;
$sessions    = WP_Session_Tokens::get_instance( $profileuser->ID );

if ( isset( $_POST['submit'] ) ) {
	$user_id = $profileuser->ID;
	if ( isset( $_POST['action'] ) || wp_verify_nonce( sanitize_key( $_POST['action'] ) ) ) {
		$my_action = sanitize_text_field( wp_unslash( $_POST['action'] ) );
	}
}
if ( ! defined( 'IS_PROFILE_PAGE' ) ) {
	define( 'IS_PROFILE_PAGE', $user_id );
}
// Execute confirmed email change. See send_confirmation_on_profile_email().
if ( IS_PROFILE_PAGE && isset( $_GET['newuseremail'] ) && $profileuser->ID ) {
	$new_email = get_user_meta( $profileuser->ID, '_new_email', true );
	if ( $new_email && hash_equals( $new_email['hash'], sanitize_text_field( wp_unslash( $_GET['newuseremail'] ) ) ) ) {
		$user             = new stdClass();
		$user->ID         = $profileuser->ID;
		$user->user_email = esc_html( trim( $new_email['newemail'] ) );
		wp_update_user( $user );
		delete_user_meta( $profileuser->ID, '_new_email' );
		wp_safe_redirect( add_query_arg( array( 'updated' => 'true' ), get_page_link() ) );
		die();
	} else {
		wp_safe_redirect( add_query_arg( array( 'error' => 'new-email' ), get_page_link() ) );
	}
} elseif ( IS_PROFILE_PAGE && ! empty( $_GET['dismiss'] ) && $profileuser->ID . '_new_email' === $_GET['dismiss'] ) {
	check_admin_referer( 'dismiss-' . $profileuser->ID . '_new_email' );
	delete_user_meta( $profileuser->ID, '_new_email' );
	wp_safe_redirect( add_query_arg( array( 'updated' => 'true' ), get_page_link() ) );
	die();
}
if ( is_user_logged_in() ) {
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-loginer-form-error.php';
	$form_error = new Loginer_Form_Error();
	$form_error->loginer_heading( LOGINER_ACCOUNT_HEADING, $GLOBALS[ LOGINER_DEFAULT_ACCOUNT ] );

	$roles           = (array) $profileuser->roles;
	$restricted_role = get_option( LOGINER_RESTRICTED_ROLE ) ? get_option( LOGINER_RESTRICTED_ROLE ) : array();
	if ( in_array( $profileuser->roles[0], $restricted_role, true ) ) {
		$user_account = get_permalink( $custom_my_account );
		$redirect_url = add_query_arg( 'status', 'restricted' );
		$array        = ( explode( '=', $redirect_url ) );
	} else {
		show_admin_bar( true );
	}

	switch ( $my_action ) {
		case 'update':
			check_admin_referer( 'update-user_' . $user_id );

			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				wp_die( esc_attr_e( 'Sorry, you are not allowed to edit this user.', 'loginer' ) );
			}

			if ( IS_PROFILE_PAGE ) {
				/**
				 * Fires before the page loads on the 'Your Profile' editing screen.
				 *
				 * The action only fires if the current user is editing their own profile.
				 *
				 * @since 2.0.0
				 *
				 * @param int $user_id The user ID.
				 */
				do_action( 'personal_options_update', $user_id );
			} else {
				/**
				 * Fires before the page loads on the 'Edit User' screen.
				 *
				 * @since 2.7.0
				 *
				 * @param int $user_id The user ID.
				 */
				do_action( 'edit_user_profile_update', $user_id );
			}
			if ( isset( $_POST['user_email'] ) || isset( $_POST['first_name'] ) || isset( $_POST['last_name'] ) || isset( $_POST['user_url'] ) || isset( $_POST['description'] ) || isset( $_POST['nickname'] ) || isset( $_POST['display_name'] ) ) {
				// Update the user.
				$my_error = wp_update_user(
					array(
						'ID'           => $user_id,
						'first_name'   => sanitize_text_field( wp_unslash( $_POST['first_name'] ) ),
						'last_name'    => sanitize_text_field( wp_unslash( $_POST['last_name'] ) ),
						'user_url'     => sanitize_text_field( wp_unslash( $_POST['user_url'] ) ),
						'description'  => sanitize_text_field( wp_unslash( $_POST['description'] ) ),
						'nickname'     => sanitize_text_field( wp_unslash( $_POST['nickname'] ) ),
						'display_name' => sanitize_text_field( wp_unslash( $_POST['display_name'] ) ),
						'user_email'   => sanitize_text_field( wp_unslash( $_POST['user_email'] ) ),
					)
				);
			}

			// Grant or revoke super admin status if requested.
			if ( is_multisite() && is_network_admin() && ! IS_PROFILE_PAGE && current_user_can( 'manage_network_options' ) && ! isset( $super_admins ) && empty( $_POST['super_admin'] ) === is_super_admin( $user_id ) ) {
				empty( $_POST['super_admin'] ) ? revoke_super_admin( $user_id ) : grant_super_admin( $user_id );
			}

			if ( is_wp_error( $my_error ) ) {
				echo '<div class="alert alert-danger">';
				$update_error = $my_error->loginer_get_error_message();
				echo esc_attr( $update_error );
				echo '</div>';
			} else {
				echo '<div class="alert alert-success">';
				esc_attr_e( 'Profile Updated', 'loginer' );
				echo '</div>';
			}

			// Intentional fall-through to display $errors.
		default:
			$profileuser = get_userdata( $user_id );
			require plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'user-account-form.php';
			break;
	}
		echo '</div>';
}
echo '</form>';
echo '<div class="form-margin-collepsed"> </div>';
