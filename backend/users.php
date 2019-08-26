<?php

function wideo_add_complete_access_to_to_cpt($singular, $plural, $role) {
  $admins = get_role($role);

  $admins->add_cap('read_'.$singular);
  $admins->add_cap('edit_'.$singular);
  $admins->add_cap('delete_'.$singular);
  $admins->add_cap('read_private_'.$plural); 
  $admins->add_cap('publish_'.$plural); 
  $admins->add_cap('edit_'.$plural); 
  $admins->add_cap('edit_others_'.$plural); 
  $admins->add_cap('edit_published_'.$plural);
  $admins->add_cap('edit_private_'.$plural); 
  $admins->add_cap('delete_'.$plural); 
  $admins->add_cap('delete_others_'.$plural); 
  $admins->add_cap('delete_published_'.$plural);
  $admins->add_cap('delete_private_'.$plural); 
}

function wideo_edit_built_in_roles() {
  // remove default roles
  global $wp_roles;
  $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');
  foreach ($roles_to_remove as $role) {
    if (isset($wp_roles->roles[$role])) {
      $wp_roles->remove_role($role);
    }
  }

  // add custom client role
  $wp_roles->add_role(
    'client',
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

      // cpts -> basic custom post types
      'read_cpt' => true,
      'edit_cpt'	=> true,
      'delete_cpt'	=> true,
      'read_private_cpts' => true,
      'publish_cpts'	=> true,
      'edit_cpts' => true,
      'edit_others_cpts'	=> true,
      'edit_published_cpts' => true,
      'edit_private_cpts' => true,
      'delete_cpts' => true,
      'delete_others_cpts'	=> true,
      'delete_published_cpts'	=> true,
      'delete_private_cpts'	=> true,
    )
  );

  wideo_add_complete_access_to_to_cpt('cpt', 'cpts', 'administrator');
}
add_action('admin_menu', 'wideo_edit_built_in_roles');
 
