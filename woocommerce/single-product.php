<?php
/**
 * The Template for displaying all single products
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop'); ?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in slide-in-from-right-8">
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="inline-flex items-center gap-2 mb-8 text-gray-500 hover:text-gray-800 dark:hover:text-gray-300 font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        Back to Shop
    </a>

    <?php while (have_posts()) : the_post(); global $product; ?>

        <div id="product-<?php the_ID(); ?>" <?php wc_product_class('bg-white dark:bg-slate-800 rounded-[40px] p-6 lg:p-12 shadow-sm border border-gray-50 dark:border-slate-700 flex flex-col lg:flex-row gap-12 mb-12', $product); ?>>
            
            <div class="flex-1 relative">
                <!-- Wishlist placeholder -->
                <button class="absolute top-4 right-4 p-3 bg-white/90 dark:bg-slate-800/90 backdrop-blur rounded-full text-gray-400 hover:text-red-400 shadow-md transition-colors z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                </button>
                
                <div class="aspect-square rounded-3xl overflow-hidden bg-gray-50 dark:bg-slate-700 mb-4 relative">
                    <?php 
                    $thumbnail_id = $product->get_image_id();
                    $image = wp_get_attachment_image_url($thumbnail_id, 'full');
                    if ($image) {
                        echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($product->get_name()) . '" class="w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal hover:scale-110 transition-transform duration-700" />';
                    } else {
                        echo '<div class="w-full h-full bg-gray-100 dark:bg-slate-700"></div>';
                    }
                    ?>
                </div>

                <!-- Product Gallery -->
                <div class="flex gap-4 overflow-x-auto no-scrollbar">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($attachment_ids && $product->get_image_id()) {
                        // Output main image as first thumbnail
                        echo '<div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-gray-50 dark:bg-slate-700 border-2 border-[#FFB7C5] dark:border-pink-500 cursor-pointer">';
                        echo '<img src="' . esc_url($image) . '" class="w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal" />';
                        echo '</div>';

                        foreach ($attachment_ids as $attachment_id) {
                            $gallery_image = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                            echo '<div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-gray-50 dark:bg-slate-700 border-2 border-transparent opacity-60 hover:opacity-100 cursor-pointer">';
                            echo '<img src="' . esc_url($gallery_image) . '" class="w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal" />';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="flex-1 flex flex-col">
                <div class="mb-2">
                    <span class="text-xs font-bold tracking-wider text-[#A8D8EA] dark:text-sky-400 uppercase bg-sky-50 dark:bg-sky-900/30 px-3 py-1 rounded-full">
                        <?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
                    </span>
                </div>
                
                <h1 class="font-['Bubblegum_Sans'] text-4xl lg:text-5xl text-gray-800 dark:text-gray-100 mb-4">
                    <?php the_title(); ?>
                </h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center text-yellow-400">
                        <?php 
                        // Mock 5 stars, Woo has its own but this matches the UI
                        for ($i = 0; $i < 5; $i++) {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
                        }
                        ?>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400 text-sm">(Customer Reviews)</span>
                </div>
                
                <p class="text-4xl font-bold text-[#FFB7C5] dark:text-pink-400 mb-6">
                    <?php echo $product->get_price_html(); ?>
                </p>
                
                <div class="text-gray-600 dark:text-gray-300 mb-8 leading-relaxed prose dark:prose-invert">
                    <?php echo apply_filters('the_content', $product->get_short_description() ?: $product->get_description()); ?>
                </div>

                <div class="mt-auto space-y-6">
                    <?php 
                    // Let WooCommerce handle the add to cart logic (variable, simple, external)
                    // We just hook into it
                    do_action('woocommerce_single_product_summary');
                    ?>

                    <div class="flex items-center gap-6 pt-6 border-t border-gray-100 dark:border-slate-700 text-sm text-gray-500 dark:text-gray-400">
                        <?php if ($product->is_in_stock()) : ?>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 dark:text-emerald-400"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg> 
                                In Stock
                            </div>
                        <?php endif; ?>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 dark:text-emerald-400"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg> 
                            Fast Delivery
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-[40px] p-6 lg:p-12 shadow-sm border border-gray-50 dark:border-slate-700">
            <?php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
            ?>
        </div>

    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer('shop'); ?>
