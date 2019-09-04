<?php
/*
Plugin Name: Wideo Mailer
Plugin URI: http://www.ideonetwork.it/
Description: Manage contacts requests and emails from custom forms.
Version: 1.0
Author: ídeo SRL
Author URI: http://www.ideonetwork.it/
*/

add_action('admin_menu', 'wideo_mailer_setup_menu');

// Add menu voice.
function wideo_mailer_setup_menu() {
  add_menu_page( 'Contatti', 'Contatti', 'wideo-mailer-plugin', 'mailer', 'wideo_mailer_view', '
  dashicons-email', 75 );

  // add user access
  $admins = get_role('administrator');
  $admins->add_cap('wideo-mailer-plugin');
}

// Template view.
function wideo_mailer_view() {
  include 'view.php';
}
