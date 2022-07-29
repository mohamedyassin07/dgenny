<?php
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

class dGenny_Settings extends AdminPageFramework
{
    public function setUp()
    {
        $this->setRootMenuPageBySlug('dgenny_main_test_page');
        $this->addSubMenuItems(
            array(
            'title' => __('dGenny Settings', 'dgenny') ,
            'page_slug' => DGENNY_SLUG            
            )
        );

        $this->addSettingSections(
            DGENNY_SLUG,
            array(
            'section_id' => 'general',
            'title' => __('General Settings', 'dgenny') ,
            )
        );

        $this->addSettingFields(
            'general',
            array(
                'field_id' => 'pipedream_url',
                'type' => 'url',
                'title' => 'PipeDream URl',
                'description' => 'Get endpoint url from <a href="https://pipedream.com" target="_blank" >https://pipedream.com</a> '
            ),
            array(
            'field_id' => 'debug',
            'title' => __('Enable Debug', 'dgenny') ,
            'type' => 'radio',
            'label' => array(
                    '0' => 'Disable',
                    '1' => 'Enable',
                ),
            'default' => '1',
        ));

        // Submit Button
        $this->addSettingFields('general', array(
            'field_id' => 'submit_button',
            'type' => 'submit',
            'show_title_column' => false,
        ));
    }

    // do_{{page_slug}}
    // do_DGENNY_SLUG
    public function do_dgenny()
    {
        // Nothing Now
    }
}