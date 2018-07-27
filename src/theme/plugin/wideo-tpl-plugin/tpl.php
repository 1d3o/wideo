<?php
/*
Plugin Name: Wideo TPL
Plugin URI: http://www.ideonetwork.it/
Description: Save template options on a custom Wordpress section.
Version: 1.0
Author: ídeo SRL
Author URI: http://www.ideonetwork.it/
*/

add_action('admin_menu', 'wideo_tpl_setup_menu');

// Add menu voice.
function wideo_tpl_setup_menu() {
    add_menu_page( 'Settaggi', 'Settaggi', 'read', 'tpl', 'wideo_tpl_view', 'dashicons-admin-settings', 76 );
}

// Template view.
function wideo_tpl_view() {
  $initialize_missing = true;

  if (function_exists('wideo_tpl_initialize')) {
    $settings = wideo_tpl_initialize();
    $initialize_missing = false;
    $flash_completed = false;

    foreach($settings as $key => $value) {
      if(isset($_POST["tpl_$key"])) {
        $flash_completed = true;
        update_option( "tpl_$key", $_POST["tpl_$key"]);
      }
    }
  }

  include 'view.php';
}

?>
