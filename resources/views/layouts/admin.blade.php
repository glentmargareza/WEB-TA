<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Jeep Wisata Wukirsari</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Admin Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand-icon">
                    <x-icon name="car-front" :size="20" />
                </div>
                <div class="sidebar-brand-text">
                    <span class="sidebar-brand-name">Jeep Wisata Wukirsari</span>
                    <span class="sidebar-brand-sub">Admin Panel</span>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <x-icon name="layout-dashboard" :size="18" />
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking') }}" class="sidebar-link {{ request()->routeIs('admin.booking') && !request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <x-icon name="calendar" :size="18" />
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pembayaran') }}" class="sidebar-link {{ request()->routeIs('admin.pembayaran') ? 'active' : '' }}">
                        <x-icon name="wallet" :size="18" />
                        <span>Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jeep-driver') }}" class="sidebar-link {{ request()->routeIs('admin.jeep-driver') ? 'active' : '' }}">
                        <x-icon name="car-front" :size="18" />
                        <span>Jeep & Driver</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.paket-wisata') }}" class="sidebar-link {{ request()->routeIs('admin.paket-wisata') ? 'active' : '' }}">
                        <x-icon name="ticket" :size="18" />
                        <span>Paket Wisata</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pelanggan') }}" class="sidebar-link {{ request()->routeIs('admin.pelanggan') ? 'active' : '' }}">
                        <x-icon name="users" :size="18" />
                        <span>Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan') }}" class="sidebar-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                        <x-icon name="bar-chart" :size="18" />
                        <span>Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengaturan') }}" class="sidebar-link {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}">
                        <x-icon name="settings" :size="18" />
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="sidebar-bg-art" style="background-image: url('{{ asset('images/volcano.png') }}');"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn">
                        <x-icon name="log-out" :size="16" />
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="admin-main">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="topbar-left">
                    <button type="button" class="topbar-toggle-btn" id="menuToggle" aria-label="Toggle menu">
                        <x-icon name="menu" :size="22" />
                    </button>

                    <div class="topbar-search">
                        <span class="topbar-search-icon">
                            <x-icon name="search" :size="16" />
                        </span>
                        <input type="text" placeholder="Cari menu, booking, atau pelanggan...">
                    </div>
                </div>

                <div class="topbar-right">
                    <a href="{{ route('home') }}" target="_blank" class="topbar-icon-btn" title="Kunjungi Website Publik">
                        <x-icon name="route" :size="18" />
                    </a>

                    <button type="button" class="topbar-icon-btn" aria-label="Notifikasi">
                        <x-icon name="bell" :size="18" />
                        <span class="topbar-badge-dot"></span>
                    </button>

                    <div class="topbar-user">
                        <div class="user-avatar-placeholder">
                            {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                            <span class="user-role">{{ ucfirst(auth()->user()->role ?? 'Super Admin') }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const adminSidebar = document.getElementById('adminSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (menuToggle && adminSidebar && sidebarOverlay) {
            menuToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('open');
            });

            sidebarOverlay.addEventListener('click', () => {
                adminSidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
