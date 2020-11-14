<?php

/**
 * @link              https://github.com/galyonj
 * @since             1.0.0
 * @package           coe-am
 * @author            John Galyon
 * @license           GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       COE Asset Management System
 * Plugin URI:        https://github.com/galyonj/coe-asset-management
 * Description:       Registers a custom post type and custom taxonomy for asset management on coefoodsafetytools.org
 * Version:           1.0.3
 * Author:            John Galyon
 * Author URI:        https://github.com/galyonj
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coe-am
 * Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define several global constants for ease of use later
 *
 * @since 1.0.0
 *
 * @internal
 */
function coe_am_constants( $plugin_data, $constant_name, $value ) {
	/**
	 * Push certain data from the plugin header
	 * into an array for better consistency later
	 *
	 * @param mixed plugin header data
	 */
	$constant_name_prefix = 'COE_AM_';
	$constant_name        = $constant_name_prefix . $constant_name;
	$plugin_data          = get_file_data(
		__FILE__,
		array(
			'name'    => 'Plugin Name',
			'version' => 'Version',
			'text'    => 'Text Domain',
		)
	);

	if ( ! defined( $constant_name ) ) {
		define( $constant_name, $value );
	}
}

// Now we use coe_am_constants();
coe_am_constants( 'DIR', dirname( plugin_basename( __FILE__ ) ) );
coe_am_constants( 'BASE', dirname( plugin_basename( __FILE__ ) ) );
coe_am_constants( 'URL', plugin_dir_url( __FILE__ ) );
coe_am_constants( 'PATH', plugin_dir_path( __FILE__ ) );
coe_am_constants( 'SLUG', firname( plugin_basename( __FILE__ ) ) );
coe_am_constants( 'NAME', $plugin_data['name'] );
coe_am_constants( 'VERSION', $plugin_data['version'] );
coe_am_constants( 'TEXT', $plugin_data['text'] );
coe_am_constants( 'PREFIX', 'coe-am' );
coe_am_constants( 'SETTINGS', 'coe-am' );

// Put all those constants we just made into an array so that we can get to them easier
function coe_am_constants_array() {
	$array = array(
		'file'     => COE_AM_FILE,
		'dir'      => COE_AM_DIR,
		'base'     => COE_AM_BASE,
		'url'      => COE_AM_URL,
		'path'     => COE_AM_PATH,
		'slug'     => COE_AM_SLUG,
		'name'     => COE_AM_NAME,
		'version'  => COE_AM_VERSION,
		'text'     => COE_AM_TEXT,
		'prefix'   => COE_AM_PREFIX,
		'settings' => COE_AM_SETTINGS,
	);

	return $array;
}

/**
 * Put value of plugin constants into an array for easier access
 */
$const = coe_am_constants_array();

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-coe-am-activator.php
 */
function activate_plugin_name() {
	require_once $const['dir'] . 'inc/activator.php';
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-coe-am-deactivator.php
 */
function deactivate_plugin_name() {
	require_once $const['dir'] . 'inc/deactivator.php';
}

register_activation_hook( __FILE__, 'activate_coe_am' );
register_deactivation_hook( __FILE__, 'deactivate_coe_am' );

function coe_am_submenu() {
	$caps = apply_filters( 'coe_am_capability', 'manage_options' );
	$parent_slug = 'edit_post.php?type="assets"';
}
