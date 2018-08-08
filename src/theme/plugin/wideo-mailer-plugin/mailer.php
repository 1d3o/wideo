<?php

// Function used to send a new email.
function wideo_mailer_send ($to, $subject, $message, $headers = '', $attachment = null) {
  if (function_exists('wideo_logger_create_log')) {
    wideo_logger_create_log('wideo_mailer_message', implode(' - ', array(
      $to,
      $subject,
      $message
    )));
  }

  if ($attachment) {
    $attachments = wp_handle_upload($attachment, array( 'test_form' => false, 'action' => 'hello-world' ))['file'];
  } else {
    $attchments = '';
  }

  return wp_mail($to, $subject, $message, $headers, $attachments);
}

// Log mail error on wideo logger if it exists.
function log_mailer_errors ($error) {
  if (function_exists('wideo_logger_create_log')) {
    wideo_logger_create_log('wideo_mailer_error', $error->get_error_message());
  }
}
add_action('wp_mail_failed', 'log_mailer_errors');
