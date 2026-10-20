@extends('layouts.app')

@section('title', $package['name'] . ' | Detail Paket Jeep Wisata Wukirsari')
@section('description', $package['description'] . ' Durasi ' . $package['duration'] . ', ' . $package['capacity'] . ', Rp ' . number_format($package['price'], 0, ',', '.') . ' /paket.')
@section('body_class', 'has-sticky-cta')

@section('content')
@php
    $images = collect($package['gallery'] ?? [$package['image']])
        ->map(fn ($g) => file_exists(public_path($g)) ? $g : 'images/hero.jpeg')
        ->unique()->values();
    $price = number_format($package['price'], 0, ',', '.');
@endphp

<div class="container detail">
    {{-- Tombol Kembali --}}
    <div>
        <a class="back-link" href="{{ route('packages.index') }}">
            <x-icon name="arrow-left" :size="16" /> Kembali
        </a>
    </div>

    {{-- Galeri Foto: Foto Utama & Thumbnail --}}
    <div>
        <div class="detail__stage">
            <img src="{{ asset($images[0]) }}" alt="{{ $package['name'] }}" data-stage fetchpriority="high">
        </div>
        @if($images->count() > 1)
            <div class="thumbs" role="group" aria-label="Galeri foto">
                @foreach($images as $i => $path)
                    <button type="button" class="thumb" data-thumb data-src="{{ asset($path) }}" data-alt="{{ $package['name'] }} foto {{ $i + 1 }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}" aria-label="Foto {{ $i + 1 }}">
                        <img src="{{ asset($path) }}" alt="" loading="lazy">
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Judul, Meta & Harga --}}
    <div class="detail__summary">
        <div>
            <h1 class="detail__title">{{ $package['name'] }}</h1>
            <ul class="meta-list">
                <li><x-icon name="clock" :size="16" /> {{ $package['duration'] }}</li>
                <li><x-icon name="users" :size="16" /> {{ $package['capacity'] }}</li>
                <li><x-icon name="map-pin" :size="16" /> {{ $package['location'] }}</li>
            </ul>
        </div>
        <div class="detail__buy">
            <div class="price">Rp {{ $price }} <small>/paket</small></div>
            <button type="button" class="btn btn--primary" data-booking="{{ $package['slug'] }}">
                Booking Sekarang <x-icon name="arrow-right" :size="18" />
            </button>
        </div>
    </div>

    {{-- Deskripsi Pembuka --}}
    <p class="prose">{{ $package['description'] }}</p>

    {{-- Fasilitas yang Didapat --}}
    <section class="panel" aria-labelledby="fasilitas-title">
        <h2 class="panel__title" id="fasilitas-title">
            <x-icon name="shield-check" :size="22" /> Fasilitas yang Didapat
        </h2>
        <ul class="facility-list">
            @foreach($facilities as $item)
                <li>
                    <x-icon name="circle-check" :size="18" />
                    <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- Tab Info: Deskripsi, Itinerary, Ketentuan --}}
    <section class="panel" data-tabs>
        <div class="tabs__list" role="tablist" aria-label="Informasi Detail Paket">
            <button class="tabs__tab" role="tab" id="tab-deskripsi" aria-controls="panel-deskripsi" aria-selected="true">Deskripsi</button>
            <button class="tabs__tab" role="tab" id="tab-itinerary" aria-controls="panel-itinerary" aria-selected="false" tabindex="-1">Itinerary</button>
            <button class="tabs__tab" role="tab" id="tab-ketentuan" aria-controls="panel-ketentuan" aria-selected="false" tabindex="-1">Ketentuan</button>
        </div>

        <div class="tabs__panel" role="tabpanel" id="panel-deskripsi" aria-labelledby="tab-deskripsi">
            <p class="prose">{{ $package['detail_desc'] ?? $package['description'] }}</p>
        </div>

        <div class="tabs__panel" role="tabpanel" id="panel-itinerary" aria-labelledby="tab-itinerary" hidden>
            <ol class="steps">
                @foreach($package['itinerary'] as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ol>
        </div>

        <div class="tabs__panel" role="tabpanel" id="panel-ketentuan" aria-labelledby="tab-ketentuan" hidden>
            <ul class="rules">
                @foreach(($package['ketentuan'] ?? []) as $rule)
                    <li>
                        <x-icon name="circle-check" :size="18" />
                        <span>{{ $rule }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Banner Penutup dengan Kutipan Script --}}
    <aside class="banner">
        <div>
            <p class="script banner__quote">Jelajahi keindahan alam bersama kami, Jeep Wukirsari!</p>
        </div>
        <a class="btn btn--outline" href="{{ route('packages.index') }}">
            Lihat Paket Lain <x-icon name="arrow-right" :size="16" />
        </a>
    </aside>
</div>

{{-- Sticky CTA Bar pada layar HP --}}
<div class="sticky-cta">
    <div class="price">Rp {{ $price }} <small>/paket</small></div>
    <button type="button" class="btn btn--primary" data-booking="{{ $package['slug'] }}">
        Booking Sekarang <x-icon name="arrow-right" :size="18" />
    </button>
</div>
@endsection
