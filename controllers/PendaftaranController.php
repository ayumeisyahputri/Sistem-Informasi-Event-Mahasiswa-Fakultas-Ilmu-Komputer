<?php
include_once 'models/Pendaftaran.php';
include_once 'models/Event.php';

class PendaftaranController {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    public function formDaftar($id_event) {
        $eventModel = new Event($this->db);
        $data = $eventModel->getDetailEvent($id_event);

        include 'views/event/form_daftar.php';
    }

    public function prosesDaftar() {

        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $email = $_POST['email'];
        $id_event = $_POST['id_event'];

        $daftarModel = new Pendaftaran($this->db);

        if ($daftarModel->daftarEvent($nama, $nim, $email, $id_event)) {
            include 'views/event/success_daftar.php';
        } else {
            echo "Gagal mendaftar.";
        }
    }
}
