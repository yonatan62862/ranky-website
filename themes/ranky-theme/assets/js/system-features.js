/**
 * System Features Interactive Navigation
 * Positions prev/active/next cards so inactive ones peek above and below the active card.
 */

(function() {
    'use strict';

    function initSystemFeatures() {
        const featuresWrapper = document.querySelector('.system__features-wrapper');
        if (!featuresWrapper) return;

        const dots      = Array.from(featuresWrapper.querySelectorAll('.system__dot'));
        const cards     = Array.from(featuresWrapper.querySelectorAll('.system__feature-card'));
        const container = featuresWrapper.querySelector('.system__features');
        const dotsEl    = featuresWrapper.querySelector('.system__dots');

        if (dots.length === 0 || cards.length === 0) return;

        const PEEK = 52; // px visible for inactive cards (above / below)

        // Align dots with the active card
        if (dotsEl) dotsEl.style.paddingTop = PEEK + 'px';

        function positionCards(activeIndex) {
            const total      = cards.length;
            const prevIndex  = (activeIndex - 1 + total) % total;
            const nextIndex  = (activeIndex + 1) % total;

            // Measure active card height BEFORE moving anything
            const activeCard  = cards[activeIndex];
            const cardHeight  = activeCard.offsetHeight;

            // Resize the features container so it fits: peek + card + peek
            container.style.height = (PEEK + cardHeight + PEEK) + 'px';

            cards.forEach((card, i) => {
                // Clear state classes
                card.classList.remove(
                    'system__feature-card--active',
                    'system__feature-card--prev',
                    'system__feature-card--next'
                );

                if (i === activeIndex) {
                    // Active card sits in the middle, offset by PEEK from the top
                    card.style.top        = PEEK + 'px';
                    card.style.opacity    = '1';
                    card.style.zIndex     = '3';
                    card.style.visibility = 'visible';
                    card.classList.add('system__feature-card--active');

                } else if (i === prevIndex) {
                    // Prev card starts at top=0 so its BEGINNING is visible above the active card.
                    // The portion below PEEK is hidden behind the active card (lower z-index).
                    card.style.top        = '0px';
                    card.style.opacity    = '0.55';
                    card.style.zIndex     = '2';
                    card.style.visibility = 'visible';
                    card.classList.add('system__feature-card--prev');

                } else if (i === nextIndex && total > 2) {
                    // Next card starts at top = 2*PEEK so its END (bottom PEEK px) is visible
                    // below the active card. The portion above is hidden behind the active card.
                    card.style.top        = (2 * PEEK) + 'px';
                    card.style.opacity    = '0.55';
                    card.style.zIndex     = '2';
                    card.style.visibility = 'visible';
                    card.classList.add('system__feature-card--next');

                } else {
                    card.style.opacity    = '0';
                    card.style.zIndex     = '0';
                    card.style.visibility = 'hidden';
                }
            });

            // Sync dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('system__dot--active', i === activeIndex);
            });
        }

        // Click on dot
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => switchToFeature(index));
        });

        let currentIndex = 0;
        let autoRotateInterval;

        function switchToFeature(index) {
            currentIndex = index;
            positionCards(index);
        }

        function startAutoRotate() {
            autoRotateInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % cards.length;
                positionCards(currentIndex);
            }, 5000);
        }

        featuresWrapper.addEventListener('mouseenter', () => clearInterval(autoRotateInterval));
        featuresWrapper.addEventListener('mouseleave', startAutoRotate);

        // Initial render — wait one frame so offsetHeight is available
        requestAnimationFrame(() => {
            positionCards(0);
            startAutoRotate();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSystemFeatures);
    } else {
        initSystemFeatures();
    }
})();
