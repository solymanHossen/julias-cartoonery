<?php
/**
 * Mini-cart content.
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart');
?>

<?php if (!WC()->cart->is_empty()) : ?>
    <ul class="space-y-3">
        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = $cart_item['data'];
            if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0) {
                continue;
            }
            ?>
            <li class="flex gap-3 items-center border-b border-gray-100 dark:border-slate-700 pb-3 last:border-0 last:pb-0" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                <a href="<?php echo esc_url(get_permalink($_product->get_id())); ?>" class="w-16 h-16 shrink-0 rounded-2xl overflow-hidden bg-gray-50 dark:bg-slate-700">
                    <?php echo jc_get_product_thumbnail_html($_product->get_id(), 'woocommerce_thumbnail', 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal'); ?>
                </a>
                <div class="flex-1 min-w-0">
                    <a href="<?php echo esc_url(get_permalink($_product->get_id())); ?>" class="block font-bold text-sm text-gray-800 dark:text-gray-100 line-clamp-1 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors"><?php echo esc_html($_product->get_name()); ?></a>
                    <div class="text-xs text-gray-400 dark:text-gray-500 mt-1"><?php echo esc_html((int) $cart_item['quantity']); ?> x <?php echo wp_kses_post($_product->get_price_html()); ?></div>
                </div>
                <button type="button" class="text-red-400 hover:text-red-500 transition-colors" data-jc-cart-action="remove" aria-label="<?php esc_attr_e('Remove item', 'julias-cartoonery'); ?>">&times;</button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="mt-5 pt-4 border-t border-gray-100 dark:border-slate-700">
        <div class="flex items-center justify-between font-bold text-gray-700 dark:text-gray-200 mb-4">
            <span><?php esc_html_e('Subtotal', 'julias-cartoonery'); ?></span>
            <span><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span>
        </div>
        <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart')); ?>" class="block w-full mb-3 px-4 py-3 rounded-full text-center font-bold border-2 border-[#FFB7C5] text-pink-500 hover:bg-pink-50 dark:border-pink-500 dark:text-pink-400 dark:hover:bg-slate-700 transition-colors">
            <?php esc_html_e('View Cart', 'julias-cartoonery'); ?>
        </a>
        <a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout')); ?>" class="block w-full px-4 py-3 rounded-full text-center font-bold bg-[#A8D8EA] text-white hover:bg-sky-400 transition-colors">
            <?php esc_html_e('Checkout', 'julias-cartoonery'); ?>
        </a>
    </div>
<?php else : ?>
    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
        <?php esc_html_e('Your cart is empty.', 'julias-cartoonery'); ?>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
