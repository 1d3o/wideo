<?php

add_action('wp_ajax_nopriv_custom_ajax_mailer', 'custom_ajax_mailer');
add_action('wp_ajax_custom_ajax_mailer', 'custom_ajax_mailer');

function custom_ajax_mailer(){
  // Settings
  // -------------------------------------------------------------------------

  if (function_exists('custom_mailer_initialize') && isset($_POST['_form'])) {
    $settings_array = custom_mailer_initialize();
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
    $PARAMS_ATTACHMENTS = isset($settings['params_attachments']) ? $settings['params_attachments'] : false;
    $LOG = isset($settings['log']) ? $settings['log'] : false;
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
  $message = '';
  foreach ($PARAMS as $parameter) {
    if($parameter != 'honey'){
      $value = isset($_POST[$parameter]) ? $_POST[$parameter] : '';
      $message .= $value ? "$parameter: $value \n\n" : '';
    }
  }

  $honeypot = $_POST['honey'];
  if(! empty( $honeypot )){
    return;
    die();
  }

  // Prepare files data
  if($PARAMS_ATTACHMENTS[0]) {
    $files = [];
    $index = 0;

    foreach($PARAMS_ATTACHMENTS as $key => $filename){
      // load files from input file multiple (require name with "[]")
      if(is_array($_FILES[$filename]['name'])){
        foreach($_FILES[$filename]['name'] as $i => $name){
          if($_FILES[$filename]['error'][$i] == 0){
            $file = array(
              'name' => $name,
              'type' => $_FILES[$filename]['type'][$i],
              'tmp_name' => $_FILES[$filename]['tmp_name'][$i],
              'error' => $_FILES[$filename]['error'][$i],
              'size' => $_FILES[$filename]['size'][$i]
            );
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload( $file, $upload_overrides);
            $files[$index] = $movefile['file'];
            $index++;
          }
        }
      // load single file
      } else {
        if($_FILES[$filename]['error'] == 0){
          $uploadedfile = $_FILES[$filename];
          $upload_overrides = array('test_form' => false);
          $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
          $files[$index] = $movefile['file'];
          $index++;
        }
      }
    }

    if(is_null($files[0])) {
      $req = wp_mail($MAILTO, $MAILSUBJECT, $message);  
    } else {
      $req = wp_mail($MAILTO, $MAILSUBJECT, $message, '', $files);

      foreach($files as $file){
        unlink($file);
      }
    }
  } else {
    $req = wp_mail($MAILTO, $MAILSUBJECT, $message);
  }

  echo json_encode(array(
    'result' => !!$req
  ));

  die();
}