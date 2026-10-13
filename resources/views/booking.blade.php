@extends('layouts.app')

@section('title', 'Formulir Booking Resmi Jeep Wisata Wukirsari Adventure Yogyakarta')

@section('content')

<!-- ========================================================================
     BOOKING STEPPER HEADER
     ======================================================================== -->
<section class="booking-header-section">
  <div class="container">
    <div class="stepper-wrapper">
      <!-- Step 1 -->
      <a href="{{ route('home') }}#paket-wisata" class="step-item {{ $selectedPackage ? 'step-completed' : 'step-active' }}" id="stepItem1">
        <div class="step-icon" id="stepIcon1">
          @if($selectedPackage)
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          @else
            1
          @endif
        </div>
        <div class="step-text">
          <span class="step-sub" id="stepSub1">{{ $selectedPackage ? 'LANGKAH 1 (SELESAI)' : 'LANGKAH 1' }}</span>
          <span class="step-title">Pilih Paket Wisata</span>
        </div>
      </a>

      <!-- Step 2 -->
      <div class="step-item {{ $selectedPackage ? 'step-active' : 'step-pending' }}" id="stepItem2">
        <div class="step-icon" id="stepIcon2">2</div>
        <div class="step-text">
          <span class="step-sub" id="stepSub2">{{ $selectedPackage ? 'SEDANG DIISI' : 'LANGKAH 2' }}</span>
          <span class="step-title">Jadwal & Data</span>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step-item step-pending" id="stepItem3">
        <div class="step-icon" id="stepIcon3">3</div>
        <div class="step-text">
          <span class="step-sub">LANGKAH 3</span>
          <span class="step-title">DP & Konfirmasi</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================================
     MAIN BOOKING CONTENT
     ======================================================================== -->
<section class="booking-page-wrapper">
  <div class="container">
    <form id="mainBookingForm" method="POST" action="{{ route('tour.book') }}">
      @csrf

      <div class="booking-layout-grid">
        <!-- ================= LEFT COLUMN: FORM SECTIONS ================= -->
        <div class="booking-form-col">

          <!-- --------------------------------------------------------
               1. PILIH PAKET WISATA JEEP
               -------------------------------------------------------- -->
          <div class="booking-card" id="section-paket">
            <div class="booking-card-header">
              <div class="section-number">1</div>
              <div class="section-header-text">
                <h3 class="section-heading">Pilih Paket Wisata Jeep</h3>
                <p class="section-subheading">Kapasitas standar 1 Jeep diisi maksimal 4 penumpang</p>
              </div>
              <span class="badge-pill badge-pill-outline count-badge">{{ count($packages) }} Paket Tersedia</span>
            </div>

            <div class="packages-radio-list">
              @foreach($packages as $pkg)
              @php
                $isDefault = $selectedPackage && ($pkg['id'] === $selectedPackage['id']);
              @endphp
              <label class="package-option-card {{ $isDefault ? 'selected' : '' }}" data-id="{{ $pkg['id'] }}" data-name="{{ $pkg['name'] }}" data-price="{{ $pkg['price_raw'] }}" data-duration="{{ $pkg['duration'] }}" data-features="{{ implode(', ', $pkg['features']) }}">
                <input type="radio" name="paket" value="{{ $pkg['name'] }}" {{ $isDefault ? 'checked' : '' }} class="package-radio-input">
                
                <div class="package-opt-content">
                  <div class="package-opt-main">
                    <div class="package-opt-title-row">
                      <h4 class="package-opt-title">{{ $pkg['name'] }}</h4>
                      @if(!empty($pkg['badge']))
                      <span class="card-badge {{ $pkg['badge_class'] ?? 'badge-orange' }}">{{ $pkg['badge'] }}</span>
                      @endif
                      <span class="selected-indicator">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        Terpilih
                      </span>
                    </div>

                    <p class="package-opt-desc">
                      @if(count($pkg['features']) > 0)
                        {{ implode(' • ', $pkg['features']) }}
                      @else
                        {{ $pkg['note'] }}
                      @endif
                    </p>

                    <div class="package-opt-meta">
                      <span class="meta-tag">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        {{ $pkg['duration'] }}
                      </span>
                      <span class="meta-tag">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        {{ $pkg['capacity'] }}
                      </span>
                      <span class="meta-tag">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        Best Splashing
                      </span>
                    </div>
                  </div>

                  <div class="package-opt-price-box">
                    <div class="opt-price-amount">Rp {{ $pkg['price'] }}</div>
                    <div class="opt-price-unit">/ armada (maks 4 pax)</div>
                  </div>
                </div>
              </label>
              @endforeach
            </div>
          </div>

          <!-- --------------------------------------------------------
               2. JADWAL & SESI KEBERANGKATAN
               -------------------------------------------------------- -->
          <div class="booking-card" id="section-jadwal">
            <div class="booking-card-header">
              <div class="section-number">2</div>
              <div class="section-header-text">
                <h3 class="section-heading">Jadwal & Sesi Keberangkatan</h3>
                <p class="section-subheading">Tentukan tanggal wisata dan waktu mulai trip offroad</p>
              </div>
            </div>

            <!-- Date Picker Row -->
            <div class="form-group mb-4">
              <div class="date-header-row">
                <label class="form-label" for="bookingDate">Tanggal Keberangkatan <span class="text-orange">*</span></label>
                <span class="reschedule-badge">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                  Bisa reschedule H-1 sebelum jam 18.00
                </span>
              </div>
              <div class="input-with-icon">
                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <input type="date" id="bookingDate" name="tanggal" class="form-input date-input" required>
              </div>
            </div>

            <!-- Session Time Select -->
            <div class="form-group">
              <label class="form-label" style="margin-bottom: 10px;">Pilih Sesi Jam Mulai <span class="text-orange">*</span></label>
              <div class="sessions-grid">
                @foreach($sessions as $sess)
                @php
                  $isSessActive = ($sess['id'] === 'pagi-1');
                @endphp
                <label class="session-card {{ $isSessActive ? 'selected' : '' }}" data-time="{{ $sess['time'] }}" data-name="{{ $sess['name'] }}">
                  <input type="radio" name="sesi" value="{{ $sess['name'] }} ({{ $sess['time'] }} WIB)" {{ $isSessActive ? 'checked' : '' }} class="session-radio-input">
                  <div class="session-card-header">
                    <span class="session-title">{{ $sess['name'] }}</span>
                    <span class="session-indicator-dot"></span>
                  </div>
                  <div class="session-time">{{ $sess['time'] }}</div>
                  <span class="session-tag {{ $sess['badge_class'] }}">
                    <span class="bullet-dot"></span>
                    {{ $sess['badge'] }}
                  </span>
                </label>
                @endforeach
              </div>
            </div>
          </div>

          <!-- --------------------------------------------------------
               3. JUMLAH ARMADA JEEP
               -------------------------------------------------------- -->
          <div class="booking-card" id="section-armada">
            <div class="booking-card-header">
              <div class="section-number">3</div>
              <div class="section-header-text">
                <h3 class="section-heading">Jumlah Armada Jeep</h3>
                <p class="section-subheading">Tiap jeep berkapasitas maksimal 4 penumpang dewasa</p>
              </div>
            </div>

            <div class="armada-counter-row">
              <div class="armada-info-left">
                <div class="armada-icon-wrap">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="6" rx="2"/>
                    <path d="M5 11l2-5h10l2 5"/>
                    <circle cx="7.5" cy="17" r="2.5"/>
                    <circle cx="16.5" cy="17" r="2.5"/>
                  </svg>
                </div>
                <div>
                  <div class="armada-name">Armada 4x4 (Custom Offroad)</div>
                  <div class="armada-cap">Kapasitas: 1 - 4 Orang per Jeep</div>
                </div>
              </div>

              <div class="counter-control-wrap">
                <button type="button" class="counter-btn" id="btnMinusJeep" aria-label="Kurangi armada">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
                <input type="number" id="jeepCountInput" name="jumlah_jeep" class="counter-value-input" value="1" min="1" max="25" readonly>
                <button type="button" class="counter-btn" id="btnPlusJeep" aria-label="Tambah armada">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
              </div>
            </div>

            <div class="notice-callout-box">
              <div class="callout-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
              </div>
              <div class="callout-text">
                <strong>Info Rombongan:</strong> Demi kenyamanan dan standar keselamatan off-road AGTA, kapasitas maksimum 4 orang per Jeep tidak dapat ditambah. Untuk rombongan > 4 orang, tambahkan kuota unit di atas.
              </div>
            </div>
          </div>

          <!-- --------------------------------------------------------
               4. DATA PEMESAN (PIC ROMBONGAN)
               -------------------------------------------------------- -->
          <div class="booking-card" id="section-pemesan">
            <div class="booking-card-header">
              <div class="section-number">4</div>
              <div class="section-header-text">
                <h3 class="section-heading">Data Pemesan (PIC Rombongan)</h3>
                <p class="section-subheading">Konfirmasi tiket dan update koordinasi penjemputan dikirim via WhatsApp</p>
              </div>
            </div>

            <div class="form-group mb-3">
              <label class="form-label" for="customerName">Nama Lengkap Pemesan <span class="text-orange">*</span></label>
              <div class="input-with-icon">
                <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <input type="text" id="customerName" name="nama" class="form-input" placeholder="Bagas Wicaksono" required>
              </div>
            </div>

            <div class="form-row mb-3">
              <div class="form-group">
                <label class="form-label" for="customerPhone">Nomor WhatsApp Aktif <span class="text-orange">*</span></label>
                <div class="input-with-icon">
                  <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                  <input type="tel" id="customerPhone" name="telepon" class="form-input" placeholder="0813-6164-5727" required>
                </div>
                <span class="field-hint">Driver akan menghubungi nomor ini 1 jam sebelum trip</span>
              </div>

              <div class="form-group">
                <label class="form-label" for="customerEmail">Email Pengiriman E-Tiket (Opsional)</label>
                <div class="input-with-icon">
                  <svg class="field-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                  <input type="email" id="customerEmail" name="email" class="form-input" placeholder="bagas.adventure@gmail.com">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="customerNotes">Catatan Khusus / Permintaan (Opsional)</label>
              <textarea id="customerNotes" name="catatan" rows="3" class="form-textarea" placeholder="Contoh: Bawa anak balita butuh driver yang laju halus, minta helm double untuk lansia, atau request spot foto khusus."></textarea>
            </div>
          </div>

          <!-- --------------------------------------------------------
               5. OPSI TITIK KUMPUL & PENJEMPUTAN
               -------------------------------------------------------- -->
          <div class="booking-card" id="section-penjemputan">
            <div class="booking-card-header">
              <div class="section-number">5</div>
              <div class="section-header-text">
                <h3 class="section-heading">Opsi Titik Kumpul & Penjemputan</h3>
                <p class="section-subheading">Pilih apakah berkumpul di basecamp atau antar jemput hotel</p>
              </div>
            </div>

            <div class="pickup-options-list">
              <!-- Opsi 1: Basecamp -->
              <label class="pickup-card selected" id="pickupBasecampOpt">
                <div class="pickup-radio-col">
                  <input type="radio" name="titik_kumpul" value="Basecamp Wukirsari Cangkringan" checked class="pickup-radio-input">
                </div>
                <div class="pickup-info-col">
                  <div class="pickup-header-row">
                    <span class="pickup-title">Langsung ke Basecamp Wukirsari Cangkringan</span>
                    <span class="pickup-badge-free">GRATIS / DISARANKAN</span>
                  </div>
                  <p class="pickup-desc">Jl. Cangkringan KM 2, Wukirsari. Area parkir luas, mushola, toilet bersih, dan rest area kopi gratis.</p>
                </div>
              </label>

              <!-- Opsi 2: Hotel -->
              <label class="pickup-card" id="pickupHotelOpt">
                <div class="pickup-radio-col">
                  <input type="radio" name="titik_kumpul" value="Penjemputan Hotel / Villa Sekitar Cangkringan & Kaliurang" class="pickup-radio-input">
                </div>
                <div class="pickup-info-col">
                  <div class="pickup-header-row">
                    <span class="pickup-title">Penjemputan Hotel / Villa Sekitar Cangkringan & Kaliurang</span>
                    <span class="pickup-badge-radius">Radius 5 km: Gratis</span>
                  </div>
                  <p class="pickup-desc">Driver siap menjemput langsung ke lobby penginapan Anda di lereng Merapi. Di luar radius dikenakan biaya operasional tambahan.</p>
                  
                  <div class="hotel-input-wrap mt-3" id="hotelInputWrap" style="display: none;">
                    <label class="form-label" for="hotelNameInput">Nama Penginapan & Alamat / No Kamar:</label>
                    <input type="text" id="hotelNameInput" name="lokasi_penjemputan" class="form-input" placeholder="Contoh: Griya Persada Hotel Kaliurang / Kamar 204">
                  </div>
                </div>
              </label>
            </div>
          </div>

        </div>

        <!-- ================= RIGHT COLUMN: STICKY SUMMARY ================= -->
        <div class="booking-summary-col">
          <div class="summary-card-sticky">
            
            <div class="summary-top-header">
              <div class="summary-logo-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="11" width="18" height="6" rx="2"/>
                  <path d="M5 11l2-5h10l2 5"/>
                  <circle cx="7.5" cy="17" r="2.5"/>
                  <circle cx="16.5" cy="17" r="2.5"/>
                </svg>
              </div>
              <div>
                <h4 class="summary-title">Ringkasan Reservasi</h4>
                <div class="summary-sub">Wukirsari Adventure 4x4</div>
              </div>
              <span class="step-progress-badge" id="stepProgressBadge">{{ $selectedPackage ? 'Step 2/3 Selesai' : 'Langkah 1/3' }}</span>
            </div>

            <!-- Active Selected Package Box -->
            <div class="summary-package-box">
              <div class="summary-pkg-tag">PAKET TERPILIH</div>
              <div class="summary-pkg-name" id="summaryPackageName">{{ $selectedPackage ? $selectedPackage['name'] : 'Pilih Paket Wisata' }}</div>
              <div class="summary-pkg-meta" id="summaryPackageMeta">{{ $selectedPackage ? 'Durasi ' . $selectedPackage['duration'] . ' (' . count($selectedPackage['features']) . ' Destinasi)' : 'Silakan klik salah satu paket di sebelah kiri' }}</div>

              <div class="summary-details-grid">
                <div class="detail-cell">
                  <span class="detail-label">Jadwal Terpilih:</span>
                  <span class="detail-val" id="summaryDateVal">-</span>
                </div>
                <div class="detail-cell">
                  <span class="detail-label">Sesi Keberangkatan:</span>
                  <span class="detail-val" id="summarySessionVal">07.00 - 09.30 WIB</span>
                </div>
                <div class="detail-cell">
                  <span class="detail-label">Total Armada:</span>
                  <span class="detail-val" id="summaryJeepVal">1 Unit Jeep 4x4</span>
                </div>
                <div class="detail-cell">
                  <span class="detail-label">Kapasitas Maksimal:</span>
                  <span class="detail-val" id="summaryPaxVal">4 Penumpang</span>
                </div>
              </div>
            </div>

            <!-- Facilities Included -->
            <div class="summary-facilities-box">
              <div class="facilities-title">FASILITAS TERMASUK DALAM TIKET:</div>
              <ul class="facilities-list">
                <li>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                  <span>Unit Jeep 4x4 tangguh & bensin (BBM)</span>
                </li>
                <li>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                  <span>Driver profesional bersertifikat AGTA</span>
                </li>
                <li>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                  <span>Tiket retribusi seluruh objek wisata rute</span>
                </li>
                <li>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                  <span>Asuransi Jasa Raharja resmi & P3K standar</span>
                </li>
              </ul>
            </div>

            <!-- Price Breakdown Calculation -->
            <div class="summary-pricing-box">
              <div class="pricing-row">
                <span class="pricing-label">Subtotal Biaya Paket:</span>
                <span class="pricing-val" id="summarySubtotalVal">{{ $selectedPackage ? 'Rp ' . $selectedPackage['price'] : 'Rp 0' }}</span>
              </div>
              <div class="pricing-row">
                <span class="pricing-label">Biaya Titik Kumpul / Penjemputan:</span>
                <span class="pricing-val" id="summaryPickupFeeVal">Rp 0 (Basecamp)</span>
              </div>
              
              <div class="pricing-divider"></div>

              <div class="pricing-row total-row">
                <span class="pricing-label total-label">Total Biaya Reservasi</span>
                <span class="pricing-val total-val" id="summaryTotalVal">{{ $selectedPackage ? 'Rp ' . $selectedPackage['price'] : 'Rp 0' }}</span>
              </div>

              <div class="pricing-row dp-row">
                <div class="dp-label-wrap">
                  <span class="dp-label">Komitmen DP Booking (30%)</span>
                </div>
                <span class="dp-val" id="summaryDpVal">{{ $selectedPackage ? 'Rp ' . number_format($selectedPackage['price_raw'] * 0.3, 0, ',', '.') : 'Rp 0' }}</span>
              </div>

              <div class="pricing-row balance-row">
                <span class="balance-label">Sisa Pelunasan di Lokasi:</span>
                <span class="balance-val" id="summaryBalanceVal">{{ $selectedPackage ? 'Rp ' . number_format($selectedPackage['price_raw'] * 0.7, 0, ',', '.') . ' (Tunai / QRIS)' : 'Rp 0' }}</span>
              </div>
            </div>

            <!-- Hidden Inputs to carry calculated totals -->
            <input type="hidden" name="paket_nama" id="hiddenPackageName" value="{{ $selectedPackage ? $selectedPackage['name'] : '' }}">
            <input type="hidden" name="total_biaya" id="hiddenTotalBiaya" value="{{ $selectedPackage ? $selectedPackage['price_raw'] : 0 }}">
            <input type="hidden" name="dp_biaya" id="hiddenDpBiaya" value="{{ $selectedPackage ? ($selectedPackage['price_raw'] * 0.3) : 0 }}">

            <!-- Action Buttons -->
            <div class="summary-actions-wrap">
              <button type="button" class="btn btn-orange btn-block" id="btnSubmitDp">
                <span>Lanjut ke Pembayaran DP</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </button>

              <button type="button" class="btn btn-wa-dark btn-block" id="btnBookingWhatsApp">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12.031 2c-5.513 0-9.99 4.477-9.99 9.99 0 1.76.458 3.475 1.33 4.989L2 22l5.167-1.353a9.948 9.948 0 004.864 1.258h.004c5.513 0 9.99-4.477 9.99-9.99 0-2.668-1.039-5.176-2.926-7.063A9.927 9.927 0 0012.031 2zm0 18.318a8.29 8.29 0 01-4.226-1.157l-.303-.18-3.141.824.838-3.061-.197-.315a8.272 8.272 0 01-1.272-4.444c0-4.576 3.723-8.299 8.303-8.299 2.217 0 4.302.864 5.87 2.432a8.261 8.261 0 012.43 5.871c0 4.576-3.725 8.294-8.303 8.294z"/>
                </svg>
                <span>Booking Cepat via WhatsApp</span>
              </button>
            </div>

            <!-- Trust Badges 2x2 Grid -->
            <div class="trust-badges-grid">
              <div class="trust-badge-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>Tanpa Biaya Tersembunyi</span>
              </div>
              <div class="trust-badge-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                <span>Reschedule Fleksibel (H-1)</span>
              </div>
              <div class="trust-badge-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                <span>Pembatalan & Garansi Resmi</span>
              </div>
              <div class="trust-badge-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <span>Admin Siaga 24 Jam</span>
              </div>
            </div>

            <!-- Large Group Hotline Notice -->
            <div class="group-hotline-box">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <div>
                Butuh rute custom atau rombongan bus besar (min 20 pax)? <br>
                Hubungi hotline: <a href="https://wa.me/6281361645727" target="_blank">+62 813-6164-5727</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- ========================================================================
     MODAL PEMBAYARAN DP (30%)
     ======================================================================== -->
<div class="modal-overlay" id="dpPaymentModal">
  <div class="modal-content dp-modal-content">
    <button type="button" class="modal-close-btn" id="closeDpModal">&times;</button>
    
    <div class="dp-modal-header text-center">
      <span class="badge-pill badge-pill-outline" style="margin-bottom: 8px;">LANGKAH 3 : PEMBAYARAN DP 30%</span>
      <h3 style="font-family: var(--font-heading); font-size: 22px; color: #fff;">Instruksi Pembayaran DP Booking</h3>
      <p style="font-size: 13px; color: var(--text-muted); margin-top: 6px;">
        Silakan lakukan transfer komitmen DP untuk mengunci slot armada Jeep Anda.
      </p>
    </div>

    <!-- DP Amount Box -->
    <div class="dp-amount-card">
      <div class="dp-amount-sub">Nominal Uang Muka (DP 30%)</div>
      <div class="dp-amount-big" id="modalDpAmount">Rp 165.000</div>
      <div class="dp-amount-note">Sisa pelunasan (<span id="modalRemainingAmount">Rp 385.000</span>) dibayarkan di Basecamp saat hari H (Tunai / QRIS)</div>
    </div>

    <!-- Booking Summary Compact -->
    <div class="modal-booking-summary">
      <div class="summary-compact-row">
        <span>Nama Pemesan:</span>
        <strong id="modalSummaryName">-</strong>
      </div>
      <div class="summary-compact-row">
        <span>Paket Wisata:</span>
        <strong id="modalSummaryPackage">-</strong>
      </div>
      <div class="summary-compact-row">
        <span>Jadwal & Sesi:</span>
        <strong id="modalSummarySchedule">-</strong>
      </div>
      <div class="summary-compact-row">
        <span>Armada & Kapasitas:</span>
        <strong id="modalSummaryArmada">-</strong>
      </div>
    </div>

    <!-- Bank Accounts Grid -->
    <div class="bank-accounts-title">PILIHAN REKENING RESMI:</div>
    <div class="bank-accounts-list">
      <!-- Bank BCA -->
      <div class="bank-item">
        <div class="bank-brand">
          <span class="bank-code bca">BCA</span>
          <div>
            <div class="bank-acc-num">802-045-8899</div>
            <div class="bank-acc-name">a.n. Jeep Wukirsari Adventure</div>
          </div>
        </div>
        <button type="button" class="btn-copy-acc" data-copy="8020458899">Salin No. Rek</button>
      </div>

      <!-- Bank Mandiri -->
      <div class="bank-item">
        <div class="bank-brand">
          <span class="bank-code mandiri">MANDIRI</span>
          <div>
            <div class="bank-acc-num">137-00-1928-3344</div>
            <div class="bank-acc-name">a.n. Jeep Wukirsari Adventure</div>
          </div>
        </div>
        <button type="button" class="btn-copy-acc" data-copy="1370019283344">Salin No. Rek</button>
      </div>

      <!-- Bank BRI -->
      <div class="bank-item">
        <div class="bank-brand">
          <span class="bank-code bri">BRI</span>
          <div>
            <div class="bank-acc-num">0105-01-059944-50-8</div>
            <div class="bank-acc-name">a.n. Jeep Wukirsari Adventure</div>
          </div>
        </div>
        <button type="button" class="btn-copy-acc" data-copy="010501059944508">Salin No. Rek</button>
      </div>
    </div>

    <!-- Action Modal -->
    <div class="dp-modal-actions mt-4">
      <button type="button" class="btn btn-orange btn-block" id="btnConfirmDpWhatsApp">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12.031 2c-5.513 0-9.99 4.477-9.99 9.99 0 1.76.458 3.475 1.33 4.989L2 22l5.167-1.353a9.948 9.948 0 004.864 1.258h.004c5.513 0 9.99-4.477 9.99-9.99 0-2.668-1.039-5.176-2.926-7.063A9.927 9.927 0 0012.031 2zm0 18.318a8.29 8.29 0 01-4.226-1.157l-.303-.18-3.141.824.838-3.061-.197-.315a8.272 8.272 0 01-1.272-4.444c0-4.576 3.723-8.299 8.303-8.299 2.217 0 4.302.864 5.87 2.432a8.261 8.261 0 012.43 5.871c0 4.576-3.725 8.294-8.303 8.294z"/>
        </svg>
        <span>Kirim Konfirmasi & Bukti Transfer via WhatsApp</span>
      </button>

      <button type="button" class="btn btn-outline-white btn-block mt-2" id="btnCloseModalBottom">
        Tutup Jendela Ini
      </button>
    </div>

  </div>
</div>

<!-- ========================================================================
     CLIENT-SIDE REACTIVE JAVASCRIPT
     ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // 1. Initial State
  const defaultDate = new Date();
  defaultDate.setDate(defaultDate.getDate() + 1); // default tomorrow
  const yyyy = defaultDate.getFullYear();
  const mm = String(defaultDate.getMonth() + 1).padStart(2, '0');
  const dd = String(defaultDate.getDate()).padStart(2, '0');
  const dateInput = document.getElementById('bookingDate');
  if (dateInput) {
    dateInput.min = `${yyyy}-${mm}-${dd}`;
    dateInput.value = `${yyyy}-${mm}-${dd}`;
  }

  let selectedPackage = @if($selectedPackage) {
    name: '{{ $selectedPackage["name"] }}',
    price: {{ $selectedPackage["price_raw"] }},
    duration: '{{ $selectedPackage["duration"] }}',
    destinations: '{{ count($selectedPackage["features"]) }} Destinasi'
  } @else null @endif;

  let jeepCount = 1;
  let selectedSession = 'Sesi Pagi 1 (07.00 - 09.30 WIB)';
  let selectedSessionTime = '07.00 - 09.30 WIB';
  let pickupType = 'Basecamp Wukirsari Cangkringan';
  let isHotelPickup = false;

  const phoneHotline = '6281361645727';

  // Format IDR Helper
  function formatIDR(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  }

  // Format Date Indo
  function formatDateIndo(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    if (isNaN(date.getTime())) return dateStr;
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    return `${days[date.getDay()]}, ${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
  }

  // Helper: Transition Stepper Step 1 to Green (Completed)
  function updateStepperOnPackageSelected() {
    const stepItem1 = document.getElementById('stepItem1');
    const stepIcon1 = document.getElementById('stepIcon1');
    const stepSub1 = document.getElementById('stepSub1');
    const stepItem2 = document.getElementById('stepItem2');
    const stepSub2 = document.getElementById('stepSub2');
    const progressBadge = document.getElementById('stepProgressBadge');

    if (stepItem1) {
      stepItem1.classList.remove('step-active');
      stepItem1.classList.add('step-completed');
    }
    if (stepIcon1) {
      stepIcon1.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>';
    }
    if (stepSub1) {
      stepSub1.textContent = 'LANGKAH 1 (SELESAI)';
    }

    if (stepItem2) {
      stepItem2.classList.remove('step-pending');
      stepItem2.classList.add('step-active');
    }
    if (stepSub2) {
      stepSub2.textContent = 'SEDANG DIISI';
    }

    if (progressBadge) {
      progressBadge.textContent = 'Step 2/3 Selesai';
    }
  }

  // Update Summary Calculation
  function updateSummary() {
    if (!selectedPackage) {
      document.getElementById('summaryPackageName').textContent = 'Pilih Paket Wisata';
      document.getElementById('summaryPackageMeta').textContent = 'Silakan klik salah satu paket di sebelah kiri';
      document.getElementById('summaryDateVal').textContent = formatDateIndo(dateInput ? dateInput.value : '');
      document.getElementById('summarySessionVal').textContent = selectedSessionTime;
      document.getElementById('summaryJeepVal').textContent = `${jeepCount} Unit Jeep 4x4`;
      document.getElementById('summaryPaxVal').textContent = `${jeepCount * 4} Penumpang`;

      document.getElementById('summarySubtotalVal').textContent = 'Rp 0';
      document.getElementById('summaryPickupFeeVal').textContent = isHotelPickup ? 'Rp 0 (Hotel Gratis <=5km)' : 'Rp 0 (Basecamp)';
      document.getElementById('summaryTotalVal').textContent = 'Rp 0';
      document.getElementById('summaryDpVal').textContent = 'Rp 0';
      document.getElementById('summaryBalanceVal').textContent = 'Rp 0 (Tunai / QRIS)';

      document.getElementById('hiddenPackageName').value = '';
      document.getElementById('hiddenTotalBiaya').value = '0';
      document.getElementById('hiddenDpBiaya').value = '0';

      document.getElementById('modalDpAmount').textContent = 'Rp 0';
      document.getElementById('modalRemainingAmount').textContent = 'Rp 0';
      return;
    }

    const subtotal = selectedPackage.price * jeepCount;
    const total = subtotal; // pickup in radius 5km is free
    const dp = Math.round(total * 0.3);
    const remaining = total - dp;

    // Sidebar DOM
    document.getElementById('summaryPackageName').textContent = selectedPackage.name;
    document.getElementById('summaryPackageMeta').textContent = `Durasi ${selectedPackage.duration} (${selectedPackage.destinations})`;
    document.getElementById('summaryDateVal').textContent = formatDateIndo(dateInput ? dateInput.value : '');
    document.getElementById('summarySessionVal').textContent = selectedSessionTime;
    document.getElementById('summaryJeepVal').textContent = `${jeepCount} Unit Jeep 4x4`;
    document.getElementById('summaryPaxVal').textContent = `${jeepCount * 4} Penumpang`;

    document.getElementById('summarySubtotalVal').textContent = formatIDR(subtotal);
    document.getElementById('summaryPickupFeeVal').textContent = isHotelPickup ? 'Rp 0 (Hotel Gratis <=5km)' : 'Rp 0 (Basecamp)';
    document.getElementById('summaryTotalVal').textContent = formatIDR(total);
    document.getElementById('summaryDpVal').textContent = formatIDR(dp);
    document.getElementById('summaryBalanceVal').textContent = `${formatIDR(remaining)} (Tunai / QRIS)`;

    // Hidden form inputs
    document.getElementById('hiddenPackageName').value = selectedPackage.name;
    document.getElementById('hiddenTotalBiaya').value = total;
    document.getElementById('hiddenDpBiaya').value = dp;

    // Modal elements
    document.getElementById('modalDpAmount').textContent = formatIDR(dp);
    document.getElementById('modalRemainingAmount').textContent = formatIDR(remaining);
  }

  // 2. Package Option Selection
  const packageCards = document.querySelectorAll('.package-option-card');
  packageCards.forEach(card => {
    card.addEventListener('click', function() {
      packageCards.forEach(c => c.classList.remove('selected'));
      this.classList.add('selected');
      const radio = this.querySelector('.package-radio-input');
      if (radio) radio.checked = true;

      selectedPackage = {
        name: this.dataset.name,
        price: parseInt(this.dataset.price),
        duration: this.dataset.duration,
        destinations: (this.dataset.features.split(',').length) + ' Destinasi'
      };

      // Transition step 1 to green (completed) and step 2 to active
      updateStepperOnPackageSelected();

      updateSummary();
    });
  });

  // 3. Date Change
  if (dateInput) {
    dateInput.addEventListener('change', updateSummary);
  }

  // 4. Session Selection
  const sessionCards = document.querySelectorAll('.session-card');
  sessionCards.forEach(card => {
    card.addEventListener('click', function() {
      sessionCards.forEach(s => s.classList.remove('selected'));
      this.classList.add('selected');
      const radio = this.querySelector('.session-radio-input');
      if (radio) {
        radio.checked = true;
        selectedSession = radio.value;
      }
      selectedSessionTime = `${this.dataset.time} WIB`;
      updateSummary();
    });
  });

  // 5. Jeep Counter
  const countInput = document.getElementById('jeepCountInput');
  const btnMinus = document.getElementById('btnMinusJeep');
  const btnPlus = document.getElementById('btnPlusJeep');

  btnMinus.addEventListener('click', function() {
    if (jeepCount > 1) {
      jeepCount--;
      countInput.value = jeepCount;
      updateSummary();
    }
  });

  btnPlus.addEventListener('click', function() {
    if (jeepCount < 20) {
      jeepCount++;
      countInput.value = jeepCount;
      updateSummary();
    }
  });

  // 6. Pickup Location Radio
  const pickupBasecamp = document.getElementById('pickupBasecampOpt');
  const pickupHotel = document.getElementById('pickupHotelOpt');
  const hotelInputWrap = document.getElementById('hotelInputWrap');

  if (pickupBasecamp && pickupHotel) {
    pickupBasecamp.addEventListener('click', function() {
      pickupBasecamp.classList.add('selected');
      pickupHotel.classList.remove('selected');
      hotelInputWrap.style.display = 'none';
      pickupType = 'Basecamp Wukirsari Cangkringan';
      isHotelPickup = false;
      updateSummary();
    });

    pickupHotel.addEventListener('click', function() {
      pickupHotel.classList.add('selected');
      pickupBasecamp.classList.remove('selected');
      hotelInputWrap.style.display = 'block';
      pickupType = 'Penjemputan Hotel / Villa Sekitar Cangkringan & Kaliurang';
      isHotelPickup = true;
      updateSummary();
    });
  }

  // 7. WhatsApp Generator Helper
  function generateWhatsAppMessage(isForDp = false) {
    const name = document.getElementById('customerName').value.trim() || 'Pemesan (Belum diisi)';
    const phone = document.getElementById('customerPhone').value.trim() || '-';
    const email = document.getElementById('customerEmail').value.trim();
    const dateVal = formatDateIndo(dateInput ? dateInput.value : '');
    const notes = document.getElementById('customerNotes').value.trim();
    const hotelDetail = isHotelPickup ? (document.getElementById('hotelNameInput').value.trim() || 'Lobby Penginapan') : 'Basecamp Langsung';

    const subtotal = selectedPackage.price * jeepCount;
    const total = subtotal;
    const dp = Math.round(total * 0.3);
    const balance = total - dp;

    let msg = `*Halo Admin Jeep Wisata Wukirsari Adventure,*\n`;
    msg += isForDp ? `Saya ingin mengonfirmasi pembayaran DP untuk pemesanan berikut:\n\n` : `Saya ingin reservasi trip offroad melalui formulir website:\n\n`;
    msg += `━━━━━━━━━━━━━━━━━━━━━\n`;
    msg += `📋 *DETAIL PESANAN:*\n`;
    msg += `• Nama Pemesan: *${name}*\n`;
    msg += `• No. WhatsApp: *${phone}*\n`;
    if (email) msg += `• Email E-Tiket: ${email}\n`;
    msg += `• Paket Wisata: *${selectedPackage.name}*\n`;
    msg += `• Tanggal Trip: *${dateVal}*\n`;
    msg += `• Sesi Jam: *${selectedSession}*\n`;
    msg += `• Total Armada: *${jeepCount} Unit Jeep 4x4* (Kapasitas maks. ${jeepCount * 4} Pax)\n`;
    msg += `• Titik Kumpul: *${pickupType}*\n`;
    if (isHotelPickup) msg += `• Lokasi Hotel: ${hotelDetail}\n`;
    if (notes) msg += `• Catatan Khusus: _${notes}_\n`;
    msg += `━━━━━━━━━━━━━━━━━━━━━\n`;
    msg += `💰 *RINCIAN BIAYA:*\n`;
    msg += `• Total Biaya: *${formatIDR(total)}*\n`;
    msg += `• Komitmen DP (30%): *${formatIDR(dp)}*\n`;
    msg += `• Sisa Pelunasan di Lokasi: *${formatIDR(balance)}*\n`;
    msg += `━━━━━━━━━━━━━━━━━━━━━\n`;
    
    if (isForDp) {
      msg += `_Berikut saya lampirkan bukti transfer DP saya. Mohon dicek dan diterbitkan e-tiket konfirmasi resminya ya Admin. Terima kasih!_`;
    } else {
      msg += `Mohon konfirmasi ketersediaan slot armada pada jadwal tersebut dan petunjuk transfer DP. Terima kasih!`;
    }

    return `https://wa.me/${phoneHotline}?text=` + encodeURIComponent(msg);
  }

  // 8. Form Validation Helper
  function validateBasicFields() {
    if (!selectedPackage) {
      alert('Silakan pilih salah satu Paket Wisata Jeep terlebih dahulu pada Langkah 1.');
      const pkgSec = document.getElementById('section-paket');
      if (pkgSec) pkgSec.scrollIntoView({ behavior: 'smooth' });
      return false;
    }

    const name = document.getElementById('customerName');
    const phone = document.getElementById('customerPhone');

    if (!name.value.trim()) {
      alert('Mohon isi Nama Lengkap Pemesan.');
      name.focus();
      return false;
    }

    if (!phone.value.trim()) {
      alert('Mohon isi Nomor WhatsApp Aktif.');
      phone.focus();
      return false;
    }

    return true;
  }

  // 9. Quick Booking via WhatsApp Click
  document.getElementById('btnBookingWhatsApp').addEventListener('click', function() {
    if (!validateBasicFields()) return;
    const waUrl = generateWhatsAppMessage(false);
    window.open(waUrl, '_blank');
  });

  // 10. DP Modal Open & Confirm
  const dpModal = document.getElementById('dpPaymentModal');
  const closeDpModal = document.getElementById('closeDpModal');
  const closeBtnBottom = document.getElementById('btnCloseModalBottom');

  document.getElementById('btnSubmitDp').addEventListener('click', function() {
    if (!validateBasicFields()) return;

    // Populate modal summary text
    document.getElementById('modalSummaryName').textContent = document.getElementById('customerName').value.trim();
    document.getElementById('modalSummaryPackage').textContent = selectedPackage.name;
    document.getElementById('modalSummarySchedule').textContent = `${formatDateIndo(dateInput.value)} (${selectedSessionTime})`;
    document.getElementById('modalSummaryArmada').textContent = `${jeepCount} Unit Jeep 4x4 (${jeepCount * 4} Penumpang)`;

    dpModal.classList.add('active');
  });

  function closeModal() {
    dpModal.classList.remove('active');
  }

  if (closeDpModal) closeDpModal.addEventListener('click', closeModal);
  if (closeBtnBottom) closeBtnBottom.addEventListener('click', closeModal);
  window.addEventListener('click', function(e) {
    if (e.target === dpModal) closeModal();
  });

  // 11. Copy Account Number Buttons
  document.querySelectorAll('.btn-copy-acc').forEach(btn => {
    btn.addEventListener('click', function() {
      const textToCopy = this.dataset.copy;
      navigator.clipboard.writeText(textToCopy).then(() => {
        const originalText = this.textContent;
        this.textContent = '✓ Tersalin!';
        this.style.background = '#10b981';
        this.style.color = '#fff';
        setTimeout(() => {
          this.textContent = originalText;
          this.style.background = '';
          this.style.color = '';
        }, 2000);
      });
    });
  });

  // 12. Confirm DP via WhatsApp from Modal
  document.getElementById('btnConfirmDpWhatsApp').addEventListener('click', function() {
    const waUrl = generateWhatsAppMessage(true);
    window.open(waUrl, '_blank');
  });

  // Initialize summary on load
  updateSummary();
});
</script>

@endsection
