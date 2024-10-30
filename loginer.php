<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0
 * @package           Loginer
 *
 * @wordpress-plugin
 * Plugin Name:       Loginer - Custom Login Page Builder
 * Plugin URI:        https://sofster.com/
 * Description:       Loginer is a Custom Login Page Builder. It provides beautifully designed Custom Login, Registration, Profile, Password Reset & Forget Password Pages.
 * Version:           1.4
 * Author:            SofSter
 * Requires at least: 4.5
 * Requires PHP:      5.6
 * Author URI:        https://sofster.com/
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       loginer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! defined( 'LOGINER_BASENAME' ) ) {
	define( 'LOGINER_BASENAME', plugin_basename( __FILE__ ) );
}
/**
 * Currently plugin version.
 * Start at version 1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LOGINER_VERSION', '1.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-loginer-activator.php
 */
function activate_loginer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes' . DIRECTORY_SEPARATOR . 'class-loginer-activator.php';
	Loginer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-loginer-deactivator.php
 */
function deactivate_loginer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes' . DIRECTORY_SEPARATOR . 'class-loginer-deactivator.php';
	Loginer_Deactivator::deactivate();
}

// Defining Menu Slugs.
define( 'LOGINER_FORM_SETTING', 'loginer-form-setting' );
define( 'LOGINER_FORM_SUBSETTING', 'loginer-form-subsetting' );

register_activation_hook( __FILE__, 'activate_loginer' );
register_deactivation_hook( __FILE__, 'deactivate_loginer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes' . DIRECTORY_SEPARATOR . 'class-loginer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
function run_loginer() {

	$plugin = new Loginer();
	$plugin->run();

}
run_loginer();
