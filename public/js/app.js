// Dive Buddy - Application JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 300);
        }, 5000);
    });

    // Star rating UI
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    const starsContainer = document.querySelector('.star-rating');
    if (starsContainer && ratingInputs.length) {
        const stars = starsContainer.querySelectorAll('.star');
        function highlight(index) {
            stars.forEach((star, i) => {
                star.classList.toggle('filled', i <= index);
            });
        }
        stars.forEach((star, idx) => {
            star.addEventListener('mouseenter', () => highlight(idx));
            star.addEventListener('click', function () {
                ratingInputs[idx].checked = true;
                highlight(idx);
            });
        });
        starsContainer.addEventListener('mouseleave', function () {
            const checked = document.querySelector('input[name="rating"]:checked');
            stars.forEach((s, i) => s.classList.toggle('filled', checked && i < parseInt(checked.value)));
        });
    }

    // Confirm destructive actions
    const deleteLinks = document.querySelectorAll('[data-confirm]');
    deleteLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm(link.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });
});
