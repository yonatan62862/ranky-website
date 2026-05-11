(function () {
    'use strict';

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function parseValue(text) {
        var match = text.match(/^([^0-9]*)(\d+(?:\.\d+)?)(.*)$/);
        if (!match) return null;
        return {
            prefix: match[1],
            number: parseFloat(match[2]),
            suffix: match[3]
        };
    }

    function animateCounter(el, parsed, duration) {
        var start = null;

        function step(timestamp) {
            if (!start) start = timestamp;
            var progress = Math.min((timestamp - start) / duration, 1);
            var eased = easeOutCubic(progress);
            var current = Math.round(parsed.number * eased);
            el.textContent = parsed.prefix + current + parsed.suffix;
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = parsed.prefix + parsed.number + parsed.suffix;
            }
        }

        requestAnimationFrame(step);
    }

    function initCounters() {
        var selectors = ['.results-card__value', '.industry-result-card__value'];
        var valueEls = [];

        selectors.forEach(function (selector) {
            document.querySelectorAll(selector).forEach(function (el) {
                var parsed = parseValue(el.textContent.trim());
                if (!parsed) return;
                el.dataset.counterPrefix = parsed.prefix;
                el.dataset.counterNumber = parsed.number;
                el.dataset.counterSuffix = parsed.suffix;
                el.textContent = parsed.prefix + '0' + parsed.suffix;
                valueEls.push(el);
            });
        });

        if (!valueEls.length) return;

        var section = document.querySelector('.results, .industry-results');
        if (!section) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                observer.disconnect();
                valueEls.forEach(function (el) {
                    animateCounter(el, {
                        prefix: el.dataset.counterPrefix,
                        number: parseFloat(el.dataset.counterNumber),
                        suffix: el.dataset.counterSuffix
                    }, 1400);
                });
            });
        }, { threshold: 0.3 });

        observer.observe(section);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCounters);
    } else {
        initCounters();
    }
})();
