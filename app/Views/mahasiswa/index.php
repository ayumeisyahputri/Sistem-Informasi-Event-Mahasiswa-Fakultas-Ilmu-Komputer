<h2>Data Mahasiswa</h2>
<a href="/mahasiswa/create" class="btn btn-primary">Tambah Mahasiswa</a>

<table>
    <thead>
        <tr><th>Nama</th><th>NIM</th><th>Email</th><th>Jurusan</th><th>Role</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach($mahasiswa as $m): ?>
        <tr>
            <td><?= esc($m['nama']) ?></td>
            <td><?= esc($m['nim']) ?></td>
            <td><?= esc($m['email']) ?></td>
            <td><?= esc($m['jurusan']) ?></td>
            <td><?= esc($m['role'] ?? 'user') ?></td>
            <td>
                <a class="btn btn-warning" href="/mahasiswa/edit/<?= $m['id_mahasiswa'] ?>">Edit</a>
                <a class="btn btn-danger" href="/mahasiswa/delete/<?= $m['id_mahasiswa'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
