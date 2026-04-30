import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const ajaxConfig = window.jcTheme || {};
    const cartCountNodes = () => document.querySelectorAll('.js-jc-cart-count');
    const miniCartContentNodes = () => document.querySelectorAll('.js-jc-mini-cart-content');
    const cartItemsWrapper = document.getElementById('jc-cart-items');
    const cartSummaryWrapper = document.getElementById('jc-cart-summary');
    const miniCartPanel = document.getElementById('jc-mini-cart-panel');

    const ensureToastRoot = () => {
        let toastRoot = document.getElementById('jc-toast-root');
        if (!toastRoot) {
            toastRoot = document.createElement('div');
            toastRoot.id = 'jc-toast-root';
            toastRoot.className = 'fixed bottom-6 left-6 z-[60] flex flex-col gap-3 pointer-events-none';
            document.body.appendChild(toastRoot);
        }
        return toastRoot;
    };

    const showToast = (message, type = 'success') => {
        const toastRoot = ensureToastRoot();
        const toast = document.createElement('div');
        toast.className = `pointer-events-auto px-5 py-4 rounded-2xl shadow-2xl text-white font-bold ${type === 'error' ? 'bg-red-500' : 'bg-slate-800'}`;
        toast.textContent = message;
        toastRoot.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    };

    const setCartCount = (count) => {
        cartCountNodes().forEach((node) => {
            node.textContent = count;
            if (count > 0) {
                node.classList.remove('hidden');
            } else {
                node.classList.add('hidden');
            }
        });
    };

    const applyCartPayload = (payload) => {
        if (typeof payload.cart_count !== 'undefined') {
            setCartCount(payload.cart_count);
        }

        if (payload.mini_cart) {
            miniCartContentNodes().forEach((node) => {
                node.innerHTML = payload.mini_cart;
            });
        }

        if (payload.cart_items_html && cartItemsWrapper) {
            cartItemsWrapper.innerHTML = payload.cart_items_html;
        }

        if (payload.cart_summary_html && cartSummaryWrapper) {
            cartSummaryWrapper.innerHTML = payload.cart_summary_html;
        }
    };

    const sendCartRequest = async (action, data = {}) => {
        if (!ajaxConfig.ajaxUrl) {
            throw new Error('AJAX is not configured.');
        }

        const body = new URLSearchParams({
            action,
            nonce: ajaxConfig.nonce || '',
            ...data,
        });

        const response = await fetch(ajaxConfig.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            },
            body,
        });

        const json = await response.json();

        if (!json.success) {
            throw new Error(json?.data?.message || 'Request failed.');
        }

        applyCartPayload(json.data || {});
        return json.data || {};
    };

    const toggleMiniCart = (forceOpen = null) => {
        if (!miniCartPanel) {
            return;
        }

        const shouldOpen = forceOpen === null ? miniCartPanel.classList.contains('opacity-0') : forceOpen;

        if (shouldOpen) {
            miniCartPanel.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-2');
            miniCartPanel.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        } else {
            miniCartPanel.classList.add('opacity-0', 'pointer-events-none', 'translate-y-2');
            miniCartPanel.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
        }
    };

    // 1. Theme Toggle (Dark/Light Mode)
    const themeToggleBtn = document.getElementById('jc-theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
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

    document.addEventListener('click', async (event) => {
        const miniCartToggle = event.target.closest('[data-jc-mini-cart-toggle]');
        if (miniCartToggle) {
            event.preventDefault();
            toggleMiniCart();
            return;
        }

        const addToCartButton = event.target.closest('[data-jc-add-to-cart]');
        if (addToCartButton) {
            event.preventDefault();

            const productId = addToCartButton.getAttribute('data-product-id');
            if (!productId) {
                return;
            }

            addToCartButton.disabled = true;

            try {
                await sendCartRequest('jc_add_to_cart', {
                    product_id: productId,
                    quantity: 1,
                });
                showToast('Added to cart');
                toggleMiniCart(true);
            } catch (error) {
                showToast(error.message, 'error');
            } finally {
                addToCartButton.disabled = false;
            }
            return;
        }

        const cartActionButton = event.target.closest('[data-jc-cart-action]');
        if (cartActionButton) {
            const row = cartActionButton.closest('[data-cart-item-key]');
            if (!row) {
                return;
            }

            event.preventDefault();

            const cartItemKey = row.getAttribute('data-cart-item-key');
            const qtyInput = row.querySelector('[data-jc-cart-qty]');
            const currentQty = qtyInput ? parseInt(qtyInput.value, 10) || 0 : 0;
            const action = cartActionButton.getAttribute('data-jc-cart-action');

            let nextQty = currentQty;
            if (action === 'increase') {
                nextQty = currentQty + 1;
            } else if (action === 'decrease') {
                nextQty = Math.max(0, currentQty - 1);
            } else if (action === 'remove') {
                nextQty = 0;
            }

            if (qtyInput) {
                qtyInput.value = nextQty;
            }

            try {
                await sendCartRequest('jc_update_cart_item', {
                    cart_item_key: cartItemKey,
                    quantity: nextQty,
                });
                if (nextQty === 0) {
                    showToast('Item removed');
                }
            } catch (error) {
                showToast(error.message, 'error');
            }
        }
    });

    document.addEventListener('change', async (event) => {
        const qtyInput = event.target.closest('[data-jc-cart-qty]');
        if (!qtyInput) {
            return;
        }

        const row = qtyInput.closest('[data-cart-item-key]');
        if (!row) {
            return;
        }

        try {
            await sendCartRequest('jc_update_cart_item', {
                cart_item_key: row.getAttribute('data-cart-item-key'),
                quantity: qtyInput.value,
            });
        } catch (error) {
            showToast(error.message, 'error');
        }
    });

});