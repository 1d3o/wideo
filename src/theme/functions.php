<?php

include_once (__DIR__ . '/plugin/tgm.php');

// Basic wordpress functions.
include_once (__DIR__ . '/functions/wordpress.php');
include_once (__DIR__ . '/functions/frontend.php');
include_once (__DIR__ . '/functions/backend.php');
include_once (__DIR__ . '/functions/navigation.php');
include_once (__DIR__ . '/functions/custom-post-types.php');

// Require plugins using tgm class.
include_once (__DIR__ . '/functions/require-plugins.php');

// Set custom plugins settings.
include_once (__DIR__ . '/functions/plugin-wideo-tpl.php');
/* include_once (__DIR__ . '/functions/plugin-wideo-logger.php');
 */
include_once (__DIR__ . '/functions/plugin-wideo-mailer.php');
