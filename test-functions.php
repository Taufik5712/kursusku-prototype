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
  <style>
    :root { --primary:#2563eb; --dark:#111827; --muted:#6b7280; --bg:#f9fafb; --border:#e5e7eb; }
    * { box-sizing: border-box; }
    body {
      margin:0; padding:32px 16px; background:var(--bg); color:var(--dark);
      font-family:-apple-system,"Segoe UI",Roboto,Arial,sans-serif; line-height:1.6;
    }
    .card {
      max-width:760px; margin:0 auto; background:#fff; border:1px solid var(--border);
      border-radius:12px; padding:28px;
    }
    h1 { font-size:1.5rem; margin:0 0 4px; }
    .subtitle { color:var(--muted); margin:0 0 24px; }
    table { width:100%; border-collapse:collapse; font-size:.94rem; }
    th, td { border-bottom:1px solid var(--border); padding:10px 8px; text-align:left; }
    thead th {
      background:var(--bg); font-size:.8rem; text-transform:uppercase;
      letter-spacing:.03em; color:var(--muted);
    }
    code { background:var(--bg); padding:2px 6px; border-radius:4px; font-size:.86rem; }
    .badge { display:inline-block; padding:3px 10px; border-radius:999px; font-weight:700; font-size:.8rem; }
    .pass { background:#dcfce7; color:#16a34a; }
    .fail { background:#fdeaea; color:#a61b1b; }
    .summary { margin-top:20px; font-weight:600; }
    .back { display:inline-block; margin-top:18px; color:var(--primary); text-decoration:none; font-weight:600; }
  </style>
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
