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
                        Fun & Learning Combined
                    </span>
                    <h1
                        class="font-['Bubblegum_Sans'] text-5xl lg:text-7xl leading-tight text-gray-800 dark:text-gray-100">
                        Where <span class="text-[#FFB7C5] dark:text-pink-400">Cartoons</span> Meet <span
                            class="text-[#A8D8EA] dark:text-sky-400">Playtime!</span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Discover the softest toys, read magical stories, and watch engaging educational cartoons
                        designed specifically for curious little minds.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                        <a href="<?php echo esc_url(home_url('/shop')); ?>"
                            class="w-full sm:w-auto text-lg py-4 px-8 bg-[#FFB7C5] text-white hover:bg-pink-400 dark:bg-pink-500 dark:hover:bg-pink-600 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-sm hover:shadow-md">Shop
                            Now</a>
                        <a href="#videos-section"
                            class="w-full sm:w-auto text-lg py-4 px-8 bg-white dark:bg-slate-800 border-2 border-[#FFB7C5] text-pink-500 hover:bg-pink-50 dark:border-pink-500 dark:text-pink-400 dark:hover:bg-slate-700 rounded-full font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg> Watch Videos
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
                Julia's Channel
            </h2>
            <p class="text-gray-500 dark:text-gray-400 max-w-xl">Watch our latest fun and educational videos. Don't
                forget to subscribe!</p>
        </div>

        <div class="flex justify-center mb-8">
            <div class="bg-gray-100 dark:bg-slate-800 p-1 rounded-full flex gap-1">
                <button id="tab-btn-videos"
                    class="px-6 py-2 rounded-full font-bold transition-all bg-white dark:bg-slate-700 shadow-sm text-[#FFB7C5] dark:text-pink-400">Latest
                    Videos</button>
                <button id="tab-btn-shorts"
                    class="px-6 py-2 rounded-full font-bold transition-all text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">Shorts</button>
            </div>
        </div>

        <div id="tab-content-videos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                class="bg-white dark:bg-slate-800 rounded-3xl p-0 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 cursor-pointer border border-gray-50 dark:border-slate-700 overflow-hidden group">
                <div class="relative aspect-video">
                    <img src="https://images.unsplash.com/photo-1615469038804-6b91aef7026f?auto=format&fit=crop&w=600&q=80"
                        alt="Video" class="w-full h-full object-cover" />
                    <div
                        class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                        <div
                            class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-[#FFB7C5] ml-1">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg>
                        </div>
                    </div>
                    <span
                        class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded">10:24</span>
                </div>
                <div class="p-4">
                    <h3
                        class="font-bold text-gray-800 dark:text-gray-200 line-clamp-2 group-hover:text-[#A8D8EA] dark:group-hover:text-sky-400 transition-colors">
                        Learn Colors with Ollie!</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Julia's Cartoonery</p>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-800 rounded-3xl p-0 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 cursor-pointer border border-gray-50 dark:border-slate-700 overflow-hidden group">
                <div class="relative aspect-video">
                    <img src="https://images.unsplash.com/photo-1555448248-2571daf6344b?auto=format&fit=crop&w=600&q=80"
                        alt="Video" class="w-full h-full object-cover" />
                    <div
                        class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                        <div
                            class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="text-[#FFB7C5] ml-1">
                                <polygon points="5 3 19 12 5 21 5 3" />
                            </svg>
                        </div>
                    </div>
                    <span
                        class="absolute bottom-2 right-2 bg-black/70 text-white text-xs font-bold px-2 py-1 rounded">15:10</span>
                </div>
                <div class="p-4">
                    <h3
                        class="font-bold text-gray-800 dark:text-gray-200 line-clamp-2 group-hover:text-[#A8D8EA] dark:group-hover:text-sky-400 transition-colors">
                        The Magical Alphabet Train</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Julia's Cartoonery</p>
                </div>
            </div>
        </div>

        <div id="tab-content-shorts" class="hidden flex overflow-x-auto pb-8 gap-4 snap-x no-scrollbar">
            <div
                class="bg-white dark:bg-slate-800 rounded-3xl min-w-[200px] w-[200px] p-0 snap-start shrink-0 group cursor-pointer border border-gray-50 dark:border-slate-700 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
                <div class="relative aspect-[9/16]">
                    <img src="https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?auto=format&fit=crop&w=300&q=80"
                        alt="Short" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                            fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-white">
                            <polygon points="5 3 19 12 5 21 5 3" />
                        </svg>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-3">
                        <h3 class="font-bold text-white text-sm line-clamp-2 leading-tight">Funny Bunny Hop!</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#B5EAD7]/10 dark:bg-emerald-900/10 py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="font-['Bubblegum_Sans'] text-4xl text-gray-800 dark:text-gray-100 mb-2">Favorite Toys
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400">Handpicked items your little ones will love.</p>
                </div>
                <a href="<?php echo esc_url(home_url('/shop')); ?>"
                    class="hidden sm:flex items-center gap-2 text-[#A8D8EA] dark:text-sky-400 font-bold hover:text-sky-500 dark:hover:text-sky-300 transition-colors">
                    View All <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
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
                            global $product;
                            ?>
                            <div class="bg-white dark:bg-slate-800 rounded-3xl p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 cursor-pointer border border-gray-50 dark:border-slate-700 flex flex-col h-full group"
                                onclick="window.location.href='<?php the_permalink(); ?>'">
                                <div class="relative aspect-square rounded-2xl overflow-hidden mb-4 bg-gray-50 dark:bg-slate-700">
                                    <?php echo woocommerce_get_product_thumbnail('woocommerce_thumbnail', array('class' => 'w-full h-full object-cover mix-blend-multiply dark:mix-blend-normal group-hover:scale-105 transition-transform duration-500')); ?>
                                </div>
                                <div class="flex flex-col flex-grow">
                                    <span
                                        class="text-xs text-gray-400 dark:text-gray-500 mb-1"><?php echo wc_get_product_category_list($product->get_id(), ', '); ?></span>
                                    <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-2 line-clamp-1"><?php the_title(); ?>
                                    </h3>
                                    <div class="mt-auto flex items-center justify-between">
                                        <span
                                            class="font-bold text-xl text-[#FFB7C5] dark:text-pink-400"><?php echo $product->get_price_html(); ?></span>
                                        <a href="?add-to-cart=<?php echo esc_attr($product->get_id()); ?>"
                                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#A8D8EA] dark:hover:bg-sky-500 hover:text-white transition-colors"
                                            onclick="event.stopPropagation();">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="8" cy="21" r="1" />
                                                <circle cx="19" cy="21" r="1" />
                                                <path
                                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
            <a href="<?php echo esc_url(home_url('/shop')); ?>"
                class="block w-full sm:hidden mt-8 py-3 text-center text-[#A8D8EA] dark:text-sky-400 font-bold border-2 border-[#A8D8EA] dark:border-sky-400 rounded-full">
                View All Toys
            </a>
        </div>
    </section>

    <section class="container mx-auto px-4 lg:px-8">
        <h2 class="font-['Bubblegum_Sans'] text-4xl text-gray-800 dark:text-gray-100 mb-10 text-center">Latest from the
            Blog</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $blog_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3));
            if ($blog_query->have_posts()):
                while ($blog_query->have_posts()):
                    $blog_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>"
                        class="bg-white dark:bg-slate-800 rounded-3xl p-0 shadow-[0_8px_30px_rgb(0,0,0,0.06)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)] hover:-translate-y-2 transition-transform duration-300 border border-gray-50 dark:border-slate-700 flex flex-col h-full group">
                        <div class="overflow-hidden h-48 rounded-t-3xl">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-100 dark:bg-slate-700"></div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <span
                                class="text-xs font-bold text-[#FFB7C5] dark:text-pink-400 tracking-wider uppercase mb-2 block">
                                <?php $categories = get_the_category();
                                if (!empty($categories))
                                    echo esc_html($categories[0]->name); ?>
                            </span>
                            <h3
                                class="font-bold text-xl text-gray-800 dark:text-gray-200 mb-3 line-clamp-2 group-hover:text-[#A8D8EA] dark:group-hover:text-sky-400 transition-colors">
                                <?php the_title(); ?></h3>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-3 flex-grow">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            <div class="text-xs text-gray-400 dark:text-gray-500 mt-auto"><?php echo get_the_date(); ?></div>
                        </div>
                    </a>
                <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>