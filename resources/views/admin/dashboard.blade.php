@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-grid">
    <!-- Center Column -->
    <div class="dashboard-center">
        <!-- 1. Welcome Greeting Banner -->
        <div class="welcome-banner">
            <div class="welcome-art" style="background-image: url('{{ asset('images/volcano.png') }}');"></div>
            <div class="welcome-avatar-wrapper">
                <div class="avatar-inner">
                    {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                </div>
            </div>
            <div class="welcome-text">
                <div class="welcome-subtitle">Selamat Datang,</div>
                <h1 class="welcome-title">{{ auth()->user()->name ?? 'Admin' }} 👋</h1>
                <p class="welcome-desc">Kelola semua aktivitas wisata Jeep Wukirsari dengan mudah.</p>
            </div>
        </div>

        <!-- 2. Metric KPI Cards -->
        <div class="metrics-row">
            <!-- Card 1: Total Booking -->
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon-wrap green">
                        <x-icon name="calendar" :size="18" />
                    </div>
                    <span class="metric-label">Total Booking</span>
                </div>
                <div class="metric-bottom">
                    <span class="metric-value">{{ $metrics['total_booking']['value'] }}</span>
                    <div class="metric-trend">
                        <span class="trend-badge up">
                            <x-icon name="trending-up" :size="12" /> {{ $metrics['total_booking']['trend'] }}
                        </span>
                        <svg class="sparkline-svg" viewBox="0 0 50 20">
                            <path d="M0,15 Q15,18 25,8 T50,4" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 2: Menunggu Pembayaran -->
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon-wrap orange">
                        <x-icon name="clock" :size="18" />
                    </div>
                    <span class="metric-label">Menunggu Pembayaran</span>
                </div>
                <div class="metric-bottom">
                    <span class="metric-value">{{ $metrics['pending_payment']['value'] }}</span>
                    <div class="metric-trend">
                        <span class="trend-badge down">
                            <x-icon name="trending-down" :size="12" /> {{ $metrics['pending_payment']['trend'] }}
                        </span>
                        <svg class="sparkline-svg" viewBox="0 0 50 20">
                            <path d="M0,5 Q15,8 25,14 T50,16" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3: Terkonfirmasi -->
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon-wrap teal">
                        <x-icon name="circle-check" :size="18" />
                    </div>
                    <span class="metric-label">Terkonfirmasi</span>
                </div>
                <div class="metric-bottom">
                    <span class="metric-value">{{ $metrics['confirmed']['value'] }}</span>
                    <div class="metric-trend">
                        <span class="trend-badge up">
                            <x-icon name="trending-up" :size="12" /> {{ $metrics['confirmed']['trend'] }}
                        </span>
                        <svg class="sparkline-svg" viewBox="0 0 50 20">
                            <path d="M0,16 Q15,14 28,9 T50,3" fill="none" stroke="#10B981" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 4: Dibatalkan -->
            <div class="metric-card">
                <div class="metric-header">
                    <div class="metric-icon-wrap red">
                        <x-icon name="users" :size="18" />
                    </div>
                    <span class="metric-label">Dibatalkan</span>
                </div>
                <div class="metric-bottom">
                    <span class="metric-value">{{ $metrics['cancelled']['value'] }}</span>
                    <div class="metric-trend">
                        <span class="trend-badge down">
                            <x-icon name="trending-down" :size="12" /> {{ $metrics['cancelled']['trend'] }}
                        </span>
                        <svg class="sparkline-svg" viewBox="0 0 50 20">
                            <path d="M0,8 Q15,10 25,14 T50,18" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Chart: Statistik Booking -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Statistik Booking</h2>
                <div class="card-filter-select">
                    <x-icon name="calendar" :size="14" />
                    <span>1 - 31 Mar 2025</span>
                    <x-icon name="chevron-down" :size="14" />
                </div>
            </div>

            <div class="chart-wrapper">
                <svg class="chart-svg" viewBox="0 0 700 200" preserveAspectRatio="none">
                    <defs>
                        <!-- Gradients for Area Fills -->
                        <linearGradient id="gradConfirmed" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#10B981" stop-opacity="0.25"/>
                            <stop offset="100%" stop-color="#10B981" stop-opacity="0.0"/>
                        </linearGradient>
                        <linearGradient id="gradPending" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#F59E0B" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#F59E0B" stop-opacity="0.0"/>
                        </linearGradient>
                        <linearGradient id="gradCancelled" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#EF4444" stop-opacity="0.15"/>
                            <stop offset="100%" stop-color="#EF4444" stop-opacity="0.0"/>
                        </linearGradient>
                    </defs>

                    <!-- Horizontal Gridlines & Values -->
                    <g stroke="#E8ECE6" stroke-dasharray="3,3" stroke-width="1">
                        <line x1="35" y1="20" x2="690" y2="20" />
                        <line x1="35" y1="60" x2="690" y2="60" />
                        <line x1="35" y1="100" x2="690" y2="100" />
                        <line x1="35" y1="140" x2="690" y2="140" />
                        <line x1="35" y1="180" x2="690" y2="180" />
                    </g>

                    <!-- Y-Axis Labels -->
                    <g fill="#94A3B8" font-size="10" font-family="'Plus Jakarta Sans', sans-serif" text-anchor="end">
                        <text x="25" y="24">100</text>
                        <text x="25" y="64">75</text>
                        <text x="25" y="104">50</text>
                        <text x="25" y="144">25</text>
                        <text x="25" y="184">0</text>
                    </g>

                    <!-- Cancelled Area & Line (Red) -->
                    <path d="M 40,175 C 95,170 150,165 205,160 C 260,158 315,162 370,165 C 425,168 480,162 535,160 C 590,158 645,155 690,152 L 690,180 L 40,180 Z" fill="url(#gradCancelled)"/>
                    <path d="M 40,175 C 95,170 150,165 205,160 C 260,158 315,162 370,165 C 425,168 480,162 535,160 C 590,158 645,155 690,152" fill="none" stroke="#EF4444" stroke-width="2"/>

                    <!-- Pending Area & Line (Orange) -->
                    <path d="M 40,160 C 95,150 150,135 205,130 C 260,128 315,135 370,130 C 425,125 480,122 535,115 C 590,105 645,95 690,88 L 690,180 L 40,180 Z" fill="url(#gradPending)"/>
                    <path d="M 40,160 C 95,150 150,135 205,130 C 260,128 315,135 370,130 C 425,125 480,122 535,115 C 590,105 645,95 690,88" fill="none" stroke="#F59E0B" stroke-width="2"/>

                    <!-- Confirmed Area & Line (Green) -->
                    <path d="M 40,140 C 95,120 150,90 205,100 C 260,110 315,85 370,65 C 425,75 480,70 535,55 C 590,40 645,30 690,20 L 690,180 L 40,180 Z" fill="url(#gradConfirmed)"/>
                    <path d="M 40,140 C 95,120 150,90 205,100 C 260,110 315,85 370,65 C 425,75 480,70 535,55 C 590,40 645,30 690,20" fill="none" stroke="#10B981" stroke-width="2.5"/>
                    <circle cx="690" cy="20" r="4" fill="#10B981" stroke="#FFFFFF" stroke-width="2"/>

                    <!-- X-Axis Months Labels -->
                    <g fill="#94A3B8" font-size="10" font-family="'Plus Jakarta Sans', sans-serif" text-anchor="middle">
                        <text x="40" y="196">Jan</text>
                        <text x="100" y="196">Feb</text>
                        <text x="160" y="196">Mar</text>
                        <text x="220" y="196">Apr</text>
                        <text x="280" y="196">Mei</text>
                        <text x="340" y="196">Jun</text>
                        <text x="400" y="196">Jul</text>
                        <text x="460" y="196">Agu</text>
                        <text x="520" y="196">Sep</text>
                        <text x="580" y="196">Okt</text>
                        <text x="640" y="196">Nov</text>
                        <text x="690" y="196">Des</text>
                    </g>
                </svg>
            </div>

            <div class="chart-legend">
                <div class="legend-item">
                    <span class="legend-dot green"></span>
                    <span>Terkonfirmasi</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot orange"></span>
                    <span>Pending</span>
                </div>
                <div class="legend-item">
                    <span class="legend-dot red"></span>
                    <span>Dibatalkan</span>
                </div>
            </div>
        </div>

        <!-- 4. Table: Booking Terbaru -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Booking Terbaru</h2>
                <a href="{{ route('admin.booking') }}" class="card-header-link">
                    <span>Lihat Semua</span>
                    <x-icon name="arrow-right" :size="14" />
                </a>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No. Booking</th>
                            <th>Nama</th>
                            <th>Paket Wisata</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $b)
                            <tr>
                                <td>
                                    <span class="booking-code">{{ $b['id'] }}</span>
                                </td>
                                <td>
                                    <span class="customer-name">{{ $b['customer'] }}</span>
                                </td>
                                <td>{{ $b['package'] }}</td>
                                <td>{{ $b['date'] }}</td>
                                <td>
                                    <span class="status-badge {{ strtolower($b['status']) }}">
                                        {{ $b['status'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-detail">Detail</button>
                                        <button type="button" class="btn-more" aria-label="Opsi">
                                            <x-icon name="more-vertical" :size="16" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span>Menampilkan 1 - 5 dari 124 data</span>
                <div class="pagination">
                    <button class="page-btn" aria-label="Sebelumnya">&lsaquo;</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn">5</button>
                    <button class="page-btn" aria-label="Berikutnya">&rsaquo;</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column (Widgets) -->
    <div class="dashboard-right">
        <!-- Widget 1: Booking Terbaru Cards List -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Booking Terbaru</h2>
                <a href="{{ route('admin.booking') }}" class="card-header-link">
                    <span>Lihat Semua</span>
                    <x-icon name="arrow-right" :size="14" />
                </a>
            </div>

            <div class="recent-bookings-list">
                @foreach($recentBookings as $item)
                    <div class="booking-item-card">
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['package'] }}" class="booking-thumb">
                        <div class="booking-item-info">
                            <span class="booking-item-id">{{ $item['id'] }}</span>
                            <div class="booking-item-pkg">{{ $item['package'] }}</div>
                            <div class="booking-item-time">
                                <x-icon name="calendar" :size="12" />
                                <span>{{ $item['date'] }} • {{ $item['time'] }}</span>
                            </div>
                        </div>
                        <div class="booking-item-meta">
                            <span class="status-badge {{ strtolower($item['status']) }}">
                                {{ $item['status'] }}
                            </span>
                            <span class="booking-item-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Widget 2: Metode Pembayaran -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Metode Pembayaran</h2>
                <a href="{{ route('admin.pembayaran') }}" class="card-header-link">
                    <span>Lihat Semua</span>
                    <x-icon name="arrow-right" :size="14" />
                </a>
            </div>

            <div class="payment-methods-list">
                @foreach($paymentMethods as $pm)
                    <div class="payment-method-row">
                        <div class="payment-icon">
                            <x-icon :name="$pm['icon']" :size="16" />
                        </div>
                        <div class="payment-info">
                            <div class="payment-title-row">
                                <span class="payment-name">{{ $pm['name'] }}</span>
                                <span class="payment-count">{{ $pm['transactions'] }} transaksi</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width: {{ $pm['percentage'] }}%;"></div>
                            </div>
                        </div>
                        <div class="payment-percent">{{ $pm['percentage'] }}%</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Widget 3: Pendapatan Bulan Ini -->
        <div class="income-card">
            <div class="card-header" style="margin-bottom: 6px;">
                <h2 class="card-title" style="font-size: 14px;">Pendapatan (Bulan Ini)</h2>
                <a href="{{ route('admin.laporan') }}" class="card-header-link" style="font-size: 11.5px;">
                    <span>Lihat Detail</span>
                    <x-icon name="arrow-right" :size="12" />
                </a>
            </div>

            <div class="income-content">
                <div class="income-left">
                    <div class="income-icon-wrap">
                        <x-icon name="coins" :size="20" />
                    </div>
                    <div>
                        <span class="income-amount">{{ $monthlyIncome['amount'] }}</span>
                        <span class="income-sub">{{ $monthlyIncome['trend'] }}</span>
                    </div>
                </div>
                <div class="income-sparkline">
                    <svg viewBox="0 0 70 30" width="70" height="30">
                        <defs>
                            <linearGradient id="incomeGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" stop-color="#10B981" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#10B981" stop-opacity="0.0"/>
                            </linearGradient>
                        </defs>
                        <path d="M0,25 Q15,28 30,18 T70,5 L70,30 L0,30 Z" fill="url(#incomeGrad)"/>
                        <path d="M0,25 Q15,28 30,18 T70,5" fill="none" stroke="#10B981" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
