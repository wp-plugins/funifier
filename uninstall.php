<?php 

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();
 
// Deleta as opções
delete_option( 'funifier-api-key' );
delete_option( 'funifier-check-widget-site' );
delete_option( 'funifier-check-widget-admin' );
delete_option( 'funifier-login-implicit' );
