<?php
/*
Plugin Name: ourAwesomePlugin
Description: A Real estate plugin
Author: 
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
		$query->set('posts_per_page', '5');
		$query->set('post_status', 'publish');
	}
}

function max_min_meta_value($request){
	$allowed_metakeys = array(
		"noofrooms",
		"kvm",
		"showdate",
		"selecteditems",
		"initialbid"
	);
	$metakey = strtolower($request['metakey']);

	if(! in_array($metakey,$allowed_metakeys)) {
		return new WP_Error( 
			'no_metakey', 
			'Invalid metakey', 
			array( 'status' => 404 ) );
	}

	global $wpdb;
	
    $queryMax = $wpdb->prepare(
        "SELECT max( cast( meta_value as UNSIGNED ) )  
        FROM {$wpdb->postmeta} 
        WHERE meta_key='%s'",
        $metakey
	);
	$queryMin = $wpdb->prepare(
        "SELECT min( cast( meta_value as UNSIGNED ) )  
        FROM {$wpdb->postmeta} 
        WHERE meta_key='%s'",
        $metakey
	);
	$queryFieldLabel = $wpdb->prepare(
		"SELECT meta_value
		FROM {$wpdb->postmeta}
		WHERE meta_key='%s'
		LIMIT 1
		",
		'_' . $metakey
	);
	if($metakey !== "initialbid") {
		$field = get_field_object($wpdb->get_var($queryFieldLabel));
	}
	else {
		$field['label'] = "kr";
	}

	$returnData = array(
		"metakey" => $metakey,
		"metalabel" => $field['label'],
		"max" => $wpdb->get_var($queryMax),
		"min" => $wpdb->get_var($queryMin),
	);
	return $returnData;
}

function autocomplete() {
	$term = strtolower($_GET['term']);
	$suggestions = array();

	global $wpdb;

	$term = "%" . $term . "%";
	//return $term;
	$query = $wpdb->prepare(
		"SELECT terms.name, terms.slug
		FROM {$wpdb->terms} as terms
		LEFT JOIN {$wpdb->term_taxonomy} as termtax
		ON termtax.taxonomy='properties' AND terms.term_id=termtax.term_id
		WHERE terms.slug LIKE '%s'",
		$term
	);
	$results = $wpdb->get_results($query);

	foreach($results as $row) {
		$suggestions[] = array(
			"label" => $row->name,
			"value" => $row->slug
		);
	}
	

	return $suggestions;
	
}

function custom_search_query( $query ) {
    if ( !is_admin() && $query->is_search() && isset($_REQUEST['customSearch'])) {
		$metaQuery = array(
			'relation' => 'AND',
            array(
                'key' => 'noofrooms',
				'value' => array(sanitize_text_field($_REQUEST['minnoofrooms']), sanitize_text_field($_REQUEST['maxnoofrooms'])),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			),
			array(
                'key' => 'kvm',
				'value' => array(sanitize_text_field($_REQUEST['minkvm']), sanitize_text_field($_REQUEST['maxkvm'])),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			),
			array(
                'key' => 'initialbid',
				'value' => array(sanitize_text_field($_REQUEST['mininitialbid']), sanitize_text_field($_REQUEST['maxinitialbid'])),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
			)
		);

		
		if(!empty($_REQUEST['search-properties'])) {
			$tax_query = array (
				array(
					'taxonomy' => 'properties',
					'field' => 'term',
					'terms' => 'nara-till-skolan',
				)
			);

			$query->set('tax_query', $tax_query);
		}

		if(!empty($_REQUEST['s'])) {
			$metaQuery[] = array(
				array(
					'key' => 'city',
					'value' => sanitize_text_field($_REQUEST['s']),
					'compare'   => 'LIKE',
				)
			);
		}
		$query->set('s','');
        $query->set('meta_query', $metaQuery);
		$query->set('post_type', 'realestate');
		
	};
}

function custom_property_query($query) {
	if ( !is_admin() && is_tax('propertytype') && $query->is_main_query()) {
		$query->set( 'orderby', 'meta_value' );
		$query->set('meta_query', array(
			'meta_value' => array (
				'key' => 'selecteditem',
				'type' => 'NUMERIC'
			)
		));
	}
}

add_action( 'rest_api_init', function () {
	register_rest_route( 'ourAwesomePlugin/v1', '/metakeyMinMax/(?P<metakey>[a-zA-Z]+)', array(
	  'methods' => 'GET',
	  'callback' => 'max_min_meta_value',
	) );

	register_rest_route( 'ourAwesomePlugin/v1', '/autocomplete', array(
		'methods' => 'GET',
		'callback' => 'autocomplete',
	  ) );
  } );
  
add_filter( 'query_vars', 'add_queryvars');
add_filter( 'pre_get_posts', 'changeHomeDefaultPostType');
add_filter( 'pre_get_posts', 'custom_search_query');
add_filter( 'pre_get_posts', 'custom_property_query');
?>