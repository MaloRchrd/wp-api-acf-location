<?php


// register Google map api key for ACF plugin
function my_acf_google_map_api( $api ){

	$api['key'] = 'GMAP_API_KEY';

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function my_acf_init() {

	acf_update_setting('google_api_key', 'GMAP_API_KEY');
}

add_action('acf/init', 'my_acf_init');
