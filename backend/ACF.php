<?php 
// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_stylesheet_directory() . '/plugins/acf/' );
define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/plugins/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

add_action('after_setup_theme',  'setup_acf_options_page');

function setup_acf_options_page()
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    if (!current_user_can('administrator')) {
        return;
    }

    acf_add_options_page([
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug' => 'site-settings',
        'capability' => 'manage_options',
    ]);
}
