<?php

/**
 * GESTIONE MENU.
 * Gestisce i diversi menu disponibili in applicazione.
 */

// Register menus.
// ***********************************************************

if (function_exists('register_nav_menus')) {
  register_nav_menus(
    array(
      'main-menu' => 'Main Menu',
      // COMPILE_CODE_HERE: aggiungere qui eventuali nuovi menu con 'chiave-univoca' => 'Titolo'
    )
  );
}
