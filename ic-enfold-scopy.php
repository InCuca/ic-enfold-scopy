<?php
/**
 * Plugin Name:     Enfold Shortcode Copy
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
    global $post;
    
    wp_register_script( 'ic-scopy', "${plugin_dir}js/ic-scopy.js");
    $icScopy = array(
        'url' => admin_url('admin-ajax.php', $protocol),
        'params' => array(
            'action' => 'ic_scopy_shortcode',
            '_nonce' => wp_create_nonce('ic-scopy-nonce'),
            'postId' => $post->ID,
        ),
    );
    wp_localize_script( 'ic-scopy', 'ic_scopy', $icScopy );
    wp_enqueue_script('ic-scopy');
};
add_action( 'wp_enqueue_scripts', $loadScripts );

$scopyShortcode = function() {
    check_ajax_referer( 'ic-scopy-nonce', '_nonce' );
    $postId = sanitize_text_field($_REQUEST['postId']);
    echo get_post_meta( $postId, '_aviaLayoutBuilderCleanData', true );
    die();
};
add_action('wp_ajax_ic_scopy_shortcode', $scopyShortcode);
add_action('wp_ajax_nopriv_ic_scopy_shortcode', $scopyShortcode);