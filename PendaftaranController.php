<?php
session_start();
include '../db.php';

if (isset($_POST['daftar'])) {

    $id_event = $_POST['id_event'];
    $id_mahasiswa = $_SESSION['id_mahasiswa'];
    $tanggal = date("Y-m-d");

    $query = "INSERT INTO pendaftaran_event 
              (id_event, id_mahasiswa, tanggal_daftar, bukti_upload, status)
              VALUES ($id_event, $id_mahasiswa, '$tanggal', '', 'Menunggu')";

    mysqli_query($conn, $query);

    header("Location: ../detail_event.php?id=$id_event&status=success");
    exit;
}
?>

