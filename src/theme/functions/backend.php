<?php

/**
 * This files contains some functions used to personalize the backend of the theme.
 */

// Remove dashboard widgets.
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
add_action('wp_dashboard_setup', 'wideo_remove_dashboard_widgets' );

// Add custom dashboard widgets.
// ***********************************************************

function wideo_set_dashboard_widgets() {
  add_meta_box( 'welcome_widget', 'Benvenuto', 'wideo_widget_theme_welcome', 'dashboard', 'normal', 'high' );
}
function wideo_widget_theme_welcome() {
  echo '<p>Benvenuto nel pannello di amministrazione del tuo sito web.<br>Utilizza il menu laterale per gestire autonomamente i contenuti.</p>';
}
add_action('wp_dashboard_setup', 'wideo_set_dashboard_widgets');

// Add custom footer text.
// ***********************************************************

function wideo_add_footer_text () { 
  echo 'Powered by <a href="http://www.ideonetwork.it" target="_blank">ídeo</a>'; 
} 
add_filter('admin_footer_text', 'wideo_add_footer_text');

// Load custom CSS on admin area.
// ***********************************************************

function wideo_load_custom_css_admin() {
  echo '<link rel=\'stylesheet\' id=\'ideologin\' href=\''.get_template_directory_uri().'/css/backend.css\' type=\'text/css\' media=\'all\' /> ';
}
add_action('admin_head', 'wideo_load_custom_css_admin');

// Load custom CSS on login area.
// ***********************************************************

function wideo_load_custom_css_login() {
  echo '<link rel=\'stylesheet\' id=\'ideologin\' href=\''.get_template_directory_uri().'/css/backend.css\' type=\'text/css\' media=\'all\' /> ';
}
add_action('login_head', 'wideo_load_custom_css_login');

// Set custom logo on login page.
// NOTE: Consider to set others CSS rules on the css for
// the backend and not here.
// ***********************************************************

// function wideo_custom_login_logo() {
//   echo '<style type="text/css">#login h1 a, .login h1 a { background-image: url('.(get_stylesheet_directory_uri()."/logo.png").'); }</style>';
// }
// add_action( 'login_enqueue_scripts', 'wideo_custom_login_logo' );

// Remove Wordpress logo on menu.
// ***********************************************************

function wideo_hide_bar_logo( $wp_admin_bar ) {
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'admin_bar_menu', 'wideo_hide_bar_logo', 11);

// Remove page attributes block on single page view for not admin
// users.
// ***********************************************************

function wideo_remove_page_attribute_meta_box() {
  if( is_admin() ) {
    if(current_user_can('client')) {
      remove_meta_box('pageparentdiv', 'page', 'normal');
    }
  }
}
add_action( 'admin_menu', 'wideo_remove_page_attribute_meta_box' );

// Set default bankend admin colors for users.
// ***********************************************************

function wideo_set_default_admin_color($user_id) {
  $args = array(
      'ID' => $user_id,
      'admin_color' => 'default'
  );
  wp_update_user( $args );
}
add_action('user_register', 'wideo_set_default_admin_color');

// Force users to go to dashboard after login.
// ***********************************************************

function wideo_my_login_redirect($redirect_to, $request) {
  $redirect_url = home_url() . '/wp-admin/index.php';
  return $redirect_url;
}
add_filter("login_redirect", "wideo_my_login_redirect", 10, 3);

// Remove help button on pages.
// ***********************************************************

function wideo_remove_help_button($old_help, $screen_id, $screen) {
  $screen->remove_help_tabs();
  return $old_help;
}
add_filter('contextual_help', 'wideo_remove_help_button', 999, 3);

// Edit Wordpress default users roles.
// ***********************************************************

// NOTE: Use this helper to permits admin to have access to the CPT if
// it has a custom capabilities.
function wideo_add_complete_access_to_admin_to_cpt($singular, $plural) {
  $admins = get_role('administrator');

  $admins->add_cap('read_'.$singular);
  $admins->add_cap('edit_'.$singular);
  $admins->add_cap('delete_'.$singular);
  $admins->add_cap('read_private_'.$plural); 
  $admins->add_cap('publish_'.$plural); 
  $admins->add_cap('edit_'.$plural); 
  $admins->add_cap('edit_others_'.$plural); 
  $admins->add_cap('edit_published_'.$plural);
  $admins->add_cap('edit_private_'.$plural); 
  $admins->add_cap('delete_'.$plural); 
  $admins->add_cap('delete_others_'.$plural); 
  $admins->add_cap('delete_published_'.$plural);
  $admins->add_cap('delete_private_'.$plural); 
}

function wideo_edit_built_in_roles() {
  global $wp_roles;
  $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');

  foreach ($roles_to_remove as $role) {
    if (isset($wp_roles->roles[$role])) {
      $wp_roles->remove_role($role);
    }
  }

  $wp_roles->add_role(
    'client',
    'Gestore',
    array(
      // general
      'manage_options' => false,
      'read' => true,
      'upload_files' => true,

      // pages
      'read_page' => true,
      'edit_page'	=> true,
      'delete_page'	=> false,
      'read_private_pages' => false,
      'publish_pages'	=> false,
      'edit_pages' => true,
      'edit_others_pages'	=> true,
      'edit_published_pages' => true,
      'edit_private_pages' => false,
      'delete_pages' => false,
      'delete_others_pages'	=> false,
      'delete_published_pages'	=> false,
      'delete_private_pages'	=> false,

      // posts
      'read_post' => false,
      'edit_post'	=> false,
      'delete_post'	=> false,
      'read_private_posts' => false,
      'publish_posts'	=> false,
      'edit_posts' => false,
      'edit_others_posts'	=> false,
      'edit_published_posts' => false,
      'edit_private_posts' => false,
      'delete_posts' => false,
      'delete_others_posts'	=> false,
      'delete_published_posts'	=> false,
      'delete_private_posts'	=> false,

      // cpts
      'read_cpt' => true,
      'edit_cpt'	=> true,
      'delete_cpt'	=> true,
      'read_private_cpts' => true,
      'publish_cpts'	=> true,
      'edit_cpts' => true,
      'edit_others_cpts'	=> true,
      'edit_published_cpts' => true,
      'edit_private_cpts' => true,
      'delete_cpts' => true,
      'delete_others_cpts'	=> true,
      'delete_published_cpts'	=> true,
      'delete_private_cpts'	=> true,
    )
  );

  wideo_add_complete_access_to_admin_to_cpt('cpt', 'cpts');
}
add_action('admin_menu', 'wideo_edit_built_in_roles');
 
