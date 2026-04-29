<?php
/**
 * WooCommerce Integration for Julia's Cartoonery
 */

if (!defined('ABSPATH')) {
    exit;
}

function julias_cartoonery_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'julias_cartoonery_woocommerce_setup');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('julias_cartoonery_wrapper_start')) {
    function julias_cartoonery_wrapper_start() {
        echo '<div class="container mx-auto px-4 lg:px-8 py-10 animate-in fade-in">';
    }
}
add_action('woocommerce_before_main_content', 'julias_cartoonery_wrapper_start', 10);

if (!function_exists('julias_cartoonery_wrapper_end')) {
    function julias_cartoonery_wrapper_end() {
        echo '</div>';
    }
}
add_action('woocommerce_after_main_content', 'julias_cartoonery_wrapper_end', 10);

/**
 * Disable default WooCommerce styles so we can style with Tailwind.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
