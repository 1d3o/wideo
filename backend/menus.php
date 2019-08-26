<?php

// Register menus.
// ***********************************************************

if (function_exists('register_nav_menus')) {
  register_nav_menus(
    array(
      'main-menu' => 'Main Menu',
      // NOTE: Add here other dynamic menus
    )
  );
}

// Helpers used to render menu.
// ***********************************************************

function wideo_main_menu() {
  wp_nav_menu (
    array (
      'theme_location' => 'main-menu',
      'menu_class' => 'c-nav__main-menu',
      'menu_id' => 'main-menu',
    )
  );
}

// NOTE: Add here other menu helpers. 
