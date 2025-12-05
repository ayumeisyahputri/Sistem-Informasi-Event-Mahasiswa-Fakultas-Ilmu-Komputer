<?php namespace App\Controllers;

use App\Models\PendaftaranModel;

class PendaftaranController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new PendaftaranModel();
    }

    public function index()
    {
        // jika admin lihat semua, user lihat miliknya
        if (session()->get('role') === 'admin') {
            $data['data'] = $this->model->findAll();
        } else {
            $data['data'] = $this->model->where('id_mahasiswa', session()->get('user')['id_mahasiswa'])->findAll();
        }
        echo view('layout/header');
        echo view('pendaftaran/index', $data);
        echo view('layout/footer');
    }

    // show form daftar ke event id
    public function create($id_event)
    {
        $data['id_event'] = $id_event;
        echo view('layout/header');
        echo view('pendaftaran/create', $data);
        echo view('layout/footer');
    }

    public function store()
    {
        // upload file (sederhana: nama file simpan)
        $file = $this->request->getFile('bukti');
        $fileName = null;
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . '../public/uploads/bukti_pendaftaran', $fileName);
        }

        $this->model->save([
            'id_event' => $this->request->getPost('id_event'),
            'id_mahasiswa' => session()->get('user')['id_mahasiswa'],
            'tanggal_daftar' => date('Y-m-d'),
            'bukti_upload' => $fileName,
            'status' => 'Menunggu'
        ]);
        return redirect()->to('/pendaftaran')->with('success', 'Pendaftaran dikirim.');
    }

    public function edit($id)
    {
        $data['data'] = $this->model->find($id);
        echo view('layout/header');
        echo view('pendaftaran/edit', $data);
        echo view('layout/footer');
    }

    public function update($id)
    {
        $this->model->update($id, [
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('/pendaftaran')->with('success', 'Pendaftaran diperbarui.');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/pendaftaran')->with('success', 'Pendaftaran dihapus.');
    }
}

