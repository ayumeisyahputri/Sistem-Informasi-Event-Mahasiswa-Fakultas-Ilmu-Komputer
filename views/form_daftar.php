<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Event</title>
</head>
<body>

<h2>Daftar Event: <?php echo $data['nama_event']; ?></h2>

<form method="POST" action="index.php?page=proses_daftar">

    <input type="hidden" name="id_event" value="<?php echo $data['id_event']; ?>">

    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>NIM:</label><br>
    <input type="text" name="nim" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>
