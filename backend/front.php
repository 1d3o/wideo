<?php

/**
 * IMPOSTAZIONI FRONT-END.
 * Gestisce tutte le impostazioni che vanno a modificare il front-end del sito.
 */

// Remove script and styles
// ***********************************************************

function wideo_deregister_scripts(){
  if ( !is_admin() ) {
    wp_deregister_script('jquery');
  }
   
}
function wideo_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}

function disable_embed(){
  wp_dequeue_script( 'wp-embed' );
}
  
add_action( 'wp_footer', 'disable_embed' );

add_action( 'wp_enqueue_scripts', 'wideo_deregister_scripts' );
add_action( 'wp_print_styles', 'wideo_deregister_styles', 100 );
add_theme_support( 'title-tag' );


// Load scripts on theme.
// ***********************************************************
function remove_cssjs_ver( $src ) {
  if( strpos( $src, '?ver=' ) )
   $src = remove_query_arg( 'ver', $src );
  return $src;
}

function wideo_enqueue_scripts() {
  $template_directory = get_template_directory_uri();
    // include custom jQuery
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('application', $template_directory. '/assets/application.js', '', '1.0.0', true);
    wp_enqueue_style('application', $template_directory.'/assets/application.css');

    // COMPILE_CODE_HERE: aggiungere eventuali script da richiamare sul front o su specifiche pagine
}

add_action('wp_enqueue_scripts', 'wideo_enqueue_scripts');

// Clean Wordpress meta tag (active them for a blog).
// ***********************************************************

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3); // display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'index_rel_link'); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'rest_output_link_wp_head' );
remove_action('wp_head', 'wp_oembed_add_discovery_links' );
remove_action('template_redirect', 'rest_output_link_header', 11 );

add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter('xmlrpc_enabled', '__return_false');

// Disable support to emoji.
// ***********************************************************

function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
 
  return $urls;
}

// Update Body classes.
// ***********************************************************

function wideo_change_body_class($classes) {
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }
  // remove unnecessary classes
  $home_id_class = 'page-id-'.get_option('page_on_front');
  $remove_classes = array(
    'page-template-default',
    $home_id_class
  );
  $classes = array_diff($classes, $remove_classes);
  return $classes;
}
add_filter('body_class', 'wideo_change_body_class');

// Remove auto-closing tags from components.
// ***********************************************************

function wideo_remove_autoclosing_tags($input) {
  return str_replace(' />', '>', $input);
}
add_filter('get_avatar', 'wideo_remove_autoclosing_tags'); // <img />
add_filter('comment_id_fields', 'wideo_remove_autoclosing_tags'); // <input />
add_filter('post_thumbnail_html', 'wideo_remove_autoclosing_tags'); // <img />

// Clean menus classes.
// ***********************************************************

function wideo_clean_menus_classes($var) {
  // remove all classes except the array list
  return is_array($var) ? array_intersect($var, array( 
    'nav__item',
    'current_page_item',
    'current_page_parent',
    'current_page_ancestor',
    'current-menu-item'
  )) : '';
}
add_filter('nav_menu_css_class', 'wideo_clean_menus_classes');
add_filter('nav_menu_item_id', 'wideo_clean_menus_classes'); 
add_filter('page_css_class', 'wideo_clean_menus_classes');

// Add custom menus classes.
// **********************************************************************

function wideo_add_custom_menus_classes($classes, $item, $args) {
  $classes[] = 'nav__item';
  return $classes;
}
add_filter('nav_menu_css_class','wideo_add_custom_menus_classes', 1, 3);

// Remove classes from the post thumbnail.
// ***********************************************************

function wideo_remove_classes_from_thumbnails($output) {
  $output = preg_replace('/class=".*?"/', '', $output);
  return $output;
}
add_filter('post_thumbnail_html', 'wideo_remove_classes_from_thumbnails');

// Disable Self Pingback
// ***********************************************************

function disable_pingback( &$links ) {
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, get_option( 'home' ) ) )
  unset($links[$l]);
 }
 add_action( 'pre_ping', 'disable_pingback' );
 
 function wpdocs_dequeue_dashicon() {
  if (current_user_can( 'update_core' )) {
      return;
  }
  wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );
