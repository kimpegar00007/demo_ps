// Enhanced Animation Controller
class AnimationController {
    constructor() {
        this.init();
    }

    init() {
        this.setupPageTransitions();
        this.setupButtonAnimations();
        this.setupFormAnimations();
        this.setupScrollAnimations();
        this.setupModalAnimations();
        this.setupNotificationAnimations();
        this.setupStaggerAnimations();
    }

    // Page Transition Animations
    setupPageTransitions() {
        // Add page transition classes to main content
        const mainContent = document.querySelector('.main-content, .container-fluid, .container');
        if (mainContent) {
            mainContent.classList.add('page-transition');
        }

        // Animate cards with stagger effect
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.classList.add('card-hover');
            setTimeout(() => {
                card.classList.add('fade-in');
            }, index * 100);
        });

        // Animate navigation items
        const navItems = document.querySelectorAll('.nav-link, .sidebar-nav .nav-link');
        navItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add('slide-in-left');
            }, index * 50);
        });
    }

    // Enhanced Button Animations
    setupButtonAnimations() {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.classList.add('btn-animated', 'btn-click-effect');
            
            // Add loading state functionality
            button.addEventListener('click', (e) => {
                if (button.type === 'submit' || button.classList.contains('btn-submit')) {
                    this.showButtonLoading(button);
                }
            });
        });

        // Special animations for primary buttons
        const primaryButtons = document.querySelectorAll('.btn-primary');
        primaryButtons.forEach(button => {
            button.classList.add('glow');
        });
    }

    // Form Input Animations
    setupFormAnimations() {
        const formControls = document.querySelectorAll('.form-control');
        formControls.forEach(input => {
            input.classList.add('form-control-animated');
            
            // Add focus animations
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('input-focused');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('input-focused');
            });

            // Add validation animations
            input.addEventListener('invalid', () => {
                input.classList.add('shake');
                setTimeout(() => {
                    input.classList.remove('shake');
                }, 820);
            });
        });

        // Animate form groups with stagger
        const formGroups = document.querySelectorAll('.form-group, .mb-3, .mb-4');
        formGroups.forEach((group, index) => {
            setTimeout(() => {
                group.classList.add('slide-in-right');
            }, index * 100);
        });
    }

    // Scroll-triggered Animations
    setupScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements for scroll animations
        const animateOnScroll = document.querySelectorAll('.table, .alert, .progress');
        animateOnScroll.forEach(element => {
            observer.observe(element);
        });
    }

    // Modal Animations
    setupModalAnimations() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.classList.add('modal-animated');
            
            modal.addEventListener('show.bs.modal', () => {
                modal.querySelector('.modal-content').classList.add('scale-in');
            });
        });
    }

    // Notification Animations
    setupNotificationAnimations() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach((alert, index) => {
            alert.classList.add('notification-slide');
            setTimeout(() => {
                alert.classList.add('show');
            }, index * 200);
        });
    }

    // Stagger Animations for Lists
    setupStaggerAnimations() {
        const tables = document.querySelectorAll('table tbody tr');
        tables.forEach((row, index) => {
            row.classList.add('stagger-item');
        });

        const listItems = document.querySelectorAll('.list-group-item');
        listItems.forEach((item, index) => {
            item.classList.add('stagger-item');
        });
    }

    // Button Loading State
    showButtonLoading(button) {
        const originalText = button.innerHTML;
        const loadingText = button.dataset.loading || 'Processing...';
        
        button.innerHTML = `<span class="loading-spinner me-2"></span>${loadingText}`;
        button.disabled = true;
        
        // Simulate loading (remove this in production)
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        }, 2000);
    }

    // Smooth Page Navigation
    navigateToPage(url, callback) {
        // Add exit animation
        document.body.classList.add('page-exit');
        
        setTimeout(() => {
            if (callback) {
                callback();
            } else {
                window.location.href = url;
            }
        }, 300);
    }

    // Animate Number Counters
    animateCounter(element, start, end, duration = 2000) {
        const range = end - start;
        const increment = range / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            element.textContent = Math.floor(current);
            
            if (current >= end) {
                element.textContent = end;
                clearInterval(timer);
            }
        }, 16);
    }

    // Progress Bar Animation
    animateProgressBar(progressBar, targetWidth) {
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.width = targetWidth + '%';
        }, 100);
    }

    // Toast Notification
    showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type} notification-slide`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Ripple Effect
    createRipple(event) {
        const button = event.currentTarget;
        const circle = document.createElement('span');
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;
        
        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
        circle.classList.add('ripple');
        
        const ripple = button.getElementsByClassName('ripple')[0];
        if (ripple) {
            ripple.remove();
        }
        
        button.appendChild(circle);
    }
}

// Initialize Animation Controller
document.addEventListener('DOMContentLoaded', () => {
    window.animationController = new AnimationController();
    
    // Add ripple effect to buttons
    const rippleButtons = document.querySelectorAll('.btn');
    rippleButtons.forEach(button => {
        button.addEventListener('click', window.animationController.createRipple);
    });
});

// Page Exit Animation
window.addEventListener('beforeunload', () => {
    document.body.classList.add('page-exit');
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});