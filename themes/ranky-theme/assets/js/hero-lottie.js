document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('hero-lottie');
    if (!container || typeof lottie === 'undefined') return;

    const path =
        typeof heroLottieData !== 'undefined' && heroLottieData.path
            ? heroLottieData.path
            : null;
    if (!path) return;

    lottie.loadAnimation({
        container: container,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: path
    });
});
