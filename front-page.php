<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header(); ?>

<div class="space-y-24 pb-12 animate-in slide-in-from-bottom-4 duration-500">
    <section
        class="relative pt-12 lg:pt-20 pb-20 px-4 lg:px-8 overflow-hidden bg-gradient-to-b from-[#A8D8EA]/20 dark:from-sky-900/20 to-transparent">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left space-y-6 z-10">
                    <span
                        class="inline-block py-1 px-4 rounded-full bg-[#B5EAD7] dark:bg-emerald-900/50 text-teal-800 dark:text-emerald-300 font-bold text-sm mb-2 shadow-sm">
                        <?php esc_html_e('Fun & Learning Combined', 'julias-cartoonery'); ?>
                    </span>
                    <h1
                        class="font-['Bubblegum_Sans'] text-5xl lg:text-7xl leading-tight text-gray-800 dark:text-gray-100">
                        <?php esc_html_e('Where', 'julias-cartoonery'); ?> <span class="text-[#FFB7C5] dark:text-pink-400"><?php esc_html_e('Cartoons', 'julias-cartoonery'); ?></span> <?php esc_html_e('Meet', 'julias-cartoonery'); ?> <span
                            class="text-[#A8D8EA] dark:text-sky-400"><?php esc_html_e('Playtime!', 'julias-cartoonery'); ?></span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        <?php esc_html_e('Discover the softest toys, read magical stories, and watch engaging educational cartoons designed specifically for curious little minds.', 'julias-cartoonery'); ?>
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                        <a href="<?php echo esc_url(home_url('/shop')); ?>"
                            class="w-full sm:w-auto text-lg py-4 px-8 bg-[#FFB7C5] text-white hover:bg-pink-400 dark:bg-pink-500 dark:hover:bg-pink-600 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"><?php esc_html_e('Shop Now', 'julias-cartoonery'); ?></a>
                        <a href="#videos-section"
                            class="w-full sm:w-auto text-lg py-4 px-8 bg-white dark:bg-slate-800 border-2 border-[#FFB7C5] text-pink-500 hover:bg-pink-50 dark:border-pink-500 dark:text-pink-400 dark:hover:bg-slate-700 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg> <?php esc_html_e('Watch Videos', 'julias-cartoonery'); ?>
                        </a>
                    </div>
                </div>
                <div class="flex-1 relative z-10">
                    <div class="relative w-full aspect-square max-w-md mx-auto">
                        <div
                            class="absolute inset-0 bg-[#FFDAC1] dark:bg-orange-300/50 rounded-full opacity-60 animate-pulse">
                        </div>
                        <div class="absolute top-10 right-10 w-24 h-24 bg-[#FFB7C5] dark:bg-pink-500 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-xl animate-bounce"
                            style="animation-duration: 3s;"></div>
                        <div class="absolute bottom-10 left-10 w-32 h-32 bg-[#A8D8EA] dark:bg-sky-500 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-xl animate-bounce"
                            style="animation-duration: 4s; animation-delay: 1s;"></div>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-toys.jpg'); ?>"
                            onerror="this.src='https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?auto=format&fit=crop&w=600&q=80'"
                            alt="Happy Toys"
                            class="absolute inset-4 object-cover rounded-full border-8 border-white dark:border-slate-800 shadow-2xl object-center" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="videos-section" class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col items-center mb-10 text-center">
            <h2 class="font-['Bubblegum_Sans'] text-4xl text-gray-800 dark:text-gray-100 mb-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-red-500">
                    <path
                        d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17" />
                    <path d="m10 15 5-3-5-3z" />
                </svg>
                <?php esc_html_e('Julia\'s Channel', 'julias-cartoonery'); ?>
            </h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl"><?php esc_html_e('Watch our latest fun and educational videos. Don\'t forget to subscribe!', 'julias-cartoonery'); ?></p>
        </div>

        <div class="flex justify-center mb-8">
            <div class="bg-gray-100 dark:bg-slate-800 p-1 rounded-full flex gap-1">
                <button id="tab-btn-videos"
                    class="px-6 py-2 rounded-full font-bold transition-all bg-white dark:bg-slate-700 shadow-sm text-[#FFB7C5] dark:text-pink-400"><?php esc_html_e('Latest Videos', 'julias-cartoonery'); ?></button>
                <button id="tab-btn-shorts"
                    class="px-6 py-2 rounded-full font-bold transition-all text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200"><?php esc_html_e('Shorts', 'julias-cartoonery'); ?></button>
            </div>
        </div>

        <div id="tab-content-videos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $video_args = array(
                'post_type' => 'video',
                'posts_per_page' => 3,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'video_type',
                        'field'    => 'slug',
                        'terms'    => 'long',
                    ),
                ),
            );
            $video_query = new WP_Query($video_args);
            if ($video_query->have_posts()) {
                while ($video_query->have_posts()) {
                    $video_query->the_post();
                    set_query_var('video_type', 'long');
                    get_template_part('template-parts/content', 'video');
                }
                wp_reset_postdata();
            } else {
                echo '<p class="text-gray-500">' . esc_html__('No videos found.', 'julias-cartoonery') . '</p>';
            }
            ?>
        </div>

        <div id="tab-content-shorts" class="hidden flex overflow-x-auto pb-8 gap-4 snap-x no-scrollbar">
            <?php
            $shorts_args = array(
                'post_type' => 'video',
                'posts_per_page' => 6,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'video_type',
                        'field'    => 'slug',
                        'terms'    => 'short',
                    ),
                ),
            );
            $shorts_query = new WP_Query($shorts_args);
            if ($shorts_query->have_posts()) {
                while ($shorts_query->have_posts()) {
                    $shorts_query->the_post();
                    set_query_var('video_type', 'short');
                    get_template_part('template-parts/content', 'video');
                }
                wp_reset_postdata();
            } else {
                echo '<p class="text-gray-500">' . esc_html__('No shorts found.', 'julias-cartoonery') . '</p>';
            }
            ?>
        </div>
    </section>

    <section class="bg-[#B5EAD7]/10 dark:bg-emerald-900/10 py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="font-['Bubblegum_Sans'] text-4xl text-gray-800 dark:text-gray-100 mb-2"><?php esc_html_e('Favorite Toys', 'julias-cartoonery'); ?></h2>
                    <p class="text-gray-500 dark:text-gray-400"><?php esc_html_e('Handpicked items your little ones will love.', 'julias-cartoonery'); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/shop')); ?>"
                    class="hidden sm:flex items-center gap-2 text-[#A8D8EA] dark:text-sky-400 font-bold hover:text-sky-500 dark:hover:text-sky-300 transition-colors">
                    <?php esc_html_e('View All', 'julias-cartoonery'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                if (class_exists('WooCommerce')) {
                    $args = array('post_type' => 'product', 'posts_per_page' => 4);
                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()):
                            $loop->the_post();
                            wc_get_template_part('content', 'product');
                        endwhile;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
            <a href="<?php echo esc_url(home_url('/shop')); ?>"
                class="block w-full sm:hidden mt-8 py-3 text-center text-[#A8D8EA] dark:text-sky-400 font-bold border-2 border-[#A8D8EA] dark:border-sky-400 rounded-full">
                <?php esc_html_e('View All Toys', 'julias-cartoonery'); ?>
            </a>
        </div>
    </section>

    <section class="container mx-auto px-4 lg:px-8">
        <h2 class="font-['Bubblegum_Sans'] text-4xl text-gray-800 dark:text-gray-100 mb-10 text-center"><?php esc_html_e('Latest from the Blog', 'julias-cartoonery'); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $blog_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3));
            if ($blog_query->have_posts()):
                while ($blog_query->have_posts()):
                    $blog_query->the_post();
                    get_template_part('template-parts/content', 'blog');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>