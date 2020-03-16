<?php

/**
 * FUNZIONE PER RECUPERO COMPONENTI DINAMICHE.
 * Mettere le componenti in /partials/components.
 * Richiamare le componenti con <php icon('nome-componente', array('config1' => 'value')); ?>
 */

$components_config = array(
  'hero' => array(
    'title' => '',
    'image' => NULL
  )
);

$common_config = array(
  'class' => '',
  'attributes' => ''
);

function component ($name = '', $args = array()) {
  global $globals, $common_config, $components_config;
  if ($name) {
    extract($globals);
    extract(array_merge($components_config[$name], $common_config, $args));
    include(locate_template("partials/components/_$name.php"));
  }
}
