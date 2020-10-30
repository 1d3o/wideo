<?php

/**
 * GESTIONE PLUGIN DI DEFAULT.
 * Attraverso il plugin TGM vengono impostati i plugin obbligatori e suggeriti dal tema.
 */

function wideo_tgm_plugin(){
	$plugins = array(
		array(
			'name' => 'WP Sync DB',
			'slug' => 'wp-sync-db',
			'source' => 'https://github.com/wp-sync-db/wp-sync-db/archive/1.5.zip',
			'required' => true,
			'external_url' => 'https://github.com/wp-sync-db/wp-sync-db'
		), 
		array(
			'name' => 'WP Sync DB media files',
			'slug' => 'wp-sync-db-media-files',
			'source' => 'https://github.com/wp-sync-db/wp-sync-db-media-files/archive/master.zip',
			'required' => true,
			'external_url' => 'https://github.com/wp-sync-db/wp-sync-db-media-files'
		),
		array(
			'name' => 'RankMath',
			'slug' => 'seo-by-rank-math',
			'required' => false,
			'external_url' => 'https://it.wordpress.org/plugins/seo-by-rank-math/'
		),
		array(
			'name' => 'iThemes Security',
			'slug' => 'better-wp-security',
			'required' => false,
			'external_url' => 'https://it.wordpress.org/plugins/better-wp-security/'
		),
		array(
			'name' => 'WP Mail SMTP',
			'slug' => 'wp-mail-smtp',
			'required' => false,
			'external_url' => 'https://it.wordpress.org/plugins/wp-mail-smtp/'
		),

		// COMPILE_CODE_HERE: aggiungere eventuali plugin suggeriti o obbligatori
	);

	$config = array(
		'id'           => 'wideo-tgm',             // Specifica un ID univoco per evitare problemi con altre istanze di TGMPA
		'default_path' => '',                      // Il percorso di default dove trovare i plugin caricati con il tema.
		'menu'         => 'wideo-tgm-install-plugins', // Fornisci uno slug per la pagina opzioni.
		'parent_slug'  => 'themes.php',            // Definisci il genitore della pagina opzioni nel menu.
		'capability'   => 'edit_theme_options',    // Specifica la capability necessaria per consultare la pagina opzioni
		'has_notices'  => true,                    // Scegli se mostrare o meno le notice.
		'dismissable'  => true,                    // Se impostato a false, l'utente non potrà chiudere la notice.
		'dismiss_msg'  => '',                      // Se 'dismissable' è false, questo messaggio verrà mostrato in alto.
		'is_automatic' => false,                   // Scegli se attivare automaticamente i plugin installati
		'message'      => '',                      // Messaggio da mostrare prima della tabella dei plugin.
  );

	tgmpa( $plugins, $config);
}

add_action('tgmpa_register', 'wideo_tgm_plugin');