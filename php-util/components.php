<?php

/**
 	* FUNZIONE PER RECUPERO COMPONENTI DINAMICHE.
	* Mettere le componenti in /partials/components.
	* Richiamare le componenti con <php component('nome-componente', array('config1' => 'value')); ?>
	* dentro al componente per accedere hai dati c'è la variabile globale $args che all suo interno torna l'array che viene passato al component
*/


function component ($name = '', $vars = array()) {
	get_template_part( 'partials/components/_'.$name, '', $vars);
}
