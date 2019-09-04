<?php

// Import wordpress.
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
require_once(ABSPATH . 'wp-admin/includes/file.php');

// Settings
// -------------------------------------------------------------------------

if (function_exists('wideo_mailer_initialize') && isset($_POST['_form'])) {
  $settings_array = wideo_mailer_initialize();
  if (!isset($settings_array[$_POST['_form']])) {
    echo json_encode(array(
      'result' => false,
      'error' => 'Form type not valid.',
      'error_code' => '_form'
    ));
    return;
  }

  $settings = $settings_array[$_POST['_form']];
  $DEBUG = isset($settings['debug']) ? $settings['debug'] : false;
  $PARAMS = isset($settings['params']) ? $settings['params'] : false;
  $PARAMS_REQUIRED = isset($settings['params_required']) ? $settings['params_required'] : false;
  $MAILTO = isset($settings['mail_to']) ? $settings['mail_to'] : false;
  $MAILSUBJECT = isset($settings['mail_subject']) ? $settings['mail_subject'] : false;
} else {
  echo json_encode(array(
    'result' => false,
    'error' => 'Uncorrect configuration of the wideo mailer plugin.',
    'error_code' => null
  ));
  return;
}

// Code
// -------------------------------------------------------------------------

// Manage debug mode.
if ($DEBUG) {
  echo json_encode(array(
    'params' => $_POST
  ));
  return;
}

// Check required parameters.
foreach ($PARAMS_REQUIRED as $parameter) {
  if (!isset($_POST[$parameter]) || $_POST[$parameter] == '') {
    echo json_encode(array(
      'result' => false,
      'error' => 'The field '.$parameter.' is required.',
      'error_code' => $parameter
    ));
    return;
  }
}

// Prepare email data.
$subject = 'New contact request from website';
$message = '';
foreach ($PARAMS as $parameter) {
  $value = isset($_POST[$parameter]) ? $_POST[$parameter] : '';
  $message .= "$parameter: $value \n\n";
}

// Send email.
wp_mail($MAILTO, $MAILSUBJECT, $message);
echo json_encode(array(
  'result' => true
));
