<?php
/**
 * process.php - Memproses Form Pendaftaran Lanjutan (Milestone 6)
 * Pemrograman Web III - Sub-CPMK5: percabangan, looping, form lanjutan
 *
 * Alur: cek method POST -> baca & bersihkan input -> validasi dasar
 * -> jika ada error, tampilkan dan hentikan (exit) -> jika valid,
 * hitung diskon (if/elseif) & label metode (switch) -> tampilkan ringkasan.
 */

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

// Halaman ini hanya boleh diakses lewat submit form (POST), bukan dibuka
// langsung lewat URL (GET) - kalau GET, kembalikan ke form.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$courseCode      = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode    = $_POST['learning_mode'] ?? '';
$packageCount    = (int) ($_POST['package_count'] ?? 1);
$notes           = trim($_POST['notes'] ?? '');

// Checkbox yang tidak dicentang sama sekali bisa membuat key 'interests'
// tidak terkirim -> ?? [] mencegah "Undefined array key".
$interests = $_POST['interests'] ?? [];
if (!is_array($interests)) {
    $interests = [];
}

// Buang nilai checkbox yang tidak dikenal (mis. hasil request yang dipalsukan)
// - hanya sisakan yang memang ada di $interestOptions.
$allowedInterestKeys = array_keys($interestOptions);
$interests = array_values(array_intersect($interests, $allowedInterestKeys));

/* ------------------------------------------------------------------
 * VALIDASI DASAR
 * ------------------------------------------------------------------ */
$errors = [];

if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

$course = findCourse($courses, $courseCode);
if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}

if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}

if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}

if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

// Jika ada data inti yang tidak valid, tampilkan pesan dan HENTIKAN proses
// (exit) - jangan lanjut menghitung biaya dengan data yang rusak.
if ($errors !== []) {
    ?>
    <!doctype html>
    <html lang="id">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Data Belum Valid - KursusKu</title>
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/week6.css">
    </head>
    <body>
      <header class="site-header">
        <div class="container nav-wrap">
          <a class="brand" href="index.php"><img class="brand-logo" src="assets/images/logo-kursusku.svg" alt=""><span>KursusKu</span></a>
          <nav aria-label="Navigasi utama">
            <a href="index.php">Beranda</a>
            <a href="register.php">Daftar Kursus</a>
            <a href="history.php">History Dummy</a>
            <a href="test-matrix.php">Test Matrix</a>
          </nav>
        </div>
      </header>
      <main class="container">
        <section class="alert-error">
          <h1>Data Belum Dapat Diproses</h1>
          <ul class="error-list">
            <?php foreach ($errors as $error): ?>
              <li><?= e($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </section>
        <p style="max-width:760px;margin:0 auto;">
          <a class="btn-link" href="register.php">Kembali ke Form</a>
        </p>
      </main>
    </body>
    </html>
    <?php
    exit;
}

/* ------------------------------------------------------------------
 * PERHITUNGAN BIAYA (percabangan if/elseif di getDiscountPercent())
 * ------------------------------------------------------------------ */
$discountPercent = getDiscountPercent($participantType);

$grossTotal     = $course['fee'] * $packageCount;
$discountAmount = intdiv($grossTotal * $discountPercent, 100);
$finalTotal     = $grossTotal - $discountAmount;

/* ------------------------------------------------------------------
 * LABEL METODE BELAJAR (switch di getLearningModeLabel())
 * ------------------------------------------------------------------ */
$learningModeLabel = getLearningModeLabel($learningMode);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ringkasan Pendaftaran - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/week6.css">
</head>
<body>

<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php"><img class="brand-logo" src="assets/images/logo-kursusku.svg" alt=""><span>KursusKu</span></a>
    <nav aria-label="Navigasi utama">
      <a href="index.php">Beranda</a>
      <a href="register.php">Daftar Kursus</a>
      <a href="history.php">History Dummy</a>
      <a href="test-matrix.php">Test Matrix</a>
    </nav>
  </div>
</header>

<main class="container">

  <section class="alert-success">
    <h1>Pendaftaran Berhasil Diproses</h1>
    <p>Periksa kembali data dan rincian biaya di bawah ini.</p>
  </section>

  <section class="summary-card">
    <dl class="summary-list">
      <dt>Nama</dt><dd><?= e($name) ?></dd>
      <dt>Email</dt><dd><?= e($email) ?></dd>
      <dt>Kursus</dt><dd><?= e($course['name']) ?></dd>
      <dt>Tipe Peserta</dt><dd><?= e(ucfirst($participantType)) ?></dd>
      <dt>Metode</dt><dd><?= e($learningModeLabel) ?></dd>
      <dt>Jumlah Paket</dt><dd><?= $packageCount ?></dd>
      <?php if ($notes !== ''): ?>
        <dt>Catatan</dt><dd><?= e($notes) ?></dd>
      <?php endif; ?>
    </dl>
  </section>

  <section class="fee-breakdown">
    <h2 style="margin-top:0;">Rincian Biaya</h2>
    <p>Biaya kursus: <?= formatRupiah($course['fee']) ?> &times; <?= $packageCount ?> paket</p>
    <p>Subtotal: <?= formatRupiah($grossTotal) ?></p>
    <p>Diskon (<?= $discountPercent ?>%): &minus; <?= formatRupiah($discountAmount) ?></p>
    <p class="final-total">Total akhir: <?= formatRupiah($finalTotal) ?></p>
  </section>

  <section class="summary-card">
    <h2 style="margin-top:0;">Minat Belajar</h2>
    <?php if ($interests === []): ?>
      <p class="empty-note">Belum memilih minat.</p>
    <?php else: ?>
      <ul class="interest-chips">
        <?php foreach ($interests as $interest): ?>
          <?php $label = $interestOptions[$interest] ?? $interest; ?>
          <li><?= e($label) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <p style="margin-top:1.25rem;">
      <a class="btn-link" href="register.php">Daftar Lagi</a>
    </p>
  </section>

</main>

</body>
</html>
