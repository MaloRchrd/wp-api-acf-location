# Wp-api-acf-location

## Feature
* wp-api-acf-location is a plugin that add location to your posts using ACF
* Geo query custom REST API endpoint


## Setup
* For the plugin to work you need to have [ACF](https://fr.wordpress.org/plugins/advanced-custom-fields/) installed
* Replace ``` GMAP_API_KEY ```  with your own key in ```gmap-apikey.php``` file
* that's it ;-)

## Custom endpoint
Parameters
* lat
* long
* dist (km)

### Exemple request
```
http://exemple.com/wp-json/acf-location/v1/posts/lat=48.85296820000001/long=2.3499021000000084/dist=10/
```

## Exemple response
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
