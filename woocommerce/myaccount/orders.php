<?php
/**
 * Customer orders.
 */

defined('ABSPATH') || exit;
?>

<div class="space-y-6">
    <div class="bg-white dark:bg-slate-800 rounded-[32px] p-6 lg:p-8 border border-gray-50 dark:border-slate-700 shadow-sm">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="font-['Bubblegum_Sans'] text-3xl text-gray-800 dark:text-gray-100 mb-1"><?php esc_html_e('Orders', 'julias-cartoonery'); ?></h2>
                <p class="text-gray-500 dark:text-gray-400"><?php esc_html_e('Track purchases and revisit order details from this account tab.', 'julias-cartoonery'); ?></p>
            </div>
        </div>

        <?php if (isset($has_orders) && $has_orders) : ?>
            <div class="overflow-hidden rounded-[28px] border border-gray-100 dark:border-slate-700">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 dark:bg-slate-900/40 text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wider">
                            <tr>
                                <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
                                    <th class="px-5 py-4"><?php echo esc_html($column_name); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-700 bg-white dark:bg-slate-800">
                            <?php foreach ($customer_orders->orders as $customer_order) :
                                $order = wc_get_order($customer_order);
                                if (!$order) {
                                    continue;
                                }
                                ?>
                                <tr class="text-gray-700 dark:text-gray-300">
                                    <?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
                                        <td class="px-5 py-4 align-middle">
                                            <?php
                                            if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) {
                                                do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order);
                                            }
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="rounded-[28px] border border-dashed border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/40 p-10 text-center">
                <p class="text-gray-500 dark:text-gray-400 mb-4"><?php esc_html_e('No orders yet. Once you place an order, it will appear here.', 'julias-cartoonery'); ?></p>
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#FFB7C5] text-white font-bold"><?php esc_html_e('Start shopping', 'julias-cartoonery'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>
