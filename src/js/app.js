import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Theme Toggle (Dark/Light Mode)
    const themeToggleBtn = document.getElementById('jc-theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            if (localStorage.getItem('jc-theme')) {
                if (localStorage.getItem('jc-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('jc-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('jc-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('jc-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('jc-theme', 'dark');
                }
            }
        });
    }

    // 2. Search Overlay Logic
    const searchToggleBtn = document.getElementById('jc-search-toggle');
    const searchCloseBtn = document.getElementById('jc-search-close');
    const searchOverlay = document.getElementById('jc-search-overlay');
    const searchInput = searchOverlay ? searchOverlay.querySelector('input[name="s"]') : null;

    if (searchToggleBtn && searchOverlay && searchCloseBtn) {
        // Open Search
        searchToggleBtn.addEventListener('click', () => {
            searchOverlay.classList.remove('opacity-0', 'pointer-events-none');
            if (searchInput) {
                setTimeout(() => searchInput.focus(), 100);
            }
        });
        // Close Search
        searchCloseBtn.addEventListener('click', () => {
            searchOverlay.classList.add('opacity-0', 'pointer-events-none');
        });
    }

    // 3. Mobile Menu Drawer Logic
    const mobileToggleBtn = document.getElementById('jc-mobile-menu-toggle');
    const mobileCloseBtn = document.getElementById('jc-mobile-menu-close');
    const mobileOverlay = document.getElementById('jc-mobile-drawer-overlay');
    const mobileDrawer = document.getElementById('jc-mobile-drawer');

    const openMobileMenu = () => {
        mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
        mobileDrawer.classList.remove('translate-x-full');
    };

    const closeMobileMenu = () => {
        mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
        mobileDrawer.classList.add('translate-x-full');
    };

    if (mobileToggleBtn && mobileCloseBtn && mobileOverlay && mobileDrawer) {
        mobileToggleBtn.addEventListener('click', openMobileMenu);
        mobileCloseBtn.addEventListener('click', closeMobileMenu);
        
        // Close menu when clicking outside the drawer (on the dark overlay)
        mobileOverlay.addEventListener('click', (e) => {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });
    }

});