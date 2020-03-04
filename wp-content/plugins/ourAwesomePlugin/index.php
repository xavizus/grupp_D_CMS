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
				'type' => 'text',
				'name' => esc_html__( 'Adress', 'Real-Estate' ),
				'desc' => esc_html__( 'Adress till objektet', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'showdate',
				'type' => 'datetime',
				'name' => esc_html__( 'Visningsdatum', 'Real-Estate' ),
				'timestamp' => 'true',
			),
			array(
				'id' => $prefix . 'noofrooms',
				'type' => 'number',
				'name' => esc_html__( 'Antal Rum', 'Real-Estate' ),
				'min' => '1',
			),
			array(
				'id' => $prefix . 'kvm',
				'type' => 'number',
				'name' => esc_html__( 'Kvm', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'initialbid',
				'type' => 'number',
				'name' => esc_html__( 'Utgångsbud', 'Real-Estate' ),
			),
			array(
				'id' => $prefix . 'selecteditems',
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
add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );
 
?>