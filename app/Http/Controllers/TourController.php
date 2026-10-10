<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display the main landing page with tour packages and destinations.
     */
    public function index()
    {
        $packages = [
            [
                'id' => 'short-trip',
                'category' => 'short',
                'name' => 'SHORT TRIP',
                'badge' => 'POPULER',
                'badge_class' => 'badge-orange',
                'duration' => '2 - 2.5 Jam',
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
                'id' => 'medium-trip',
                'category' => 'medium',
                'name' => 'MEDIUM TRIP A',
                'badge' => 'BEST VALUE',
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
                    'Manuver Air',
                ],
                'note' => 'Pilihan terfavorit dengan kombinasi alam, adrenalin susur kali, dan situs budaya.',
            ],
            
            [
                'id' => 'medium-trip',
                'category' => 'medium',
                'name' => 'MEDIUM TRIP B',
                'badge' => 'BEST VALUE',
                'badge_class' => 'badge-emerald',
                'duration' => '2 - 2.5 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '550.000',
                'price_raw' => 550000,
                'image' => asset('images/3.jpeg'),
                'features' => [
                    'Susur Sungai kali Gendol',
                    'Museum Kampung Hilang',
                    'Selo Maruto',
                    'Lorong Oksigen',
                    'Gerbang Tol Sokario',
                    'Manuver Air',
                ],
                'note' => 'Pilihan terfavorit dengan kombinasi alam, adrenalin susur kali, dan situs budaya.',
            ],
            [
                'id' => 'long-trip',
                'category' => 'long',
                'name' => 'LONG TRIP',
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
                'name' => 'SUNRISE TRIP',
                'badge' => 'SPESIAL',
                'badge_class' => 'badge-amber',
                'duration' => '3 - 4 Jam',
                'capacity' => '4 Orang / Jeep',
                'price' => '650.000',
                'price_raw' => 650000,
                'image' => asset('images/5.jpeg'),
                'features' => [
                    'Bunker Kaliadem',
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
     * Booking process endpoint (AJAX or direct redirect to WhatsApp)
     */
    public function book(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'telepon' => 'required|string|max:20',
            'paket' => 'required|string',
            'tanggal' => 'required|date',
            'sesi' => 'required|string',
            'jumlah_jeep' => 'required|integer|min:1|max:50',
            'catatan' => 'nullable|string|max:500',
        ]);

        $phone = '6281234567890';
        $text = "Halo Admin Jeep Wisata Wukirsari Adventure,\n\n"
              . "Saya ingin melakukan booking:\n"
              . "• Nama: {$validated['nama']}\n"
              . "• No HP/WA: {$validated['telepon']}\n"
              . "• Paket: {$validated['paket']}\n"
              . "• Tanggal: {$validated['tanggal']}\n"
              . "• Sesi: {$validated['sesi']}\n"
              . "• Jumlah Jeep: {$validated['jumlah_jeep']} Armada\n"
              . ($validated['catatan'] ? "• Catatan: {$validated['catatan']}\n" : "")
              . "\nMohon konfirmasi ketersediaan dan detail pembayarannya. Terima kasih!";

        $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($text);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'whatsapp_url' => $whatsappUrl,
            ]);
        }

        return redirect()->away($whatsappUrl);
    }
}
