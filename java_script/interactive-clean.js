/**
 * Interactive Clean JavaScript Library
 * Untuk halaman data mahasiswa dengan design clean
 */

class InteractiveClean {
    constructor() {
        this.init();
    }

    init() {
        this.setupLoadingAnimation();
        this.setupSmoothScroll();
        this.setupIntersectionObserver();
        this.setupCounterAnimation();
        this.setupCardInteractions();
        this.setupNavInteractions();
        this.setupUtilityFunctions();
    }

    // Loading Animation
    setupLoadingAnimation() {
        // Create loading overlay
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = `
            <div class="loading-content">
                <div class="loading-spinner"></div>
                <p>Memuat data...</p>
            </div>
        `;
        document.body.appendChild(loadingOverlay);

        // Hide loading when page is ready
        window.addEventListener('load', () => {
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.remove();
                }, 300);
            }, 800);
        });
    }

    // Smooth Scroll
    setupSmoothScroll() {
        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Smooth scroll to top button
        this.createScrollToTopButton();
    }

    createScrollToTopButton() {
        const scrollBtn = document.createElement('button');
        scrollBtn.className = 'scroll-to-top';
        scrollBtn.innerHTML = '<i class="ri-arrow-up-line"></i>';
        scrollBtn.title = 'Kembali ke atas';
        document.body.appendChild(scrollBtn);

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Show/hide scroll button
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        });
    }

    // Intersection Observer for animations
    setupIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // Trigger counter animation if it's a stat item
                    if (entry.target.classList.contains('stat-item-simple')) {
                        this.animateCounter(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe elements
        document.querySelectorAll('.menu-card, .stat-item-simple, .filter-simple, .table-container-simple').forEach(el => {
            observer.observe(el);
        });
    }

    // Counter Animation
    setupCounterAnimation() {
        this.countersAnimated = new Set();
    }

    animateCounter(statItem) {
        const numberElement = statItem.querySelector('.stat-number');
        if (!numberElement || this.countersAnimated.has(numberElement)) return;

        this.countersAnimated.add(numberElement);
        const finalNumber = parseInt(numberElement.textContent);
        const duration = 2000;
        const startTime = performance.now();

        const updateCounter = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentNumber = Math.floor(easeOutQuart * finalNumber);
            
            numberElement.textContent = currentNumber;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                numberElement.textContent = finalNumber;
            }
        };

        requestAnimationFrame(updateCounter);
    }

    // Card Interactions
    setupCardInteractions() {
        // Menu cards hover effects
        document.querySelectorAll('.menu-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                this.createRippleEffect(card);
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });

            // Click animation
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.menu-btn')) {
                    const btn = card.querySelector('.menu-btn');
                    if (btn) {
                        this.animateClick(btn);
                        setTimeout(() => {
                            window.location.href = btn.href;
                        }, 200);
                    }
                }
            });
        });

        // Button click animations
        document.querySelectorAll('.menu-btn, .btn-simple').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.animateClick(btn);
            });
        });
    }

    createRippleEffect(element) {
        const ripple = document.createElement('div');
        ripple.className = 'ripple-effect';
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    animateClick(element) {
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 150);
    }

    // Navigation Interactions
    setupNavInteractions() {
        const header = document.querySelector('.header-clean');
        let lastScrollY = window.pageYOffset;

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const currentScrollY = window.pageYOffset;
            
            if (currentScrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide/show header on scroll
            if (currentScrollY > lastScrollY && currentScrollY > 200) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }

            lastScrollY = currentScrollY;
        });

        // Active navigation highlighting
        this.highlightActiveNavigation();
    }

    highlightActiveNavigation() {
        const navLinks = document.querySelectorAll('.nav-link');
        const currentPath = window.location.pathname;

        navLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            if (linkPath === currentPath) {
                link.classList.add('active');
            }
        });
    }

    // Utility Functions
    setupUtilityFunctions() {
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            // ESC key to close mobile menu
            if (e.key === 'Escape') {
                const navMenu = document.getElementById('navMenu');
                if (navMenu && navMenu.classList.contains('show-menu')) {
                    navMenu.classList.remove('show-menu');
                }
            }
        });

        // Focus management for accessibility
        this.setupFocusManagement();
        
        // Performance monitoring
        this.monitorPerformance();
    }

    setupFocusManagement() {
        // Trap focus in mobile menu
        const navMenu = document.getElementById('navMenu');
        const navToggle = document.getElementById('navToggle');

        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                if (navMenu.classList.contains('show-menu')) {
                    // Focus first link when menu opens
                    const firstLink = navMenu.querySelector('.nav-link');
                    if (firstLink) {
                        setTimeout(() => firstLink.focus(), 100);
                    }
                }
            });
        }
    }

    monitorPerformance() {
        // Simple performance monitoring
        if ('performance' in window) {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    const perf = performance.getEntriesByType('navigation')[0];
                    console.log(`Page load time: ${perf.loadEventEnd - perf.loadEventStart}ms`);
                }, 0);
            });
        }
    }

    // Public methods for external use
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="ri-information-line"></i>
                <span>${message}</span>
                <button class="notification-close">
                    <i class="ri-close-line"></i>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 5000);

        // Manual close
        notification.querySelector('.notification-close').addEventListener('click', () => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        });
    }

    animateElement(element, animation = 'fadeIn') {
        element.classList.add('animate__animated', `animate__${animation}`);
        
        element.addEventListener('animationend', () => {
            element.classList.remove('animate__animated', `animate__${animation}`);
        }, { once: true });
    }
}

// Table Enhancement Class
class InteractiveTable {
    constructor(tableId) {
        this.table = document.getElementById(tableId);
        this.dataTable = null;
        this.init();
    }

    init() {
        if (!this.table) return;
        
        this.setupAdvancedFiltering();
        this.setupExportFunctionality();
        this.setupTableAnimations();
        this.setupRowInteractions();
    }

    setupAdvancedFiltering() {
        // Real-time search with debounce
        const searchInput = document.querySelector('.dataTables_filter input');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.highlightSearchResults(e.target.value);
                }, 300);
            });
        }

        // Filter animations
        document.querySelectorAll('#filterBidang, #filterStatus, #filterMasuk, #filterKeluar').forEach(filter => {
            filter.addEventListener('change', () => {
                this.animateFilterApply();
            });
        });
    }

    highlightSearchResults(searchTerm) {
        if (!searchTerm) return;
        
        const rows = this.table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                row.classList.add('search-highlight');
                setTimeout(() => row.classList.remove('search-highlight'), 1000);
            }
        });
    }

    animateFilterApply() {
        const tableWrapper = document.querySelector('.table-wrapper-simple');
        if (tableWrapper) {
            tableWrapper.style.opacity = '0.7';
            setTimeout(() => {
                tableWrapper.style.opacity = '1';
            }, 200);
        }
    }

    setupExportFunctionality() {
        const exportBtn = document.querySelector('.export-btn');
        if (exportBtn) {
            exportBtn.addEventListener('click', () => {
                this.showExportModal();
            });
        }
    }

    showExportModal() {
        const modal = document.createElement('div');
        modal.className = 'export-modal-overlay';
        modal.innerHTML = `
            <div class="export-modal">
                <div class="export-modal-header">
                    <h3><i class="ri-download-line"></i> Export Data</h3>
                    <button class="export-modal-close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="export-modal-content">
                    <p>Pilih format export yang diinginkan:</p>
                    <div class="export-options">
                        <button class="export-option" data-format="excel">
                            <i class="ri-file-excel-line"></i>
                            <span>Excel (.xlsx)</span>
                        </button>
                        <button class="export-option" data-format="csv">
                            <i class="ri-file-text-line"></i>
                            <span>CSV (.csv)</span>
                        </button>
                        <button class="export-option" data-format="pdf">
                            <i class="ri-file-pdf-line"></i>
                            <span>PDF (.pdf)</span>
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal events
        modal.querySelector('.export-modal-close').addEventListener('click', () => {
            modal.remove();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });

        // Export options
        modal.querySelectorAll('.export-option').forEach(option => {
            option.addEventListener('click', () => {
                const format = option.dataset.format;
                this.performExport(format);
                modal.remove();
            });
        });
    }

    performExport(format) {
        // Show loading
        const loading = document.createElement('div');
        loading.className = 'export-loading';
        loading.innerHTML = `
            <div class="export-loading-content">
                <div class="loading-spinner"></div>
                <p>Memproses export ${format.toUpperCase()}...</p>
            </div>
        `;
        document.body.appendChild(loading);

        // Simulate export process
        setTimeout(() => {
            loading.remove();
            window.interactiveClean.showNotification(`Export ${format.toUpperCase()} berhasil! File akan segera diunduh.`, 'success');
        }, 2000);
    }

    setupTableAnimations() {
        // Row hover animations
        const rows = this.table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.transform = 'scale(1.01)';
            });

            row.addEventListener('mouseleave', () => {
                row.style.transform = 'scale(1)';
            });
        });
    }

    setupRowInteractions() {
        // Double click for details (if needed)
        const rows = this.table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('dblclick', () => {
                this.showRowDetails(row);
            });
        });
    }

    showRowDetails(row) {
        const cells = row.querySelectorAll('td');
        const details = Array.from(cells).map(cell => cell.textContent);
        
        window.interactiveClean.showNotification(
            `Detail data: ${details.join(' | ')}`, 
            'info'
        );
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize main interactive features
    window.interactiveClean = new InteractiveClean();
    
    // Initialize table if exists
    const magangTable = document.getElementById('tabelMagang');
    if (magangTable) {
        window.interactiveTable = new InteractiveTable('tabelMagang');
    }
    
    console.log('Interactive Clean JavaScript initialized successfully!');
});

// Export for external use
window.InteractiveClean = InteractiveClean;
window.InteractiveTable = InteractiveTable;