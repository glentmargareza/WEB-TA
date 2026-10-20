/* Jeep Wukirsari - Interaksi situs */
(() => {
  'use strict';

  const $  = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];

  /* ---------- Header: Bayangan saat scroll ---------- */
  const header = $('.site-header');
  const onScroll = () => {
    if (header) {
      header.classList.toggle('is-scrolled', window.scrollY > 12);
    }
  };
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ---------- Navigasi Mobile ---------- */
  const toggle = $('[data-nav-toggle]');
  const nav = $('#site-nav');
  if (toggle && nav) {
    const setNav = (open) => {
      nav.classList.toggle('is-open', open);
      toggle.setAttribute('aria-expanded', String(open));
      toggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    };
    toggle.addEventListener('click', () => setNav(!nav.classList.contains('is-open')));
    nav.addEventListener('click', (e) => {
      if (e.target.closest('a, [data-booking]')) setNav(false);
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setNav(false);
    });
    document.addEventListener('click', (e) => {
      if (!nav.classList.contains('is-open')) return;
      if (!nav.contains(e.target) && !toggle.contains(e.target)) setNav(false);
    });
  }

  /* ---------- Dialog Booking ---------- */
  const dialog = $('#booking-dialog');
  if (dialog) {
    const pkgSelect = $('#booking-package');
    const sessionSelect = $('#booking-session');
    let lastTrigger = null;

    const syncSession = () => {
      const opt = pkgSelect && pkgSelect.selectedOptions[0];
      if (opt && opt.dataset.session && sessionSelect) {
        sessionSelect.value = opt.dataset.session;
      }
    };
    if (pkgSelect) pkgSelect.addEventListener('change', syncSession);

    const openBooking = (slug, trigger) => {
      lastTrigger = trigger || null;
      if (slug && pkgSelect) {
        pkgSelect.value = slug;
        syncSession();
      }
      if (!dialog.open) {
        dialog.showModal();
      }
    };

    document.addEventListener('click', (e) => {
      const t = e.target.closest('[data-booking]');
      if (!t) return;
      e.preventDefault();
      openBooking(t.dataset.booking, t);
    });

    $$('[data-dialog-close]', dialog).forEach((b) => {
      b.addEventListener('click', () => dialog.close());
    });
    dialog.addEventListener('click', (e) => {
      if (e.target === dialog) dialog.close();
    });
    dialog.addEventListener('close', () => {
      if (lastTrigger) lastTrigger.focus();
    });

    const form = $('form', dialog);
    const submitBtn = form && $('[type="submit"]', form);
    if (form && submitBtn) {
      form.addEventListener('submit', () => {
        submitBtn.classList.add('is-loading');
        submitBtn.setAttribute('aria-busy', 'true');
      });
      window.addEventListener('pageshow', () => {
        submitBtn.classList.remove('is-loading');
        submitBtn.removeAttribute('aria-busy');
      });
    }

    if (dialog.dataset.open === 'true') {
      dialog.showModal();
    }
  }

  /* ---------- Filter + Cari Paket (Katalog) ---------- */
  const grid = $('[data-package-grid]');
  if (grid) {
    const chips = $$('.chip[data-filter]');
    const search = $('[data-search]');
    const empty = $('[data-empty]');
    let category = 'all';
    let query = '';

    const applyFilter = () => {
      let visible = 0;
      $$('[data-category]', grid).forEach((card) => {
        const cardCat = card.dataset.category || '';
        const cardName = card.dataset.name || '';
        const matchCat = (category === 'all' || cardCat === category);
        const matchQuery = (!query || cardName.includes(query));
        const show = matchCat && matchQuery;
        card.hidden = !show;
        if (show) visible += 1;
      });
      if (empty) empty.hidden = visible !== 0;
      chips.forEach((c) => c.setAttribute('aria-pressed', String(c.dataset.filter === category)));
    };

    chips.forEach((c) => {
      c.addEventListener('click', () => {
        category = c.dataset.filter || 'all';
        applyFilter();
      });
    });

    if (search) {
      let timer = null;
      search.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(() => {
          query = search.value.trim().toLowerCase();
          applyFilter();
        }, 150);
      });
    }

    const resetBtn = $('[data-reset-search]');
    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        category = 'all';
        query = '';
        if (search) search.value = '';
        applyFilter();
      });
    }
  }

  /* ---------- Detail: Thumbnail Switcher ---------- */
  const stage = $('[data-stage]');
  const thumbs = $$('[data-thumb]');
  if (stage && thumbs.length) {
    thumbs.forEach((thumb) => {
      thumb.addEventListener('click', () => {
        thumbs.forEach((t) => t.setAttribute('aria-current', 'false'));
        thumb.setAttribute('aria-current', 'true');
        stage.style.opacity = '0.3';
        setTimeout(() => {
          stage.src = thumb.dataset.src;
          if (thumb.dataset.alt) stage.alt = thumb.dataset.alt;
          stage.style.opacity = '1';
        }, 150);
      });
    });
  }

  /* ---------- Detail: Tabs (Deskripsi, Itinerary, Ketentuan) ---------- */
  const tabList = $('[data-tabs]');
  if (tabList) {
    const tabs = $$('[role="tab"]', tabList);
    const panels = $$('[role="tabpanel"]', tabList);

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        tabs.forEach((t) => {
          t.setAttribute('aria-selected', 'false');
          t.setAttribute('tabindex', '-1');
        });
        panels.forEach((p) => (p.hidden = true));

        tab.setAttribute('aria-selected', 'true');
        tab.removeAttribute('tabindex');
        const targetPanel = $('#' + tab.getAttribute('aria-controls'));
        if (targetPanel) targetPanel.hidden = false;
      });

      tab.addEventListener('keydown', (e) => {
        const i = tabs.indexOf(tab);
        let next = null;
        if (e.key === 'ArrowRight') next = tabs[(i + 1) % tabs.length];
        if (e.key === 'ArrowLeft')  next = tabs[(i - 1 + tabs.length) % tabs.length];
        if (next) {
          e.preventDefault();
          next.focus();
          next.click();
        }
      });
    });
  }

  /* ---------- Lightbox Galeri ---------- */
  const lightbox = $('#lightbox');
  if (lightbox) {
    const img = $('img', lightbox);
    $$('[data-lightbox]').forEach((item) => {
      item.addEventListener('click', () => {
        const src = item.dataset.lightbox || item.querySelector('img')?.src;
        if (src && img) {
          img.src = src;
          lightbox.showModal();
        }
      });
    });
    lightbox.addEventListener('click', () => lightbox.close());
  }

  /* ---------- Reveal saat scroll ---------- */
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          observer.unobserve(e.target);
        }
      });
    }, { threshold: 0.15 });

    $$('.reveal').forEach((el) => observer.observe(el));
  } else {
    $$('.reveal').forEach((el) => el.classList.add('is-visible'));
  }
})();
