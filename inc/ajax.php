<?php
/**
 * AJAX endpoints for cart interactions.
 */

if (!defined('ABSPATH')) {
    exit;
}

function jc_bootstrap_wc_cart() {
    if (!function_exists('WC')) {
        return false;
    }

    if (!WC()->session) {
        if (function_exists('wc_load_cart')) {
            wc_load_cart();
        }
    }

    if (!WC()->cart && function_exists('wc_load_cart')) {
        wc_load_cart();
    }

    return (bool) WC()->cart;
}

function jc_ajax_cart_response() {
    if (!jc_bootstrap_wc_cart()) {
        wp_send_json_error(array('message' => __('WooCommerce cart is unavailable.', 'julias-cartoonery')));
    }

    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();

    wp_send_json_success(array(
        'cart_count'       => jc_get_cart_count(),
        'cart_total'       => jc_get_cart_total(),
        'mini_cart'        => $mini_cart,
        'cart_items_html'  => jc_render_cart_items_html(),
        'cart_summary_html'=> jc_render_cart_summary_html(),
        'fragments'        => apply_filters('woocommerce_add_to_cart_fragments', array()),
    ));
}

function jc_ajax_add_to_cart() {
    check_ajax_referer('jc_cart_nonce', 'nonce');

    if (!jc_bootstrap_wc_cart()) {
        wp_send_json_error(array('message' => __('WooCommerce is not active.', 'julias-cartoonery')));
    }

    $product_id  = isset($_POST['product_id']) ? absint(wp_unslash($_POST['product_id'])) : 0;
    $quantity    = isset($_POST['quantity']) ? max(1, absint(wp_unslash($_POST['quantity']))) : 1;
    $variation_id = isset($_POST['variation_id']) ? absint(wp_unslash($_POST['variation_id'])) : 0;
    $variation   = isset($_POST['variation']) && is_array($_POST['variation']) ? wc_clean(wp_unslash($_POST['variation'])) : array();

    if (!$product_id) {
        wp_send_json_error(array('message' => __('Invalid product.', 'julias-cartoonery')));
    }

    $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation);

    if (!$added) {
        wp_send_json_error(array('message' => __('Could not add the product to cart.', 'julias-cartoonery')));
    }

    jc_ajax_cart_response();
}

function jc_ajax_update_cart_item() {
    check_ajax_referer('jc_cart_nonce', 'nonce');

    if (!jc_bootstrap_wc_cart()) {
        wp_send_json_error(array('message' => __('WooCommerce cart is unavailable.', 'julias-cartoonery')));
    }

    $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field(wp_unslash($_POST['cart_item_key'])) : '';
    $quantity      = isset($_POST['quantity']) ? max(0, absint(wp_unslash($_POST['quantity']))) : 0;

    if (!$cart_item_key || !isset(WC()->cart->get_cart()[$cart_item_key])) {
        wp_send_json_error(array('message' => __('Cart item not found.', 'julias-cartoonery')));
    }

    if (0 === $quantity) {
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        WC()->cart->set_quantity($cart_item_key, $quantity, true);
    }

    jc_ajax_cart_response();
}

function jc_ajax_remove_cart_item() {
    check_ajax_referer('jc_cart_nonce', 'nonce');

    if (!jc_bootstrap_wc_cart()) {
        wp_send_json_error(array('message' => __('WooCommerce cart is unavailable.', 'julias-cartoonery')));
    }

    $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field(wp_unslash($_POST['cart_item_key'])) : '';

    if (!$cart_item_key || !isset(WC()->cart->get_cart()[$cart_item_key])) {
        wp_send_json_error(array('message' => __('Cart item not found.', 'julias-cartoonery')));
    }

    WC()->cart->remove_cart_item($cart_item_key);

    jc_ajax_cart_response();
}

add_action('wp_ajax_jc_add_to_cart', 'jc_ajax_add_to_cart');
add_action('wp_ajax_nopriv_jc_add_to_cart', 'jc_ajax_add_to_cart');
add_action('wp_ajax_jc_update_cart_item', 'jc_ajax_update_cart_item');
add_action('wp_ajax_nopriv_jc_update_cart_item', 'jc_ajax_update_cart_item');
add_action('wp_ajax_jc_remove_cart_item', 'jc_ajax_remove_cart_item');
add_action('wp_ajax_nopriv_jc_remove_cart_item', 'jc_ajax_remove_cart_item');
