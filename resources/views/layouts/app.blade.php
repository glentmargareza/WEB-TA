<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <!-- Primary Meta Tags -->
  <title>@yield('title', 'Paket Jeep Wisata Wukirsari Adventure Yogyakarta | Sensasi Offroad Terbaik')</title>
  <meta name="title" content="Paket Jeep Wisata Wukirsari Adventure Yogyakarta">
  <meta name="description" content="Jelajahi keindahan alam desa wisata Wukirsari Imogiri Yogyakarta dengan armada Jeep 4x4 terawat dan driver berpengalaman. Susur sungai, kebun salak, makam Imogiri, hingga sunrise spektakuler.">
  <meta name="keywords" content="jeep wisata jogja, jeep wukirsari,merapi lava tour alternatif">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="Paket Jeep Wisata Wukirsari Adventure Yogyakarta">
  <meta property="og:description" content="Jelajahi keindahan alam Wukirsari Yogyakarta dengan sensasi offroad Jeep 4x4 terbaik, aman, dan berkesan.">
  <meta property="og:image" content="{{ asset('images/hero.jpegit config --global user.nameg') }}">

  <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- Favicon icon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23f27405'><path d='M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 3c-.1.2-.1.4-.1.6v4.5c0 .6.4 1 1 1h2m0 0a2.5 2.5 0 1 0 5 0m-5 0h5m4 0a2.5 2.5 0 1 0 5 0m-5 0h5'/></svg>">
</head>
<body>

  <!-- Top Announcement Bar -->
  <div class="topbar">
    <div class="container topbar-content">
      <div class="topbar-left">
        <div class="topbar-item">
          <span class="topbar-dot"></span>
          <span>Wisata Jeep Kaliurang Resmi & Terpercaya | Buka Setiap Hari: 07.00 - 17.00 WIB</span>
        </div>
      </div>
      <div class="topbar-right">
        <a href="https://wa.me/6281234567890" target="_blank" class="topbar-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          <span>+62 812-3456-7890</span>
        </a>
        <span style="opacity: 0.3;">|</span>
        <a href="#basecamp" class="topbar-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <span>Basecamp Wukirsari Kaliurang</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Main Navigation Bar -->
  <header class="navbar">
    <div class="container navbar-container">
        <div>
          <a href="/" class="brand">
            <img src="{{ asset('images/logo.png') }}" alt="Wukirsari Jeep"
              style="width: 100px !important; height: 80px !important; object-fit: contain;">
          </a>
        </div>
      </a>

      <!-- Desktop Nav Menu -->
      <ul class="nav-menu" id="navMenu">
        <li><a href="#beranda" class="nav-link active">Beranda</a></li>
        <li><a href="#paket-wisata" class="nav-link">Paket Wisata</a></li>
        <li><a href="#spot-utama" class="nav-link">Spot Utama</a></li>
        <li><a href="#cara-booking" class="nav-link">Cara Booking</a></li>
        <li><a href="#galeri" class="nav-link">Galeri</a></li>
        <li><a href="#basecamp" class="nav-link">Lokasi</a></li>
      </ul>

      <!-- CTA Button & Mobile Toggle -->
      <div style="display: flex; align-items: center; gap: 12px;">
        <a href="#booking" class="btn btn-orange open-booking-modal" data-package="SHORT TRIP">
          <span>Pesan Sekarang</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>

        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content Body -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <!-- Col 1: Brand Info -->
        <div>
          <a href="{{ route('home') }}" class="brand-logo" style="margin-bottom: 16px;">
            <div class="logo-icon-box">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="6" rx="2"/>
                <path d="M5 11l2-5h10l2 5"/>
                <circle cx="7.5" cy="17" r="2.5"/>
                <circle cx="16.5" cy="17" r="2.5"/>
              </svg>
            </div>
            <div>
              <div class="logo-text-title">WUKIRSARI <span>JEEP</span></div>
              <div class="logo-text-sub">ADVENTURE TOUR</div>
            </div>
          </a>
          <p class="footer-bio">
            Penyedia jasa wisata Jeep offroad resmi di kawasan Desa Wisata Wukirsari Imogiri Yogyakarta. Armada tangguh, driver ramah bersertifikat, dan jaminan keselamatan berasuransi.
          </p>
          <div class="footer-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <span>Desa Wisata Mandiri Terverifikasi</span>
          </div>
        </div>

        <!-- Col 2: Kontak & Reservasi -->
        <div>
          <h4 class="footer-col-title">Kontak & Reservasi</h4>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">📍</span>
            <span>Jl. Imogiri Timur KM 14, Wukirsari, Imogiri, Bantul, D.I. Yogyakarta 55782</span>
          </div>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">📱</span>
            <span>+62 812-3456-7890 (Reservasi WhatsApp)</span>
          </div>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">✉️</span>
            <span>reservasi@jeepwukirsari.com</span>
          </div>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">⏰</span>
            <span>Buka Setiap Hari: 07.00 - 17.00 WIB</span>
          </div>
        </div>

        <!-- Col 3: Pilihan Paket Tour -->
        <div>
          <h4 class="footer-col-title">Pilihan Paket Tour</h4>
          <ul class="footer-links-list">
            <li class="footer-link-item"><a href="#paket-wisata" class="open-booking-modal" data-package="SHORT TRIP">Short Trip Wukirsari (1 - 1.5 Jam)</a></li>
            <li class="footer-link-item"><a href="#paket-wisata" class="open-booking-modal" data-package="MEDIUM TRIP">Medium Trip Watu Goyang (2 - 2.5 Jam)</a></li>
            <li class="footer-link-item"><a href="#paket-wisata" class="open-booking-modal" data-package="LONG TRIP (FULL TRACK)">Long Trip Ekstrem (3 - 3.5 Jam)</a></li>
            <li class="footer-link-item"><a href="#paket-wisata" class="open-booking-modal" data-package="SUNRISE TRIP">Sunrise Trip Bukit Pengilon</a></li>
            <li class="footer-link-item"><a href="#paket-wisata" class="open-booking-modal" data-package="CUSTOM / EVENT PACK">Paket Outbound & Gathering Instansi</a></li>
          </ul>
        </div>

        <!-- Col 4: Informasi & Media Sosial -->
        <div>
          <h4 class="footer-col-title">Informasi & Bantuan</h4>
          <ul class="footer-links-list">
            <li class="footer-link-item"><a href="#cara-booking">Panduan Cara Booking</a></li>
            <li class="footer-link-item"><a href="#kenapa-kami">Standar Keselamatan & Asuransi</a></li>
            <li class="footer-link-item"><a href="#basecamp">Petunjuk Arah Basecamp</a></li>
            <li class="footer-link-item"><a href="https://wa.me/6281234567890" target="_blank">Konsultasi Rute Custom</a></li>
          </ul>

          <div class="footer-social-row">
            <a href="#" class="footer-social-btn" title="Instagram" aria-label="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" class="footer-social-btn" title="TikTok" aria-label="TikTok">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
            </a>
            <a href="#" class="footer-social-btn" title="YouTube" aria-label="YouTube">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
            </a>
            <a href="#" class="footer-social-btn" title="Facebook" aria-label="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Copyright Bottom Bar -->
      <div class="footer-bottom">
        <div>© 2026 Jeep Wisata Wukirsari Adventure Yogyakarta. Hak Cipta Dilindungi Undang-Undang.</div>
        <div style="display: flex; gap: 20px;">
          <span>Dirancang dengan Petualangan & Standar Terbaik Jogja</span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Booking Modal -->
  <div class="modal-overlay" id="bookingModal">
    <div class="modal-content">
      <button class="modal-close-btn" id="closeBookingModal" aria-label="Tutup Modal">&times;</button>
      
      <div style="text-align: center; margin-bottom: 24px;">
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 10px;">RESERVASI ONLINE RESMI</span>
        <h3 style="font-family: var(--font-heading); font-size: 22px; color: #fff;">Formulir Booking Jeep Wukirsari</h3>
        <p style="font-size: 13px; color: var(--text-muted); margin-top: 6px;">Isi data di bawah ini, pesanan Anda akan langsung terhubung ke WhatsApp Admin resmi kami untuk konfirmasi slot.</p>
      </div>

      <form id="bookingForm">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="inputName">Nama Lengkap *</label>
            <input type="text" id="inputName" class="form-input" placeholder="Contoh: Dimas Prasetyo" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="inputPhone">Nomor WhatsApp Aktif *</label>
            <input type="tel" id="inputPhone" class="form-input" placeholder="081234567890" required>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="modalPackageSelect">Pilihan Paket Wisata *</label>
          <select id="modalPackageSelect" class="form-select" required>
            <option value="SHORT TRIP (Rp 350.000 / Jeep)">SHORT TRIP - Rp 350.000 / Armada (1 - 1.5 Jam)</option>
            <option value="MEDIUM TRIP (Rp 450.000 / Jeep)">MEDIUM TRIP - Rp 450.000 / Armada (2 - 2.5 Jam)</option>
            <option value="LONG TRIP (Rp 550.000 / Jeep)">LONG TRIP FULL TRACK - Rp 550.000 / Armada (3 - 3.5 Jam)</option>
            <option value="SUNRISE TRIP (Rp 500.000 / Jeep)">SUNRISE TRIP - Rp 500.000 / Armada (04.30 WIB)</option>
            <option value="CUSTOM / EVENT GATHERING">CUSTOM TRIP / GATHERING ROMBONGAN (Fleksibel)</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="inputDate">Tanggal Keberangkatan *</label>
            <input type="date" id="inputDate" class="form-input" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="inputSession">Pilihan Sesi Jam *</label>
            <select id="inputSession" class="form-select" required>
              <option value="Pagi (07.00 - 10.00 WIB)">Sesi Pagi (07.00 - 10.00 WIB)</option>
              <option value="Siang (10.00 - 13.00 WIB)">Sesi Siang (10.00 - 13.00 WIB)</option>
              <option value="Sore / Sunset (14.00 - 17.00 WIB)">Sesi Sore / Golden Sunset (14.00 - 17.00 WIB)</option>
              <option value="Sunrise Subuh (04.30 WIB)">Sesi Subuh Sunrise (04.30 WIB)</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="inputJeepCount">Jumlah Armada Jeep (Maks. 4 Orang / Jeep) *</label>
          <select id="inputJeepCount" class="form-select" required>
            <option value="1">1 Armada Jeep (1 - 4 Orang)</option>
            <option value="2">2 Armada Jeep (5 - 8 Orang)</option>
            <option value="3">3 Armada Jeep (9 - 12 Orang)</option>
            <option value="4">4 Armada Jeep (13 - 16 Orang)</option>
            <option value="5">5 Armada Jeep (17 - 20 Orang)</option>
            <option value="10">Rombongan Lebih dari 5 Jeep (>20 Orang)</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="inputNotes">Catatan Tambahan (Opsional)</label>
          <textarea id="inputNotes" class="form-textarea" rows="2" placeholder="Contoh: Bawa anak kecil, request dokumentasi foto driver, dll."></textarea>
        </div>

        <button type="submit" class="btn btn-orange" style="width: 100%; padding: 14px; font-size: 15px; margin-top: 10px;">
          <span>Kirim Booking via WhatsApp</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </form>
    </div>
  </div>

  <!-- Video Preview Modal -->
  <div class="modal-overlay" id="videoModal">
    <div class="modal-content video-modal-content">
      <button class="modal-close-btn" id="closeVideoModal" style="top: 10px; right: 10px; z-index: 10;" aria-label="Tutup Video">&times;</button>
      <div class="video-container-responsive">
        <iframe id="videoFrame" src="" title="Video Tour Jeep Wisata Wukirsari" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <!-- Gallery Lightbox Modal -->
  <div class="modal-overlay" id="galleryModal">
    <div class="modal-content" style="max-width: 800px; padding: 20px; text-align: center;">
      <button class="modal-close-btn" id="closeGalleryModal" aria-label="Tutup Galeri">&times;</button>
      <img id="galleryModalImg" src="" alt="Galeri Preview" style="border-radius: var(--radius-md); max-height: 75vh; width: auto; margin: 0 auto 14px;">
      <h4 id="galleryModalCaption" style="color: #fff; font-family: var(--font-heading);"></h4>
    </div>
  </div>

  <!-- Floating WhatsApp Quick Button -->
  <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Jeep%20Wisata%20Wukirsari,%20saya%20ingin%20tanya%20paket%20trip%20Jeep" target="_blank" class="floating-whatsapp" title="Chat WhatsApp Kami" aria-label="Hubungi WhatsApp">
    <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24zm4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.25-1.5-1.4-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.34-.76-1.84-.2-.48-.4-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.13.17 1.78 2.71 4.3 3.8.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.32z"/>
    </svg>
  </a>

  <!-- JavaScript -->
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
