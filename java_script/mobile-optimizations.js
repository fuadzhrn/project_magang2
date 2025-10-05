// Global Mobile UX Enhancements
(function () {
  // Improve scrolling performance on touch devices
  document.addEventListener('touchstart', function () {}, { passive: true });

  // iOS momentum scrolling
  if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
    document.body.style.webkitOverflowScrolling = 'touch';
  }

  // Optional: haptics helper for buttons (opt-in: add data-haptic)
  document.addEventListener('click', function (e) {
    const el = e.target.closest('[data-haptic]');
    if (!el || !navigator.vibrate) return;
    const type = el.getAttribute('data-haptic');
    const patterns = {
      light: 20,
      medium: 60,
      heavy: 120,
      success: [40, 30, 40],
      error: [120, 40, 120]
    };
    navigator.vibrate(patterns[type] || 20);
  }, { passive: true });
})();
