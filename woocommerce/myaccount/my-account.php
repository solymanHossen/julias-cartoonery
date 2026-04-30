<?php
/**
 * My account template.
 */

defined('ABSPATH') || exit;

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="container mx-auto px-4 lg:px-8 py-12">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-[18rem_minmax(0,1fr)] gap-8 items-start">
            <aside class="bg-white dark:bg-slate-800 rounded-[32px] p-4 lg:p-5 border border-gray-50 dark:border-slate-700 shadow-sm sticky top-28">
                <?php do_action('woocommerce_account_navigation'); ?>
            </aside>
            <section class="space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 border border-gray-50 dark:border-slate-700 shadow-sm">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#B5EAD7]/15 dark:bg-emerald-900/30 text-[#B5EAD7] dark:text-emerald-300 font-bold text-sm uppercase tracking-wider"><?php esc_html_e('Account Center', 'julias-cartoonery'); ?></span>
                    <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mt-4 mb-3"><?php esc_html_e('My Account', 'julias-cartoonery'); ?></h1>
                    <p class="text-gray-500 dark:text-gray-400 max-w-2xl"><?php esc_html_e('Use the same layout across orders, wishlist, and profile so the account area feels like part of the store.', 'julias-cartoonery'); ?></p>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 border border-gray-50 dark:border-slate-700 shadow-sm">
                    <?php do_action('woocommerce_account_content'); ?>
                </div>
            </section>
        </div>
    </div>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
