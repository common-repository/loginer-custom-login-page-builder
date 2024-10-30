<?php
/**
 * Provide an admin area view for the form options
 *
 * This file is used to Create the Various Elements Margin and Padding Options.
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
<table class="form-options">
	<tr class="line">
		<th><b><?php echo esc_attr( $args['heading'] ); ?></b></th>
		<td>
			<div class="margin-padding-input-wrapper">
				<ul class="margin-padding-dimensions">
					<li class="margin-padding-option">
						<input id="<?php echo esc_attr( 'custom_form_' . $args['top'] ); ?>" name="<?php echo esc_attr( 'setting_options_group[formstyle][' . $args['top'] . ']' ); ?>" type="number" min="0" oninput="this.value = Math.abs(this.value)" value="<?php echo esc_attr( loginer_setting_options_group( $args['top'] ) ); ?>">
						<label for="<?php echo esc_attr( 'custom_form_' . $args['top'] ); ?>" class="margin-padding-option-label">Top</label>
					</li>
					<li class="margin-padding-option">
						<input id="<?php echo esc_attr( 'custom_form_' . $args['right'] ); ?>" name="<?php echo esc_attr( 'setting_options_group[formstyle][' . $args['right'] . ']' ); ?>" type="number" min="0" oninput="this.value = Math.abs(this.value)" value="<?php echo esc_attr( loginer_setting_options_group( $args['right'] ) ); ?>">
						<label for="<?php echo esc_attr( 'custom_form_' . $args['right'] ); ?>" class="margin-padding-option-label">Right</label>
					</li>
					<li class="margin-padding-option">
						<input id="<?php echo esc_attr( 'custom_form_' . $args['bottom'] ); ?>" name="<?php echo esc_attr( 'setting_options_group[formstyle][' . $args['bottom'] . ']' ); ?>" type="number" min="0" oninput="this.value = Math.abs(this.value)" value="<?php echo esc_attr( loginer_setting_options_group( $args['bottom'] ) ); ?>">
						<label for="<?php echo esc_attr( 'custom_form_' . $args['bottom'] ); ?>" class="margin-padding-option-label">Bottom</label>
					</li>
					<li class="margin-padding-option">
						<input id="<?php echo esc_attr( 'custom_form_' . $args['left'] ); ?>" name="<?php echo esc_attr( 'setting_options_group[formstyle][' . $args['left'] . ']' ); ?>" type="number" min="0" oninput="this.value = Math.abs(this.value)" value="<?php echo esc_attr( loginer_setting_options_group( $args['left'] ) ); ?>">
						<label for="<?php echo esc_attr( 'custom_form_' . $args['left'] ); ?>" class="margin-padding-option-label">Left</label>
					</li>
					<li>
						<a id="link-<?php echo esc_attr( $args['button_id'] ); ?>" class="margin-padding-link tooltip-target button">
						<span class="options-linked">
							<span class="dashicons login-deshicon dashicons-lock"></span>
							</span>
							<span class="options-unlinked">
							<span class="dashicons login-deshicon dashicons-unlock"></span>
							</span>
						</a>
					</li>
				</ul>
			</div>
		</td>
	</tr>
</table>
