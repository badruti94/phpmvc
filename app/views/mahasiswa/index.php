<!-- app/views/mahasiswa/index.php -->
<h1><?= htmlspecialchars($data["judul"], ENT_QUOTES, "UTF-8"); ?></h1>

<?php Flasher::flash(); ?>

<p><a class="tombol" href="<?= BASEURL; ?>/mahasiswa/tambah">Tambah Mahasiswa</a></p>

<table>
    <tr><th>Nama</th><th>NRP</th><th>Jurusan</th><th>Aksi</th></tr>
    <?php foreach ($data["mhs"] as $mhs): ?>
    <tr>
        <td><?= htmlspecialchars($mhs["nama"], ENT_QUOTES, "UTF-8"); ?></td>
        <td><?= htmlspecialchars($mhs["nrp"], ENT_QUOTES, "UTF-8"); ?></td>
        <td><?= htmlspecialchars($mhs["jurusan"], ENT_QUOTES, "UTF-8"); ?></td>
        <td class="aksi">
            <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= (int) $mhs["id"]; ?>">Detail</a>
            <a href="<?= BASEURL; ?>/mahasiswa/ubah/<?= (int) $mhs["id"]; ?>">Ubah</a>
            <form class="inline" action="<?= BASEURL; ?>/mahasiswa/hapus/<?= (int) $mhs["id"]; ?>" method="post"
                  onsubmit="return confirm('Yakin hapus data ini?');">
                <button type="submit" class="tombol-hapus">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($data["mhs"])): ?>
    <tr><td colspan="4">Belum ada data mahasiswa.</td></tr>
    <?php endif; ?>
</table>
