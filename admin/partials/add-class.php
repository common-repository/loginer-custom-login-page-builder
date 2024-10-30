<?php
/**
 * To Provide an admin area view for the form options
 *
 * This file has Fields that Provide options
 * so that user can give own custom classes to the elements
 * inside the form.
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
<div class="outer">
	<div class="tab-desc"><p><?php esc_attr_e( 'Add multiple classes and your own custom CSS with ease to make it more personalized.', 'loginer' ); ?></p></div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Form', 'loginer' ); ?></b></label>
		<input id="formclasses" class="custom-heading-box" pattern="-?[_a-zA-Z]+[_a-zA-Z0-9-\s]*" data-element=".custom-form form" title="Class Name Must Contain a-z, A-Z, 0-9 and - _ Special characters only" type="text" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][formclasses]' ); ?>" value="<?php echo esc_attr( loginer_setting_options_group( 'formclasses' ) ); ?>">
	</div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Heading', 'loginer' ); ?></b></label>
		<input id="headingclasses" pattern="-?[_a-zA-Z]+[_a-zA-Z0-9-\s]*" class="custom-heading-box" data-element=".custom-form h2" title="Class Name Must Contain a-z, A-Z, 0-9 and - _ Special characters only" type="text" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][headingclasses]' ); ?>" value="<?php echo esc_attr( loginer_setting_options_group( 'headingclasses' ) ); ?>">
	</div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Label', 'loginer' ); ?></b></label>
		<input id="labelclasses" class="custom-heading-box" type="text" pattern="-?[_a-zA-Z]+[_a-zA-Z0-9-\s]*" title="Class Name Must Contain a-z, A-Z, 0-9 and - _ Special characters only" data-element=".custom-form label" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][labelclasses]' ); ?>" value="<?php echo esc_attr( loginer_setting_options_group( 'labelclasses' ) ); ?>">
	</div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Button', 'loginer' ); ?></b></label>
		<input id="buttonclasses" data-element=".custom-form input[type='submit']" class="custom-heading-box" title="Class Name Must Contain a-z, A-Z, 0-9 and - _ Special characters only" pattern="-?[_a-zA-Z]+[_a-zA-Z0-9-\s]*" type="text" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][buttonclasses]' ); ?>" value="<?php echo esc_attr( loginer_setting_options_group( 'buttonclasses' ) ); ?>">
	</div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Input', 'loginer' ); ?></b></label>
		<input id="inputclasses" type="text" class="custom-heading-box" title="Class Name Must Contain a-z, A-Z, 0-9 and - _ Special characters only" pattern="-?[_a-zA-Z]+[_a-zA-Z0-9-\s]*" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][inputclasses]' ); ?>" data-element=".custom-form input[type='text'], input[type='password'], input[type='email']" value="<?php echo esc_attr( loginer_setting_options_group( 'inputclasses' ) ); ?>">
	</div>
	<div class="text-inputs">
		<label class="heading"><b><?php echo esc_attr__( 'Add Custom CSS', 'loginer' ); ?></b></label>
		<textarea id="customcss" class="custom-heading-box" name="<?php echo esc_attr( LOGINER_SETTING_OPTIONS_GROUP . '[customstyle][customcss]' ); ?>" rows="10"><?php echo esc_attr( loginer_setting_options_group( 'customcss' ) ); ?></textarea>
	</div>
</div>
