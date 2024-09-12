<?php

/**
 * GESTIONE UTENZE.
 * Questo file imposta tutte le settings degli utenti con accesso al pannello di admin.
 * Di principio vengono eliminati tutti i ruoli di default di Wordpress ad eccezione dell'amministratore
 * e viene creato un ruolo "gestore" da fornire al cliente.
 */

// Funzione per aggiungere ad un ruolo utente i permessi di accesso ad un custom post type.
// ***********************************************************

function wideo_add_complete_access_to_to_cpt($singular, $plural, $role, $exclude = array()) {
  $users = get_role($role);

  if (!in_array('read_'.$singular, $exclude)) $users->add_cap('read_'.$singular);
  if (!in_array('edit_'.$singular, $exclude)) $users->add_cap('edit_'.$singular);
  if (!in_array('delete_'.$singular, $exclude)) $users->add_cap('delete_'.$singular);
  if (!in_array('read_private_'.$plural, $exclude)) $users->add_cap('read_private_'.$plural); 
  if (!in_array('publish_'.$plural, $exclude)) $users->add_cap('publish_'.$plural); 
  if (!in_array('edit_'.$plural, $exclude)) $users->add_cap('edit_'.$plural); 
  if (!in_array('edit_others_'.$plural, $exclude)) $users->add_cap('edit_others_'.$plural); 
  if (!in_array('edit_published_'.$plural, $exclude)) $users->add_cap('edit_published_'.$plural);
  if (!in_array('edit_private_'.$plural, $exclude)) $users->add_cap('edit_private_'.$plural); 
  if (!in_array('delete_'.$plural, $exclude)) $users->add_cap('delete_'.$plural); 
  if (!in_array('delete_others_'.$plural, $exclude)) $users->add_cap('delete_others_'.$plural); 
  if (!in_array('delete_published_'.$plural, $exclude)) $users->add_cap('delete_published_'.$plural);
  if (!in_array('delete_private_'.$plural, $exclude)) $users->add_cap('delete_private_'.$plural); 
  if (!in_array('manage_terms', $exclude)) $users->add_cap('manage_terms');
}

// Funzione per rimuovere tutti i ruoli "gestore"
function wideo_remove_all_gestore_roles() {
  remove_role('gestore');
  remove_role('manager');
}

// Funzione principale che modifica i ruoli degli utenti
// ***********************************************************

function wideo_edit_built_in_roles() {
  // remove default roles
  global $wp_roles;
  $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
  foreach ($roles_to_remove as $role) {
    if (isset($wp_roles->roles[$role])) {
      $wp_roles->remove_role($role);
    }
  }

  // Rimuovere tutti i ruoli "gestore"
  wideo_remove_all_gestore_roles();

  // add custom manager role
  $wp_roles->add_role(
    'gestore',
    'Gestore',
    array(
      // general
      'manage_options' => false,
      'read' => true,
      'upload_files' => true,
      'manage_site_settings' => true, // Aggiungi questa capacità

      // pages
      'read_page' => true,
      'edit_page' => true,
      'delete_page' => false,
      'read_private_pages' => false,
      'publish_pages' => false,
      'edit_pages' => true,
      'edit_others_pages' => true,
      'edit_published_pages' => true,
      'edit_private_pages' => false,
      'delete_pages' => false,
      'delete_others_pages' => false,
      'delete_published_pages' => false,
      'delete_private_pages' => false,

      // posts
      'read_post' => true,
      'edit_post' => true,
      'delete_post' => true,
      'read_private_posts' => true,
      'publish_posts' => true,
      'edit_posts' => true,
      'edit_others_posts' => true,
      'edit_published_posts' => true,
      'edit_private_posts' => true,
      'delete_posts' => true,
      'delete_others_posts' => true,
      'delete_published_posts' => true,
      'delete_private_posts' => true,

      // users - rimosse tutte le capacità riguardanti gli utenti
      'list_users' => false,
      'remove_users' => false,
      'edit_users' => false,
      'add_users' => false,
      'create_users' => false,
      'delete_users' => false,

      // custom taxonomies
      'manage_terms' => true,
      'edit_terms' => true,
      'delete_terms' => true,
      'assign_terms' => true,
    )
  );
  
  // Applicare permessi custom su custom post type e tassonomie.
  wideo_add_complete_access_to_to_cpt('cpt', 'cpts', 'gestore');

  // Esempio per articoli e tassonomie di notizie (news).
  wideo_add_complete_access_to_to_cpt('news', 'news', 'gestore');
}

add_action('admin_init', 'wideo_edit_built_in_roles');
add_action('switch_theme', 'wideo_edit_built_in_roles');
add_action('after_switch_theme', 'wideo_edit_built_in_roles');

// Rimuovere le capacità di gestione utenti per il ruolo 'gestore' se esistono ancora
function wideo_remove_user_capabilities() {
  $role = get_role('gestore');
  if ($role) {
    $role->remove_cap('list_users');
    $role->remove_cap('remove_users');
    $role->remove_cap('edit_users');
    $role->remove_cap('add_users');
    $role->remove_cap('create_users');
    $role->remove_cap('delete_users');
  }
}

add_action('admin_init', 'wideo_remove_user_capabilities');

// Nascondi menu degli utenti per il ruolo gestore
function wideo_hide_user_menu_for_gestore() {
  if (current_user_can('gestore')) {
    remove_menu_page('users.php');
  }
}

add_action('admin_menu', 'wideo_hide_user_menu_for_gestore', 999);



?>