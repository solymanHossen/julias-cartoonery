<?php
/**
 * Template Name: Wishlist
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header('shop');

do_action('woocommerce_before_main_content');
?>

<div class="container mx-auto px-4 lg:px-8 py-12">
    <?php echo do_shortcode('[jc_wishlist]'); ?>
</div>

<?php
do_action('woocommerce_after_main_content');
get_footer('shop');