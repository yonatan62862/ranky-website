document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('hero-lottie');
    if (!container || typeof lottie === 'undefined') return;

    lottie.loadAnimation({
        container: container,
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: heroLottieData.path
    });
});
