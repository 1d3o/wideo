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

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <div id="page-wrap">
      <div class="c-wrapper">