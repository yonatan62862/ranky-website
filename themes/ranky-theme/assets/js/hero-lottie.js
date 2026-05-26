document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('hero-lottie');
    if (!container || typeof lottie === 'undefined') return;

    const path =
        typeof heroLottieData !== 'undefined' && heroLottieData.path
            ? heroLottieData.path
            : null;
    if (!path) return;

    const animation = lottie.loadAnimation({
        container: container,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: path
    });

    const scale = parseFloat(container.dataset.lottieScale || '1', 10);
    if (Number.isNaN(scale) || scale === 1) return;

    function scaleLottieSvg() {
        const svg = container.querySelector('svg');
        if (!svg) return;

        svg.style.setProperty('transform', 'scale(' + scale + ')', 'important');
        svg.style.setProperty('transform-origin', 'center center', 'important');
    }

    animation.addEventListener('DOMLoaded', scaleLottieSvg);
    animation.addEventListener('data_ready', scaleLottieSvg);
});
