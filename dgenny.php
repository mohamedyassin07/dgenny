<?php
/**
 * Debugging Genny
 *
 * @package       DGENNY
 * @author        Mohamed Yassin
 * @version       1.2.0
 *
 * @wordpress-plugin
 * Plugin Name:   Debugging Genny
 * Plugin URI:    https://mydomain.com
 * Description:   The wordpress developers genny 🧞 helps them in their daily work routine.
 * Version:       1.2.0
 * Author:        Mohamed Yassin
 * Author URI:    https://developeryassin.wordpress.com
 * Text Domain:   dgenny
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin Name
define( 'DGENNY_NAME',			'Debugging Genny' );

// Plugin Slug
define( 'DGENNY_SLUG',			'dgenny' );

// Plugin version
define( 'DGENNY_VERSION',		'1.2.0' );

// Plugin Root File
define( 'DGENNY_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'DGENNY_PLUGIN_BASE',	plugin_basename( DGENNY_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'DGENNY_PLUGIN_DIR',	plugin_dir_path( DGENNY_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'DGENNY_PLUGIN_URL',	plugin_dir_url( DGENNY_PLUGIN_FILE ) );

// dGenny debug status
if ( ! defined('DGENNY_DEBUG') ) {
	$dgenny_settings = get_option( DGENNY_SLUG.'_Settings' );

	if(
		isset ( $_GET['dgenny_debug'] ) ||
		(
			isset ( $dgenny_settings['general'] ) &&
			isset ( $dgenny_settings['general']['dgenny_debug'] ) &&
			$dgenny_settings['general']['dgenny_debug'] === '1'
		)
	){
		define( 'DGENNY_DEBUG',	true );
	}else {
		define( 'DGENNY_DEBUG',	false );
	}
}


/**
 * Load the main class for the core functionality after the plugins loaded 
 *
 * @author  Mohamed Yassin
 * @since   1.0.0
 * @return  object|Dgenny
 */
require_once DGENNY_PLUGIN_DIR . 'class-dgenny.php';
Dgenny::instance();

add_action( 'init', function(){


} );