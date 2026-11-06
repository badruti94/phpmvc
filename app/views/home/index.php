<!-- app/views/mahasiswa/index.php -->
<h1><?= htmlspecialchars($data["judul"], ENT_QUOTES, "UTF-8"); ?></h1>
<table>
 <tr><th>Nama</th><th>NRP</th><th>Jurusan</th><th>Aksi</th></tr>
 <?php foreach ($data["mhs"] as $mhs): ?>
 <tr>
 <td><?= htmlspecialchars($mhs["nama"], ENT_QUOTES, "UTF-8"); ?></td>
 <td><?= htmlspecialchars($mhs["nrp"], ENT_QUOTES, "UTF-8"); ?></td>
 <td><?= htmlspecialchars($mhs["jurusan"], ENT_QUOTES, "UTF-8"); ?></td>
 <td>
 <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= (int) $mhs["id"]; ?>">Detail</a>
 </td>
 </tr>
 <?php endforeach; ?>
</table>


