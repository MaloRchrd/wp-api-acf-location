<?php


// register Google map api key for ACF plugin
function my_acf_google_map_api( $api ){

	$api['key'] = 'AIzaSyCyJ9DzfTGLq2etKNEpgecaw241uvAoeq0';

	return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyCyJ9DzfTGLq2etKNEpgecaw241uvAoeq0');
}

add_action('acf/init', 'my_acf_init');
