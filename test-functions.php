<?php
/**
 * test-functions.php - Pengujian sederhana 4 function reusable (Milestone 4)
 *
 * Nilai expected ditulis berdasarkan ATURAN PROYEK, bukan disamakan dengan
 * hasil program. Jika ada FAIL, perbaiki function-nya, jangan ubah expected.
 */

require_once __DIR__ . '/helpers.php';

$tests = [
    ['rupiah(250000)',               rupiah(250000),                 'Rp 250.000'],
    ['statusKursus(25, 25)',         statusKursus(25, 25),           'Penuh'],
    ['statusKursus(30, 29)',         statusKursus(30, 29),           'Tersedia'],
    ['sisaKursi(20, 0)',             sisaKursi(20, 0),               20],
    ['sisaKursi(25, 25)',            sisaKursi(25, 25),              0],
    ['formatTanggal(2026-09-15)',    formatTanggal('2026-09-15'),    '15-09-2026'],
];

$passCount = 0;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test Function - KursusKu</title>
  <link rel="stylesheet" href="assets/css/test-functions.css">
</head>
<body>

<main class="card">
  <h1>Pengujian Function <code>helpers.php</code></h1>
  <p class="subtitle">Enam test sederhana untuk empat function reusable.</p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Pemanggilan</th>
        <th>Actual</th>
        <th>Expected</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tests as $i => [$name, $actual, $expected]): ?>
        <?php
          // Memakai === agar nilai DAN tipe data ikut diperiksa
          $passed = $actual === $expected;
          if ($passed) { $passCount++; }
        ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><code><?= htmlspecialchars($name) ?></code></td>
          <td><?= htmlspecialchars((string) $actual) ?></td>
          <td><?= htmlspecialchars((string) $expected) ?></td>
          <td>
            <span class="badge <?= $passed ? 'pass' : 'fail' ?>">
              <?= $passed ? 'PASS' : 'FAIL' ?>
            </span>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <p class="summary">
    Hasil: <?= $passCount ?> dari <?= count($tests) ?> test PASS.
  </p>

  <a class="back" href="index.php">&larr; Kembali ke Beranda KursusKu</a>
</main>

</body>
</html>
