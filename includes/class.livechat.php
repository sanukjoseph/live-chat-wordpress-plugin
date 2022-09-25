<?php

class Livechat {

    public static function init() {
        session_start();
        load_plugin_textdomain( 'livechat' );
        
        if ( is_admin() ) {
            include LIVECHAT_PLUGIN_ADMIN . 'admin.php';
        } else {
            include LIVECHAT_PLUGIN_FRONTEND . 'public.php';
        }
    }

    /* Plugin activation */
    function plugin_activation () {
        
        // Create Database on activation
        global $wpdb; 
    
        $table_name = $wpdb->prefix . "livechat"; 
    
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE $table_name (
            id INTEGER NOT NULL AUTO_INCREMENT,
            time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            message TEXT NOT NULL DEFAULT '',
            chatuser VARCHAR(32) NOT NULL,
            useronline TINYINT NOT NULL,
            usersession VARCHAR(50) NOT NULL,
            userip VARCHAR(128) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        $sqlInit = "INSERT INTO $table_name (id, message, chatuser, useronline) VALUES (1, '', '', 0)";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        dbDelta( $sqlInit );

        
     }

    /* Plugin deactivation */
    function plugin_deactivation() {
    }

    /* Ajax functions */
    function writeMessage() {
        DB_Helper::getHelper()->writeMessage(); 
        wp_die();
    }

    function readMessages() {
        DB_Helper::getHelper()->readMessages();
        wp_die();
    }

    function endChat() {
        DB_Helper::getHelper()->endChat();
        wp_die();
    }

    function checkUserOnline() {
        DB_Helper::getHelper()->checkUserOnline();
        wp_die();
    }
}