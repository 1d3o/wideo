<?php

/**
 * GESTIONE TAG IMMAGINI.
 * Funzione per la visualizzazione di immagini.
 * Opzioni:
 * - src {string/array} -> url immagine / array
 * 
 * Esempio:
 * picture(array(
 *    'src' => array(
 *        '200' => 'http://domain.com/image-150-150px.jpg'
 *        'other' => 'http://domain.com/image-full.jpg'
 *    )
 * ))
 */

function picture ($options = array(), $echo = TRUE) {
  $defaults = array(
    'src' => '',
    'mime' => 'jpeg',
    'class' => '',
    'alt' => '',
    'title' => '',
    'webp' => TRUE,
    'lazy' => FALSE
  );
  extract(array_merge($defaults, $options));
  $prefix = $lazy ? 'data-' : '';
  $src_type = gettype($src);
  $original = $src_type === 'array' ? $src['other'] : $src;

  $html = "<picture class=\"$class\">";
  $modern = '';
  $legacy = '';
  if ($src_type === 'array') {
    foreach ($src as $media => $s) {
      if ($media !== 'other') {
        if ($webp) $modern .= "<source {$prefix}srcset=\"$s.webp\" type=\"image/webp\" media=\"(max-width:{$media}px)\">";
        $legacy .= "<source {$prefix}srcset=\"$s\" type=\"image/$mime\" media=\"(max-width:{$media}px)\">";
      } else {
        if ($webp) $modern .= "<source {$prefix}srcset=\"$s.webp\" type=\"image/webp\">";
        $legacy .= "<source {$prefix}srcset=\"$s\" type=\"image/$mime\">";
      }
    }
  } else {
    if ($webp) $modern .= "<source {$prefix}srcset=\"$src.webp\" type=\"image/webp\">";
    $legacy .= "<source {$prefix}srcset=\"$src\" type=\"image/$mime\">";
  }
  $html .= $modern . $legacy . "<img {$prefix}src=\"$original\" alt=\"$alt\" title=\"$title\"></picture>";
  if ($echo) {
    echo $html;
  } else {
    return $html;
  }
}

?>