<?php
/**
 * Enqueue Theme Assets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function jc_enqueue_assets()
{
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'jc-fonts',
        'https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Nunito:wght@400;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap',
        array(),
        null
    );

    // Enqueue main CSS
    wp_enqueue_style(
        'jc-main-style',
        get_template_directory_uri() . '/assets/css/app.css',
        array(),
        $theme_version
    );

    // Enqueue main JS
    wp_enqueue_script(
        'jc-main-script',
        get_template_directory_uri() . '/assets/js/app.js',
        array('jquery'),
        $theme_version,
        true
    );

    wp_localize_script(
        'jc-main-script',
        'jcTheme',
        array(
            'ajaxUrl'   => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce('jc_cart_nonce'),
            'cartCount' => jc_get_cart_count(),
            'cartTotal' => jc_get_cart_total(),
        )
    );
}
add_action('wp_enqueue_scripts', 'jc_enqueue_assets');
