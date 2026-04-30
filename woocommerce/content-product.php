<?php
/**
 * The template for displaying product content within loops
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure $product is a WC_Product object, which is needed in custom loops like front-page.php
if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<div class="bg-white dark:bg-slate-800 rounded-3xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 cursor-pointer border border-gray-50 dark:border-slate-700 flex flex-col h-full group" onclick="window.location.href='<?php the_permalink(); ?>'">
    <div class="relative aspect-square rounded-2xl overflow-hidden mb-4 bg-gray-50 dark:bg-slate-700">
        <?php echo jc_get_product_thumbnail_html($product->get_id(), 'woocommerce_thumbnail', 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal group-hover:scale-105 transition-transform duration-500'); ?>
        <?php echo function_exists('jc_get_wishlist_button_html') ? jc_get_wishlist_button_html($product->get_id(), 'top-3 right-3 p-2 bg-white/80 dark:bg-slate-800/80') : ''; ?>
    </div>
    
    <div class="flex flex-col flex-grow">
        <span class="text-xs text-gray-400 dark:text-gray-500 mb-1">
            <?php echo wc_get_product_category_list($product->get_id(), ', '); ?>
        </span>
        
        <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-2 line-clamp-1">
            <?php the_title(); ?>
        </h3>
        
        <!-- Rating Placeholder -->
        <div class="flex items-center gap-1 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-400">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            <span class="text-sm text-gray-600 dark:text-gray-400 font-bold">4.8</span>
        </div>
        
        <div class="mt-auto flex items-center justify-between">
            <span class="font-bold text-xl text-[#FFB7C5] dark:text-pink-400">
                <?php echo $product->get_price_html(); ?>
            </span>
            
            <button type="button" data-jc-add-to-cart data-product-id="<?php echo esc_attr($product->get_id()); ?>" class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#A8D8EA] dark:hover:bg-sky-500 hover:text-white transition-colors" onclick="event.stopPropagation();" aria-label="<?php echo esc_attr(sprintf(__('Add %s to cart', 'julias-cartoonery'), $product->get_name())); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="8" cy="21" r="1" />
                    <circle cx="19" cy="21" r="1" />
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                </svg>
            </button>
        </div>
    </div>
</div>
