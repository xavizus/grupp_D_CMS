<?php
/*
Plugin Name: Test plugin
Description: A test plugin to demonstrate wordpress functionality
Author: Stephanus Pungros
Version: 0.1
*/

add_action('admin_enqueue_scripts', 'callback_for_setting_up_scripts');

function callback_for_setting_up_scripts() {
    wp_register_style( 'bootstrap', plugin_dir_url( __FILE__ ) . "/css/bootstrap.min.css" );
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_script( 'bootstrapJS', plugin_dir_url( __FILE__ ) . "/js/bootstrap.min.js", array( 'jquery' ) );
}

add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Real Estate Page', 'Real Estate', 'edit_posts', 'real-estate-plugin', 'view_real_estate_init' );
        add_submenu_page('real-estate-plugin', 'Visa fastighet page', 'Visa fastighet behörigheter','edit_posts', 'real-estate-plugin'); 
        add_submenu_page('real-estate-plugin', 'Lägg till fastighet page', 'Lägg till fastighet ','edit_posts', 'real-estate-add-plugin', 'add_estate_init'); // Author
        add_submenu_page('real-estate-plugin', 'Editera fastighet page', 'Editera fastighet', 'edit_others_posts', 'real-estate-edit-estate', 'edit_estate_init'); // Editor 
        add_submenu_page('real-estate-plugin', 'Ta bort fastighet page', 'Ta bort fastighet', 'manage_options', 'real-estate-remove-estate', 'remove_estate_init'); // Admin
}

function view_real_estate_init() {
    echo "<h1>Du kan göra följande:</h1>";
    echo "<ul class='list-group w-25'>";
    foreach ($GLOBALS['submenu']['real-estate-plugin'] as $realEstateCapabiltity) {
        if(current_user_can($realEstateCapabiltity[1])) {
            echo "<li class='list-group-item list-group-item-action'>" . $realEstateCapabiltity[0] . "</li>";
        }
    } 
    echo "</ul>";
}

function add_estate_init(){
    echo "<h1>Du lägger nu till en fastighet!</h1>";
}

function edit_estate_init(){
    echo "<h1>Du editerar nu en fastighet!</h1>";
}

function remove_estate_init(){
    echo "<h1>Du tar nu bort en fastighet!</h1>";
}

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
				'taxonomy' => 'propertytype',
				'field_type' => 'select_advanced',
			)
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'your_prefix_get_meta_box' );
 
?>