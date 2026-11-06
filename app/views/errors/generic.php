<?php
/**
 * View error umum (dipakai kalau tidak ada view khusus untuk kode tersebut,
 * mis. 405). Variabel $kode dan $pesan dikirim oleh App::error() / Controller::error().
 *
 * @var int    $kode
 * @var string $pesan
 */
$kode = $kode ?? 500;
$pesan = $pesan ?? "Terjadi kesalahan pada aplikasi.";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= (int) $kode; ?> - Kesalahan</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
<nav>
    <img src="<?= BASEURL; ?>/img/logo.png" alt="Logo" class="logo">
    <a href="<?= BASEURL; ?>/home">Home</a>
    <a href="<?= BASEURL; ?>/mahasiswa">Mahasiswa</a>
</nav>
<main>
    <h1><?= (int) $kode; ?></h1>
    <p><?= htmlspecialchars($pesan, ENT_QUOTES, "UTF-8"); ?></p>
    <p><a href="<?= BASEURL; ?>/home">&laquo; Kembali ke Home</a></p>
</main>
</body>
</html>
