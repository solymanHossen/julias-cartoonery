<?php
/**
 * Wishlist helpers and AJAX endpoints.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('jc_register_wishlist_endpoint')) {
    function jc_register_wishlist_endpoint() {
        add_rewrite_endpoint('wishlist', EP_ROOT | EP_PAGES);
    }
}
add_action('init', 'jc_register_wishlist_endpoint');

if (!function_exists('jc_maybe_flush_wishlist_endpoint_rules')) {
    function jc_maybe_flush_wishlist_endpoint_rules() {
        if (get_option('jc_wishlist_rewrite_flushed')) {
            return;
        }

        flush_rewrite_rules(false);
        update_option('jc_wishlist_rewrite_flushed', true);
    }
}
add_action('init', 'jc_maybe_flush_wishlist_endpoint_rules', 20);

if (!function_exists('jc_account_menu_items')) {
    function jc_account_menu_items($items) {
        $ordered = array();

        if (isset($items['dashboard'])) {
            $ordered['dashboard'] = __('Dashboard', 'julias-cartoonery');
        }

        if (isset($items['orders'])) {
            $order_count = function_exists('wc_get_customer_order_count') ? wc_get_customer_order_count(get_current_user_id()) : 0;
            $ordered['orders'] = sprintf('%s <span class="jc-account-badge">%d</span>', __('Orders', 'julias-cartoonery'), absint($order_count));
        }

        $ordered['wishlist'] = sprintf('%s <span class="jc-account-badge">%d</span>', __('Wishlist', 'julias-cartoonery'), absint(jc_get_wishlist_count()));

        if (isset($items['edit-account'])) {
            $ordered['edit-account'] = __('Profile', 'julias-cartoonery');
        }

        if (isset($items['customer-logout'])) {
            $ordered['customer-logout'] = __('Logout', 'julias-cartoonery');
        }

        return $ordered;
    }
}
add_filter('woocommerce_account_menu_items', 'jc_account_menu_items');

if (!function_exists('jc_account_wishlist_endpoint')) {
    function jc_account_wishlist_endpoint() {
        echo '<div class="jc-account-section">';
        echo jc_render_wishlist_items_html();
        echo '</div>';
    }
}
add_action('woocommerce_account_wishlist_endpoint', 'jc_account_wishlist_endpoint');

if (!function_exists('jc_get_wishlist_ids')) {
    function jc_get_wishlist_ids($user_id = 0) {
        $user_id = $user_id ? absint($user_id) : get_current_user_id();

        if (!$user_id) {
            return array();
        }

        $wishlist = get_user_meta($user_id, '_jc_wishlist', true);

        if (!is_array($wishlist)) {
            return array();
        }

        return array_values(array_filter(array_map('absint', $wishlist)));
    }
}

if (!function_exists('jc_save_wishlist_ids')) {
    function jc_save_wishlist_ids($wishlist_ids, $user_id = 0) {
        $user_id = $user_id ? absint($user_id) : get_current_user_id();

        if (!$user_id) {
            return false;
        }

        $wishlist_ids = array_values(array_unique(array_filter(array_map('absint', (array) $wishlist_ids))));

        update_user_meta($user_id, '_jc_wishlist', $wishlist_ids);

        return $wishlist_ids;
    }
}

if (!function_exists('jc_get_wishlist_count')) {
    function jc_get_wishlist_count($user_id = 0) {
        return count(jc_get_wishlist_ids($user_id));
    }
}

if (!function_exists('jc_is_product_in_wishlist')) {
    function jc_is_product_in_wishlist($product_id, $user_id = 0) {
        return in_array(absint($product_id), jc_get_wishlist_ids($user_id), true);
    }
}

if (!function_exists('jc_get_wishlist_button_html')) {
    function jc_get_wishlist_button_html($product_id, $class = '', $button_size = 18) {
        $product_id = absint($product_id);
        $in_wishlist = jc_is_product_in_wishlist($product_id);
        $account_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url();

        $classes = trim('js-jc-wishlist-toggle absolute top-3 right-3 p-2 bg-white/85 dark:bg-slate-800/85 backdrop-blur rounded-full shadow-md transition-colors z-10 ' . ($in_wishlist ? 'text-[#FFB7C5] dark:text-pink-400' : 'text-gray-400 dark:text-gray-300 hover:text-[#FFB7C5] dark:hover:text-pink-400') . ' ' . $class);

        return sprintf(
            '<button type="button" data-jc-wishlist-toggle data-product-id="%1$d" data-jc-in-wishlist="%2$d" data-jc-auth-url="%3$s" class="%4$s" onclick="event.stopPropagation();" aria-label="%5$s" aria-pressed="%6$s"><svg xmlns="http://www.w3.org/2000/svg" width="%7$d" height="%7$d" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg></button>',
            $product_id,
            $in_wishlist ? 1 : 0,
            esc_url($account_url),
            esc_attr($classes),
            esc_attr($in_wishlist ? __('Remove from wishlist', 'julias-cartoonery') : __('Add to wishlist', 'julias-cartoonery')),
            $in_wishlist ? 'true' : 'false',
            absint($button_size)
        );
    }
}

if (!function_exists('jc_render_wishlist_items_html')) {
    function jc_render_wishlist_items_html($user_id = 0) {
        if (!is_user_logged_in()) {
            return '';
        }

        $wishlist_ids = jc_get_wishlist_ids($user_id);

        ob_start();

        if (empty($wishlist_ids)) {
            ?>
            <div class="bg-white dark:bg-slate-800 rounded-[32px] p-10 text-center border border-gray-50 dark:border-slate-700">
                <h2 class="font-['Bubblegum_Sans'] text-3xl text-gray-800 dark:text-gray-100 mb-3"><?php esc_html_e('Your wishlist is empty', 'julias-cartoonery'); ?></h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6"><?php esc_html_e('Save your favorite toys here so you can come back later.', 'julias-cartoonery'); ?></p>
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#FFB7C5] text-white font-bold"><?php esc_html_e('Browse the shop', 'julias-cartoonery'); ?></a>
            </div>
            <?php
        } else {
            echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">';

            foreach ($wishlist_ids as $product_id) {
                $product = wc_get_product($product_id);

                if (!$product || !$product->exists()) {
                    continue;
                }

                echo '<div class="bg-white dark:bg-slate-800 rounded-3xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] border border-gray-50 dark:border-slate-700 flex gap-4 items-center">';
                echo '<a href="' . esc_url(get_permalink($product_id)) . '" class="shrink-0">' . jc_get_product_thumbnail_html($product_id, 'woocommerce_thumbnail', 'w-24 h-24 rounded-2xl object-cover bg-gray-50 dark:bg-slate-700 mix-blend-multiply dark:mix-blend-normal') . '</a>';
                echo '<div class="flex-1 min-w-0">';
                echo '<a href="' . esc_url(get_permalink($product_id)) . '" class="block font-bold text-gray-800 dark:text-gray-100 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors line-clamp-1">' . esc_html($product->get_name()) . '</a>';
                echo '<div class="mt-1 text-[#FFB7C5] dark:text-pink-400 font-bold">' . wp_kses_post($product->get_price_html()) . '</div>';
                echo '<div class="mt-3 flex flex-wrap items-center gap-3">';
                echo '<button type="button" data-jc-add-to-cart data-product-id="' . esc_attr($product_id) . '" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-[#A8D8EA] dark:bg-sky-500 text-white font-bold text-sm hover:bg-sky-400 dark:hover:bg-sky-600 transition-colors">' . esc_html__('Add to cart', 'julias-cartoonery') . '</button>';
                echo '<button type="button" data-jc-wishlist-toggle data-product-id="' . esc_attr($product_id) . '" data-jc-in-wishlist="1" data-jc-auth-url="' . esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url()) . '" class="inline-flex items-center justify-center px-4 py-2 rounded-full border border-[#FFB7C5] text-[#FFB7C5] dark:text-pink-300 font-bold text-sm hover:bg-[#FFB7C5] hover:text-white transition-colors" onclick="event.stopPropagation();" aria-label="' . esc_attr__('Remove from wishlist', 'julias-cartoonery') . '">' . esc_html__('Remove', 'julias-cartoonery') . '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }

        return ob_get_clean();
    }
}

if (!function_exists('jc_render_wishlist_shortcode')) {
    function jc_render_wishlist_shortcode() {
        ob_start();
        ?>
        <div class="space-y-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FFB7C5]/10 dark:bg-pink-500/20 text-[#FFB7C5] dark:text-pink-300 font-bold text-sm uppercase tracking-wider"><?php esc_html_e('Saved Favorites', 'julias-cartoonery'); ?></span>
                <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mt-4 mb-3"><?php esc_html_e('Wishlist', 'julias-cartoonery'); ?></h1>
                <p class="text-gray-500 dark:text-gray-400 max-w-2xl"><?php esc_html_e('Keep track of the toys you want to revisit, then move them to the cart when you are ready.', 'julias-cartoonery'); ?></p>
            </div>

            <?php if (!is_user_logged_in()) : ?>
                <div class="bg-white dark:bg-slate-800 rounded-[32px] p-10 text-center border border-gray-50 dark:border-slate-700">
                    <h2 class="font-['Bubblegum_Sans'] text-3xl text-gray-800 dark:text-gray-100 mb-3"><?php esc_html_e('Sign in to save favorites', 'julias-cartoonery'); ?></h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-6"><?php esc_html_e('Wishlist items are stored on your account so they stay available across devices.', 'julias-cartoonery'); ?></p>
                    <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url()); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-[#FFB7C5] text-white font-bold"><?php esc_html_e('Sign in or register', 'julias-cartoonery'); ?></a>
                </div>
            <?php else : ?>
                <div id="jc-wishlist-items">
                    <?php echo jc_render_wishlist_items_html(); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

add_shortcode('jc_wishlist', 'jc_render_wishlist_shortcode');

if (!function_exists('jc_ajax_toggle_wishlist')) {
    function jc_ajax_toggle_wishlist() {
        check_ajax_referer('jc_wishlist_nonce', 'nonce');

        if (!is_user_logged_in()) {
            wp_send_json_error(array(
                'message' => __('Please sign in to save wishlist items.', 'julias-cartoonery'),
                'login_url' => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url(),
            ), 401);
        }

        $product_id = isset($_POST['product_id']) ? absint(wp_unslash($_POST['product_id'])) : 0;

        if (!$product_id || !wc_get_product($product_id)) {
            wp_send_json_error(array('message' => __('Invalid product.', 'julias-cartoonery')));
        }

        $wishlist_ids = jc_get_wishlist_ids();

        if (in_array($product_id, $wishlist_ids, true)) {
            $wishlist_ids = array_values(array_diff($wishlist_ids, array($product_id)));
            $in_wishlist = false;
        } else {
            $wishlist_ids[] = $product_id;
            $wishlist_ids = array_values(array_unique($wishlist_ids));
            $in_wishlist = true;
        }

        jc_save_wishlist_ids($wishlist_ids);

        wp_send_json_success(array(
            'product_id'     => $product_id,
            'in_wishlist'    => $in_wishlist,
            'wishlist_count'  => count($wishlist_ids),
            'wishlist_items' => jc_render_wishlist_items_html(),
        ));
    }
}

add_action('wp_ajax_jc_toggle_wishlist', 'jc_ajax_toggle_wishlist');
add_action('wp_ajax_nopriv_jc_toggle_wishlist', 'jc_ajax_toggle_wishlist');