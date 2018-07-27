<?php 

function sam_tgm_plugin(){
	$plugins = array(
		array(
			'name' => 'WP Sync DB',
			'slug' => 'wp-sync-db',
			'source' => 'https://github.com/wp-sync-db/wp-sync-db/archive/1.5.zip',
			'required' => true,
			'external_url' => 'https://github.com/wp-sync-db/wp-sync-db/'
		), 
		array(
			'name' => 'WP Sync DB media files',
			'slug' => 'wp-sync-db-media-files',
			'source' => 'https://github.com/wp-sync-db/wp-sync-db-media-files/archive/master.zip',
			'required' => true,
			'external_url' => 'https://github.com/wp-sync-db/wp-sync-db-media-files'
		), 
	);

	$config = array(
		'id'           => 'sam-tgmpa',             // Specifica un ID univoco per evitare problemi con altre istanze di TGMPA
		'default_path' => '',                      // Il percorso di default dove trovare i plugin caricati con il tema.
		'menu'         => 'tgmpa-install-plugins', // Fornisci uno slug per la pagina opzioni.
		'parent_slug'  => 'themes.php',            // Definisci il genitore della pagina opzioni nel menu.
		'capability'   => 'edit_theme_options',    // Specifica la capability necessaria per consultare la pagina opzioni
		'has_notices'  => true,                    // Scegli se mostrare o meno le notice.
		'dismissable'  => true,                    // Se impostato a false, l'utente non potrà chiudere la notice.
		'dismiss_msg'  => '',                      // Se 'dismissable' è false, questo messaggio verrà mostrato in alto.
		'is_automatic' => false,                   // Scegli se attivare automaticamente i plugin installati
		'message'      => '',                      // Messaggio da mostrare prima della tabella dei plugin.
		
		//Tutta la traduzione delle stringhe è facoltativa, puoi anche rimuovere tutto il codice qua sotto
		'strings'      => array(
			'page_title'                      => __( 'Installa i plugins richiesti', 'theme-slug' ),
			'menu_title'                      => __( 'Installa Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installa Plugin: %s', 'theme-slug' ),
			'updating'                        => __( 'Aggiorna Plugin: %s', 'theme-slug' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'Installa i plugin richiesti per aiutarti nello sviluppo: %1$s.',
				'Installa i plugins suggeriti se ti possono essere utili: %1$s.',
				'theme-slug'
			),
			'notice_can_install_recommended'  => _n_noop(
				'Plugin raccomandato: %1$s.',
				'Plugins raccomandati: %1$s.',
				'theme-slug'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'Aggiornamento disponibile per un plugin %1$s.',
				'Sono disponibili aggiornamenti per i seguenti plugin : %1$s.',
				'theme-slug'

			),
			'notice_can_activate_required'    => _n_noop(
				'Il seguente plugin richiesto è attualmente inattivo: %1$s.',
				'I seguenti plugins richiesti sono attualmente inattivi: %1$s.',
				'theme-slug'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			),
			'install_link'                    => _n_noop(
				"Inizia l'installazione del plugin",
				"Inizia l'installazione dei plugins",
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Attiva il plugin richiesto',
				'Attiva i seguenti plugins',
				'theme-slug'
			),
			'plugin_activated'                => __( 'Plugin attivato con successo.', 'theme-slug' ),
			'activated_successfully'          => __( 'Il plugin è stato attivato con successo:', 'theme-slug' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),
			'complete'                        => __( 'Tutti i plugins sono installati e attivati con successo. %1$s', 'theme-slug' ),
			'dismiss'                         => __( 'Rimuovi la notifica', 'theme-slug' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'theme-slug' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'theme-slug' ),
			'nag_type'                        => 'notice-warning', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
  );

	tgmpa( $plugins, $config);
}

add_action('tgmpa_register', 'sam_tgm_plugin');