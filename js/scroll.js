document.addEventListener('DOMContentLoaded', () => {
    let lastScrollTop = 0;
    const body = document.body;
    const scrollThreshold = 100;

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > scrollThreshold) {
            body.classList.add('hide-topbar');
        } else {
            body.classList.remove('hide-topbar');
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });
});
