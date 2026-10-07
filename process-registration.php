<?php
/**
 * process-registration.php - Menerima data dari registration.php (Milestone 5)
 * Pemrograman Web III - Sub-CPMK4: form, GET/POST
 *
 * Batas praktikum: file ini hanya membaca $_POST dan menampilkannya kembali.
 * Belum ada penyimpanan ke database (dipelajari setelah fondasi form selesai).
 */

$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$phone           = trim($_POST['phone'] ?? '');
$studyProgram    = trim($_POST['study_program'] ?? '');
$course          = $_POST['course'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$interests       = $_POST['interests'] ?? [];
$note            = trim($_POST['note'] ?? '');
$source          = $_POST['source'] ?? '';

$interestText = implode(', ', $interests);

/**
 * e() - fungsi escaping output (konsep reusable dari Pertemuan 4).
 * Semua nilai dari pengguna WAJIB melewati fungsi ini sebelum dicetak ke HTML.
 */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pendaftaran - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php"><img class="brand-logo" src="assets/images/logo-kursusku.svg" alt=""><span>KursusKu</span></a>
    <nav aria-label="Navigasi utama">
      <a href="index.php">Beranda</a>
      <a href="index.php#katalog">Katalog</a>
      <a href="registration.php">Daftar</a>
      <a href="test-matrix.php">Test Matrix</a>
    </nav>
  </div>
</header>

<main class="container result-page">

  <section class="alert-success">
    <h1>Pendaftaran Diterima untuk Diproses</h1>
    <p>Periksa kembali data latihan berikut.</p>
  </section>

  <section class="summary-card">
    <dl class="summary-list">
      <dt>Nama</dt><dd><?= e($name) ?></dd>
      <dt>Email</dt><dd><?= e($email) ?></dd>
      <dt>Nomor HP</dt><dd><?= e($phone) ?></dd>
      <dt>Program Studi</dt><dd><?= e($studyProgram) ?></dd>
      <dt>Kursus</dt><dd><?= e($course) ?></dd>
      <dt>Jenis Peserta</dt><dd><?= e($participantType) ?></dd>
      <dt>Minat</dt><dd><?= e($interestText) ?></dd>
      <dt>Catatan</dt><dd><?= e($note) ?></dd>
      <dt>Sumber</dt><dd><?= e($source) ?></dd>
    </dl>
    <a class="btn-link" href="registration.php">Kembali ke Form</a>
  </section>

</main>

</body>
</html>
