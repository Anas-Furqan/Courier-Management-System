import './bootstrap';

const revealTargets = document.querySelectorAll('[data-reveal]');

if (revealTargets.length) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px',
        },
    );

    revealTargets.forEach((target) => observer.observe(target));
}

document.addEventListener('DOMContentLoaded', () => {
    const revealItems = document.querySelectorAll('[data-reveal]');

    if (!revealItems.length || !('IntersectionObserver' in window)) {
        revealItems.forEach((element) => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    revealItems.forEach((element) => observer.observe(element));
});
