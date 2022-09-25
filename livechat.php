<?php
if ( !function_exists( 'add_action' ) ) {
	echo 'Do not call me directly';
	exit;
}

define( 'LIVECHAT_PLUGIN_ADMIN', plugin_dir_path( __FILE__ ) . 'admin/' );
define( 'LIVECHAT_PLUGIN_FRONTEND', plugin_dir_path( __FILE__ ) . 'public/' );
define( 'LIVECHAT_PLUGIN_INCLUDE', plugin_dir_path( __FILE__ ) . 'includes/' );

register_activation_hook( __FILE__ , array( 'Livechat', 'plugin_activation' ) );
register_deactivation_hook( __FILE__ , array( 'Livechat', 'plugin_deactivation' ) );

include_once( LIVECHAT_PLUGIN_INCLUDE . 'class.livechat.php' );
include_once( LIVECHAT_PLUGIN_INCLUDE . 'class.livechat.dp_helper.php' );
include_once( LIVECHAT_PLUGIN_INCLUDE . 'livechat.functions.php' );
 
add_action( 'init', array( 'Livechat', 'init' ) );

/* Ajax hooks */
add_action( 'wp_ajax_nopriv_writeMessage', array('Livechat', 'writeMessage' ) );
add_action( 'wp_ajax_writeMessage', array('Livechat', 'writeMessage' ) );
add_action( 'wp_ajax_nopriv_readMessages',  array('Livechat', 'readMessages' ) );
add_action( 'wp_ajax_readMessages',  array('Livechat', 'readMessages' ) );
add_action( 'wp_ajax_endChat',  array('Livechat', 'endChat' ) );
add_action( 'wp_ajax_checkUserOnline',  array('Livechat', 'checkUserOnline' ) );