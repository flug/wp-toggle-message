<?php
/*
 * Plugin Name: Wordpress Message toggle
 * Description:
 * Version: 1.0
 * Author URI: clooder.com
 * License: MYT
 */



function message_widget_load_widget() {
    if(!class_exists("MessageWidget"))
	include("MessageWidget.php");
    register_widget( 'MessageWidget' );
}
add_action( 'widgets_init', 'message_widget_load_widget' );
