<?php 

/**
 * IMPOSTAZIONI ACF.
 * Questo file imposta tramite ACF la sezione impostazioni sito con campi custom utilizzati in tutto
 * il sito.
 * TODO: Spiegare come aggiungere campi e come utilizzarli sul sito.
 */

define( 'FUNCTION_ACF', get_stylesheet_directory() . '/backend/ACF/' );

// Include the ACF plugin.
include_once( FUNCTION_ACF . 'BaseFields.php' );
include_once( FUNCTION_ACF . 'Repeater.php' );

$prefix = 'site-settings';

// Registro i field disponibili con ACF.
// ***********************************************************

function wideo_register_field_group() {
    global $prefix;
    acf_add_local_field_group([
        'key' => 'group_settings_' . $prefix,
        'title' => 'Site Settings',
        'fields' => [
            addTab($prefix . __FUNCTION__, 'General Settings'),
            wysiwyg($prefix . __FUNCTION__, 'Cookie Popup'),
            addTab($prefix . __FUNCTION__, 'Social Options'),
            init([
                'settings' => [
                    'prefix' => $prefix . __FUNCTION__,
                    'label' => 'Social Options',
                ],
                'elements' => [
                    url($prefix . __FUNCTION__, 'Social link'),
                        select($prefix . __FUNCTION__, 'Social icon', [
                        'facebook' => 'Facebook',
                        'twitter' => 'Twitter',
                        'instagram' => 'Instagram',
                        'youtube' => 'YouTube',
                    ]),
                ],
            ]),
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site-settings',
                ],
            ],
        ],
    ]);
}

add_action('acf/init', 'wideo_register_field_group');

// Imposto la pagina di impostazioni sito.
// ***********************************************************

function wideo_setup_acf_options_page()
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
add_action('after_setup_theme',  'wideo_setup_acf_options_page');
