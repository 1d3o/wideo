<?php

// Configure SMTP mailer.
// ***********************************************************

// function mailer_config (PHPMailer $mailer) {
//   $mailer->IsSMTP();
//   $mailer->Host = "mail.telemar.it"; // your SMTP server
//   $mailer->Port = 25;
//   $mailer->SMTPDebug = 2; // write 0 if you don't want to see client/server communication in page
//   $mailer->CharSet  = "utf-8";
// }
// add_action( 'phpmailer_init', 'mailer_config');


include_once( get_stylesheet_directory() . '/plugin/wideo-mailer-plugin/mailer.php');
