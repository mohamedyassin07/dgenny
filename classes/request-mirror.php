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

class dGenny_Request_Mirror
{
	public $url;
	public $params;
	public $headers;
	public $body;

	function __construct(){
		add_action( 'wp_ajax_dgenny_request_mirror', array( $this, 'request_mirror' ) );
		add_action( 'wp_ajax_nopriv_dgenny_request_mirror', array( $this, 'request_mirror' ) );
	}

	public function request_mirror()
	{
		// http://aqar/wp-admin/admin-ajax.php?action=dgenny_request_mirror

		$url = isset($_REQUEST['headers']) ? $_REQUEST['url'] : '' ;
		$headers = isset($_REQUEST['headers']) ? $_REQUEST['headers'] :  array();
		$body = isset($_REQUEST['body']) ? $_REQUEST['body'] :  array();
		$params = isset($_REQUEST['params']) ? $_REQUEST['params'] :  array();

		$headers['is_mirrored'] = true;

        $response = wp_remote_post(
            $url, 
            array(
                'method'      => 'POST',
                'timeout'     => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking'    => true,
                'body'    => $body,
                'headers' => $headers,
            )
        );

        if ( is_wp_error( $response ) ) {
			$status = 400;
		}else {
            $status = 200;
        }

		wp_send_json_success( $response , $status );
	}
}