<?php

function my_acf_google_map_api( $api ){

	$api['key'] = get_option('wp_api_acf_loc_gmap_api_key');

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


function my_acf_init() {

	acf_update_setting('google_api_key', get_option('wp_api_acf_loc_gmap_api_key'));
}

add_action('acf/init', 'my_acf_init');
