<?php namespace App\Controllers;

use App\Models\EventModel;
use App\Models\PendaftaranModel;
use App\Models\NotifikasiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $eventModel = new EventModel();
        $pendaftaranModel = new PendaftaranModel();
        $notifModel = new NotifikasiModel();

        // beberapa ringkasan sederhana
        $data = [
            'count_events' => count($eventModel->findAll()),
            'count_pendaftaran' => count($pendaftaranModel->where('id_mahasiswa', session()->get('user')['id_mahasiswa'])->findAll()),
            'notifikasi' => $notifModel->where('id_mahasiswa', session()->get('user')['id_mahasiswa'])->orderBy('tanggal', 'DESC')->findAll()
        ];

        echo view('layout/header');
        echo view('dashboard/index', $data);
        echo view('layout/footer');
    }
}
