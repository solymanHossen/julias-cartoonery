<?php
/**
 * The template for displaying the cart page.
 */

defined('ABSPATH') || exit;

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="container mx-auto px-4 lg:px-8 py-10 animate-in fade-in">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-4 mb-8">
        <div>
            <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100"><?php esc_html_e('Shopping Cart', 'julias-cartoonery'); ?></h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2"><?php esc_html_e('Review your items and update quantities without reloading.', 'julias-cartoonery'); ?></p>
        </div>
    </div>

    <?php do_action('woocommerce_before_cart'); ?>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-[2] space-y-4" id="jc-cart-items">
            <?php echo jc_render_cart_items_html(); ?>
        </div>

        <div class="flex-1" id="jc-cart-summary">
            <?php echo jc_render_cart_summary_html(); ?>
        </div>
    </div>

    <?php do_action('woocommerce_after_cart'); ?>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');
