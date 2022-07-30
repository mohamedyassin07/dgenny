<?php
return ;
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

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

class dGenny_CRB
{
    public function __construct()
    {
        add_action( 'after_setup_theme', array( $this, 'load_carbon_fields' ) );

        add_action( 'carbon_fields_register_fields', array( $this, 'register_carbon_fields' ) );

        /* will succesfuly retrieve the data of the fields registered at
         * carbon_fields_register_fields action hook
         * if you retrieve the data before carbon_fields_fields_registered action hook
         * has fired it won't work
         */
        add_action( 'carbon_fields_fields_registered', array( $this, 'carbon_fields_values_are_available' ) );

    }

    public function load_carbon_fields()
    {
        require_once DGENNY_PLUGIN_DIR . 'libs/carbon-fields/vendor/autoload.php';
        \Carbon_Fields\Carbon_Fields::boot();
    }

    public function register_carbon_fields()
    {
        Container::make( 'theme_options', 'YourFancyPlugin options' )
            ->add_fields( 
                array(
                    Field::make( 'text', 'oppo1')
                ) 
            );
    }

    public function carbon_fields_values_are_available()
    {
        /* retrieve the values of your Carbon Fields related to your plugin */
        // var_dump( carbon_get_theme_option( 'oppo1' ) );
        /* do all the stuff that does rely on values of your Carbon Fields */
    }

}