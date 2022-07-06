<?php

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();

    component('_editor', array(
      'post_id' => get_the_ID(),
    ));

    component('_contact', array(
      'post_id' => get_the_ID(),
    ));
  }
}
   
get_footer();
