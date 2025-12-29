document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.success__carousel').forEach(carousel => {
        const track = carousel.querySelector('.success__track');
        if (!track) return;

        let scrollSpeed = 0.5;
        let isPaused = false;
        let animationFrameId;

        function autoScroll() {
            if (!isPaused) {
                carousel.scrollLeft += scrollSpeed;

                // Reset to beginning when reaching the end for seamless loop
                if (carousel.scrollLeft >= carousel.scrollWidth - carousel.clientWidth - 1) {
                    carousel.scrollLeft = 0;
                }
            }
            animationFrameId = requestAnimationFrame(autoScroll);
        }

        // Pause on hover
        carousel.addEventListener('mouseenter', () => {
            isPaused = true;
        });

        carousel.addEventListener('mouseleave', () => {
            isPaused = false;
        });

        // Start auto-scroll using requestAnimationFrame for smooth animation
        autoScroll();
    });
});
