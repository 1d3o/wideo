<?php

$contact_module = get_field('contact_module', $args['post_id']);

if ($contact_module == 'small') {
  component('contact-small', array(
    'titolo' => get_field('cm_small_titolo', 'options'),
    'sottotitolo' => get_field('cm_small_sottotitolo', 'options'),
    'cta_label' => get_field('cm_small_cta_label', 'options'),
    'cta_url' => get_field('cm_small_cta_url', 'options'),
  ));
}

if ($contact_module == 'info') {
  component('contact-info', array(
    'titolo' => get_field('cm_info_titolo', 'options'),
    'contenuto' => get_field('cm_info_contenuto', 'options'),
  ));
}

if ($contact_module == 'candidature') {
  component('contact-candidature', array(
    'titolo' => get_field('cm_candidature_titolo', 'options'),
    'contenuto' => get_field('cm_candidature_contenuto', 'options'),
  ));
}

if ($contact_module == 'general') {
  component('contact-general', array(
    'locations' => get_field('locations', 'options'),
    'telefono' => get_field('c_phone', 'options'),
    'facebook' => get_field('c_facebook', 'options'),
    'youtube' => get_field('c_youtube', 'options'),
    'linkedin' => get_field('c_linkedin', 'options'),
  ));
}
