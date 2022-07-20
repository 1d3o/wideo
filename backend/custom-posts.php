<?php

/**
 * IMPOSTAZIONI CUSTOM POST TYPES.
 * Gestisce tutte le impostazioni che vanno a creare e gestire i custom post type e le tassonomie del sito.
 */

// Funzione per la registrazione di un nuovo CPT
// ***********************************************************

function wideo_register_post_type($name, $singular, $multiple, $slug, $icon, $args = [], $capability = 'cpt') {
  $defaults = [
    'labels' => [
      'name' => $multiple,
      'singular_name' => $singular,
      'add_new' => 'Aggiungi',
      'add_new_item' => 'Aggiungi ' . $singular,
      'edit_item' => 'Modifica ' . $singular,
      'new_item' => 'Nuovo ' . $singular,
      'view_item' => 'Vedi ' . $singular,
      'view_items' => 'Vedi ' . $multiple,
      'search_items' => 'Cerca ' . $multiple,
      'not_found' => $multiple . ' non creati',
      'not_found_in_trash' => 'No ' . $multiple . ' found in Trash',
      'parent_item_colon' => 'Parent ' . $singular . ':',
      'all_items' => 'Tutti ' . $multiple,
      'archives' => $singular . ' Archivio',
      'attributes' => 'Attributi ' . $singular,
      'insert_into_item' => 'Inserisci ' . $singular,
      'uploaded_to_this_item' => 'Uploaded to this ' . $singular,
      'featured_image' => 'Immagine in evidenza',
      'set_featured_image' => 'Imposta immagine',
      'remove_featured_image' => 'Rimuovi immagine',
      'use_featured_image' => 'Usa immagine in evidenza',
      'menu_name' => $multiple,
      'filter_items_list' => 'Filtra ' . $multiple .' list',
      'items_list_navigation' => 'Current' . $singular,
      'items_list' => $multiple . ' list',
      'name_admin_bar' => $singular,
      'item_published' => $singular . ' published',
      'item_published_privately' => $singular . ' published privately',
      'item_reverted_to_draft' => $singular . ' reverted to draft',
      'item_scheduled' => $singular . ' scheduled',
      'item_updated' => $singular . ' updated',
    ],
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => true,
    'hierarchical' => false,
    'menu_position' => 20,
    'menu_icon' => $icon,
    'supports' => [
      'title',
      'editor',
      'author',
      'thumbnail',
      'revisions',
      'page-attributes',
    ],
    'has_archive' => true,
    'rewrite' => [
      'slug' => $slug,
      'with_front' => false,
      'feeds' => false,
      'pages' => true,
    ],
    'capabilities' => array(
      'edit_post'          => 'edit_'.$capability.'', 
      'read_post'          => 'read_'.$capability.'', 
      'delete_post'        => 'delete_'.$capability.'', 
      'edit_posts'         => 'edit_'.$capability.'s', 
      'edit_others_posts'  => 'edit_others_'.$capability.'s', 
      'publish_posts'      => 'publish_'.$capability.'s',       
      'read_private_posts' => 'read_private_'.$capability.'s', 
      'create_posts'       => 'edit_'.$capability.'s'
    ),
  ];
  $args = array_merge($defaults, $args);
  register_post_type($name, $args);
}

// Funzione per la registrazione di una nuova tassonomia
// ***********************************************************

function wideo_register_taxonomy($name, $singular, $multiple, $slug, $postTypes = [], $args = []) {
  $defaults = [
    'labels' => [
      'name' => $multiple,
      'singular_name' => $singular,
      'menu_name' => $multiple,
      'all_items' => 'Tutti i ' . $singular,
      'edit_item' => 'Modifica ' . $singular,
      'view_item' => 'Vedi ' . $singular,
      'update_item' => 'Aggiorna ' . $singular,
      'add_new_item' => 'Aggiungi ' . $singular,
      'new_item_name' => 'Nuovo ' . $singular,
      'parent_item' => 'Parent ' . $singular,
      'parent_item_colon' => 'Parent ' . $singular . ':',
      'search_items' => 'Search ' . $singular,
      'popular_items' => 'Popular ' . $singular,
      'separate_items_with_commas' => 'Separate ' . $singular . ' with commas',
      'add_or_remove_items' => 'Add or remove ' . $singular,
      'choose_from_most_used' => 'Choose from the most used ' . $singular,
      'not_found' => 'No ' . $singular . ' found',
      'back_to_items' => 'Back to ' . $multiple,
    ],
    'show_ui' => true,
    'show_in_rest' => true,
    'hierarchical' => true,
    'rewrite' => [
      'slug' => $slug,
      'with_front' => false,
      'hierarchical' => true,
    ],
    'capabilities' => array(
      'manage_terms'  => 'manage_terms',
      'edit_terms'    => 'manage_terms',
      'delete_terms'  => 'manage_terms',
      'assign_terms'  => 'manage_terms'
    ),
  ];
  $args = array_merge($defaults, $args);
  register_taxonomy($name, $postTypes, $args);
}

// Registrazione post type e tassonomia
// NOTE: Per info icone: https://developer.wordpress.org/resource/dashicons/#image-flip-vertical
// ***********************************************************

function wideo_register_cpt_and_tax() {
  // wideo_register_post_type('service', 'Servizio', 'Servizi', 'service', 'nome-icona');
  // wideo_register_taxonomy('category-service', 'Categoria servizio', 'Categorie servizio', 'categoria-servizio', ['service']);

  // COMPILE_CODE_HERE: aggiungere registrazione di eventuali custom post type
}
add_action( 'init', 'wideo_register_cpt_and_tax');
