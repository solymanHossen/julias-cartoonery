<?php
/**
 * Theme Setup
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function jc_theme_setup()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // WooCommerce support
    add_theme_support('woocommerce');

    // HTML5 markup support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Custom Logo support
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Register Navigation Menus
    register_nav_menus(array(
        'primary'  => esc_html__('Primary Menu', 'julias-cartoonery'),
        'footer-1' => esc_html__('Footer Menu - Column 1', 'julias-cartoonery'),
        'footer-2' => esc_html__('Footer Menu - Column 2', 'julias-cartoonery'),
    ));
}
add_action('after_setup_theme', 'jc_theme_setup');

/**
 * Setup default pages on theme activation
 */
function jc_create_default_pages() {
    $pages_to_create = array(
        'Home' => array(
            'content'  => '',
            'template' => 'front-page.php',
            'is_front' => true
        ),
        'My Account' => array(
            'content'  => '[woocommerce_my_account]',
            'template' => '',
            'is_front' => false
        ),
        'Wishlist' => array(
            'content'  => '[jc_wishlist]',
            'template' => 'template-wishlist.php',
            'is_front' => false
        ),
        'Playground' => array(
            'content'  => '',
            'template' => 'template-games.php',
            'is_front' => false
        ),
        'Characters' => array(
            'content'  => '',
            'template' => 'template-characters.php',
            'is_front' => false
        ),
        'Create AI' => array(
            'content'  => '',
            'template' => 'template-create.php',
            'is_front' => false
        )
    );

    foreach ($pages_to_create as $title => $page_data) {
        $page_check = get_page_by_title($title);
        if (!isset($page_check->ID)) {
            $page_id = wp_insert_post(array(
                'post_title'     => $title,
                'post_content'   => $page_data['content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
            ));

            if ($page_id && !is_wp_error($page_id)) {
                if (!empty($page_data['template']) && $page_data['template'] !== 'front-page.php') {
                    update_post_meta($page_id, '_wp_page_template', $page_data['template']);
                }
                if ('My Account' === $title) {
                    update_option('woocommerce_myaccount_page_id', $page_id);
                }
                if ($page_data['is_front']) {
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $page_id);
                }
            }
        } else {
            // Ensure Home page is set as front page even if it exists
            if ('My Account' === $title) {
                update_option('woocommerce_myaccount_page_id', $page_check->ID);
            }
            if ($page_data['is_front']) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_check->ID);
            }
        }
    }
}
add_action('after_switch_theme', 'jc_create_default_pages');

function jc_maybe_create_default_pages() {
    if (get_option('jc_default_pages_initialized')) {
        return;
    }

    jc_create_default_pages();
    update_option('jc_default_pages_initialized', true);
}
add_action('init', 'jc_maybe_create_default_pages');
