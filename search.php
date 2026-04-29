<?php
/**
 * The template for displaying search results pages
 */

get_header(); ?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="text-center mb-12">
        <div class="w-20 h-20 bg-[#A8D8EA]/20 dark:bg-sky-900/40 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#A8D8EA] dark:text-sky-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </div>
        <h1 class="font-['Bubblegum_Sans'] text-4xl lg:text-5xl text-gray-800 dark:text-gray-100 mb-4">
            Search Results for: <span class="text-[#A8D8EA] dark:text-sky-400"><?php echo get_search_query(); ?></span>
        </h1>
    </div>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php while (have_posts()) : the_post(); 
                $post_type = get_post_type();
                if ($post_type === 'product' && class_exists('WooCommerce')) {
                    global $product;
                    wc_get_template_part('content', 'product');
                } elseif ($post_type === 'video') {
                    get_template_part('template-parts/content', 'video');
                } elseif ($post_type === 'story') {
                    get_template_part('template-parts/content', 'story');
                } else {
                    get_template_part('template-parts/content', 'blog');
                }
            endwhile; ?>
        </div>

        <?php 
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '&larr; Previous',
            'next_text' => 'Next &rarr;',
            'class'     => 'mt-12 flex justify-center',
        ));
        ?>

    <?php else : ?>
        <div class="text-center text-gray-400 dark:text-gray-500 mt-10 flex flex-col items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-4 opacity-50"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/><line x1="9" x2="13" y1="9" y2="13"/><line x1="13" x2="9" y1="9" y2="13"/></svg>
            <p class="text-xl">No magical items found for "<?php echo get_search_query(); ?>"</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mt-6 px-6 py-3 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-95 shadow-sm hover:shadow-md bg-[#A8D8EA] text-white hover:bg-blue-400 dark:bg-sky-500 dark:hover:bg-sky-600">Return Home</a>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
