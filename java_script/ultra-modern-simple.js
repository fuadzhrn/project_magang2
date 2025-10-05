// ===== PLN SIMPLE JS (No Loading Screen) ===== //

class PLNWebsiteSimple {
    constructor() {
        this.initializeComponents();
        this.setupEventListeners();
        this.ensureVisibility();
        this.initOptionalEnhancements();
    }

    initializeComponents() {
        this.header = document.getElementById('header');
        this.navToggle = document.getElementById('nav-toggle');
        this.navMenu = document.getElementById('nav-menu');
    this.navIcon = this.navToggle ? this.navToggle.querySelector('i') : null;
    // Fix typo that prevented initialization and left AOS elements hidden
    this.backToTop = document.getElementById('backToTop');
        this.scrollPosition = 0;
        console.log('✅ PLN Simple JS initialized (no loading screen)');
    }

    setupEventListeners() {
        // Scroll handling
        window.addEventListener('scroll', () => this.handleScroll());

        // Mobile navigation
        if (this.navToggle && this.navMenu) {
            // ARIA for accessibility
            this.navToggle.setAttribute('role', 'button');
            this.navToggle.setAttribute('aria-controls', 'nav-menu');
            this.navToggle.setAttribute('aria-expanded', 'false');

            const openMenu = () => {
                this.navMenu.classList.add('show-menu');
                this.navToggle.classList.add('active');
                document.body.classList.add('no-scroll');
                this.navToggle.setAttribute('aria-expanded', 'true');
                // Swap icon to close
                if (this.navIcon) {
                    this.navIcon.className = 'ri-close-line';
                }
                // Add dim overlay
                if (!this.menuOverlay) {
                    this.menuOverlay = document.createElement('div');
                    this.menuOverlay.className = 'mobile-menu-overlay';
                    this.menuOverlay.style.cssText = `
                        position: fixed;
                        inset: 0;
                        background: rgba(0,0,0,0.45);
                        z-index: 11000;
                        opacity: 0;
                        transition: opacity 0.25s ease;
                    `;
                    document.body.appendChild(this.menuOverlay);
                    // click to close
                    this.menuOverlay.addEventListener('click', () => closeMenu());
                    // fade in
                    requestAnimationFrame(() => {
                        this.menuOverlay && (this.menuOverlay.style.opacity = '1');
                    });
                }
            };

            const closeMenu = () => {
                this.navMenu.classList.remove('show-menu');
                this.navToggle.classList.remove('active');
                document.body.classList.remove('no-scroll');
                this.navToggle.setAttribute('aria-expanded', 'false');
                // Swap icon back to hamburger
                if (this.navIcon) {
                    this.navIcon.className = 'ri-menu-3-line';
                }
                // Remove overlay with fade out
                if (this.menuOverlay) {
                    this.menuOverlay.style.opacity = '0';
                    setTimeout(() => {
                        this.menuOverlay && this.menuOverlay.remove();
                        this.menuOverlay = null;
                    }, 250);
                }
            };

            this.navToggle.addEventListener('click', () => {
                const isOpen = this.navMenu.classList.contains('show-menu');
                if (isOpen) closeMenu(); else openMenu();
            });

            // Close on link click
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => closeMenu());
            });

            // Close when clicking outside the menu/toggle
            document.addEventListener('click', (e) => {
                const clickedOutside = !this.navMenu.contains(e.target) && !this.navToggle.contains(e.target);
                if (clickedOutside) closeMenu();
            });

            // Close on ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeMenu();
            });

            // Auto-close when resizing to desktop breakpoint
            window.addEventListener('resize', () => {
                const isDesktop = window.innerWidth >= 993;
                if (isDesktop) closeMenu();
            });
        }

        // Back to top
        if (this.backToTop) {
            this.backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Smooth anchor scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href && href.length > 1) {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        const offsetTop = target.offsetTop - 100;
                        window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                    }
                }
            });
        });
    }

    handleScroll() {
        const scrollY = window.pageYOffset || document.documentElement.scrollTop;

        // Header style on scroll
        if (this.header) {
            if (scrollY > 100) this.header.classList.add('scrolled');
            else this.header.classList.remove('scrolled');
        }

        // Back to top visibility
        if (this.backToTop) {
            if (scrollY > 300) this.backToTop.classList.add('show');
            else this.backToTop.classList.remove('show');
        }
    }

    ensureVisibility() {
        // Ensure primary containers are visible (guards against CSS animations hiding content)
        const selectors = [
            'main', 'section', '.container', '.compact-header', '.quick-access-section',
            '.services-section', '.service-card', '.table-wrapper-modern', 'table', 'thead', 'tbody'
        ];
        selectors.forEach(sel => {
            document.querySelectorAll(sel).forEach(el => {
                el.style.visibility = 'visible';
                if (!getComputedStyle(el).display || getComputedStyle(el).display === 'none') {
                    // Use sensible defaults for common elements
                    const tag = el.tagName;
                    if (tag === 'TABLE') el.style.display = 'table';
                    else if (tag === 'THEAD') el.style.display = 'table-header-group';
                    else if (tag === 'TBODY') el.style.display = 'table-row-group';
                    else if (tag === 'TR') el.style.display = 'table-row';
                    else if (tag === 'TD' || tag === 'TH') el.style.display = 'table-cell';
                    else el.style.display = 'block';
                }
                el.style.opacity = '1';
            });
        });
    }

    initOptionalEnhancements() {
        // Initialize AOS if available (no loading dependency)
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 700, easing: 'ease-out-quart', once: true, offset: 60 });
        }
    }
}

// Initialize without loading screen
document.addEventListener('DOMContentLoaded', () => {
    window.plnSimple = new PLNWebsiteSimple();
});

// Log load performance (no loader)
window.addEventListener('load', () => {
    const loadTime = Math.round(performance.now());
    console.log(`⚡ Simple page loaded in ${loadTime}ms`);
});
