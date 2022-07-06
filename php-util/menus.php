<?php

/**
 * FUNZIONI PER STAMPA MENU.
 * Richiamare la funzione con <php mainMenu(); ?>
 */

function mainMenu() {
  wp_nav_menu (
    array (
      'theme_location' => 'main-menu',
      'menu_class' => '',
      'menu_id' => 'main-menu',
      'container' => false
    )
  );
}

function footerMenu() {
  wp_nav_menu (
    array (
      'theme_location' => 'footer-menu',
      'menu_class' => '',
      'menu_id' => 'footer-menu',
      'container' => false
    )
  );
}