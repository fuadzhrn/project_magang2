// Mobile sticky footer: hide on scroll down, show on scroll up
// Works for both .modern-footer and .minimal-footer variants
(function () {
  const isMobile = () => window.innerWidth <= 768;
  const footerBar = document.querySelector(
    '.modern-footer .footer-bottom, .minimal-footer .footer-bottom'
  );
  if (!footerBar) return;

  // Respect user preference for reduced motion
  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const prefersReducedMotion = () => motionQuery.matches === true;

  const setVars = () => {
    const h = footerBar.offsetHeight || 64;
    document.documentElement.style.setProperty(
      '--footer-mobile-h',
      h + 6 + 'px'
    );
  };

  let lastY = window.pageYOffset || 0;
  let ticking = false;
  const threshold = 8; // small deadzone to avoid jitter

  const onScroll = () => {
    // If user prefers reduced motion, don't auto-hide
    if (prefersReducedMotion()) {
      footerBar.classList.remove('is-hidden');
      return;
    }
    if (!isMobile()) {
      footerBar.classList.remove('is-hidden');
      return;
    }
    const y = window.pageYOffset || 0;
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (y > lastY + threshold) {
          // scrolling down -> hide
          footerBar.classList.add('is-hidden');
        } else if (y < lastY - threshold || y < 80) {
          // scrolling up or near top -> show
          footerBar.classList.remove('is-hidden');
        }
        lastY = y;
        ticking = false;
      });
      ticking = true;
    }
  };

  // Init
  setVars();
  window.addEventListener('resize', setVars);
  window.addEventListener('orientationchange', setVars);
  window.addEventListener('load', setVars);
  window.addEventListener('scroll', onScroll, { passive: true });

  // React to changes in reduced-motion preference dynamically
  if (typeof motionQuery.addEventListener === 'function') {
    motionQuery.addEventListener('change', () => {
      // Ensure visible when switching to reduced motion
      if (prefersReducedMotion()) {
        footerBar.classList.remove('is-hidden');
      }
    });
  } else if (typeof motionQuery.addListener === 'function') {
    // Safari fallback
    motionQuery.addListener(() => {
      if (prefersReducedMotion()) {
        footerBar.classList.remove('is-hidden');
      }
    });
  }
})();
