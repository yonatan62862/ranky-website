document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-menu');
    const siteHeader = document.querySelector('.site-header');

    if (!hamburger || !mobileMenu) return;

    hamburger.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('is-open');
        hamburger.setAttribute('aria-expanded', isOpen);
        document.body.classList.toggle('menu-open', isOpen);
    });

    // Sticky header: add background on scroll (mobile only)
    if (siteHeader && window.matchMedia('(max-width: 1024px)').matches) {
        const SCROLL_THRESHOLD = 60;

        const updateHeaderBg = () => {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > SCROLL_THRESHOLD);
        };

        window.addEventListener('scroll', updateHeaderBg, { passive: true });
        updateHeaderBg(); // run once on load in case page is already scrolled
    }
});
