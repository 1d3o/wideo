<?php 
// Define path and URL to the ACF plugin.


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
