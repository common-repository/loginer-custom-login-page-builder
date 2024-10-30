<?php
/**
 * Provide an admin area view for the form options
 *
 * This file is used to Create the Various Elemts Border options.
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
<tr class="line">
	<th colspan="2" class="heading-padding"  ><?php esc_attr_e( 'Border', 'loginer' ); ?></th>
</tr>
<tr class="custom-sub-options-settings">
	<th class="subheadings"><?php esc_attr_e( 'Thickness', 'loginer' ); ?></th>
	<td> <?php loginer_select_box_options( $args['width'] ); ?> </td>
</tr>
<tr class="custom-sub-options-settings" style="display:none;">
	<th class="subheadings"><?php esc_attr_e( 'Color', 'loginer' ); ?></th>
	<td>
		<input type="text" class="login-color-picker" id="<?php echo esc_attr( 'custom_form_' . $args['color'] ); ?>" name="<?php echo esc_attr( 'setting_options_group[formstyle][' . $args['color'] . ']' ); ?>" value="<?php echo esc_attr( loginer_setting_options_group( $args['color'] ) ); ?>">
	</td>
</tr>
<tr class="custom-sub-options-settings">
	<th class="subheadings"><?php esc_attr_e( 'Style', 'loginer' ); ?></th>
	<td>
		<?php loginer_border_style_selectbox( $args['style'] ); ?>
	</td>
</tr>
<tr class="custom-sub-options-settings">
	<th class="subheadings"><?php esc_attr_e( 'Radius', 'loginer' ); ?></th>
	<td> <?php loginer_select_box_options( $args['radius'] ); ?> </td>
</tr>
