<?php

/**
 * FUNZIONE PER LOG PHP SU CONSOLE JAVASCRIPT.
 * Richiamare la funzione con <php logJs($my_var); ?>
 */

function logJs ($val, $name = '') {
  $type = gettype($val);
  if ($type == 'array' || $type == 'object') {
    $val = json_encode($val);
    echo "<script>console.log('$name', $val);</script>";
  } else {
    echo "<script>console.log('$name', '$val');</script>";
  }
}
