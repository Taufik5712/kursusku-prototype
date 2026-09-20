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
