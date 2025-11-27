<?php
include_once 'models/Event.php';

class EventController {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    public function detail($id_event) {
        $eventModel = new Event($this->db);
        $data = $eventModel->getDetailEvent($id_event);

        include 'views/event/detail_event.php';
    }
}
