<?php

function partial ($name) {
  if ($name) {
    global $globals;
    extract($globals);
    include(locate_template("partials/_$name.php"));
  }
}

?>