<?php 
# Sostituisce il logo nella pagina di login
#-------------------------------------------------------------------------------
function wideo_login_logo ()
{
  if ( file_exists( get_template_directory() . "/assets/images/logo.svg" ) ) :
    echo "<style>#login h1 a { background-image: url(" . get_template_directory_uri() . "/assets/images/logo.svg" . ") !important; width: 320px !important; height: 184px !important; background-size: 320px 184px !important; }</style>";
  endif;
}

  
add_action('login_head', 'wideo_login_logo');
# Modifico la destinazione del link sul logo nella schermata di login
#-------------------------------------------------------------------------------
function wideo_login_logo_link ()
{
  return get_site_url();
}


add_filter('login_headerurl', 'wideo_login_logo_link' );
# Cambia il link associato alla pagina di login

