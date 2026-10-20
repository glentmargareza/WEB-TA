<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jeep Wisata Wukirsari | Petualangan di Lereng Merapi')</title>
    <meta name="description" content="@yield('description', 'Jelajahi keindahan alam Merapi bersama Jeep Wukirsari. Paket tour offroad seru, driver berpengalaman, armada 4x4 terawat.')">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Jeep Wisata Wukirsari | Petualangan di Lereng Merapi')">
    <meta property="og:description" content="@yield('description', 'Jelajahi keindahan alam Merapi bersama Jeep Wukirsari.')">
    <meta property="og:image" content="{{ asset('images/hero.jpeg') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Caveat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <script>document.documentElement.classList.add('js');</script>
    @stack('head')
</head>
<body>

  <!-- Top Announcement Bar -->
  <div class="topbar">
    <div class="container topbar-content">
      <div class="topbar-left">
        <div class="topbar-item">
          <span class="topbar-dot"></span>
          <span>Mitra Resmi Pengelola Jeep Wisata Wukirsari & Merapi | Operasional : Setiap Hari 04.00 - 18.00 WIB</span>
        </div>
      </div>
      <div class="topbar-right">
        <a href="https://wa.me/6281361645727" target="_blank" class="topbar-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          <span>+62 813-6164-5727</span>
        </a>
        <span style="opacity: 0.3;">|</span>
        <a href="{{ route('home') }}#basecamp" class="topbar-link">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <span>Basecamp Wukirsari Cangkringan</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Main Navigation Bar -->
  <header class="navbar">
    <div class="container navbar-container">
      <div>
        <a href="{{ route('home') }}" class="brand">
          <img src="{{ asset('images/logo.png') }}" alt="Jeep Wukirsari Adventure"
            style="width: 100px !important; height: 80px !important; object-fit: contain;">
        </a>
      </div>

      <!-- Desktop Nav Menu -->
      <ul class="nav-menu" id="navMenu">
        <li><a href="{{ route('home') }}#beranda" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('home') }}#paket-wisata" class="nav-link">Paket Wisata</a></li>
        <li><a href="{{ route('home') }}#spot-utama" class="nav-link">Rute & Destinasi</a></li>
        <li><a href="{{ route('home') }}#galeri" class="nav-link">Galeri</a></li>
        <li><a href="{{ route('home') }}#basecamp" class="nav-link">Lokasi Basecamp</a></li>
      </ul>

      <!-- CTA Button & Mobile Toggle -->
      <div style="display: flex; align-items: center; gap: 12px;">
        <a href="{{ route('tour.booking.page') }}" class="btn btn-orange">
          <span>BOOKING SEKARANG</span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>

        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
</header>

<main id="main">
    @yield('content')
</main>

<footer class="footer" id="kontak">
    <div class="container">
        <div class="footer__grid">
            <div>
                <div class="brand" style="margin-bottom: var(--space-2);">
                    <img class="brand__logo" src="{{ asset('images/logo.png') }}" alt="Logo {{ $brand['name'] }}" width="44" height="44" style="filter: brightness(0) invert(1);">
                    <div>
                        <span class="footer__brand-name" style="color: #ffffff;">{{ $brand['name'] }}</span>
                        <span style="display:block; font-size: var(--text-xs); color: var(--color-on-dark-muted);">{{ $brand['subname'] }}</span>
                    </div>
                </div>
                <p class="footer__text">{{ $brand['slogan'] }}</p>
            </div>

            <div>
                <h2 class="footer__title">Navigasi</h2>
                <ul class="footer__list">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('packages.index') }}">Paket Wisata</a></li>
                    <li><a href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                    <li><a href="{{ route('home') }}#galeri">Galeri</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
            </div>

        <!-- Col 2: Kontak & Reservasi -->
        <div>
          <h4 class="footer-col-title">Kontak & Reservasi</h4>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">📍</span>
            <span>Bedoyo, Wukirsari, Kec.Cngkringan, Kabupate Sleman D.I. Yogyakarta 55782</span>
          </div>
          <div class="footer-contact-item">
            <span class="footer-contact-icon">📱</span>
            <span>+62 813-6164-5727 (Reservasi WhatsApp)</span>
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

            <div>
                <h2 class="footer__title">Ikuti Kami</h2>
                <div class="social">
                    @if(!empty($social['instagram']))
                        <a href="{{ $social['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram">
                            <x-icon name="instagram" :size="18" />
                        </a>
                    @endif
                    @if(!empty($social['facebook']))
                        <a href="{{ $social['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook">
                            <x-icon name="facebook" :size="18" />
                        </a>
                    @endif
                    @if(!empty($social['tiktok']))
                        <a href="{{ $social['tiktok'] }}" target="_blank" rel="noopener" aria-label="TikTok">
                            <x-icon name="tiktok" :size="18" />
                        </a>
                    @endif
                    @if(!empty($social['youtube']))
                        <a href="{{ $social['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube">
                            <x-icon name="youtube" :size="18" />
                        </a>
                    @endif
                    @if($wa !== '')
                        <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" aria-label="WhatsApp">
                            <x-icon name="whatsapp" :size="18" />
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <span>&copy; {{ date('Y') }} {{ $brand['name'] }}. Semua hak dilindungi.</span>
            <div class="footer__legal">
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

{{-- Dialog Booking Pop-up --}}
<dialog class="dialog" id="booking-dialog" aria-labelledby="booking-title"
        data-open="{{ ($errors->any() || session('booking_error')) ? 'true' : 'false' }}">
    <div class="dialog__body">
        <button type="button" class="dialog__close" data-dialog-close aria-label="Tutup form booking">
            <x-icon name="x" :size="20" />
        </button>
        <div class="dialog__head">
            <h2 class="dialog__title" id="booking-title">Booking {{ $brand['name'] }}</h2>
            <p class="dialog__desc">Isi formulir di bawah ini. Pesanan Anda akan diteruskan ke WhatsApp admin untuk konfirmasi armada & jadwal.</p>
        </div>

        @if(session('booking_error'))
            <div class="alert" role="alert"><x-icon name="alert" :size="18" /> {{ session('booking_error') }}</div>
        @endif

        <form class="form" method="POST" action="{{ route('tour.book') }}" novalidate>
            @csrf
            <div class="form__row">
                <div class="field">
                    <label class="field__label" for="booking-name">Nama Lengkap</label>
                    <input class="field__control" id="booking-name" name="name" type="text" autocomplete="name"
                           placeholder="Contoh: Budi Santoso" value="{{ old('name') }}" required @error('name') aria-invalid="true" aria-describedby="err-name" @enderror>
                    @error('name')<p class="field__error" id="err-name"><x-icon name="alert" :size="16" /> {{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field__label" for="booking-phone">Nomor WhatsApp</label>
                    <input class="field__control" id="booking-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel"
                           placeholder="0812xxxxxxxx" value="{{ old('phone') }}" required @error('phone') aria-invalid="true" aria-describedby="err-phone" @enderror>
                    @error('phone')<p class="field__error" id="err-phone"><x-icon name="alert" :size="16" /> {{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field__label" for="booking-package">Paket Wisata</label>
                <select class="field__control" id="booking-package" name="package" required @error('package') aria-invalid="true" aria-describedby="err-package" @enderror>
                    @foreach(config('jeep.packages') as $p)
                        <option value="{{ $p['slug'] }}" data-session="{{ $p['default_session'] ?? 'pagi' }}" @selected(old('package') === $p['slug'])>
                            {{ $p['name'] }} - Rp {{ number_format($p['price'], 0, ',', '.') }} / paket ({{ $p['duration'] }})
                        </option>
                    @endforeach
                </select>
                @error('package')<p class="field__error" id="err-package"><x-icon name="alert" :size="16" /> {{ $message }}</p>@enderror
            </div>

            <div class="form__row">
                <div class="field">
                    <label class="field__label" for="booking-date">Tanggal Keberangkatan</label>
                    <input class="field__control" id="booking-date" name="date" type="date" min="{{ now()->toDateString() }}"
                           value="{{ old('date', now()->addDay()->toDateString()) }}" required @error('date') aria-invalid="true" aria-describedby="err-date" @enderror>
                    @error('date')<p class="field__error" id="err-date"><x-icon name="alert" :size="16" /> {{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field__label" for="booking-session">Sesi Jam</label>
                    <select class="field__control" id="booking-session" name="session" required>
                        @foreach(config('jeep.sessions') as $key => $label)
                            <option value="{{ $key }}" @selected(old('session') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <div class="form-group">
          <label class="form-label" for="inputJeepCount">Jumlah Armada Jeep (Maks. 4 Dewasa / Jeep) *</label>
          <select id="inputJeepCount" class="form-select" required>
            <option value="1">1 Armada Jeep (1 - 4 Orang / Maks. 5 jika 1 Anak Kecil)</option>
            <option value="2">2 Armada Jeep (5 - 8 Orang)</option>
            <option value="3">3 Armada Jeep (9 - 12 Orang)</option>
            <option value="4">4 Armada Jeep (13 - 16 Orang)</option>
            <option value="5">5 Armada Jeep (17 - 20 Orang)</option>
            <option value="10">Rombongan Lebih dari 5 Jeep (>20 Orang)</option>
          </select>
          <span style="font-size: 11.5px; color: var(--text-muted); display: block; margin-top: 4px;">Kapasitas normal 1 Jeep maks. 4 orang dewasa. Muat 5 orang bila 1 di antaranya anak kecil.</span>
        </div>

            <div class="field">
                <label class="field__label" for="booking-notes">Catatan Tambahan (Opsional)</label>
                <textarea class="field__control" id="booking-notes" name="notes" rows="2" maxlength="300" placeholder="Contoh: request spot foto tertentu, anak kecil, dll.">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn--primary btn--block">
                Lanjut Booking ke WhatsApp <x-icon name="arrow-right" :size="18" />
            </button>
        </form>
    </div>
</dialog>

{{-- Lightbox Galeri --}}
<dialog class="dialog dialog--media" id="lightbox" aria-label="Pratinjau Foto">
    <img src="" alt="Pratinjau Foto Jeep Wukirsari">
</dialog>

<script src="{{ asset('js/site.js') }}" defer></script>
</body>
</html>
