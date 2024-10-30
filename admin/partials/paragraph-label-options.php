<?php
/**
 * Contains the option functions
 *
 * This file is used to Create the Various Elements Paragraph and Label Elements Options.
 *
 * @package Loginer
 * @subpackage Loginer/admin/partial
 * @since 1.0
 * @author Sofster
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @version 1.0
 * @copyright 2019 Sofster
 */

?>
<th colspan="2" class="heading-padding"> <b><?php echo esc_attr( $label ); ?></b> </th></tr>
	<tr class="custom-sub-options-settings">
		<th class="subheadings"><?php esc_attr_e( 'Font Color', 'loginer' ); ?></b></th>
		<td> <input type="text" class="login-color-picker" id="custom_form_<?php echo esc_attr( $field['color'] ); ?>" name="setting_options_group[formstyle][<?php echo esc_attr( $field['color'] ); ?>]" value="<?php echo esc_attr( loginer_setting_options_group( $field['color'] ) ); ?>"> </td>
	</tr>
	<tr class="custom-sub-options-settings">
		<th class="subheadings"><?php esc_attr_e( 'Font Size', 'loginer' ); ?></th>
	<td> <?php loginer_select_box_options( $field['font'] ); ?> </td>

