<?php
/**
 * Template part for displaying a story card
 */
?>
<div class="relative group cursor-pointer perspective-1000" onclick="window.location.href='<?php the_permalink(); ?>'">
    <div class="absolute inset-0 bg-black/20 translate-x-2 translate-y-2 rounded-r-lg blur-sm group-hover:translate-x-4 group-hover:translate-y-4 transition-transform"></div>
    <div class="relative w-40 h-56 lg:w-48 lg:h-64 bg-white dark:bg-slate-800 rounded-r-xl border-l-[12px] border-[#FFB7C5] dark:border-pink-600 shadow-sm transform group-hover:-translate-y-4 group-hover:rotate-[-4deg] transition-all duration-300 overflow-hidden flex flex-col">
        <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('medium', array('class' => 'w-full h-3/4 object-cover')); ?>
        <?php else: ?>
            <div class="w-full h-3/4 bg-pink-100 dark:bg-pink-900/50"></div>
        <?php endif; ?>
        <div class="p-3 bg-white dark:bg-slate-800 flex-grow flex flex-col justify-center text-center border-t border-gray-100 dark:border-slate-700">
            <h3 class="font-['Bubblegum_Sans'] text-sm lg:text-base leading-tight text-gray-800 dark:text-gray-200"><?php the_title(); ?></h3>
        </div>
    </div>
</div>
