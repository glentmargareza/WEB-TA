@extends('layouts.app')

@section('title', 'Form Booking - Jeep Wisata Adventure')

@section('content')

<!-- Menyisipkan Stylesheet Khusus Booking Sesuai Mockup UI -->
<link rel="stylesheet" href="{{ asset('css/booking.css') }}">

<script>
  // Mengaktifkan background terang bernuansa alam untuk body halaman booking
  document.body.classList.add('booking-page-body');
</script>

<!-- ========================================================================
     1. FLOATING NAVBAR CAPSULE (Sesuai Mockup)
     ======================================================================== -->
<header class="booking-navbar-wrapper">
  <div class="booking-floating-navbar">
    
    <!-- Logo Brand Kiri -->
    <a href="{{ route('home') }}" class="booking-nav-brand">
      <div class="brand-icon-circle">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8 3l4 8 5-5 5 11H2L8 3z"/>
        </svg>
      </div>
      <div class="brand-title-wrap">
        <span class="brand-title-text">Jeep WisataSeri</span>
        <span class="brand-sub-text">Adventure Tour</span>
      </div>
    </a>

    <!-- Menu Navigasi Tengah -->
    <ul class="booking-nav-links">
      <li><a href="{{ route('home') }}#beranda" class="booking-nav-link">Beranda</a></li>
      <li><a href="{{ route('home') }}#paket-wisata" class="booking-nav-link">Paket Wisata</a></li>
      <li><a href="{{ route('home') }}#spot-utama" class="booking-nav-link">Tentang</a></li>
      <li><a href="{{ route('home') }}#galeri" class="booking-nav-link">Galeri</a></li>
      <li><a href="{{ route('home') }}#basecamp" class="booking-nav-link">Kontak</a></li>
    </ul>

    <!-- Aksi Kanan -->
    <div class="booking-nav-actions">
      <button type="button" class="booking-search-btn" title="Cari Informasi" aria-label="Cari">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/>
          <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>

      <a href="{{ route('tour.booking.page') }}" class="booking-cta-btn">
        <span>Booking Sekarang</span>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"/>
          <polyline points="12 5 19 12 12 19"/>
        </svg>
      </a>
    </div>

  </div>
</header>

<!-- ========================================================================
     2. STEPPER PILLS (4 Langkah Sesuai Mockup)
     ======================================================================== -->
<section class="booking-stepper-container">
  <div class="booking-stepper-pills">
    
    <!-- Step 1: Form Booking (Aktif) -->
    <div class="step-pill active">
      <span class="step-pill-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
          <polyline points="10 9 9 9 8 9"/>
        </svg>
      </span>
      <span>Form Booking</span>
    </div>

    <div class="step-connector-line"></div>

    <!-- Step 2: Detail Pesanan -->
    <div class="step-pill">
      <span class="step-pill-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
      </span>
      <span>Detail Pesanan</span>
    </div>

    <div class="step-connector-line"></div>

    <!-- Step 3: Konfirmasi -->
    <div class="step-pill">
      <span class="step-pill-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="9 12 11 14 15 10"/>
        </svg>
      </span>
      <span>Konfirmasi</span>
    </div>

    <div class="step-connector-line"></div>

    <!-- Step 4: Pembayaran -->
    <div class="step-pill">
      <span class="step-pill-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="2" y="5" width="20" height="14" rx="2"/>
          <line x1="2" y1="10" x2="22" y2="10"/>
        </svg>
      </span>
      <span>Pembayaran</span>
    </div>

  </div>
</section>

<!-- ========================================================================
     3. MAIN BOOKING FORM & SUMMARY SECTION
     ======================================================================== -->
<section class="booking-content-section">
  <form id="newBookingForm" method="POST" action="{{ route('tour.book') }}">
    @csrf

    <div class="booking-grid">
      
      <!-- ================= LEFT COLUMN: FORM CARD ================= -->
      <div class="booking-form-card">
        
        <!-- Header Card Form -->
        <div class="form-card-header">
          <div class="form-header-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
              <polyline points="14 2 14 8 20 8"/>
              <line x1="16" y1="13" x2="8" y2="13"/>
              <line x1="16" y1="17" x2="8" y2="17"/>
              <polyline points="10 9 9 9 8 9"/>
            </svg>
          </div>
          <div class="form-title-group">
            <h1 class="form-main-title">Form Booking</h1>
            <p class="form-main-subtitle">Lengkapi data untuk melanjutkan pemesanan.</p>
          </div>
        </div>

        <h2 class="form-section-label">Informasi Pemesanan</h2>

        <!-- 1. Nama Lengkap (Full Width) -->
        <div class="field-group">
          <label class="field-label" for="inputNama">Nama Lengkap <span class="required-star">*</span></label>
          <div class="input-icon-box">
            <span class="input-left-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </span>
            <input type="text" id="inputNama" name="nama" class="booking-input" placeholder="Contoh: Andi Pratama" required>
          </div>
        </div>

        <!-- 2. No. WhatsApp & Tanggal (Grid 2 Kolom) -->
        <div class="field-grid-2">
          
          <div class="field-group">
            <label class="field-label" for="inputPhone">No. WhatsApp <span class="required-star">*</span></label>
            <div class="input-icon-box">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
              </span>
              <input type="tel" id="inputPhone" name="telepon" class="booking-input" placeholder="Contoh: 081234567890" required>
            </div>
          </div>

          <div class="field-group">
            <label class="field-label" for="inputTanggal">Tanggal <span class="required-star">*</span></label>
            <div class="input-icon-box date-input-box" id="dateInputBox" title="Klik untuk membuka kalender">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                  <line x1="16" y1="2" x2="16" y2="6"/>
                  <line x1="8" y1="2" x2="8" y2="6"/>
                  <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
              </span>
              <input type="date" id="inputTanggal" name="tanggal" class="booking-input date-picker-input" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required>
            </div>
          </div>

        </div>

        <!-- 3. Waktu & Jumlah Orang (Grid 2 Kolom) -->
        <div class="field-grid-2">
          
          <div class="field-group">
            <label class="field-label" for="selectWaktu">Waktu</label>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
              </span>
              <select id="selectWaktu" name="waktu" class="booking-select">
                <option value="08:00 - 09:00" selected>08:00 - 09:00</option>
                <option value="09:00 - 10:00">09:00 - 10:00</option>
                <option value="10:00 - 11:00">10:00 - 11:00</option>
                <option value="13:00 - 14:00">13:00 - 14:00</option>
                <option value="14:00 - 15:00">14:00 - 15:00</option>
                <option value="15:30 - 17:30 (Sunset)">15:30 - 17:30 (Sunset)</option>
                <option value="04:30 - 07:00 (Sunrise)">04:30 - 07:00 (Sunrise)</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
          </div>

          <div class="field-group">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 2px;">
              <label class="field-label" for="selectJumlahOrang">Jumlah Orang</label>
              <span class="field-hint-badge">Maks. 4 Dewasa / Jeep</span>
            </div>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <select id="selectJumlahOrang" name="jumlah_orang" class="booking-select">
                <option value="1 Orang">1 Orang (1 Unit Jeep)</option>
                <option value="2 Orang">2 Orang (1 Unit Jeep)</option>
                <option value="3 Orang">3 Orang (1 Unit Jeep)</option>
                <option value="4 Orang" selected>4 Orang (Maksimal Standar 1 Jeep)</option>
                <option value="5 Orang (4 Dewasa + 1 Anak Kecil)">5 Orang (4 Dewasa + 1 Anak Kecil)</option>
                <option value="6 Orang (2 Unit Jeep)">6 Orang (2 Unit Jeep)</option>
                <option value="7 Orang (2 Unit Jeep)">7 Orang (2 Unit Jeep)</option>
                <option value="8 Orang (2 Unit Jeep)">8 Orang (2 Unit Jeep)</option>
                <option value="9 - 12 Orang (3 Unit Jeep)">9 - 12 Orang (3 Unit Jeep)</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
            <span class="field-help-text">Maksimal 4 penumpang dewasa per Jeep. Muat 5 orang bila 1 di antaranya anak kecil.</span>
          </div>

        </div>

        <!-- 4. Pilih Paket Wisata (Full Width) -->
        <div class="field-group">
          <label class="field-label" for="selectPaket">Pilih Paket Wisata</label>
          <div class="select-wrapper">
            <span class="input-left-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 3l4 8 5-5 5 11H2L8 3z"/>
              </svg>
            </span>
            <select id="selectPaket" name="paket" class="booking-select">
              @foreach($packages as $pkg)
              <option value="{{ $pkg['name'] }}" 
                data-price="{{ $pkg['price_raw'] }}" 
                data-price-format="Rp {{ $pkg['price'] }}" 
                data-duration="{{ $pkg['duration'] }}"
                data-image="{{ $pkg['image'] ?? asset('images/jeep_adventure_thumb.jpg') }}"
                data-cap="{{ $pkg['capacity'] }}"
                {{ ($selectedPackage && $selectedPackage['id'] === $pkg['id']) || ($pkg['name'] === 'Adventure') ? 'selected' : '' }}>
                {{ $pkg['name'] }}
              </option>
              @endforeach
            </select>
            <span class="select-chevron">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </span>
          </div>
        </div>

        <!-- 5. Tipe Kendaraan & Lokasi Penjemputan (Grid 2 Kolom) -->
        <div class="field-grid-2">
          
          <div class="field-group">
            <label class="field-label" for="selectKendaraan">Tipe Kendaraan</label>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="6" rx="2"/>
                  <path d="M5 11l2-5h10l2 5"/>
                  <circle cx="7.5" cy="17" r="2.5"/>
                  <circle cx="16.5" cy="17" r="2.5"/>
                </svg>
              </span>
              <select id="selectKendaraan" name="tipe_kendaraan" class="booking-select">
                <option value="Jeep 4x4" selected>Jeep 4x4</option>
                <option value="Jeep Hardtop 4x4">Jeep Hardtop 4x4</option>
                <option value="Jeep Willys Standar">Jeep Willys Standar</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
          </div>

          <div class="field-group">
            <label class="field-label" for="selectLokasi">Lokasi Penjemputan</label>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
              </span>
              <select id="selectLokasi" name="lokasi_penjemputan" class="booking-select">
                <option value="Cangkringan, Sleman" selected>Cangkringan, Sleman</option>
                <option value="Basecamp Wukirsari Cangkringan">Basecamp Wukirsari Cangkringan</option>
                <option value="Hotel / Villa Kaliurang">Hotel / Villa Kaliurang</option>
                <option value="Jogja (Other)">Jogja (Other)</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
          </div>

        </div>

        <!-- 6. Durasi & Jumlah Pendamping (Grid 2 Kolom) -->
        <div class="field-grid-2">
          
          <div class="field-group">
            <label class="field-label" for="selectDurasi">Durasi</label>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
              </span>
              <select id="selectDurasi" name="durasi" class="booking-select">
                <option value="1 Hari" selected>1 Hari</option>
                <option value="1.5 - 2 Jam">1.5 - 2 Jam</option>
                <option value="2 - 2.5 Jam">2 - 2.5 Jam</option>
                <option value="2.5 - 3 Jam">2.5 - 3 Jam</option>
                <option value="3 - 4 Jam">3 - 4 Jam</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
          </div>

          <div class="field-group">
            <label class="field-label" for="selectPendamping">Jumlah Pendamping</label>
            <div class="select-wrapper">
              <span class="input-left-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <select id="selectPendamping" name="jumlah_pendamping" class="booking-select">
                <option value="4 Orang" selected>4 Orang</option>
                <option value="3 Orang">3 Orang</option>
                <option value="2 Orang">2 Orang</option>
                <option value="1 Orang">1 Orang</option>
                <option value="Tanpa Pendamping">Tanpa Pendamping</option>
              </select>
              <span class="select-chevron">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 12 15 18 9"/>
                </svg>
              </span>
            </div>
          </div>

        </div>

        <!-- 7. Tipe Pembayaran (Full Width) -->
        <div class="field-group">
          <label class="field-label" for="selectPembayaran">Tipe Pembayaran</label>
          <div class="select-wrapper">
            <span class="input-left-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <line x1="2" y1="10" x2="22" y2="10"/>
              </svg>
            </span>
            <select id="selectPembayaran" name="tipe_pembayaran" class="booking-select">
              <option value="Transfer Bank" selected>Transfer Bank</option>
              <option value="DP 30% Transfer">DP 30% Transfer</option>
              <option value="Bayar Tunai di Basecamp">Bayar Tunai di Basecamp</option>
              <option value="QRIS / E-Wallet">QRIS / E-Wallet</option>
            </select>
            <span class="select-chevron">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </span>
          </div>
        </div>

        <!-- 8. Catatan / Permintaan Khusus (Opsional) -->
        <div class="field-group" style="margin-bottom: 0;">
          <label class="field-label" for="inputCatatan">Catatan / Permintaan Khusus (Opsional)</label>
          <div class="textarea-icon-box">
            <span class="textarea-left-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              </svg>
            </span>
            <textarea id="inputCatatan" name="catatan" rows="3" class="booking-textarea" placeholder="Contoh: request driver tertentu, dll"></textarea>
          </div>
        </div>

        <!-- Hidden input for total and package name compatibility -->
        <input type="hidden" name="paket_nama" id="hiddenPaketNama" value="Adventure">
        <input type="hidden" name="total_biaya" id="hiddenTotalBiaya" value="450000">

      </div>

      <!-- ================= RIGHT COLUMN: RINGKASAN PESANAN ================= -->
      <aside class="booking-summary-col">
        <div class="booking-summary-card">
          
          <div class="summary-card-header">
            <div class="summary-header-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
              </svg>
            </div>
            <h3 class="summary-card-title">Ringkasan Pesanan</h3>
          </div>

          <!-- Preview Item Paket -->
          <div class="summary-package-card">
            <img src="{{ asset('images/jeep_adventure_thumb.jpg') }}" alt="Adventure Tour" class="summary-package-img" id="summaryImage">
            <div class="summary-package-meta">
              <h4 class="summary-package-name" id="summaryPackageName">Adventure</h4>
              <div class="summary-package-cap">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
                <span id="summaryCapacity">1 - 5 pax</span>
              </div>
            </div>
          </div>

          <!-- Detail Spesifikasi List -->
          <div class="summary-items-list">
            
            <div class="summary-item-row">
              <span class="summary-item-label">Tanggal</span>
              <span class="summary-item-value" id="summaryTanggal">12 Maret 2025</span>
            </div>

            <div class="summary-item-row">
              <span class="summary-item-label">Waktu</span>
              <span class="summary-item-value" id="summaryWaktu">08:00 - 09:00</span>
            </div>

            <div class="summary-item-row">
              <span class="summary-item-label">Jumlah Orang</span>
              <span class="summary-item-value" id="summaryJumlahOrang">4</span>
            </div>

            <div class="summary-item-row">
              <span class="summary-item-label">Jumlah Pendamping</span>
              <span class="summary-item-value" id="summaryJumlahPendamping">4</span>
            </div>

            <div class="summary-item-row">
              <span class="summary-item-label">Pick-up</span>
              <span class="summary-item-value" id="summaryPickup">Jogja (Other)</span>
            </div>

          </div>

          <div class="summary-divider"></div>

          <!-- Total Harga -->
          <div class="summary-total-row">
            <span class="summary-total-label">Total Harga</span>
            <span class="summary-total-price" id="summaryTotalPrice">Rp 450.000</span>
          </div>

          <!-- Tombol Lanjut ke Jadwal -->
          <button type="submit" class="btn-submit-booking" id="btnSubmitBooking">
            <span>Lanjut ke Jadwal</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"/>
              <polyline points="12 5 19 12 12 19"/>
            </svg>
          </button>

        </div>
      </aside>

    </div>
  </form>
</section>

<!-- ========================================================================
     CLIENT-SIDE REAL-TIME SYNC JAVASCRIPT
     ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const selectPaket = document.getElementById('selectPaket');
  const inputTanggal = document.getElementById('inputTanggal');
  const selectWaktu = document.getElementById('selectWaktu');
  const selectJumlahOrang = document.getElementById('selectJumlahOrang');
  const selectPendamping = document.getElementById('selectPendamping');
  const selectLokasi = document.getElementById('selectLokasi');
  const selectDurasi = document.getElementById('selectDurasi');

  // Summary Elements
  const summaryPackageName = document.getElementById('summaryPackageName');
  const summaryCapacity = document.getElementById('summaryCapacity');
  const summaryTanggal = document.getElementById('summaryTanggal');
  const summaryWaktu = document.getElementById('summaryWaktu');
  const summaryJumlahOrang = document.getElementById('summaryJumlahOrang');
  const summaryJumlahPendamping = document.getElementById('summaryJumlahPendamping');
  const summaryPickup = document.getElementById('summaryPickup');
  const summaryTotalPrice = document.getElementById('summaryTotalPrice');
  const summaryImage = document.getElementById('summaryImage');

  // Hidden Inputs
  const hiddenPaketNama = document.getElementById('hiddenPaketNama');
  const hiddenTotalBiaya = document.getElementById('hiddenTotalBiaya');

  // Update Summary based on inputs
  function updateSummary() {
    // 1. Paket Wisata
    if (selectPaket) {
      const selectedOpt = selectPaket.options[selectPaket.selectedIndex];
      if (selectedOpt) {
        const pkgName = selectedOpt.value;
        const priceFmt = selectedOpt.dataset.priceFormat || 'Rp 450.000';
        const priceRaw = selectedOpt.dataset.price || '450000';
        const duration = selectedOpt.dataset.duration || '1 Hari';
        const capacity = selectedOpt.dataset.cap || '1 - 5 pax';
        const image = selectedOpt.dataset.image;

        if (summaryPackageName) summaryPackageName.textContent = pkgName;
        if (summaryCapacity) summaryCapacity.textContent = capacity;
        if (summaryTotalPrice) summaryTotalPrice.textContent = priceFmt;
        if (image && summaryImage) summaryImage.src = image;

        if (hiddenPaketNama) hiddenPaketNama.value = pkgName;
        if (hiddenTotalBiaya) hiddenTotalBiaya.value = priceRaw;

        // Sync duration if not manually edited
        if (selectDurasi && duration) {
          const matchOpt = Array.from(selectDurasi.options).find(opt => opt.value.toLowerCase().includes(duration.toLowerCase()) || duration.toLowerCase().includes(opt.value.toLowerCase()));
          if (matchOpt) {
            selectDurasi.value = matchOpt.value;
          }
        }
      }
    }

    // Helper Format Tanggal ke Bahasa Indonesia
    function formatTanggalIndo(dateStr) {
      if (!dateStr) return '12 Maret 2025';
      const parts = dateStr.split('-');
      if (parts.length === 3) {
        const year = parseInt(parts[0], 10);
        const monthIdx = parseInt(parts[1], 10) - 1;
        const day = parseInt(parts[2], 10);
        const bulanIndo = [
          'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        if (bulanIndo[monthIdx]) {
          return `${day} ${bulanIndo[monthIdx]} ${year}`;
        }
      }
      return dateStr;
    }

    // 2. Tanggal
    if (inputTanggal && summaryTanggal) {
      summaryTanggal.textContent = formatTanggalIndo(inputTanggal.value);
    }

    // 3. Waktu
    if (selectWaktu && summaryWaktu) {
      summaryWaktu.textContent = selectWaktu.value;
    }

    // 4. Jumlah Orang & Kapasitas per Unit
    if (selectJumlahOrang && summaryJumlahOrang) {
      const val = selectJumlahOrang.value;
      if (val.includes('5 Orang')) {
        summaryJumlahOrang.textContent = '5 (Termasuk 1 Anak)';
      } else if (val.includes('4 Orang')) {
        summaryJumlahOrang.textContent = '4';
      } else if (val.includes('3 Orang')) {
        summaryJumlahOrang.textContent = '3';
      } else if (val.includes('2 Orang')) {
        summaryJumlahOrang.textContent = '2';
      } else if (val.includes('1 Orang')) {
        summaryJumlahOrang.textContent = '1';
      } else {
        summaryJumlahOrang.textContent = val;
      }
    }

    // 5. Jumlah Pendamping
    if (selectPendamping && summaryJumlahPendamping) {
      const val = selectPendamping.value.replace(/[^0-9]/g, '') || '0';
      summaryJumlahPendamping.textContent = val;
    }

    // 6. Lokasi Penjemputan / Pick-up
    if (selectLokasi && summaryPickup) {
      summaryPickup.textContent = selectLokasi.value;
    }
  }

  // Interaktivitas Picker Kalender saat dipencet
  const dateInputBox = document.getElementById('dateInputBox');
  if (inputTanggal) {
    const triggerPicker = () => {
      try {
        if (typeof inputTanggal.showPicker === 'function') {
          inputTanggal.showPicker();
        }
      } catch (e) {
        inputTanggal.focus();
      }
    };

    if (dateInputBox) {
      dateInputBox.addEventListener('click', function(e) {
        if (e.target !== inputTanggal) {
          triggerPicker();
        }
      });
    }

    inputTanggal.addEventListener('click', triggerPicker);
    inputTanggal.addEventListener('change', updateSummary);
    inputTanggal.addEventListener('input', updateSummary);
  }

  // Event Listeners Input Lainnya
  if (selectPaket) selectPaket.addEventListener('change', updateSummary);
  if (selectWaktu) selectWaktu.addEventListener('change', updateSummary);
  if (selectJumlahOrang) selectJumlahOrang.addEventListener('change', updateSummary);
  if (selectPendamping) selectPendamping.addEventListener('change', updateSummary);
  if (selectLokasi) selectLokasi.addEventListener('change', updateSummary);

  // Initial Run
  updateSummary();
});
</script>

@endsection
