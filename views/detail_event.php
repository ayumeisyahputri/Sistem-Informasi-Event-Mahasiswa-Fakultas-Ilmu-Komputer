<!DOCTYPE html>
<html>
<head>
    <title>Detail Event</title>
</head>
<body>

<h2>Detail Event</h2>

<h3><?php echo $data['nama_event']; ?></h3>
<p><b>Tanggal:</b> <?php echo $data['tanggal']; ?></p>
<p><b>Deskripsi:</b> <?php echo $data['deskripsi']; ?></p>

<br>
<a href="index.php?page=daftar&id_event=<?php echo $data['id_event']; ?>">
    <button>Daftar Event</button>
</a>

</body>
</html>
