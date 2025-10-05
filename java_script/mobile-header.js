// Mobile sticky header: hide on scroll down, show on scroll up
// Respects prefers-reduced-motion and avoids hiding when nav menu is open
(function () {
  const header = document.getElementById('header');
  if (!header) return;

  const isMobile = () => window.innerWidth <= 768;
  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const prefersReducedMotion = () => motionQuery.matches === true;

  let lastY = window.pageYOffset || 0;
  let ticking = false;
  const threshold = 8; // deadzone to reduce jitter

  function isMenuOpen() {
    const menu = document.getElementById('nav-menu');
    if (!menu) return false;
    // many pages use .show-menu for off-canvas open
    return menu.classList.contains('show-menu');
  }

  const onScroll = () => {
    if (!isMobile() || prefersReducedMotion()) {
      header.classList.remove('is-hidden');
      return;
    }

    const y = window.pageYOffset || 0;
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (isMenuOpen()) {
          header.classList.remove('is-hidden');
        } else if (y > lastY + threshold) {
          // scrolling down -> hide
          header.classList.add('is-hidden');
        } else if (y < lastY - threshold || y < 80) {
          // scrolling up or near top -> show
          header.classList.remove('is-hidden');
        }
        lastY = y;
        ticking = false;
      });
      ticking = true;
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  window.addEventListener('orientationchange', onScroll);

  // React to reduced motion changes
  if (typeof motionQuery.addEventListener === 'function') {
    motionQuery.addEventListener('change', onScroll);
  } else if (typeof motionQuery.addListener === 'function') {
    motionQuery.addListener(onScroll);
  }
})();
