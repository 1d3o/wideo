<?php

if ( have_rows('editor', $args['post_id']) ) {
  while ( have_rows('editor', $args['post_id']) ) {
    the_row();

    if(get_row_layout() == 'hero') {
      component('hero', array(
        'titolo' => get_sub_field('titolo'),
        'sottotitolo' => get_sub_field('sottotitolo'),
        'cta_label' => get_sub_field('cta_label'),
        'cta_url' => get_sub_field('cta_url'),
      ));
    }

    if(get_row_layout() == 'hero-page') {
      $home_ID = get_option('page_on_front');

      $breadcrumbs = [
        array(
          'label' => get_the_title($home_ID),
          'url' => get_permalink($home_ID)
        )
      ];

      $parent = get_post_parent($args['post_id']);
      while ($parent) {
        $breadcrumbs[] = array(
          'label' => get_the_title($parent),
          'url' => get_permalink($parent)
        );
        $parent = get_post_parent($parent);
      }

      $breadcrumbs[] = array(
        'label' => get_the_title($args['post_id']),
        'url' => get_permalink($args['post_id'])
      );

      component('hero-page', array(
        'titolo' => get_sub_field('titolo'),
        'sottotitolo' => get_sub_field('sottotitolo'),
        'immagine' => get_sub_field('immagine'),
        'breadcrumbs' => $breadcrumbs
      ));
    }

    if(get_row_layout() == 'sub-hero') {
      component('sub-hero', array(
        'titolo' => get_sub_field('titolo'),
        'sottotitolo' => get_sub_field('sottotitolo'),
        'contenuto' => get_sub_field('contenuto'),
        'cta_primary_label' => get_sub_field('cta_primary_label'),
        'cta_primary_url' => get_sub_field('cta_primary_url'),
        'cta_secondary_label' => get_sub_field('cta_secondary_label'),
        'cta_secondary_url' => get_sub_field('cta_secondary_url'),
        'cta_download' => get_sub_field('cta_download'),
        'azioni' => get_sub_field('azioni'),
        'immagine_sfondo' => get_sub_field('immagine_sfondo'),
      ));
    }

    if(get_row_layout() == 'sub-hero-video') {
      component('sub-hero-video', array(
        'titolo' => get_sub_field('titolo'),
        'sottotitolo' => get_sub_field('sottotitolo'),
        'contenuto' => get_sub_field('contenuto'),
        'preview' => get_sub_field('preview'),
        'youtube_video_id' => get_sub_field('youtube_video_id')
      ));
    }

    if(get_row_layout() == 'sub-hero-accordions') {
      component('sub-hero-accordions', array(
        'titolo' => get_sub_field('titolo'),
        'sottotitolo' => get_sub_field('sottotitolo'),
        'contenuto' => get_sub_field('contenuto'),
        'accordion' => get_sub_field('accordion')
      ));
    }

    if(get_row_layout() == 'text-image') {
      component('text-image', array(
        'titolo' => get_sub_field('titolo'),
        'contenuto' => get_sub_field('contenuto'),
        'cta_label' => get_sub_field('cta_label'),
        'cta_url' => get_sub_field('cta_url'),
        'allineamento' => get_sub_field('allineamento'),
        'immagine' => get_sub_field('immagine'),
        'calendario' => get_sub_field('calendario')
      ));
    }

    if(get_row_layout() == 'slider-products') {
      component('slider-products', array(
        'titolo' => get_sub_field('titolo'),
        'contenuto' => get_sub_field('contenuto'),
        'cta_label' => get_sub_field('cta_label'),
        'cta_url' => get_sub_field('cta_url'),
        'prodotti' => get_sub_field('prodotti')
      ));
    }

    if(get_row_layout() == 'brands') {
      component('brands', array(
        'titolo' => get_sub_field('titolo'),
        'brand' => get_sub_field('brand')
      ));
    }

    if(get_row_layout() == 'video') {
      component('video', array(
        'preview' => get_sub_field('preview'),
        'youtube_video_id' => get_sub_field('youtube_video_id')
      ));
    }

    if(get_row_layout() == 'content') {
      component('content', array(
        'contenuto' => get_sub_field('contenuto')
      ));
    }

    if(get_row_layout() == 'gallery') {
      component('gallery', array(
        'immagini' => get_sub_field('immagini')
      ));
    }
  }
}
