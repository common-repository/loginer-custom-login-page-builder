<?php
/**
 * Provide an Public area view.
 *
 * This file has the User Account Form.
 *
 * @version 1.0.0
 * @package Loginer
 * @subpackage Loginer/partials
 * @since 1.0.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @copyright 2019 Sofster
 */

if ( isset( $_POST['destroy'] ) ) {
	wp_verify_nonce( sanitize_key( $_POST['destroy'] ) );
	$user_id  = get_current_user_id();
	$session  = wp_get_session_token();
	$sessions = WP_Session_Tokens::get_instance( $user_id );
	$sessions->destroy_others( $session );
	echo '<div class="alert alert-success">';
	esc_attr_e( ' You are now logged out everywhere else.' );
	echo '</div>';
}
?>
<div class="account">
<div class="form-margin-collepsed"> </div>
		<?php wp_nonce_field( 'update-user_' . $user_id ); ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo esc_attr( get_current_user_id() ); ?>" />
		<h4><?php esc_attr_e( 'Name', 'loginer' ); ?></h4>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Username', 'loginer' ); ?></label>
			<input type="text" name="login" id="user_login" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" style="opacity: .5;"value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" /><span class="description"><?php esc_attr_e( 'Username cannot be changed.', 'loginer' ); ?></span>
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'First Name', 'loginer' ); ?></label>
			<input type="text" name="first_name" id="first_name" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" value="<?php echo esc_attr( $profileuser->first_name ); ?>" />
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Last Name', 'loginer' ); ?></label>
			<input type="text" name="last_name" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>"/>
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Nick Name', 'loginer' ); ?><strong><span class="custom_required_Color"> * </span></strong></label>
			<input type="text" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" required/>
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Display Name', 'loginer' ); ?></label>
			<select name="display_name" id="display_name">
			<?php
				$public_display                     = array();
				$public_display['display_nickname'] = $profileuser->nickname;
				$public_display['display_username'] = $profileuser->user_login;

			if ( ! empty( $profileuser->first_name ) ) {
				$public_display['display_firstname'] = $profileuser->first_name;
			}

			if ( ! empty( $profileuser->last_name ) ) {
				$public_display['display_lastname'] = $profileuser->last_name;
			}

			if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
				$public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
				$public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
			}

			if ( ! in_array( $profileuser->display_name, $public_display, true ) ) {
				// Only add this if it isn't duplicated elsewhere.
				$public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
			}

				$public_display = array_map( 'trim', $public_display );
				$public_display = array_unique( $public_display );

			foreach ( $public_display as $my_id => $item ) {
				?>
			<option <?php selected( $profileuser->display_name, $item ); ?>><?php echo esc_attr( $item ); ?></option>
				<?php
			}
			?>
			</select>
		</div>
		<h4><?php esc_attr_e( 'Contact Info' ); ?></h4>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Email', 'loginer' ); ?><strong><span class="custom_required_Color"> * </span></strong></label>
			<input type="email" id="user_email" name="user_email" required  value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>"/>
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Website', 'loginer' ); ?></label>
			<input type="url" name="user_url" class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>" id="user_url" value="<?php echo esc_attr( $profileuser->user_url ); ?>" />
		</div>
		<h4><?php esc_attr_e( 'About Yourself', 'loginer' ); ?></h4>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Biographical Info', 'loginer' ); ?></label>
			<textarea name="description" id="description" rows="3" cols="30"><?php echo esc_attr( $profileuser->description ); ?></textarea>
		</div>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Profile Picture', 'loginer' ); ?></label>
			<?php echo get_avatar( $user_id ); ?>
			<p class="description">
				<?php
				if ( IS_PROFILE_PAGE ) {
					$description = sprintf(
						/* translators: %s: Gravatar URL */
						__( 'You can change your profile picture on <a href="%s">Gravatar</a>.', 'loginer' ),
						'https://en.gravatar.com/'
					);
				} else {
					$description = '';
				}

				/**
				 * Filters the user profile picture description displayed under the Gravatar.
				 *
				 * @since 4.4.0
				 * @since 4.7.0 Added the `$profileuser` parameter.
				 *
				 * @param string  $description The description that will be printed.
				 * @param WP_User $profileuser The current WP_User object.
				 */
				echo wp_kses_post( apply_filters( 'user_profile_picture_description', $description, $profileuser ) );
				?>
			</p>
		</div>
		<h4><?php esc_attr_e( 'Account Management', 'loginer' ); ?></h4>
		<div class="form-row">
			<?php
			if ( IS_PROFILE_PAGE && count( $sessions->get_all() ) === 1 ) :
				?>
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Sessions', 'loginer' ); ?></label>
			<button type="button" disabled style="opacity: 0.5;"class="btn"><?php esc_attr_e( 'Log Out Everywhere Else', 'loginer' ); ?></button>
			<p class="description">
				<?php esc_attr_e( 'You are only logged in at this location.', 'loginer' ); ?>
			</p>
			<?php elseif ( IS_PROFILE_PAGE && count( $sessions->get_all() ) > 1 ) : ?>
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Sessions', 'loginer' ); ?></label>
			<button type="submit" class="btn" id="destroy-sessions" name="destroy"><?php esc_attr_e( 'Log Out Everywhere Else', 'loginer' ); ?> 			</button>
			<p class="description">
				<?php esc_attr_e( 'Did you lose your phone or leave your account logged in at a public computer? You can log out everywhere else, and stay logged in here.', 'loginer' ); ?>
			</p>
			<?php elseif ( ! IS_PROFILE_PAGE && $sessions->get_all() ) : ?>
			<?php endif; ?>
		</div>
		<?php
		if ( IS_PROFILE_PAGE ) {
			/**
			 * Fires after the 'About Yourself' settings table on the 'Your Profile' editing screen.
			 *
			 * The action only fires if the current user is editing their own profile.
			 *
			 * @since 2.0.0
			 *
			 * @param WP_User $profileuser The current WP_User object.
			 */
			do_action( 'show_user_profile', $profileuser );
		} else {
			/**
			 * Fires after the 'About the User' settings table on the 'Edit User' screen.
			 *
			 * @since 2.0.0
			 *
			 * @param WP_User $profileuser The current WP_User object.
			 */
			do_action( 'edit_user_profile', $profileuser );
		}
		?>

		<?php
		/**
		 * Filters whether to display additional capabilities for the user.
		 *
		 * The 'Additional Capabilities' section will only be enabled if
		 * the number of the user's capabilities exceeds their number of
		 * roles.
		 *
		 * @since 2.8.0
		 *
		 * @param bool    $enable      Whether to display the capabilities. Default true.
		 * @param WP_User $profileuser The current WP_User object.
		 */
		if ( count( $profileuser->caps ) > count( $profileuser->roles )
			&& apply_filters( 'additional_capabilities_display', true, $profileuser )
		) :
			?>
		<h4><?php esc_attr_e( 'Additional Capabilities', 'loginer' ); ?></h4>
		<div class="form-row">
			<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ); ?>"><?php esc_attr_e( 'Capabilities', 'loginer' ); ?></label>
			<?php
			$output = '';
			global $wp_roles;
			foreach ( $profileuser->caps as $cap => $value ) {
				if ( ! $wp_roles->is_role( $cap ) ) {
					if ( '' !== $output ) {
						$output .= ', ';
					}
					/* translators: %s: capability name */
					$output .= $value ? $cap : sprintf( __( 'Denied: %s', 'loginer' ), $cap );
				}
			}
			echo esc_attr( $output );
			?>
		</div>
		<?php endif; ?>
		<div class="form-row">
			<input type="hidden" name="action" value="update" />
			<input type="submit" class="button btn <?php echo esc_attr( $this->loginer_get_option_values( 'buttonclasses' ) ); ?>" name="submit" id="submit" value="<?php esc_attr_e( 'Update Profile', 'loginer' ); ?>" />
			<a class="btn" href="<?php echo esc_url( wp_logout_url() ); ?>">
				<?php esc_attr_e( 'Logout', 'loginer' ); ?>
			</a>
		</div>
</div>
