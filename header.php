<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php bloginfo('name'); ?> - <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

<!-- Name of web application (only should be used if the website is used as an app) -->
<meta name="application-name" content="<?php bloginfo('name'); ?>">

<!-- Theme Color for Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#ffffff">

<!-- Short description of the document (limit to 150 characters) -->
<meta name="description" content="<?php bloginfo('description'); ?>">

<!-- Control the behavior of search engine crawling and indexing -->
<meta name="robots" content="index,follow"><!-- All Search Engines -->
<meta name="googlebot" content="index,follow"><!-- Google Specific -->

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php echo get_site_url(); ?>">
<meta name="twitter:title" content="<?php bloginfo('name'); ?>">
<meta name="twitter:description" content="<?php bloginfo('description'); ?>">

<!-- Open Graph data -->
<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo get_site_url(); ?>" />
<meta property="og:description" content="<?php bloginfo('description'); ?>" />

<!-- Favicon and extra -->
<!--
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/public/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/public/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/public/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/public/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/public/favicon-16x16.png">
-->

<!-- PWA -->
<!--
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/public/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/public/ms-icon-144x144.png">
<meta name="msapplication-navbutton-color" content="#ffffff">
<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/public/browserconfig.xml">
<meta name="msapplication-tooltip" content="<?php bloginfo('description'); ?>">
<meta name="msapplication-tap-highlight" content="no">
<meta name="msapplication-starturl" content="/">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="full-screen" content="yes">
<meta name="browsermode" content="application">
<meta name="screen-orientation" content="portrait">
-->

<!-- Application helpers -->
<meta name="wideo_template_uri" content="<?php echo get_template_directory_uri(); ?>">

<?php partial('head-scripts'); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

  <?php partial('nav'); ?>
