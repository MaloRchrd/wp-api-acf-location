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

### Exemple
```
http://exemple.com/wp-json/acf-location/v1/posts/lat=48.85296820000001/long=2.3499021000000084/dist=10/
```
