<?php
/**
 * Provide an Public area view.
 *
 * This file has the User Lost Password Form.
 *
 * @since 1.0.0
 * @author Sofster
 * @package Loginer
 * @subpackage Loginer/partials
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0.0
 * @copyright 2019 Sofster
 */

?>
<div class="form-margin-collepsed"> </div>
<div class="form-row">
	<label class="<?php echo esc_attr( $this->loginer_get_option_values( 'labelclasses' ) ? $this->loginer_get_option_values( 'labelclasses' ) : '' ); ?>" for="lost-password"><?php echo esc_attr( $this->loginer_get_option_values( LOGINER_EMAILUSER_LABEL ) ? $this->loginer_get_option_values( LOGINER_EMAILUSER_LABEL ) : __( 'Email or Username', 'loginer' ) ); ?>&nbsp;</label>
	<input type="text" name="user_login" id="user_login" placeholder="<?php echo esc_attr( $this->loginer_get_option_values( LOGINER_EMAILUSER_PLACE ) ? $this->loginer_get_option_values( LOGINER_EMAILUSER_PLACE ) : __( 'Email or Username', 'loginer' ) ); ?>" required class="<?php echo esc_attr( $this->loginer_get_option_values( 'inputclasses' ) ); ?>">
</div>
<?php do_action( 'lostpassword_form' ); ?>
<div class="form-row">
	<input type="submit" name="submit" class="button btn <?php echo esc_attr( $this->loginer_get_option_values( 'buttonclasses' ) ? $this->loginer_get_option_values( 'buttonclasses' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset Password', 'loginer' ); ?>"/>
</div>
<div class="form-margin-collepsed"> </div>
