<?php
/**
 * index.php - Landing Page KursusKu (Versi 1 / Milestone 2)
 * Pemrograman Web III - PHP & MySQL
 *
 * Berisi nilai PHP sederhana (site name, tagline, tahun) yang ditampilkan
 * ke dalam struktur HTML semantik. Fokus pertemuan ini: struktur halaman
 * dan pembuktian bahwa PHP diproses di server, bukan visual/CSS kompleks.
 */

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
  <style>
    /* Styling dasar & rapi - sengaja dibuat sederhana, bukan CSS kompleks */
    :root {
      --primary: #2563eb;
      --dark: #111827;
      --muted: #6b7280;
      --bg-light: #f9fafb;
      --border: #e5e7eb;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
      color: var(--dark);
      line-height: 1.6;
    }
    header {
      background: #fff;
      border-bottom: 1px solid var(--border);
      position: sticky;
      top: 0;
    }
    nav {
      max-width: 1000px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 24px;
      flex-wrap: wrap;
      gap: 12px;
    }
    nav a {
      color: var(--dark);
      text-decoration: none;
      margin-left: 20px;
      font-size: 0.95rem;
    }
    nav a:first-child { margin-left: 0; font-size: 1.1rem; }
    nav a:hover { color: var(--primary); }

    main { max-width: 1000px; margin: 0 auto; padding: 0 24px; }

    #hero {
      text-align: center;
      padding: 64px 16px;
    }
    #hero h1 {
      font-size: 2rem;
      margin-bottom: 12px;
    }
    #hero p { color: var(--muted); max-width: 560px; margin: 0 auto 24px; }
    #hero a {
      display: inline-block;
      background: var(--primary);
      color: #fff;
      padding: 12px 24px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
    }

    section { padding: 48px 0; }
    section h2 {
      text-align: center;
      margin-bottom: 32px;
      font-size: 1.5rem;
    }

    #keunggulan article, #katalog article {
      display: inline-block;
      vertical-align: top;
      width: 100%;
      max-width: 300px;
      margin: 0 12px 24px 0;
      padding: 20px;
      background: var(--bg-light);
      border: 1px solid var(--border);
      border-radius: 8px;
    }
    #keunggulan, #katalog { text-align: center; }
    #keunggulan article h3, #katalog article h3 {
      margin-top: 0;
      color: var(--primary);
    }

    #alur ol { max-width: 480px; margin: 0 auto; padding-left: 20px; }
    #alur li { margin-bottom: 8px; }

    #media { text-align: center; background: var(--bg-light); border-radius: 8px; }
    #media img, #media video { max-width: 100%; height: auto; border-radius: 8px; }
    #media h3 { margin-top: 32px; }
    #media a { color: var(--primary); }

    #kontak { text-align: center; }

    footer {
      text-align: center;
      padding: 24px;
      color: var(--muted);
      border-top: 1px solid var(--border);
      margin-top: 32px;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<header>
  <nav aria-label="Navigasi utama">
    <a href="index.php"><strong><?= htmlspecialchars($siteName) ?></strong></a>
    <span>
      <a href="#keunggulan">Keunggulan</a>
      <a href="#katalog">Katalog</a>
      <a href="#alur">Cara Daftar</a>
      <a href="#kontak">Kontak</a>
    </span>
  </nav>
</header>

<main>

  <section id="hero">
    <h1><?= htmlspecialchars($tagline) ?></h1>
    <p>Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda.</p>
    <a href="#katalog">Lihat Katalog Kursus</a>
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
    <article>
      <h3>Web Dasar</h3>
      <p>Belajar struktur HTML dan dasar pengembangan web.</p>
    </article>
    <article>
      <h3>PHP Dasar</h3>
      <p>Belajar variabel, operator, percabangan, looping, dan form.</p>
    </article>
    <article>
      <h3>Laravel Dasar</h3>
      <p>Mengenal framework, route, controller, view, dan database.</p>
    </article>
  </section>

  <section id="alur">
    <h2>Cara Mendaftar</h2>
    <ol>
      <li>Pilih kursus yang diminati.</li>
      <li>Isi form pendaftaran.</li>
      <li>Periksa kembali data.</li>
      <li>Kirim pendaftaran dan tunggu konfirmasi.</li>
    </ol>
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
    <p>Alamat: Laboratorium Komputer - data latihan</p>
  </section>

</main>

<footer>
  <small>&copy; <?= $year ?> <?= htmlspecialchars($siteName) ?></small>
</footer>

</body>
</html>
