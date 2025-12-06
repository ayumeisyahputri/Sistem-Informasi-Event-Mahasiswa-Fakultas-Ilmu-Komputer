<h2>Edit Event</h2>

<form id="eventEditForm" method="post" action="/admin/event/update/<?= $event['id_event'] ?>">
    <label>Nama Event</label>
    <input type="text" name="nama_event" value="<?= esc($event['nama_event']) ?>">

    <label>Deskripsi</label>
    <textarea name="deskripsi"><?= esc($event['deskripsi']) ?></textarea>

    <label>Penyelenggara</label>
    <input type="text" name="penyelenggara" value="<?= esc($event['penyelenggara']) ?>">

    <label>Lokasi</label>
    <input type="text" name="lokasi" value="<?= esc($event['lokasi']) ?>">

    <label>Tanggal Event</label>
    <input type="date" name="tanggal_event" value="<?= esc($event['tanggal_event']) ?>">

    <label>Deadline Pendaftaran (opsional)</label>
    <input type="date" name="deadline_pendaftaran" value="<?= esc($event['deadline_pendaftaran']) ?>">

    <label>Kapasitas (kuota)</label>
    <input type="number" name="kapasitas" value="<?= esc($event['kapasitas']) ?>">

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script src="/js/event-validation.js"></script>
