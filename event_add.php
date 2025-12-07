<h2>Tambah Event</h2>

<form id="eventForm" method="post" action="/admin/event/store">
    <label>Nama Event</label>
    <input type="text" name="nama_event" value="<?= old('nama_event') ?>">

    <label>Deskripsi</label>
    <textarea name="deskripsi"><?= old('deskripsi') ?></textarea>

    <label>Penyelenggara</label>
    <input type="text" name="penyelenggara" value="<?= old('penyelenggara') ?>">

    <label>Lokasi</label>
    <input type="text" name="lokasi" value="<?= old('lokasi') ?>">

    <label>Tanggal Event</label>
    <input type="date" name="tanggal_event" value="<?= old('tanggal_event') ?>">

    <label>Deadline Pendaftaran (opsional)</label>
    <input type="date" name="deadline_pendaftaran" value="<?= old('deadline_pendaftaran') ?>">

    <label>Kapasitas (kuota)</label>
    <input type="number" name="kapasitas" value="<?= old('kapasitas', 10) ?>">

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<script src="/js/event-validation.js"></script>
