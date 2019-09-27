<?php
/*
Plugin Name:  WP API ACF location
Plugin URI: https://github.com/MaloRchrd/wp-api-acf-location
Description: This plugin add location to you posts and customize wordrpress REST API to perform geo-query based on ACF latitude and longitude field.
Version: 0.0.1
Author: Malo Richard
Author URI: https://github.com/MaloRchrd
Text Domain: wp-api-acf-location
*/

include( plugin_dir_path( __FILE__ ) . 'inc/add-loc-to-posts.php');
include( plugin_dir_path( __FILE__ ) . 'inc/vincenty-distance.php');
include( plugin_dir_path( __FILE__ ) . 'inc/gmap-apikey.php');

function acf_location_api($loc){

	$args = [
		'numberposts' => 99999,
		'post_type' => 'post'
	];
	$posts = get_posts($args);
	$data = [];
	$i = 0;

	foreach($posts as $post) {
		$location = get_field('location',$post->ID );
		$disance  = vincentyGreatCircleDistance(
	     $loc['lat'], $loc['long'], $location['lat'], $location['lng'], $earthRadius = 6371000);
		 $maxdist = $loc['dist'] * 1000;

		if ($disance < $maxdist) {
			$data[$i]['id'] = $post->ID;
			$data[$i]['title'] = $post->post_title;
			$data[$i]['content'] = $post->post_content;
			$data[$i]['slug'] = $post->post_name;
			$data[$i]['location'] = $location ;
			$data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
			$data[$i]['featured_image']['medium'] = get_the_post_thumbnail_url($post->ID, 'medium');
			$data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');

		}

		$i++;
	}
	return $data;

}

add_action('rest_api_init',function(){

	register_rest_route('/acf-location/v1', 'posts/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)/dist=(?P<dist>[a-z0-9 .\-]+)',[
		'methods' => 'GET',
		'callback' => 'acf_location_api',

	]);

});
