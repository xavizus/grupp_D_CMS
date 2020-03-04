<?php

add_action('plugins_loaded', 'search-filter-extended-init');

function search_filter_extended_init() {
    if (class_exists('SearchAndFilter')) {

    }
}

class search_filter_extended extends SearchAndFilter {
    
}