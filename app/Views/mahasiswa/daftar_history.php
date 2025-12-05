<h2>Riwayat Pendaftaran Event</h2>

<?php if (empty($pendaftaran)): ?>
    <p>Belum ada riwayat pendaftaran.</p>
<?php else: ?>
<table border="1" cellpadding="10">
    <tr>
        <th>Event</th>
        <th>Tanggal Daftar</th>
        <th>Status</th>
        <th>Bukti</th>
    </tr>

    <?php foreach ($pendaftaran as $p): ?>
        <?php 
            $event = (new \App\Models\EventModel())->find($p['id_event']);
        ?>
        <tr>
            <td><?= esc($event['nama_event']) ?></td>
            <td><?= esc($p['tanggal_daftar']) ?></td>
            <td><?= esc($p['status']) ?></td>
            <td>
                <?php if ($p['bukti_upload']): ?>
                    <a href="/pendaftaran/download/<?= $p['id_pendaftaran_event'] ?>">Download</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
<?php endif; ?>
