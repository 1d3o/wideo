<?php

// Hide admin bar on site view.
// ***********************************************************

show_admin_bar( false );

// Add thumbnail to posts with custom sizes.
// ***********************************************************

add_theme_support( 'post-thumbnails' );

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

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Add default image compression
// **********************************************************************

add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

// Disactive wp updates.
// ***********************************************************

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );

// Enable / disable edit theme options.
// ***********************************************************

define( 'DISALLOW_FILE_EDIT', true );
