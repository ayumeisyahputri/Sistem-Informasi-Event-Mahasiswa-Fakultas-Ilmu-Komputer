<h2>Edit Event</h2>
<form method="post" action="/event/update/<?= $event['id_event'] ?>">
    <label>Nama Event</label>
    <input type="text" name="nama_event" required value="<?= esc($event['nama_event']) ?>">

    <label>Deskripsi</label>
    <textarea name="deskripsi"><?= esc($event['deskripsi']) ?></textarea>

    <label>Penyelenggara</label>
    <input type="text" name="penyelenggara" value="<?= esc($event['penyelenggara']) ?>">

    <label>Deadline Pendaftaran</label>
    <input type="date" name="deadline_pendaftaran" value="<?= esc($event['deadline_pendaftaran']) ?>">

    <button type="submit">Update</button>
</form>
