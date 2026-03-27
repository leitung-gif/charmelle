/* ============================================================
   CHARMELLE BEAUTY — SHARED JAVASCRIPT
   Mobile Menu, FAQ Accordion, Tabs, Testimonial Carousel,
   Scroll Reveals, Lightbox, Header scroll behavior
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  // --- Header Scroll Effect ---
  const header = document.querySelector('.site-header');
  if (header) {
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
      const currentScroll = window.pageYOffset;
      if (currentScroll > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
      lastScroll = currentScroll;
    }, { passive: true });
  }

  // --- Mobile Menu Toggle ---
  const menuToggle = document.querySelector('.menu-toggle');
  const mainNav = document.querySelector('.main-nav');
  if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
      menuToggle.classList.toggle('active');
      mainNav.classList.toggle('open');
      document.body.style.overflow = mainNav.classList.contains('open') ? 'hidden' : '';
    });
    // Close on nav link click
    mainNav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        menuToggle.classList.remove('active');
        mainNav.classList.remove('open');
        document.body.style.overflow = '';
      });
    });
  }

  // --- FAQ Accordion ---
  document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
      const item = question.closest('.faq-item');
      const wasOpen = item.classList.contains('open');
      // Close all siblings in the same FAQ section
      const parent = item.closest('.faq-section');
      if (parent) {
        parent.querySelectorAll('.faq-item.open').forEach(openItem => {
          openItem.classList.remove('open');
        });
      }
      // Toggle current
      if (!wasOpen) {
        item.classList.add('open');
      }
    });
  });

  // --- Tab Navigation ---
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const tabGroup = btn.closest('.tab-nav').dataset.tabGroup || 'default';
      const targetPanel = btn.dataset.tab;

      // Deactivate all tabs in this group
      btn.closest('.tab-nav').querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
      btn.classList.add('active');

      // Show target panel, hide others
      document.querySelectorAll(`.tab-panel[data-tab-group="${tabGroup}"]`).forEach(panel => {
        panel.classList.remove('active');
      });
      const target = document.getElementById(targetPanel);
      if (target) {
        target.classList.add('active');
      }
    });
  });

  // --- Testimonial Carousel ---
  const carousel = document.querySelector('.testimonial-carousel');
  if (carousel) {
    const track = carousel.querySelector('.testimonial-track');
    const cards = carousel.querySelectorAll('.testimonial-card');
    const dots = carousel.querySelectorAll('.carousel-dot');
    let currentIndex = 0;
    let autoplayInterval;

    function goToSlide(index) {
      currentIndex = index;
      track.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        goToSlide(i);
        resetAutoplay();
      });
    });

    function nextSlide() {
      goToSlide((currentIndex + 1) % cards.length);
    }

    function startAutoplay() {
      autoplayInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoplay() {
      clearInterval(autoplayInterval);
      startAutoplay();
    }

    startAutoplay();

    // Pause on hover
    carousel.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
    carousel.addEventListener('mouseleave', startAutoplay);
  }

  // --- Scroll Reveal Animations ---
  const revealElements = document.querySelectorAll('.reveal');
  if (revealElements.length > 0) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));
  }

  // --- Lightbox / Modal ---
  const lightboxTriggers = document.querySelectorAll('[data-lightbox]');
  const lightboxOverlay = document.querySelector('.lightbox-overlay');

  lightboxTriggers.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      if (lightboxOverlay) {
        lightboxOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (lightboxOverlay) {
    const closeBtn = lightboxOverlay.querySelector('.lightbox-close');
    if (closeBtn) {
      closeBtn.addEventListener('click', closeLightbox);
    }
    lightboxOverlay.addEventListener('click', (e) => {
      if (e.target === lightboxOverlay) closeLightbox();
    });
  }

  function closeLightbox() {
    if (lightboxOverlay) {
      lightboxOverlay.classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  // Close lightbox on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
  });

  // --- Smooth Anchor Scroll ---
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        const headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 80;
        const announcementOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--announcement-height')) || 40;
        const totalOffset = headerOffset + announcementOffset;
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - totalOffset;
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // --- Aktion des Monats Auto-Popup (Homepage only) ---
  if (document.querySelector('.lightbox-overlay.auto-popup')) {
    setTimeout(() => {
      const popup = document.querySelector('.lightbox-overlay.auto-popup');
      if (popup && !sessionStorage.getItem('charmelle-popup-dismissed')) {
        popup.classList.add('open');
        document.body.style.overflow = 'hidden';
      }
    }, 3000);

    // Mark as dismissed when closed
    const popup = document.querySelector('.lightbox-overlay.auto-popup');
    if (popup) {
      const origClose = closeLightbox;
      const closePopup = () => {
        popup.classList.remove('open');
        document.body.style.overflow = '';
        sessionStorage.setItem('charmelle-popup-dismissed', 'true');
      };
      const popupClose = popup.querySelector('.lightbox-close');
      if (popupClose) {
        popupClose.removeEventListener('click', closeLightbox);
        popupClose.addEventListener('click', closePopup);
      }
      popup.addEventListener('click', (e) => {
        if (e.target === popup) closePopup();
      });
    }
  }

  // --- Unsplash Image Loading ---
  // Replace data-unsplash attributes with real images using the Unsplash API
  const UNSPLASH_KEY = 'QutQnlTrArq9Zx-QW-tSPTe2RSAlfQUYfuZa-7_Ichk';
  document.querySelectorAll('img[data-unsplash]').forEach(async (img) => {
    const query = img.dataset.unsplash;
    const w = img.dataset.width || 800;
    const h = img.dataset.height || 600;
    try {
      const response = await fetch(
        `https://api.unsplash.com/photos/random?query=${encodeURIComponent(query)}&orientation=portrait&client_id=${UNSPLASH_KEY}`
      );
      const data = await response.json();
      if (data.urls) {
        img.src = `${data.urls.raw}&w=${w}&h=${h}&fit=crop&q=80`;
        img.alt = data.alt_description || query;
      }
    } catch (e) {
      // Fallback: use a gradient placeholder
      img.style.background = 'linear-gradient(135deg, var(--bg-section), var(--accent-shape))';
    }
  });

  // --- Blog Category Filter ---
  const blogFilterBtns = document.querySelectorAll('.blog-categories .filter-btn');
  if (blogFilterBtns.length > 0) {
    blogFilterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        blogFilterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const filter = btn.dataset.filter;
        document.querySelectorAll('.blog-card').forEach(card => {
          if (filter === 'all' || card.dataset.category === filter) {
            card.style.display = '';
            card.style.opacity = '0';
            requestAnimationFrame(() => {
              card.style.transition = 'opacity 0.4s ease';
              card.style.opacity = '1';
            });
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

});
