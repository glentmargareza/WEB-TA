@props(['pkg', 'showBook' => false, 'index' => 0])

@php
    $img = file_exists(public_path($pkg['image'])) ? $pkg['image'] : 'images/hero.jpeg';
    $price = number_format($pkg['price'], 0, ',', '.');
@endphp

<article class="package-card reveal reveal-d{{ min($index, 5) }}"
         data-category="{{ $pkg['category'] }}"
         data-name="{{ \Illuminate\Support\Str::lower($pkg['name']) }}">
    <a class="package-card__media" href="{{ route('packages.show', $pkg['slug']) }}" tabindex="-1" aria-hidden="true">
        <img src="{{ asset($img) }}" alt="{{ $pkg['name'] }}" loading="lazy" width="640" height="480">
        @if($pkg['popular'] ?? false)
            <span class="badge">Paling Populer</span>
        @endif
    </a>
    <div class="package-card__body">
        <h3 class="package-card__title">
            <a href="{{ route('packages.show', $pkg['slug']) }}">{{ $pkg['name'] }}</a>
        </h3>
        @if($showBook && !empty($pkg['summary']))
            <p class="package-card__summary">{{ $pkg['summary'] }}</p>
        @endif
        <ul class="package-card__meta">
            <li><x-icon name="clock" :size="15" /> {{ $pkg['duration'] }}</li>
            <li><x-icon name="users" :size="15" /> {{ $pkg['capacity'] }}</li>
            @if(!empty($pkg['location']))
                <li><x-icon name="map-pin" :size="15" /> {{ $pkg['location'] }}</li>
            @endif
        </ul>
        <div class="package-card__foot">
            <div class="price">
                Rp {{ $price }}
                <small>{{ $showBook ? '/ Jeep' : '/paket' }}</small>
            </div>
            <div class="package-card__actions">
                <a class="btn btn--outline {{ $showBook ? 'btn--sm' : '' }}" href="{{ route('packages.show', $pkg['slug']) }}">
                    Lihat Detail <x-icon name="arrow-right" :size="15" />
                </a>
                @if($showBook)
                    <button type="button" class="btn btn--primary btn--sm" data-booking="{{ $pkg['slug'] }}">
                        Booking Sekarang
                    </button>
                @endif
            </div>
        </div>
    </div>
</article>
