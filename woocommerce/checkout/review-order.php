<?php
/**
 * Review order table.
 */

defined('ABSPATH') || exit;

?>

<div class="space-y-6">
    <div class="space-y-3">
        <?php do_action('woocommerce_review_order_before_cart_contents'); ?>

        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = $cart_item['data'];
            if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0) {
                continue;
            }
            ?>
            <div class="flex gap-4 items-center rounded-3xl border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-4" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                <a href="<?php echo esc_url(get_permalink($_product->get_id())); ?>" class="w-16 h-16 shrink-0 rounded-2xl overflow-hidden bg-white dark:bg-slate-800">
                    <?php echo jc_get_product_thumbnail_html($_product->get_id(), 'woocommerce_thumbnail', 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal'); ?>
                </a>
                <div class="flex-1 min-w-0">
                    <a href="<?php echo esc_url(get_permalink($_product->get_id())); ?>" class="block font-bold text-gray-800 dark:text-gray-100 line-clamp-1 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors">
                        <?php echo esc_html($_product->get_name()); ?>
                    </a>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <?php echo esc_html((int) $cart_item['quantity']); ?> x <?php echo wp_kses_post($_product->get_price_html()); ?>
                    </div>
                    <?php
                    $item_meta = wc_get_formatted_cart_item_data($cart_item);
                    if ($item_meta) {
                        echo '<div class="text-xs text-gray-400 dark:text-gray-500 mt-1">' . wp_kses_post($item_meta) . '</div>';
                    }
                    ?>
                </div>
                <div class="font-bold text-[#FFB7C5] dark:text-pink-400"><?php echo wp_kses_post(WC()->cart->get_product_subtotal($_product, $cart_item['quantity'])); ?></div>
            </div>
        <?php endforeach; ?>

        <?php do_action('woocommerce_review_order_after_cart_contents'); ?>
    </div>

    <div class="space-y-3 text-gray-600 dark:text-gray-400">
        <div class="flex justify-between">
            <span><?php esc_html_e('Subtotal', 'julias-cartoonery'); ?></span>
            <span class="font-bold dark:text-gray-300"><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span>
        </div>
        <div class="flex justify-between">
            <span><?php esc_html_e('Shipping', 'julias-cartoonery'); ?></span>
            <span class="font-bold dark:text-gray-300"><?php echo WC()->cart->needs_shipping() ? esc_html__('Calculated at checkout', 'julias-cartoonery') : esc_html__('Free', 'julias-cartoonery'); ?></span>
        </div>
        <div class="h-px bg-gray-100 dark:bg-slate-700 my-4"></div>
        <div class="flex justify-between text-xl text-gray-800 dark:text-gray-100">
            <span class="font-bold"><?php esc_html_e('Total', 'julias-cartoonery'); ?></span>
            <span class="font-bold text-[#FFB7C5] dark:text-pink-400"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>
    </div>
</div>
