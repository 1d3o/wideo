<?php

function icon ($name = '') {
  if ($name) {
    include(locate_template("partials/icons/$name.svg"));
  }
}

?>