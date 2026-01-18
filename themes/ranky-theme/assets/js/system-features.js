/**
 * System Features Interactive Navigation
 * Handles the dot navigation and card switching for the "What You Gain" system section
 */

(function() {
    'use strict';

    function initSystemFeatures() {
        const featuresWrapper = document.querySelector('.system__features-wrapper');
        if (!featuresWrapper) return;

        const dots = featuresWrapper.querySelectorAll('.system__dot');
        const cards = featuresWrapper.querySelectorAll('.system__feature-card');

        if (dots.length === 0 || cards.length === 0) return;

        // Handle dot click
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                switchToFeature(index);
            });
        });

        // Auto-rotate feature (optional - can be disabled)
        let autoRotateInterval;
        const startAutoRotate = () => {
            let currentIndex = 0;
            autoRotateInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % dots.length;
                switchToFeature(currentIndex);
            }, 5000); // Change every 5 seconds
        };

        // Pause auto-rotate on hover
        featuresWrapper.addEventListener('mouseenter', () => {
            if (autoRotateInterval) {
                clearInterval(autoRotateInterval);
            }
        });

        // Resume auto-rotate on mouse leave
        featuresWrapper.addEventListener('mouseleave', () => {
            startAutoRotate();
        });

        function switchToFeature(index) {
            // Remove active classes
            dots.forEach(dot => dot.classList.remove('system__dot--active'));
            cards.forEach(card => card.classList.remove('system__feature-card--active'));

            // Add active classes to selected items
            if (dots[index]) {
                dots[index].classList.add('system__dot--active');
            }
            if (cards[index]) {
                cards[index].classList.add('system__feature-card--active');
            }
        }

        // Start auto-rotate
        startAutoRotate();
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSystemFeatures);
    } else {
        initSystemFeatures();
    }
})();

