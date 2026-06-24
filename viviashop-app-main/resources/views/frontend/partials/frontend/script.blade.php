<!-- Scroll Shortcuts Widget -->
<div class="scroll-shortcuts-widget" id="scrollShortcuts">
    <button class="scroll-btn scroll-to-top-btn" aria-label="Kembali ke atas" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <i class="fas fa-chevron-up"></i>
    </button>
    <button class="scroll-btn scroll-to-bottom-btn" aria-label="Ke bagian bawah" onclick="window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' })">
        <i class="fas fa-chevron-down"></i>
    </button>
</div>

<style>
    .back-to-top {
        display: none !important;
    }

    .scroll-shortcuts-widget {
        position: fixed;
        right: 26px;
        bottom: 100px;
        z-index: 1010;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px) scale(0.9);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .scroll-shortcuts-widget.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
    }

    .scroll-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 1px solid rgba(15, 81, 50, 0.12);
        background: rgba(255, 255, 255, 0.88);
        color: #0f5132;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(15, 81, 50, 0.08);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .scroll-btn:hover {
        background: linear-gradient(135deg, #0f5132 0%, #198754 100%);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(15, 81, 50, 0.16);
    }

    .scroll-btn:active {
        transform: scale(0.95);
    }

    @media (max-width: 991.98px) {
        .scroll-shortcuts-widget {
            right: 20px;
            bottom: 172px !important; /* Positioned perfectly above the AI chat widget FAB */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var scrollWidget = document.getElementById('scrollShortcuts');
        if (scrollWidget) {
            var handleScroll = function() {
                if (window.scrollY > 250) {
                    scrollWidget.classList.add('visible');
                } else {
                    scrollWidget.classList.remove('visible');
                }
            };
            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll(); // Check initially
        }
    });
</script>

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('themes/ezone/assets/js/app.js') }}"></script>
    <script src="{{ asset('frontend/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".delete").on("click", function () {
            return confirm("Do you want to remove this?");
        });
    </script>
    @stack('script-alt')

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>