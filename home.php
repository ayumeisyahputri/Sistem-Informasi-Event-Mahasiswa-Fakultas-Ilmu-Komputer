<?php
session_start();
include 'db.php';

// cek login dulu
if (!isset($_SESSION['id_mahasiswa'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM event ORDER BY tanggal_mulai ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home | Event Kampus</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Daftar Event Kampus</h2>

<div class="event-container" style="display:flex; gap:20px; flex-wrap:wrap;">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="event-card" 
             style="width:200px; border:1px solid #ddd; padding:10px; border-radius:8px;">
            
            <a href="detail_event.php?id=<?= $row['id_event']; ?>">
                <img src="assets/img/<?= $row['poster']; ?>" 
                     width="100%" 
                     style="border-radius:6px;">
            </a>

            <h3 style="font-size:18px;"><?= $row['nama_event']; ?></h3>

            <small><?= $row['tanggal_mulai']; ?></small>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
