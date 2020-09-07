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
        'page_title' => 'Settaggi',
        'menu_title' => 'Settaggi',
        'menu_slug' => 'site-settings',
        'capability' => 'manage_options',
    ]);
}
add_action('after_setup_theme',  'wideo_setup_acf_options_page');
