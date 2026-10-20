<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class TourController extends Controller
{
    private function catalog()
    {
        return collect(config('jeep.packages'));
    }

    public function index()
    {
        $packages = $this->catalog();
        $popularPackages = $packages->filter(fn ($p) => $p['popular'] ?? false);
        if ($popularPackages->isEmpty()) {
            $popularPackages = $packages->take(3);
        } else {
            // Include up to 3 cards for the home popular section
            $popularPackages = $packages->take(3);
        }

        $gallery = collect(File::glob(public_path('images/gallery/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))
            ->map(fn ($path) => 'images/gallery/' . basename($path))
            ->values();

        if ($gallery->isEmpty()) {
            // Fallback to existing public images if gallery folder was empty
            $gallery = collect(['images/1.jpeg', 'images/2.jpeg', 'images/3.jpeg', 'images/4.jpeg', 'images/5.jpeg']);
        }

        $testimonials = collect(config('jeep.testimonials', []));

        return view('home', compact('packages', 'popularPackages', 'gallery', 'testimonials'));
    }

    public function packages()
    {
        return view('packages.index', [
            'packages' => $this->catalog(),
        ]);
    }

    public function show(string $slug)
    {
        $package = $this->catalog()->firstWhere('slug', $slug);
        abort_unless($package, 404);

        return view('packages.show', [
            'package'    => $package,
            'facilities' => config('jeep.facilities'),
        ]);
    }

    public function book(Request $request)
    {
        $validSlugs = $this->catalog()->pluck('slug')->all();

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:80'],
            'phone'   => ['required', 'regex:/^\+?[0-9][0-9\s\-]{7,17}$/'],
            'package' => ['required', Rule::in($validSlugs)],
            'date'    => ['required', 'date', 'after_or_equal:today'],
            'session' => ['required', Rule::in(array_keys(config('jeep.sessions')))],
            'jeeps'   => ['required', 'integer', 'between:1,10'],
            'notes'   => ['nullable', 'string', 'max:300'],
        ], [
            'name.required'       => 'Nama lengkap wajib diisi.',
            'phone.required'      => 'Nomor WhatsApp wajib diisi.',
            'phone.regex'         => 'Format nomor WhatsApp tidak valid.',
            'package.required'    => 'Pilih paket wisata.',
            'package.in'          => 'Paket yang dipilih tidak tersedia.',
            'date.required'       => 'Tanggal keberangkatan wajib diisi.',
            'date.after_or_equal' => 'Tanggal tidak boleh sebelum hari ini.',
            'session.required'    => 'Pilih sesi jam keberangkatan.',
            'jeeps.required'      => 'Pilih jumlah armada jeep.',
        ]);

        $whatsapp = preg_replace('/\D/', '', (string) config('jeep.contact.whatsapp'));
        if ($whatsapp === '') {
            $whatsapp = '6281234567890';
        }

        $package = $this->catalog()->firstWhere('slug', $data['package']);
        $rupiah  = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');
        $jeeps   = (int) $data['jeeps'];
        $total   = $jeeps <= 5 ? $rupiah($package['price'] * $jeeps) : 'Hubungi admin (rombongan >5 armada)';
        $date    = Carbon::parse($data['date'])->locale('id')->translatedFormat('l, j F Y');
        $notes   = trim(preg_replace('/\s+/', ' ', (string) ($data['notes'] ?? '')));
        $brand   = config('jeep.brand.name');

        $lines = [
            "Halo Admin {$brand}, saya ingin booking paket jeep wisata:",
            "• Nama: {$data['name']}",
            "• No WhatsApp: {$data['phone']}",
            "• Paket: {$package['name']} ({$rupiah($package['price'])} / paket)",
            "• Tanggal: {$date}",
            "• Sesi Jam: " . (config('jeep.sessions')[$data['session']] ?? $data['session']),
            "• Jumlah Armada: {$jeeps} Jeep",
            "• Estimasi Total: {$total}",
        ];

        if ($notes !== '') {
            $lines[] = "• Catatan: {$notes}";
        }

        $lines[] = "";
        $lines[] = "Mohon konfirmasi ketersediaan armada dan informasi pembayarannya. Terima kasih!";

        $url = 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode(implode("\n", $lines));

        return redirect()->away($url);
    }
}





