<?php
session_start();
include 'koneksi.php'; 

if (isset($_POST['login'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

  
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);

        if ($password == $data['password']) {
            
            $_SESSION['id_mahasiswa'] = $data['id_mahasiswa'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['status'] = "login";

            header("location:index.php");
        } else {
            header("location:login.php?pesan=gagal_pass");
        }
    } else {
        header("location:login.php?pesan=gagal_nim");
    }
}
?>
