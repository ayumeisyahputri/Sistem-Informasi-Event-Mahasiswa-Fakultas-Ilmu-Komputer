<?php namespace App\Controllers;

use App\Models\NotifikasiModel;

class NotifikasiController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new NotifikasiModel();
    }

    public function index()
    {
        $id_user = session()->get('user')['id_mahasiswa'];
        $data['notif'] = $this->model->where('id_mahasiswa', $id_user)->orderBy('tanggal','DESC')->findAll();

        echo view('layout/header');
        echo view('notifikasi/index', $data);
        echo view('layout/footer');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/notifikasi')->with('success', 'Notifikasi dihapus.');
    }
}
