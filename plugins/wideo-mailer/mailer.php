<?php

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
