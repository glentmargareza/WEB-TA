/**
 * JEEP WISATA WUKIRSARI ADVENTURE - INTERACTIVE SCRIPT
 */

document.addEventListener('DOMContentLoaded', function () {
  // 1. Mobile Menu Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const navMenu = document.getElementById('navMenu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', function () {
      navMenu.classList.toggle('open');
      const isOpen = navMenu.classList.contains('open');
      mobileToggle.innerHTML = isOpen
        ? `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>`
        : `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>`;
    });

    // Close menu when clicking link
    navMenu.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('open');
        mobileToggle.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>`;
      });
    });
  }

  // 2. Sticky Navbar scroll effect
  const navbar = document.querySelector('.navbar');
  window.addEventListener('scroll', function () {
    if (window.scrollY > 40) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });

  // 3. Package Filtering by Category
  const filterBtns = document.querySelectorAll('.filter-btn');
  const packageCards = document.querySelectorAll('.package-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const filterValue = this.getAttribute('data-filter');

      packageCards.forEach(card => {
        const category = card.getAttribute('data-category');
        if (filterValue === 'all' || category === filterValue) {
          card.style.display = 'flex';
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 50);
        } else {
          card.style.opacity = '0';
          card.style.transform = 'translateY(10px)';
          setTimeout(() => {
            card.style.display = 'none';
          }, 200);
        }
      });
    });
  });

  // 4. Booking Modal System
  const bookingModal = document.getElementById('bookingModal');
  const openBookingBtns = document.querySelectorAll('.open-booking-modal');
  const closeBookingBtn = document.getElementById('closeBookingModal');
  const packageSelect = document.getElementById('modalPackageSelect');
  const bookingForm = document.getElementById('bookingForm');

  openBookingBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const packageName = this.getAttribute('data-package');
      if (packageName && packageSelect) {
        packageSelect.value = packageName;
      }
      if (bookingModal) {
        bookingModal.classList.add('open');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (closeBookingBtn && bookingModal) {
    closeBookingBtn.addEventListener('click', function () {
      bookingModal.classList.remove('open');
      document.body.style.overflow = '';
    });

    bookingModal.addEventListener('click', function (e) {
      if (e.target === bookingModal) {
        bookingModal.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  // Handle Form Submission -> WhatsApp
  if (bookingForm) {
    bookingForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const name = document.getElementById('inputName').value.trim();
      const phone = document.getElementById('inputPhone').value.trim();
      const pkg = document.getElementById('modalPackageSelect').value;
      const date = document.getElementById('inputDate').value;
      const session = document.getElementById('inputSession').value;
      const jeepCount = document.getElementById('inputJeepCount').value;
      const notes = document.getElementById('inputNotes').value.trim();

      if (!name || !phone || !date) {
        alert('Mohon lengkapi Nama, Nomor WhatsApp, dan Tanggal Trip!');
        return;
      }

      const waNumber = '6281234567890';
      const msg = `Halo Admin Jeep Wisata Wukirsari Adventure Yogyakarta! 🚙✨\n\n` +
        `Saya ingin reservasi petualangan Jeep:\n` +
        `• *Nama Pemesan:* ${name}\n` +
        `• *No. WhatsApp:* ${phone}\n` +
        `• *Paket Pilihan:* ${pkg}\n` +
        `• *Tanggal Trip:* ${date}\n` +
        `• *Sesi Waktu:* ${session}\n` +
        `• *Jumlah Jeep:* ${jeepCount} Armada (Maks. 4 org/Jeep)\n` +
        (notes ? `• *Catatan Tambahan:* ${notes}\n` : '') +
        `\nMohon informasi ketersediaan slot armada dan tata cara pembayarannya. Terima kasih!`;

      const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(msg)}`;
      window.open(waUrl, '_blank');

      if (bookingModal) {
        bookingModal.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }

  // 5. Video Preview Modal
  const videoModal = document.getElementById('videoModal');
  const playVideoBtn = document.getElementById('playVideoBtn');
  const closeVideoModal = document.getElementById('closeVideoModal');
  const videoFrame = document.getElementById('videoFrame');

  if (playVideoBtn && videoModal) {
    playVideoBtn.addEventListener('click', function () {
      videoModal.classList.add('open');
      document.body.style.overflow = 'hidden';
      // Load YouTube embed when clicked
      if (videoFrame && !videoFrame.getAttribute('src')) {
        videoFrame.setAttribute('src', 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1');
      }
    });

    if (closeVideoModal) {
      closeVideoModal.addEventListener('click', function () {
        videoModal.classList.remove('open');
        document.body.style.overflow = '';
        if (videoFrame) {
          videoFrame.setAttribute('src', '');
        }
      });
    }

    videoModal.addEventListener('click', function (e) {
      if (e.target === videoModal) {
        videoModal.classList.remove('open');
        document.body.style.overflow = '';
        if (videoFrame) {
          videoFrame.setAttribute('src', '');
        }
      }
    });
  }

  // 6. Gallery Lightbox Modal
  const galleryModal = document.getElementById('galleryModal');
  const galleryItems = document.querySelectorAll('.gallery-item');
  const galleryModalImg = document.getElementById('galleryModalImg');
  const galleryModalCaption = document.getElementById('galleryModalCaption');
  const closeGalleryModal = document.getElementById('closeGalleryModal');

  galleryItems.forEach(item => {
    item.addEventListener('click', function () {
      const img = this.querySelector('img');
      const caption = this.querySelector('.gallery-caption');
      if (img && galleryModal && galleryModalImg) {
        galleryModalImg.src = img.src;
        if (galleryModalCaption && caption) {
          galleryModalCaption.textContent = caption.textContent;
        }
        galleryModal.classList.add('open');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (closeGalleryModal && galleryModal) {
    closeGalleryModal.addEventListener('click', function () {
      galleryModal.classList.remove('open');
      document.body.style.overflow = '';
    });

    galleryModal.addEventListener('click', function (e) {
      if (e.target === galleryModal) {
        galleryModal.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  }
});
