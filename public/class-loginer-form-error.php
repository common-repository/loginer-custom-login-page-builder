<?php
/**
 * This File Handle The Public End Form errors.
 *
 * @package    Loginer
 * @subpackage Loginer/includes
 *
 * @since      1.0.0
 */

/** This File Has the Parent class of his class */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public' . DIRECTORY_SEPARATOR . 'class-sub-loginer.php';
/**
 * The core plugin class handle the error funcitons.
 */
class Loginer_Form_Error extends Sub_Loginer {

	/**
	 * This Function has the Error Message And Heading of the Form.
	 *
	 * @param string $option for show heading Option.
	 * @param string $default for Default Value of the Heading.
	 */
	public function loginer_heading( $option, $default ) {
			$page_title_option = get_option( LOGINER_CUSTOM_SHOW_PAGE_TITLE );
		if ( 'yes' === $page_title_option ) {
			$heading = $this->loginer_get_option_values( $option ) ? $this->loginer_get_option_values( $option ) : $default;
			?>
				<h2 class="<?php echo esc_attr( $this->loginer_get_option_values( 'headingclasses' ) ? $this->loginer_get_option_values( 'headingclasses' ) : '' ); ?>"><?php echo esc_attr( $heading ); ?></h2>
				<?php
		}
		if ( isset( $_REQUEST['errors'] ) && wp_verify_nonce( sanitize_key( $_REQUEST['errors'] ) ) ) {
			$_REQUEST['errors'] = sanitize_text_field( wp_unslash( $_REQUEST['errors'] ) );
		}
		if ( isset( $_REQUEST['errors'] ) ) {
			?>
				<div class="alert alert-danger alert-msg"> 
			<?php
				// Retrieve possible errors from request parameters.
				$error_codes = sanitize_text_field( wp_unslash( $_REQUEST['errors'] ) ) ? explode( ',', sanitize_text_field( wp_unslash( $_REQUEST['errors'] ) ) ) : array();
			foreach ( $error_codes as $error_code ) {
				?>
				<p>
					<?php echo esc_attr( $this->loginer_get_error_message( $error_code ) ); ?>
				</p>
				<?php
			}
			?>
			</div>
			<?php
		}
	}

	/** Function to check if the user allready Login */
	public function loginer_already_login() {
		if ( current_user_can( 'edit_posts' ) ) {
			if ( is_admin() ) {
				wp_safe_redirect( edit_post_link() );
			} else {
				wp_safe_redirect( admin_url() );
			}
		} else {
			wp_safe_redirect( get_site_url() );
		}

	}


}
