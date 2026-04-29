<?php
/**
 * Register Custom Post Types and Taxonomies
 */

if (!defined('ABSPATH')) {
    exit;
}

function julias_cartoonery_register_cpts() {
    // 1. Stories (Rupkothar Gollpo)
    $story_labels = array(
        'name'               => _x('Stories', 'post type general name', 'julias-cartoonery'),
        'singular_name'      => _x('Story', 'post type singular name', 'julias-cartoonery'),
        'menu_name'          => _x('Stories', 'admin menu', 'julias-cartoonery'),
        'name_admin_bar'     => _x('Story', 'add new on admin bar', 'julias-cartoonery'),
        'add_new'            => _x('Add New', 'story', 'julias-cartoonery'),
        'add_new_item'       => __('Add New Story', 'julias-cartoonery'),
        'new_item'           => __('New Story', 'julias-cartoonery'),
        'edit_item'          => __('Edit Story', 'julias-cartoonery'),
        'view_item'          => __('View Story', 'julias-cartoonery'),
        'all_items'          => __('All Stories', 'julias-cartoonery'),
        'search_items'       => __('Search Stories', 'julias-cartoonery'),
        'parent_item_colon'  => __('Parent Stories:', 'julias-cartoonery'),
        'not_found'          => __('No stories found.', 'julias-cartoonery'),
        'not_found_in_trash' => __('No stories found in Trash.', 'julias-cartoonery')
    );

    $story_args = array(
        'labels'             => $story_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'story'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // Gutenberg support
    );
    register_post_type('story', $story_args);

    // Story Category Taxonomy
    register_taxonomy('story_category', array('story'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Story Categories', 'taxonomy general name', 'julias-cartoonery'),
            'singular_name'     => _x('Story Category', 'taxonomy singular name', 'julias-cartoonery'),
            'search_items'      => __('Search Story Categories', 'julias-cartoonery'),
            'all_items'         => __('All Story Categories', 'julias-cartoonery'),
            'parent_item'       => __('Parent Story Category', 'julias-cartoonery'),
            'parent_item_colon' => __('Parent Story Category:', 'julias-cartoonery'),
            'edit_item'         => __('Edit Story Category', 'julias-cartoonery'),
            'update_item'       => __('Update Story Category', 'julias-cartoonery'),
            'add_new_item'      => __('Add New Story Category', 'julias-cartoonery'),
            'new_item_name'     => __('New Story Category Name', 'julias-cartoonery'),
            'menu_name'         => __('Story Category', 'julias-cartoonery'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'story-category'),
        'show_in_rest'      => true,
    ));

    // 2. Videos (Julia's Channel)
    $video_labels = array(
        'name'               => _x('Videos', 'post type general name', 'julias-cartoonery'),
        'singular_name'      => _x('Video', 'post type singular name', 'julias-cartoonery'),
        'menu_name'          => _x('Videos', 'admin menu', 'julias-cartoonery'),
        'add_new'            => _x('Add New', 'video', 'julias-cartoonery'),
        'add_new_item'       => __('Add New Video', 'julias-cartoonery'),
        'edit_item'          => __('Edit Video', 'julias-cartoonery'),
        'view_item'          => __('View Video', 'julias-cartoonery'),
    );
    register_post_type('video', array(
        'labels'             => $video_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'rewrite'            => array('slug' => 'video'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-video-alt3',
        'supports'           => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    ));

    // Video Type Taxonomy (Long/Short)
    register_taxonomy('video_type', array('video'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'              => _x('Video Types', 'taxonomy general name', 'julias-cartoonery'),
            'singular_name'     => _x('Video Type', 'taxonomy singular name', 'julias-cartoonery'),
            'menu_name'         => __('Video Types', 'julias-cartoonery'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
    ));

    // 3. Characters
    $character_labels = array(
        'name'               => _x('Characters', 'post type general name', 'julias-cartoonery'),
        'singular_name'      => _x('Character', 'post type singular name', 'julias-cartoonery'),
        'menu_name'          => _x('Characters', 'admin menu', 'julias-cartoonery'),
        'add_new'            => _x('Add New', 'character', 'julias-cartoonery'),
        'add_new_item'       => __('Add New Character', 'julias-cartoonery'),
    );
    register_post_type('character', array(
        'labels'             => $character_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'rewrite'            => array('slug' => 'characters-gallery'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
    ));
}
add_action('init', 'julias_cartoonery_register_cpts');
