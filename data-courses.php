<?php
/**
 * data-courses.php - Sumber data katalog KursusKu (Milestone 4)
 *
 * Array ini menjadi sumber data sementara sebelum database MySQL dipelajari.
 * Setiap record WAJIB memakai enam key yang sama:
 * code, name, fee, quota, registered, start_date
 *
 * Catatan:
 * - fee disimpan sebagai integer rupiah (250000), bukan teks berformat.
 * - start_date disimpan dalam format sumber YYYY-MM-DD agar konsisten.
 * - Nama kursus 'UI Web Dasar' sengaja diberi spasi di awal/akhir
 *   sebagai bahan pembuktian kegunaan trim() saat dirender.
 */

$courses = [
    [
        'code'       => 'WEB-01',
        'name'       => 'Web Dasar',
        'fee'        => 200000,
        'quota'      => 30,
        'registered' => 12,
        'start_date' => '2026-09-21',
    ],
    [
        'code'       => 'PHP-01',
        'name'       => 'PHP Dasar',
        'fee'        => 250000,
        'quota'      => 30,
        'registered' => 18,
        'start_date' => '2026-09-22',
    ],
    [
        'code'       => 'PHP-02',
        'name'       => 'PHP Lanjutan',
        'fee'        => 300000,
        'quota'      => 25,
        'registered' => 24,   // hampir penuh -> sisa 1
        'start_date' => '2026-09-24',
    ],
    [
        'code'       => 'LAR-01',
        'name'       => 'Laravel Fundamental',
        'fee'        => 350000,
        'quota'      => 25,
        'registered' => 25,   // penuh -> sisa 0
        'start_date' => '2026-09-28',
    ],
    [
        'code'       => 'DB-01',
        'name'       => 'MySQL Dasar',
        'fee'        => 275000,
        'quota'      => 20,
        'registered' => 0,    // kosong -> sisa 20
        'start_date' => '2026-10-01',
    ],
    [
        'code'       => 'UI-01',
        'name'       => '  UI Web Dasar  ',
        'fee'        => 225000,
        'quota'      => 35,
        'registered' => 9,
        'start_date' => '2026-10-03',
    ],
];
