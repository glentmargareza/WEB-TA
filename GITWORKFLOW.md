\# Git Workflow — WEB-TA



> \*\*Alur kerja:\*\* Setiap anggota memiliki branch masing-masing. Semua perubahan fitur dikumpulkan dan diintegrasikan ke `branch-dev` oleh integrator (Galent). Konflik diselesaikan di `branch-dev` agar pekerjaan anggota lain tidak terganggu.



\---



\## Tim \& Branch



| User | Branch | Peran |

|---|---|---|

| Galent | `galent-fitur-data-master` dan `branch-dev` | Integrator dan developer fitur data master |

| Anin | `anin` | Developer |

| Shofi | `shofi` | Developer |

| Semua anggota | `main` | Versi utama project yang stabil |



\*\*Repository:\*\* https://github.com/glentmargareza/WEB-TA



> Nama branch harus sesuai dengan branch yang benar-benar tersedia di GitHub.



\---



\## 1. Setup Awal



\### Clone Repository (sekali saja)



```bash

git clone https://github.com/glentmargareza/WEB-TA.git

cd WEB-TA

```



\### Ambil Informasi Branch



```bash

git fetch --all

git branch -a

```



\### Checkout Branch Masing-Masing



Galent:



```bash

git switch galent-fitur-data-master

```



Anin:



```bash

git switch anin

```



Shofi:



```bash

git switch shofi

```



Jika branch lokal belum ada, tetapi branch remote sudah tersedia:



```bash

git switch --track origin/nama-branch

```



\### Membuat Branch Integrasi



Jika `branch-dev` belum tersedia di GitHub, Galent dapat membuatnya dari `main`:



```bash

git switch main

git pull origin main

git switch -c branch-dev

git push -u origin branch-dev

```



Jika `branch-dev` sudah tersedia, gunakan:



```bash

git fetch origin

git switch --track origin/branch-dev

```



\---



\## 2. Daily Workflow — Developer (Anin dan Shofi)



\### Sebelum Mulai Bekerja



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



Jika terjadi konflik, selesaikan konflik di branch masing-masing sebelum melanjutkan pekerjaan.



\### Kerja dan Commit



Setelah mengubah kode:



```bash

git status

git diff

```



Tambahkan file yang diperlukan:



```bash

git add nama-file

git commit -m "feat: deskripsi fitur"

```



\### Push ke GitHub



Anin:



```bash

git push origin anin

```



Shofi:



```bash

git push origin shofi

```



\---



\## 3. Alur Integrasi — Galent



> Galent bertugas menggabungkan perubahan dari branch anggota ke `branch-dev`. Branch `galent-fitur-data-master` tetap digunakan untuk pengembangan fitur pribadi.



\### Ambil Perubahan Terbaru



```bash

git fetch --all

git switch branch-dev

git pull origin branch-dev

```



\### Merge Branch Anin



```bash

git merge origin/anin

```



Jika tidak ada konflik, uji hasil integrasi lalu push:



```bash

git push origin branch-dev

```



\### Merge Branch Shofi



```bash

git fetch origin

git merge origin/shofi

```



Jika tidak ada konflik dan hasil pengujian sudah benar:



```bash

git push origin branch-dev

```



\### Merge Fitur Pribadi Galent



Jika fitur pribadi Galent sudah di-commit dan di-push:



```bash

git fetch origin

git switch branch-dev

git pull origin branch-dev

git merge origin/galent-fitur-data-master

```



Setelah memeriksa hasilnya:



```bash

git push origin branch-dev

```



\---



\## 4. Menyelesaikan Merge Conflict



Jika Git menampilkan pesan `CONFLICT`, periksa file yang bermasalah:



```bash

git status

```



Buka file yang konflik di Antigravity. Cari penanda berikut:



```text

<<<<<<< HEAD

Kode dari branch-dev

=======

Kode dari branch yang digabungkan

>>>>>>> origin/anin

```



Pilih atau gabungkan kode yang benar, kemudian hapus semua penanda konflik dan simpan file.



Tandai konflik sebagai selesai:



```bash

git add nama-file

git commit -m "fix: resolve merge conflict"

```



Setelah hasilnya diperiksa:



```bash

git push origin branch-dev

```



Ganti nama file dan branch sesuai konflik yang terjadi.



Jika ingin membatalkan proses merge yang sedang berlangsung sebelum commit merge:



```bash

git merge --abort

```



\---



\## 5. Sinkronisasi Developer



Setelah Galent memperbarui `branch-dev`, Anin dan Shofi dapat mengambil perubahan terbaru.



Anin:



```bash

git switch anin

git fetch origin

git merge origin/branch-dev

```



Shofi:



```bash

git switch shofi

git fetch origin

git merge origin/branch-dev

```



Jika hasilnya sudah benar, push branch masing-masing apabila ada perubahan baru:



```bash

git push origin anin

```



atau:



```bash

git push origin shofi

```



\---



\## 6. Kondisi Khusus



\### A. Developer Belum Push



Galent tidak dapat menggabungkan commit yang hanya tersimpan di komputer anggota.



Solusi:

1\. Anggota melakukan commit.

2\. Anggota melakukan push ke branch sendiri.

3\. Galent menjalankan `git fetch origin`.

4\. Galent menggabungkan branch remote anggota ke `branch-dev`.



\### B. Merge Menampilkan `Already up to date`



Artinya tidak ada commit baru pada branch yang sedang digabungkan dibandingkan dengan branch aktif.



Periksa commit remote:



```bash

git fetch --all

git log --oneline origin/anin -5

```



Ganti `anin` dengan branch yang ingin diperiksa.



\### C. Rollback Perubahan



Jika commit yang salah sudah masuk ke `branch-dev`, gunakan `git revert` untuk membuat commit pembatalan:



```bash

git switch branch-dev

git revert HEAD

git push origin branch-dev

```



Pastikan commit terakhir memang commit yang ingin dibatalkan.



\### D. Membuat Branch Fitur Baru



Buat branch berdasarkan `branch-dev` terbaru:



```bash

git switch branch-dev

git pull origin branch-dev

git switch -c nama-fitur

git push -u origin nama-fitur

```



\### E. Branch Ketinggalan Update



Developer mengambil update terbaru:



```bash

git switch anin

git fetch origin

git merge origin/branch-dev

```



Selesaikan konflik jika ada, uji kode, kemudian push jika diperlukan.



\### F. Menghapus Branch



Branch lokal yang sudah tidak digunakan dapat dihapus setelah memastikan pekerjaannya sudah aman:



```bash

git branch -d nama-branch

```



Untuk menghapus branch remote, pastikan seluruh anggota menyetujui:



```bash

git push origin --delete nama-branch

```



\---



\## 7. Checklist Harian



\### Developer — Anin dan Shofi



\- \[ ] Memastikan branch aktif sudah benar.

\- \[ ] Mengambil perubahan terbaru dari branch sendiri.

\- \[ ] Menggabungkan update `branch-dev`.

\- \[ ] Menguji perubahan sebelum commit.

\- \[ ] Menggunakan pesan commit yang jelas.

\- \[ ] Push perubahan ke branch sendiri.



\### Integrator — Galent



\- \[ ] Menjalankan `git fetch --all`.

\- \[ ] Memperbarui `branch-dev`.

\- \[ ] Memeriksa branch anggota sebelum merge.

\- \[ ] Menggabungkan branch Anin dan Shofi satu per satu.

\- \[ ] Menggabungkan fitur pribadi jika sudah siap.

\- \[ ] Menyelesaikan konflik jika ada.

\- \[ ] Menguji hasil integrasi.

\- \[ ] Push hasil ke `branch-dev`.

\- \[ ] Mengabari anggota setelah integrasi selesai.



\---



\## 8. Cheat Sheet



\### Developer



```bash

git status

git switch anin

git pull origin anin

git fetch origin

git merge origin/branch-dev

git add nama-file

git commit -m "feat: deskripsi fitur"

git push origin anin

```



Ganti `anin` menjadi `shofi` jika digunakan oleh Shofi.



\### Integrator



```bash

git fetch --all

git switch branch-dev

git pull origin branch-dev

git merge origin/anin

git push origin branch-dev

```



Ulangi untuk `origin/shofi` dan `origin/galent-fitur-data-master` saat ada perubahan baru.



\---



\## 9. Aturan Keamanan



1\. Selalu periksa branch aktif sebelum menjalankan perintah.

2\. Ambil update terbaru sebelum mulai bekerja.

3\. Commit dengan pesan yang jelas.

4\. Push perubahan ke branch masing-masing.

5\. Gunakan `branch-dev` sebagai tempat integrasi.

6\. Uji hasil merge sebelum diteruskan ke `main`.

7\. Jangan melakukan force push pada branch bersama.

8\. Jangan menjalankan `git reset --hard` tanpa memahami dampaknya.

9\. Jangan mengunggah `.env`, password, token, atau kredensial.

10\. Koordinasikan perubahan pada file yang dikerjakan bersama.

11\. Baca `docs/database.md` sebelum mengembangkan fitur yang berkaitan dengan database.

12\. Periksa `git status` sebelum commit dan push.



\---



\## 10. Alur Kerja Keseluruhan



`main` → `branch-dev` → branch fitur masing-masing → commit dan push → integrator menggabungkan ke `branch-dev` → pengujian → integrasi ke `main` setelah disetujui.



Dokumen ini menjadi pedoman kerja Git dan GitHub untuk seluruh anggota tim WEB-TA.

