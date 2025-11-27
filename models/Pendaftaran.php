<?php
class Pendaftaran {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function daftarEvent($nama, $nim, $email, $id_event) {

        $query = "INSERT INTO pendaftaran (nama, nim, email, id_event) 
                  VALUES ('$nama', '$nim', '$email', '$id_event')";

        return mysqli_query($this->koneksi, $query);
    }
}
