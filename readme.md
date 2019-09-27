# Wp-api-acf-location

This plugin has been created to show post nearby on a map based on user location .

## Feature
* Add location to your posts using ACF
* Geo query custom REST API endpoint
* Category filtering (multi-categories support)
* Lightened Api response to the basic need


## Setup
* For the plugin to work you need to have [ACF](https://fr.wordpress.org/plugins/advanced-custom-fields/) installed
* Replace ``` GMAP_API_KEY ```  with your own key in ```gmap-apikey.php``` file
* That's it ;-)

## Custom API endpoint
Parameters
* lat
* long
* dist (km)

### Exemple request

#### Location
```
http://exemple.com/wp-json/acf-location/v1/posts/lat=48.852/long=2.349/dist=10/
```

#### Location + Category
```
http://exemple.com/wp-json/acf-location/v1/posts/cat=3/lat=48.852/long=2.349/dist=10/
```



### Exemple response
```json
{
	"id": 25,
	"title": "Paris",
	"content": "<!-- wp:paragraph -->\n<p>Hello this is an exemple post for Wp-api-acf-location</p>\n<!-- /wp:paragraph -->",
	"slug": "paris",
	"location": {
		"address": "Notre-Dame de Paris, Parvis Notre-Dame - place Jean-Paul-II, Paris, France",
		"lat": "48.85296820000001",
		"lng": "2.3499021000000084"
	},
	"featured_image": {
		"thumbnail": "http://exemple.com/wp-content/uploads/2019/09/tour-eiffel-150x150.png",
		"medium": "http://exemple.com/wp-content/uploads/2019/09/tour-eiffel-300x191.png",
		"large": "http://exemple.com/sailor/wp-content/uploads/2019/09/tour-eiffel-1024x651.png"
	}
}
```


## Todo

* Admin page
    * Register goole map api key
    * Allow custom post type
* Map template.
* More
