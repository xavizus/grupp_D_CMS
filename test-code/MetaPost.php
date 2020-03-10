<?php
function your_prefix_get_meta_box( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'untitled',
        'title' => esc_html__( 'Untitled Metabox', 'Real-Estate' ),
        'post_types' => array('properties' ),
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
				'taxonomy' => 'propertyType',
				'field_type' => 'select',
			),
			array(
				'id' => $prefix . 'properties',
				'type' => 'taxonomy',
				'name' => esc_html__( 'Egenskaper', 'Real-Estate' ),
				'desc' => esc_html__( 'Egenskaper för fastigheten', 'Real-Estate' ),
				'taxonomy' => 'properties',
				'field_type' => 'select',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );