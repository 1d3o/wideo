# Plugins

Wideo has some included plugin that can be used for the theme development.

Every plugin is inside the ./src/theme/plugin directory and is required on a functions file inside the ./src/theme/functions directory.

## Wideo logger

The Wideo logger plugin can be used to log informations on a custom data structure on the database.

### Usage

Every log can be created using the <b>wideo_logger_create_log()</b> function. The function require two parameters:

- $type: a string about the log type.
- $content: an array or string with the content of the log.

Example:

```php
wideo_logger_create_log('contact_mail', array(
  'sender' => $sender,
  'subject' => $subject,
  'message' => $message
))
```

## Wideo TPL

The TPL plugin (template) is used to save and manage template options.
It generate an administration view where users can set option values on a list of inputs.

### Usage

The list of options can be configured with a <b>wideo_tpl_initialize()</b> function (it is already declared on the ./src/functions/plugin-wideo-tpl.php file).

The function should return an array with the list of option configurations. The key of each option can be used to get it's value everywhere on the theme using the Wordpress function <b>get_option()</b> (each key should be introduced by the "tpl_" prefix).


Example:

```php
function wideo_tpl_initialize() {
  return array(
    'contacts_email' => array(
      'label' => 'Indirizzo email di contatto',
      'only_admin' => false
    ),
    'contacts_email_support' => array(
      'label' => 'Indirizzo email di supporto',
      'only_admin' => true
    ),
  );
}

echo get_option('tpl_contacts_email');
```

## Wideo mailer

The Wideo mailer plugin can be used to send emails using the Wordpress function <b>wp_mail()</b>. It depends on the Wideo logger plugin wich is used to log every email request (so there is not the risk to lose contacts).

### Usage

Emails can be send using the <b>wideo_mailer_send()</b> function.

Example:

```php
$to = 'dev@ideonetwork.it';
$subject = 'Nice framework';
$message = '...';

wideo_mailer_send($to, $subject, $message);
```

NOTE: The email submit configuration can be set adding a 'phpmailer_init' action (see the commented code on the ./src/theme/functions/plugin-wideo-mailer.php file).
