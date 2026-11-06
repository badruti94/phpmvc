<!-- app/views/mahasiswa/detail.php -->
<h1><?= htmlspecialchars($data["judul"], ENT_QUOTES, "UTF-8"); ?></h1>

<?php if ($data["mhs"] === null): ?>
    <p>Data mahasiswa tidak ditemukan.</p>
<?php else: ?>
    <table class="detail">
        <tr><th>Nama</th><td><?= htmlspecialchars($data["mhs"]["nama"], ENT_QUOTES, "UTF-8"); ?></td></tr>
        <tr><th>NRP</th><td><?= htmlspecialchars($data["mhs"]["nrp"], ENT_QUOTES, "UTF-8"); ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($data["mhs"]["email"], ENT_QUOTES, "UTF-8"); ?></td></tr>
        <tr><th>Jurusan</th><td><?= htmlspecialchars($data["mhs"]["jurusan"], ENT_QUOTES, "UTF-8"); ?></td></tr>
        <tr><th>Dibuat pada</th><td><?= htmlspecialchars((string) $data["mhs"]["dibuat_pada"], ENT_QUOTES, "UTF-8"); ?></td></tr>
    </table>
<?php endif; ?>

<p><a href="<?= BASEURL; ?>/mahasiswa">&laquo; Kembali ke daftar</a></p>
