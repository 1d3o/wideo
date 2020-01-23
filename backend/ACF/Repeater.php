<?php

function init($args)
{
    $defaults = [
        'button_label' => '',
        'label' => '',
        'prefix' => 'ss_acf',
        'min' => '',
        'max' => '',
        'conditions' => ''
    ];

    $settings = array_merge($defaults, $args['settings']);

    return [
        'key' => generateUniquePrefix($settings['prefix'], $settings['label']) . 'field_repeater',
        'label' => $settings['label'],
        'name' => generateName($settings['label']),
        'type' => 'repeater',
        'sub_fields' => $args['elements'],
        'button_label' => $settings['button_label'],
        'min' => $settings['min'],
        'max' => $settings['max'],
        'layout' => 'block',
        'collapsed' => 'true',
        'conditions' => $settings['conditions']
    ];
}

