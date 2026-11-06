<!-- app/views/mahasiswa/ubah.php -->
<h1><?= htmlspecialchars($data["judul"], ENT_QUOTES, "UTF-8"); ?></h1>

<?php if (!empty($data["error"])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($data["error"], ENT_QUOTES, "UTF-8"); ?></div>
<?php endif; ?>

<form action="<?= BASEURL; ?>/mahasiswa/ubah/<?= (int) $data["mhs"]["id"]; ?>" method="post">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data["mhs"]["nama"], ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="nrp">NRP</label>
    <input type="text" id="nrp" name="nrp" value="<?= htmlspecialchars($data["mhs"]["nrp"], ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($data["mhs"]["email"], ENT_QUOTES, "UTF-8"); ?>" required>

    <label for="jurusan">Jurusan</label>
    <input type="text" id="jurusan" name="jurusan" value="<?= htmlspecialchars($data["mhs"]["jurusan"], ENT_QUOTES, "UTF-8"); ?>" required>

    <button type="submit">Simpan Perubahan</button>
    <a class="tombol-batal" href="<?= BASEURL; ?>/mahasiswa">Batal</a>
</form>

<p>
    <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= (int) $data["mhs"]["id"]; ?>">Lihat detail</a> &middot;
    <a href="<?= BASEURL; ?>/mahasiswa">&laquo; Kembali ke daftar</a>
</p>
