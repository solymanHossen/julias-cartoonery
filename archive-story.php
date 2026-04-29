<?php
/**
 * The template for displaying the story archive
 */

get_header(); ?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] dark:bg-blend-multiply">
    <div class="flex flex-col items-center text-center mb-16">
        <div class="w-20 h-20 bg-[#FFDAC1] dark:bg-orange-900/40 rounded-full flex items-center justify-center mb-4 shadow-inner">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-400 dark:text-orange-300">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>
        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mb-4">Rupkothar Gollpo</h1>
        <p class="text-gray-500 dark:text-gray-400">Magical stories for bedtime and beyond.</p>
    </div>

    <div class="max-w-5xl mx-auto relative">
        <div class="flex justify-center gap-8 lg:gap-16 flex-wrap px-4 pb-4 border-b-[16px] border-[#d4a373] dark:border-[#8b5a2b] shadow-[0_10px_20px_rgba(0,0,0,0.1)] mb-16">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'story'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="w-full text-center text-gray-500 py-12">
                    <p>No stories found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php 
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '&larr; Previous',
        'next_text' => 'Next &rarr;',
        'class'     => 'mt-8 flex justify-center',
    ));
    ?>
</div>

<?php get_footer(); ?>
