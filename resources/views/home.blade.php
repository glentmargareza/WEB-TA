@extends('layouts.app')

@section('title', 'Jeep Wisata Wukirsari Adventure Tour | Jelajahi Keindahan Alam Merapi')
@section('description', 'Rasakan petualangan seru menyusuri jalur lava, menikmati panorama Merapi, dan menciptakan cerita perjalanan yang tak terlupakan bersama Jeep Wukirsari.')

@section('content')
@php
    $features = [
        ['car-front',    'Jeep 4x4',             'Siap di segala medan'],
        ['user-check',   'Driver Berpengalaman', 'Pemandu profesional'],
        ['shield-check', 'Fasilitas Lengkap',    'Aman dan nyaman'],
        ['map-pin',      'Lokasi Strategis',     'Dekat Gunung Merapi'],
    ];

    $whyItems = [
        ['shield-check',   'Harga Transparan',  'Tanpa biaya tersembunyi'],
        ['headset',        'Pelayanan Ramah',   'Siap membantu 24 jam'],
        ['route',          'Jalur Aman',        'Dipilih sesuai kondisi'],
        ['star',           'Pengalaman Terbaik', 'Banyak review positif'],
    ];
@endphp

{{-- ========================================================================
     1. HERO SECTION
     ======================================================================== --}}
<section class="hero" id="beranda">
    <div class="hero__media">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Jeep Wisata Wukirsari di Lereng Gunung Merapi" fetchpriority="high">
    </div>
    <div class="container hero__content">
        <p class="script hero__eyebrow">
            <x-icon name="map-pin" :size="20" /> Petualangan di Lereng Merapi
        </p>
        <h1 class="hero__title">Jelajahi Keindahan Alam Merapi Bersama Jeep Wukirsari</h1>
        <p class="hero__lead">Rasakan petualangan seru menyusuri jalur lava, menikmati panorama Merapi, dan menciptakan cerita perjalanan yang tak terlupakan.</p>
        
        <div class="hero__actions">
            <button type="button" class="btn btn--primary" data-booking>
                Booking Sekarang <x-icon name="arrow-right" :size="18" />
            </button>
            <a class="btn btn--ghost" href="{{ route('packages.index') }}">
                Jelajahi Paket
            </a>
        </div>

        <div class="hero__bottom-bar">
            <div class="hero__slider-nav" aria-label="Slider indikator">
                <span class="active">01</span>
                <span>02</span>
                <span>03</span>
                <span>04</span>
                <span>05</span>
                <button type="button" aria-label="Sebelumnya"><x-icon name="arrow-left" :size="14" /></button>
                <button type="button" aria-label="Selanjutnya"><x-icon name="arrow-right" :size="14" /></button>
            </div>
            <div class="hero__loc">
                <x-icon name="map-pin" :size="15" /> Wukirsari, Sleman, Yogyakarta
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================
     2. FEATURE STRIP (4 POIN)
     ======================================================================== --}}
<section class="strip" aria-label="Keunggulan Layanan">
    <div class="container">
        <ul class="strip__list">
            @foreach($features as [$icon, $title, $desc])
                <li class="strip__item">
                    <span class="icon-circle"><x-icon :name="$icon" :size="24" /></span>
                    <div>
                        <strong class="strip__title">{{ $title }}</strong>
                        <span class="strip__desc">{{ $desc }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- ========================================================================
     3. PAKET WISATA POPULER
     ======================================================================== --}}
<section class="section" id="paket-populer">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">PAKET WISATA</span>
                <h2 class="section-title">Paket Wisata Populer</h2>
                <p class="section-desc">Pilihan terbaik untuk pengalaman tak terlupakan di setiap perjalanan.</p>
            </div>
            <a class="link-arrow" href="{{ route('packages.index') }}">
                Lihat Semua <x-icon name="arrow-right" :size="16" />
            </a>
        </div>

        <div class="packages-grid">
            @foreach($popularPackages as $i => $pkg)
                <x-package-card :pkg="$pkg" :index="$i" :show-book="true" />
            @endforeach
        </div>
    </div>
</section>

{{-- ========================================================================
     4. MENGAPA MEMILIH JEEP WUKIRSARI?
     ======================================================================== --}}
<section class="section section--flush-top" id="tentang">
    <div class="container">
        <div class="why reveal">
            <div>
                <p class="script" style="color: var(--color-on-dark-muted);">Mengapa Memilih</p>
                <h2 class="why__title">Jeep Wukirsari?</h2>
                <p class="why__text">Kami berkomitmen memberikan pengalaman terbaik untuk setiap perjalanan Anda. Dengan pelayanan profesional, fasilitas lengkap dan rute yang aman, liburan Anda akan menjadi lebih berkesan.</p>
                <a href="#kontak" class="btn btn--white btn--pill">
                    Tentang Kami <x-icon name="arrow-right" :size="16" />
                </a>
            </div>

            <div class="why__grid">
                @foreach($whyItems as [$icon, $title, $desc])
                    <div class="why__card">
                        <span class="icon-circle"><x-icon :name="$icon" :size="20" /></span>
                        <strong>{{ $title }}</strong>
                        <span>{{ $desc }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================
     5. GALERI: JELAJAHI MOMEN INDAH BERSAMA KAMI
     ======================================================================== --}}
@if($gallery->isNotEmpty())
<section class="section section--flush-top" id="galeri">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">GALERI</span>
                <h2 class="section-title">Jelajahi Momen Indah Bersama Kami</h2>
                <p class="section-desc">Kumpulan foto perjalanan seru di berbagai rute wisata.</p>
            </div>
            <a class="link-arrow" href="{{ route('packages.index') }}">
                Lihat Semua Galeri <x-icon name="arrow-right" :size="16" />
            </a>
        </div>

        <div class="gallery">
            @foreach($gallery->take(5) as $i => $img)
                <button type="button" class="gallery__item reveal reveal-d{{ $i + 1 }}" data-lightbox="{{ asset($img) }}" aria-label="Perbesar foto {{ $i + 1 }}">
                    <img src="{{ asset($img) }}" alt="Dokumentasi Tour Jeep Merapi {{ $i + 1 }}" loading="lazy">
                </button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ========================================================================
     6. TESTIMONI: APA KATA MEREKA?
     ======================================================================== --}}
@if($testimonials->isNotEmpty())
<section class="section section--flush-top" id="testimoni">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">TESTIMONI</span>
                <h2 class="section-title">Apa Kata Mereka?</h2>
                <p class="section-desc">Pengalaman nyata dari pelanggan yang sudah merasakan keseruannya.</p>
            </div>
            <div style="display: flex; gap: var(--space-2);">
                <button type="button" class="header-search-btn" aria-label="Testimoni sebelumnya" style="border: 1px solid var(--color-border);"><x-icon name="arrow-left" :size="16" /></button>
                <button type="button" class="header-search-btn" aria-label="Testimoni berikutnya" style="border: 1px solid var(--color-border);"><x-icon name="arrow-right" :size="16" /></button>
            </div>
        </div>

        <div class="testi-grid">
            @foreach($testimonials as $i => $t)
                <article class="testi reveal reveal-d{{ $i + 1 }}">
                    <div class="testi__header">
                        <div class="testi__avatar">
                            {{ substr($t['name'], 0, 1) }}
                        </div>
                        <div>
                            <h3 class="testi__name">{{ $t['name'] }}</h3>
                            <p class="testi__city">{{ $t['city'] }}</p>
                        </div>
                    </div>
                    <p class="testi__text">"{{ $t['text'] }}"</p>
                    <div class="testi__stars" aria-label="Rating {{ $t['rating'] }} dari 5">
                        @for($s = 0; $s < ($t['rating'] ?? 5); $s++)
                            <x-icon name="star" :size="16" />
                        @endfor
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
