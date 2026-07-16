import './bootstrap';
import 'bootstrap';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import AOS from 'aos';
import Swiper from 'swiper/bundle';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Lenis Smooth Scroll
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 1,
        touchMultiplier: 2,
        infinite: false,
    });

    // Update ScrollTrigger on Lenis scroll
    lenis.on('scroll', ScrollTrigger.update);

    // Set up requestAnimationFrame loop for Lenis
    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // 2. Initialize AOS (Animate On Scroll)
    AOS.init({
        duration: 900,
        easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
        once: true,
        offset: 80,
    });

    // 3. Navbar Scrolled Sticky Effect
    const navbar = document.querySelector('.navbar-luxury');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // 4. GSAP Stats Counter Animation
    const counters = document.querySelectorAll('.counter');
    if (counters.length > 0) {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'), 10) || 0;
            
            gsap.fromTo(counter, 
                { textContent: 0 }, 
                {
                    textContent: target,
                    duration: 2.5,
                    ease: 'power3.out',
                    snap: { textContent: 1 },
                    scrollTrigger: {
                        trigger: counter,
                        start: 'top 90%',
                        toggleActions: 'play none none none'
                    },
                    onUpdate: function() {
                        // Format with thousands separator if needed
                        const value = Math.ceil(this.targets()[0].textContent);
                        counter.textContent = value.toLocaleString('id-ID');
                    }
                }
            );
        });
    }

    // 5. Initialize Swiper for Testimonials
    const testimonialSwiperEl = document.querySelector('.testimonial-swiper');
    if (testimonialSwiperEl) {
        new Swiper('.testimonial-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                }
            }
        });
    }

    // 5b. Initialize Swiper for Projects Horizontal Timeline
    const projectsSwiperEl = document.querySelector('.projects-swiper');
    if (projectsSwiperEl) {
        new Swiper('.projects-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 24,
            loop: true,
            freeMode: true,
            speed: 8000,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            allowTouchMove: true
        });
    }
    // 5c. Initialize Swiper for Portfolio Detail Gallery
    const detailSwiperEl = document.querySelector('.detail-swiper');
    if (detailSwiperEl) {
        new Swiper('.detail-swiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // 6. GSAP Hover Effect for Service Cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card.querySelector('.icon-box'), {
                scale: 1.1,
                duration: 0.3,
                ease: 'power1.out'
            });
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card.querySelector('.icon-box'), {
                scale: 1,
                duration: 0.3,
                ease: 'power1.in'
            });
        });
    });

    // 7. Client Notification Bell Dismissal
    const notificationItems = document.querySelectorAll('.notification-item');
    notificationItems.forEach(item => {
        const id = item.getAttribute('data-id');
        const actionBtn = item.querySelector('.mark-read-btn');
        if (actionBtn && id) {
            actionBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fetch(`/client/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        item.classList.add('opacity-50');
                        actionBtn.remove();
                        // Optional: update badge counter
                        const badge = document.querySelector('.notification-badge');
                        if (badge) {
                            let count = parseInt(badge.textContent, 10);
                            if (count > 1) {
                                badge.textContent = count - 1;
                            } else {
                                badge.remove();
                            }
                        }
                    }
                });
            });
        }
    });
});
