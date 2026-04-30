<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
</main>

<footer
    class="bg-white dark:bg-slate-900 pt-16 pb-8 border-t border-gray-100 dark:border-slate-800 mt-20 relative overflow-hidden transition-colors">
    <div
        class="absolute top-0 left-0 w-64 h-64 bg-[#FFB7C5]/20 dark:bg-pink-900/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
    </div>
    <div
        class="absolute bottom-0 right-0 w-64 h-64 bg-[#A8D8EA]/20 dark:bg-sky-900/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-6xl mx-auto rounded-[32px] border border-gray-100 dark:border-slate-800 bg-white/80 dark:bg-slate-900/70 backdrop-blur-md shadow-[0_20px_60px_rgba(15,23,42,.06)] p-8 lg:p-10 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="col-span-1 md:col-span-2">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#FFB7C5] flex items-center justify-center text-white font-['Bubblegum_Sans'] text-2xl">JC</div>
                        <h2 class="font-['Bubblegum_Sans'] text-3xl text-[#FFB7C5] dark:text-pink-400">
                            <?php bloginfo('name'); ?>
                        </h2>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm leading-relaxed">
                        <?php bloginfo('description'); ?>
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach (array('Shop', 'Stories', 'Characters', 'Wishlist') as $label) : ?>
                            <span class="px-4 py-2 rounded-full bg-[#FFB7C5]/10 dark:bg-pink-500/20 text-[#FFB7C5] dark:text-pink-300 text-sm font-bold"><?php echo esc_html($label); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-4 text-lg"><?php esc_html_e('Quick Links', 'julias-cartoonery'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-1',
                        'fallback_cb' => 'jc_footer_quick_links_fallback',
                        'menu_class' => 'space-y-3 text-gray-500 dark:text-gray-400',
                        'link_before' => '<span class="hover:text-[#A8D8EA] dark:hover:text-sky-400 cursor-pointer transition-colors">',
                        'link_after' => '</span>'
                    ));
                    ?>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-4 text-lg"><?php esc_html_e('Support', 'julias-cartoonery'); ?></h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-2',
                        'fallback_cb' => 'jc_footer_support_links_fallback',
                        'menu_class' => 'space-y-3 text-gray-500 dark:text-gray-400',
                        'link_before' => '<span class="hover:text-[#A8D8EA] dark:hover:text-sky-400 cursor-pointer transition-colors">',
                        'link_after' => '</span>'
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center border-t border-gray-100 dark:border-slate-800 pt-8 mt-8">
            <div class="text-gray-400 dark:text-gray-600 text-sm mb-4 md:mb-0">
                <?php echo wp_kses_post(get_theme_mod('jc_copyright_text', '&copy; ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.')); ?>
            </div>
            
            <?php $youtube_link = get_theme_mod('jc_social_youtube', 'https://youtube.com'); ?>
            <?php if (!empty($youtube_link)): ?>
            <a href="<?php echo esc_url($youtube_link); ?>" target="_blank" rel="noopener noreferrer" class="text-gray-400 dark:text-gray-600 hover:text-red-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
            </a>
            <?php endif; ?>
        </div>
    </div>
</footer>

<div id="jc-chat-wrapper" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    <div id="jc-chat-box"
        class="hidden bg-white dark:bg-slate-800 w-80 h-96 rounded-2xl shadow-2xl mb-4 border border-gray-100 dark:border-slate-700 flex-col overflow-hidden animate-in slide-in-from-bottom-4">
        <div
            class="bg-gradient-to-r from-[#FFB7C5] to-[#A8D8EA] dark:from-pink-600 dark:to-sky-600 p-4 text-white flex justify-between items-center shadow-md">
            <div class="flex items-center gap-2 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                </svg>
                <?php esc_html_e('Chat with Julia', 'julias-cartoonery'); ?>
            </div>
            <button id="jc-chat-close" class="hover:bg-white/20 p-1 rounded transition-colors"><svg
                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg></button>
        </div>
        <div id="jc-chat-messages" class="flex-1 p-4 overflow-y-auto bg-slate-50 dark:bg-slate-900/50 space-y-3">
            <div class="flex justify-start">
                <div
                    class="px-4 py-2 rounded-2xl max-w-[80%] text-sm shadow-sm bg-white dark:bg-slate-700 text-gray-800 dark:text-gray-200 border border-gray-100 dark:border-slate-600 rounded-bl-sm">
                    <?php esc_html_e('Hi there! I\'m Julia. Need help finding a toy?', 'julias-cartoonery'); ?>
                </div>
            </div>
        </div>
        <form id="jc-chat-form"
            class="p-3 bg-white dark:bg-slate-800 border-t border-gray-100 dark:border-slate-700 flex gap-2">
            <input type="text" id="jc-chat-input" placeholder="<?php esc_attr_e('Type a message...', 'julias-cartoonery'); ?>"
                class="flex-1 bg-gray-100 dark:bg-slate-900 dark:text-white rounded-full px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-[#FFB7C5] dark:focus:ring-pink-500 transition-shadow" />
            <button type="submit"
                class="bg-[#FFB7C5] dark:bg-pink-500 text-white p-2 rounded-full hover:bg-pink-400 dark:hover:bg-pink-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1">
                    <path d="m22 2-7 20-4-9-9-4Z" />
                    <path d="M22 2 11 13" />
                </svg>
            </button>
        </form>
    </div>
    <button id="jc-chat-toggle"
        class="w-14 h-14 bg-[#FFB7C5] dark:bg-pink-600 text-white rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition-transform hover:shadow-xl">
        <svg id="jc-chat-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
        </svg>
    </button>
</div>

<?php wp_footer(); ?>
</body>

</html>