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

/**
 * @function honeyPotCaptcha
 * Add a hidden input with name "human" to check if a form request
 * is coming from a robot or not. The "human" value should be empty
 */
function honeyPotCaptcha ($classes) {
  echo '<input class="'.$classes.'" name="human" value="" style="clip: rect(1px, 1px, 1px, 1px); height: 1px; overflow: hidden; position: absolute; width: 1px;" />';
}
