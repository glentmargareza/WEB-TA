@extends('layouts.app')

@section('title', 'Paket Jeep Wisata Wukirsari Adventure Yogyakarta | Sensasi Offroad Terbaik')

@section('content')

<!-- ========================================================================
     1. HERO SECTION
     ======================================================================== -->
<section class="hero-section" id="beranda">
  <div class="hero-bg">
    <img src="{{ asset('images/hero.jpeg') }}" alt="Armada Jeep Wisata Wukirsari Adventure Yogyakarta">
  </div>
  <div class="hero-overlay"></div>

  <div class="container hero-content">
    <h1 class="hero-title">
      Paket Jeep Wisata Wukirsari Adventure Yogyakarta
    </h1>

    <p class="hero-subtitle">
      Jadikan Moment Liburanmu Seru, Asik dan Tidak Terlupakan Bersama Kami. Jeep Wukirsari Adventure berdiri sejak 2020, memberikan pengalaman dansensasi ngejeep yang berbeda: 80% fun offroad bersama driver yang seru,asik dan berpengalaman!
    </p>

    <!-- 4 Feature Highlights Bar -->
    <div class="hero-features-bar">
      <div class="hero-feature-item">
        <div class="hero-feature-icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <span>Armada 4x4 Prima</span>
      </div>

      <div class="hero-feature-item">
        <div class="hero-feature-icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <span>Driver Berpengalaman</span>
      </div>

      <div class="hero-feature-item">
        <div class="hero-feature-icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <span>Asuransi Perjalanan</span>
      </div>

      <div class="hero-feature-item">
        <div class="hero-feature-icon">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
        </div>
        <span>Pilihan Rute Fleksibel</span>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================================
     2. SECTION: 5 PILIHAN PAKET WISATA JEEP WUKIRSARI
     ======================================================================== -->
<section class="section-wrapper" id="paket-wisata">
  <div class="container">
    <div class="section-header-row">
      <div>
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">PILIHAN PAKET POPULER & TERLARIS</span>
        <h2 class="section-title">5 Pilihan Paket Wisata Jeep Wukirsari</h2>
        <p class="section-desc">
          Tersedia berbagai pilihan rute mulai dari Short Trip yang ramah keluarga hingga Long Trip & Sunrise yang menantang adrenalin.
        </p>
      </div>

    </div>

    <!-- Filter Tab Buttons -->
    <div class="filter-tabs">
      <button class="filter-btn active" data-filter="all">SEMUA PAKET</button>
      <button class="filter-btn" data-filter="short">SHORT TRIP (2 - 2.5 JAM)</button>
      <button class="filter-btn" data-filter="medium">MEDIUM TRIP (2 - 2.5 JAM)</button>
      <button class="filter-btn" data-filter="long">LONG TRIP (2.5 - 3 JAM)</button>
      <button class="filter-btn" data-filter="sunrise">SUNRISE TRIP (3 - 4 JAM)</button>
    </div>

    <!-- Packages Grid (5 Cards + 1 Inquiry Box) -->
    <div class="packages-grid">
      @foreach($packages as $pkg)
      <div class="package-card" data-category="{{ $pkg['category'] }}">
        <div class="card-img-box">
          <img src="{{ $pkg['image'] }}" alt="{{ $pkg['name'] }}">
          <span class="card-badge {{ $pkg['badge_class'] }}">{{ $pkg['badge'] }}</span>
        </div>

        <div class="card-body">
          <div class="package-header">
            <h3 class="package-title">{{ $pkg['name'] }}</h3>
            <div class="package-price">
              <div class="price-amount">Rp {{ $pkg['price'] }}</div>
              <div class="price-unit">/ per Jeep</div>
            </div>
          </div>

          <div class="package-meta">
            <span>⏱ {{ $pkg['duration'] }}</span> • <span>👥 {{ $pkg['capacity'] }}</span>
          </div>

          <ul class="feature-list">
            @foreach($pkg['features'] as $feature)
            <li class="feature-item">
              <span class="feature-check">✓</span>
              <span>{{ $feature }}</span>
            </li>
            @endforeach
          </ul>

          <div class="card-footer">
            <div class="card-footer-info">
              <span>Total Harga:</span>
              <strong>Rp {{ $pkg['price'] }} / Armada</strong>
            </div>

            <button type="button" class="btn-card open-booking-modal" data-package="{{ $pkg['name'] }} (Rp {{ $pkg['price'] }} / Jeep)">
              <span>Pilih Paket {{ explode(' ', $pkg['name'])[0] }}</span>
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </div>
        </div>
      </div>
      @endforeach

      <!-- Box 6: Custom Inquiry / Promo Card -->
      <div class="custom-inquiry-card">
        <div>
          <div class="custom-inquiry-icon">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          </div>
          <h3 class="custom-inquiry-title">Bingung Pilih Paket yang Cocok?</h3>
          <p class="custom-inquiry-text">
            Konsultasikan kebutuhan liburan Anda bersama tim kami. Mulai dari liburan keluarga, rombongan kantor, study tour sekolah, hingga event komunitas besar.
          </p>

          <ul class="custom-inquiry-list">
            <li class="custom-inquiry-item">
              <span class="feature-check">✓</span>
              <span>Konsultasi Gratis 24 Jam</span>
            </li>
            <li class="custom-inquiry-item">
              <span class="feature-check">✓</span>
              <span>Bebas Rancang Rute Sendiri</span>
            </li>
            <li class="custom-inquiry-item">
              <span class="feature-check">✓</span>
              <span>Diskon Booking Rombongan (>5 Jeep)</span>
            </li>
          </ul>
        </div>

        <div>
          <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Jeep%20Wisata%20Wukirsari,%20saya%20ingin%20konsultasi%20paket%20rombongan" target="_blank" class="btn btn-orange" style="width: 100%;">
            <span>Chat WhatsApp Sekarang</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
    </div>

    <!-- Small Notice Banner Below Packages -->
    <div class="notice-strip">
      <div class="notice-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      </div>
      <div>
        <strong>Catatan Keselamatan:</strong> 1 Armada Jeep berkapasitas maksimal 4 orang dewasa demi kenyamanan dan keselamatan perjalanan. Seluruh armada telah terdaftar resmi dan dilengkapi asuransi perjalanan.
      </div>
    </div>
  </div>
</section>

<!-- ========================================================================
     3. SECTION: REKOMENDASI SPOT UTAMA
     ======================================================================== -->
<section class="section-wrapper" id="spot-utama" style="background: rgba(5, 24, 17, 0.5);">
  <div class="container">
    <div class="section-header">
      <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">SPOT POPULER & IKONIK</span>
      <h2 class="section-title">Rekomendasi Spot Utama</h2>
      <p class="section-desc">
        Destinasi terbaik yang akan Anda singgahi dalam perjalanan petualangan Jeep Wisata Wukirsari, dari panorama alam hingga budaya bersejarah.
      </p>
    </div>

    <div class="spots-grid">
      @foreach($spots as $spot)
      <div class="spot-card">
        <div class="spot-img-box">
          <img src="{{ $spot['image'] }}" alt="{{ $spot['title'] }}">
          <span class="spot-num-badge">{{ $spot['no'] }}</span>
          <span class="spot-tag-badge">{{ $spot['tag'] }}</span>
        </div>

        <div class="spot-content">
          <h3 class="spot-title">{{ $spot['title'] }}</h3>
          <p class="spot-desc">{{ $spot['description'] }}</p>
          <a href="#booking" class="spot-link open-booking-modal" data-package="SHORT TRIP">
            <span>Detail Jalur & Estimasi</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ========================================================================
     4. SECTION: KENAPA MEMILIH JEEP WUKIRSARI & VIDEO
     ======================================================================== -->
<section class="section-wrapper" id="kenapa-kami">
  <div class="container">
    <div class="why-us-grid">
      <!-- Left: 4 Reason Cards -->
      <div>
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">KEUNGGULAN KAMI</span>
        <h2 class="section-title">Kenapa Memilih Jeep Wukirsari?</h2>
        <p class="section-desc">
          Kami mengutamakan kepuasan, keamanan, dan sensasi petualangan berkesan untuk setiap momen liburan Anda.
        </p>

        <div class="why-features-grid">
          @foreach($reasons as $reason)
          <div class="why-card">
            <div class="why-card-num">{{ $reason['num'] }}</div>
            <h3 class="why-card-title">{{ $reason['title'] }}</h3>
            <p class="why-card-desc">{{ $reason['desc'] }}</p>
          </div>
          @endforeach
        </div>

        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20melihat%20legalitas%20dan%20testimoni%20Jeep%20Wukirsari" target="_blank" class="btn btn-outline-green">
          <span>Lihat Testimoni & Legalitas Kami</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>

      <!-- Right: Video Preview Card -->
      <div>
        <div class="video-preview-card">
          <video class="video-thumb-img" muted preload="metadata" playsinline aria-label="Video Preview Jeep Adventure">
            <source src="{{ asset('videos/vidio.mp4') }}#t=0.5" type="video/mp4">
          </video>
          <div class="video-overlay">
            <button class="play-pulse-btn" id="playVideoBtn" aria-label="Putar Video Tour">
              <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            </button>
            <h3 class="video-card-title">Tonton Video Keseruan Wisata Kami</h3>
            <span class="video-card-badge">
              <span>▶ 4K Cinematic Video Tour • Durasi 2 Menit</span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================================
     5. SECTION: CARA BOOKING 4 LANGKAH MUDAH
     ======================================================================== -->
<section class="section-wrapper" id="cara-booking" style="background: rgba(5, 24, 17, 0.5);">
  <div class="container">
    <div class="section-header text-center">
      <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">PROSES CEPAT TANPA RIBET</span>
      <h2 class="section-title">Cara Booking 4 Langkah Mudah</h2>
      <p class="section-desc">
        Pesan paket petualangan Jeep Anda dalam hitungan menit secara online atau via WhatsApp
      </p>
    </div>

    <div class="steps-grid">
      @foreach($steps as $step)
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">{{ $step['step'] }}</span>
          <span class="step-arrow">→</span>
        </div>
        <h3 class="step-title">{{ $step['title'] }}</h3>
        <p class="step-desc">{{ $step['desc'] }}</p>
      </div>
      @endforeach
    </div>

    <!-- Alert Strip Below Steps -->
    <div class="fast-booking-strip">
      <div class="fast-booking-left">
        <div class="fast-booking-icon">⚡</div>
        <div class="fast-booking-text">
          Butuh jadwal mendadak? Hubungi kami langsung via WhatsApp untuk ketersediaan armada hari ini.
        </div>
      </div>
      <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20apakah%20ada%20armada%20Jeep%20standby%20hari%20ini?" target="_blank" class="btn btn-orange">
        <span>Cek Slot Hari Ini</span>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ========================================================================
     6. SECTION: GALERI PETUALANGAN EKSPEDISI
     ======================================================================== -->
<section class="section-wrapper" id="galeri">
  <div class="container">
    <div class="section-header-row">
      <div>
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">DOKUMENTASI ASLI DARI KAMI</span>
        <h2 class="section-title">Galeri Petualangan Ekspedisi</h2>
        <p class="section-desc">
          Potret keseruan tamu kami saat menaklukkan trek offroad dan menikmati pesona Yogyakarta
        </p>
      </div>
      <div>
        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20bisa%20kirimkan%20foto%20dan%20video%20dokumentasi%20terbaru?" target="_blank" class="btn btn-outline-white">
          <span>Lihat Dokumentasi Lengkap</span>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <div class="gallery-grid">
      @foreach($gallery as $item)
      <div class="gallery-item">
        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
        <div class="gallery-overlay">
          <div class="gallery-caption">{{ $item['title'] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ========================================================================
     7. SECTION: BASECAMP UTAMA & PETA LOKASI
     ======================================================================== -->
<section class="section-wrapper" id="basecamp" style="background: rgba(5, 24, 17, 0.5);">
  <div class="container">
    <div class="basecamp-grid">
      <!-- Left side: Basecamp Info -->
      <div>
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">LOKASI MUDAH DIAKSES</span>
        <h2 class="section-title">Basecamp Utama Wukirsari</h2>
        <p class="section-desc">
          Basecamp kami berlokasi strategis di desa wisata Wukirsari dengan area parkir luas untuk bus dan mobil pribadi, toilet bersih, mushola, serta resto kopi.
        </p>

        <ul class="basecamp-facility-list">
          <li class="basecamp-facility-item">
            <span class="basecamp-icon">📍</span>
            <div>
              <strong>Alamat Lengkap:</strong><br>
              Jl. Imogiri Timur KM 14, Karangtalun, Wukirsari, Imogiri, Bantul, D.I. Yogyakarta 55782
            </div>
          </li>
          <li class="basecamp-facility-item">
            <span class="basecamp-icon">🅿</span>
            <div>
              <strong>Area Parkir & Ibadah:</strong><br>
              Area Parkir Luas (Muat Bus Besar & Puluhan Mobil Pribadi) serta Mushola Nyaman
            </div>
          </li>
          <li class="basecamp-facility-item">
            <span class="basecamp-icon">☕</span>
            <div>
              <strong>Resto & Coffee Shop:</strong><br>
              Menyediakan hidangan kuliner khas pedesaan, kelapa muda segar, dan kopi racikan lokal
            </div>
          </li>
        </ul>

        <div style="display: flex; gap: 14px; flex-wrap: wrap;">
          <a href="https://maps.google.com/?q=Wukirsari+Imogiri+Bantul+Yogyakarta" target="_blank" class="btn btn-orange">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
            <span>Buka Petunjuk Arah (Maps)</span>
          </a>
          <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20sedang%20menuju%20ke%20Basecamp%20Jeep%20Wukirsari" target="_blank" class="btn btn-outline-white">
            <span>Hubungi Petugas Basecamp</span>
          </a>
        </div>
      </div>

      <!-- Right side: Map Card with Interactive Location Marker -->
      <div>
        <div class="map-card-wrapper">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.128458925433!2d110.39572627588365!3d-7.90151199212132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5509930f7b99%3A0xb0030ce16e6d1c80!2sWukirsari%2C%20Imogiri%2C%20Bantul%20Regency%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
            title="Peta Lokasi Basecamp Jeep Wukirsari"
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>

          <div class="map-floating-badge">
            <div class="map-badge-title">
              <span class="topbar-dot"></span>
              <span>Basecamp Jeep Wukirsari</span>
            </div>
            <div class="map-badge-sub">Buka Setiap Hari: 07.00 - 17.00 WIB</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================================
     8. SECTION: CALL TO ACTION (CTA) BANNER
     ======================================================================== -->
<section class="section-wrapper" id="booking" style="padding-bottom: 90px;">
  <div class="container">
    <div class="cta-banner-wrapper">
      <div class="cta-bg-pattern"></div>
      <div class="cta-banner-content">
        <span class="badge-pill badge-pill-outline" style="margin-bottom: 14px;">SIAP MENJELAJAHI KEINDAHAN ALAM JOGJA?</span>
        
        <h2 class="cta-title">
          Siap Merasakan Sensasi Ngejeep Yang Berbeda?
        </h2>

        <p class="cta-subtitle">
          Jangan biarkan liburan Anda ke Jogja biasa-biasa saja. Pesan armada Jeep Wukirsari sekarang sebelum kehabisan slot di weekend & libur nasional!
        </p>

        <div class="cta-buttons-row">
          <a href="#bookingModal" class="btn btn-orange open-booking-modal" data-package="SHORT TRIP" style="padding: 14px 28px; font-size: 15px;">
            <span>Booking Sekarang via WA</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>

          <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20konsultasi%20rute%20custom%20rombongan" target="_blank" class="btn btn-outline-white" style="padding: 14px 26px; font-size: 15px;">
            <span>Konsultasi Custom Rute Rombongan</span>
          </a>
        </div>

        <div class="cta-guarantee-note">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          <span>Respon Cepat 24 Jam • Bebas Konsultasi • Pembayaran Aman & Terpercaya</span>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
