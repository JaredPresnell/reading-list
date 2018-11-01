<?php 
/*
 @package reading-list
 */
 /*
 Plugin Name: Reading List
 Plugin URI: https://jaredpresnell.me
 Description: A plugin to register books custom post type and sort query or something
 Version: 1.0.0
 Author: Jared Presnell
 Author URI: https://jaredpresnell.me
 License: GPLv3
 Text Domain: reading-list
 */
defined('ABSPATH') or die('stop that');


include plugin_dir_path( __FILE__ ) . 'books-cpt.php';
include plugin_dir_path( __FILE__ ) . 'ajax.php';
include plugin_dir_path( __FILE__ ) . 'create-template.php';

function reading_list_enqueue(){
	//var_dump(plugin_dir_url(__FILE__) . 'js/reading-list.js');
	wp_register_script( 'reading_list', plugin_dir_url(__FILE__) . 'js/reading-list.js', array('jquery'),'1.0.0',true );
	//wp_register_script( 'reading_list', 'http://localhost/wordpress/wp-content/plugins/reading-list/js/reading-list.js?ver=1.0.0', array('jquery'),'1.0.0',true );
	wp_localize_script( 'reading_list', 'my_ajax_object',
	        array( 'ajax_url' => admin_url( 'admin-ajax.php'), 'test'=>'SHRED' ) );
	wp_enqueue_script('reading_list');
}

add_action( 'wp_enqueue_scripts', 'reading_list_enqueue' );

//ACTIVATION AND DEACTIVATION HOOKS
function activate_portfolio_nells_plugin(){
	flush_rewrite_rules();
}

function deactivate_portfolio_nells_plugin(){
	flush_rewrite_rules();	
}

register_activation_hook(__FILE__, 'activate_portfolio_nells_plugin');
register_deactivation_hook(__FILE__, 'deactivate_portfolio_nells_plugin');