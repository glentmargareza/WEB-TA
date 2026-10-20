<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        // Summary Metrics
        $metrics = [
            'total_booking' => [
                'label' => 'Total Booking',
                'value' => '124',
                'trend' => '+12%',
                'trend_type' => 'up',
            ],
            'pending_payment' => [
                'label' => 'Menunggu Pembayaran',
                'value' => '8',
                'trend' => '-3%',
                'trend_type' => 'down',
            ],
            'confirmed' => [
                'label' => 'Terkonfirmasi',
                'value' => '102',
                'trend' => '+8%',
                'trend_type' => 'up',
            ],
            'cancelled' => [
                'label' => 'Dibatalkan',
                'value' => '5',
                'trend' => '-2%',
                'trend_type' => 'down',
            ],
        ];

        // Table Data: Booking Terbaru
        $recentBookings = [
            [
                'id'       => 'JW20251112-001',
                'customer' => 'Andi Pratama',
                'package'  => 'Adventure',
                'date'     => '12 Mar 2025',
                'time'     => '08:00 - 09:00',
                'status'   => 'Terkonfirmasi',
                'price'    => 450000,
                'image'    => 'images/kali_gendol.jpeg',
            ],
            [
                'id'       => 'JW20251112-002',
                'customer' => 'Siti Nurhaliza',
                'package'  => 'Lava Tour',
                'date'     => '12 Mar 2025',
                'time'     => '09:00 - 11:00',
                'status'   => 'Pending',
                'price'    => 700000,
                'image'    => 'images/manuver.jpeg',
            ],
            [
                'id'       => 'JW20251111-003',
                'customer' => 'Budi Santoso',
                'package'  => 'Sunrise Tour',
                'date'     => '13 Mar 2025',
                'time'     => '04:00 - 07:30',
                'status'   => 'Terkonfirmasi',
                'price'    => 1200000,
                'image'    => 'images/gerbang_tol.jpeg',
            ],
            [
                'id'       => 'JW20251111-004',
                'customer' => 'Rina Kurnia',
                'package'  => 'Private Trip',
                'date'     => '13 Mar 2025',
                'time'     => '08:00 - 16:00',
                'status'   => 'Pending',
                'price'    => 950000,
                'image'    => 'images/lorong.jpeg',
            ],
            [
                'id'       => 'JW20251111-005',
                'customer' => 'Agus Setiawan',
                'package'  => 'Adventure',
                'date'     => '14 Mar 2025',
                'time'     => '08:00 - 09:30',
                'status'   => 'Terkonfirmasi',
                'price'    => 450000,
                'image'    => 'images/kampung_hilang.jpeg',
            ],
        ];

        // Payment Methods Summary
        $paymentMethods = [
            [
                'name'         => 'Transfer Bank',
                'transactions' => 87,
                'percentage'   => 70,
                'icon'         => 'building-2',
            ],
            [
                'name'         => 'E-Wallet',
                'transactions' => 25,
                'percentage'   => 20,
                'icon'         => 'wallet',
            ],
            [
                'name'         => 'QRIS',
                'transactions' => 8,
                'percentage'   => 6,
                'icon'         => 'qr-code',
            ],
            [
                'name'         => 'COD',
                'transactions' => 4,
                'percentage'   => 3,
                'icon'         => 'banknote',
            ],
        ];

        // Monthly Income
        $monthlyIncome = [
            'amount' => 'Rp 24.850.000',
            'trend'  => '+ 15% dari bulan lalu',
        ];

        return view('admin.dashboard', compact(
            'metrics',
            'recentBookings',
            'paymentMethods',
            'monthlyIncome'
        ));
    }
}
