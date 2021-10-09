<?php
/**
 * Plugin Name: Block editable Custom post type for woo
 * Plugin URI: https://github.com/rocket-martue/block-editable-cpt-for-woo
 * Description: This plugin adds block editable custom post type for woo. It also allows you to easily insert blocks into your products using a shortcode.
 * Version: 0.0.1
 * Tested up to: 5.7
 * Requires at least: 5.6
 * Requires PHP: 5.6
 * Author: Rocket Martue
 * Author URI: https://profiles.wordpress.org/rocketmartue/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: block-editable-cpt-for-woo
 *
 * @package block-editable-cpt-for-woo
 * @author Rocket Martue
 * @license GPL-2.0+
 */

define( 'BLOCK_EDITABLE_CPT_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'BLOCK_EDITABLE_CPT_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

/**
 * Function : plugin loaded
 */
add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'block-editable-cpt-for-woo', false, basename( __DIR__ ) . '/languages' );
	}
);

/**
 * Auto loading the php file in the inc directory.
 * If the file name starts with an underscore (e.g. _example.php), it will not be included.
 */
$dir = trailingslashit( BLOCK_EDITABLE_CPT_PATH ).'inc/';
if ( file_exists( $dir) ) {
	opendir( $dir );
	while( ( $file = readdir() ) !== false ) {
		if( ! is_dir( $file ) && ( strtolower( substr( $file, -4 ) ) == ".php" ) && ( substr( $file, 0, 1 ) != "_" ) ) {
			$load_file = $dir.$file;
			require_once( $load_file );
		}
	}
	closedir();
}