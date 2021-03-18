<?php

$CACHE_PATH = get_theme_file_path('/cache');

/**
 * Esegue la scrittura di una stringa in cache.
 * ESEMPIO: cache_write('chiave_univoca', 'Lorem ipsum dolor sit amet');
 */
function cache_write($key, $data) {
  global $CACHE_PATH;

  if (!file_exists($CACHE_PATH)) {
    mkdir($CACHE_PATH, 0777, true);
  }

  $file = "$CACHE_PATH/$key.cache";
  file_put_contents($file, $data, FILE_TEXT);
}

/**
 * Esegue la lettura di una stringa in cache.
 * ESEMPIO: cache_write('chiave_univoca', 3600); // -> ritorna il valore in cache di 'chiave_univoca' solo se creato da meno di un ora.
 */
function cache_read($key, $max_lifetime_seconds = 3600) {
  global $CACHE_PATH;
  $file = "$CACHE_PATH/$key.cache";

  // check file exists
  if (!file_exists($file)) return null;

  // check file is not too older
  if (time() - filemtime($file) > $max_lifetime_seconds) return null;

  return readfile($file);
}

/**
 * Esegue la scrittura di un oggetto in cache.
 */
function cache_write_object($key, $data) {
  return cache_write($key, json_encode($data));
}

/**
 * Esegue la lettura di un oggetto in cache.
 */
function cache_read_object($key, $max_lifetime_seconds) {
  $data = cache_read($key, $max_lifetime_seconds);
  if (!$data) return null;

  return json_decode($data);
}