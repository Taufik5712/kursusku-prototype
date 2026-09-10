<?php
/**
 * server-time.php
 * Bertujuan membuktikan bahwa kode PHP dijalankan oleh server (Laragon),
 * bukan oleh browser. Setiap kali halaman ini di-refresh, waktu akan berubah
 * karena date() dieksekusi ulang di server.
 */

$serverTime = date('Y-m-d H:i:s');
echo 'Waktu server: ' . $serverTime;
