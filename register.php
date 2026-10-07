<?php
/**
 * register.php - Form Pendaftaran Lanjutan KursusKu (Milestone 6)
 * Pemrograman Web III - Sub-CPMK5: percabangan, looping, form lanjutan
 *
 * data.php   -> menyediakan array $courses, $interestOptions, $facilities
 * helpers.php -> menyediakan e() dan formatRupiah() untuk output aman
 */

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pendaftaran Lanjutan - KursusKu</title>
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
      <a href="history.php">History Dummy</a>
      <a href="test-matrix.php">Test Matrix</a>
    </nav>
  </div>
</header>

<main class="container">

  <section class="page-intro">
    <p class="eyebrow">Pendaftaran Lanjutan</p>
    <h1>Lengkapi Data Pendaftaran</h1>
    <p>Kursus, minat, metode belajar, dan jumlah paket diambil dari data PHP - bukan ditulis manual.</p>
  </section>

  <ul class="facility-list">
    <?php foreach ($facilities as $facility): ?>
      <li><?= e($facility) ?></li>
    <?php endforeach; ?>
  </ul>

  <section class="form-card">
    <form method="POST" action="process.php" class="registration-form">

      <div class="form-grid">
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input id="name" name="name" type="text" minlength="3" maxlength="100" autocomplete="name" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" maxlength="120" autocomplete="email" required>
        </div>
      </div>

      <div class="form-group">
        <label for="course_code">Pilih Kursus</label>
        <select id="course_code" name="course_code" required>
          <option value="">-- Pilih kursus --</option>
          <?php foreach ($courses as $course): ?>
            <option value="<?= e($course['code']) ?>">
              <?= e($course['name']) ?> - <?= formatRupiah($course['fee']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <fieldset class="form-group">
        <legend>Tipe Peserta</legend>
        <label class="choice">
          <input type="radio" name="participant_type" value="mahasiswa" required>
          Mahasiswa <small class="help">(diskon 20%)</small>
        </label>
        <label class="choice">
          <input type="radio" name="participant_type" value="guru">
          Guru <small class="help">(diskon 15%)</small>
        </label>
        <label class="choice">
          <input type="radio" name="participant_type" value="umum">
          Umum
        </label>
      </fieldset>

      <fieldset class="form-group">
        <legend>Minat Belajar</legend>
        <?php foreach ($interestOptions as $value => $label): ?>
          <label class="choice">
            <input type="checkbox" name="interests[]" value="<?= e($value) ?>">
            <?= e($label) ?>
          </label>
        <?php endforeach; ?>
      </fieldset>

      <div class="form-grid">
        <div class="form-group">
          <label for="learning_mode">Metode Belajar</label>
          <select id="learning_mode" name="learning_mode" required>
            <option value="">-- Pilih metode --</option>
            <option value="offline">Tatap Muka</option>
            <option value="online">Online</option>
            <option value="hybrid">Hybrid</option>
          </select>
        </div>

        <div class="form-group">
          <label for="package_count">Jumlah Paket</label>
          <select id="package_count" name="package_count" required>
            <?php for ($i = 1; $i <= 3; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?> paket</option>
            <?php endfor; ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="notes">Catatan Tambahan</label>
        <textarea id="notes" name="notes" rows="4" maxlength="300"
          placeholder="Opsional, maksimal 300 karakter"></textarea>
      </div>

      <button class="btn-primary" type="submit">Proses Pendaftaran</button>
    </form>
  </section>

</main>

</body>
</html>
