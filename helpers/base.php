<?php
function get_json( $file ){
	$content = file_get_contents('jsons/'.$file.'.json' );
	return(json_decode( $content, true));
};
function mk_json( $fields,$json_file ){
	$fp = fopen( 'jsons/'.$json_file.'.json', 'w' );
	fwrite( $fp, json_encode( $fields ) );
	fclose( $fp );
};
function json_response( $response ){
	header( 'Content-Type: application/json' );
	echo  json_encode( $response);
}
function wp_content( $id = 0 ){
	if(is_object( $id ) && isset( $id->ID ) ){
		$id =  $id->ID; 
	}
	if( $id == 0 ){
		$id = get_the_ID();
	}
	$content = get_post( $id);
	$content = $content->post_content;
	$content = apply_filters( 'the_content', $content);
	$content = str_replace( ']]>', ']]&gt;', $content);
	$content =  $content != '' ?  $content : __('No content added' , 'dgenny') ; 
	return $content;
}

function get_post_by_meta( $meta, $value ){
	$args = array(
		'post_type'     => 'any',
		'meta_key'      => $meta,
		'meta_value'    => $value,
	);
	$posts = get_posts( $args );
	if( !empty( $posts ) ){
		return $posts[0];
	}else {
		return false;
	}
}

function dg_view( $view, $vars= array() ){
	$view = DGENNY_PLUGIN_DIR.'views/'.$view.'.php';

	if( !is_file( $view ) ){
		die ( __( 'No File with this name', 'dgenny' ) );
	}

	// global $wp_query;
	foreach ( $vars as $var => $value) {
		// $wp_query->set( $var, $value );
	}

	// load_template( $view );
}

function ajax_request_maker( $data ){
	$data['ajax_url'] 		= admin_url( 'admin-ajax.php' );
	$data['waiting_msg']	= __( 'Waiting Response . . . . .', 'dgenny' );
	$data['response_div']	= isset( $data['response_div']) ? $data['response_div'] : $data['action']."_response";
	$data['form']			= isset( $data['form']) ? $data['form'] : $data['action']."_form";
	dg_view( 'ajax_request', $data );	
}

function dg_option( $option_name){
	$settings = get_option( 'dGenny_Settings' )['general'];
	return isset( $settings[$option_name] ) ? $settings[$option_name] : false ; 
}

function mirror_request( $bridge='',$url='',$headers = array(),$body = array(),$params = array())
{
	$bridge = 'http://'.$bridge.'/wp-admin/admin-ajax.php?action=dgenny_request_mirror';
	
	$params['url'] 		= $url;
	$params['headers'] 	= $headers;
	$params['body'] 	= $body;

	$bridge = $bridge.'&'.http_build_query( $params);

	echo $bridge . '</br>';

	return;
	$response = wp_remote_post(
		$bridge, 
		array(
			'method'      => 'POST',
			'timeout'     => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking'    => true,
		)
	  );
	return $response;	  
}