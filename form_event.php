<!DOCTYPE html>
<html>
<head>
    <title>Form Event</title>
</head>
<body>

<h2>Form Event</h2>

<form action="<?= site_url('admin/event/save') ?>" method="POST">

    <input type="hidden" name="id_event" 
           value="<?= isset($event['id_event']) ? $event['id_event'] : '' ?>">

    Nama Event: <br>
    <input type="text" name="nama_event"
           value="<?= isset($event['nama_event']) ? $event['nama_event'] : '' ?>" required><br><br>

    Deskripsi: <br>
    <textarea name="deskripsi" required><?= isset($event['deskripsi']) ? $event['deskripsi'] : '' ?></textarea><br><br>

    Penyelenggara: <br>
    <input type="text" name="penyelenggara"
           value="<?= isset($event['penyelenggara']) ? $event['penyelenggara'] : '' ?>" required><br><br>

    Deadline Pendaftaran: <br>
    <input type="date" name="deadline_pendaftaran"
           value="<?= isset($event['deadline_pendaftaran']) ? $event['deadline_pendaftaran'] : '' ?>" required><br><br>

    <button type="submit">Simpan</button>

</form>

</body>
</html>
