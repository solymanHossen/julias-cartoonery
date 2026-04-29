<?php
/**
 * Julia's Cartoonery functions and definitions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Require theme setup and configuration files
$theme_includes = [
    '/inc/setup.php',
    '/inc/enqueue.php',
];

foreach ($theme_includes as $file) {
    $filepath = get_template_directory() . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}