<?php
/**
 * The header for our theme
 *
 * @package julias-cartoonery
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="transition-colors duration-500">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
    
    <script>
        if (localStorage.getItem('jc-theme') === 'dark' || (!('jc-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body <?php body_class("min-h-screen bg-[#fafafc] dark:bg-slate-900 font-['Nunito'] text-slate-800 dark:text-slate-200 flex flex-col overflow-x-hidden selection:bg-[#FFB7C5] selection:text-white transition-colors duration-500"); ?>>
<?php wp_body_open(); ?>

<header class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md shadow-sm border-b border-[#FFB7C5]/20 dark:border-slate-800 transition-colors duration-500">
    <div class="container mx-auto px-4 lg:px-8 py-4 flex items-center justify-between">
        
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 cursor-pointer transition-transform hover:scale-105">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="w-12 h-12 bg-[#FFB7C5] dark:bg-pink-500 rounded-full flex items-center justify-center shadow-inner text-white font-['Bubblegum_Sans'] text-2xl rotate-[-5deg] transition-colors">
                    <?php echo esc_html(substr(get_bloginfo('name'), 0, 2)); ?>
                </div>
                <h1 class="font-['Bubblegum_Sans'] text-2xl md:text-3xl tracking-wide bg-gradient-to-r from-[#FFB7C5] to-[#A8D8EA] dark:from-pink-400 dark:to-sky-400 bg-clip-text text-transparent hidden sm:block">
                    <?php bloginfo('name'); ?>
                </h1>
            <?php endif; ?>
        </a>

        <nav class="hidden lg:flex items-center gap-6 xl:gap-8 font-bold text-gray-600 dark:text-gray-300">
            <?php
            wp_nav_menu(array(
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_class'      => 'flex items-center gap-6 xl:gap-8',
                'fallback_cb'     => false,
            ));
            ?>
        </nav>

        <div class="flex items-center gap-1 sm:gap-3">
            
            <button id="jc-theme-toggle" class="p-2 text-gray-500 dark:text-gray-400 hover:text-[#A8D8EA] dark:hover:text-sky-300 transition-colors" title="Toggle Theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon block dark:hidden"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun hidden dark:block"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
            </button>

            <button id="jc-search-toggle" class="p-2 text-gray-500 dark:text-gray-400 hover:text-[#A8D8EA] dark:hover:text-sky-300 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>

            <a href="<?php echo esc_url(home_url('/wishlist')); ?>" class="hidden md:block relative p-2 text-gray-500 dark:text-gray-400 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            </a>

            <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart')); ?>" class="relative p-2 text-gray-500 dark:text-gray-400 hover:text-[#FFB7C5] dark:hover:text-pink-400 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-110 transition-transform"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                <?php if(function_exists('WC') && WC()->cart->get_cart_contents_count() > 0): ?>
                    <span class="absolute -top-1 -right-1 bg-red-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full animate-bounce">
                        <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
                    </span>
                <?php endif; ?>
            </a>

            <a href="<?php echo esc_url(wp_login_url()); ?>" class="p-2 text-gray-500 dark:text-gray-400 hover:text-[#B5EAD7] dark:hover:text-emerald-400 transition-colors">
                <?php if (is_user_logged_in()) : 
                    $current_user = wp_get_current_user();
                    $initial = strtoupper(substr($current_user->display_name, 0, 1));
                ?>
                    <div class="w-8 h-8 rounded-full bg-[#B5EAD7] dark:bg-emerald-500 flex items-center justify-center text-white font-bold ring-2 ring-offset-2 ring-[#B5EAD7] dark:ring-emerald-500 dark:ring-offset-slate-900 transition-all">
                        <?php echo esc_html($initial); ?>
                    </div>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <?php endif; ?>
            </a>
            
            <button id="jc-mobile-menu-toggle" class="lg:hidden p-2 text-gray-500 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </div>
</header>

<div id="jc-search-overlay" class="fixed inset-0 z-50 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300 flex flex-col">
    <div class="container mx-auto px-4 lg:px-8 py-6 flex items-center gap-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#A8D8EA] dark:text-sky-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="flex-grow">
            <input type="text" name="s" placeholder="Search toys, videos, or stories..." class="w-full bg-transparent text-3xl font-['Bubblegum_Sans'] text-gray-800 dark:text-gray-100 placeholder-gray-300 dark:placeholder-gray-600 outline-none" />
        </form>
        <button id="jc-search-close" type="button" class="p-3 bg-gray-100 dark:bg-slate-800 rounded-full hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
        </button>
    </div>
</div>

<div id="jc-mobile-drawer-overlay" class="fixed inset-0 z-50 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden">
    <div id="jc-mobile-drawer" class="absolute right-0 top-0 bottom-0 w-64 bg-white dark:bg-slate-800 shadow-2xl p-6 transform translate-x-full transition-transform duration-300 flex flex-col" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-['Bubblegum_Sans'] text-xl text-[#FFB7C5] dark:text-pink-400">Menu</h2>
            <button id="jc-mobile-menu-close" class="p-2 bg-gray-100 dark:bg-slate-700 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
            </button>
        </div>
        <div class="flex flex-col gap-2 flex-grow overflow-y-auto">
            <?php
            wp_nav_menu(array(
                'theme_location'  => 'primary',
                'container'       => false,
                'menu_class'      => 'flex flex-col gap-2',
                'fallback_cb'     => false,
                // Adding Tailwind classes directly to anchor tags inside the menu
                'link_before'     => '<span class="block w-full text-left text-lg font-bold p-3 rounded-2xl transition-colors text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">',
                'link_after'      => '</span>'
            ));
            ?>
        </div>
    </div>
</div>
