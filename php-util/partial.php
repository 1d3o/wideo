<?php

/**
 * FUNZIONE PER RICHIAMARE TEMPLATE PARZIALI.
 * Mettere i template in /partials.
 * Richiamare la funzione con <php partial('nome-parziale'); ?>
 */

function partial ($name = '') {
  if ($name) {
    global $globals;
    extract($globals);
    include(locate_template("partials/_$name.php"));
  }
}
