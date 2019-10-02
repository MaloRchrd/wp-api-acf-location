<?php
/*
Plugin Name:  WP API ACF location
Plugin URI: https://github.com/MaloRchrd/wp-api-acf-location
Description: This plugin add location to you posts and customize wordrpress REST API to perform geo-query based on ACF latitude and longitude fields.
Version: 0.0.2
Author: Malo Richard
Author URI: https://github.com/MaloRchrd
Text Domain: wp-api-acf-location
*/

include( plugin_dir_path( __FILE__ ) . 'inc/add-loc-to-posts.php');
include( plugin_dir_path( __FILE__ ) . 'inc/vincenty-distance.php');
include( plugin_dir_path( __FILE__ ) . 'inc/gmap-apikey.php');
include( plugin_dir_path( __FILE__ ) . 'inc/plugin-option-page.php');
include( plugin_dir_path( __FILE__ ) . 'inc/plugin-template-page.php');


function acf_location_api($loc){
	 $post_type = get_option('wp_api_acf_loc_custom_post_type');
	if ($post_type) {
		$args = [
			'numberposts' => 99999,
			'post_type' => $post_type,
			'category' => $loc['cat']
		];
	}else {
		$args = [
			'numberposts' => 99999,
			'post_type' => 'post',
			'category' => $loc['cat']
		];
	}


	$posts = get_posts($args);
	$data = [];
	$i = 0;

	foreach($posts as $post) {
		$location = get_field('location',$post->ID );
		$disance  = vincentyGreatCircleDistance(
	     $loc['lat'], $loc['long'], $location['lat'], $location['lng'], $earthRadius = 6371000);
		 $maxdist = $loc['dist'] * 1000;
		 $cat = get_the_category($post->ID);

		if ($disance < $maxdist) {
			$data[$i]['id'] = $post->ID;
			$data[$i]['categoryid'] = $cat;
			$data[$i]['category'] = $cat[0]->name;
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

	register_rest_route('/acf-location/v1', 'posts/cat=(?P<cat>[a-z0-9 ,\-]+)/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)/dist=(?P<dist>[a-z0-9 .\-]+)',[
		'methods' => 'GET',
		'callback' => 'acf_location_api',

	]);
	// register_rest_route('/acf-location/v1', $post_type .'/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)/dist=(?P<dist>[a-z0-9 .\-]+)',[
	// 	'methods' => 'GET',
	// 	'callback' => 'acf_location_api',
	//
	// ]);
	//
	// register_rest_route('/acf-location/v1', $post_type .'/cat=(?P<cat>[a-z0-9 ,\-]+)/lat=(?P<lat>[a-z0-9 .\-]+)/long=(?P<long>[a-z0-9 .\-]+)/dist=(?P<dist>[a-z0-9 .\-]+)',[
	// 	'methods' => 'GET',
	// 	'callback' => 'acf_location_api',
	//
	// ]);

});
