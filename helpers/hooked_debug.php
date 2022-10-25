<?php
// pre_action();
function pre_action( $name=null){
	$name = $name !== null ? $name : 'all';
	add_action( $name,'pre_hook');
}
function pre_hook(){
	if (stripos(current_action(), "world") !== false) {
		prr(current_action());
	}
}
/****************************************** Debug Log CPT ******************************************/
function regist_my_debug_log_cpt() {

	/**
	 * Post Type: Deug Log.
	 */

	$labels = [
		"name" => __( "Deug Log", "martfury" ),
		"singular_name" => __( "Deug Logs", "martfury" ),
		"menu_name" => __( "Deug Log", "martfury" ),
		];

	$args = [
		"label" => __( "Deug Log", "martfury" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "deug_log", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-text-page",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "deug_log", $args );
}

add_action( 'init', 'regist_my_debug_log_cpt' );

add_filter( 'manage_edit-deug_log_columns','tjr_deug_log_orders_content_column');
function tjr_deug_log_orders_content_column( $columns)
{
	$new_columns =  array();
	foreach ( $columns as $key => $value) {
		$new_columns[$key] = $value;
		if( $key ==  'title'){
			$new_columns['content'] = __('Content','tjr');
		}
	}
    return $new_columns;    
}

add_action( 'manage_deug_log_posts_custom_column' , 'tjr_deug_log_orders_content_column_content' );
function tjr_deug_log_orders_content_column_content( $column ) {
	global $post;
	$json ='';
	$content = get_the_content(null,false,$post);
	$json = json_decode( $content,true);
	if(is_array( $json) && count( $json) > 1){
		prr( $json,'no_title');
	}else {
		echo $content;
	}
}