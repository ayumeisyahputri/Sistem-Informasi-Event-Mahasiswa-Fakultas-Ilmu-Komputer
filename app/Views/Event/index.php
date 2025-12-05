<h2>Daftar Event</h2>

<?php if(session()->get('role') == 'admin'): ?>
    <a href="/event/create" class="btn btn-primary">Tambah Event</a>
<?php endif; ?>

<table>
    <thead>
        <tr><th>Nama</th><th>Penyelenggara</th><th>Deadline</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php foreach($event as $e): ?>
        <tr>
            <td><?= esc($e['nama_event']) ?></td>
            <td><?= esc($e['penyelenggara']) ?></td>
            <td><?= esc($e['deadline_pendaftaran']) ?></td>
            <td>
                <a class="btn btn-primary" href="/event/detail/<?= $e['id_event'] ?>">Detail</a>
                <?php if(session()->get('role') == 'admin'): ?>
                    <a class="btn btn-warning" href="/event/edit/<?= $e['id_event'] ?>">Edit</a>
                    <a class="btn btn-danger" href="/event/delete/<?= $e['id_event'] ?>" onclick="return confirm('Hapus event?')">Hapus</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
