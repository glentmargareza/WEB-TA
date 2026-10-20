@extends('layouts.app')

@section('title', 'Pembayaran DP & Konfirmasi Reservasi | Jeep Wisata Wukirsari Adventure')

@section('content')

<!-- Menyisipkan Stylesheet Khusus Pembayaran Secara Terpisah & Modular -->
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">

<!-- ========================================================================
     1. STEPPER SECTION (LANGKAH 1, 2, 3 SESUAI FIGMA)
     ======================================================================== -->
<section class="payment-stepper-section">
  <div class="container">
    <div class="payment-stepper-grid">
      
      <!-- Langkah 1: Selesai -->
      <a href="{{ route('home') }}#paket-wisata" class="stepper-card step-done" title="Kembali ke Pilihan Paket">
        <div class="step-circle">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="step-label-group">
          <span class="step-status-tag">LANGKAH 1</span>
          <span class="step-name">Pilih Paket Wisata</span>
        </div>
      </a>

      <!-- Langkah 2: Selesai -->
      <a href="javascript:history.back()" class="stepper-card step-done" title="Kembali ke Pengisian Data">
        <div class="step-circle">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="step-label-group">
          <span class="step-status-tag">LANGKAH 2</span>
          <span class="step-name">Jadwal & Data</span>
        </div>
      </a>

      <!-- Langkah 3: Sedang Diisi (Aktif) -->
      <div class="stepper-card step-active">
        <div class="step-circle">3</div>
        <div class="step-label-group">
          <span class="step-status-tag">SEDANG DIISI</span>
          <span class="step-name">DP & Konfirmasi</span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ========================================================================
     2. MAIN PAYMENT CONTENT WRAPPER
     ======================================================================== -->
<section class="payment-page-wrapper">
  <div class="container">
    <div class="payment-layout-grid">

      <!-- ================= LEFT COLUMN: PAYMENT INSTRUCTIONS ================= -->
      <div class="payment-main-col">

        <!-- 2.1 CARD TIMER PENGUNCIAN SLOT ARMADA -->
        <div class="slot-hold-card">
          <div class="slot-timer-header">
            <div class="timer-title-wrap">
              <div class="timer-icon-box">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
              </div>
              <span class="timer-title-text">WAKTU TERSISA PENGUNCIAN SLOT</span>
            </div>

            <div class="slot-hold-badge">
              <span class="badge-dot"></span>
              <span>Unit {{ $bookingData['armada_no'] }} Hold</span>
            </div>
          </div>

          <div class="timer-countdown-row">
            <div class="timer-clock-digits" id="timerDigits">14 Menit : 48 Detik</div>
            <span class="timer-sub-note">(Batas waktu penyelesaian transfer DP)</span>
          </div>

          <!-- Progress Bar Animasi Waktu -->
          <div class="timer-progress-track">
            <div class="timer-progress-bar" id="timerProgressBar"></div>
          </div>

          <p class="slot-hold-desc">
            Armada Jeep Willys 4×4 Standby No. Lambung <strong>{{ $bookingData['armada_no'] }}</strong> ditahan sementara hingga timer habis. Pembayaran otomatis tercatat tanpa perlu refresh halaman.
          </p>

          @if($bookingData['is_preview'])
          <div class="preview-alert-strip">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <span><strong>Mode Pratinjau Tampilan:</strong> Data pemesan dan armada di bawah ini merupakan data contoh untuk visualisasi desain Figma.</span>
          </div>
          @endif
        </div>

        <!-- 2.2 METODE PEMBAYARAN DP -->
        <div class="payment-method-card">
          <div class="payment-card-header">
            <div class="payment-card-title-wrap">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <line x1="2" y1="10" x2="22" y2="10"/>
              </svg>
              <h3 class="payment-card-title">Metode Pembayaran DP</h3>
            </div>
            <span class="badge-realtime">REAL-TIME INSTANT</span>
          </div>

          <!-- Tab Navigasi Metode Pembayaran -->
          <div class="payment-tabs-nav">
            <button type="button" class="pay-tab-btn active" data-tab="tab-qris" id="btnTabQris">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              <span>QRIS Instan (Semua Bank / E-Wallet)</span>
            </button>

            <button type="button" class="pay-tab-btn" data-tab="tab-va" id="btnTabVa">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="8" x2="17" y2="8"/><line x1="7" y1="12" x2="17" y2="12"/><line x1="7" y1="16" x2="13" y2="16"/></svg>
              <span>Virtual Account 24 Jam</span>
              <span class="tab-pill-badge">Segera Hadir</span>
            </button>

            <button type="button" class="pay-tab-btn" data-tab="tab-cc" id="btnTabCc">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
              <span>Kartu Kredit / Debit</span>
              <span class="tab-pill-badge">Segera Hadir</span>
            </button>
          </div>

          <!-- TAB CONTENT 1: QRIS INSTAN (DEFAULT) -->
          <div class="pay-tab-content" id="tab-qris">
            <div class="qris-detail-box">
              
              <!-- Kolom Kiri: QR Frame Placeholder -->
              <div class="qris-qr-col">
                <div class="qris-frame">
                  <img src="{{ asset('images/qris-placeholder.svg') }}" alt="Placeholder QRIS Jeep Wukirsari Adventure" id="qrisImagePlaceholder">
                  <span class="qris-nmid-text">NMID: (Menunggu Konfigurasi)</span>
                </div>

                <button type="button" class="btn-download-qr" title="QRIS resmi belum dikonfigurasi" disabled>
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                  <span>Unduh QR</span>
                </button>
              </div>

              <!-- Kolom Kanan: Nominal Transfer & Panduan 3 Langkah -->
              <div class="qris-info-col">
                <div class="nominal-transfer-card">
                  <div>
                    <div class="nominal-label">NOMINAL TRANSFER DP TEPAT</div>
                    <div class="nominal-amount" id="displayDpAmount">Rp {{ number_format($bookingData['dp_biaya'], 0, ',', '.') }}</div>
                  </div>

                  <button type="button" class="btn-copy-amount" id="btnCopyNominal" data-copy="{{ $bookingData['dp_biaya'] }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    <span id="copyBtnText">Salin</span>
                  </button>
                </div>

                <!-- Langkah Pembayaran -->
                <div class="qris-steps-list">
                  <div class="qris-step-item">
                    <span class="step-num-badge">1</span>
                    <div>Buka aplikasi mobile banking (BCA, Mandiri, BRI, BNI) atau dompet digital (GoPay, Dana, OVO, ShopeePay).</div>
                  </div>

                  <div class="qris-step-item">
                    <span class="step-num-badge">2</span>
                    <div>Pilih menu <strong>Pindai / Scan QRIS</strong> lalu arahkan kamera ke barcode di samping.</div>
                  </div>

                  <div class="qris-step-item">
                    <span class="step-num-badge">3</span>
                    <div>Pastikan nama merchant adalah <strong>JEEP WUKIRSARI ADVENTURE</strong>, lalu input PIN Anda.</div>
                  </div>
                </div>

                <!-- Chips Logo Bank & E-Wallet -->
                <div class="supported-apps-row">
                  <span class="supported-app-chip">BCA Mobile</span>
                  <span class="supported-app-chip">Livin Mandiri</span>
                  <span class="supported-app-chip">BRImo</span>
                  <span class="supported-app-chip">GoPay</span>
                  <span class="supported-app-chip">DANA</span>
                  <span class="supported-app-chip">+ 20 Lainnya</span>
                </div>
              </div>

            </div>
          </div>

          <!-- TAB CONTENT 2: VIRTUAL ACCOUNT (INACTIVE) -->
          <div class="pay-tab-content" id="tab-va" style="display: none;">
            <div class="tab-inactive-card">
              <h4>Kanal Virtual Account Dalam Tahap Integrasi</h4>
              <p>Metode pembayaran Virtual Account otomatis 24 Jam sedang dipersiapkan dan akan segera aktif setelah proses integrasi payment gateway selesai. Silakan gunakan metode QRIS Instan atau konfirmasi manual via WhatsApp.</p>
            </div>
          </div>

          <!-- TAB CONTENT 3: KARTU KREDIT (INACTIVE) -->
          <div class="pay-tab-content" id="tab-cc" style="display: none;">
            <div class="tab-inactive-card">
              <h4>Kanal Kartu Kredit / Debit Dalam Tahap Integrasi</h4>
              <p>Metode pembayaran kartu kredit Visa, Mastercard, dan JCB sedang dalam proses sertifikasi keamanan transaksi. Silakan gunakan kanal QRIS Instan di samping.</p>
            </div>
          </div>

        </div>

        <!-- 2.3 JAMINAN TRANSAKSI & PERLINDUNGAN TRIP (3 CARD) -->
        <div class="payment-guarantees-grid">
          
          <!-- Card 1: Cuaca Ekstrem -->
          <div class="guarantee-card">
            <div class="guarantee-icon-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
            </div>
            <h4 class="guarantee-title">Garansi Cuaca Ekstrem</h4>
            <p class="guarantee-desc">Reschedule jadwal 100% gratis tanpa potongan biaya bila status Merapi waspada atau terjadi badai lebat.</p>
          </div>

          <!-- Card 2: Asuransi Jasa Raharja -->
          <div class="guarantee-card">
            <div class="guarantee-icon-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h4 class="guarantee-title">Asuransi Jasa Raharja</h4>
            <p class="guarantee-desc">Seluruh 4 orang penumpang dalam Jeep telah terlindungi asuransi jiwa & medis resmi dari penjemputan hingga trip usai.</p>
          </div>

          <!-- Card 3: E-Tiket Otomatis -->
          <div class="guarantee-card">
            <div class="guarantee-icon-box">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <h4 class="guarantee-title">E-Tiket Otomatis</h4>
            <p class="guarantee-desc">Setelah DP terverifikasi, PDF tiket ber-barcode dan kontak driver dikirim langsung via WhatsApp ke nomor PIC.</p>
          </div>

        </div>

      </div>

      <!-- ================= RIGHT COLUMN: STICKY BOOKING SUMMARY ================= -->
      <div class="payment-summary-col">
        
        <!-- Summary Card -->
        <div class="payment-summary-card">
          <div class="summary-header-row">
            <div>
              <h4 style="font-family: var(--font-heading); font-size: 16px; font-weight: 800; color: #fff;">Ringkasan Booking</h4>
              <span style="font-size: 11.5px; color: var(--text-dim);">Wukirsari Adventure 4×4</span>
            </div>
            
            <div class="status-badge-waiting">
              <span class="badge-dot"></span>
              <span>Menunggu DP</span>
            </div>
          </div>

          <!-- Box Paket Terpilih -->
          <div class="summary-package-card">
            <div class="pkg-icon-wrap">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="6" rx="2"/>
                <path d="M5 11l2-5h10l2 5"/>
                <circle cx="7.5" cy="17" r="2.5"/>
                <circle cx="16.5" cy="17" r="2.5"/>
              </svg>
            </div>
            <div class="pkg-info-wrap">
              <span class="pkg-tag">PAKET TERPILIH</span>
              <div class="pkg-name">{{ $bookingData['paket'] }}</div>
              <div class="pkg-route">{{ $bookingData['paket_desc'] }}</div>
            </div>
          </div>

          <!-- Metadata Booking -->
          <div class="summary-meta-list">
            
            <div class="meta-item-row">
              <svg class="meta-item-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <span class="meta-item-label">Jadwal Keberangkatan</span>
              <span class="meta-item-val">{{ $bookingData['tanggal_formatted'] }}</span>
            </div>

            <div class="meta-item-row">
              <svg class="meta-item-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span class="meta-item-label">Sesi Waktu</span>
              <span class="meta-item-val">{{ $bookingData['sesi'] }}</span>
            </div>

            <div class="meta-item-row">
              <svg class="meta-item-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="6" rx="2"/><circle cx="7.5" cy="17" r="2.5"/><circle cx="16.5" cy="17" r="2.5"/></svg>
              <span class="meta-item-label">Tipe Unit Armada</span>
              <span class="meta-item-val">{{ $bookingData['armada_tipe'] }}</span>
            </div>

            <div class="meta-item-row">
              <svg class="meta-item-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span class="meta-item-label">Titik Penjemputan</span>
              <span class="meta-item-val">{{ $bookingData['titik_kumpul'] }}</span>
            </div>

            <div class="meta-item-row">
              <svg class="meta-item-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <span class="meta-item-label">Nama PIC / Kontak</span>
              <span class="meta-item-val">{{ $bookingData['nama'] }} ({{ $bookingData['telepon'] }})</span>
            </div>

          </div>

          <!-- Rincian Finansial -->
          <div class="financial-box">
            <h5 class="financial-box-title">Rincian Finansial</h5>

            <div class="financial-rows-list">
              <div class="fin-row">
                <span class="fin-label">Tarif Paket ({{ $bookingData['jumlah_jeep'] }} Jeep)</span>
                <span class="fin-val">Rp {{ number_format($bookingData['total_biaya'], 0, ',', '.') }}</span>
              </div>

              <div class="fin-row">
                <span class="fin-label">Layanan Penjemputan Basecamp</span>
                <span class="fin-val free">FREE</span>
              </div>

              <div class="fin-row">
                <span class="fin-label">Asuransi Resmi 4 Peserta</span>
                <span class="fin-val free">Termasuk</span>
              </div>

              <div class="fin-divider"></div>

              <div class="fin-row total-row">
                <span class="fin-label">Total Tarif Keseluruhan</span>
                <span class="fin-val">Rp {{ number_format($bookingData['total_biaya'], 0, ',', '.') }}</span>
              </div>

              <!-- DP Wajib 30% -->
              <div class="fin-row dp-highlight-row">
                <div class="dp-highlight-label">
                  <span class="dp-title">UANG MUKA WAJIB (30%)</span>
                  <span class="dp-sub">Kunci Unit & Jadwal</span>
                </div>
                <div class="dp-highlight-val">Rp {{ number_format($bookingData['dp_biaya'], 0, ',', '.') }}</div>
              </div>

              <!-- Sisa Pelunasan -->
              <div class="fin-row balance-row">
                <span class="fin-label">Sisa Pelunasan di Basecamp:</span>
                <span class="fin-val">Rp {{ number_format($bookingData['sisa_pelunasan'], 0, ',', '.') }}</span>
              </div>

              <p class="balance-footnote">
                Dapat dibayar tunai atau gesek EDC saat registrasi ulang di lokasi basecamp.
              </p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="summary-action-group">
            <button type="button" class="btn-confirm-transfer" id="btnConfirmTransfer">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
              <span>Saya Sudah Transfer DP • Cek Status</span>
            </button>

            <a href="javascript:history.back()" class="btn-back-step2">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              <span>Kembali ke Langkah 2: Jadwal & Data</span>
            </a>
          </div>

        </div>

        <!-- Corporate Invoice Card -->
        <div class="invoice-corporate-card">
          <div class="invoice-icon-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>

          <div class="invoice-content-wrap">
            <h5 class="invoice-title">Butuh Invoice Resmi Perusahaan?</h5>
            <p class="invoice-desc">Hubungi Finance kami untuk kwitansi stempel basah atau faktur PPN rombongan corporate.</p>
            <a href="https://wa.me/6281361645727?text=Halo%20Finance%20Jeep%20Wukirsari,%20saya%20butuh%20invoice%20resmi%20corporate%20untuk%20booking%20Jeep" target="_blank" class="invoice-link-btn">
              <span>Hubungi WhatsApp Finance (+62 813-6164-5727)</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- ========================================================================
     3. STATUS & VERIFIKASI PEMBAYARAN MODAL (TRANSPARAN & AMAN)
     ======================================================================== -->
<div class="status-modal-overlay" id="statusModalOverlay">
  <div class="status-modal-card">
    <div class="status-modal-header">
      <div class="status-icon-badge">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
      </div>
      <h3 class="status-modal-title">Konfirmasi & Cek Status DP</h3>
      <p class="status-modal-sub">Jeep Wisata Wukirsari Adventure Yogyakarta</p>

      <div class="status-badge-pill">
        <span class="badge-dot" style="width: 7px; height: 7px; border-radius: 50%; background: var(--accent-orange); display: inline-block;"></span>
        <span>Status: Menunggu Verifikasi Manual Mutasi</span>
      </div>
    </div>

    <div class="status-instructions-box">
      <p style="margin-bottom: 8px;">
        <strong>Informasi Verifikasi:</strong> Pembayaran <strong>tidak otomatis ditandai lunas</strong> tanpa verifikasi bukti transfer.
      </p>
      <p style="margin-bottom: 8px;">
        Silakan kirimkan struk / bukti transfer DP Anda (sebesar <strong>Rp {{ number_format($bookingData['dp_biaya'], 0, ',', '.') }}</strong>) langsung ke WhatsApp Admin/Finance kami untuk dicek mutasinya secara manual.
      </p>
      <p style="color: var(--text-dim); font-size: 11.5px;">
        Setelah diverifikasi oleh staf kami, E-Tiket resmi ber-barcode akan diterbitkan dan dikirimkan ke nomor WhatsApp Anda.
      </p>
    </div>

    <div class="status-modal-actions">
      <a href="#" target="_blank" class="btn-send-wa-proof" id="btnSendWaProof">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24zm4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.25-1.5-1.4-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.13-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.34-.76-1.84-.2-.48-.4-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.13.17 1.78 2.71 4.3 3.8.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.12-.22-.19-.47-.32z"/>
        </svg>
        <span>Kirim Bukti Transfer ke WhatsApp Admin</span>
      </a>

      <button type="button" class="btn-close-status-modal" id="btnCloseStatusModal">
        <span>Tutup Jendela Ini</span>
      </button>
    </div>
  </div>
</div>

<!-- ========================================================================
     4. JAVASCRIPT LOGIC KHUSUS HALAMAN PEMBAYARAN
     ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  
  // 1. Tab Switching (QRIS, VA, CC)
  const tabBtns = document.querySelectorAll('.pay-tab-btn');
  const tabContents = document.querySelectorAll('.pay-tab-content');

  tabBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const targetId = this.dataset.tab;
      
      tabBtns.forEach(b => b.classList.remove('active'));
      tabContents.forEach(c => c.style.display = 'none');

      this.classList.add('active');
      const targetContent = document.getElementById(targetId);
      if (targetContent) {
        targetContent.style.display = 'block';
      }
    });
  });

  // 2. Countdown Timer Visual Penguncian Slot (14 Menit 48 Detik)
  let totalSeconds = 14 * 60 + 48; // 888 detik
  const initialSeconds = 15 * 60; // 900 detik basis perhitungan persen
  const digitsEl = document.getElementById('timerDigits');
  const barEl = document.getElementById('timerProgressBar');

  function updateTimer() {
    if (totalSeconds <= 0) {
      if (digitsEl) digitsEl.textContent = '00 Menit : 00 Detik (Waktu Habis)';
      if (barEl) barEl.style.width = '0%';
      return;
    }

    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    const padMin = String(minutes).padStart(2, '0');
    const padSec = String(seconds).padStart(2, '0');

    if (digitsEl) {
      digitsEl.textContent = `${padMin} Menit : ${padSec} Detik`;
    }

    if (barEl) {
      const percent = Math.max(0, Math.min(100, (totalSeconds / initialSeconds) * 100));
      barEl.style.width = `${percent}%`;
    }

    totalSeconds--;
  }

  updateTimer();
  setInterval(updateTimer, 1000);

  // 3. Tombol Salin Nominal DP
  const btnCopy = document.getElementById('btnCopyNominal');
  const copyText = document.getElementById('copyBtnText');
  
  if (btnCopy) {
    btnCopy.addEventListener('click', function() {
      const nominal = this.dataset.copy;
      navigator.clipboard.writeText(nominal).then(() => {
        if (copyText) copyText.textContent = '✓ Tersalin!';
        btnCopy.style.background = '#10b981';
        btnCopy.style.borderColor = '#10b981';
        btnCopy.style.color = '#ffffff';

        setTimeout(() => {
          if (copyText) copyText.textContent = 'Salin';
          btnCopy.style.background = '';
          btnCopy.style.borderColor = '';
          btnCopy.style.color = '';
        }, 2200);
      });
    });
  }

  // 4. Modal Konfirmasi & Cek Status DP
  const modalOverlay = document.getElementById('statusModalOverlay');
  const btnOpenModal = document.getElementById('btnConfirmTransfer');
  const btnCloseModal = document.getElementById('btnCloseStatusModal');
  const btnSendWa = document.getElementById('btnSendWaProof');

  const defaultWaText = encodeURIComponent(
    "Halo Admin Jeep Wisata Wukirsari Adventure,\n\n" +
    "Saya ingin mengonfirmasi pembayaran DP reservasi saya:\n" +
    "• Nama Pemesan: {{ $bookingData['nama'] }}\n" +
    "• Paket Wisata: {{ $bookingData['paket'] }}\n" +
    "• Tanggal & Sesi: {{ $bookingData['tanggal_formatted'] }} ({{ $bookingData['sesi'] }})\n" +
    "• Nominal DP: Rp {{ number_format($bookingData['dp_biaya'], 0, ',', '.') }}\n" +
    "• Status: Menunggu Verifikasi Manual Mutasi Bank\n\n" +
    "Berikut saya lampirkan bukti transfer saya untuk diverifikasi. Mohon dicek ya Admin. Terima kasih!"
  );

  const defaultWaUrl = "https://wa.me/6281361645727?text=" + defaultWaText;
  if (btnSendWa) {
    btnSendWa.href = defaultWaUrl;
  }

  if (btnOpenModal && modalOverlay) {
    btnOpenModal.addEventListener('click', function() {
      // Panggil endpoint verifikasi via AJAX jika tersedia
      fetch("{{ route('payment.confirm') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data && data.whatsapp_url && btnSendWa) {
          btnSendWa.href = data.whatsapp_url;
        }
      })
      .catch(() => {
        // Fallback tetap mengarah ke defaultWaUrl yang aman
        if (btnSendWa) btnSendWa.href = defaultWaUrl;
      });

      modalOverlay.classList.add('open');
    });
  }

  if (btnCloseModal && modalOverlay) {
    btnCloseModal.addEventListener('click', function() {
      modalOverlay.classList.remove('open');
    });
  }

  if (modalOverlay) {
    window.addEventListener('click', function(e) {
      if (e.target === modalOverlay) {
        modalOverlay.classList.remove('open');
      }
    });
  }

});
</script>

@endsection
