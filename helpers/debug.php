<?php
/****************************************** Debug Helpers ******************************************/
function get_line_info(){
	$short_folder = '';
	$excuting_line = debug_backtrace()[1]['line'];
	$excuting_file = debug_backtrace()[1]['file'];
	
	if (preg_match('/plugins(.*?).php/', $excuting_file, $match) == 1) {
		$short_folder = $match[1];
	}

	if ( !isset($short_folder) && preg_match('/themes(.*?).php/', $excuting_file, $match) == 1) {
		$short_folder = $match[1];
	}

	return "$short_folder@$excuting_line";
}

function echo_line( $echo = true){
	$line = get_line_info();

	if( $echo){
		echo "<h2>$line</h2>";
	}else {
		return $line ;
	}
}

function prr( $element, $title = '', $echo = true ){
	$title = is_string( $title) && strlen( $title) ? $title.' ' : '';
	$title = "<h3>$title(".get_line_info().")</h3>";

	if( $echo){
		echo "$title<pre>";
		print_r( $element);
		echo "</pre>";
	}else {
		return "$title<pre>".print_r( $element)."</pre>";
	}
}

function text( $text= NULL , $return =  false){

	if ( $text == NULL) {
		$text = "<h6 >A long text to be shown in places when you can't see results so perhaps you will need to make a standard check . You can search for me in the page with 6s ssssss.</h6>";
	}else {
		$text =  "<h3 >$text</h3>";
	}
	if( $return ==  false){
		echo $text;
	}else {
		return $text;
	}
}
function remote_prr( $args = array() ){
	$url = 'https://e96bec7d52189e30b8db9e17cce0eb53.m.pipedream.net';

	if( ! $url ){
		echo __('Please Insert PipeDream URl first ');
		return;
	}

	if( !is_array( $args) && !is_object( $args) ){
		$args 	= array('info' => $args);
	}

	$url = $url.'/?'. http_build_query( $args);
	$response = wp_remote_get( $url);

	return json_decode( wp_remote_retrieve_body( $response ), true );
}
function log_prr( $content='', $title = null){	
	$title = $title != null ? $title :  date('h:i:s') ;
	$title = is_object( $content) && isset( $content->post_title) ? $title . " :: " . $content->post_title :  $title ;
	$content =  is_string( $content) ?  $content :  json_encode(json_decode(json_encode( $content),true));

	$my_post = array(
    'post_type' => 'deug_log',
    'post_title'    => $title ,
    'post_content'  => $content,
    'post_status'   => 'publish',
  );  
  wp_insert_post( $my_post );
}
function is_local(){
	if ( $_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR']=='::1') {
		return TRUE;
	}
};
/****************************************** Actions Debuging ******************************************/
function dump_hook( $tag, $hook ) {
    echo ">>>>>\t<strong>$tag</strong><br>";

    foreach( $hook as $priority => $functions ) {

	echo $priority;

	foreach( $functions as $function )
	    if( $function['function'] != 'list_hook_details' ) {

		echo "\t";

		if( is_string( $function['function'] ) )
		    echo $function['function'];

		elseif(is_array( $function) && is_string( $function['function'][0] ) )
		     echo $function['function'][0] . ' -> ' . $function['function'][1];

		elseif( is_object( $function['function'][0] ) )
		    echo "(object) " . get_class( $function['function'][0] ) . ' -> ' . $function['function'][1];

		else
		    print_r( $function);

		echo ' (' . $function['accepted_args'] . ') <br>';
		}
    }

    echo '';
}
function list_hooks( $filter = false ){
	global $wp_filter;
	$hooks = (array)$wp_filter;
	foreach( $hooks as $tag => $hook ){
	    if ( false === $filter || false !== strpos( $tag, $filter ) ){
			dump_hook( $tag, $hook);
        }
    }
}
function list_hook_details( $input = NULL ) {
    global $wp_filter;

    $tag = current_filter();
    if( isset( $wp_filter[$tag] ) )
		dump_hook( $tag, $wp_filter[$tag] );

	return $input;
}
function list_live_hooks( $hook = false ) {
    if ( false === $hook )
		$hook = 'all';

    add_action( $hook, 'list_hook_details', -1 );
}