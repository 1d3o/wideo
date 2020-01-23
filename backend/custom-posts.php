<?php
/* FUNZIONI PER CREAZIONI CPT E TAXONOMY */




function registerPostType($name, $singular, $multiple, $slug, $args = [])
{
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
        'menu_icon' => 'dashicons-palmtree',
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
    ];
    $args = array_merge($defaults, $args);

    register_post_type($name, $args);
}

/**
 * @param $name
 * @param $singular
 * @param $multiple
 * @param $slug
 * @param $postTypes
 * @param $args
*/
function registerCustomTaxonomy($name, $singular, $multiple, $slug, $postTypes = [], $args = [])
{
    $defaults = [
        'labels' => [
            'name' => $multiple,
            'singular_name' => $singular,
            'menu_name' => $singular,
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
    ];
    $args = array_merge($defaults, $args);

    register_taxonomy($name, $postTypes, $args);
}

add_action( 'init', 'registerCPT');

function registerCPT() {
    // registerPostType($name, $singular, $multiple, $slug, $args = [])
    // registerCustomTaxonomy($name, $singular, $multiple, $slug, $postTypes = [], $args = [])
    /*    
        ***  ESEMPIO *****

        registerPostType('service', 'Servizio', 'Servizi', 'service');
        registerCustomTaxonomy('category-service', 'Categoria servizio', 'Categorie servizio', 'Categoria servizio', 'service');
    */

}
