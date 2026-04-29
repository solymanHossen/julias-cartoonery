<?php
/**
 * One Click Demo Import Setup
 */

if (!defined('ABSPATH')) {
    exit;
}

function jc_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'Julia\'s Cartoonery Default Demo',
            'categories'                   => array( 'Kids', 'eCommerce' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-data/content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-data/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-data/customizer.dat',
            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
            'import_notice'                => __( 'After you import this demo, you will have to setup the permalinks and ensure WooCommerce pages are generated.', 'julias-cartoonery' ),
            'preview_url'                  => 'https://example.com/julias-cartoonery',
        ),
    );
}
add_filter( 'ocdi/import_files', 'jc_ocdi_import_files' );

function jc_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    $footer_menu  = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $primary_menu ? $primary_menu->term_id : '',
            'footer'  => $footer_menu ? $footer_menu->term_id : '',
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Parenting & Play' );

    update_option( 'show_on_front', 'page' );
    if ( $front_page_id ) {
        update_option( 'page_on_front', $front_page_id->ID );
    }
    if ( $blog_page_id ) {
        update_option( 'page_for_posts', $blog_page_id->ID );
    }
}
add_action( 'ocdi/after_import', 'jc_ocdi_after_import_setup' );

/**
 * Filter OCDI plugin page setup to hide certain things if desired, 
 * or just use default.
 */
add_filter( 'ocdi/disable_pt_branding', '__return_true' );
