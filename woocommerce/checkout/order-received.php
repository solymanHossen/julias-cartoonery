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
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#B5EAD7]/15 dark:bg-emerald-900/30 text-[#B5EAD7] dark:text-emerald-300 font-bold text-sm uppercase tracking-wider mb-6"><?php esc_html_e('Order complete', 'julias-cartoonery'); ?></span>
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

        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
            <div class="rounded-[28px] border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-4">
                <div class="text-xs font-bold tracking-wider uppercase text-[#A8D8EA] dark:text-sky-300 mb-2"><?php esc_html_e('Receipt', 'julias-cartoonery'); ?></div>
                <div class="font-bold text-gray-800 dark:text-gray-100"><?php echo $order ? esc_html($order->get_order_number()) : esc_html__('Pending', 'julias-cartoonery'); ?></div>
            </div>
            <div class="rounded-[28px] border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-4">
                <div class="text-xs font-bold tracking-wider uppercase text-[#B5EAD7] dark:text-emerald-300 mb-2"><?php esc_html_e('Status', 'julias-cartoonery'); ?></div>
                <div class="font-bold text-gray-800 dark:text-gray-100"><?php echo $order ? esc_html(wc_get_order_status_name($order->get_status())) : esc_html__('Confirmed', 'julias-cartoonery'); ?></div>
            </div>
            <div class="rounded-[28px] border border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-4">
                <div class="text-xs font-bold tracking-wider uppercase text-[#FFB7C5] dark:text-pink-300 mb-2"><?php esc_html_e('Track', 'julias-cartoonery'); ?></div>
                <div class="font-bold text-gray-800 dark:text-gray-100"><?php esc_html_e('My Account', 'julias-cartoonery'); ?></div>
            </div>
        </div>
    </div>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
