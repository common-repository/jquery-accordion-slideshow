<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option('JaS_Title');
 
// for site options in Multisite
delete_site_option('JaS_Title');

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}jas_plugin");