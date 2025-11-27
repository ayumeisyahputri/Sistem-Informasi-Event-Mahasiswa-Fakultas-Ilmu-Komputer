<?php
class Event {
    private $koneksi;

    public function __construct($db) {
        $this->koneksi = $db;
    }

    public function getDetailEvent($id_event) {
        $query = "SELECT * FROM event WHERE id_event = $id_event";
        $result = mysqli_query($this->koneksi, $query);
        return mysqli_fetch_assoc($result);
    }
}
