<?php
function wideo_max_image_size( $file ) {
  $size = $file['size'];
  $size = $size / 1024;
  $type = $file['type'];
  $is_image = strpos( $type, 'image' ) !== false;
  $limit = 600;
  $limit_output = '600kb';
  if ( $is_image && $size > $limit ) {
    $file['error'] = 'Il file è troppo grande, il limite massimo è '. $limit_output.' Ottimizza il file con https://tinypng.com/';
    
  }//end if
  return $file;
}//end wideo_max_image_size()
add_filter( 'wp_handle_upload_prefilter', 'wideo_max_image_size' );
