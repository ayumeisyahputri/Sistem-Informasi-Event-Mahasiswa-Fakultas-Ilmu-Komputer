<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Admin - Daftar Event</h2>

<a href="<?= site_url('admin/event/form') ?>">+ Tambah Event</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama Event</th>
        <th>Deskripsi</th>
        <th>Penyelenggara</th>
        <th>Deadline</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($events as $e): ?>
        <tr>
            <td><?= $e['id_event'] ?></td>
            <td><?= $e['nama_event'] ?></td>
            <td><?= $e['deskripsi'] ?></td>
            <td><?= $e['penyelenggara'] ?></td>
            <td><?= $e['deadline_pendaftaran'] ?></td>
            <td>
                <a href="<?= site_url('admin/event/form/'.$e['id_event']) ?>">Edit</a> |
                <a href="<?= site_url('admin/event/delete/'.$e['id_event']) ?>"
                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
