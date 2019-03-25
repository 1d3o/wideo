<?php

/**
 * This files contains some functions used to personalize the frontend of the theme.
 */

// Load scripts on theme.
// ***********************************************************

function wideo_enqueue_scripts() {
  $template_directory = get_template_directory_uri();
  wp_deregister_script('jquery' ); // Remove this if you have problem on front-end without Jquery.
  
  wp_enqueue_style('theme-css', $template_directory.'/css/theme.css');
  wp_enqueue_script('theme-js', $template_directory. '/js/main.js', '', '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wideo_enqueue_scripts');

// Clean Wordpress meta tag (active them for a blog).
// ***********************************************************

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3 ); // display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2 ); // display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link' ); // display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link' ); // display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0 ); // display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'index_rel_link' ); // index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0 ); // start link
add_filter('the_generator', '__return_false'); // remove the WordPress version from RSS feeds
add_theme_support('automatic-feed-links' );


/* Rimuove la versione dai file CSS e JS */
function remove_cssjs_ver( $src ) {
  if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );
// Update Body classes.
// ***********************************************************

function wideo_change_body_class($classes) {
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }
  // remove unnecessary classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
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
    'c-navbar__item',
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
  $classes[] = 'c-navbar__item';
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