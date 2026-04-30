<?php
/**
 * Custom checkout payment section.
 */

defined('ABSPATH') || exit;

if (!WC()->cart->needs_payment()) {
    return;
}
?>

<div class="space-y-4">
    <?php if (WC()->cart->needs_shipping()) : ?>
        <p class="text-sm text-gray-500 dark:text-gray-400"><?php esc_html_e('Shipping will be calculated based on the selected address.', 'julias-cartoonery'); ?></p>
    <?php endif; ?>

    <?php if (WC()->cart->needs_payment()) : ?>
        <div class="space-y-2">
            <?php foreach (WC()->payment_gateways()->get_available_payment_gateways() as $gateway) : ?>
                <label class="flex items-start gap-3 p-4 border dark:border-slate-700 rounded-2xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <input type="radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> class="mt-1 accent-[#FFB7C5] dark:accent-pink-500" />
                    <span class="flex-1">
                        <span class="block text-sm font-bold text-gray-700 dark:text-gray-300"><?php echo esc_html($gateway->get_title()); ?></span>
                        <?php if ($gateway->description) : ?>
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1"><?php echo wp_kses_post($gateway->description); ?></span>
                        <?php endif; ?>
                    </span>
                </label>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="woocommerce-terms-and-conditions-wrapper text-sm text-gray-500 dark:text-gray-400">
        <?php do_action('woocommerce_checkout_before_terms_and_conditions'); ?>
        <?php wc_get_template('checkout/terms.php'); ?>
        <?php do_action('woocommerce_checkout_after_terms_and_conditions'); ?>
    </div>

    <button type="submit" class="w-full py-4 text-lg bg-[#A8D8EA] dark:bg-sky-500 hover:bg-sky-400 dark:hover:bg-sky-600 text-white rounded-full font-bold transition-colors" id="place_order" name="woocommerce_checkout_place_order" value="<?php esc_attr_e('Place order', 'julias-cartoonery'); ?>">
        <?php esc_html_e('Place Order Now', 'julias-cartoonery'); ?>
    </button>
</div>
