<?php
/**
 * The template for displaying a single story
 */

get_header(); ?>

<div class="min-h-[80vh] bg-[#fdfbf7] dark:bg-slate-900 py-12 animate-in fade-in transition-colors">
    <div class="container mx-auto px-4 lg:px-8">
        <a href="<?php echo esc_url(get_post_type_archive_link('story')); ?>" class="inline-flex items-center gap-2 mb-8 text-gray-500 hover:text-gray-800 dark:hover:text-gray-300 font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            Back to Library
        </a>

        <?php while (have_posts()) : the_post(); 
            // Determine current page for native WP pagination
            global $page, $numpages;
            $current_page = $page ? $page : 1;
            $total_pages = $numpages ? $numpages : 1;
        ?>
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 rounded-t-3xl rounded-b-md shadow-2xl border-x-8 border-t-8 border-[#FFB7C5] dark:border-pink-600 overflow-hidden transition-colors">
                
                <div class="w-full h-[40vh] bg-gray-100 dark:bg-slate-700 relative flex items-center justify-center overflow-hidden">
                    <?php 
                    // If using ACF, we could get page-specific images. 
                    // For now, we fallback to the post thumbnail if no images are in the content page.
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'absolute inset-0 w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal opacity-50 blur-sm'));
                        the_post_thumbnail('large', array('class' => 'relative z-10 max-h-full w-auto object-contain shadow-xl'));
                    }
                    ?>
                    <div class="absolute top-4 right-4 bg-white/80 dark:bg-slate-800/80 backdrop-blur px-4 py-1 rounded-full text-xs font-bold text-gray-600 dark:text-gray-300 shadow-sm z-20">
                        Page <?php echo esc_html($current_page); ?> of <?php echo esc_html($total_pages); ?>
                    </div>
                </div>

                <div class="p-8 md:p-16 text-center bg-[#fffcf5] dark:bg-slate-800 transition-colors">
                    <h1 class="font-['Bubblegum_Sans'] text-3xl text-gray-300 dark:text-gray-600 mb-8 border-b-2 border-dashed border-gray-200 dark:border-slate-700 pb-4 inline-block">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="font-['Lora'] text-2xl md:text-3xl leading-relaxed text-gray-800 dark:text-gray-200 prose dark:prose-invert max-w-none">
                        <?php 
                        // the_content() will show only the current page if <!--nextpage--> is used
                        the_content(); 
                        ?>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 bg-gray-50 dark:bg-slate-800/50 border-t border-gray-100 dark:border-slate-700 transition-colors">
                    <?php 
                    $args = array(
                        'before'           => '',
                        'after'            => '',
                        'link_before'      => '<span class="hidden">',
                        'link_after'       => '</span>',
                        'next_or_number'   => 'next',
                        'separator'        => ' ',
                        'nextpagelink'     => __('Next Page', 'julias-cartoonery'),
                        'previouspagelink' => __('Previous Page', 'julias-cartoonery'),
                        'pagelink'         => '%',
                        'echo'             => 0
                    );
                    $page_links = wp_link_pages($args); 
                    
                    // Custom parsing to match the original button styles
                    if ($current_page > 1) {
                        echo '<a href="' . esc_url(_wp_link_page($current_page - 1)) . '" class="px-6 py-3 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-95 shadow-sm hover:shadow-md bg-[#A8D8EA] text-white hover:bg-blue-400 dark:bg-sky-500 dark:hover:bg-sky-600">Previous Page</a>';
                    } else {
                        echo '<div></div>'; // Spacer
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="' . esc_url(_wp_link_page($current_page + 1)) . '" class="px-6 py-3 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-95 shadow-sm hover:shadow-md bg-[#FFB7C5] text-white hover:bg-pink-400 dark:bg-pink-500 dark:hover:bg-pink-600">Next Page</a>';
                    } else {
                        echo '<a href="' . esc_url(get_post_type_archive_link('story')) . '" class="px-6 py-3 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 transform active:scale-95 shadow-sm hover:shadow-md bg-[#B5EAD7] dark:bg-emerald-600 hover:bg-emerald-300 dark:hover:bg-emerald-500 text-emerald-900 dark:text-white">Finish Book</a>';
                    }
                    ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
