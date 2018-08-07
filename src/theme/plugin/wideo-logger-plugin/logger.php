<?php
/*
Plugin Name: Wideo logger
Plugin URI: http://www.ideonetwork.it/
Description: Simple WordPress custom logger.
Version: 1.0
Author: ídeo SRL
Author URI: http://www.ideonetwork.it/
*/

/**
 * USAGE:
 * wideo_logger_create_log('log_type', array(
 * 	'content_key' => 'content_value'
 * ))
 */

// Initialize database for the plugin.
function wideo_logger_create_db() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'wideo_logger';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		type varchar(255) NOT NULL,
		content text NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
add_action( 'after_setup_theme', 'wideo_logger_create_db' );

// Function used to create a new log.
function wideo_logger_create_log($type, $content) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'wideo_logger';
	$time = current_time('mysql');
	$json_content = json_encode($content);

	$result = $wpdb->query(
		"INSERT INTO $table_name (time, type, content) VALUES ('$time', '$type', '$json_content')"
	);

	return $result;
}

?>
