<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= htmlspecialchars($data["judul"] ?? "Aplikasi MVC", ENT_QUOTES, "UTF-8"); ?></title>
 <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
<nav>
 <img src="<?= BASEURL; ?>/img/logo.png" alt="Logo" class="logo">
 <a href="<?= BASEURL; ?>/home">Home</a>
 <a href="<?= BASEURL; ?>/mahasiswa">Mahasiswa</a>
 <a href="<?= BASEURL; ?>/mahasiswa/tambah">Tambah</a>
</nav>
<main>
