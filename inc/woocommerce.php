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

/**
 * Keep header cart count and mini cart in sync.
 */
function julias_cartoonery_woocommerce_fragments($fragments) {
    ob_start();
    ?>
    <span class="js-jc-cart-count absolute -top-1 -right-1 bg-red-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full animate-bounce">
        <?php echo esc_html(jc_get_cart_count()); ?>
    </span>
    <?php
    $fragments['span.js-jc-cart-count'] = ob_get_clean();

    ob_start();
    woocommerce_mini_cart();
    $fragments['.js-jc-mini-cart-content'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'julias_cartoonery_woocommerce_fragments');

/**
 * Light checkout field adjustments for the custom layout.
 */
function julias_cartoonery_checkout_fields($fields) {
    if (isset($fields['billing']['billing_first_name'])) {
        $fields['billing']['billing_first_name']['label'] = __('Full Name', 'julias-cartoonery');
        $fields['billing']['billing_first_name']['placeholder'] = __('Enter your full name', 'julias-cartoonery');
        $fields['billing']['billing_first_name']['class'] = array('form-row-wide');
    }

    if (isset($fields['billing']['billing_phone'])) {
        $fields['billing']['billing_phone']['label'] = __('Phone Number', 'julias-cartoonery');
        $fields['billing']['billing_phone']['placeholder'] = __('Enter your phone number', 'julias-cartoonery');
    }

    if (isset($fields['order']['order_comments'])) {
        $fields['order']['order_comments']['label'] = __('Delivery Notes', 'julias-cartoonery');
        $fields['order']['order_comments']['placeholder'] = __('Add delivery instructions or gift notes', 'julias-cartoonery');
    }

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'julias_cartoonery_checkout_fields');
