// Cart count badge update
function updateCartBadge() {
    const badge = document.getElementById('cart-badge');
    if (badge) {
        const count = parseInt(badge.textContent);
        if (count > 0) {
            badge.classList.remove('hidden');
        }
    }
}

// Flash message auto-hide
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('[data-auto-dismiss]');
    alerts.forEach(alert => {
        const duration = parseInt(alert.dataset.autoDismiss) || 4000;
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s, transform 0.5s';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        }, duration);
    });

    // Mobile menu toggle
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Admin sidebar toggle (mobile)
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            if (sidebarOverlay) sidebarOverlay.classList.toggle('hidden');
        });
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
    }

    // Image preview for file inputs
    document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
        input.addEventListener('change', function () {
            const previewContainer = document.getElementById(this.dataset.preview);
            if (!previewContainer) return;
            previewContainer.innerHTML = '';

            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-20 h-20 object-cover rounded-lg border';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    });

    // Quantity input controls
    document.querySelectorAll('[data-qty-minus]').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');
            if (input && parseInt(input.value) > parseInt(input.min || 1)) {
                input.value = parseInt(input.value) - 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });
    document.querySelectorAll('[data-qty-plus]').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input[type="number"]');
            const max = parseInt(input.max) || 999;
            if (input && parseInt(input.value) < max) {
                input.value = parseInt(input.value) + 1;
                input.dispatchEvent(new Event('change'));
            }
        });
    });

    // Star rating interactive
    document.querySelectorAll('.star-rating').forEach(container => {
        const stars = container.querySelectorAll('.star');
        const input = container.querySelector('input[name="rating"]');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const val = parseInt(this.dataset.value);
                if (input) input.value = val;
                stars.forEach((s, i) => {
                    s.classList.toggle('active', i < val);
                });
            });
        });
    });
});
