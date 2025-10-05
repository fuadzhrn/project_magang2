// ===== ULTRA MODERN PLN WEBSITE - ADVANCED JAVASCRIPT ===== //

class PLNWebsite {
    constructor() {
        this.initializeComponents();
        this.setupEventListeners();
        this.startAnimations();
    }

    initializeComponents() {
        this.header = document.getElementById('header');
        this.navToggle = document.getElementById('nav-toggle');
        this.navMenu = document.getElementById('nav-menu');
        this.backToTop = document.getElementById('backToTop');
        this.isScrolling = false;
        this.scrollPosition = 0;
        // Make sure header starts visible on mobile to avoid flicker
        if (this.header && window.innerWidth <= 768) {
            this.header.classList.add('header-visible');
        }
        
        console.log('🚀 PLN Ultra Modern Website Initialized');
    }

    setupEventListeners() {
        // Enhanced scroll handling with throttling
        this.throttledScrollHandler = this.throttle(this.handleScroll.bind(this), 16);
        window.addEventListener('scroll', this.throttledScrollHandler);
        
        // Mobile navigation
        this.setupMobileNavigation();
        
        // Back to top functionality
        this.setupBackToTop();
        
        // Smooth scrolling for links
        this.setupSmoothScrolling();
        
        // Enhanced window resize handling
        window.addEventListener('resize', this.throttle(this.handleResize.bind(this), 250));
        
        // Page visibility changes
        document.addEventListener('visibilitychange', this.handleVisibilityChange.bind(this));
    }

    startAnimations() {
        // Initialize all animations when DOM is ready
        this.initializeParticleSystem();
        this.initializeGeometricShapes();
        this.initializeTypewriterEffect();
        this.initializeCounterAnimations();
        this.initializeScrollRevealAnimations();
        this.initializeCardHoverEffects();
        this.initializeAdvancedCursor();
        this.initializeParallaxEffects();
        this.initializeFooterReveal();
    }

    // ===== UTILITY FUNCTIONS ===== //
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    getRandomFloat(min, max) {
        return Math.random() * (max - min) + min;
    }

    getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // ===== ADVANCED PARTICLE SYSTEM ===== //
    initializeParticleSystem() {
        const particlesContainer = document.querySelector('.hero-particles');
        if (!particlesContainer) return;

        this.particles = [];
        const particleCount = window.innerWidth > 768 ? 40 : 20;

        // Create particle pool
        for (let i = 0; i < particleCount; i++) {
            this.createParticle(particlesContainer);
        }

        // Continuous particle generation
        setInterval(() => {
            if (this.particles.length < particleCount) {
                this.createParticle(particlesContainer);
            }
        }, 300);

        console.log(`✨ Particle system initialized with ${particleCount} particles`);
    }

    createParticle(container) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random properties
        const size = this.getRandomFloat(3, 8);
        const startX = this.getRandomFloat(0, 100);
        const duration = this.getRandomFloat(6, 12);
        const delay = this.getRandomFloat(0, 5);
        
        particle.style.cssText = `
            left: ${startX}%;
            width: ${size}px;
            height: ${size}px;
            animation-duration: ${duration}s;
            animation-delay: ${delay}s;
            opacity: ${this.getRandomFloat(0.3, 0.8)};
        `;
        
        container.appendChild(particle);
        this.particles.push(particle);
        
        // Remove particle after animation
        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
                this.particles = this.particles.filter(p => p !== particle);
            }
        }, (duration + delay) * 1000);
    }

    // ===== GEOMETRIC SHAPES ANIMATION ===== //
    initializeGeometricShapes() {
        const shapesContainer = document.querySelector('.geometric-shapes');
        if (!shapesContainer) return;

        for (let i = 0; i < 3; i++) {
            const shape = document.createElement('div');
            shape.className = 'shape';
            shapesContainer.appendChild(shape);
        }

        console.log('🔷 Geometric shapes initialized');
    }

    // ===== ADVANCED TYPEWRITER EFFECT ===== //
    initializeTypewriterEffect() {
        const typewriterElement = document.querySelector('.hero-typewriter');
        if (!typewriterElement) return;

        const words = [
            'PLN UID Sulselrabar',
            'Portal Informasi',
            'Status Surat',
            'Sertifikat Digital'
        ];
        
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let typeSpeed = 100;

        const typeWriter = () => {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                typewriterElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
                typeSpeed = 50;
            } else {
                typewriterElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
                typeSpeed = 100;
            }

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2000; // Pause at end
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 500; // Pause before next word
            }

            setTimeout(typeWriter, typeSpeed);
        };

        // Add typewriter class and start animation
        const highlight = typewriterElement.closest('.highlight');
        if (highlight) {
            highlight.classList.add('gradient-text');
        }
        
        setTimeout(typeWriter, 1000);
        console.log('⌨️ Typewriter effect initialized');
    }

    // ===== ENHANCED COUNTER ANIMATIONS ===== //
    initializeCounterAnimations() {
        const counters = document.querySelectorAll('.stat-number');
        const observerOptions = {
            threshold: 0.7,
            rootMargin: '0px 0px -50px 0px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    this.animateCounter(entry.target);
                    entry.target.dataset.animated = 'true';
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });

        console.log(`🔢 Counter animations set up for ${counters.length} elements`);
    }

    animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target') || element.textContent);
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                element.textContent = Math.floor(current) + (target === 98 ? '%' : '+');
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + (target === 98 ? '%' : '+');
                
                // Add completion effect
                element.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }
        };

        updateCounter();
    }

    // ===== SCROLL REVEAL ANIMATIONS ===== //
    initializeScrollRevealAnimations() {
        const revealElements = document.querySelectorAll('.reveal-on-scroll, .service-card, .timeline-item, .feature-item');
        
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('revealed', 'fade-in-up');
                    }, index * 100);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(element => {
            element.classList.add('reveal-on-scroll');
            revealObserver.observe(element);
        });

        console.log(`👁️ Scroll reveal set up for ${revealElements.length} elements`);
    }

    // ===== ADVANCED CARD HOVER EFFECTS ===== //
    initializeCardHoverEffects() {
        const cards = document.querySelectorAll('.service-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                this.createRippleEffect(e.target, e);
                card.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });

            card.addEventListener('mousemove', (e) => {
                this.createCardTiltEffect(card, e);
            });
        });

        console.log(`🎴 Card hover effects initialized for ${cards.length} cards`);
    }

    createRippleEffect(element, event) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(15, 178, 190, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            pointer-events: none;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    createCardTiltEffect(card, event) {
        const rect = card.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const mouseX = event.clientX - centerX;
        const mouseY = event.clientY - centerY;
        
        const rotateX = (mouseY / rect.height) * 10;
        const rotateY = (mouseX / rect.width) * -10;
        
        card.style.transform = `
            translateY(-10px) 
            scale(1.02) 
            rotateX(${rotateX}deg) 
            rotateY(${rotateY}deg)
            perspective(1000px)
        `;
    }

    // ===== ADVANCED CURSOR EFFECTS ===== //
    initializeAdvancedCursor() {
        if (window.innerWidth <= 768) return; // Skip on mobile
        
        const cursor = document.createElement('div');
        cursor.className = 'custom-cursor';
        cursor.style.cssText = `
            position: fixed;
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, var(--pln-primary), var(--pln-accent));
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s ease;
            mix-blend-mode: difference;
        `;
        document.body.appendChild(cursor);

        const cursorFollower = document.createElement('div');
        cursorFollower.className = 'cursor-follower';
        cursorFollower.style.cssText = `
            position: fixed;
            width: 40px;
            height: 40px;
            border: 2px solid rgba(15, 178, 190, 0.5);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            transition: all 0.15s ease;
        `;
        document.body.appendChild(cursorFollower);

        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            cursor.style.left = mouseX - 10 + 'px';
            cursor.style.top = mouseY - 10 + 'px';
        });

        // Smooth follower animation
        const animateFollower = () => {
            followerX += (mouseX - followerX) * 0.1;
            followerY += (mouseY - followerY) * 0.1;
            
            cursorFollower.style.left = followerX - 20 + 'px';
            cursorFollower.style.top = followerY - 20 + 'px';
            
            requestAnimationFrame(animateFollower);
        };
        animateFollower();

        // Interactive elements
        const interactiveElements = document.querySelectorAll('a, button, .service-card, .nav-link');
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursorFollower.style.transform = 'scale(1.5)';
            });
            
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursorFollower.style.transform = 'scale(1)';
            });
        });

        console.log('🖱️ Advanced cursor effects initialized');
    }

    // ===== PARALLAX EFFECTS ===== //
    initializeParallaxEffects() {
        const bg = document.querySelector('.hero-background');
        const shapes = document.querySelector('.geometric-shapes');
        const imageWrap = document.querySelector('.hero-image-container');
        const floatCards = document.querySelectorAll('.floating-card');

        const onScroll = () => {
            const scrolled = window.pageYOffset || document.documentElement.scrollTop;
            if (bg) bg.style.transform = `translateY(${-(scrolled * 0.25)}px)`;
            if (shapes) shapes.style.transform = `translateY(${-(scrolled * 0.18)}px)`;
            if (imageWrap) imageWrap.style.transform = `translateY(${-(scrolled * 0.12)}px)`;
            floatCards.forEach((el, i) => {
                const depth = 0.35 + i * 0.05;
                el.style.transform = `translateY(${-(scrolled * depth)}px)`;
            });
        };

        window.addEventListener('scroll', this.throttle(onScroll, 16));

        console.log(`🌊 Parallax effects initialized for ${parallaxElements.length} elements`);
    }

    // ===== FOOTER REVEAL ===== //
    initializeFooterReveal() {
        const targets = document.querySelectorAll('.footer-brand, .footer-links, .footer-contact, .footer-cta');
        if (!targets.length) return;

        const io = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        targets.forEach(t => io.observe(t));
        console.log(`🦶 Footer reveal initialized for ${targets.length} blocks`);
    }

    // ===== ENHANCED SCROLL HANDLING ===== //
    handleScroll() {
        const scrollY = window.pageYOffset;
        const scrollDirection = scrollY > this.scrollPosition ? 'down' : 'up';
        this.scrollPosition = scrollY;

        // Enhanced header behavior
        if (scrollY > 100) {
            this.header?.classList.add('scrolled');
        } else {
            this.header?.classList.remove('scrolled');
        }

        // Back to top button
        if (this.backToTop) {
            if (scrollY > 300) {
                this.backToTop.classList.add('show');
            } else {
                this.backToTop.classList.remove('show');
            }
        }

        // Dynamic header behavior on mobile with hysteresis to prevent flicker
        if (window.innerWidth <= 768 && this.header) {
            // Don't hide header if mobile menu is open
            const menuOpen = this.navMenu?.classList.contains('show-menu');
            if (menuOpen) {
                this.header.classList.remove('header-hidden');
                this.header.classList.add('header-visible');
                return;
            }

            // Hysteresis thresholds
            const hideThreshold = 180; // start hide after this scroll
            const showThreshold = 90;  // show again when near top or scrolling up enough

            // Use direction and thresholds to toggle classes rather than inline styles
            if (scrollDirection === 'down' && scrollY > hideThreshold) {
                this.header.classList.add('header-hidden');
                this.header.classList.remove('header-visible');
            } else if (scrollDirection === 'up' || scrollY < showThreshold) {
                this.header.classList.remove('header-hidden');
                this.header.classList.add('header-visible');
            }
        }
    }

    // ===== MOBILE NAVIGATION ===== //
    setupMobileNavigation() {
        if (!this.navToggle || !this.navMenu) return;

        this.navToggle.addEventListener('click', () => {
            this.navMenu.classList.toggle('show-menu');
            this.navToggle.classList.toggle('active');
            this.toggleMenuOverlay();
            
            // Animate hamburger to X
            const icon = this.navToggle.querySelector('i');
            if (icon) {
                if (this.navMenu.classList.contains('show-menu')) {
                    icon.className = 'ri-close-line';
                } else {
                    icon.className = 'ri-menu-3-line';
                }
            }
        });

        // Close menu when clicking on links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                this.navMenu.classList.remove('show-menu');
                this.navToggle.classList.remove('active');
                this.hideMenuOverlay();
                
                const icon = this.navToggle.querySelector('i');
                if (icon) icon.className = 'ri-menu-3-line';
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!this.navToggle.contains(e.target) && !this.navMenu.contains(e.target)) {
                this.navMenu.classList.remove('show-menu');
                this.navToggle.classList.remove('active');
                this.hideMenuOverlay();
                
                const icon = this.navToggle.querySelector('i');
                if (icon) icon.style.transform = 'rotate(0deg)';
            }
        });

        console.log('📱 Mobile navigation initialized');
    }

    // ===== MENU OVERLAY ===== //
    toggleMenuOverlay() {
        if (this.navMenu.classList.contains('show-menu')) {
            this.showMenuOverlay();
        } else {
            this.hideMenuOverlay();
        }
    }

    showMenuOverlay() {
        if (!this.menuOverlay) {
            this.menuOverlay = document.createElement('div');
            this.menuOverlay.className = 'mobile-menu-overlay';
            this.menuOverlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.45);
                /* no blur here to avoid page-wide blur */
                z-index: 11000;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;
            document.body.appendChild(this.menuOverlay);
            
            // Close menu when clicking overlay
            this.menuOverlay.addEventListener('click', () => {
                this.navMenu.classList.remove('show-menu');
                this.navToggle.classList.remove('active');
                this.hideMenuOverlay();
                
                const icon = this.navToggle.querySelector('i');
                if (icon) icon.className = 'ri-menu-3-line';
            });
        }
        
        setTimeout(() => {
            this.menuOverlay.style.opacity = '1';
        }, 10);
    }

    hideMenuOverlay() {
        if (this.menuOverlay) {
            this.menuOverlay.style.opacity = '0';
            setTimeout(() => {
                if (this.menuOverlay && this.menuOverlay.parentNode) {
                    this.menuOverlay.parentNode.removeChild(this.menuOverlay);
                    this.menuOverlay = null;
                }
            }, 300);
        }
    }

    // ===== BACK TO TOP ===== //
    setupBackToTop() {
        if (!this.backToTop) return;

        this.backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // ===== SMOOTH SCROLLING ===== //
    setupSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        console.log('⚡ Smooth scrolling initialized');
    }

    // ===== WINDOW RESIZE HANDLING ===== //
    handleResize() {
        // Reinitialize particles on resize
        const particlesContainer = document.querySelector('.hero-particles');
        if (particlesContainer) {
            particlesContainer.innerHTML = '';
            this.particles = [];
            setTimeout(() => this.initializeParticleSystem(), 100);
        }

        console.log('📏 Window resized, components reinitialized');
    }

    // ===== PAGE VISIBILITY HANDLING ===== //
    handleVisibilityChange() {
        if (document.hidden) {
            // Pause animations when page is not visible
            document.body.style.animationPlayState = 'paused';
        } else {
            // Resume animations when page becomes visible
            document.body.style.animationPlayState = 'running';
        }
    }
}

// ===== LOADING SCREEN ===== //
class LoadingScreen {
    constructor() {
        this.createLoadingScreen();
    }

    createLoadingScreen() {
        const loader = document.createElement('div');
        loader.id = 'loading-screen';
        loader.innerHTML = `
            <div class="loader-content">
                <div class="pln-logo-loader">
                    <div class="loader-ring"></div>
                    <div class="loader-ring"></div>
                    <div class="loader-ring"></div>
                </div>
                <h3>PLN UID Sulselrabar</h3>
                <p>Loading Experience...</p>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
        `;
        
        loader.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #00627A, #019AA5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20000; /* ensure above header/nav/menu */
            color: white;
        `;

        document.body.appendChild(loader);
        // Prevent scroll beneath the loader
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';
        this.animateLoading();
    }

    animateLoading() {
        const progressFill = document.querySelector('.progress-fill');
        let progress = 0;
        
        const interval = setInterval(() => {
            progress += Math.random() * 15 + 5;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                setTimeout(() => this.hideLoading(), 500);
            }
            
            if (progressFill) {
                progressFill.style.width = progress + '%';
            }
        }, 150);
    }

    hideLoading() {
        const loader = document.getElementById('loading-screen');
        if (loader) {
            loader.style.opacity = '0';
            loader.style.transform = 'scale(1.1)';
            setTimeout(() => {
                loader.remove();
                // Restore scroll after loader removed
                document.documentElement.style.overflow = '';
                document.body.style.overflow = '';
            }, 300);
        }
    }
}

// ===== INITIALIZATION ===== //
document.addEventListener('DOMContentLoaded', () => {
    // Add required CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to { transform: scale(4); opacity: 0; }
        }
        
        .loader-content {
            text-align: center;
        }
        
        .pln-logo-loader {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
        }
        
        .loader-ring {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid #FFD400;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .loader-ring:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 10px;
            left: 10px;
        }
        
        .loader-ring:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 20px;
            left: 20px;
            animation-delay: -0.3s;
        }
        
        .loader-ring:nth-child(3) {
            width: 20px;
            height: 20px;
            top: 30px;
            left: 30px;
            animation-delay: -0.6s;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .progress-bar {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            margin: 20px auto;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: #FFD400;
            width: 0%;
            transition: width 0.3s ease;
        }
    `;
    document.head.appendChild(style);
    
    // Initialize loading screen
    new LoadingScreen();
    
    // Initialize main website after a short delay
    setTimeout(() => {
        window.plnWebsite = new PLNWebsite();
    }, 100);
});

// ===== PERFORMANCE MONITORING ===== //
window.addEventListener('load', () => {
    const loadTime = performance.now();
    console.log(`🚀 PLN Website loaded in ${Math.round(loadTime)}ms`);
    
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    }
});

// ===== ERROR HANDLING ===== //
window.addEventListener('error', (e) => {
    console.error('PLN Website Error:', e.error);
});

// ===== GALLERY MAGANG FUNCTIONALITY ===== //
class GalleryMagang {
    constructor() {
        this.tracks = document.querySelectorAll('.gallery-track');
        this.galleryItems = document.querySelectorAll('.gallery-item');
        this.init();
    }

    init() {
        this.setupHoverEffects();
        this.setupTouchSupport();
        this.setupIntersectionObserver();
        this.setupAccessibility();
        console.log('🖼️ Gallery Magang Initialized');
    }

    setupHoverEffects() {
        this.galleryItems.forEach(item => {
            item.addEventListener('mouseenter', this.handleItemHover.bind(this));
            item.addEventListener('mouseleave', this.handleItemLeave.bind(this));
            item.addEventListener('click', this.handleItemClick.bind(this));
        });
    }

    handleItemHover(e) {
        const item = e.currentTarget;
        const track = item.closest('.gallery-track');
        
        // Pause animation on hover
        track.style.animationPlayState = 'paused';
        
        // Add subtle scale effect to surrounding items
        const allItems = track.querySelectorAll('.gallery-item');
        allItems.forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.style.opacity = '0.7';
                otherItem.style.transform = 'scale(0.95)';
            }
        });
    }

    handleItemLeave(e) {
        const item = e.currentTarget;
        const track = item.closest('.gallery-track');
        
        // Resume animation
        track.style.animationPlayState = 'running';
        
        // Reset all items
        const allItems = track.querySelectorAll('.gallery-item');
        allItems.forEach(otherItem => {
            otherItem.style.opacity = '1';
            otherItem.style.transform = 'scale(1)';
        });
    }

    handleItemClick(e) {
        const item = e.currentTarget;
        const img = item.querySelector('img');
        const info = item.querySelector('.gallery-info');
        
        // Simple lightbox effect
        this.showLightbox(img.src, info.querySelector('h4').textContent, info.querySelector('p').textContent);
    }

    showLightbox(imageSrc, title, description) {
        // Create lightbox overlay
        const lightbox = document.createElement('div');
        lightbox.className = 'gallery-lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-overlay" onclick="this.parentElement.remove()">
                <div class="lightbox-content" onclick="event.stopPropagation()">
                    <button class="lightbox-close" onclick="this.closest('.gallery-lightbox').remove()">
                        <i class="ri-close-line"></i>
                    </button>
                    <img src="${imageSrc}" alt="${title}">
                    <div class="lightbox-info">
                        <h3>${title}</h3>
                        <p>${description}</p>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(lightbox);
        
        // Add lightbox styles dynamically
        if (!document.getElementById('lightbox-styles')) {
            const styles = document.createElement('style');
            styles.id = 'lightbox-styles';
            styles.textContent = `
                .gallery-lightbox {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 10000;
                    animation: fadeIn 0.3s ease;
                }
                .lightbox-overlay {
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.9);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 2rem;
                }
                .lightbox-content {
                    position: relative;
                    max-width: 90vw;
                    max-height: 90vh;
                    background: white;
                    border-radius: 12px;
                    overflow: hidden;
                    animation: scaleIn 0.3s ease;
                }
                .lightbox-close {
                    position: absolute;
                    top: 1rem;
                    right: 1rem;
                    background: rgba(0, 0, 0, 0.7);
                    color: white;
                    border: none;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    cursor: pointer;
                    z-index: 10001;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s ease;
                }
                .lightbox-close:hover {
                    background: rgba(0, 0, 0, 0.9);
                    transform: scale(1.1);
                }
                .lightbox-content img {
                    width: 100%;
                    height: auto;
                    max-height: 70vh;
                    object-fit: cover;
                }
                .lightbox-info {
                    padding: 1.5rem;
                    text-align: center;
                }
                .lightbox-info h3 {
                    color: var(--pln-primary);
                    margin-bottom: 0.5rem;
                }
                .lightbox-info p {
                    color: var(--text-secondary);
                }
            `;
            document.head.appendChild(styles);
        }
    }

    setupTouchSupport() {
        if ('ontouchstart' in window) {
            this.tracks.forEach(track => {
                let startX = 0;
                let currentTranslate = 0;
                
                track.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    track.style.animationPlayState = 'paused';
                });
                
                track.addEventListener('touchmove', (e) => {
                    const currentX = e.touches[0].clientX;
                    const diffX = currentX - startX;
                    currentTranslate = diffX;
                    track.style.transform = `translateX(${currentTranslate}px)`;
                });
                
                track.addEventListener('touchend', () => {
                    track.style.animationPlayState = 'running';
                    track.style.transform = '';
                });
            });
        }
    }

    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const track = entry.target.querySelector('.gallery-track');
                if (entry.isIntersecting) {
                    track.style.animationPlayState = 'running';
                } else {
                    track.style.animationPlayState = 'paused';
                }
            });
        }, { threshold: 0.3 });

        document.querySelectorAll('.gallery-row').forEach(row => {
            observer.observe(row);
        });
    }

    setupAccessibility() {
        this.galleryItems.forEach((item, index) => {
            item.setAttribute('tabindex', '0');
            item.setAttribute('role', 'button');
            item.setAttribute('aria-label', `Lihat gambar magang ${index + 1}`);
            
            item.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.handleItemClick(e);
                }
            });
        });
    }
}

// Initialize Gallery when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.gallery-section')) {
        new GalleryMagang();
    }
});

console.log('✅ PLN Ultra Modern JavaScript Loaded Successfully');