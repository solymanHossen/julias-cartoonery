<?php
/**
 * Template part for displaying a video card.
 */

$video_duration = get_post_meta(get_the_ID(), 'video_duration', true) ?: '10:00';
$video_type = get_query_var('video_type', 'long'); // Can be passed to the template part

if ($video_type === 'short') {
    ?>
    <div class="bg-white dark:bg-slate-800 rounded-3xl min-w-[200px] w-[200px] p-0 snap-start shrink-0 group cursor-pointer border border-gray-50 dark:border-slate-700 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]" onclick="window.location.href='<?php the_permalink(); ?>'">
        <div class="relative aspect-[9/16]">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']);
            } ?>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                    <polygon points="5 3 19 12 5 21 5 3" />
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-3">
                <h3 class="font-bold text-white text-sm line-clamp-2 leading-tight"><?php the_title(); ?></h3>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="bg-white dark:bg-slate-800 rounded-3xl p-0 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 cursor-pointer border border-gray-50 dark:border-slate-700 overflow-hidden group" onclick="window.location.href='<?php the_permalink(); ?>'">
        <div class="relative aspect-video">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']);
            } ?>
            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#FFB7C5] ml-1">
                        <polygon points="5 3 19 12 5 21 5 3" />
                    </svg>
                </div>
            </div>
            <span class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded"><?php echo esc_html($video_duration); ?></span>
        </div>
        <div class="p-4">
            <h3 class="font-bold text-gray-800 dark:text-gray-200 line-clamp-2 group-hover:text-[#A8D8EA] dark:group-hover:text-sky-400 transition-colors">
                <?php the_title(); ?>
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Julia's Cartoonery</p>
        </div>
    </div>
    <?php
}
