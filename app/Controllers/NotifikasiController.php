<?php namespace App\Controllers;

use App\Models\NotifikasiModel;

class NotifikasiController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new NotifikasiModel();
    }

    // halaman daftar notifikasi mahasiswa
    public function index()
    {
        $user = session()->get('user');
        $id_user = $user['id_mahasiswa'] ?? null;

        $data['notif'] = $this->model
                              ->where('id_mahasiswa', $id_user)
                              ->orderBy('tanggal', 'DESC')
                              ->findAll();

        echo view('layout/header');
        echo view('notifikasi/index', $data); // pakai folder yg di branch ayumei
        echo view('layout/footer');
    }

    // hitung unread → JSON untuk navbar badge
    public function countUnread()
    {
        $user = session()->get('user');
        $id_user = $user['id_mahasiswa'] ?? null;

        $count = 0;

        if ($id_user) {
            $count = $this->model
                          ->where('id_mahasiswa', $id_user)
                          ->where('status_baca', 'unread')
                          ->countAllResults();
        }

        return $this->response->setJSON(['count' => $count]);
    }

    // tandai satu notifikasi sebagai read
    public function markRead($id = null)
    {
        if ($id) {
            $this->model->update($id, [
                'status_baca' => 'read'
            ]);
        }
        return redirect()->back();
    }

    // hapus notifikasi
    public function delete($id = null)
    {
        if ($id) {
            $this->model->delete($id);
        }

        return redirect()->back()->with('success', 'Notifikasi dihapus.');
    }

    // helper membuat notifikasi untuk satu user
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

    // helper broadcast ke semua mahasiswa
    public function createBroadcast($pesan, $link = null)
    {
        $db = \Config\Database::connect();
        $rows = $db->table('mahasiswa')->select('id_mahasiswa')->get()->getResultArray();

        foreach ($rows as $row) {
            $this->create($row['id_mahasiswa'], $pesan, $link);
        }
    }
}