<?php

require_once 'config.php';

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

?>