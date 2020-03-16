<?php

/**
 * FUNZIONE PER RECUPERO ICONE SVG.
 * Mettere le icone svg in /partials/icons.
 * Richiamare le icone con <php icon('nome-icona'); ?>
 */

function icon ($name = '') {
  if ($name) {
    include(locate_template("partials/icons/$name.svg"));
  }
}
