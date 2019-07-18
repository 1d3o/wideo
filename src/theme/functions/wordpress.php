<?php

/**
 * This files contains some functions used to set most important configurations of Wordpress.
 */

// Hide admin bar on site view.
// ***********************************************************

show_admin_bar(false);

// Add thumbnail to posts with custom sizes.
// ***********************************************************

add_theme_support('post-thumbnails');

// add_image_size( 'image-full', 1920, 1080, true );
// add_image_size( 'image-medium', 660, 660, true );
// add_image_size( 'image-small', 110, 110, true );

// Add excerpt to posts.
// ***********************************************************

add_post_type_support('page', 'excerpt');

// function wp_ideo_custom_excerpt_length() {
//   return 80;
// }
// add_filter('excerpt_length','wp_ideo_custom_excerpt_length');

// Disable support for emoji.
// ************************************************************

remove_action('wp_head', 'print_emoji_detection_script', 7); 
remove_action('wp_print_styles', 'print_emoji_styles');


// Disactive wp updates.
// ***********************************************************

define('WP_AUTO_UPDATE_CORE', 'minor' );
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

<<<<<<< HEAD
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
=======
>>>>>>> e2173514e21b4cb03391e88d3aaaa4e66c454d8a
// Enable / disable edit theme options.
// ***********************************************************

define('DISALLOW_FILE_EDIT', true);


// disable for posts and pages
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);