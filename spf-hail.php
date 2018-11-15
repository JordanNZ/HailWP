<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://spfwebsites.co.nz/about-us
 * @since             1.0.0
 * @package           Spf_Hail
 *
 * @wordpress-plugin
 * Plugin Name:       SPF + Hail
 * Plugin URI:        https://github.com/SPFWeb/SPF-Snippets/blob/master/wordpress/hail/
 * Description:       Plugin that allows for page content to be pulled from the Hail API through to the website using shortcodes, metaboxes etc.
 * Version:           1.0.11
 * Author:            Jordan Diamond
 * Author URI:        http://spfwebsites.co.nz/about-us
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       spf-hail
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
//define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-spf-hail-activator.php
 */
function activate_spf_hail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-spf-hail-activator.php';
	Spf_Hail_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-spf-hail-deactivator.php
 */
function deactivate_spf_hail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-spf-hail-deactivator.php';
	Spf_Hail_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_spf_hail' );
register_deactivation_hook( __FILE__, 'deactivate_spf_hail' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-spf-hail.php';
require plugin_dir_path( __FILE__ ) . 'includes/metabox-spf-hail.php';

/**
 * Update Plugin Checker
 * Will hopefully check if the version is the latest version and if not display a notification
 *
*/

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/JordanNZ/Hail/',
	__FILE__,
	'spf-hail'
);

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('1aec3394b16e76a03f60b43359806cb87e0d1332');

//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('master');

//Grabs the releases
$myUpdateChecker->getVcsApi()->enableReleaseAssets();

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_spf_hail() {

	$plugin = new Spf_Hail();
	$plugin->run();

}
run_spf_hail();
