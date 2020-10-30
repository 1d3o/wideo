<?php

/**
 * IMPOSTAZIONE VARIABILI GLOBALI DISPONIBILI SU TUTTI I FILE DEL SITO.
 */

global $globals;

$globals = array(
  'site_url' => get_site_url(),
  'template_url' => get_template_directory_uri()
);


extract($globals);
