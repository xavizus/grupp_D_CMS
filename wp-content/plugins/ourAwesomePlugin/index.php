<?php
/*
Plugin Name: Test plugin
Description: A test plugin to demonstrate wordpress functionality
Author: Stephanus Pungros
Version: 0.1
*/

function your_prefix_get_meta_box( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'untitled',
        'title' => esc_html__( 'Extra Properties', 'Real-Estate' ),
        'post_types' => array('realestate' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'address',
				"taxonomy" => "address",
				'type' => 'text',
				'name' => esc_html__( 'Adress', 'Real-Estate' ),
				'desc' => esc_html__( 'Adress till objektet', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'zipcode',
				'type' => 'taxonomy',
				'type' => 'text',
				'name' => esc_html__( 'Postnummer', 'Real-Estate' ),
				'desc' => esc_html__( 'Postnummer till fastigheten', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'city',
				'type' => 'text',
				'name' => esc_html__( 'Ort', 'Real-Estate' ),
				'desc' => esc_html__( 'Postnummer till fastigheten', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'showdate',
				'type' => 'taxonomy',
				'type' => 'datetime',
				'name' => esc_html__( 'Visningsdatum', 'Real-Estate' ),
				'timestamp' => 'true',
			),
			array(
				'id' => $prefix . 'noofrooms',
				'type' => 'taxonomy',
				'type' => 'number',
				'name' => esc_html__( 'Antal Rum', 'Real-Estate' ),
				'min' => '1',
			),
			array(
				'id' => $prefix . 'kvm',
				'type' => 'taxonomy',
				'type' => 'number',
				'name' => esc_html__( 'Kvm', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'initialbid',
				'type' => 'taxonomy',
				'type' => 'number',
				'name' => esc_html__( 'Utgångsbud', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'selecteditems',
				'type' => 'taxonomy',
				'name' => esc_html__( 'Utvalda objekt', 'Real-Estate' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Ska objektet visas under utvalda objekt?', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'propertytype',
				'type' => 'taxonomy',
				'name' => esc_html__( 'Bostadstyp', 'Real-Estate' ),
				'desc' => esc_html__( 'Välj bostadstyp', 'Real-Estate' ),
				'taxonomy' => 'propertytype',
				'field_type' => 'select_advanced',
			)
		),
	);

	return $meta_boxes;
}
//add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );


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
		$query->set('posts_per_page', '5');
		$query->set('post_status', 'publish');
	}
}

/*
 * Extend wp search to include custom post meta 
 */
 
function custom_search_query( $query ) {
    if ( !is_admin() && $query->is_search() && isset($query->query_vars['noOfRooms'])) {

		if(!isset($query->query_vars['s'])) {
			
		}
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