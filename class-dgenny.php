<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Dgenny' ) ) :

	/**
	 * Main Dgenny Class.
	 *
	 * @package		DGENNY
	 * @subpackage	Classes/Dgenny
	 * @since		1.0.0
	 * @author		Mohamed Yassin
	 */
	final class Dgenny {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Dgenny
		 */
		private static $instance;

		/**
		 * DGENNY helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Dgenny_Helpers
		 */
		public $helpers;

		/**
		 * DGENNY settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Dgenny_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'dgenny' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'dgenny' ), '1.0.0' );
		}

		/**
		 * Main Dgenny Instance.
		 *
		 * Insures that only one instance of Dgenny exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Dgenny	The one true Dgenny
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Dgenny ) ) {
				/**
				 * Fire a custom action to allow dependencies
				 * before the plugin setup
				 */
				do_action( 'DGENNY/before_plugin_loaded' );

				self::$instance	= new Dgenny;

				self::$instance->enable_debug_enviroment_settings();

				self::$instance->includes();
				//self::$instance->plugin_updater();
				self::$instance->add_hooks();

				// run required classes
				//new dGenny_CRB;
				new dGenny_Settings;
				new dGenny_Testing_Areas;
				new dGenny_Request_Mirror;
				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'DGENNY/plugin_loaded' );
			}

			return self::$instance;
		}

		public function enable_debug_enviroment_settings()
		{
			$dgenny_settings = get_option( DGENNY_SLUG.'_Settings' );

			if(
				DGENNY_DEBUG &&
				isset ( $dgenny_settings['general'] ) &&
				isset ( $dgenny_settings['general']['show_php_errors'] ) &&
				$dgenny_settings['general']['show_php_errors'] === '1'
			){
				ini_set('display_errors', 1); 
				ini_set('display_startup_errors', 1); 
				error_reporting(E_ALL);		
	
			}
		}
		
		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once DGENNY_PLUGIN_DIR . 'helpers/helpers.php';
			
			require_once DGENNY_PLUGIN_DIR . 'libs/admin-page-framework-core/admin-page-framework.php';
			//require_once DGENNY_PLUGIN_DIR . 'classes/dgenny-crb.php';
			require_once DGENNY_PLUGIN_DIR . 'classes/settings-page.php';
			require_once DGENNY_PLUGIN_DIR . 'classes/testing-areas.php';
			require_once DGENNY_PLUGIN_DIR . 'classes/request-mirror.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function add_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
			add_action( 'plugin_action_links_' . DGENNY_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );	
		}


		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'dgenny', FALSE, dirname( plugin_basename( DGENNY_PLUGIN_FILE ) ) . '/languages/' );
		}

		/**
		* Adds action links to the plugin list table
		*
		* @access	public
		* @since	1.0.0
		*
		* @param	array	$links An array of plugin action links.
		*
		* @return	array	An array of plugin action links.
		*/
		public function add_plugin_action_link( $links ) {
			$settings_link = sprintf( '<a href="%s" title="Custom Link" style="font-weight:700;">%s</a>', admin_url('admin.php?page='.DGENNY_SLUG ) , __( 'Settings', 'dgenny' ) );
			array_unshift( $links, $settings_link );	
			return $links;
		}

		/**
		 * Enqueue the backend related scripts and styles for this plugin.
		 * All of the added scripts andstyles will be available on every page within the backend.
		 *
		 * @access	public
		 * @since	1.0.0
		 *
		 * @return	void
		 */
		public function enqueue_backend_scripts_and_styles() {
			wp_enqueue_script( 'dgenny-backend-scripts', DGENNY_PLUGIN_URL . 'core/includes/assets/js/backend-scripts.js', array(), DGENNY_VERSION, false );
			wp_localize_script( 'dgenny', 'dgenny', array(
				'plugin_name'   	=> __( 'dgenny', 'dgenny' ),
			));
		}

		private function plugin_updater(Type $var = null)
		{
			if ((string) get_option('my_licence_key') !== '') {			
				$updater = new PDUpdater(__FILE__);
				$updater->set_username('username-here');
				$updater->set_repository('repository-name-here');
				$updater->authorize(get_option('my_licence_key'));
				$updater->initialize();
			}
			
		}		
}

endif; // End if class_exists check.