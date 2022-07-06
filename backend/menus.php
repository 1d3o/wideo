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
      'footer-menu' => 'Footer Menu',
    )
  );
}
