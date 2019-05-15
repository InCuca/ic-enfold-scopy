<?php
/**
 * Plugin Name:     Enfold hello
 * Plugin URI:      https://incuca.net
 * Description:     Hello Enfold Plugin
 * Author:          INCUCA
 * Author URI:      https://incuca.net
 * Text Domain:     ic-hello
 * Version:         0.1.0
 *
 * @package         Ic_Enfold
 */

// Add shortcodes to Enfold
add_filter('avia_load_shortcodes', 'ic_hello_shortcodes', 12, 1);

function ic_hello_shortcodes($paths)
{
	$plugin_dir = plugin_dir_path(__FILE__);
	array_push($paths, $plugin_dir.'/shortcodes/');
	return $paths;
}