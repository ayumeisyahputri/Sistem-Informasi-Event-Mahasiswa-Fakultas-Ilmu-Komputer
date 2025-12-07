<h2>Daftar Event</h2>
<form method="post" action="/pendaftaran/store" enctype="multipart/form-data">
    <input type="hidden" name="id_event" value="<?= esc($id_event) ?>">
    <label>Upload Bukti (jpg/png/pdf)</label>
    <input type="file" name="bukti" required>

    <button type="submit">Kirim Pendaftaran</button>
</form>
