<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display the main landing page with tour packages and destinations.
     */
    /**
     * Get tour packages definition.
     */
    protected function getPackages()
    {
        return [
            [
                'id' => 'short-trip',
                'category' => 'short',
                'name' => 'Short Trip Offroad',
                'badge' => 'POPULER',
                'badge_class' => 'badge-orange',
                'duration' => '1.5 - 2 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '450.000',
                'price_raw' => 450000,
                'image' => asset('images/1.jpeg'),
                'features' => [
                    'Susur Kali Gendol',
                    'Museum Kampung Hilang',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Manuver Air',
                ],
                'note' => 'Cocok untuk keluarga & pemula yang ingin sensasi offroad santai namun tetap menantang.',
            ],
            [
                'id' => 'medium-trip-a',
                'category' => 'medium',
                'name' => 'Medium Trip (A)',
                'badge' => 'TERPOPULER',
                'badge_class' => 'badge-emerald',
                'duration' => '2 - 2.5 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '550.000',
                'price_raw' => 550000,
                'image' => asset('images/2.jpeg'),
                'features' => [
                    'Volcano Park',
                    'Susur Sungai kali Gendol',
                    'Museum Kampung Hilang',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Manuver Air Basah',
                ],
                'note' => 'Pilihan terfavorit dengan kombinasi alam, adrenalin susur kali, dan situs budaya.',
            ],
            [
                'id' => 'medium-trip-b',
                'category' => 'medium',
                'name' => 'Medium Trip (B)',
                'badge' => 'BEST VALUE',
                'badge_class' => 'badge-emerald',
                'duration' => '2 - 2.5 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '550.000',
                'price_raw' => 550000,
                'image' => asset('images/3.jpeg'),
                'features' => [
                    'Susur Sungai kali Gendol',
                    'Selo Maruto Wow',
                    'Museum Kampung Hilang',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Manuver Air',
                ],
                'note' => 'Pilihan terfavorit dengan kombinasi alam, adrenalin susur kali, dan situs budaya.',
            ],
            [
                'id' => 'long-trip',
                'category' => 'long',
                'name' => 'Long Trip Adventure',
                'badge' => 'LENGKAP',
                'badge_class' => 'badge-orange',
                'duration' => '2.5 - 3 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '650.000',
                'price_raw' => 650000,
                'image' => asset('images/4.jpeg'),
                'features' => [
                    'Susur Sungai Watugede',
                    'Volcano Park',
                    'Susur Sungai kali Gendol',
                    'Museum Kampung Hilang',
                    'Selo Maruto',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Manuver Air',
                ],
                'note' => 'Eksplorasi total dengan rute offroad lengkap dan spot pemandangan terbaik.',
            ],
            [
                'id' => 'sunrise-trip',
                'category' => 'sunrise',
                'name' => 'Sunrise Merapi Golden Hour',
                'badge' => 'Mulai 04.30 WIB',
                'badge_class' => 'badge-amber',
                'duration' => '3 - 4 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '650.000',
                'price_raw' => 650000,
                'image' => asset('images/5.jpeg'),
                'features' => [
                    'Sunrise Bunker Kaliadem Spot Utama',
                    'Tebing Kali Gendol',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Museum Kampung Hilang',
                    'Susur Sungai Kali Gendol',
                    'Manuver Air',
                ],
                'note' => 'Menikmati lautan awan dan matahari terbit spektakuler dari puncak bukit.',
            ],
        ];
    }

    /**
     * Display the main landing page with tour packages and destinations.
     */
    public function index()
    {
        $packages = $this->getPackages();

        $spots = [
            [
                'no' => '01',
                'title' => 'Water Splash Kali Opak',
                'tag' => 'Spot Basah-basahan',
                'image' => asset('images/spot_kali_opak.jpg'),
                'description' => 'Sensasi melibas aliran sungai berjeram ringan dengan cipratan air seru yang menantang dan memacu tawa seluruh penumpang.',
            ],
            [
                'no' => '02',
                'title' => 'Makam Raja-Raja Imogiri',
                'tag' => 'Wisata Sejarah',
                'image' => asset('images/spot_makam_imogiri.jpg'),
                'description' => 'Situs bersejarah Kesultanan Mataram dengan arsitektur tangga batu megah dan nilai spiritual mendalam yang sakral.',
            ],
            [
                'no' => '03',
                'title' => 'Hutan Bambu & Pinus',
                'tag' => 'Spot Teduh Asri',
                'image' => asset('images/spot_hutan_pinus.jpg'),
                'description' => 'Suasana sejuk di antara deretan rimbun pohon pinus dan kanopi bambu alami lereng perbukitan yang menenangkan jiwa.',
            ],
            [
                'no' => '04',
                'title' => 'Panorama Puncak Sosok',
                'tag' => 'Pemandangan Memukau',
                'image' => asset('images/spot_puncak_sosok.jpg'),
                'description' => 'Pemandangan 360 derajat kota Yogyakarta dan bentang perbukitan dari ketinggian, spot terfavorit menikmati senja nan syahdu.',
            ],
            [
                'no' => '05',
                'title' => 'Track Offroad Kebun Salak',
                'tag' => 'Jalur Ekstrem Seru',
                'image' => asset('images/spot_kebun_salak.jpg'),
                'description' => 'Jalur berlumpur dan berbatu alami menembus perkebunan salak pondoh khas Wukirsari dengan tanjakan memacu adrenalin.',
            ],
            [
                'no' => '06',
                'title' => 'Sentra Kerajinan Batik Giriloyo',
                'tag' => 'Wisata Edukasi & Budaya',
                'image' => asset('images/spot_batik_giriloyo.jpg'),
                'description' => 'Melihat langsung pembuatan batik tulis warisan leluhur Wukirsari yang diakui UNESCO dan mencoba membatik langsung.',
            ],
        ];

        $reasons = [
            [
                'num' => '01',
                'title' => 'Armada Terawat & Tangguh',
                'desc' => 'Unit Jeep 4x4 kami selalu dicek berkala oleh mekanik berpengalaman sebelum beroperasi demi keselamatan maksimal Anda.',
            ],
            [
                'num' => '02',
                'title' => 'Driver Asli Lokal & Ramah',
                'desc' => 'Dipandu putra daerah yang sangat hafal medan, cerita sejarah spot wisata, dan mahir mengambil foto sudut terbaik.',
            ],
            [
                'num' => '03',
                'title' => 'Pelayanan Ramah & Berpengalaman',
                'desc' => 'Telah melayani ribuan wisatawan keluarga, rombongan perusahaan, instansi kedinasan, hingga komunitas touring.',
            ],
            [
                'num' => '04',
                'title' => 'Fasilitas Komplit & Transparan',
                'desc' => 'Sudah mencakup asuransi perjalanan resmi, BBM, driver, air mineral gratis, serta tiket masuk tanpa biaya tersembunyi.',
            ],
        ];

        $steps = [
            [
                'step' => '01',
                'title' => 'Pilih Paket Wisata',
                'desc' => 'Pilih rute Short, Medium, Long, Sunrise, atau Custom trip sesuai waktu dan preferensi rombongan Anda.',
            ],
            [
                'step' => '02',
                'title' => 'Tentukan Tanggal & Jam',
                'desc' => 'Pilih tanggal kedatangan dan sesi jam trip (pagi, siang, atau sore saat golden hour menjelang senja).',
            ],
            [
                'step' => '03',
                'title' => 'Konfirmasi & DP Fleksibel',
                'desc' => 'Admin kami akan mengonfirmasi ketersediaan armada dan Anda cukup membayar uang muka amanah.',
            ],
            [
                'step' => '04',
                'title' => 'Nikmati Petualangan!',
                'desc' => 'Tiba di basecamp, kenakan safety gear, briefing singkat dengan driver, dan petualangan seru dimulai!',
            ],
        ];

        $gallery = [
            [
                'title' => 'Keseruan Rombongan Trip',
                'caption' => 'Armada Jeep Wukirsari siap menjelajah',
                'image' => asset('images/medium_trip.jpg'),
            ],
            [
                'title' => 'Water Splash Kali Opak',
                'caption' => 'Sensasi cipratan air sungai yang memacu adrenalin',
                'image' => asset('images/short_trip.jpg'),
            ],
            [
                'title' => 'Jalur Kanopi Bambu Hutan',
                'caption' => 'Menembus keteduhan alam lereng perbukitan',
                'image' => asset('images/long_trip.jpg'),
            ],
            [
                'title' => 'Golden Sunrise Perbukitan',
                'caption' => 'Pesona mentari terbit di atas lautan awan',
                'image' => asset('images/sunrise_trip.jpg'),
            ],
        ];

        return view('index', compact('packages', 'spots', 'reasons', 'steps', 'gallery'));
    }

    /**
     * Display the dedicated booking / reservation page.
     */
    public function bookingPage(Request $request)
    {
        $packages = $this->getPackages();
        $requestedPackage = $request->query('package');

        // Only preselect package if query parameter is provided (e.g., from landing page button)
        $selectedPackage = null;
        if ($requestedPackage) {
            $selectedPackage = collect($packages)->firstWhere('id', $requestedPackage)
                ?? collect($packages)->firstWhere('name', $requestedPackage);
        }

        $sessions = [
            [
                'id' => 'sunrise',
                'name' => 'Sesi Sunrise',
                'time' => '04.30 - 07.30',
                'badge' => 'Tersedia',
                'badge_class' => 'badge-avail',
            ],
            [
                'id' => 'pagi-1',
                'name' => 'Sesi Pagi 1',
                'time' => '07.00 - 09.30',
                'badge' => 'Best Daylight View',
                'badge_class' => 'badge-popular',
            ],
            [
                'id' => 'pagi-2',
                'name' => 'Sesi Pagi 2',
                'time' => '09.30 - 12.00',
                'badge' => 'Tersedia',
                'badge_class' => 'badge-avail',
            ],
            [
                'id' => 'siang',
                'name' => 'Sesi Siang',
                'time' => '13.00 - 15.30',
                'badge' => 'Tersedia',
                'badge_class' => 'badge-avail',
            ],
            [
                'id' => 'sunset',
                'name' => 'Sesi Sore (Sunset)',
                'time' => '15.30 - 17.30',
                'badge' => 'Sisa 2 Armada!',
                'badge_class' => 'badge-urgent',
            ],
        ];

        return view('booking', compact('packages', 'selectedPackage', 'sessions'));
    }

    /**
     * Booking process endpoint (AJAX or direct redirect to WhatsApp)
     */
    public function book(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'paket' => 'required|string',
            'paket_nama' => 'nullable|string',
            'tanggal' => 'required|date',
            'sesi' => 'required|string',
            'jumlah_jeep' => 'required|integer|min:1|max:50',
            'titik_kumpul' => 'nullable|string|max:100',
            'lokasi_penjemputan' => 'nullable|string|max:255',
            'total_biaya' => 'nullable|numeric',
            'dp_biaya' => 'nullable|numeric',
            'catatan' => 'nullable|string|max:500',
        ]);

        $phone = '6281361645727';
        $packageName = $validated['paket_nama'] ?? $validated['paket'];
        $jeepCount = (int) $validated['jumlah_jeep'];
        $totalFormatted = !empty($validated['total_biaya']) ? 'Rp ' . number_format($validated['total_biaya'], 0, ',', '.') : '-';
        $dpFormatted = !empty($validated['dp_biaya']) ? 'Rp ' . number_format($validated['dp_biaya'], 0, ',', '.') : '-';

        $text = "Halo Admin Jeep Wisata Wukirsari Adventure,\n\n"
              . "Saya ingin melakukan booking via Website:\n"
              . "━━━━━━━━━━━━━━━━━━━━━\n"
              . "• Nama Lengkap: {$validated['nama']}\n"
              . "• No WhatsApp: {$validated['telepon']}\n"
              . (!empty($validated['email']) ? "• Email: {$validated['email']}\n" : "")
              . "• Paket Wisata: {$packageName}\n"
              . "• Tanggal Trip: {$validated['tanggal']}\n"
              . "• Sesi Waktu: {$validated['sesi']}\n"
              . "• Jumlah Armada: {$jeepCount} Unit Jeep 4x4 (Maks. " . ($jeepCount * 4) . " Penumpang)\n"
              . "• Titik Kumpul: " . ($validated['titik_kumpul'] ?? 'Basecamp Wukirsari Cangkringan') . "\n"
              . (!empty($validated['lokasi_penjemputan']) ? "• Info Penjemputan: {$validated['lokasi_penjemputan']}\n" : "")
              . (!empty($validated['total_biaya']) ? "• Total Estimasi: {$totalFormatted}\n" : "")
              . (!empty($validated['dp_biaya']) ? "• Komitmen DP (30%): {$dpFormatted}\n" : "")
              . (!empty($validated['catatan']) ? "• Catatan Khusus: {$validated['catatan']}\n" : "")
              . "━━━━━━━━━━━━━━━━━━━━━\n"
              . "Mohon info ketersediaan slot armada dan petunjuk rekening pembayaran DP. Terima kasih!";

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($text);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'whatsapp_url' => $whatsappUrl,
                'summary' => [
                    'nama' => $validated['nama'],
                    'paket' => $packageName,
                    'tanggal' => $validated['tanggal'],
                    'sesi' => $validated['sesi'],
                    'jumlah_jeep' => $jeepCount,
                    'total_biaya' => $totalFormatted,
                    'dp_biaya' => $dpFormatted,
                ],
            ]);
        }

        return redirect()->away($whatsappUrl);
    }
}
