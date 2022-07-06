<?php

get_header();

component('hero-page', array(
  'titolo' => get_field('archive_product_title', 'options')
));

if ( have_posts() ) {
  /** NOTE: Se riesci usa classi generiche per la griglia dei prodotti (cioe chiamala tipo grid e non grid-product) così se serve in futuro per altri custom post type la ricicliamo. */
  ?>
  <div class="contenitore-lista-prodotti">
  <?php
  while ( have_posts() ) {
    the_post();

    ?>
    <div class="wrapper-singolo-prodotto">
    <?php
      component('card-product', array(
        'titolo' => get_the_title(),
        'categoria' => get_the_terms(get_the_ID(), 'category-product')[0]->name,
        'immagine' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
        'link' => get_the_permalink()
      ));
    ?>
    </div>
    <?php
  }
  ?>
  </div>
  <div class="contenitore-paginazione">
    <?php the_posts_pagination( array( 'mid_size'  => 2 ) ); ?>
  </div>
  <?php
}

component('contact-small', array(
  'titolo' => get_field('cm_small_titolo', 'options'),
  'sottotitolo' => get_field('cm_small_sottotitolo', 'options'),
  'cta_label' => get_field('cm_small_cta_label', 'options'),
  'cta_url' => get_field('cm_small_cta_url', 'options'),
));
   
get_footer();
