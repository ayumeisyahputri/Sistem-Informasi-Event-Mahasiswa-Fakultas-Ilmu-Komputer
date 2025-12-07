<?php namespace App\Controllers;

use App\Models\NotifikasiModel;
use App\Controllers\BaseController;

class NotifikasiController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new NotifikasiModel();
    }

    // halaman daftar notifikasi mahasiswa (view)
    public function index()
    {
        $user = session()->get('user');
        $id_user = $user['id_mahasiswa'] ?? null;

        $data['notif'] = $this->model
                             ->where('id_mahasiswa', $id_user)
                             ->orderBy('tanggal', 'DESC')
                             ->findAll();

        echo view('layout/header');
        echo view('mahasiswa/notifikasi', $data);
        echo view('layout/footer');
    }

    // route: /notifikasi/countUnread -> return JSON {count: n}
    public function countUnread()
    {
        $user = session()->get('user');
        $id_user = $user['id_mahasiswa'] ?? null;
        $count = 0;
        if ($id_user) {
            $count = $this->model->where('id_mahasiswa', $id_user)
                                 ->where('status_baca','unread')
                                 ->countAllResults();
        }
        return $this->response->setJSON(['count' => $count]);
    }

    // mark satu notifikasi read (AJAX or link)
    public function markRead($id = null)
    {
        if ($id) {
            $this->model->update($id, ['status_baca' => 'read']);
        }
        return redirect()->back();
    }

    // delete notice
    public function delete($id = null)
    {
        if ($id) {
            $this->model->delete($id);
        }
        return redirect()->back()->with('success','Notifikasi dihapus.');
    }

    // helper: buat notifikasi (dipanggil dari controller lain)
    public function create($id_mahasiswa, $pesan, $link = null)
    {
        $data = [
            'id_mahasiswa' => $id_mahasiswa,
            'pesan'        => $pesan,
            'link'         => $link,
            'tanggal'      => date('Y-m-d H:i:s'),
            'status_baca'  => 'unread'
        ];
        return $this->model->insert($data);
    }

    // helper: buat notifikasi broadcast (ke semua mahasiswa)
    public function createBroadcast($pesan, $link = null)
    {
        // ambil semua mahasiswa id
        $db = \Config\Database::connect();
        $res = $db->table('mahasiswa')->select('id_mahasiswa')->get()->getResultArray();
        foreach ($res as $row) {
            $this->create($row['id_mahasiswa'], $pesan, $link);
        }
    }
}