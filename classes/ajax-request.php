<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Dgenny_Ajax_Request
 *
 * This class update the plugin files
 * 
 *
 * @package		DGENNY
 * @subpackage	Classes/Dgenny_Ajax_Request
 * @author		Mohamed Yassin
 * @since		1.0.0
 */
class Dgenny_Ajax_Request {

    public $slug;

    function __construct( $args ) {

    }

    function ajax_request_maker( $data ){
        $data['ajax_url'] 		= admin_url( 'admin-ajax.php' );
        $data['waiting_msg']	= __( 'Waiting Response . . . . .', 'dgenny' );
        $data['response_div']	= isset( $data['response_div']) ? $data['response_div'] : $data['action']."_response";
        $data['form']			= isset( $data['form']) ? $data['form'] : $data['action']."_form";

    }

    function form_html(){ ?>

    <?php  }
}
