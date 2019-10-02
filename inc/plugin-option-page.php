
<?php

function wp_api_acf_loc_register_settings() {
   add_option( 'wp_api_acf_loc_gmap_api_key', 'Add you gmap api key');
   register_setting( 'wp_api_acf_loc_options_group', 'wp_api_acf_loc_gmap_api_key', 'myplugin_callback' );
   add_option( 'wp_api_acf_loc_custom_post_type', 'post type slug');
   register_setting( 'wp_api_acf_loc_options_group', 'wp_api_acf_loc_custom_post_type', 'myplugin_callback' );
   add_option( 'wp_api_acf_loc_leaflet_provider', 'Copy and paste leaflet provider code');
   register_setting( 'wp_api_acf_loc_options_group', 'wp_api_acf_loc_leaflet_provider', 'myplugin_callback' );
}
add_action( 'admin_init', 'wp_api_acf_loc_register_settings' );


function wp_api_acf_loc_register_options_page() {
  add_options_page('WP API ACF location', 'REST API Location ', 'manage_options', 'myplugin', 'myplugin_options_page');
}
add_action('admin_menu', 'wp_api_acf_loc_register_options_page');


 function myplugin_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h1>WP API ACF location Settings</h1>
  <form method="post" action="options.php">
  <?php settings_fields( 'wp_api_acf_loc_options_group' ); ?>
  <h3>Gmap api key </h3>
  <p>Find your gmap Api Key <a href="https://console.cloud.google.com/apis/" target="_blank">here</a></p>
  <h4>⚠️This API key is required for the plugin to work⚠️</h4>
  <table>
  <tr valign="top">
  <th scope="row"><label for="wp_api_acf_loc_gmap_api_key">Api Key</label></th>
  <td><input type="text" id="wp_api_acf_loc_gmap_api_key" name="wp_api_acf_loc_gmap_api_key" value="<?php echo get_option('wp_api_acf_loc_gmap_api_key'); ?>" /></td>
  </tr>
  </table>
  <!-- <h3>Custom post type </h3>
  <h4>type the slug of you custom post type (default : post)</h4>
  <p>Note that changing post type will only apply to the api call<br> you will need to add manually the acf feild</p>
  <table>
  <tr valign="top">

  <th scope="row"><label for="wp_api_acf_loc_custom_post_type">slug</label></th>
  <td><input type="text" id="wp_api_acf_loc_custom_post_type" name="wp_api_acf_loc_custom_post_type" value="<?php echo get_option('wp_api_acf_loc_custom_post_type'); ?>" /></td>
  </tr>
  </table>
  <h3>Leaflet provider (front end map)</h3>
  <p>Find the beautiful map designs to customize your website <a href="https://leaflet-extras.github.io/leaflet-providers/preview/" target="_blank">here</a></p>
  <table>
  <tr valign="top">

  <th scope="row"><label for="wp_api_acf_loc_leaflet_provider">Leaflet provider</label></th>
  <td><textarea type="text" id="wp_api_acf_loc_leaflet_provider" name="wp_api_acf_loc_leaflet_provider" value="<?php echo get_option('wp_api_acf_loc_leaflet_provider'); ?>" ></textarea></td>
  </tr>
  </table> -->

  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>
