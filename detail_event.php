<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM event WHERE id_event = $id";
$result = mysqli_query($conn, $query);
$event = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Event</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2><?= $event['nama_event']; ?></h2>

<img src="assets/img/<?= $event['poster']; ?>" 
     width="300" 
     style="border-radius:10px;">

<p><b>Kategori:</b> <?= $event['kategori']; ?></p>
<p><b>Tanggal:</b> <?= $event['tanggal_mulai']; ?> s/d <?= $event['tanggal_selesai']; ?></p>
<p><b>Tempat:</b> <?= $event['tempat']; ?></p>

<?php if (isset($_GET['status']) && $_GET['status'] == "success") : ?>
    <p style="color:green;"><b>Berhasil daftar!</b></p>
<?php endif; ?>

<form action="controllers/PendaftaranController.php" method="POST">
    <input type="hidden" name="id_event" value="<?= $event['id_event']; ?>">
    <input type="hidden" name="id_mahasiswa" value="<?= $_SESSION['id_mahasiswa']; ?>">

    <button type="submit" name="daftar"
            style="padding:10px 20px; background:#0066ff; color:white; border:none; border-radius:6px;">
        Daftar Event
    </button>
</form>

</body>
</html>
