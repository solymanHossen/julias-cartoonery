<?php
/**
 * The main template file for blog/posts page
 */

get_header(); ?>

<div class="container mx-auto px-4 lg:px-8 py-12 animate-in fade-in">
    <div class="text-center mb-12">
        <h1 class="font-['Bubblegum_Sans'] text-5xl text-gray-800 dark:text-gray-100 mb-4">
            <?php 
            if (is_home() && !is_front_page()) {
                single_post_title();
            } else {
                echo 'Parenting & Play';
            }
            ?>
        </h1>
        <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">Tips, stories, and educational insights from the world of Julia's Cartoonery.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'blog'); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-span-full text-center text-gray-500 py-12">
                <p>No magical stories found yet. Please check back later!</p>
            </div>
        <?php endif; ?>
    </div>

    <?php 
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '&larr; Previous',
        'next_text' => 'Next &rarr;',
        'class'     => 'mt-12 flex justify-center',
    ));
    ?>
</div>

<?php get_footer(); ?>
