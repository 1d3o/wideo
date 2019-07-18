<?php

require get_template_directory() . '/plugin/tgm.php';

// Basic wordpress functions.
require get_template_directory() . '/functions/wordpress.php';
require get_template_directory() . '/functions/frontend.php';
require get_template_directory() . '/functions/backend.php';
require get_template_directory() . '/functions/navigation.php';
require get_template_directory() . '/functions/custom-post-types.php';
require get_template_directory() . '/functions/custom-settings-wideo.php';


// Require plugins using tgm class.
require get_template_directory() . '/functions/require-plugins.php';

// Set custom plugins settings.
require get_template_directory() . '/functions/plugin-wideo-tpl.php';
/* require get_template_directory() . '/functions/plugin-wideo-logger.php';
 */
require get_template_directory() . '/functions/plugin-wideo-mailer.php';
