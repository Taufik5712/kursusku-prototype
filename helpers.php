<?php
/**
 * helpers.php - Kumpulan function reusable KursusKu (Milestone 4)
 * Pemrograman Web III - Sub-CPMK3: function, string, date/time, logika
 *
 * Aturan file ini:
 * - Hanya berisi definisi function, TIDAK menghasilkan output sendiri saat di-include.
 * - Function perhitungan mengembalikan nilai (return), tidak mencetak HTML langsung,
 *   supaya mudah digunakan ulang dan mudah diuji.
 */

/**
 * Mengubah angka rupiah menjadi teks siap tampil.
 * Contoh: 250000  ->  "Rp 250.000"
 */
function rupiah(int $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

/**
 * Menentukan status kursus berdasarkan kapasitas.
 * Memakai operator >= : kursus dianggap penuh jika pendaftar
 * sama dengan ATAU melebihi quota.
 */
function statusKursus(int $quota, int $registered): string
{
    return $registered >= $quota ? 'Penuh' : 'Tersedia';
}

/**
 * Menghitung sisa kursi yang masih tersedia.
 * max(0, ...) mencegah hasil negatif bila pendaftar melebihi quota.
 */
function sisaKursi(int $quota, int $registered): int
{
    return max(0, $quota - $registered);
}

/**
 * Mengubah tanggal sumber (YYYY-MM-DD) menjadi format tampilan (DD-MM-YYYY).
 * Nilai sumber disimpan konsisten agar mudah diurutkan; format tampilan
 * hanya dipakai saat ditampilkan ke pengguna.
 */
function formatTanggal(string $date): string
{
    $value = new DateTimeImmutable($date);
    return $value->format('d-m-Y');
}

/* ======================================================================
 * Fungsi tambahan Pertemuan 6 (percabangan, looping, form lanjutan)
 * ====================================================================== */

/**
 * Escaping output - dipakai pada SETIAP nilai dari pengguna sebelum dicetak
 * ke HTML, supaya karakter khusus tidak merusak halaman (konsep dari
 * Pertemuan 5, dipakai ulang di sini dengan nama pendek e()).
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Format rupiah versi Pertemuan 6 (tanpa spasi setelah "Rp").
 * Dipakai oleh register.php, process.php, dan history.php.
 * Catatan: ini sengaja terpisah dari rupiah() di atas (dipakai index.php
 * & fee-calculator.php sejak Pertemuan 3-4) supaya kode pertemuan lama
 * tidak ikut berubah tampilannya.
 */
function formatRupiah(int $amount): string
{
    return 'Rp' . number_format($amount, 0, ',', '.');
}

/**
 * Mencari satu record kursus berdasarkan code.
 * Melatih foreach + return di dalam function: begitu ditemukan, function
 * langsung berhenti dan mengembalikan record itu. Jika loop habis tanpa
 * ditemukan, mengembalikan null (nullable return type: ?array).
 */
function findCourse(array $courses, string $code): ?array
{
    foreach ($courses as $course) {
        if ($course['code'] === $code) {
            return $course;
        }
    }

    return null;
}

/**
 * Menentukan persentase diskon berdasarkan tipe peserta (percabangan if/elseif).
 * Mahasiswa 20%, guru 15%, selain itu (umum) 0% - jalur default tanpa elseif
 * tambahan, ditangani oleh return di akhir function.
 */
function getDiscountPercent(string $participantType): int
{
    if ($participantType === 'mahasiswa') {
        return 20;
    } elseif ($participantType === 'guru') {
        return 15;
    }

    return 0;
}

/**
 * Mengubah kode metode belajar menjadi label yang mudah dibaca (switch).
 * switch dipilih di sini karena satu variabel dibandingkan dengan beberapa
 * nilai yang sudah diketahui pasti (offline/online/hybrid) - berbeda dengan
 * getDiscountPercent() yang memakai if/elseif karena hanya dua kondisi
 * bertingkat sebelum jalur default.
 */
function getLearningModeLabel(string $mode): string
{
    switch ($mode) {
        case 'offline':
            return 'Tatap Muka';

        case 'online':
            return 'Online';

        case 'hybrid':
            return 'Hybrid';

        default:
            return 'Tidak diketahui';
    }
}
