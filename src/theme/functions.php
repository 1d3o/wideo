<?php

require_once (__DIR__ . '/plugin/tgm.php');

// Basic wordpress functions.
require_once (__DIR__ . '/functions/wordpress.php');
require_once (__DIR__ . '/functions/frontend.php');
require_once (__DIR__ . '/functions/backend.php');
require_once (__DIR__ . '/functions/navigation.php');
require_once (__DIR__ . '/functions/custom-post-types.php');

// Require plugins using tgm class.
require_once (__DIR__ . '/functions/require-plugins.php');

// Set custom plugins settings.
require_once (__DIR__ . '/functions/plugin-wideo-tpl.php');
require_once (__DIR__ . '/functions/plugin-wideo-logger.php');
require_once (__DIR__ . '/functions/plugin-wideo-mailer.php');
