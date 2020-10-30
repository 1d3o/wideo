<?php

/**
 * GESTIONE TAG PICTURE.
 * Funzione per la visualizzazione di immagini.
 * Opzioni:
 * - src {string|array} -> url immagine / array
 * - mime {string} -> mime type dell'immagine,
 *   su contenuto dinamico è facilmente ottenibile
 *   con dall'array immagine: $image['subtype']
 * - alt {string} -> attributo 'alt' immagine, da mettere SEMPRE
 * - title {string} -> attributo 'title' immagine, facoltativo
 * - class {string} -> classi css da aggiungere al tag picture
 * - webp {bool} -> se TRUE aggiunge anche i file .webp
 *   alle source, consigliato mettere FALSE sui $defaults
 *   in fase di sviluppo. Per immagini statiche specificarlo
 *   solo se l'immagine non è jpg/jpeg
 *   NB: i nomi dei file webp sono composti dal nome del
 *   file originale aggiungendo .webp alla fine (da impostare
 *   sulle opzioni di Optimus)
 *   ES.: 'path/immagine.jpg.webp'
 * - lazy {bool} -> se TRUE le source avranno daat-srcset invece
 *   di srcset, l'img data-src invece di src
 *   NB: per un corretto funzionamento del modulo js di lazy load
 *   mettere la picture in un contenitore a cui verrà messo l'attributo
 *   data-lazy
 * 
 * Esempio:
 * picture(array(
 *   'src' => array(
 *     '400' => 'http://domain.com/image-500x500.png', // fino ai 400px usa questa
 *     '1280' => 'http://domain.com/image-1440x1440.png', // fino ai 1280px usa questa
 *     'other' => 'http://domain.com/image.png' // oltre i 1280px usa questa
 *   ),
 *   'mime' => 'png',
 *   'alt' => 'Descrizione immagine',
 *   'title' => 'Titolo immagine',
 *   'class' => 'section__image',
 * ));
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

/**
 * GENERAZIONE PADDING PER LAZY LOAD
 * Genera del padding-bottom in % sull'elemento contenitore della
 * picture con altezza automatica per dare lo spazio al placeholder
 * al fine di essere visualizzato correttamente
 * Parametri:
 * - w {number} -> larghezza immagine originale
 * - h {number} -> altezza immagine originale
 * - echo {bool} -> se TRUE (default) esegue un echo dello style,
 *   altrimenti ritorna il valore numerico in % del padding-bottom,
 *   utile per unire lo style con altre proprietà css
 * 
 * Esempio:
 * picture_padding(1920, 1080); // immagine statica
 * picture_padding($image['width'], $image['height']); // array immagine dinamica
 */
function picture_padding ($w, $h, $echo = TRUE) {
  $p = number_format(100 / ($w / $h), 2);
  if ($echo) {
    echo "style='padding-bottom:$p%;'";
  } else {
    return $p;
  }
}

function picture_src($image) {
  if (is_array($image)) { // NOTE: Si considera array di acf
    return array(
      '150' => $image['sizes']['thumbnail'],
      '560' => $image['sizes']['medium'],
      '1920' => $image['sizes']['large'],
      'other' => $image['url']
    );
  } else {
    return $image;
  }
}

function picture_mime($image) {
  if (is_array($image)) { // NOTE: Si considera array di acf
    return $image['mime_type'];
  } else {
    return 'jpeg';
  }
}

function picture_alt($image) {
  global $SITENAME;
  if (is_array($image)) { // NOTE: Si considera array di acf
    return $image['alt'];
  } else {
    return get_bloginfo('name');
  }
}

?>