<?php
/**
 * FUNZIONE PER RICHIAMARE TEMPLATE PARZIALI.
 * Mettere i template in /partials.
 * Richiamare la funzione con <php partial('nome-parziale'); ?>
 */


function partial($name = '') {	
	get_template_part( 'partials/_'.$name);
}
