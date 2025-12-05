<h2>Edit Pendaftaran</h2>
<form method="post" action="/pendaftaran/update/<?= $data['id_pendaftaran_event'] ?>">
    <label>Status</label>
    <select name="status">
        <option value="Menunggu" <?= $data['status']=='Menunggu' ? 'selected' : '' ?>>Menunggu</option>
        <option value="Diterima" <?= $data['status']=='Diterima' ? 'selected' : '' ?>>Diterima</option>
        <option value="Ditolak" <?= $data['status']=='Ditolak' ? 'selected' : '' ?>>Ditolak</option>
    </select>

    <button type="submit">Update</button>
</form>
