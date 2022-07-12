<?php

// Requires
// ***********************************************************

// PHP-Util (singole funzioni utili utilizzabili per lo sviluppo)
require get_template_directory() . '/php-util/variables.php';
require get_template_directory() . '/php-util/logJs.php';
require get_template_directory() . '/php-util/partial.php';
require get_template_directory() . '/php-util/icon.php';
require get_template_directory() . '/php-util/picture.php';
require get_template_directory() . '/php-util/components.php';
require get_template_directory() . '/php-util/menus.php';

// Plugins (plugin custom del tema)
require get_template_directory() . '/plugins/tgm.php';

// Backend (configurazione wordpress)
// -> Update wordpress admin panel and options
require get_template_directory() . '/backend/backend.php';
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
// -> Import ACF
require get_template_directory() . '/backend/ACF.php';

// -> clean cache preload wp-rocket on save or update post
require get_template_directory() . '/backend/wp-rocket-auto-clean-cache.php';
// -> limit upload image media gallery
require get_template_directory() . '/backend/custom-limit-media-upload-size.php';
// -> custom duplicate post
require get_template_directory() . '/backend/custom-duplicate-post.php';
// -> custom login
require get_template_directory() . '/backend/custom-login.php';
// -> custom mailer
require get_template_directory() . '/backend/custom-mailer.php';


// Initialize Wideo Mailer options
// ***********************************************************

function custom_mailer_initialize() {
  return array(
    'contacts' => array(
      'debug' => false,
      'params' => ['name', 'surname', 'email', 'phone', 'object', 'message'],
      'params_required' => ['name', 'surname', 'email'],
      'params_attachments' => ['file'],
      'mail_to' => 'test@mail.com',
      'mail_subject' => 'New email from website'
    ),
  );
}
