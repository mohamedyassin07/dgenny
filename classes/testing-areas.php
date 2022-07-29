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
		dg_view('test_ouside_hooks');

    }

	public function temp_test_areas()
	{
		// create plugins/dgenny/views/{{folder/page name}}/index.php file
		// to add new sub testing page here
		$views_dir = DGENNY_PLUGIN_DIR . 'views/' ;
		$areas =  scandir( $views_dir );
		unset($areas[0]);
		unset($areas[1]);

		if ( in_array('dgenny_main_test_page' , $areas ) ) {
			unset( $areas[ array_search( 'dgenny_main_test_page' , $areas ) ] );
		}
		foreach ($areas as $key =>  $area) {
			if ( ! is_dir( $views_dir . $area) ||  !file_exists($views_dir . $this->page_file( $area , true ) ) )  {
				unset( $areas[$key] );
			}
		}
		return $areas;
	}

	public function set_temp_test_areas()
	{
		// Main testing Pages
		add_menu_page( 'Testing Page', 'Testing Page', 'manage_options', 'dgenny_main_test_page', array(  $this , 'html'   ) , 'dashicons-hammer' , 4 );

		// Extra Temporarly Sub Testing pages
		foreach ( $this->temp_test_areas() as $area ) {
			$name = $this->page_name( $area );

			add_submenu_page( 
				'dgenny_main_test_page',
				$name,
				$name,
				'manage_options',
				$area,
				array(  $this , 'html'   )
			);			
		}
	}

	public function html()
	{
		$name = $_GET['page'];
		echo '<h1>'.$this->page_name($name).'</h1>';
		dg_view( $this->page_file ( $name ));

	}

	public function page_file($name ,$php = false){
		return $php ? $name.'/'.$name.'.php' : $name.'/'.$name ;
	}

	public function page_name( $area ){
		$area = str_replace('_', ' ', $area);
		return ucwords(strtolower($area));
	}

	// as a dashboard notice  allways appears in all admin pages
	public function debug_admin_notice(){
		echo '<div class="notice notice-warning is-dismissible">';
		dg_view('admin_notice');
		echo '</div>';
	}
}