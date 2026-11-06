<?php
/**
 * View 404. Variabel $pesan dikirim oleh App::error404()
 * @var string $pesan
 */
$pesan = $pesan ?? "Halaman tidak ditemukan.";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Tidak ditemukan</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
<nav>
    <img src="<?= BASEURL; ?>/img/logo.png" alt="Logo" class="logo">
    <a href="<?= BASEURL; ?>/home">Home</a>
    <a href="<?= BASEURL; ?>/mahasiswa">Mahasiswa</a>
</nav>
<main>
    <h1>404</h1>
    <p><?= htmlspecialchars($pesan, ENT_QUOTES, "UTF-8"); ?></p>
    <p><a href="<?= BASEURL; ?>/home">&laquo; Kembali ke Home</a></p>
</main>
</body>
</html>
