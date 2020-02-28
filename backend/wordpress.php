<?php

// Disactive wp updates.
// ***********************************************************

define('WP_AUTO_UPDATE_CORE', 'minor' ); // Permit only security updates
add_filter('auto_update_plugin', '__return_false'); // Disactive auto-update plugins
add_filter('auto_update_theme', '__return_false'); // Disactive auto-update themes

// Enable / disable edit theme options.
// ***********************************************************

define('DISALLOW_FILE_EDIT', true); // Hide theme editor on wordpress admin panel.

// Hide admin bar on site view.
// ***********************************************************

show_admin_bar(false);

// Add excerpt to posts.
// ***********************************************************

add_post_type_support('page', 'excerpt');

// Add thumbnail to posts.
// ***********************************************************

add_theme_support('post-thumbnails');

// Hide admin bar on site view.
// ***********************************************************

show_admin_bar(false);

// Disable gutenberg editor.
// ***********************************************************

// disable for posts and pages
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Dashboard widgets.
// ***********************************************************

function wideo_remove_dashboard_widgets() {
  remove_meta_box('dashboard_recent_drafts','dashboard','side'); //Recent Drafts
  remove_meta_box('dashboard_primary','dashboard','side'); //WordPress.com Blog
  remove_meta_box('dashboard_secondary','dashboard','side'); //Other WordPress News
  remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
  remove_meta_box('dashboard_plugins','dashboard','normal'); //Plugins
  remove_meta_box('dashboard_right_now','dashboard', 'normal'); //Right Now
  remove_meta_box('rg_forms_dashboard','dashboard','normal'); //Gravity Forms
  remove_meta_box('dashboard_recent_comments','dashboard','normal'); //Recent Comments
  remove_meta_box('icl_dashboard_widget','dashboard','normal'); //Multi Language Plugin
  remove_meta_box('dashboard_activity','dashboard', 'normal'); //Activity
  remove_action('welcome_panel','wp_welcome_panel');
}
add_action('wp_dashboard_setup', 'wideo_remove_dashboard_widgets');

function wideo_widget_theme_welcome() {
  echo '<p>Benvenuto nel pannello di amministrazione del tuo sito web.<br>Utilizza il menu laterale per gestire autonomamente i contenuti.</p>';
}
function wideo_set_dashboard_widgets() {
  add_meta_box( 'welcome_widget', 'Benvenuto', 'wideo_widget_theme_welcome', 'dashboard', 'normal', 'high' );
}
add_action('wp_dashboard_setup', 'wideo_set_dashboard_widgets');

// Dashboard footer.
// ***********************************************************

function wideo_add_dashboard_footer_text () { 
  echo 'Powered by <a href="http://www.ideonetwork.it" target="_blank">ídeo</a>'; 
} 
add_filter('admin_footer_text', 'wideo_add_dashboard_footer_text');

// Remove Wordpress logo on dashboard menu.
// ***********************************************************

function wideo_hide_bar_logo( $wp_admin_bar ) {
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action('admin_bar_menu', 'wideo_hide_bar_logo', 11);

/***** Setta le dimensioni delle thumbnail di default *****/
update_option( 'thumbnail_size_w', 150 );
update_option( 'thumbnail_size_h', 150 );

update_option( 'medium_size_w', 560 );
update_option( 'medium_size_h', 400 );

update_option( 'medium_large_size_w', 0 );
update_option( 'medium_large_size_h', 0 );

update_option( 'large_size_w', 1920 );
update_option( 'large_size_h', 1280 );
