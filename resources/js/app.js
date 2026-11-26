document.querySelectorAll('[data-copy-link]').forEach((button) => {
    button.addEventListener('click', async () => {
        const originalLabel = button.textContent;

        try {
            await navigator.clipboard.writeText(button.dataset.copyLink);
            button.textContent = 'Link copied';
        } catch {
            button.textContent = 'Copy unavailable';
        }

        window.setTimeout(() => {
            button.textContent = originalLabel;
        }, 2200);
    });

    document.querySelectorAll('[data-analytics-event]').forEach((element) => {
        element.addEventListener('click', () => {
            const eventName = element.dataset.analyticsEvent;

            if (!eventName) {
                return;
            }

            window.dispatchEvent(new CustomEvent('cic:analytics', {
                detail: {
                    name: eventName,
                },
            }));

            if (typeof window.gtag === 'function') {
                window.gtag('event', eventName);
            }
        });
    });

});

document.querySelectorAll('[data-mobile-menu-toggle]').forEach((toggle) => {
    const menu = document.getElementById(toggle.getAttribute('aria-controls'));
    const label = toggle.querySelector('[data-mobile-menu-label]');

    if (!menu) {
        return;
    }

    const closeMenu = () => {
        menu.classList.add('hidden');
        toggle.setAttribute('aria-expanded', 'false');
        if (label) {
            label.textContent = 'Menu';
        }
    };

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

        menu.classList.toggle('hidden', isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
        if (label) {
            label.textContent = isOpen ? 'Menu' : 'Close';
        }

        if (!isOpen) {
            menu.querySelector('a')?.focus();
        }
    });

    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
});

document.querySelectorAll('[data-faq-toggle]').forEach((toggle) => {
    const panel = document.getElementById(toggle.getAttribute('aria-controls'));

    if (!panel) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

        toggle.setAttribute('aria-expanded', String(!isExpanded));
        panel.hidden = isExpanded;
    });
});

const backToTop = document.querySelector('[data-back-to-top]');

if (backToTop) {
    const updateBackToTop = () => {
        const isVisible = window.scrollY > 480;

        backToTop.dataset.visible = String(isVisible);
        backToTop.setAttribute('aria-hidden', String(!isVisible));
        backToTop.tabIndex = isVisible ? 0 : -1;
    };

    window.addEventListener('scroll', updateBackToTop, { passive: true });
    updateBackToTop();

    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
        });
    });
}

const lightboxTriggers = [...document.querySelectorAll('[data-lightbox-trigger]')];
const lightbox = document.querySelector('[data-lightbox-modal]');

if (lightbox && lightboxTriggers.length > 0) {
    const image = lightbox.querySelector('[data-lightbox-image]');
    const caption = lightbox.querySelector('[data-lightbox-caption-output]');
    const counter = lightbox.querySelector('[data-lightbox-counter]');
    const closeButton = lightbox.querySelector('[data-lightbox-close]');
    let currentIndex = 0;
    let previousFocus;

    const renderImage = (index) => {
        currentIndex = (index + lightboxTriggers.length) % lightboxTriggers.length;
        const trigger = lightboxTriggers[currentIndex];
        image.src = trigger.dataset.lightboxSrc;
        image.alt = trigger.dataset.lightboxAlt || '';
        caption.textContent = trigger.dataset.lightboxCaption || '';
        counter.textContent = `${currentIndex + 1} of ${lightboxTriggers.length}`;
    };

    const closeLightbox = () => {
        lightbox.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        previousFocus?.focus();
    };

    lightboxTriggers.forEach((trigger, index) => {
        trigger.addEventListener('click', () => {
            previousFocus = document.activeElement;
            renderImage(index);
            lightbox.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            closeButton.focus();
        });
    });

    closeButton.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });
    lightbox.querySelector('[data-lightbox-previous]').addEventListener('click', () => renderImage(currentIndex - 1));
    lightbox.querySelector('[data-lightbox-next]').addEventListener('click', () => renderImage(currentIndex + 1));
    document.addEventListener('keydown', (event) => {
        if (lightbox.classList.contains('hidden')) {
            return;
        }

        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrowLeft') {
            renderImage(currentIndex - 1);
        } else if (event.key === 'ArrowRight') {
            renderImage(currentIndex + 1);
        }
    });
}

const intro = document.querySelector('[data-cic-intro]');
const introRoot = document.documentElement;

if (intro && introRoot.dataset.cicIntroPending === 'true') {
    const introImage = intro.querySelector('[data-cic-intro-image]');
    const skipButton = intro.querySelector('[data-cic-intro-skip]');
    const animationSource = introImage?.dataset.src;

    if (!introImage || !skipButton || !animationSource) {
        console.error('CIC intro could not start because required markup or its animation is missing.');
        delete introRoot.dataset.cicIntroPending;
    } else if (window.getComputedStyle(intro).getPropertyValue('--cic-intro-styles-loaded').trim() !== '1') {
        console.warn('CIC intro skipped because its styles did not load.');
        delete introRoot.dataset.cicIntroPending;
    } else {
        const pageContent = [...document.body.children].filter((element) => element !== intro);
        const motionPreference = window.matchMedia('(prefers-reduced-motion: reduce)');
        const introStartedAt = performance.now();
        let loadDeadline;
        let animationTimer;
        let cleanupTimer;
        let isFinished = false;
        let hasImageLoaded = false;

        const cleanupIntro = () => {
            window.clearTimeout(loadDeadline);
            window.clearTimeout(animationTimer);
            window.clearTimeout(cleanupTimer);
            document.removeEventListener('keydown', handleEscape);
            motionPreference.removeEventListener('change', handleMotionPreferenceChange);
            introRoot.removeAttribute('data-cic-intro-pending');
            introRoot.removeAttribute('data-cic-intro-leaving');
            introRoot.removeAttribute('data-cic-intro-controller-ready');
            introImage.removeAttribute('src');
            pageContent.forEach((element) => {
                element.inert = false;
            });

            if (document.activeElement === skipButton) {
                skipButton.blur();
            }
        };

        const finishIntro = (shouldFade = true) => {
            if (isFinished) {
                return;
            }

            isFinished = true;
            window.clearTimeout(loadDeadline);
            window.clearTimeout(animationTimer);

            if (!shouldFade || motionPreference.matches) {
                cleanupIntro();
                return;
            }

            introRoot.dataset.cicIntroLeaving = 'true';
            cleanupTimer = window.setTimeout(cleanupIntro, 650);
        };

        const handleEscape = (event) => {
            if (event.key === 'Escape') {
                finishIntro();
            }
        };

        const handleMotionPreferenceChange = (event) => {
            if (event.matches) {
                finishIntro(false);
            }
        };

        const handleImageLoad = () => {
            if (isFinished || hasImageLoaded) {
                return;
            }

            if (introImage.naturalWidth === 0) {
                console.warn('CIC intro animation failed to load; showing the homepage.');
                finishIntro(false);
                return;
            }

            hasImageLoaded = true;
            window.clearTimeout(loadDeadline);
            animationTimer = window.setTimeout(
                () => finishIntro(),
                Math.max(0, 3850 - (performance.now() - introStartedAt)),
            );
        };

        introImage.addEventListener('load', handleImageLoad, { once: true });
        introImage.addEventListener('error', () => {
            console.warn('CIC intro animation failed to load; showing the homepage.');
            finishIntro(false);
        }, { once: true });
        skipButton.addEventListener('click', () => finishIntro());
        document.addEventListener('keydown', handleEscape);
        motionPreference.addEventListener('change', handleMotionPreferenceChange);
        loadDeadline = window.setTimeout(() => {
            console.warn('CIC intro skipped because the animation did not load in time.');
            finishIntro(false);
        }, 2200);
        introImage.src = animationSource;
        pageContent.forEach((element) => {
            element.inert = true;
        });
        introRoot.dataset.cicIntroControllerReady = 'true';
        skipButton.focus({ preventScroll: true });

        if (introImage.complete) {
            handleImageLoad();
        }
    }
}
