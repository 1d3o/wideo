<?php

/**
 * GESTIONE UTENZE.
 * Questo file imposta sutte le settings degli utenti con accesso al pannello di admin.
 * Di principio vengono eliminati tutti i ruoli di default di Wordpress ad eccezione dell'amministratore
 * e viene creato un ruolo "client" da fornire al cliente.
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

  // add custom manager role
  $wp_roles->add_role(
    'manager',
    'Gestore',
    array(
      // general
      'manage_options' => false,
      'read' => true,
      'upload_files' => true,

      // pages
      'read_page' => true,
      'edit_page'	=> true,
      'delete_page'	=> false,
      'read_private_pages' => false,
      'publish_pages'	=> false,
      'edit_pages' => true,
      'edit_others_pages'	=> true,
      'edit_published_pages' => true,
      'edit_private_pages' => false,
      'delete_pages' => false,
      'delete_others_pages'	=> false,
      'delete_published_pages'	=> false,
      'delete_private_pages'	=> false,

      // posts
      'read_post' => false,
      'edit_post'	=> false,
      'delete_post'	=> false,
      'read_private_posts' => false,
      'publish_posts'	=> false,
      'edit_posts' => false,
      'edit_others_posts'	=> false,
      'edit_published_posts' => false,
      'edit_private_posts' => false,
      'delete_posts' => false,
      'delete_others_posts'	=> false,
      'delete_published_posts'	=> false,
      'delete_private_posts'	=> false,

      // users      
      'list_users' => true,
      'remove_users' => true,
      'edit_users' => true,
      'add_users' => true,
      'create_users' => true,
      'delete_users' => true,

      // custom taxonomies
      'manage_terms' => true,
    )
  );
  
  // Esempio applicazione permessi custom su un custom post type.
  // wideo_add_complete_access_to_to_cpt('cpt', 'cpts', 'manager');

  // COMPILE_CODE_HERE: aggiungere eventuali ruoli copiando il codice utilizzato sopra per il ruolo "client"
}

add_action('admin_menu', 'wideo_edit_built_in_roles');
 
