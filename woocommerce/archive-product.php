<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="flex flex-col lg:flex-row justify-between items-center mb-8 gap-4">
    <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100">
        <?php woocommerce_page_title(); ?>
    </h1>
    <div class="flex items-center gap-3 bg-white dark:bg-slate-800 px-4 py-2 rounded-full shadow-sm border border-gray-100 dark:border-slate-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
        <?php
        if (woocommerce_product_loop()) {
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            do_action('woocommerce_before_shop_loop');
        }
        ?>
    </div>
</div>

<div class="flex flex-col lg:flex-row gap-8">
    <!-- Sidebar / Categories -->
    <aside class="w-full lg:w-64 shrink-0">
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 sticky top-28">
            <h3 class="font-bold text-lg mb-4 text-gray-800 dark:text-gray-200 border-b dark:border-slate-700 pb-2">Categories</h3>
            <?php
            // Custom category list styled with Tailwind
            $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            ));
            if (!empty($categories) && !is_wp_error($categories)) {
                echo '<ul class="space-y-2">';
                foreach ($categories as $category) {
                    $is_active = is_product_category($category->slug) ? 'bg-[#FFB7C5]/20 dark:bg-pink-500/20 text-[#FFB7C5] dark:text-pink-400 font-bold' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700';
                    echo '<li><a href="' . esc_url(get_term_link($category)) . '" class="block w-full text-left px-3 py-2 rounded-xl transition-colors ' . esc_attr($is_active) . '">' . esc_html($category->name) . '</a></li>';
                }
                echo '</ul>';
            }
            ?>
        </div>
    </aside>

    <!-- Main Loop -->
    <div class="flex-1">
        <?php
        if (woocommerce_product_loop()) {
            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
                echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">';
                while (have_posts()) {
                    the_post();
                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
                echo '</div>';
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
