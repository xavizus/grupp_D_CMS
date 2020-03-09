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
		"SELECT terms.name
		FROM {$wpdb->terms} as terms
		LEFT JOIN {$wpdb->term_taxonomy} as termtax
		ON termtax.taxonomy='properties' AND terms.term_id=termtax.term_id
		WHERE terms.slug LIKE '%s'",
		$term
	);
	$results = $wpdb->get_results($query);

	foreach($results as $row) {
		$suggestions[] = $row->name;
	}
	

	return $suggestions;
	
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
 
?>