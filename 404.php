<?php

get_header();

component('hero-page', array(
  'titolo' => 'Page not found'
));

component('content', array(
  'contenuto' => "<p>The page you are looking for doesn't exist. Please check the URL or use the search form.</p>"
));

component('contact-small', array(
  'titolo' => get_field('cm_small_titolo', 'options'),
  'sottotitolo' => get_field('cm_small_sottotitolo', 'options'),
  'cta_label' => get_field('cm_small_cta_label', 'options'),
  'cta_url' => get_field('cm_small_cta_url', 'options'),
));

get_footer();