<?php
/**
 * Template part for displaying blog posts in a grid
 */
?>
<a href="<?php the_permalink(); ?>" class="bg-white dark:bg-slate-800 rounded-3xl p-0 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 border border-gray-50 dark:border-slate-700 flex flex-col h-full group">
    <div class="overflow-hidden h-48 rounded-t-3xl">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
        <?php else: ?>
            <div class="w-full h-full bg-gray-100 dark:bg-slate-700"></div>
        <?php endif; ?>
    </div>
    <div class="p-6 flex-grow flex flex-col">
        <span class="text-xs font-bold text-[#FFB7C5] dark:text-pink-400 tracking-wider uppercase mb-2 block">
            <?php 
            $categories = get_the_category();
            if (!empty($categories)) {
                echo esc_html($categories[0]->name); 
            }
            ?>
        </span>
        <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200 mb-3 line-clamp-2 group-hover:text-[#A8D8EA] dark:group-hover:text-sky-400 transition-colors">
            <?php the_title(); ?>
        </h3>
        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-3 flex-grow">
            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
        </p>
        <div class="text-xs text-gray-400 dark:text-gray-500 mt-auto">
            <?php echo get_the_date(); ?>
        </div>
    </div>
</a>
