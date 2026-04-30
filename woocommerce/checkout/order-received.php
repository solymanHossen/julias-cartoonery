<?php
/**
 * Order received template.
 */

defined('ABSPATH') || exit;

$order_id = isset($order_id) ? absint($order_id) : absint(get_query_var('order-received'));
$order = $order_id ? wc_get_order($order_id) : false;

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="container mx-auto px-4 lg:px-8 py-16">
    <div class="max-w-3xl mx-auto text-center bg-white dark:bg-slate-800 rounded-[40px] p-8 lg:p-12 shadow-sm border border-gray-50 dark:border-slate-700">
        <div class="w-32 h-32 bg-[#B5EAD7] dark:bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-8 text-white shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
        </div>

        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mb-4"><?php esc_html_e('Yay! Order Confirmed!', 'julias-cartoonery'); ?></h1>

        <p class="text-gray-500 dark:text-gray-400 mb-2">
            <?php if ($order) : ?>
                <?php echo esc_html(sprintf(__('Order ID: #%s', 'julias-cartoonery'), $order->get_order_number())); ?>
            <?php else : ?>
                <?php esc_html_e('Your order has been received.', 'julias-cartoonery'); ?>
            <?php endif; ?>
        </p>

        <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto"><?php esc_html_e('We are getting your toys ready. They will be magically delivered to your door soon.', 'julias-cartoonery'); ?></p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#FFB7C5] text-white font-bold">
                <?php esc_html_e('Track Order', 'julias-cartoonery'); ?>
            </a>
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full border-2 border-[#A8D8EA] text-[#A8D8EA] font-bold">
                <?php esc_html_e('Continue Shopping', 'julias-cartoonery'); ?>
            </a>
        </div>
    </div>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
