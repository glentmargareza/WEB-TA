<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran DP paket wisata Jeep Wukirsari.
     * Mengambil data pemesanan dari session (POST) jika ada, atau menggunakan data fallback untuk preview UI.
     */
    public function index(Request $request)
    {
        // Periksa apakah terdapat data booking nyata di session
        $sessionBooking = session('booking_data');
        $isPreview = empty($sessionBooking);

        if (!$isPreview) {
            // Data booking nyata dari formulir pemesanan (tanpa query string GET demi privasi data)
            $totalBiaya = (int) ($sessionBooking['total_biaya'] ?? 550000);
            $dpBiaya = (int) ($sessionBooking['dp_biaya'] ?? round($totalBiaya * 0.3));
            $sisaPelunasan = $totalBiaya - $dpBiaya;

            $bookingData = [
                'is_preview' => false,
                'nama' => $sessionBooking['nama'] ?? '-',
                'telepon' => $sessionBooking['telepon'] ?? '-',
                'email' => $sessionBooking['email'] ?? null,
                'paket' => $sessionBooking['paket_nama'] ?? $sessionBooking['paket'] ?? 'Medium Trip A – Kali Gendol',
                'paket_desc' => $sessionBooking['paket_desc'] ?? 'Manuver Air, Batu Alien, Bunker Kaliadem',
                'tanggal' => $sessionBooking['tanggal'] ?? date('Y-m-d'),
                'tanggal_formatted' => $sessionBooking['tanggal_formatted'] ?? $this->formatTanggalIndo($sessionBooking['tanggal'] ?? date('Y-m-d')),
                'sesi' => $sessionBooking['sesi'] ?? 'Sesi 1 (07:30 - 10:00 WIB)',
                'jumlah_jeep' => (int) ($sessionBooking['jumlah_jeep'] ?? 1),
                'armada_tipe' => 'Jeep Willys 4×4 (' . ($sessionBooking['jumlah_jeep'] ?? 1) . ' Unit)',
                'armada_no' => $sessionBooking['armada_no'] ?? '#WKS-08',
                'titik_kumpul' => $sessionBooking['titik_kumpul'] ?? 'Basecamp Utama Jeep Wukirsari (Jl. Kaliurang Km 21)',
                'lokasi_penjemputan' => $sessionBooking['lokasi_penjemputan'] ?? null,
                'catatan' => $sessionBooking['catatan'] ?? null,
                'total_biaya' => $totalBiaya,
                'dp_biaya' => $dpBiaya,
                'sisa_pelunasan' => $sisaPelunasan,
            ];
        } else {
            // Data fallback khusus pratinjau (Preview UI Mockup Figma)
            $totalBiaya = 550000;
            $dpBiaya = 165000; // 30% dari 550.000
            $sisaPelunasan = 385000;

            $bookingData = [
                'is_preview' => true,
                'nama' => 'Bambang S.',
                'telepon' => '+62 813-6164-5727',
                'email' => null,
                'paket' => 'Medium Trip A – Kali Gendol',
                'paket_desc' => 'Manuver Air, Batu Alien, Bunker Kaliadem',
                'tanggal' => '2026-10-14',
                'tanggal_formatted' => 'Rabu, 14 Okt 2026',
                'sesi' => 'Sesi 1 (07:30 - 10:00 WIB)',
                'jumlah_jeep' => 1,
                'armada_tipe' => 'Jeep Willys 4×4 (1 Unit)',
                'armada_no' => '#WKS-08',
                'titik_kumpul' => 'Basecamp Utama Jeep Wukirsari (Jl. Kaliurang Km 21)',
                'lokasi_penjemputan' => null,
                'catatan' => null,
                'total_biaya' => $totalBiaya,
                'dp_biaya' => $dpBiaya,
                'sisa_pelunasan' => $sisaPelunasan,
            ];
        }

        return view('pembayaran', compact('bookingData'));
    }

    /**
     * Menerima payload booking via POST dan menyimpannya ke session secara aman (bukan via query string).
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'paket' => 'required|string',
            'paket_nama' => 'nullable|string',
            'paket_desc' => 'nullable|string',
            'tanggal' => 'required|date',
            'sesi' => 'required|string',
            'jumlah_jeep' => 'required|integer|min:1|max:50',
            'titik_kumpul' => 'nullable|string|max:150',
            'lokasi_penjemputan' => 'nullable|string|max:255',
            'total_biaya' => 'nullable|numeric',
            'dp_biaya' => 'nullable|numeric',
            'catatan' => 'nullable|string|max:500',
        ]);

        $validated['tanggal_formatted'] = $this->formatTanggalIndo($validated['tanggal']);
        $validated['armada_no'] = '#WKS-' . str_pad((string) rand(1, 15), 2, '0', STR_PAD_LEFT);

        // Hitung nominal jika belum tersedia
        $hargaPerUnit = 550000;
        if (!empty($validated['total_biaya'])) {
            $total = (int) $validated['total_biaya'];
        } else {
            $total = $hargaPerUnit * (int) $validated['jumlah_jeep'];
        }
        $validated['total_biaya'] = $total;
        $validated['dp_biaya'] = round($total * 0.3);

        session(['booking_data' => $validated]);

        return redirect()->route('payment.index');
    }

    /**
     * Menyiapkan data konfirmasi transfer untuk verifikasi manual oleh Admin.
     * Tidak menandai pembayaran otomatis lunas.
     */
    public function confirm(Request $request)
    {
        $sessionBooking = session('booking_data');
        $nama = $sessionBooking['nama'] ?? 'Pelanggan';
        $paket = $sessionBooking['paket_nama'] ?? $sessionBooking['paket'] ?? 'Medium Trip A – Kali Gendol';
        $nominalDp = !empty($sessionBooking['dp_biaya']) 
            ? 'Rp ' . number_format($sessionBooking['dp_biaya'], 0, ',', '.') 
            : 'Rp 165.000';

        $phone = '6281361645727';
        $text = "Halo Admin Jeep Wisata Wukirsari Adventure,\n\n"
              . "Saya sudah melakukan transfer pembayaran DP:\n"
              . "━━━━━━━━━━━━━━━━━━━━━\n"
              . "• Nama Pemesan: {$nama}\n"
              . "• Paket Wisata: {$paket}\n"
              . "• Nominal Transfer DP: {$nominalDp}\n"
              . "• Status: Menunggu Verifikasi Manual Mutasi Bank\n"
              . "━━━━━━━━━━━━━━━━━━━━━\n"
              . "Berikut saya lampirkan struk / bukti transfer saya untuk diverifikasi. Mohon konfirmasi e-tiket resminya. Terima kasih!";

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($text);

        return response()->json([
            'success' => true,
            'status' => 'pending_verification',
            'message' => 'Status: Menunggu Verifikasi Manual oleh Admin. Pembayaran tidak otomatis lunas sebelum mutasi diperiksa.',
            'whatsapp_url' => $whatsappUrl,
        ]);
    }

    /**
     * Helper untuk format tanggal ke format bahasa Indonesia.
     */
    private function formatTanggalIndo($dateString)
    {
        if (!$dateString) return '-';
        $timestamp = strtotime($dateString);
        if (!$timestamp) return $dateString;

        $hariArr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulanArr = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $hari = $hariArr[(int) date('w', $timestamp)];
        $tgl = date('j', $timestamp);
        $bulan = $bulanArr[(int) date('n', $timestamp)];
        $tahun = date('Y', $timestamp);

        return "{$hari}, {$tgl} {$bulan} {$tahun}";
    }
}
