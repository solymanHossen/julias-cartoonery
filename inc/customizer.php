<?php
/**
 * Julia's Cartoonery Theme Customizer
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register customizer settings and controls
 */
function jc_customize_register($wp_customize) {
    // Theme Colors Section
    $wp_customize->add_section('jc_colors_section', array(
        'title'       => __('Theme Colors', 'julias-cartoonery'),
        'description' => __('Customize the primary colors used throughout the theme.', 'julias-cartoonery'),
        'priority'    => 30,
    ));

    $colors = array(
        'jc_color_pink'   => array('default' => '#FFB7C5', 'label' => __('Pink (Primary)', 'julias-cartoonery')),
        'jc_color_blue'   => array('default' => '#A8D8EA', 'label' => __('Blue (Secondary)', 'julias-cartoonery')),
        'jc_color_green'  => array('default' => '#B5EAD7', 'label' => __('Green (Accent)', 'julias-cartoonery')),
        'jc_color_yellow' => array('default' => '#FFDAC1', 'label' => __('Yellow (Highlight)', 'julias-cartoonery')),
    );

    foreach ($colors as $id => $data) {
        $wp_customize->add_setting($id, array(
            'default'           => $data['default'],
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, array(
            'label'    => $data['label'],
            'section'  => 'jc_colors_section',
            'settings' => $id,
        )));
    }

    // Header & Footer Section
    $wp_customize->add_section('jc_header_footer_section', array(
        'title'    => __('Header & Footer', 'julias-cartoonery'),
        'priority' => 35,
    ));

    $wp_customize->add_setting('jc_copyright_text', array(
        'default'           => '© 2026 Julia\'s Cartoonery. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('jc_copyright_text', array(
        'label'   => __('Copyright Text', 'julias-cartoonery'),
        'section' => 'jc_header_footer_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('jc_social_youtube', array(
        'default'           => 'https://youtube.com',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('jc_social_youtube', array(
        'label'   => __('YouTube Link', 'julias-cartoonery'),
        'section' => 'jc_header_footer_section',
        'type'    => 'url',
    ));

    // General Settings Section
    $wp_customize->add_section('jc_general_section', array(
        'title'    => __('General Settings', 'julias-cartoonery'),
        'priority' => 25,
    ));

    $wp_customize->add_setting('jc_enable_bedtime_mode', array(
        'default'           => true,
        'sanitize_callback' => 'jc_sanitize_checkbox',
    ));
    $wp_customize->add_control('jc_enable_bedtime_mode', array(
        'label'       => __('Enable Bedtime Mode (Dark Mode)', 'julias-cartoonery'),
        'description' => __('If disabled, the theme will stay in light mode globally.', 'julias-cartoonery'),
        'section'     => 'jc_general_section',
        'type'        => 'checkbox',
    ));
}
add_action('customize_register', 'jc_customize_register');

/**
 * Sanitize Checkbox
 */
function jc_sanitize_checkbox($checked) {
    return (isset($checked) && $checked == true) ? true : false;
}

/**
 * Output Dynamic CSS for Customizer Colors
 */
function jc_customizer_css() {
    $pink   = get_theme_mod('jc_color_pink', '#FFB7C5');
    $blue   = get_theme_mod('jc_color_blue', '#A8D8EA');
    $green  = get_theme_mod('jc_color_green', '#B5EAD7');
    $yellow = get_theme_mod('jc_color_yellow', '#FFDAC1');
    ?>
    <style type="text/css">
        :root {
            --theme-pink: <?php echo sanitize_hex_color($pink); ?>;
            --theme-blue: <?php echo sanitize_hex_color($blue); ?>;
            --theme-green: <?php echo sanitize_hex_color($green); ?>;
            --theme-yellow: <?php echo sanitize_hex_color($yellow); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'jc_customizer_css');
