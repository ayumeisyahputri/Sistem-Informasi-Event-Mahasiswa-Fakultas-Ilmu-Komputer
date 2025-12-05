<h2>Pendaftaran Event</h2>
<?php if(empty($data)): ?>
    <p>Tidak ada pendaftaran.</p>
<?php else: ?>
    <table>
        <thead><tr><th>Event</th><th>Mahasiswa</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php foreach($data as $d): ?>
            <tr>
                <td><?= esc($d['id_event']) ?></td>
                <td><?= esc($d['id_mahasiswa']) ?></td>
                <td><?= esc($d['tanggal_daftar']) ?></td>
                <td><?= esc($d['status']) ?></td>
                <td>
                    <?php if(session()->get('role') === 'admin'): ?>
                        <a class="btn btn-warning" href="/pendaftaran/edit/<?= $d['id_pendaftaran_event'] ?>">Edit</a>
                        <a class="btn btn-danger" href="/pendaftaran/delete/<?= $d['id_pendaftaran_event'] ?>">Hapus</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
