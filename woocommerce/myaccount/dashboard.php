<?php
/**
 * Account dashboard.
 */

defined('ABSPATH') || exit;
?>

<div class="space-y-6">
    <div class="bg-white/70 dark:bg-slate-900/40 rounded-[28px] border border-gray-100 dark:border-slate-700 p-5 lg:p-6">
        <h2 class="font-['Bubblegum_Sans'] text-3xl text-gray-800 dark:text-gray-100 mb-2"><?php esc_html_e('Welcome back', 'julias-cartoonery'); ?></h2>
        <p class="text-gray-500 dark:text-gray-400 max-w-2xl"><?php esc_html_e('From here you can review orders, open your wishlist, and update your profile in the same visual system as the store.', 'julias-cartoonery'); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="bg-white dark:bg-slate-800 rounded-[28px] p-5 border border-gray-50 dark:border-slate-700 shadow-sm">
            <div class="text-xs font-bold tracking-wider uppercase text-[#A8D8EA] dark:text-sky-300 mb-2"><?php esc_html_e('Orders', 'julias-cartoonery'); ?></div>
            <div class="text-4xl font-bold text-gray-800 dark:text-gray-100"><?php echo esc_html(function_exists('wc_get_customer_order_count') ? wc_get_customer_order_count(get_current_user_id()) : 0); ?></div>
            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400"><?php esc_html_e('View order history', 'julias-cartoonery'); ?></div>
        </a>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('wishlist')); ?>" class="bg-white dark:bg-slate-800 rounded-[28px] p-5 border border-gray-50 dark:border-slate-700 shadow-sm">
            <div class="text-xs font-bold tracking-wider uppercase text-[#FFB7C5] dark:text-pink-300 mb-2"><?php esc_html_e('Wishlist', 'julias-cartoonery'); ?></div>
            <div class="text-4xl font-bold text-gray-800 dark:text-gray-100"><?php echo esc_html(function_exists('jc_get_wishlist_count') ? jc_get_wishlist_count() : 0); ?></div>
            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400"><?php esc_html_e('Open saved items', 'julias-cartoonery'); ?></div>
        </a>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="bg-white dark:bg-slate-800 rounded-[28px] p-5 border border-gray-50 dark:border-slate-700 shadow-sm">
            <div class="text-xs font-bold tracking-wider uppercase text-[#B5EAD7] dark:text-emerald-300 mb-2"><?php esc_html_e('Profile', 'julias-cartoonery'); ?></div>
            <div class="text-2xl font-bold text-gray-800 dark:text-gray-100 line-clamp-1"><?php echo esc_html(wp_get_current_user()->display_name ?: __('Member', 'julias-cartoonery')); ?></div>
            <div class="mt-2 text-sm text-gray-500 dark:text-gray-400"><?php esc_html_e('Edit account details', 'julias-cartoonery'); ?></div>
        </a>
    </div>
</div>
