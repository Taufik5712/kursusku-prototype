<?php
/**
 * loop-lab.php - Latihan Bentuk Loop: for, while, do-while (Pertemuan 6)
 * Pemrograman Web III - Sub-CPMK5: Memahami ketiga bentuk loop selain foreach
 *
 * Catatan: loop-lab.php JALANKAN setiap bentuk loop dan TAMPILKAN hasilnya.
 * Tidak menampilkan kode sumber, melainkan output dari eksekusi.
 * Ini latihan wajib meski proyek utama lebih banyak pakai foreach.
 */
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Loop Lab - KursusKu</title>
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
    <p class="eyebrow">Demonstrasi</p>
    <h1>Loop Lab</h1>
    <p>Perbandingan bentuk loop: for, while, do-while, dan foreach.</p>
  </section>

  <section class="loop-card">
    <h2>for — Jumlah iterasi diketahui</h2>
    <pre class="output">
<?php
for ($i = 1; $i <= 5; $i++) {
    echo "Pertemuan ke-$i\n";
}
?>
    </pre>
  </section>

  <section class="loop-card">
    <h2>while — Kondisi dicek sebelum blok</h2>
    <pre class="output">
<?php
$i = 1;
while ($i <= 5) {
    echo "Nomor antrean: $i\n";
    $i++;
}
?>
    </pre>
  </section>

  <section class="loop-card">
    <h2>do-while — Blok jalan dahulu, baru kondisi dicek</h2>
    <pre class="output">
<?php
$i = 1;
do {
    echo "Percobaan ke-$i\n";
    $i++;
} while ($i <= 5);
?>
    </pre>
  </section>

  <section class="loop-card">
    <h2>Perbandingan Bentuk Loop</h2>
    <table class="loop-compare">
      <thead>
        <tr>
          <th>Loop</th>
          <th>Gunakan Saat</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>for</code></td>
          <td>Jumlah iterasi sudah diketahui</td>
        </tr>
        <tr>
          <td><code>while</code></td>
          <td>Iterasi tergantung kondisi, boleh nol kali</td>
        </tr>
        <tr>
          <td><code>do-while</code></td>
          <td>Blok wajib jalan minimal satu kali</td>
        </tr>
        <tr>
          <td><code>foreach</code></td>
          <td>Proses setiap item dalam array</td>
        </tr>
      </tbody>
    </table>
  </section>



</main>

<footer class="site-footer">
  <small>&copy; <?= date('Y') ?> KursusKu &middot;
    <a href="index.php">Beranda</a> &middot;
    <a href="register.php">Daftar</a> &middot;
    <a href="loop-lab.php">Loop Lab</a>
  </small>
</footer>

</body>
</html>
