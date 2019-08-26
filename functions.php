<?php

// Plugins
require get_template_directory() . '/plugins/tgm.php';
require get_template_directory() . '/plugins/wideo-tpl/tpl.php';
// require get_template_directory() . '/plugins/wideo-mailer/mailer.php'; // WORK IN PROGRESS

// Backend
// -> Update wordpress admin panel and options
require get_template_directory() . '/backend/wordpress.php';
// -> Update wordpress front-end management
require get_template_directory() . '/backend/front.php';
// -> Update wordpress users and capabilities
require get_template_directory() . '/backend/users.php';
// -> Update wordpress menus
require get_template_directory() . '/backend/menus.php';
// -> Update wordpress custom post types
require get_template_directory() . '/backend/custom-posts.php';
// -> Set TGM required plugins
require get_template_directory() . '/backend/tgm.php';

// Initialize Wideo TPL options
// ***********************************************************

function wideo_tpl_initialize() {
  return array(
    'contacts_email' => array(
      'label' => 'Indirizzo email di contatto'
    )
  );
}
