<?php
/**
 * data.php - Sumber data untuk alur pendaftaran Pertemuan 6
 * (register.php -> process.php)
 *
 * Catatan: ini berbeda dari data-courses.php (dipakai katalog di index.php,
 * yang menyimpan quota/registered/start_date). File ini khusus untuk form
 * pendaftaran lanjutan: hanya kode, nama, dan biaya dasar per kursus.
 */

$courses = [
    [
        'code' => 'web',
        'name' => 'Web Dasar',
        'fee'  => 300000,
    ],
    [
        'code' => 'php',
        'name' => 'PHP Dasar',
        'fee'  => 400000,
    ],
    [
        'code' => 'laravel',
        'name' => 'Laravel Dasar',
        'fee'  => 500000,
    ],
];

// key = value yang dikirim checkbox, value = label yang ditampilkan
$interestOptions = [
    'frontend' => 'Frontend',
    'backend'  => 'Backend',
    'database' => 'Database',
    'uiux'     => 'UI/UX',
];

$facilities = [
    'Modul digital',
    'Sertifikat penyelesaian',
    'Forum diskusi kelas',
];
