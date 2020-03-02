<?php 

define( 'FUNCTION_ACF', get_stylesheet_directory() . '/backend/ACF/' );

// Include the ACF plugin.
include_once( FUNCTION_ACF . 'BaseFields.php' );
include_once( FUNCTION_ACF . 'Repeater.php' );

$prefix = 'site-settings';

function registerFieldGroup() {

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

add_action('acf/init', 'registerFieldGroup');
