/**
 * Chez Théo les Bains — main.js (Laravel)
 */

(function () {
  'use strict';

  // ──────────────────────────────────────────────────────────
  // 1. PAGE LOADER
  // ──────────────────────────────────────────────────────────
  const loader = document.getElementById('page-loader');
  if (loader) {
    window.addEventListener('load', () => {
      setTimeout(() => loader.classList.add('loaded'), 300);
    });
    setTimeout(() => loader.classList.add('loaded'), 700);
  }

  // ──────────────────────────────────────────────────────────
  // 2. NAVIGATION — scroll + hamburger
  // ──────────────────────────────────────────────────────────
  const header  = document.getElementById('site-header');
  const burger  = document.getElementById('nav-burger');
  const navMenu = document.getElementById('main-nav')?.querySelector('.nav-menu');

  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });
  }

  if (burger && navMenu) {
    burger.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      burger.classList.toggle('open', isOpen);
      burger.setAttribute('aria-expanded', String(isOpen));
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !burger.contains(e.target)) {
        navMenu.classList.remove('open');
        burger.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && navMenu.classList.contains('open')) {
        navMenu.classList.remove('open');
        burger.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  // ──────────────────────────────────────────────────────────
  // 3. PARALLAX HERO
  // ──────────────────────────────────────────────────────────
  const heroMedia = document.querySelector('.hero-media img');
  if (heroMedia) {
    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        requestAnimationFrame(() => {
          if (window.scrollY < window.innerHeight) {
            heroMedia.style.transform = `scale(1.08) translateY(${window.scrollY * 0.25}px)`;
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // ──────────────────────────────────────────────────────────
  // 4. PARTICULES HERO
  // ──────────────────────────────────────────────────────────
  const particles = document.getElementById('hero-particles');
  if (particles) {
    for (let i = 0; i < 18; i++) {
      const p    = document.createElement('div');
      p.className = 'particle';
      const size = Math.random() * 4 + 3;
      p.style.cssText = [
        `width:${size}px`, `height:${size}px`,
        `left:${Math.random() * 100}%`,
        `bottom:${Math.random() * 30}%`,
        `--dur:${(Math.random() * 4 + 5).toFixed(1)}s`,
        `--delay:${(Math.random() * 4).toFixed(1)}s`,
        `--tx:${((Math.random() - 0.5) * 80).toFixed(0)}px`,
        `--ty:-${(Math.random() * 150 + 80).toFixed(0)}px`,
      ].join(';');
      particles.appendChild(p);
    }
  }

  // ──────────────────────────────────────────────────────────
  // 5. SCROLL REVEAL
  // ──────────────────────────────────────────────────────────
  const revealEls = document.querySelectorAll('[data-r]');
  if (revealEls.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('revealed');
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach((el) => obs.observe(el));
  }

  // ──────────────────────────────────────────────────────────
  // 6. BOOKING BAR FLOTTANTE
  // ──────────────────────────────────────────────────────────
  const bookingBar = document.getElementById('booking-bar');
  if (bookingBar) {
    let visible = false;
    window.addEventListener('scroll', () => {
      const show = window.scrollY > 500;
      if (show !== visible) {
        bookingBar.classList.toggle('visible', show);
        visible = show;
      }
    }, { passive: true });
  }

  // ──────────────────────────────────────────────────────────
  // 7. BACK TO TOP
  // ──────────────────────────────────────────────────────────
  const backTop = document.getElementById('back-to-top');
  if (backTop) {
    window.addEventListener('scroll', () => {
      backTop.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });
    backTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  }

  // ──────────────────────────────────────────────────────────
  // 8. HERO SCROLL INDICATOR
  // ──────────────────────────────────────────────────────────
  const heroScroll = document.getElementById('hero-scroll');
  if (heroScroll) {
    heroScroll.addEventListener('click', () => {
      const next = document.querySelector('.services-band') || document.querySelector('section:nth-of-type(2)');
      if (next) next.scrollIntoView({ behavior: 'smooth' });
    });
  }

  // ──────────────────────────────────────────────────────────
  // 9. TABS (filtres hébergements, excursions…)
  // ──────────────────────────────────────────────────────────
  document.querySelectorAll('.tabs-nav').forEach((nav) => {
    const btns = nav.querySelectorAll('.tab-btn');
    btns.forEach((btn) => {
      btn.addEventListener('click', function () {
        btns.forEach((b) => b.classList.remove('active'));
        this.classList.add('active');
        const filter = this.dataset.filter;
        if (!filter) return;
        document.querySelectorAll('[data-filter-item]').forEach((card) => {
          const match = filter === 'all' || card.dataset.filterItem === filter;
          card.style.display = match ? '' : 'none';
        });
      });
    });
  });

  // ──────────────────────────────────────────────────────────
  // 10. 3D TILT SUR LES ROOM CARDS
  // ──────────────────────────────────────────────────────────
  if (window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('.room-card').forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const r  = card.getBoundingClientRect();
        const rotX = (((e.clientY - r.top)  / r.height) - 0.5) * -6;
        const rotY = (((e.clientX - r.left) / r.width)  - 0.5) *  6;
        card.style.transform = `translateY(-14px) rotateX(${rotX}deg) rotateY(${rotY}deg)`;
      });
      card.addEventListener('mouseleave', () => {
        card.style.transform   = '';
        card.style.transition  = 'transform .4s var(--ease)';
        setTimeout(() => (card.style.transition = ''), 400);
      });
    });
  }

  // ──────────────────────────────────────────────────────────
  // 11. COMPTEUR ANIMÉ
  // ──────────────────────────────────────────────────────────
  function animateCount(el) {
    const raw    = el.textContent.trim();
    const num    = parseFloat(raw.replace(/[^0-9.]/g, ''));
    const suffix = raw.replace(/[0-9.]/g, '');
    if (isNaN(num)) return;
    const start = performance.now();
    const dur   = 1800;
    const tick  = (now) => {
      const p   = Math.min((now - start) / dur, 1);
      const val = num * (1 - Math.pow(1 - p, 3));
      el.textContent = (num % 1 !== 0 ? val.toFixed(1) : Math.round(val)) + suffix;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }
  const cntObs = new IntersectionObserver((entries) => {
    entries.forEach((e) => { if (e.isIntersecting) { animateCount(e.target); cntObs.unobserve(e.target); } });
  }, { threshold: 0.5 });
  document.querySelectorAll('.stat-num').forEach((el) => cntObs.observe(el));

  // ──────────────────────────────────────────────────────────
  // 12. FORMULAIRE CONTACT — feedback visuel
  //     (Laravel gère la soumission côté serveur)
  // ──────────────────────────────────────────────────────────
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', function () {
      const btn = this.querySelector('[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.textContent = 'Envoi en cours…';
      }
    });
  }

  // ──────────────────────────────────────────────────────────
  // 13. LIGHTBOX GALERIE
  // ──────────────────────────────────────────────────────────
  const galleryItems = document.querySelectorAll('.g-item');
  if (galleryItems.length) {
    const lb  = document.createElement('div');
    lb.id     = 'lightbox';
    lb.style.cssText = 'position:fixed;inset:0;z-index:9990;background:rgba(8,19,30,.96);backdrop-filter:blur(14px);display:flex;align-items:center;justify-content:center;opacity:0;visibility:hidden;transition:opacity .3s,visibility .3s;cursor:pointer';
    const img = document.createElement('img');
    img.style.cssText = 'max-width:90vw;max-height:90vh;object-fit:contain;border-radius:12px;box-shadow:0 20px 80px rgba(0,0,0,.5)';
    lb.appendChild(img);
    document.body.appendChild(lb);

    galleryItems.forEach((item) => {
      item.addEventListener('click', () => {
        const src = item.querySelector('img')?.src;
        if (!src) return;
        img.src = src;
        lb.style.opacity = '1';
        lb.style.visibility = 'visible';
        document.body.style.overflow = 'hidden';
      });
    });
    lb.addEventListener('click', () => {
      lb.style.opacity = '0';
      lb.style.visibility = 'hidden';
      document.body.style.overflow = '';
    });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') lb.click(); });
  }

})();

// ──────────────────────────────────────────────────────────
// 14. DROPDOWN CLAVIER (accessibilité)
// ──────────────────────────────────────────────────────────
document.querySelectorAll('.nav-has-drop > a').forEach((trigger) => {
  trigger.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      const li = trigger.parentElement;
      li.classList.toggle('open');
      trigger.setAttribute('aria-expanded', li.classList.contains('open'));
    }
  });
});
