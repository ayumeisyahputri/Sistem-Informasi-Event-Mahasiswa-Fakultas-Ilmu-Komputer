<h2>Tambah Event</h2>
<form method="post" action="/event/store">
    <label>Nama Event</label>
    <input type="text" name="nama_event" required>

    <label>Deskripsi</label>
    <textarea name="deskripsi"></textarea>

    <label>Penyelenggara</label>
    <input type="text" name="penyelenggara">

    <label>Deadline Pendaftaran</label>
    <input type="date" name="deadline_pendaftaran">

    <button type="submit">Simpan</button>
</form>
