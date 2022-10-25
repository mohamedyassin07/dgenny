<?php
return ;
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Class dGenny_Settings
 *
 * This class contains repetitive functions that
 * are used globally within the plugin.
 *
 * @package		DGENNY
 * @subpackage	Classes/dGenny_Settings
 * @author		Mohamed Yassin
 * @since		1.0.0
 */

class dGenny_Testing_Areas
{
	public $temp_test_areas =  array();
    /**
	 * Our Dgenny_Settings constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		// set defult areas
		add_action( 'admin_notices', array( $this, 'debug_admin_notice') );
		
		// set the temp areas
		add_action('admin_menu', array( $this,  'set_temp_test_areas' ) );

		// if some thing need to be excuted outside hook or before the 'admin_notices' hook
		// dg_view('test_ouside_hooks');
    }

	public function external_debugging_areas( )
	{
		$external_areas = [];
		$areas = dg_option( 'external_debugging_areas' , '' );
		$areas = explode( "\n", $areas );

		foreach ( $areas as $area ) {
			$area = explode( "->", $area );
			if( isset( $area[1] ) &&  is_file( WP_CONTENT_DIR . '/' . trim( $area[1] ) ) ){
				$external_areas [ trim( $area[0] ) ]['path'] = WP_CONTENT_DIR . '/' . trim( $area[1] );
			}
		}

		return $external_areas;
	}
	public function set_temp_test_areas()
	{
		// Main testing Area
		add_menu_page(
			'Testing Page',
			'Testing Page',
			'manage_options',
			'dgenny_main_test_page',
			function(){
				$path = DGENNY_PLUGIN_DIR . 'views/dgenny_main_test_page/dgenny_main_test_page.php';
				$this->render_page( $path );
			},
			'dashicons-hammer',
			4
		);

		// Extra Temporarly Sub Testing pages
		foreach ( $this->external_debugging_areas() as $key => $area ) {
			add_submenu_page( 
				'dgenny_main_test_page',
				$this->page_name( $key ) ,
				$this->page_name( $key ),
				'manage_options',
				urlencode( strtolower( $key ) ) ,
				function() use( $area ){
					$this->render_page( $area['path'] );
				}
			);			
		}
	}

	public function render_page( $path )
	{
		echo '<h1>'.$this->page_name( $_GET['page'] ) . '</h1>';
		dg_view( $path , array() , true );
	}

	public function page_file($name ,$php = false){
		return $php ? $name.'/'.$name.'.php' : $name.'/'.$name ;
	}

	public function page_name( $area ){
		$area = str_replace('_', ' ', $area);
		return ucwords( $area );
	}

	// as a dashboard notice  always appears in all admin pages
	public function debug_admin_notice(){
		echo '<div class="notice notice-warning is-dismissible">';
		dg_view('admin_notice');
		echo '</div>';
	}
}