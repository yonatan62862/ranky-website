document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.success__track').forEach(track => {
        const cards = Array.from(track.children);
        if (!cards.length) return;

        // Duplicate cards to create seamless infinite loop
        cards.forEach(card => {
            const clone = card.cloneNode(true);
            clone.setAttribute('aria-hidden', 'true');
            track.appendChild(clone);
        });
    });
});
