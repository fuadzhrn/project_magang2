    </div>
    <!-- End Main Container -->

    <!-- Modern Footer -->
    <footer class="footer-modern">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-copyright"></i> 2025 - <?=date('Y')  ?> PLN UID Sulselrabar Admin Panel | 
                Developed by <strong>FFA Team - UNM</strong>
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <!-- Use full jQuery (not slim) because we use effects like delay/fade/slide -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    
    <!-- Modern Admin JS -->
    <script>
        // Add smooth scrolling and animations
        $(document).ready(function() {
            // Animate cards on load
            $('.card-modern, .dashboard-card').each(function(i) {
                $(this).delay(i * 100).queue(function(next) {
                    $(this).addClass('fade-in');
                    next();
                });
            });
            
            // Add loading state on form submit (avoid blocking native submit)
            $('form').on('submit', function() {
                // Try to find the clicked submit button; fallback to the first submit button
                var btn = $(this).find('button[type="submit"]:focus');
                if (!btn.length) {
                    btn = $(this).find('button[type="submit"]').first();
                }
                if (btn.length) {
                    if (!btn.data('original-html')) {
                        btn.data('original-html', btn.html());
                    }
                    btn.html('<span class="loading"></span> Processing...');
                    btn.prop('disabled', true);
                }
                // Do not re-enable here; navigation will occur. If the page
                // is re-rendered with errors, buttons will be enabled on load.
            });
            
            // Auto-hide alerts
            $('.alert-modern').delay(5000).fadeOut();
            
            // Mobile menu enhancements
            $('.navbar-toggler').click(function() {
                $(this).toggleClass('active');
            });
            
            // Close mobile menu when clicking on a link
            $('.navbar-nav .nav-link').click(function() {
                if ($(window).width() < 768) {
                    $('.navbar-collapse').collapse('hide');
                    $('.navbar-toggler').removeClass('active');
                }
            });
            
            // Handle user dropdown in mobile
            if ($(window).width() < 768) {
                $('#userDropdown').click(function(e) {
                    e.preventDefault();
                    $(this).next('.dropdown-menu').slideToggle();
                });
            }
            
            // Close dropdown when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').slideUp();
                }
            });
        });
    </script>
  </body>
</html>