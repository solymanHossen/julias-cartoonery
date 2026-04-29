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
        array(),
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'jc_enqueue_assets');
