<h2>Manajemen Event</h2>
<a href="/admin/event/create" class="btn btn-primary">Tambah Event</a>
<a href="/admin/event/riwayat" class="btn btn-secondary">Lihat Riwayat (Selesai)</a>

<table>
    <thead>
        <tr>
            <th>Nama</th><th>Tanggal</th><th>Lokasi</th><th>Kapasitas</th><th>Sisa Kuota</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($events as $e): ?>
        <tr>
            <td><?= esc($e['nama_event']) ?></td>
            <td><?= esc($e['tanggal_event']) ?></td>
            <td><?= esc($e['lokasi']) ?></td>
            <td><?= esc($e['kapasitas']) ?></td>
            <td>
                <?php
                    // panggil helper sisaKuota di controller via object instance
                    $ci = \Config\Services::renderer(); // bukan ideal, gunakan ajax di implementasi final
                    // kalau ingin menampilkan sisa kuota sekarang, panggil via model/pendaftaran
                    echo 'lihat detail pendaftaran'; 
                ?>
            </td>
            <td>
                <a class="btn btn-warning" href="/admin/event/edit/<?= $e['id_event'] ?>">Edit</a>
                <a class="btn btn-danger" href="/admin/event/delete/<?= $e['id_event'] ?>" onclick="return confirm('Hapus event?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
