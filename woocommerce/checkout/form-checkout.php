<?php
/**
 * Custom checkout form.
 */

defined('ABSPATH') || exit;

$checkout = WC()->checkout();

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="max-w-3xl mx-auto text-center mb-12">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#A8D8EA]/15 dark:bg-sky-900/30 text-[#A8D8EA] dark:text-sky-300 font-bold text-sm uppercase tracking-wider"><?php esc_html_e('Secure checkout', 'julias-cartoonery'); ?></span>
        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mt-4 mb-4"><?php esc_html_e('Checkout Details', 'julias-cartoonery'); ?></h1>
        <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto"><?php esc_html_e('Complete your delivery details and payment securely.', 'julias-cartoonery'); ?></p>
    </div>

    <?php if (!WC()->cart->is_empty()) : ?>
        <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex-[2] space-y-6">
                    <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 shadow-sm border border-gray-50 dark:border-slate-700">
                        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 mb-6"><?php esc_html_e('Billing Details', 'julias-cartoonery'); ?></h2>
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 shadow-sm border border-gray-50 dark:border-slate-700">
                        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 mb-6"><?php esc_html_e('Shipping Address', 'julias-cartoonery'); ?></h2>
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>

                    <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 shadow-sm border border-gray-50 dark:border-slate-700">
                        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 mb-6"><?php esc_html_e('Order Notes', 'julias-cartoonery'); ?></h2>
                        <?php do_action('woocommerce_before_order_notes', $checkout); ?>
                        <?php
                        $order_fields = $checkout->get_checkout_fields('order');
                        if (isset($order_fields['order_comments'])) {
                            woocommerce_form_field('order_comments', $order_fields['order_comments'], $checkout->get_value('order_comments'));
                        }
                        ?>
                        <?php do_action('woocommerce_after_order_notes', $checkout); ?>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 shadow-sm border border-gray-50 dark:border-slate-700 sticky top-28 space-y-6">
                        <div class="rounded-[28px] border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-4 flex items-center justify-between gap-4">
                            <div>
                                <div class="text-xs font-bold tracking-wider uppercase text-[#A8D8EA] dark:text-sky-300"><?php esc_html_e('Step 1', 'julias-cartoonery'); ?></div>
                                <div class="font-bold text-gray-800 dark:text-gray-100"><?php esc_html_e('Review your order', 'julias-cartoonery'); ?></div>
                            </div>
                            <div>
                                <div class="text-xs font-bold tracking-wider uppercase text-[#B5EAD7] dark:text-emerald-300"><?php esc_html_e('Step 2', 'julias-cartoonery'); ?></div>
                                <div class="font-bold text-gray-800 dark:text-gray-100"><?php esc_html_e('Confirm payment', 'julias-cartoonery'); ?></div>
                            </div>
                        </div>
                        <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 mb-6"><?php esc_html_e('Order Summary', 'julias-cartoonery'); ?></h2>
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>
                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>
                        <div class="mt-8">
                            <?php do_action('woocommerce_checkout_before_payment'); ?>
                            <div class="rounded-[28px] border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-5">
                                <?php do_action('woocommerce_checkout_payment'); ?>
                            </div>
                            <?php do_action('woocommerce_checkout_after_payment'); ?>
                        </div>
                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                    </div>
                </div>
            </div>
        </form>

        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    <?php else : ?>
        <div class="max-w-xl mx-auto text-center bg-white dark:bg-slate-800 rounded-[32px] p-10 shadow-sm border border-gray-50 dark:border-slate-700">
            <p class="text-gray-500 dark:text-gray-400 mb-6"><?php esc_html_e('Your cart is empty.', 'julias-cartoonery'); ?></p>
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#FFB7C5] text-white font-bold">
                <?php esc_html_e('Continue Shopping', 'julias-cartoonery'); ?>
            </a>
        </div>
    <?php endif; ?>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
