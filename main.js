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
    const isMobile = window.innerWidth <= 768;
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: isMobile ? 0.05 : 0.1,
      rootMargin: isMobile ? '0px' : '0px 0px -50px 0px'
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
  // REMOVED: API key was exposed client-side. No data-unsplash elements are used.
  // If needed, implement via a server-side proxy to protect the API key.

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
  // --- Cookie Consent ---
  const cookieBanner = document.querySelector('.cookie-consent');
  if (cookieBanner && !localStorage.getItem('charmelle-cookies')) {
    setTimeout(() => cookieBanner.classList.add('is-visible'), 1000);
    
    const acceptBtn = cookieBanner.querySelector('.btn-accept');
    const declineBtn = cookieBanner.querySelector('.btn-decline');
    
    if (acceptBtn) {
      acceptBtn.addEventListener('click', () => {
        localStorage.setItem('charmelle-cookies', 'accepted');
        cookieBanner.classList.remove('is-visible');
      });
    }
    if (declineBtn) {
      declineBtn.addEventListener('click', () => {
        localStorage.setItem('charmelle-cookies', 'declined');
        cookieBanner.classList.remove('is-visible');
      });
    }
  }

  // --- Dynamic Copyright Year ---
  document.querySelectorAll('.copyright-year').forEach(el => {
    el.textContent = new Date().getFullYear();
  });

  // --- Newsletter Popup (CMS-driven) ---
  const popup = document.getElementById('newsletter-popup');
  if (popup) {
    // Load popup settings from CMS
    async function initPopup() {
      let settings = {
        enabled: true,
        subtitle: 'Exklusive Angebote',
        title: 'Beauty-News & <em class="text-italic">Aktionen</em>',
        text: 'Erhalten Sie exklusive Angebote, Pflegetipps und Neuigkeiten direkt in Ihre Inbox.',
        buttonText: 'Anmelden',
        placeholder: 'Ihre E-Mail-Adresse',
        disclaimer: 'Kein Spam, jederzeit abbestellbar.',
        delaySeconds: 15,
        cooldownDays: 7
      };

      try {
        const res = await fetch('/data/settings.json');
        if (res.ok) {
          const data = await res.json();
          if (data.popup) Object.assign(settings, data.popup);
        }
      } catch (e) {
        // Use defaults
      }

      if (!settings.enabled) return;

      // Update popup content from CMS
      const subtitleEl = popup.querySelector('.subtitle');
      const titleEl = popup.querySelector('h3');
      const textEl = popup.querySelector('.popup-content > p');
      const btnEl = popup.querySelector('button[type="submit"]');
      const inputEl = popup.querySelector('input[type="email"]');
      const disclaimerEl = popup.querySelector('.popup-disclaimer');

      if (subtitleEl) subtitleEl.textContent = settings.subtitle;
      if (titleEl) titleEl.innerHTML = settings.title;
      if (textEl) textEl.textContent = settings.text;
      if (btnEl) btnEl.textContent = settings.buttonText;
      if (inputEl) inputEl.placeholder = settings.placeholder;
      if (disclaimerEl) {
        disclaimerEl.innerHTML = settings.disclaimer + ' <a href="kontakt.html#datenschutz">Datenschutz</a>';
      }

      // Cooldown check
      const POPUP_COOLDOWN = settings.cooldownDays * 24 * 60 * 60 * 1000;
      const lastShown = localStorage.getItem('charmelle-popup-shown');
      const shouldShow = !lastShown || (Date.now() - parseInt(lastShown)) > POPUP_COOLDOWN;

      if (!shouldShow) return;

      // Show after delay
      const popupTimer = setTimeout(() => showPopup(), settings.delaySeconds * 1000);

      // Exit intent (desktop only)
      if (window.innerWidth > 768) {
        document.addEventListener('mouseout', function exitIntent(e) {
          if (e.clientY < 10 && !popup.classList.contains('is-visible')) {
            clearTimeout(popupTimer);
            showPopup();
            document.removeEventListener('mouseout', exitIntent);
          }
        });
      }
    }

    function showPopup() {
      popup.classList.add('is-visible');
      localStorage.setItem('charmelle-popup-shown', Date.now().toString());
    }

    // Close popup
    const popupClose = popup.querySelector('.popup-close');
    if (popupClose) {
      popupClose.addEventListener('click', () => {
        popup.classList.remove('is-visible');
      });
    }

    // Close on overlay click
    popup.addEventListener('click', (e) => {
      if (e.target === popup) {
        popup.classList.remove('is-visible');
      }
    });

    // Form submission
    const popupForm = popup.querySelector('form');
    if (popupForm) {
      popupForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(popupForm);
        try {
          await fetch('/', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(formData).toString()
          });
          popup.querySelector('.popup-content').innerHTML = `
            <div style="text-align:center;padding:40px 0;">
              <div style="font-size:3rem;margin-bottom:16px;">✨</div>
              <h3 style="margin-bottom:8px;">Vielen Dank!</h3>
              <p style="color:var(--text-light);">Wir haben Ihre Anmeldung erhalten und melden uns bald bei Ihnen.</p>
            </div>
          `;
          setTimeout(() => popup.classList.remove('is-visible'), 3000);
        } catch (err) {
          console.error('Form submission failed', err);
        }
      });
    }

    initPopup();
  }

  // --- Netlify Identity Widget (for CMS login) ---
  if (window.netlifyIdentity) {
    window.netlifyIdentity.on('init', user => {
      if (!user) {
        window.netlifyIdentity.on('login', () => {
          document.location.href = '/admin/';
        });
      }
    });
  }

});
