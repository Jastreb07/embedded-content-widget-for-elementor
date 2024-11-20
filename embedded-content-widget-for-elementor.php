<?php
/**
 * Plugin Name: Embedded content widget for Elementor
 * Plugin URI: https://github.com/Jastreb07/embedded-content-widget-for-elementor
 * Description: Simple Embedded Content from other websites.
 * Version:     1.0.2
 * License:     GPL3
 * Author:      Vitalij Dell
 * Author URI:  https://herweck.de
 * GitHub Plugin URI: Jastreb07/embedded-content-widget-for-elementor
 * Primary Branch: main
 * Release Asset: true
 */

// Elementor Widget
function register_embedded_content_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/embedded-content-widget.php' );

    $widgets_manager->register( new \Elementor_Embedded_Content_Widget() );

}
add_action( 'elementor/widgets/register', 'register_embedded_content_widget' );

// Enqueue JavaScript
function iframe_height_sender_enqueue_scripts() {
    wp_enqueue_script(
        'iframe-height-sender-script',
        plugin_dir_url(__FILE__) . 'iframe-height-sender.js',
        array(),
        '1.1',
        true
    );
}
add_action('wp_enqueue_scripts', 'iframe_height_sender_enqueue_scripts');
