<?php
/**
 * Theme admin dashboard.
 */

if (!defined('ABSPATH')) {
    exit;
}

function jc_register_admin_dashboard() {
    add_menu_page(
        __('Cartoonery Dashboard', 'julias-cartoonery'),
        __('Cartoonery', 'julias-cartoonery'),
        'manage_options',
        'jc-dashboard',
        'jc_render_admin_dashboard',
        'dashicons-star-filled',
        3
    );
}
add_action('admin_menu', 'jc_register_admin_dashboard');

function jc_count_posts_by_type($post_type) {
    $counts = wp_count_posts($post_type);

    return array(
        'publish' => isset($counts->publish) ? (int) $counts->publish : 0,
        'draft'   => isset($counts->draft) ? (int) $counts->draft : 0,
        'total'   => array_sum(get_object_vars($counts)),
    );
}

function jc_render_admin_dashboard() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'julias-cartoonery'));
    }

    $seed_url = wp_nonce_url(admin_url('admin-post.php?action=jc_seed_data'), 'jc_seed_data_nonce');
    $shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop');
    $dashboard_cards = array(
        array('label' => __('Products', 'julias-cartoonery'), 'count' => jc_count_posts_by_type('product')['publish'], 'url' => admin_url('edit.php?post_type=product')),
        array('label' => __('Videos', 'julias-cartoonery'), 'count' => jc_count_posts_by_type('video')['publish'], 'url' => admin_url('edit.php?post_type=video')),
        array('label' => __('Stories', 'julias-cartoonery'), 'count' => jc_count_posts_by_type('story')['publish'], 'url' => admin_url('edit.php?post_type=story')),
        array('label' => __('Characters', 'julias-cartoonery'), 'count' => jc_count_posts_by_type('character')['publish'], 'url' => admin_url('edit.php?post_type=character')),
    );
    ?>
    <div class="wrap">
        <h1 style="font-size:32px; line-height:1.2; font-weight:800; margin:18px 0 12px;"><?php esc_html_e('Julia\'s Cartoonery Dashboard', 'julias-cartoonery'); ?></h1>
        <p style="font-size:15px; color:#5f6b7a; max-width:760px; margin-bottom:24px;"><?php esc_html_e('Manage content, seed demo data, and jump into the live storefront from one control panel.', 'julias-cartoonery'); ?></p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px; margin-bottom:24px;">
            <?php foreach ($dashboard_cards as $card) : ?>
                <a href="<?php echo esc_url($card['url']); ?>" style="display:block; background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:20px; text-decoration:none; box-shadow:0 10px 30px rgba(15,23,42,.06);">
                    <div style="font-size:13px; color:#64748b; font-weight:700; text-transform:uppercase; letter-spacing:.08em; margin-bottom:12px;"><?php echo esc_html($card['label']); ?></div>
                    <div style="font-size:40px; line-height:1; font-weight:800; color:#ff7fa1;"><?php echo esc_html($card['count']); ?></div>
                </a>
            <?php endforeach; ?>
        </div>

        <div style="display:grid; grid-template-columns:2fr 1fr; gap:16px; align-items:start;">
            <div style="background:#fff; border:1px solid #e5e7eb; border-radius:20px; padding:24px; box-shadow:0 10px 30px rgba(15,23,42,.06);">
                <h2 style="margin-top:0; font-size:20px; font-weight:800;"><?php esc_html_e('Quick Actions', 'julias-cartoonery'); ?></h2>
                <p style="color:#64748b; margin-bottom:20px;"><?php esc_html_e('Use the buttons below to populate or inspect the site quickly.', 'julias-cartoonery'); ?></p>
                <div style="display:flex; flex-wrap:wrap; gap:12px;">
                    <a href="<?php echo esc_url($seed_url); ?>" class="button button-primary"><?php esc_html_e('Seed Demo Data', 'julias-cartoonery'); ?></a>
                    <a href="<?php echo esc_url($shop_url); ?>" class="button" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Open Shop', 'julias-cartoonery'); ?></a>
                    <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button"><?php esc_html_e('Open Customizer', 'julias-cartoonery'); ?></a>
                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>" class="button"><?php esc_html_e('Manage Products', 'julias-cartoonery'); ?></a>
                </div>
            </div>

            <div style="background:linear-gradient(180deg,#ffb7c5 0%, #a8d8ea 100%); border-radius:20px; padding:24px; color:#fff; box-shadow:0 10px 30px rgba(15,23,42,.08);">
                <h2 style="margin-top:0; font-size:20px; font-weight:800; color:#fff;"><?php esc_html_e('Theme Health', 'julias-cartoonery'); ?></h2>
                <ul style="margin:0; padding-left:18px; line-height:1.8;">
                    <li><?php esc_html_e('WooCommerce templates are overridden.', 'julias-cartoonery'); ?></li>
                    <li><?php esc_html_e('AJAX cart actions are enabled.', 'julias-cartoonery'); ?></li>
                    <li><?php esc_html_e('Fonts are loaded through WordPress enqueue.', 'julias-cartoonery'); ?></li>
                    <li><?php esc_html_e('Seed data can be regenerated from the dashboard.', 'julias-cartoonery'); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
