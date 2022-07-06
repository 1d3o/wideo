<?php

get_header();

component('contact-info', array(
  'titolo' => get_field('cm_info_machine_titolo', 'options'),
  'contenuto' => get_field('cm_info_machine_contenuto', 'options'),
));

get_footer();