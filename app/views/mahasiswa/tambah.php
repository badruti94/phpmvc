<!-- app/views/mahasiswa/tambah.php -->
<h1><?= htmlspecialchars($data["judul"], ENT_QUOTES, "UTF-8"); ?></h1>

<?php if (!empty($data["error"])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($data["error"], ENT_QUOTES, "UTF-8"); ?></div>
<?php endif; ?>

<form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST["nama"] ?? "", ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="nrp">NRP</label>
    <input type="text" id="nrp" name="nrp" value="<?= htmlspecialchars($_POST["nrp"] ?? "", ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "", ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="jurusan">Jurusan</label>
    <input type="text" id="jurusan" name="jurusan" value="<?= htmlspecialchars($_POST["jurusan"] ?? "", ENT_QUOTES, "UTF-8"); ?>" required>

    <button type="submit">Simpan</button>
</form>

<p><a href="<?= BASEURL; ?>/mahasiswa">&laquo; Kembali ke daftar</a></p>
