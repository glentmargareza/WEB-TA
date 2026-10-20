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
<body class="@yield('body_class')">

@php
    $brand   = config('jeep.brand');
    $contact = config('jeep.contact');
    $social  = config('jeep.social');
    $wa      = preg_replace('/\D/', '', (string) ($contact['whatsapp'] ?? ''));
@endphp

<a class="skip-link" href="#main">Lewati ke konten</a>

<header class="site-header">
    <div class="container site-header__inner">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $brand['name'] }}, Beranda">
            <img class="brand__logo" src="{{ asset('images/logo.png') }}" alt="Logo {{ $brand['name'] }}" width="44" height="44">
            <span>
                <span class="brand__name">{{ $brand['name'] }}</span>
                <span class="brand__tag">{{ $brand['tagline'] }}</span>
            </span>
        </a>

        <nav id="site-nav" class="nav" aria-label="Navigasi Utama">
            <ul class="nav__list">
                <li><a class="nav__link" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Beranda</a></li>
                <li><a class="nav__link" href="{{ route('packages.index') }}" @if(request()->routeIs('packages.*')) aria-current="page" @endif>Paket Wisata</a></li>
                <li><a class="nav__link" href="{{ route('home') }}#tentang">Tentang Kami</a></li>
                <li><a class="nav__link" href="{{ route('home') }}#galeri">Galeri</a></li>
                <li><a class="nav__link" href="{{ route('home') }}#kontak">Kontak</a></li>
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a class="nav__link" href="{{ route('admin.dashboard') }}" style="color: var(--color-primary-600); font-weight: 700;">Admin Panel</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav__link" style="background:none; border:none; cursor:pointer; font-family:inherit;">Keluar</button>
                        </form>
                    </li>
                @else
                    <li><a class="nav__link" href="{{ route('login') }}">Masuk</a></li>
                @endauth
            </ul>
            <button type="button" class="btn btn--primary btn--block nav__cta" data-booking>
                <x-icon name="calendar-check" :size="18" /> Booking Sekarang
            </button>
        </nav>

        <div class="site-header__actions">
            <a href="{{ route('packages.index') }}" class="header-search-btn" aria-label="Cari paket wisata">
                <x-icon name="search" :size="20" />
            </a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn--secondary" style="padding: 9px 14px; font-size: 13px;">
                        <x-icon name="layout-dashboard" :size="16" /> Admin Panel
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn--ghost" style="padding: 9px 14px; font-size: 13px;" title="Keluar">
                        <x-icon name="log-out" :size="16" />
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn--ghost" style="padding: 9px 14px; font-size: 13px;">
                    Masuk
                </a>
            @endauth
            <button type="button" class="btn btn--primary header-cta" data-booking>
                <x-icon name="calendar-check" :size="18" /> Booking Sekarang <x-icon name="arrow-right" :size="14" />
            </button>
            <button type="button" class="nav-toggle" data-nav-toggle aria-expanded="false" aria-controls="site-nav" aria-label="Buka menu">
                <x-icon name="menu" :size="24" class="icon--open" />
                <x-icon name="x" :size="24" class="icon--close" />
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

            <div>
                <h2 class="footer__title">Kontak Kami</h2>
                <ul class="footer__list">
                    @if($wa !== '')
                        <li><x-icon name="phone" :size="16" /><a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener">{{ $contact['phone'] }}</a></li>
                    @endif
                    @if(!empty($contact['email']))
                        <li><x-icon name="mail" :size="16" /><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></li>
                    @endif
                    <li><x-icon name="map-pin" :size="16" /><span>{{ $contact['address'] }}</span></li>
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

            <div class="field">
                <label class="field__label" for="booking-jeeps">Jumlah Armada Jeep (Maks. 4 orang / jeep)</label>
                <select class="field__control" id="booking-jeeps" name="jeeps" required>
                    @foreach([1, 2, 3, 4, 5] as $n)
                        <option value="{{ $n }}" @selected((int) old('jeeps', 1) === $n)>{{ $n }} Jeep ({{ ($n - 1) * 4 + 1 }} - {{ $n * 4 }} orang)</option>
                    @endforeach
                    <option value="6" @selected((int) old('jeeps') === 6)>Lebih dari 5 Jeep (Rombongan Besar)</option>
                </select>
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
