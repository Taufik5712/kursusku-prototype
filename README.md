# KursusKu - Prototype Proyek Pemrograman Web III

Proyek semester berbasis PHP + HTML yang dibangun bertahap setiap pertemuan.
Dijalankan melalui Laragon pada `C:\laragon\www\kursusku-prototype`.

## Struktur Proyek

```
kursusku-prototype/
|-- index.php                  # Landing page + katalog data-driven (Milestone 2 & 4)
|-- fee-calculator.php         # Kalkulator estimasi biaya (Milestone 3)
|-- helpers.php                # Function reusable Milestone 4 + Milestone 6
|-- data-courses.php           # Array 6 kursus untuk katalog (Milestone 4)
|-- test-functions.php         # 6 test sederhana (Milestone 4)
|-- registration.php           # Form pendaftaran v1, 8 kontrol (Milestone 5, arsip)
|-- process-registration.php   # Proses form v1 (Milestone 5, arsip)
|-- data.php                   # Array courses ringkas, interestOptions, facilities (Milestone 6)
|-- register.php               # Form pendaftaran lanjutan: radio/checkbox/select/textarea (Milestone 6)
|-- process.php                # Validasi + percabangan diskon + switch + ringkasan (Milestone 6)
|-- history.php                # Data dummy ditampilkan dengan foreach (Milestone 6)
|-- loop-lab.php               # Latihan for, while, do-while (Milestone 6)
|-- server-time.php            # Bukti PHP diproses server
|-- README.md
|-- assets/
|   |-- css/
|   |   |-- style.css            # CSS global: navbar, form, card, button, alert
|   |   |-- home.css             # Khusus index.php: hero, keunggulan, katalog, media
|   |   |-- fee-calculator.css   # Khusus fee-calculator.php
|   |   |-- test-functions.css   # Khusus test-functions.php
|   |   `-- week6.css            # Khusus register/process (form, ringkasan, error)/history/loop-lab.php
|   |-- images/hero-kursus.jpg
|   `-- video/intro-kursus.mp4
`-- evidence/
    |-- week-02/
    |-- week-03/
    |-- week-04/
    |-- week-05/
    `-- week-06/                # README.txt, test-matrix.txt, refleksi.txt, ai-usage-log.txt + 6 screenshot
```

> Catatan: `registration.php` & `process-registration.php` (Milestone 5) tidak
> dihapus - tetap tersimpan sebagai arsip/evidence lama. Alur pendaftaran yang
> AKTIF di navigasi utama sejak Milestone 6 adalah `register.php` -> `process.php`,
> karena versi ini sudah mencakup validasi, perhitungan diskon, dan percabangan.

## Milestone 2 - Landing Page (Pertemuan 2)

Halaman publik `index.php` dengan HTML semantik: header + navigasi, hero
(satu `h1`), section keunggulan, katalog, alur pendaftaran, media
(gambar + video + external link), kontak, dan footer.

Tiga nilai PHP yang dipakai ulang di halaman:

| Variabel     | Contoh nilai                                          |
|--------------|-------------------------------------------------------|
| `$siteName`  | `KursusKu`                                            |
| `$tagline`   | `Belajar, daftar, dan kelola kursus dalam satu tempat.` |
| `$year`      | hasil `date('Y')`                                     |

## Milestone 3 - Rumus Biaya (Pertemuan 3)

```
subtotal = fee x participantCount
discount = subtotal x discountPercent / 100
total    = subtotal - discount + adminFee
```

Catatan:

- Semua nilai uang disimpan sebagai **integer** rupiah (`350000`, bukan `350000.00`).
- Pembagian diskon memakai `intdiv()` agar hasilnya tetap integer.
- `number_format()` hanya dipakai pada bagian **output**, tidak pada perhitungan.
- Biaya admin ditambahkan **setelah** diskon, sesuai aturan bisnis yang ditetapkan.
- Nilai masih hard-code pada Pertemuan 3. Input dari form ditambahkan pada pertemuan berikutnya.

### Variabel yang digunakan

| Variabel            | Tipe   | Makna bisnis                  |
|---------------------|--------|-------------------------------|
| `$courseName`       | string | Nama kursus                   |
| `$fee`              | int    | Biaya per peserta (rupiah)    |
| `$participantCount` | int    | Jumlah peserta                |
| `$discountPercent`  | int    | Persentase diskon             |
| `$adminFee`         | int    | Biaya administrasi (rupiah)   |
| `$isActive`         | bool   | Status kursus aktif/nonaktif  |

`$fee` dan `$participantCount` adalah variabel input dasar, sedangkan
`$subtotal`, `$discount`, dan `$total` adalah variabel hasil proses.

### Contoh perhitungan default

| Komponen          | Nilai        | Perhitungan                     |
|-------------------|--------------|---------------------------------|
| Biaya per peserta | Rp 350.000   | -                               |
| Jumlah peserta    | 2            | -                               |
| Subtotal          | Rp 700.000   | 350.000 x 2                     |
| Diskon 10%        | Rp 70.000    | 700.000 x 10 / 100              |
| Biaya admin       | Rp 25.000    | ditambahkan setelah diskon      |
| **Total akhir**   | **Rp 655.000** | 700.000 - 70.000 + 25.000     |

### Matriks Test Case

| No | Fee       | Peserta | Diskon | Admin  | Expected Total | Status |
|----|-----------|---------|--------|--------|----------------|--------|
| 1  | 350.000   | 1       | 0%     | 25.000 | 375.000        | PASS   |
| 2  | 350.000   | 1       | 10%    | 25.000 | 340.000        | PASS   |
| 3  | 350.000   | 2       | 25%    | 25.000 | 550.000        | PASS   |
| 4  | 0         | 1       | 10%    | 0      | 0              | PASS   |
| 5  | 2.500.000 | 3       | 10%    | 50.000 | 6.800.000      | PASS   |

Test case 1 menguji batas diskon 0%, test case 4 menguji nilai biaya 0,
dan test case 5 menguji angka besar.

## Cara Menjalankan

1. Letakkan folder proyek di `C:\laragon\www\kursusku-prototype`.
2. Jalankan Laragon dan pastikan layanan web server aktif.
3. Buka `http://kursusku-prototype.test` atau `http://localhost/kursusku-prototype/`.
4. Dari beranda, klik **Lihat Estimasi Biaya** untuk membuka kalkulator.

## Milestone 4 - Katalog Data-Driven (Pertemuan 4)

Katalog yang sebelumnya ditulis statis satu per satu kini dibangun dari array PHP
(`data-courses.php`) dan dirender ke tabel HTML dengan `foreach`. Seluruh
pengolahan nilai dipusatkan di `helpers.php` agar tidak ada rumus yang disalin
berulang di dalam HTML.

### Empat function reusable (`helpers.php`)

| Function                              | Input             | Output          | Tujuan                                  |
|---------------------------------------|-------------------|-----------------|-----------------------------------------|
| `rupiah(int $amount)`                 | `250000`          | `Rp 250.000`    | Menghindari format uang berulang        |
| `statusKursus(int $quota, int $reg)`  | `25, 25`          | `Penuh`         | Memusatkan aturan status                |
| `sisaKursi(int $quota, int $reg)`     | `20, 0`           | `20`            | Menghitung kapasitas tersisa (tidak negatif) |
| `formatTanggal(string $date)`         | `2026-09-15`      | `15-09-2026`    | Memisahkan format simpan dan format tampil |

Catatan:

- `statusKursus()` memakai `>=` sehingga kursus dianggap penuh ketika pendaftar
  sama dengan **atau** melebihi quota.
- `sisaKursi()` memakai `max(0, ...)` agar sisa kursi tidak pernah negatif.
- `formatTanggal()` memisahkan **nilai sumber** (`2026-09-15`, mudah diurutkan)
  dari **nilai tampilan** (`15-09-2026`, familiar untuk pembaca lokal).
- `helpers.php` tidak menghasilkan output apa pun ketika hanya di-include.

### Struktur data kursus

Setiap record memakai enam key yang sama: `code`, `name`, `fee`, `quota`,
`registered`, `start_date`.

| Kode   | Nama Kursus         | Biaya   | Quota | Terdaftar | Mulai      | Kondisi yang diuji |
|--------|---------------------|---------|-------|-----------|------------|--------------------|
| WEB-01 | Web Dasar           | 200.000 | 30    | 12        | 2026-09-21 | Tersedia           |
| PHP-01 | PHP Dasar           | 250.000 | 30    | 18        | 2026-09-22 | Tersedia           |
| PHP-02 | PHP Lanjutan        | 300.000 | 25    | 24        | 2026-09-24 | Hampir penuh (sisa 1) |
| LAR-01 | Laravel Fundamental | 350.000 | 25    | 25        | 2026-09-28 | Penuh (sisa 0)     |
| DB-01  | MySQL Dasar         | 275.000 | 20    | 0         | 2026-10-01 | Kosong (sisa 20)   |
| UI-01  | UI Web Dasar        | 225.000 | 35    | 9         | 2026-10-03 | Uji `trim()` pada nama |

Nama `UI-01` sengaja disimpan dengan spasi di awal dan akhir untuk membuktikan
kegunaan `trim()` saat dirender.

### Enam test function (`test-functions.php`)

| No | Pemanggilan                    | Expected     |
|----|--------------------------------|--------------|
| 1  | `rupiah(250000)`               | `Rp 250.000` |
| 2  | `statusKursus(25, 25)`         | `Penuh`      |
| 3  | `statusKursus(30, 29)`         | `Tersedia`   |
| 4  | `sisaKursi(20, 0)`             | `20`         |
| 5  | `sisaKursi(25, 25)`            | `0`          |
| 6  | `formatTanggal('2026-09-15')`  | `15-09-2026` |

Perbandingan memakai `===` agar nilai sekaligus tipe data ikut diperiksa.

### Pengujian manual katalog

| No | Skenario                    | Yang diperiksa                  |
|----|-----------------------------|---------------------------------|
| 1  | quota 25, registered 25     | Status Penuh, sisa 0            |
| 2  | quota 25, registered 24     | Status Tersedia, sisa 1         |
| 3  | quota 20, registered 0      | Status Tersedia, sisa 20        |
| 4  | fee 350000                  | Tampil `Rp 350.000`             |
| 5  | tanggal 2026-10-01          | Tampil `01-10-2026`             |
| 6  | nama berisi spasi luar      | `trim()` membersihkan spasi     |

## Milestone 5 - Form Pendaftaran, CSS, GET/POST (Pertemuan 5)

Alur navigasi: **Landing (index.php) → Katalog (#katalog) → Daftar (registration.php)
→ Hasil (process-registration.php)**.

### Delapan jenis kontrol form pada `registration.php`

| No | Kontrol   | Field                          |
|----|-----------|---------------------------------|
| 1  | Text      | Nama Lengkap, Program Studi     |
| 2  | Email     | Email peserta                   |
| 3  | Tel       | Nomor HP                        |
| 4  | Select    | Kursus yang dipilih             |
| 5  | Radio     | Jenis peserta (Mahasiswa/Umum)  |
| 6  | Checkbox  | Minat tambahan (bisa lebih dari satu, `name="interests[]"`) |
| 7  | Textarea  | Catatan                         |
| 8  | Hidden    | Sumber form (`source=week-05`)  |

### Method: kenapa POST, bukan GET

Method akhir yang dipakai adalah **POST** karena form ini mengirim data pendaftaran
(mengubah/membuat data), bukan sekadar pencarian atau filter. Saat method sementara
diubah ke GET untuk eksperimen, seluruh isi form muncul sebagai query string di URL
(`process-registration.php?source=week-05&name=...`) — itulah bedanya dengan POST,
yang tidak menampilkan data pada URL.

### Alur data POST (`process-registration.php`)

```
$_POST['name']  ->  trim()  ->  disimpan ke $name  ->  di-escape lewat e()  ->  dicetak ke HTML
```

- `trim()` membersihkan spasi di awal/akhir sebelum data dipakai.
- `implode(', ', $interests)` menggabungkan array checkbox menjadi satu teks.
- Fungsi `e()` (escaping dengan `htmlspecialchars`) dipakai pada **setiap** nilai
  sebelum ditampilkan, supaya karakter khusus dari input pengguna tidak merusak HTML.
- File ini belum menyimpan data ke database — hanya membaca dan menampilkan kembali.

### CSS (`assets/css/style.css`)

CSS global dipakai bersama oleh `index.php`, `registration.php`, dan
`process-registration.php` supaya warna, navbar, card, form, dan tombol konsisten
di seluruh proyek. Responsif diuji pada lebar sekitar 360px: layout dua kolom pada
form otomatis menjadi satu kolom lewat media query `@media (max-width: 640px)`.

### Local Development vs Hosting

| Aspek        | Local (Laragon)            | Hosting / Production          |
|--------------|-----------------------------|--------------------------------|
| URL          | kursusku-prototype.test     | Domain/subdomain publik        |
| Database     | MySQL lokal                 | Database server hosting        |
| HTTPS        | Tidak selalu ada             | Seharusnya aktif               |
| Debug        | Boleh ditampilkan            | Detail error sensitif disembunyikan |
| Secret       | Disimpan lokal                | Disimpan sebagai konfigurasi server |

Tabel lengkap dan catatan proyek ada di `evidence/week-05/local-vs-hosting.txt`.

### Pengujian wajib

Lihat `evidence/week-05/test-matrix.txt` untuk 12 skenario pengujian (form kosong,
validasi email, GET vs POST, checkbox, mobile, navigasi, dll).

## Pemisahan CSS (tidak lagi inline)

Seluruh CSS dipindahkan keluar dari tag `<style>` di dalam file PHP dan disimpan
sebagai file terpisah di `assets/css/`. Setiap halaman PHP kini hanya berisi
struktur HTML dan logika PHP, dihubungkan ke CSS-nya lewat `<link rel="stylesheet">`:

| Halaman PHP              | File CSS                          |
|---------------------------|-----------------------------------|
| Semua halaman (global)    | `assets/css/style.css`            |
| `index.php`                | + `assets/css/home.css`          |
| `registration.php`         | `assets/css/style.css`            |
| `process-registration.php` | `assets/css/style.css`            |
| `fee-calculator.php`       | `assets/css/fee-calculator.css`   |
| `test-functions.php`       | `assets/css/test-functions.css`   |

`style.css` berisi aturan global (navbar, container, form, card, button, alert)
yang dipakai lebih dari satu halaman. `home.css`, `fee-calculator.css`, dan
`test-functions.css` masing-masing hanya dipakai satu halaman, sehingga tidak
ikut di-load oleh halaman lain yang tidak membutuhkannya.

## Milestone 6 - Percabangan, Looping, Form Lanjutan (Pertemuan 6)

User flow lengkap tanpa database:
```
index.php -> register.php -> process.php -> (ringkasan) -> history.php
```

### Percabangan (branching)

`getDiscountPercent()` di `helpers.php` memakai **if/elseif**:

```php
if ($participantType === 'mahasiswa')      { return 20; }
elseif ($participantType === 'guru')       { return 15; }
return 0; // umum / jalur default
```

`getLearningModeLabel()` memakai **switch**, karena satu variabel
(`$learningMode`) dibandingkan dengan beberapa nilai yang sudah diketahui
pasti (`offline`/`online`/`hybrid`) - beda kasus dengan diskon yang hanya
dua kondisi bertingkat sebelum default.

Di `process.php`, jika `$errors` tidak kosong, halaman error ditampilkan
dan `exit` dipanggil - proses perhitungan biaya **tidak dilanjutkan** dengan
data yang belum valid.

### Looping

| Loop       | Dipakai di                                  | Alasan                              |
|------------|-----------------------------------------------|--------------------------------------|
| `foreach`  | opsi kursus, checkbox minat, daftar fasilitas, error list, minat pada ringkasan, tabel history | Membaca seluruh isi array            |
| `for`      | opsi jumlah paket (1-3) di `register.php`      | Jumlah iterasi sudah diketahui       |
| `while`    | `loop-lab.php`                                 | Kondisi dicek sebelum blok dijalankan |
| `do-while` | `loop-lab.php`                                 | Proses minimal harus berjalan sekali |

### Form lanjutan

| Kontrol   | Field              | Catatan                                            |
|-----------|--------------------|------------------------------------------------------|
| Radio     | `participant_type` | Satu `name` yang sama → hanya satu nilai terkirim     |
| Checkbox  | `interests[]`      | Tanda `[]` → PHP menerima sebagai array               |
| Select    | `course_code`, `learning_mode`, `package_count` | `course_code` & `package_count` dirender dari array/loop |
| Textarea  | `notes`            | Opsional, `maxlength="300"`                           |

### Validasi fundamental di `process.php`

- Method bukan POST → `header('Location: register.php')` lalu `exit`.
- `$_POST['interests'] ?? []` mencegah warning *Undefined array key* saat
  tidak ada checkbox dicentang.
- `array_intersect($interests, $allowedInterestKeys)` membuang nilai checkbox
  yang tidak dikenal.
- `filter_var($email, FILTER_VALIDATE_EMAIL)` untuk validasi format email.
- `findCourse()` mencari record kursus lewat `foreach` + `return` di helpers.php.
- Ini **validasi fundamental**, bukan pengganti validasi Laravel yang lengkap
  (dipelajari setelah pindah ke framework pada Pertemuan 7).

### Contoh perhitungan (dicocokkan dengan test matrix panduan)

| Kursus       | Tipe       | Paket | Subtotal  | Diskon | Total      |
|--------------|------------|-------|-----------|--------|------------|
| Web Dasar    | Mahasiswa  | 1     | 300.000   | 20%    | Rp240.000  |
| PHP Dasar    | Guru       | 1     | 400.000   | 15%    | Rp340.000  |
| Laravel Dasar| Umum       | 1     | 500.000   | 0%     | Rp500.000  |
| Web Dasar    | Mahasiswa  | 2     | 600.000   | 20%    | Rp480.000  |

Keempatnya sudah diverifikasi cocok dengan logika `process.php`.

### Mengapa belum pakai database

Pertemuan 6 masih fase PHP fundamental. `history.php` sengaja memakai array
dummy (`$history`), bukan data nyata - latihan `foreach` sebagai jembatan
sebelum data sungguhan dari MySQL dipelajari pada fase Laravel (Pertemuan 7+).

### Pengujian wajib

12 skenario ada di `evidence/week-06/test-matrix.txt` (perhitungan total,
validasi nama/email, minat kosong, 3 minat sekaligus, label metode belajar,
akses GET langsung ke `process.php`, penambahan fasilitas baru).
