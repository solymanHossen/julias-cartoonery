<?php
/**
 * Theme helper functions.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('jc_get_cart_count')) {
    function jc_get_cart_count() {
        if (!function_exists('WC') || !WC()->cart) {
            return 0;
        }

        return (int) WC()->cart->get_cart_contents_count();
    }
}

if (!function_exists('jc_get_cart_total')) {
    function jc_get_cart_total() {
        if (!function_exists('WC') || !WC()->cart) {
            return wc_price(0);
        }

        return WC()->cart->get_cart_total();
    }
}

if (!function_exists('jc_get_product_thumbnail_html')) {
    function jc_get_product_thumbnail_html($product_id, $size = 'woocommerce_thumbnail', $class = '') {
        $product = wc_get_product($product_id);

        if (!$product) {
            return '';
        }

        $thumbnail_id = $product->get_image_id();

        if (!$thumbnail_id) {
            return wc_placeholder_img($size);
        }

        return wp_get_attachment_image(
            $thumbnail_id,
            $size,
            false,
            array(
                'class'   => $class,
                'loading' => 'lazy',
                'alt'     => $product->get_name(),
            )
        );
    }
}

if (!function_exists('jc_get_cart_row_subtotal')) {
    function jc_get_cart_row_subtotal($cart_item) {
        if (empty($cart_item['data']) || !is_a($cart_item['data'], 'WC_Product')) {
            return '';
        }

        $line_total = (float) $cart_item['data']->get_price() * (int) $cart_item['quantity'];

        return wc_price($line_total);
    }
}

if (!function_exists('jc_render_cart_items_html')) {
    function jc_render_cart_items_html() {
        if (!function_exists('WC') || !WC()->cart) {
            return '';
        }

        ob_start();

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];

            if (!$product || !$product->exists() || $cart_item['quantity'] <= 0) {
                continue;
            }

            $product_id = $product->get_id();
            ?>
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-4 flex items-center gap-4 shadow-sm border border-gray-50 dark:border-slate-700" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="shrink-0">
                    <?php echo jc_get_product_thumbnail_html($product_id, 'woocommerce_thumbnail', 'w-24 h-24 rounded-2xl object-cover bg-gray-50 dark:bg-slate-700 mix-blend-multiply dark:mix-blend-normal'); ?>
                </a>
                <div class="flex-grow min-w-0">
                    <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="font-bold text-gray-800 dark:text-gray-200 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors line-clamp-1">
                        <?php echo esc_html($product->get_name()); ?>
                    </a>
                    <p class="text-[#FFB7C5] dark:text-pink-400 font-bold mt-1"><?php echo wp_kses_post($product->get_price_html()); ?></p>
                </div>
                <div class="flex items-center bg-gray-50 dark:bg-slate-700 rounded-full px-2 py-1">
                    <button type="button" data-jc-cart-action="decrease" class="p-2 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" aria-label="<?php esc_attr_e('Decrease quantity', 'julias-cartoonery'); ?>">
                        -
                    </button>
                    <input type="number" min="0" step="1" value="<?php echo esc_attr((int) $cart_item['quantity']); ?>" class="jc-cart-qty w-12 bg-transparent text-center font-bold text-sm dark:text-white outline-none" data-jc-cart-qty />
                    <button type="button" data-jc-cart-action="increase" class="p-2 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-white" aria-label="<?php esc_attr_e('Increase quantity', 'julias-cartoonery'); ?>">
                        +
                    </button>
                </div>
                <button type="button" data-jc-cart-action="remove" class="p-3 text-red-300 dark:text-red-400 hover:text-red-500 transition-colors bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-full ml-2" aria-label="<?php esc_attr_e('Remove item', 'julias-cartoonery'); ?>">
                    &times;
                </button>
            </div>
            <?php
        }

        $html = ob_get_clean();

        if ('' === trim($html)) {
            $html = '<div class="bg-white dark:bg-slate-800 rounded-3xl p-10 text-center border border-gray-50 dark:border-slate-700 text-gray-500 dark:text-gray-400">' . esc_html__('Your cart is empty.', 'julias-cartoonery') . '</div>';
        }

        return $html;
    }
}

if (!function_exists('jc_render_cart_summary_html')) {
    function jc_render_cart_summary_html() {
        if (!function_exists('WC') || !WC()->cart) {
            return '';
        }

        $subtotal = WC()->cart->get_subtotal();
        $shipping = WC()->cart->needs_shipping() ? 5 : 0;
        $total = (float) $subtotal + (float) $shipping;

        ob_start();
        ?>
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-gray-50 dark:border-slate-700 sticky top-28">
            <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 mb-6"><?php esc_html_e('Order Summary', 'julias-cartoonery'); ?></h3>

            <div class="space-y-3 text-gray-600 dark:text-gray-400 mb-6">
                <div class="flex justify-between"><span><?php esc_html_e('Subtotal', 'julias-cartoonery'); ?></span> <span class="font-bold dark:text-gray-300"><?php echo wp_kses_post(wc_price($subtotal)); ?></span></div>
                <div class="flex justify-between"><span><?php esc_html_e('Delivery', 'julias-cartoonery'); ?></span> <span class="font-bold dark:text-gray-300"><?php echo wp_kses_post(wc_price($shipping)); ?></span></div>
                <div class="h-px bg-gray-100 dark:bg-slate-700 my-4"></div>
                <div class="flex justify-between text-xl text-gray-800 dark:text-gray-100">
                    <span class="font-bold"><?php esc_html_e('Total', 'julias-cartoonery'); ?></span>
                    <span class="font-bold text-[#FFB7C5] dark:text-pink-400"><?php echo wp_kses_post(wc_price($total)); ?></span>
                </div>
            </div>

            <a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout')); ?>" class="block w-full py-4 text-lg bg-[#A8D8EA] dark:bg-sky-500 hover:bg-sky-400 dark:hover:bg-sky-600 text-white rounded-full font-bold text-center transition-colors">
                <?php esc_html_e('Proceed to Checkout', 'julias-cartoonery'); ?>
            </a>
        </div>
        <?php
        return ob_get_clean();
    }
}

