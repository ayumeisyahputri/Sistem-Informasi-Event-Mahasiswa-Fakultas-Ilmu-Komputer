<h2>Riwayat Event (Sudah Selesai)</h2>
<a href="/admin/event" class="btn btn-secondary">Kembali ke Daftar Event</a>

<table>
    <thead>
        <tr><th>Nama</th><th>Tanggal</th><th>Lokasi</th><th>Penyelenggara</th></tr>
    </thead>
    <tbody>
    <?php foreach($events as $e): ?>
        <tr>
            <td><?= esc($e['nama_event']) ?></td>
            <td><?= esc($e['tanggal_event']) ?></td>
            <td><?= esc($e['lokasi']) ?></td>
            <td><?= esc($e['penyelenggara']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
