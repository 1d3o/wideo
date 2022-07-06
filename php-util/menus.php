<?php

/**
 * FUNZIONI PER STAMPA MENU.
 * Richiamare la funzione con <php mainMenu(); ?>
 */

function mainMenu() {
  wp_nav_menu (
    array (
      'theme_location' => 'main-menu',
      'menu_class' => 'nav__main-menu',
      'menu_id' => 'main-menu',
      'container' => false
    )
  );
}
