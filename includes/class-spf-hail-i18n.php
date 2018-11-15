<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://spfwebsites.co.nz/about-us
 * @since      1.0.0
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Spf_Hail
 * @subpackage Spf_Hail/includes
 * @author     Jordan Diamond <jordan@spfwebsites.co.nz>
 */
class Spf_Hail_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'spf-hail',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
