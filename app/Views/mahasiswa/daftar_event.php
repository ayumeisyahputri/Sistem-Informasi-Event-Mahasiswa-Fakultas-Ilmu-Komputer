<h2>Daftar Event: <?= esc($event['nama_event']) ?></h2>

<p><?= esc($event['deskripsi']) ?></p>
<p>Penyelenggara: <?= esc($event['penyelenggara']) ?></p>
<p>Deadline Pendaftaran: <?= esc($event['deadline_pendaftaran']) ?></p>
<p>Sisa Kuota: <b><?= $sisa_kuota ?></b></p>

<?php if ($sudah_daftar): ?>
    <p style="color: red;">Anda sudah mendaftar event ini.</p>

<?php elseif ($sisa_kuota <= 0): ?>
    <p style="color: red;">Kuota penuh, pendaftaran ditutup.</p>

<?php else: ?>
<form action="/pendaftaran/store" method="POST" enctype="multipart/form-data" id="form-daftar">
    <input type="hidden" name="id_event" value="<?= $event['id_event'] ?>">

    <label>Upload KTM (JPG/PNG/PDF, max 3MB)</label><br>
    <input type="file" name="ktm" id="ktm" required><br><br>

    <button type="submit">Kirim Pendaftaran</button>
</form>
<?php endif; ?>

<br>
<a href="/pendaftaran">Lihat Riwayat Pendaftaran</a>

<script src="/js/upload-validation.js"></script>
