<?php
/**
 * test-matrix.php - Test Matrix Pertemuan 6
 * Menampilkan skenario pengujian dengan looping foreach.
 * Status dihitung otomatis: PASS jika actual sama dengan expected.
 */

require __DIR__ . '/helpers.php';

$matrix = [
    ['scenario' => 'Mahasiswa, Web Dasar, 1 paket',  'actual' => 'Rp 240.000',                    'expected' => 'Rp 240.000'],
    ['scenario' => 'Guru, PHP Dasar, 1 paket',       'actual' => 'Rp 340.000',                    'expected' => 'Rp 340.000'],
    ['scenario' => 'Umum, Laravel Dasar, 1 paket',   'actual' => 'Rp 500.000',                    'expected' => 'Rp 500.000'],
    ['scenario' => 'Mahasiswa, Web Dasar, 2 paket',  'actual' => 'Rp 480.000',                    'expected' => 'Rp 480.000'],
    ['scenario' => 'Nama kosong',                    'actual' => 'Nama wajib diisi.',             'expected' => 'Nama wajib diisi.'],
    ['scenario' => 'Email tidak valid',              'actual' => 'Email tidak valid.',            'expected' => 'Email tidak valid.'],
    ['scenario' => 'Minat kosong',                   'actual' => 'Belum memilih minat.',          'expected' => 'Belum memilih minat.'],
    ['scenario' => '3 minat',                        'actual' => 'Frontend, Backend, Database',   'expected' => 'Frontend, Backend, Database'],
    ['scenario' => 'Metode offline',                 'actual' => 'Tatap Muka',                    'expected' => 'Tatap Muka'],
    ['scenario' => 'Metode hybrid',                  'actual' => 'Hybrid',                        'expected' => 'Hybrid'],
    ['scenario' => 'GET process.php',                'actual' => 'Redirect ke register.php',      'expected' => 'Redirect ke register.php'],
    ['scenario' => 'Tambah fasilitas',               'actual' => 'Dirender otomatis dengan foreach', 'expected' => 'Dirender otomatis dengan foreach'],
];

$total = count($matrix);
$passed = 0;
foreach ($matrix as $row) {
    if ($row['actual'] === $row['expected']) {
        $passed++;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test Matrix Pertemuan 6 - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/week6.css">
</head>
<body>

<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php"><img class="brand-logo" src="assets/images/logo-kursusku.svg" alt=""><span>KursusKu</span></a>
    <nav aria-label="Navigasi utama">
      <a href="index.php">Beranda</a>
      <a href="index.php#katalog">Katalog</a>
      <a href="register.php">Daftar Kursus</a>
      <a href="history.php">Riwayat</a>
      <a href="test-matrix.php">Test Matrix</a>
    </nav>
  </div>
</header>

<main class="container">

  <section class="page-intro">
    <p class="eyebrow">Evidence Week 06</p>
    <h1>Test Matrix Pertemuan 6</h1>
    <p>Hasil pengujian skenario pendaftaran: perbandingan hasil aktual dengan hasil yang diharapkan.</p>
  </section>

  <div class="matrix-table-wrap">
    <table class="matrix">
      <thead>
        <tr>
          <th class="col-no">No</th>
          <th>Skenario</th>
          <th>Actual</th>
          <th>Expected</th>
          <th class="col-status">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($matrix as $index => $row): ?>
          <?php $isPass = $row['actual'] === $row['expected']; ?>
          <tr>
            <td class="col-no"><?= $index + 1 ?></td>
            <td><?= e($row['scenario']) ?></td>
            <td><?= e($row['actual']) ?></td>
            <td><?= e($row['expected']) ?></td>
            <td class="col-status">
              <span class="badge <?= $isPass ? 'pass' : 'fail' ?>"><?= $isPass ? 'Pass' : 'Fail' ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="4" class="matrix-summary-label">Ringkasan:</td>
          <td class="col-status"><?= $passed ?>/<?= $total ?> Pass</td>
        </tr>
      </tfoot>
    </table>
  </div>

</main>

<footer class="site-footer">
  <small>&copy; <?= date('Y') ?> KursusKu &middot;
    <a href="index.php">Beranda</a> &middot;
    <a href="register.php">Daftar</a> &middot;
    <a href="history.php">Riwayat</a> &middot;
    <a href="test-matrix.php">Test Matrix</a>
  </small>
</footer>

</body>
</html>
