<?php

/**
 * This files contains some functions used to initialize custom post types and custom taxonomies.
 */

// Custom post type.
// ***********************************************************

// function wideo_create_project_type() {
//   register_post_type( 'project',
//     array(
//       'labels' => array(
//           'name' => __( 'Progetti' ),
//           'singular_name' => __( 'Progetto' )
//       ),
//       'rewrite' => array(
//         'slug' => 'projects'
//       ),
//       'supports' => array('title'),
//       'public' => true,
//       'has_archive' => true,
//       'show_in_rest' => true,
//       'capability_type' => array('cpt', 'cpts')
//     )
//   );
// }
// add_action( 'init', 'wideo_create_project_type');

// Taxonomy.
// ***********************************************************

// function wideo_create_project_category_taxonomy() {
//   register_taxonomy('project-category', array('project'), array(
//     'labels' => array(
//       'name' => __( 'Categorie' ),
//       'singular_name' => __( 'Categoria' )
//     ),
//     'rewrite' => array(
//       'slug' => 'product-category'
//     ),
//     'hierarchical' => true,
//     'public' => true,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'show_tagcloud' => false
//   ));
// }
// add_action( 'init', 'wideo_create_project_category_taxonomy');