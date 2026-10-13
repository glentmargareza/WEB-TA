# PANDUAN GIT WORKFLOW — WEB-TA

### 1. Tujuan Git Workflow
setiap anggota memiliki branch sendiri. Setelah fitur selesai, kode dikirim ke GitHub. Galent bertugas menggabungkan kode dari semua anggota ke branch `branch-dev` dan memastikan semua fitur berjalan dengan baik.

### 2. Pembagian Tugas dan Branch

| Nama | Branch | Tugas |
| Galent | `galent` | Mengerjakan fitur Galent |
| Galent | `branch-dev` | Menggabungkan dan menguji semua fitur |
| Anin | `anin` | Mengerjakan fitur Anin |
| Shofi | `shofi` | Mengerjakan fitur Shofi |
| Semua anggota | `main` | Menyimpan versi utama proyek yang sudah stabil |

**Fungsi setiap branch:**

- `main`: menyimpan versi utama proyek yang sudah stabil.
- `branch-dev`: tempat menggabungkan dan menguji fitur dari semua anggota.
- `galent`: tempat Galent mengerjakan fiturnya.
- `anin`: tempat Anin mengerjakan fiturnya.
- `shofi`: tempat Shofi mengerjakan fiturnya.

Repository GitHub: https://github.com/glentmargareza/WEB-TA

### 3. Mengenal Perintah Git

Sebelum mulai bekerja, setiap anggota perlu memahami beberapa perintah Git berikut.

| Perintah | Fungsi |
| `git status` | Melihat perubahan file dan kondisi Git. |
| `git branch --show-current` | Melihat branch yang sedang aktif. |
| `git fetch origin` | Mengambil informasi terbaru dari GitHub tanpa langsung menggabungkan kode. |
| `git pull origin nama-branch` | Mengambil dan menggabungkan pembaruan dari branch tertentu. |
| `git switch nama-branch` | Berpindah ke branch yang dipilih. |
| `git add .` | Menyiapkan perubahan untuk disimpan. |
| `git commit -m "pesan"` | Menyimpan perubahan ke riwayat Git. |
| `git push origin nama-branch` | Mengirim commit ke GitHub. |
| `git merge origin/nama-branch` | Menggabungkan perubahan dari branch remote ke branch yang sedang aktif. |

**Penting:** sebelum melakukan merge, pastikan branch yang aktif sudah benar dengan perintah:

```bash
git branch --show-current
```

### 4. Persiapan Awal

Bagian ini dilakukan ketika pertama kali menyiapkan proyek.

#### A. Mengunduh proyek dari GitHub

Buka terminal Antigravity, kemudian jalankan:

```bash
git clone https://github.com/glentmargareza/WEB-TA.git
cd WEB-TA
```

Perintah pertama digunakan untuk mengunduh proyek dari GitHub. Perintah kedua digunakan untuk masuk ke folder proyek.

#### B. Melihat branch yang tersedia

Jalankan:

```bash
git fetch --all
git branch -a
```

#### C. Berpindah ke branch masing-masing

Galent:

```bash
git switch galent
```

Anin:

```bash
git switch anin
```

Shofi:

```bash
git switch shofi
```

Jika branch belum tersedia secara lokal tetapi sudah ada di GitHub, gunakan:

```bash
git switch --track origin/nama-branch
```

Ganti `nama-branch` dengan nama branch yang ingin digunakan.

### 5. Cara Kerja Anin dan Shofi

Anin dan Shofi mengerjakan fitur masing-masing di branch pribadi. Perubahan tidak langsung dimasukkan ke `main`, melainkan dikirim ke branch masing-masing terlebih dahulu.

#### A. Sebelum mulai coding

Anin menjalankan:

```bash
git switch anin
git pull origin anin
git fetch origin
git merge origin/branch-dev
```

Shofi menjalankan:

```bash
git switch shofi
git pull origin shofi
git fetch origin
git merge origin/branch-dev
```

Langkah tersebut bertujuan untuk mengambil pembaruan terbaru dari branch masing-masing dan memasukkan perubahan yang sudah ada di `branch-dev`.

Jika muncul merge conflict, selesaikan terlebih dahulu sebelum melanjutkan pekerjaan.

#### B. Setelah selesai coding

Periksa perubahan yang telah dibuat:

```bash
git status
git diff
```

Jika perubahan sudah benar, simpan menggunakan:

```bash
git add .
git commit -m "feat: menambahkan fitur"
```

Contoh pesan commit:

```bash
git commit -m "feat: menambahkan fitur login"
```

Pesan commit sebaiknya menjelaskan perubahan yang benar-benar dilakukan.

#### C. Mengirim kode ke GitHub

Setelah perubahan disimpan, kirim kode ke branch masing-masing.

Anin:

```bash
git push origin anin
```

Shofi:

```bash
git push origin shofi
```

Setelah push berhasil, kode sudah dikirim ke GitHub dan dapat diambil oleh Galent untuk proses integrasi.

### 6. Cara Kerja Galent sebagai Integrator

Galent memiliki dua tugas, yaitu mengerjakan fitur sendiri di branch `galent` dan menggabungkan fitur dari semua anggota ke `branch-dev`.

#### Langkah 1 — Mengerjakan fitur Galent

Pindah ke branch Galent:

```bash
git switch galent
git pull origin galent
```

Kerjakan fitur yang menjadi tanggung jawab Galent.

Setelah selesai, periksa perubahan:

```bash
git status
git diff
```

Jika sudah benar, simpan perubahan:

```bash
git add .
git commit -m "feat: menambahkan fitur Galent"
```

Kemudian kirim ke GitHub:

```bash
git push origin galent
```

Dengan begitu, fitur Galent sudah tersimpan di branch miliknya.

#### Langkah 2 — Menyiapkan branch-dev

Sebelum menggabungkan fitur anggota, pastikan branch `branch-dev` tersedia.

Jalankan:

```bash
git fetch origin
git branch -a
```

Jika `branch-dev` sudah tersedia secara lokal, jalankan:

```bash
git switch branch-dev
git pull origin branch-dev
```

Jika branch tersebut baru tersedia di GitHub, jalankan:

```bash
git switch --track origin/branch-dev
```

#### Langkah 3 — Menggabungkan kode Anin

Pastikan branch aktif adalah `branch-dev`.

Jalankan:

```bash
git switch branch-dev
git fetch origin
git merge origin/anin
```

Setelah merge berhasil, jalankan aplikasi dan periksa fitur Anin.

Jika sudah benar, kirim hasil integrasi ke GitHub:

```bash
git push origin branch-dev
```

#### Langkah 4 — Menggabungkan kode Shofi

Masih di `branch-dev`, jalankan:

```bash
git fetch origin
git merge origin/shofi
```

Uji kembali aplikasi untuk memastikan fitur Shofi berjalan dengan baik.

Jika tidak ada masalah, kirim pembaruan:

```bash
git push origin branch-dev
```

#### Langkah 5 — Menggabungkan fitur Galent

Setelah fitur Galent selesai dan sudah di-push ke GitHub, jalankan:

```bash
git switch branch-dev
git pull origin branch-dev
git fetch origin
git merge origin/galent
```

Uji kembali aplikasi. Jika semua berjalan dengan baik, jalankan:

```bash
git push origin branch-dev
```

### 7. Cara Mengatasi Merge Conflict

Merge conflict terjadi ketika Git menemukan perubahan yang bertentangan pada bagian kode yang sama sehingga tidak bisa menggabungkannya secara otomatis.

Contoh penanda konflik:

```text
<<<<<<< HEAD
Kode dari branch-dev
=======
Kode dari branch anggota
>>>>>>> origin/anin
```

Cara menyelesaikannya:

1. Buka file yang mengalami konflik di Antigravity.
2. Periksa kode dari kedua versi.
3. Pilih atau gabungkan kode yang benar.
4. Hapus penanda `<<<<<<<`, `=======`, dan `>>>>>>>`.
5. Simpan file.
6. Periksa kembali kondisi Git.

Jalankan:

```bash
git add .
git status
```

Jika Git masih meminta penyelesaian merge dengan commit, jalankan:

```bash
git commit -m "fix: menyelesaikan merge conflict"
```

Setelah itu, jalankan aplikasi untuk memastikan tidak ada bagian yang rusak.

Jika konflik terjadi di `branch-dev` dan pengujian berhasil, kirim hasilnya:

```bash
git push origin branch-dev
```

Jika ingin membatalkan merge yang masih berlangsung dan belum selesai, gunakan:

```bash
git merge --abort
```

Perintah tersebut tidak digunakan jika merge sudah selesai. Sebelum menyelesaikan konflik, pastikan kode yang diperlukan tidak terhapus.

### 8. Cara Anin dan Shofi Mengambil Pembaruan

Setelah Galent mengirim perubahan ke `branch-dev`, Anin dan Shofi dapat mengambil pembaruan tersebut ke branch masing-masing.

Anin menjalankan:

```bash
git switch anin
git fetch origin
git merge origin/branch-dev
```

Shofi menjalankan:

```bash
git switch shofi
git fetch origin
git merge origin/branch-dev
```

Setelah merge selesai, periksa apakah fitur masing-masing masih berjalan dengan baik.

Jika hasilnya sudah benar dan ingin mengirim pembaruan ke GitHub, Anin menjalankan:

```bash
git push origin anin
```

Shofi menjalankan:

```bash
git push origin shofi
```

Langkah ini membantu setiap anggota memperoleh pembaruan terbaru dari `branch-dev`.

### 9. Kondisi yang Mungkin Terjadi

#### A. Kode belum muncul di GitHub

Pastikan perubahan sudah di-commit dan di-push. Perubahan yang hanya tersimpan di komputer belum dapat diambil oleh anggota lain.

Periksa kondisi Git dengan:

```bash
git status
git log -5 --oneline
```

#### B. Muncul pesan `Already up to date`

Artinya tidak ada commit baru yang perlu digabungkan dari sumber yang diperiksa.

Pesan tersebut tidak selalu berarti seluruh file di kedua branch identik.

#### C. Ingin membatalkan commit yang salah

Jika commit sudah dibagikan kepada anggota lain, gunakan `git revert` untuk membuat commit pembatalan tanpa menghapus riwayat sebelumnya.

Periksa commit yang akan dibatalkan terlebih dahulu.

#### D. Membuat branch fitur baru

Jika ingin membuat branch fitur baru berdasarkan `branch-dev` terbaru, jalankan:

```bash
git switch branch-dev
git pull origin branch-dev
git switch -c nama-fitur
git push -u origin nama-fitur
```

Ganti `nama-fitur` dengan nama branch yang diinginkan.

#### E. Menghapus branch

Untuk menghapus branch lokal yang sudah tidak digunakan:

```bash
git branch -d nama-branch
```

Untuk menghapus branch di GitHub:

```bash
git push origin --delete nama-branch
```

Pastikan pekerjaan sudah aman dan anggota tim menyetujui penghapusan branch remote.

### 10. Menjalankan dan Menguji Aplikasi

Setelah fitur digabungkan ke `branch-dev`, Galent perlu menguji aplikasi secara menyeluruh.

Pastikan berada di branch yang benar:

```bash
git switch branch-dev
git pull origin branch-dev
git branch --show-current
```

Hasil perintah terakhir seharusnya:

```text
branch-dev
```

Jika proyek menggunakan Laravel, jalankan:

```bash
php artisan serve
```

Buka alamat yang ditampilkan di terminal, kemudian periksa seluruh fitur yang telah digabungkan.

Pengujian mencakup halaman yang bisa dibuka, tombol yang berfungsi, proses penyimpanan data, dan fitur lain yang dikembangkan oleh anggota kelompok.

Setelah integrasi dan pengujian disetujui tim, perubahan dapat diteruskan ke `main`.

### 11. Aturan Penting untuk Semua Anggota

1. Periksa branch aktif sebelum melakukan perubahan.
2. Ambil pembaruan terbaru sebelum mulai coding.
3. Gunakan pesan commit yang jelas.
4. Push kode ke branch masing-masing.
5. Gunakan `branch-dev` sebagai tempat integrasi.
6. Uji hasil merge sebelum diteruskan ke `main`.
7. Jangan menggunakan force push pada branch bersama tanpa persetujuan.
8. Jangan menggunakan `git reset --hard` jika belum memahami dampaknya.
9. Jangan mengunggah file `.env`, password, token, atau data rahasia ke GitHub.
10. Baca `docs/database.md` sebelum mengembangkan fitur database.
11. Koordinasikan perubahan jika beberapa anggota mengerjakan file yang sama.
12. Periksa `git status` sebelum commit dan push.
13. Jangan melakukan merge jika masih ada perubahan lokal yang belum diamankan.
14. Jika terjadi konflik, diskusikan dengan anggota yang mengerjakan fitur terkait sebelum memilih kode.

### 12. Ringkasan Alur Kerja

**Untuk Anin dan Shofi:**

Coding di branch masing-masing → periksa perubahan → commit → push ke GitHub → menunggu integrasi Galent → mengambil pembaruan dari `branch-dev`.

**Untuk Galent:**

Mengerjakan fitur Galent di branch `galent` → commit → push → berpindah ke `branch-dev` → menggabungkan branch Anin, Shofi, dan Galent satu per satu → menguji aplikasi → push hasil integrasi ke GitHub.

**Alur akhir proyek:**

`main` sebagai versi utama proyek → `branch-dev` sebagai tempat integrasi → branch masing-masing anggota untuk coding → commit dan push → penggabungan oleh Galent ke `branch-dev` → pengujian → masuk ke `main` setelah disetujui tim.

Dokumen ini menjadi pedoman bersama agar pengembangan proyek WEB-TA lebih teratur, perubahan kode mudah dilacak, dan pekerjaan setiap anggota dapat digabungkan dengan aman.