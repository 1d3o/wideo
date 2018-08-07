<?php

// Function used to send a new email.
function wideo_mailer_send ($to, $subject, $message) {
  if (function_exists('wideo_logger_create_log')) {
    wideo_logger_create_log('wideo_mailer_message', implode(' - ', array(
      $to,
      $subject,
      $message
    )));
  }

  return wp_mail($to, $subject, $message);
}

// Log mail error on wideo logger if it exists.
function log_mailer_errors ($error) {
  if (function_exists('wideo_logger_create_log')) {
    wideo_logger_create_log('wideo_mailer_error', $error->get_error_message());
  }
}
add_action('wp_mail_failed', 'log_mailer_errors');
