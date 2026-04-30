<?php
/**
 * Dynamic Content Seeder
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display Admin Notice with Seeder Button
 */
function jc_seeder_admin_notice() {
    // Only show to admins who can manage options
    if (!current_user_can('manage_options')) {
        return;
    }

    // Don't show if already seeded
    if (get_option('jc_data_seeded')) {
        return;
    }

    $seed_url = wp_nonce_url(admin_url('admin-post.php?action=jc_seed_data'), 'jc_seed_data_nonce');

    if (isset($_GET['jc_seed_success'])) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__('Success!', 'julias-cartoonery') . '</strong> ' . esc_html__('Mock data has been successfully seeded.', 'julias-cartoonery') . '</p></div>';
        return;
    }

    echo '<div class="notice notice-info" style="padding-bottom: 15px;">';
    echo '<p><strong>' . esc_html__('Julia\'s Cartoonery - Theme Activated!', 'julias-cartoonery') . '</strong></p>';
    echo '<p>' . esc_html__('To see the theme in action immediately, you can populate your site with sample data (Toys, Videos, Stories, Characters).', 'julias-cartoonery') . '</p>';
    
    if (!class_exists('WooCommerce')) {
        echo '<p style="color: red;"><strong>' . esc_html__('Note:', 'julias-cartoonery') . '</strong> ' . esc_html__('WooCommerce is not active. Toy products will NOT be seeded. Please activate WooCommerce first if you want products.', 'julias-cartoonery') . '</p>';
    }

    echo '<p><a href="' . esc_url($seed_url) . '" class="button button-primary">' . esc_html__('Seed Mock Data', 'julias-cartoonery') . '</a></p>';
    echo '</div>';
}
add_action('admin_notices', 'jc_seeder_admin_notice');

/**
 * Handle Seeder Action
 */
function jc_handle_seed_data() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have permission to do this.', 'julias-cartoonery'));
    }

    check_admin_referer('jc_seed_data_nonce');

    if (get_option('jc_data_seeded')) {
        wp_redirect(admin_url('themes.php'));
        exit;
    }

    // Run seeding logic
    jc_seed_posts();
    jc_seed_stories();
    jc_seed_characters();
    jc_seed_videos();
    
    if (class_exists('WooCommerce')) {
        jc_seed_products();
    }

    // Mark as seeded
    update_option('jc_data_seeded', true);

    wp_redirect(add_query_arg('jc_seed_success', '1', admin_url('themes.php')));
    exit;
}
add_action('admin_post_jc_seed_data', 'jc_handle_seed_data');

/**
 * Seed WooCommerce Products
 */
function jc_seed_products() {
    $products = array(
        array(
            'name' => 'Cuddly Bear Ollie',
            'price' => '24.99',
            'desc' => 'The softest, most huggable companion for your little one.',
            'cat' => 'Soft Toys'
        ),
        array(
            'name' => 'Sleepy Bunny Plush',
            'price' => '21.00',
            'desc' => 'A pastel bedtime bunny made for cozy hugs and naps.',
            'cat' => 'Soft Toys'
        ),
        array(
            'name' => 'Rainbow Stacking Rings',
            'price' => '15.50',
            'desc' => 'A classic educational toy that develops fine motor skills and color recognition.',
            'cat' => 'Educational'
        ),
        array(
            'name' => 'Alphabet Blocks',
            'price' => '18.00',
            'desc' => 'Wooden blocks with friendly letters for early learning.',
            'cat' => 'Educational'
        ),
        array(
            'name' => 'Wooden Train Set',
            'price' => '45.00',
            'desc' => 'Beautifully crafted wooden train set for endless imaginative adventures.',
            'cat' => 'Vehicles'
        ),
        array(
            'name' => 'Musical Xylophone',
            'price' => '22.00',
            'desc' => 'Introduce your child to the world of music with this colorful xylophone.',
            'cat' => 'Musical'
        ),
        array(
            'name' => 'Pastel Teether Set',
            'price' => '12.99',
            'desc' => 'Gentle silicone teethers in soft baby-friendly colors.',
            'cat' => 'Teethers'
        )
    );

    foreach ($products as $prod_data) {
        $product = new WC_Product_Simple();
        $product->set_name($prod_data['name']);
        $product->set_regular_price($prod_data['price']);
        $product->set_description($prod_data['desc']);
        $product->set_short_description($prod_data['desc']);
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        
        $product_id = $product->save();

        // Assign category
        wp_set_object_terms($product_id, $prod_data['cat'], 'product_cat', true);
    }
}

/**
 * Seed Videos
 */
function jc_seed_videos() {
    $long_videos = array(
        'Learn the Alphabet with Animals',
        'Counting to 10 in Space',
        'The Colors of the Rainbow',
        'Morning Songs with Ollie',
        'Bedtime Stories for Little Dreamers'
    );
    
    foreach ($long_videos as $title) {
        $post_id = wp_insert_post(array(
            'post_title' => $title,
            'post_content' => 'Watch this amazing educational video! <br/> [youtube url="https://youtube.com"]',
            'post_status' => 'publish',
            'post_type' => 'video'
        ));
        wp_set_object_terms($post_id, 'long', 'video_type');
    }

    $short_videos = array(
        'Funny Cat Dance',
        'Quick Magic Trick',
        'Learn to Draw a Star',
        'Sing a ABC Song',
        'Make a Paper Boat',
        'Guess the Animal Sound',
        'Five Colors in Five Seconds',
        'Tiny Dance Break'
    );

    foreach ($short_videos as $title) {
        $post_id = wp_insert_post(array(
            'post_title' => $title,
            'post_content' => 'A quick fun short! <br/> [youtube url="https://youtube.com"]',
            'post_status' => 'publish',
            'post_type' => 'video'
        ));
        wp_set_object_terms($post_id, 'short', 'video_type');
    }
}

/**
 * Seed Stories
 */
function jc_seed_stories() {
    $stories = array(
        'The Brave Little Star',
        'Oliver\'s Magic Garden',
        'The Whispering Woods',
        'A Journey to the Moon',
        'The Little Blue Cloud',
        'Pip and the Rainy Day'
    );

    $story_content = "Once upon a time, in a land far, far away... <!--nextpage--> They journeyed through the magical forest... <!--nextpage--> And they all lived happily ever after!";

    foreach ($stories as $title) {
        wp_insert_post(array(
            'post_title' => $title,
            'post_content' => $story_content,
            'post_status' => 'publish',
            'post_type' => 'story'
        ));
    }
}

/**
 * Seed Characters
 */
function jc_seed_characters() {
    $characters = array('Leo the Lion', 'Bella the Bunny', 'Oliver the Owl', 'Daisy the Duck', 'Sammy the Squirrel', 'Penny the Penguin', 'Milo the Monkey', 'Tina the Turtle', 'Ollie the Bear', 'Pip the Penguin');

    foreach ($characters as $name) {
        wp_insert_post(array(
            'post_title' => $name,
            'post_content' => 'A fun cartoon character to download and color!',
            'post_status' => 'publish',
            'post_type' => 'character'
        ));
    }
}

/**
 * Seed Posts
 */
function jc_seed_posts() {
    $posts = array(
        array('title' => 'The Importance of Play-Based Learning', 'cat' => 'Education'),
        array('title' => 'Top 5 Bedtime Stories for Toddlers', 'cat' => 'Parenting'),
        array('title' => 'How to Create a Safe Play Area', 'cat' => 'Tips')
    );

    foreach ($posts as $post_data) {
        $post_id = wp_insert_post(array(
            'post_title' => $post_data['title'],
            'post_content' => 'This is a sample blog post. It discusses interesting topics regarding parenting and education.',
            'post_excerpt' => 'A brief summary of this amazing blog post for the front page.',
            'post_status' => 'publish',
            'post_type' => 'post'
        ));
        
        $term = wp_insert_term($post_data['cat'], 'category');
        $cat_id = !is_wp_error($term) ? $term['term_id'] : $term->error_data['term_exists'];
        wp_set_post_categories($post_id, array($cat_id));
    }
}
