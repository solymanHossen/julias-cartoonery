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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-2">
                <h2 class="font-['Bubblegum_Sans'] text-3xl text-[#FFB7C5] dark:text-pink-400 mb-4">
                    <?php bloginfo('name'); ?>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm leading-relaxed">
                    <?php bloginfo('description'); ?>
                </p>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-4 text-lg">Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-1',
                    'fallback_cb' => false,
                    'menu_class' => 'space-y-3 text-gray-500 dark:text-gray-400',
                    'link_before' => '<span class="hover:text-[#A8D8EA] dark:hover:text-sky-400 cursor-pointer transition-colors">',
                    'link_after' => '</span>'
                ));
                ?>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 dark:text-gray-200 mb-4 text-lg">Support</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-2',
                    'fallback_cb' => false,
                    'menu_class' => 'space-y-3 text-gray-500 dark:text-gray-400',
                    'link_before' => '<span class="hover:text-[#A8D8EA] dark:hover:text-sky-400 cursor-pointer transition-colors">',
                    'link_after' => '</span>'
                ));
                ?>
            </div>
        </div>
        <div
            class="text-center text-gray-400 dark:text-gray-600 text-sm border-t border-gray-100 dark:border-slate-800 pt-8">
            &copy;
            <?php echo date('Y'); ?>
            <?php bloginfo('name'); ?>. All rights reserved.
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
                Chat with Julia
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
                    Hi there! I'm Julia. Need help finding a toy?
                </div>
            </div>
        </div>
        <form id="jc-chat-form"
            class="p-3 bg-white dark:bg-slate-800 border-t border-gray-100 dark:border-slate-700 flex gap-2">
            <input type="text" id="jc-chat-input" placeholder="Type a message..."
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