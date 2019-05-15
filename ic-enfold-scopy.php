<?php
/**
 * Plugin Name:     Shortcode Copy
 * Plugin URI:      https://incuca.net
 * Description:     Copy page shortcode on frontend
 * Author:          INCUCA
 * Author URI:      https://incuca.net
 * Text Domain:     ic-enfold-scopy
 * Version:         0.1.0
 *
 * @package         Ic_Enfold
 */

$plugin_dir = plugin_dir_url(__FILE__);

$loadScripts = function() use (&$plugin_dir) {
    wp_localize_script( 'ic-scopy', 'ajaxUrl', admin_url('admin-ajax.php') );
    wp_enqueue_script( 'ic-scopy', "$plugin_dir/js/ic-scopy.js");
};

add_action( 'wp_enqueue_scripts', $loadScripts );
