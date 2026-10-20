@extends('layouts.app')

@section('title', 'Katalog Paket Wisata Jeep Wukirsari | Adventure, Lava Tour, Sunrise')
@section('description', 'Pilih paket perjalanan jeep offroad yang sesuai dengan keinginanmu di Wukirsari, Cangkringan, Sleman, Yogyakarta.')

@section('content')
{{-- Hero Banner Halaman Katalog --}}
<section class="hero hero--page">
    <div class="hero__media">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Jeep Wisata Wukirsari" fetchpriority="high">
    </div>
    <div class="container hero__content">
        <h1 class="hero__title">Paket Wisata</h1>
        <p class="hero__lead">Pilih paket perjalanan yang sesuai dengan keinginanmu.</p>
    </div>
</section>

{{-- Filter & Grid Paket --}}
<section class="section">
    <div class="container">
        <div class="filter" role="search">
            <div class="filter__chips" role="group" aria-label="Filter kategori paket">
                <button type="button" class="chip" data-filter="all" aria-pressed="true">Semua</button>
                <button type="button" class="chip" data-filter="adventure" aria-pressed="false">Adventure</button>
                <button type="button" class="chip" data-filter="lava-tour" aria-pressed="false">Lava Tour</button>
                <button type="button" class="chip" data-filter="sunrise-tour" aria-pressed="false">Sunrise Tour</button>
                <button type="button" class="chip" data-filter="private-trip" aria-pressed="false">Private Trip</button>
            </div>
            <label class="search">
                <x-icon name="search" :size="18" />
                <span class="sr-only">Cari paket wisata</span>
                <input type="search" data-search placeholder="Cari paket wisata..." autocomplete="off">
            </label>
        </div>

        <div class="section-head">
            <div>
                <h2 class="section-title">Paket Wisata Populer</h2>
            </div>
            <span class="link-arrow" style="cursor: default;">
                Lihat Semua <x-icon name="arrow-right" :size="16" />
            </span>
        </div>

        <div class="packages-grid" data-package-grid>
            @foreach($packages as $i => $pkg)
                <x-package-card :pkg="$pkg" :index="$i" :show-book="false" />
            @endforeach
        </div>

        <div class="empty" data-empty hidden>
            <x-icon name="search" :size="32" />
            <p style="font-size: var(--text-base); font-weight: 600;">Paket tidak ditemukan</p>
            <p style="font-size: var(--text-sm);">Coba gunakan kata kunci pencarian yang lain atau reset filter.</p>
            <button type="button" class="btn btn--outline" data-filter="all" data-reset-search style="margin-top: var(--space-2);">
                Tampilkan Semua Paket
            </button>
        </div>
    </div>
</section>
@endsection
