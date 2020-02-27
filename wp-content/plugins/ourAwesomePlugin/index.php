<?php
/*
Plugin Name: Test plugin
Description: A test plugin to demonstrate wordpress functionality
Author: Stephanus Pungros
Version: 0.1
*/

add_action('admin_menu', 'test_plugin_setup_menu');
 
function test_plugin_setup_menu(){
        add_menu_page( 'Real Estate Page', 'Real Estate', 'publish_posts', 'real-estate-plugin', 'add_estate' );
        add_submenu_page('real-estate-plugin', 'Lägg till fastighet page', 'Lägg till fastighet','publish_posts', 'real-estate-plugin'); //Author
        add_submenu_page('real-estate-plugin', 'Editera fastighet page', 'Editera fastighet', 'moderate_comments', 'real-estate-edit-estate', 'edit_estate_init'); // Editor 
        add_submenu_page('real-estate-plugin', 'Ta bort fastighet page', 'Ta bort fastighet', 'manage_options', 'real-estate-remove-estate', 'remove_estate_init'); // Admin
}

function add_estate(){
    echo "<h1>Du lägger nu till en fastighet!</h1>";
}

function edit_estate_init(){
    echo "<h1>Du editerar nu en fastighet!</h1>";
}

function remove_estate_init(){
    echo "<h1>Du tar nu bort en fastighet!</h1>";
}
 
?>