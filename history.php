<?php
/**
 * history.php - Riwayat Pendaftaran (Pertemuan 6)
 * Menampilkan data pendaftaran dengan looping foreach
 */

require __DIR__ . '/helpers.php';

$history = [
    ['name' => 'Alya',      'course' => 'Web Dasar',       'total' => 240000],
    ['name' => 'Bima',      'course' => 'PHP Dasar',       'total' => 340000],
    ['name' => 'Citra',     'course' => 'Laravel Dasar',   'total' => 500000],
    ['name' => 'Dani',      'course' => 'Web Dasar',       'total' => 300000],
    ['name' => 'Eka',       'course' => 'PHP Dasar',       'total' => 400000],
    ['name' => 'Farhan',    'course' => 'Laravel Dasar',   'total' => 425000],
    ['name' => 'Gita',      'course' => 'Web Dasar',       'total' => 480000],
    ['name' => 'Hani',      'course' => 'PHP Dasar',       'total' => 680000],
    ['name' => 'Ivan',      'course' => 'Laravel Dasar',   'total' => 500000],
    ['name' => 'Jelita',    'course' => 'Web Dasar',       'total' => 240000],
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Riwayat Pendaftaran - KursusKu</title>
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
    <p class="eyebrow">Pendaftaran</p>
    <h1>Riwayat Pendaftaran</h1>
    <p>Data pendaftaran peserta kursus yang telah diproses.</p>
  </section>

  <div class="history-table-wrap">
    <table class="history">
      <thead>
        <tr>
          <th style="width: 60px;">No</th>
          <th>Nama Peserta</th>
          <th>Kursus yang Diambil</th>
          <th class="num" style="width: 150px;">Total Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($history as $index => $item): ?>
          <tr>
            <td style="text-align: center; font-weight: 600;">
              <?= $index + 1 ?>
            </td>
            <td><?= e($item['name']) ?></td>
            <td><?= e($item['course']) ?></td>
            <td class="num" style="font-weight: 600;">
              <?= formatRupiah($item['total']) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" style="text-align: right; font-weight: 600; color: var(--text-muted);">
            Jumlah Peserta:
          </td>
          <td class="num" style="font-weight: 600;">
            <?= count($history) ?> orang
          </td>
        </tr>
      </tfoot>
    </table>
  </div>

</main>

<footer class="site-footer">
  <small>&copy; <?= date('Y') ?> KursusKu &middot;
    <a href="index.php">Beranda</a> &middot;
    <a href="register.php">Daftar</a> &middot;
    <a href="history.php">Riwayat</a>
  </small>
</footer>

</body>
</html>
