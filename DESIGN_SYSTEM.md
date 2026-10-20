# DESIGN SYSTEM: Jeep Wukirsari

Dokumen acuan visual dan implementasi untuk website booking jeep wisata di Wukirsari, Cangkringan, Sleman, Yogyakarta.
Sumber: 3 desain (Beranda, Paket Wisata, Detail Paket). Dokumen ini adalah **sumber kebenaran tunggal**. Jika desain gambar dan dokumen ini berbeda, ikuti dokumen ini (lihat bagian 14 untuk alasan koreksi).

> **Untuk AI agent:** baca seluruh dokumen, lalu wajib ikuti **Bagian 12 (Aturan Implementasi AI Agent)** sebelum menulis satu baris kode pun.

---

## Daftar Isi

1. Prinsip Desain
2. Brand dan Gaya Bahasa
3. Warna
4. Tipografi
5. Spacing, Radius, Shadow, Layout
6. Ikon
7. Animasi
8. Responsif
9. Komponen
10. Layout Halaman
11. Aksesibilitas
12. Aturan Implementasi AI Agent
13. Checklist Sebelum Selesai
14. Saran Perbaikan dari Desain

---

## 1. Prinsip Desain

| Prinsip | Artinya dalam praktik |
|---|---|
| Alami dan hangat | Hijau hutan, krem lembut, foto lereng Merapi sebagai pusat visual |
| Bersih | Banyak ruang kosong, satu aksi utama per area, tanpa dekorasi berlebihan |
| Konsisten | Satu set token untuk warna, jarak, radius, bayangan, dan animasi |
| Jelas | Kontras teks memenuhi WCAG AA, hierarki heading terlihat |
| Mobile-first | Mayoritas wisatawan membuka dari HP; desain dimulai dari layar kecil |

---

## 2. Brand dan Gaya Bahasa

- Nama brand: **Jeep Wukirsari**
- Tagline (pilih **satu**, pakai di mana-mana): `Explore More, Create Memories`
- Bahasa: Indonesia, sapaan "kamu" untuk copy ringan, netral untuk label UI.
- Nada: ramah, tenang, meyakinkan. Hindari tanda seru berlebihan dan huruf kapital semua.
- Format harga: `Rp 450.000` (titik ribuan, spasi setelah Rp), satuan `/jeep` (lihat bagian 14).
- Format durasi: `1,5 - 3 jam` (koma desimal, spasi di sekitar tanda hubung).
- Nama paket resmi: **Adventure**, **Lava Tour**, **Sunrise Tour**, **Private Trip**.

---

## 3. Warna

Semua warna **wajib** lewat CSS variable. Dilarang menulis hex langsung di luar blok token.

### 3.1 Token

```css
:root {
  /* Brand */
  --color-primary-900: #163A2B;  /* footer, overlay gelap */
  --color-primary-700: #1F4D3A;  /* tombol utama, judul, link aktif */
  --color-primary-600: #2A6048;  /* hover tombol utama */
  --color-primary-100: #E3EDE7;  /* chip/badge latar, state aktif lembut */
  --color-primary-50:  #F0F5F2;  /* latar section alternatif */

  /* Netral */
  --color-bg:          #F6F5EF;  /* latar halaman (krem) */
  --color-surface:     #FFFFFF;  /* card, panel, input */
  --color-border:      #E4E6DF;  /* garis, border card */
  --color-text:        #1B2B24;  /* teks utama */
  --color-text-muted:  #55655D;  /* teks sekunder, meta */
  --color-text-on-dark:#FFFFFF;  /* teks di atas primary-900/700 */

  /* Aksen dan status */
  --color-accent:      #E8A317;  /* HANYA bintang rating dan highlight kecil */
  --color-success:     #1E7A4C;
  --color-danger:      #B3261E;
  --color-focus:       #2A6048;  /* focus ring */
}
```

### 3.2 Pasangan warna yang diizinkan (perkiraan kontras)

| Teks | Latar | Rasio | Status |
|---|---|---|---|
| `--color-text` | `--color-bg` / `--color-surface` | di atas 12:1 | AAA |
| `--color-primary-700` | `--color-surface` | sekitar 9,6:1 | AAA |
| `--color-text-muted` | `--color-surface` | sekitar 6:1 | AA |
| `--color-text-muted` | `--color-bg` | sekitar 5,5:1 | AA |
| `--color-text-on-dark` | `--color-primary-700` / `-900` | di atas 9:1 | AAA |
| `--color-text-on-dark` | `--color-primary-600` | sekitar 7:1 | AAA |

Verifikasi ulang dengan alat kontras jika nilai token diubah.

### 3.3 Aturan warna

- Satu warna aksi utama: hijau `--color-primary-700`. Tidak ada warna tombol lain.
- `--color-accent` (emas) **bukan** warna teks atau tombol. Kontrasnya rendah di latar terang; pakai hanya untuk ikon bintang dan sertakan teks/`aria-label` rating.
- Teks di atas foto (hero) wajib memakai overlay gradien gelap `--color-primary-900` (opasitas 55-70% di sisi teks) agar terbaca.
- Teks sekunder jangan lebih pucat dari `--color-text-muted` (desain asli beberapa meta terlalu pucat).
- Tidak ada dark mode pada versi pertama.

---

## 4. Tipografi

**Maksimal 2 font. Tidak boleh ditambah.**

| Peran | Font | Bobot | Dipakai untuk |
|---|---|---|---|
| Utama | **Plus Jakarta Sans** | 400, 500, 600, 700 | Semua: heading, body, tombol, input, nav, label |
| Aksen | **Caveat** | 600 | Hanya tagline/kutipan dekoratif (mis. "Jelajahi keindahan alam bersama kami") |

Aturan font aksen: maksimal 1 baris per section, ukuran minimal 22px, tidak untuk tombol, label, input, atau paragraf, dan teks yang penting harus tetap tersedia sebagai teks biasa untuk pembaca layar.

Pemuatan: self-host atau Google Fonts dengan `font-display: swap`, hanya muat bobot yang dipakai.

```css
:root {
  --font-sans: "Plus Jakarta Sans", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  --font-script: "Caveat", "Segoe Script", cursive;

  /* Skala fluid */
  --text-xs:   0.8125rem;                                  /* 13px, label kecil/meta minimum */
  --text-sm:   0.875rem;                                   /* 14px */
  --text-base: 1rem;                                       /* 16px, body */
  --text-lg:   1.125rem;                                   /* 18px */
  --text-xl:   clamp(1.25rem, 1.1rem + 0.6vw, 1.5rem);     /* judul card */
  --text-2xl:  clamp(1.5rem, 1.2rem + 1.4vw, 2rem);        /* judul section */
  --text-3xl:  clamp(2rem, 1.4rem + 3vw, 3.5rem);          /* judul hero */

  --leading-tight: 1.2;
  --leading-normal: 1.6;
}
```

| Elemen | Ukuran | Bobot | Line-height |
|---|---|---|---|
| Hero title | `--text-3xl` | 700 | tight |
| Judul section | `--text-2xl` | 700 | tight |
| Judul card / nama paket | `--text-xl` | 600 | tight |
| Body | `--text-base` | 400 | normal |
| Meta (durasi, kapasitas, lokasi) | `--text-sm` | 400 | normal |
| Harga | `--text-xl` | 700 | tight |
| Tombol | `--text-sm` s/d `--text-base` | 600 | 1 |
| Eyebrow (mis. "PAKET WISATA") | `--text-xs`, uppercase, letter-spacing 0.08em | 600 | 1 |

Panjang baris paragraf maksimal sekitar 65 karakter (`max-width: 65ch`).

---

## 5. Spacing, Radius, Shadow, Layout

```css
:root {
  /* Spacing basis 4px */
  --space-1: 0.25rem;  --space-2: 0.5rem;   --space-3: 0.75rem;
  --space-4: 1rem;     --space-5: 1.5rem;   --space-6: 2rem;
  --space-7: 3rem;     --space-8: 4rem;     --space-9: 6rem;

  /* Radius */
  --radius-sm: 8px;    /* input kecil, chip kecil */
  --radius-md: 12px;   /* tombol, input */
  --radius-lg: 16px;   /* card */
  --radius-xl: 24px;   /* hero/banner container */
  --radius-pill: 999px;/* chip filter, badge */

  /* Shadow (tint hijau, lembut) */
  --shadow-sm: 0 1px 2px rgba(22, 58, 43, 0.06);
  --shadow-md: 0 4px 16px rgba(22, 58, 43, 0.08);
  --shadow-lg: 0 12px 32px rgba(22, 58, 43, 0.12);

  /* Layout */
  --container-max: 1200px;
  --container-pad: clamp(1rem, 4vw, 2rem);
  --header-height: 64px;
}
```

- Jarak vertikal antar section: `--space-8` (mobile `--space-7`).
- Gap grid card: `--space-5`.
- Padding card: `--space-4` (mobile) sampai `--space-5` (desktop).
- Container: `max-width: var(--container-max); margin-inline: auto; padding-inline: var(--container-pad);`

---

## 6. Ikon

**Dilarang emoji** untuk ikon tombol, card, judul, list, atau elemen UI apa pun. Gunakan hanya ikon SVG.

- Set ikon: **Lucide** (garis konsisten, sesuai gaya desain). Satu set saja, jangan campur dengan set lain.
- Ikon merek sosial (Instagram, Facebook, YouTube, TikTok, WhatsApp): ambil dari **Simple Icons** atau SVG resmi, karena Lucide tidak menyediakan ikon merek.
- Logo: SVG kustom (gunung + jeep) sebagai aset terpisah.
- Cara pakai: inline SVG atau SVG sprite (`<use href="#icon-name">`). Satu definisi per ikon, jangan menyalin path SVG yang sama ke banyak tempat.
- Warna: `stroke="currentColor"` / `fill="currentColor"` agar mengikuti warna teks.
- Ukuran dan stroke: 16px (meta), 20px (tombol, list), 24px (feature strip). `stroke-width: 1.75`. Gunakan token `--icon-sm/md/lg`.
- Dekoratif: `aria-hidden="true"`. Tombol hanya-ikon: wajib `aria-label`.

| Kebutuhan | Ikon |
|---|---|
| Durasi | `clock` |
| Kapasitas | `users` |
| Lokasi | `map-pin` |
| Booking | `calendar-check` |
| Cari | `search` |
| Lanjut / Lihat detail | `arrow-right` |
| Kembali | `arrow-left` |
| Fasilitas tersedia | `circle-check` |
| Jeep 4x4 / Driver / Aman | `car-front`, `user-check`, `shield-check` |
| Harga transparan, pelayanan, rute, pengalaman | `badge-check`, `headset`, `route`, `star` |
| Menu mobile / tutup | `menu` / `x` |
| Carousel | `chevron-left` / `chevron-right` |

Aturan: ikon tidak pernah menjadi satu-satunya penyampai makna; selalu ada teks atau label.

---

## 7. Animasi

Prinsip: **halus, singkat, bermakna, seragam**. Hanya animasikan `transform` dan `opacity` (plus `background-color`, `box-shadow`, `color` untuk state hover). Dilarang menganimasikan `width`, `height`, `top`, `left`, `margin`.

```css
:root {
  --duration-fast: 150ms;   /* hover kecil, warna */
  --duration-base: 250ms;   /* menu, tab, dropdown */
  --duration-slow: 400ms;   /* gambar, reveal */
  --ease-standard: cubic-bezier(0.4, 0, 0.2, 1);
  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
}
```

| Interaksi | Efek | Durasi | Easing |
|---|---|---|---|
| Hover tombol | warna latar berubah, `translateY(-1px)` | fast | standard |
| Active/pressed tombol | `scale(0.98)` | 100ms | standard |
| Hover card | `translateY(-4px)` + `--shadow-lg` | base | out |
| Hover gambar di card | `scale(1.04)` di dalam container `overflow: hidden` | slow | out |
| Hover link nav | garis bawah menyorot dari kiri (`scaleX`) | base | standard |
| Pindah tab | indikator bergeser (`translateX`), konten fade | base | standard |
| Chip filter aktif | transisi warna latar dan teks | fast | standard |
| Menu mobile / drawer | slide dari samping + fade backdrop | base | out |
| Reveal saat scroll | fade + naik 16px, sekali saja, stagger maks 60ms, maksimal 5 elemen | slow | out |
| Hero slider | crossfade | 500ms | standard |
| Focus ring | muncul instan (tanpa delay) | 0 | - |

Aturan:
- Dilarang: bounce, elastic, shake, animasi berulang tak terbatas (kecuali spinner loading), parallax berat.
- Autoplay (hero slider, carousel testimoni) harus berhenti saat hover/focus dan harus ada kontrol manual.
- Wajib hormati preferensi pengguna:

```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

(Satu-satunya tempat `!important` yang diizinkan.)

---

## 8. Responsif

Pendekatan **mobile-first**: tulis gaya dasar untuk layar kecil, lalu tambahkan `min-width`.

| Nama | Min-width | Perangkat |
|---|---|---|
| base | 0 | HP (target 320px ke atas) |
| sm | 640px | HP besar / landscape |
| md | 768px | Tablet |
| lg | 1024px | Laptop kecil |
| xl | 1280px | Desktop |

> Media query tidak bisa memakai CSS variable. Tulis angka di atas secara literal dan konsisten.

| Area | base | sm-md | lg+ |
|---|---|---|---|
| Navbar | logo + tombol hamburger, menu drawer | sama | menu horizontal + tombol Booking Sekarang |
| Grid card paket | 1 kolom | 2 kolom (sm) | 3 kolom (lg); halaman Paket Wisata 2-3 kolom |
| Feature strip (4 poin) | 2x2 grid | 2x2 | 4 kolom satu baris |
| Galeri | scroll horizontal dengan `scroll-snap` | 3 kolom | 5 kolom |
| Testimoni | 1 card + swipe | 2 card | 3 card |
| Detail paket | satu kolom: galeri, info, fasilitas, tab | sama | galeri lebar penuh, info dua kolom |
| Footer | 1 kolom bertumpuk | 2 kolom | 4 kolom |
| CTA Booking (Detail) | **bar sticky di bawah layar** | sama | tombol inline |

Aturan:
- Target sentuh minimal **44x44px**.
- Tidak boleh ada scroll horizontal pada halaman (kecuali galeri/carousel yang memang disengaja).
- Gambar: `max-width: 100%`, `aspect-ratio` tetap (card 4/3, hero 16/9 desktop dan 4/5 mobile), `object-fit: cover`, `loading="lazy"` kecuali hero, sediakan `srcset` dan format WebP/AVIF.
- Tinggi hero pakai `min-height` dengan `clamp()`, bukan tinggi tetap.
- Tabel atau konten lebar harus punya container `overflow-x: auto`.
- Uji minimal di lebar: 320, 375, 768, 1024, 1440.
- Dukung area aman perangkat (`env(safe-area-inset-bottom)`) untuk bar sticky.

---

## 9. Komponen

Setiap komponen memakai **token saja**. Nama kelas mengikuti BEM: `.blok__elemen--modifier`. Jika proyek sudah memiliki konvensi penamaan, ikuti yang sudah ada (lihat bagian 12).

### 9.1 Tombol

| Varian | Tampilan | Dipakai untuk |
|---|---|---|
| `primary` | latar `--color-primary-700`, teks putih | Booking Sekarang, aksi utama |
| `outline` | border `--color-primary-700`, teks `--color-primary-700`, latar transparan | Lihat Detail, aksi sekunder |
| `ghost` (di atas foto) | latar putih 90%, teks `--color-primary-700` | Jelajahi Paket di hero |
| `link` | teks `--color-primary-700` + ikon panah | Lihat Semua |

- Ukuran: tinggi 44px (default), 36px (`sm`, hanya di card padat), radius `--radius-md`; pill untuk chip.
- State wajib: default, hover, focus-visible, active, disabled, loading (spinner SVG, teks tetap).
- Maksimal **1 tombol primary per viewport area**.
- Ikon ditempatkan setelah teks untuk aksi maju (`arrow-right`), sebelum teks untuk aksi mundur (`arrow-left`).

### 9.2 Navbar

- Tinggi `--header-height`, latar putih/krem dengan blur ringan, sticky.
- Menu: Beranda, Paket Wisata, Tentang Kami, Galeri, Kontak. Item aktif: teks `--color-primary-700` + garis bawah.
- Kanan: ikon cari dan tombol `primary` Booking Sekarang (ikon `calendar-check`).
- Mobile: hamburger membuka drawer; fokus terkunci di drawer, tutup dengan Esc dan klik backdrop.

### 9.3 Hero (Beranda)

- Foto jeep + Merapi, overlay gradien `--color-primary-900`.
- Eyebrow (font aksen) + judul `--text-3xl` + deskripsi maks 2-3 baris + 2 tombol (primary + ghost).
- Indikator slider `01-05` hanya tampil jika slider benar-benar dibuat; jika tidak, hilangkan.
- Label lokasi kecil di kanan bawah dengan ikon `map-pin`.

### 9.4 Hero halaman Paket Wisata

- Foto lebih pendek, judul "Paket Wisata" + 1 kalimat deskripsi. Overlay sama dengan hero beranda.

### 9.5 Feature strip

- 4 item: ikon dalam lingkaran `--color-primary-100`, judul `--text-sm` 600, deskripsi `--text-xs` muted.
- Pemisah vertikal tipis hanya di lg+.

### 9.6 Kartu paket (komponen paling sering dipakai)

Struktur:
1. Gambar (rasio 4/3, radius atas `--radius-lg`)
2. Badge opsional "Paling Populer" (pill, latar `--color-primary-700`, teks putih)
3. Nama paket (`--text-xl`)
4. Deskripsi singkat (maks 2 baris, `line-clamp`) - opsional, hanya di Beranda
5. Meta: durasi (`clock`), kapasitas (`users`), lokasi (`map-pin`)
6. Harga + satuan
7. Aksi: `outline` Lihat Detail (+ `primary` Booking Sekarang di Beranda)

- Satu komponen `package-card` untuk Beranda dan halaman Paket Wisata; perbedaan hanya lewat modifier `--compact`, bukan komponen baru.
- Seluruh card bisa diklik ke detail, tetapi hanya satu link utama (hindari link bersarang).

### 9.7 Filter paket (halaman Paket Wisata)

- Chip pill: Semua, Adventure, Lava Tour, Sunrise Tour, Private Trip. Aktif: latar `--color-primary-700`, teks putih.
- Kolom cari dengan ikon `search`. Debounce 250ms.
- Mobile: chip scroll horizontal, kolom cari di baris sendiri.
- Wajib ada **state kosong** ("Paket tidak ditemukan") dengan ikon dan tombol reset filter.

### 9.8 Halaman Detail Paket

- Tombol Kembali (pill putih di atas gambar), galeri utama + 4 thumbnail (klik thumbnail mengganti gambar utama, transisi fade).
- Judul paket, meta (durasi, kapasitas, lokasi), harga, tombol Booking Sekarang.
- Kotak "Fasilitas yang Didapat": daftar 2 kolom (1 kolom di mobile) dengan ikon `circle-check`.
- Tab: Deskripsi, Itinerary, Ketentuan (pola `role="tablist"`, navigasi panah keyboard).
- Banner penutup berisi ilustrasi + kutipan font aksen.

### 9.9 Section "Mengapa Memilih"

- Panel hijau gradasi (`--color-primary-700` ke `--color-primary-900`), teks putih, 4 poin dengan ikon, tombol "Tentang Kami".

### 9.10 Galeri

- Gambar rasio seragam, radius `--radius-md`, hover `scale(1.04)`. Klik membuka lightbox (fokus terkunci, Esc untuk tutup, panah kiri/kanan).

### 9.11 Testimoni

- Card: avatar bulat, nama, kota, kutipan, 5 bintang (`--color-accent`) dengan `aria-label="Rating 5 dari 5"`.

### 9.12 Footer

- Latar `--color-primary-900`, logo + tagline, navigasi, kontak (telepon, email, alamat dengan ikon), sosial (ikon SVG merek), baris hak cipta dan tautan Syarat/Kebijakan.
- Tahun hak cipta dibuat dinamis, bukan teks tetap.

### 9.13 Form Booking (belum ada di desain, lihat bagian 14)

- Label di atas input (bukan placeholder-sebagai-label), tinggi input 48px, radius `--radius-md`, border `--color-border`, focus ring `--color-focus` 2px.
- Pesan error: teks `--color-danger` + ikon, dibacakan lewat `aria-describedby`.

---

## 10. Layout Halaman

**Beranda:** Navbar, Hero, Feature strip, Paket Populer (3 card + Lihat Semua), Mengapa Memilih, Galeri, Testimoni, Footer.

**Paket Wisata:** Navbar, Hero pendek, Filter + cari, Grid paket (tampilkan hanya paket yang tersedia di Wukirsari), Footer.

**Detail Paket:** Navbar, Kembali, Galeri, Info + harga + CTA, Fasilitas, Tab, Banner penutup, Footer.

**Booking (usulan):** pilih paket, tanggal, jumlah jeep, jumlah peserta, nama, nomor WhatsApp, ringkasan harga, konfirmasi.

---

## 11. Aksesibilitas

- Kontras minimal AA (lihat bagian 3).
- Semua elemen interaktif bisa dijangkau keyboard; `:focus-visible` dengan outline 2px `--color-focus`, offset 2px. Dilarang `outline: none` tanpa pengganti.
- HTML semantik: `header`, `nav`, `main`, `section` dengan heading, `footer`. Satu `h1` per halaman, urutan heading tidak melompat.
- Gambar bermakna punya `alt` deskriptif; gambar dekoratif `alt=""`.
- Tombol hanya-ikon punya `aria-label`.
- Carousel/slider: kontrol pause, indikator posisi, bisa dioperasikan keyboard.
- Jangan sampaikan informasi hanya lewat warna.
- Tautan membuka tab baru diberi keterangan dan `rel="noopener"`.

---

## 12. Aturan Implementasi AI Agent

### 12.1 Alur kerja wajib (urut, jangan loncat)

1. **Baca** dokumen ini sampai habis.
2. **Audit CSS yang sudah ada** sebelum menulis apa pun:
   - Daftar semua file CSS, variabel (`--*`), dan nama kelas yang ada.
   - Catat konvensi penamaan yang dipakai (BEM, utility, dll.) dan **ikuti**, jangan mengganti.
   - Bandingkan token di dokumen ini dengan token yang sudah ada. Jika sudah ada padanannya, **pakai yang sudah ada**; jangan membuat alias baru. Jika nilainya berbeda dari dokumen ini, laporkan perbedaannya ke pengguna, jangan menimpa diam-diam.
3. **Petakan** kebutuhan tugas ke komponen di Bagian 9 dan ke kelas yang sudah ada. Tulis pemetaan singkat sebelum coding.
4. **Cari dulu** (grep) sebelum membuat: warna, spacing, kelas, ikon, animasi. Jika sudah ada, pakai.
5. **Implementasikan** dengan HTML semantik, mobile-first, token saja.
6. **Verifikasi** dengan checklist Bagian 13.
7. **Laporkan**: file yang diubah, kelas/token baru (jika ada) beserta alasannya, dan hal yang butuh keputusan pengguna.

### 12.2 Aturan anti-duplikasi (jangan mengulang)

- Dilarang menulis nilai mentah untuk warna, jarak, radius, bayangan, ukuran font, durasi, easing. Selalu `var(--token)`.
- Dilarang membuat kelas baru jika kelas yang ada bisa dipakai dengan modifier.
- Dilarang menyalin blok CSS atau markup yang sama ke tempat lain. Pola yang muncul **3 kali atau lebih** diekstrak menjadi satu komponen.
- Satu ikon = satu definisi SVG (sprite atau komponen), dipakai ulang lewat referensi.
- Dilarang membuat file CSS baru jika file yang ada sudah mencakup tujuannya.
- Dilarang menambah `@keyframes` baru jika transisi biasa cukup; periksa dulu animasi yang sudah ada.
- Tidak ada gaya inline (`style=""`) dan tidak ada `!important` (kecuali blok reduced-motion).

### 12.3 Aturan anti-reuse berlebihan (jangan over-abstraksi)

- Jangan membuat komponen "serba bisa" dengan lebih dari 4 varian; pecah jika lebih.
- Ekstrak hanya setelah ada pola nyata (aturan 3 kali), jangan abstraksi spekulatif.
- Hindari kelas pembungkus yang hanya dipakai sekali.
- Hindari ledakan utility class (satu properti per kelas) jika proyek bukan berbasis utility.
- Modifier maksimal satu tingkat (`.card--compact`), bukan `.card--compact--dark--wide`.
- Jangan menggeser gaya komponen yang tidak terkait; ubah hanya yang diminta.
- Jangan refactor kode di luar lingkup tugas. Jika menemukan masalah lain, catat di laporan, jangan diperbaiki diam-diam.

### 12.4 Aturan teknis

- Urutan properti dalam rule: layout (display, grid, position) lalu box (size, spacing) lalu tipografi lalu visual (warna, border, shadow) lalu motion (transition).
- Mobile-first: gaya dasar tanpa media query, lalu `@media (min-width: ...)`.
- Gunakan `gap`, `grid`, `flex`, `clamp()`, `aspect-ratio`; hindari lebar/tinggi piksel tetap untuk wadah.
- Transisi ditulis eksplisit per properti (`transition: transform var(--duration-base) var(--ease-out)`), bukan `transition: all`.
- Urutan z-index lewat token (`--z-header`, `--z-drawer`, `--z-modal`), tidak memakai angka acak.
- Stack JavaScript/framework: **ikuti yang sudah dipakai proyek**; dokumen ini tidak menetapkan framework.

### 12.5 Larangan mutlak

1. Emoji di UI (tombol, card, judul, list, placeholder, alt).
2. Font ketiga atau bobot font yang tidak terdaftar.
3. Warna di luar token, termasuk gradien dengan warna acak.
4. Animasi di luar tabel Bagian 7, atau animasi `width/height/top/left`.
5. Teks di atas foto tanpa overlay.
6. Menghapus focus ring.
7. Menimpa atau menghapus gaya yang sudah ada tanpa persetujuan.
8. Menambahkan library CSS/UI baru tanpa persetujuan pengguna.

### 12.6 Jika ragu

Jika desain gambar, dokumen ini, dan CSS yang ada saling bertentangan: urutan prioritasnya **dokumen ini, lalu CSS yang ada, lalu gambar desain**. Tulis konflik tersebut di laporan dan tanyakan ke pengguna sebelum mengubah gaya yang sudah dipakai di produksi.

---

## 13. Checklist Sebelum Selesai

- [ ] Tidak ada nilai warna/jarak/radius/shadow/durasi mentah di luar token
- [ ] Hanya 2 font (Plus Jakarta Sans, Caveat) dan Caveat hanya untuk aksen
- [ ] Tidak ada emoji; semua ikon SVG dari set yang ditentukan
- [ ] Semua animasi sesuai tabel Bagian 7; `prefers-reduced-motion` ditangani
- [ ] Kontras teks memenuhi AA; teks di atas foto memakai overlay
- [ ] Tidak ada duplikasi kelas/blok CSS; tidak ada abstraksi berlebihan
- [ ] Mobile-first; diuji di 320, 375, 768, 1024, 1440; tanpa scroll horizontal
- [ ] Target sentuh minimal 44px; bar CTA sticky di mobile pada halaman Detail
- [ ] Keyboard dan fokus berfungsi; heading berurutan; `alt` dan `aria-label` lengkap
- [ ] State lengkap: hover, focus, active, disabled, loading, kosong, error
- [ ] Laporan perubahan ditulis (file, kelas/token baru, keputusan yang tertunda)

---

## 14. Saran Perbaikan dari Desain

Temuan saat menganalisis 3 desain, dan koreksi yang dipakai di dokumen ini:

| # | Temuan di desain | Koreksi / saran |
|---|---|---|
| 1 | Salah ketik: "Andventure", "Lavature" | Gunakan **Adventure** dan **Lava Tour** di semua halaman |
| 2 | Satuan harga tidak konsisten: `/Jeep` (Beranda) vs `/paket` (Paket, Detail) | Pilih `/jeep` (kapasitas maks 4 orang per jeep) dan seragamkan |
| 3 | Label nav "Tentang" vs "Tentang Kami" | Gunakan **Tentang Kami** |
| 4 | Tagline beda: "Explore More, Create Memories" vs "Adventure Tour" | Pakai satu tagline (lihat bagian 2) |
| 5 | Paket Bromo Camping dan Raja Ampat (foto bukan jeep, lokasi di luar Wukirsari) tidak sesuai ruang lingkup proyek | Hapus, atau tandai sebagai "Segera Hadir" jika memang akan ada |
| 6 | Teks meta di card Paket Wisata terlalu pucat | Pakai `--color-text-muted` (kontras sekitar 6:1) |
| 7 | Teks hero di atas foto bergantung pada bagian foto yang gelap | Overlay gradien wajib |
| 8 | Desain beranda memakai teks sangat kecil (di bawah 12px) | Minimum 13px (`--text-xs`) |
| 9 | Nomor telepon, email, dan tahun hak cipta masih contoh | Ganti dengan data asli; tahun dibuat dinamis |
| 10 | Belum ada desain halaman/form **Booking** padahal inti proyek | Buat halaman booking (tanggal, jumlah jeep, peserta, kontak, ringkasan harga, konfirmasi lewat WhatsApp) |
| 11 | Belum ada state: hover, focus, loading, error, kosong, 404 | Wajib dibuat sesuai bagian 9 |
| 12 | Indikator slider `01-05` dan panah testimoni tanpa perilaku jelas | Jika ada autoplay: pause saat hover/focus, kontrol manual, aksesibel keyboard; jika tidak dipakai, hapus |
| 13 | Tab Itinerary dan Ketentuan belum ada isinya | Siapkan konten (titik kumpul, rute, jam, kebijakan batal/hujan, batas usia) |
| 14 | Item fasilitas panjang ("Tiket masuk, Jasa Raharja, antar jemput") digabung satu baris | Pecah menjadi item terpisah agar rapi di mobile |
| 15 | Ada elemen kecil tumpang tindih di gambar card (label di sudut kiri bawah) | Hapus; badge hanya "Paling Populer" di sudut kiri atas |
| 16 | Pada mobile tidak ada CTA yang selalu terlihat | Bar Booking sticky di halaman Detail |
| 17 | Performa: banyak foto besar | WebP/AVIF, `srcset`, `loading="lazy"`, ukuran hero dioptimalkan |

---

*Versi 1.0. Perbarui dokumen ini terlebih dahulu setiap kali token atau komponen berubah, lalu sesuaikan kodenya.*