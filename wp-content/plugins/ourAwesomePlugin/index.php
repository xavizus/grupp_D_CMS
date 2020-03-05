<?php
/*
Plugin Name: Test plugin
Description: A test plugin to demonstrate wordpress functionality
Author: Stephanus Pungros
Version: 0.1
*/

function add_queryvars( $qvars )
		{
			$qvars[] = 'noOfRooms';
			return $qvars;
		}

function changeHomeDefaultPostType($query) {
	if(!is_admin() &&  $query->is_main_query() && $query->is_front_page()) {
		$query->set('post_type', 'realestate');
		$query->set('meta_query', array(
            array(
                'key' => 'selecteditem',
				'value' => '1',
            )
		));
	}
}

/*
 * Extend wp search to include custom post meta 
 */
 
function custom_search_query( $query ) {
    if ( !is_admin() && $query->is_search() && isset($query->query_vars['noOfRooms'])) {
        $query->set('meta_query', array(
            array(
                'key' => 'noofrooms',
				'value' => $query->query_vars['noOfRooms'],
				'type' => 'numeric'
            )
		));
         $query->set('post_type', 'realestate'); // optional
	};
}

add_filter( 'query_vars', 'add_queryvars');
add_filter( 'pre_get_posts', 'changeHomeDefaultPostType');
add_filter( 'pre_get_posts', 'custom_search_query');
 
?>