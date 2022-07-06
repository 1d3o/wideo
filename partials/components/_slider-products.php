<?php 

/** NOTE: "contenuto" è da stampare usando la funzione get_formatted_content($args['contenuto]). Metterlo dentro un div e non un p perchè contiene già a sua volta tag p. */

/** NOTE: Per le card dei prodotti puoi usare la componente 'card-product'. Lasciala tranquillamente statica e poi collego io i contenuti. */

echo '<h1>Slider products</h1><hr>';
var_dump($args);