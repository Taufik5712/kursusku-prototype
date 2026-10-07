<?php


require_once __DIR__ . '/helpers.php';      // 4 function reusable (Milestone 4)
require_once __DIR__ . '/data-courses.php'; // array $courses berisi 6 kursus

$siteName = 'KursusKu';
$tagline  = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year     = date('Y');
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($siteName) ?> - Landing Page</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php"><img class="brand-logo" src="assets/images/logo-kursusku.svg" alt=""><span><?= htmlspecialchars($siteName) ?></span></a>
    <nav aria-label="Navigasi utama">
      <a href="#keunggulan">Keunggulan</a>
      <a href="#katalog">Katalog</a>
      <a href="#alur">Cara Daftar</a>
      <a href="fee-calculator.php">Estimasi Biaya</a>
      <a href="register.php">Daftar Kursus</a>
      <a href="history.php">History</a>
      <a href="test-matrix.php">Test Matrix</a>
      <a href="#kontak">Kontak</a>
    </nav>
  </div>
</header>

<main class="container">

  <section id="hero">
    <h1><?= htmlspecialchars($tagline) ?></h1>
    <p>Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda.</p>
    <a href="register.php">Daftar Sekarang</a>
    <a class="secondary" href="fee-calculator.php">Lihat Estimasi Biaya</a>
  </section>

  <section id="keunggulan">
    <h2>Mengapa Memilih KursusKu?</h2>
    <article>
      <h3>Materi Terarah</h3>
      <p>Materi disusun bertahap dari dasar hingga praktik.</p>
    </article>
    <article>
      <h3>Belajar dengan Proyek</h3>
      <p>Setiap tahap menghasilkan bagian nyata dari aplikasi.</p>
    </article>
    <article>
      <h3>Pendampingan Praktik</h3>
      <p>Mahasiswa belajar melalui demonstrasi, latihan, dan evaluasi.</p>
    </article>
  </section>

  <section id="katalog">
    <h2>Katalog Kursus</h2>
    <p class="section-note">
      Data katalog dibangun dari array PHP dan dirender dengan <code>foreach</code>.
    </p>

    <div class="table-wrap">
      <table class="catalog">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Kursus</th>
            <th class="num">Biaya</th>
            <th>Mulai</th>
            <th class="num">Sisa Kursi</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $course): ?>
            <?php
              // Logika status ditentukan sekali, lalu dipakai untuk teks dan class CSS
              $status      = statusKursus($course['quota'], $course['registered']);
              $statusClass = $status === 'Penuh' ? 'badge-full' : 'badge-available';
            ?>
            <tr>
              <td><code><?= htmlspecialchars($course['code']) ?></code></td>
              <td><?= htmlspecialchars(trim($course['name'])) ?></td>
              <td class="num"><?= rupiah($course['fee']) ?></td>
              <td><?= formatTanggal($course['start_date']) ?></td>
              <td class="num"><?= sisaKursi($course['quota'], $course['registered']) ?></td>
              <td><span class="<?= $statusClass ?>"><?= $status ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <section id="alur">
    <h2>Cara Mendaftar</h2>
    <ol>
      <li>Pilih kursus yang diminati.</li>
      <li>Isi form pendaftaran.</li>
      <li>Periksa kembali data.</li>
      <li>Kirim pendaftaran dan tunggu konfirmasi.</li>
    </ol>
    <p style="text-align:center;">
      <a class="btn-link" href="register.php">Buka Form Pendaftaran</a>
    </p>
  </section>

  <section id="media">
    <h2>Kenali Program Kami</h2>
    <img
      src="assets/images/hero-kursus.jpg"
      alt="Mahasiswa sedang mengikuti kegiatan kursus komputer"
      width="640">

    <h3>Video Singkat</h3>
    <video controls width="640">
      <source src="assets/video/intro-kursus.mp4" type="video/mp4">
      Browser Anda tidak mendukung video HTML5.
    </video>

    <p>
      Pelajari juga
      <a href="https://www.php.net/" target="_blank" rel="noopener">dokumentasi PHP</a>.
    </p>
  </section>

  <section id="kontak">
    <h2>Kontak</h2>
    <p>Email: hidayattaufik5712@gmail.com</p>
    <p>Alamat: Laboratorium Komputer - UIN SJECH M DJAMIL DJAMBEK</p>
  </section>

</main>

<footer class="site-footer">
  <small>&copy; <?= $year ?> <?= htmlspecialchars($siteName) ?> &middot; <a href="loop-lab.php">Loop Lab</a></small>
</footer>

</body>
</html>
