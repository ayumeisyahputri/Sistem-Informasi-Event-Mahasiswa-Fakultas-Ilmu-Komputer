<?php namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    protected $mhsModel;

    public function __construct()
    {
        $this->mhsModel = new MahasiswaModel();
    }

    public function index()
    {
        $data['mahasiswa'] = $this->mhsModel->findAll();
        echo view('layout/header');
        echo view('mahasiswa/index', $data);
        echo view('layout/footer');
    }

    public function create()
    {
        echo view('layout/header');
        echo view('mahasiswa/create');
        echo view('layout/footer');
    }

    public function store()
    {
        $this->mhsModel->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role') ?? 'user'
        ]);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa ditambahkan.');
    }

    public function edit($id)
    {
        $data['mhs'] = $this->mhsModel->find($id);
        echo view('layout/header');
        echo view('mahasiswa/edit', $data);
        echo view('layout/footer');
    }

    public function update($id)
    {
        $this->mhsModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role') ?? 'user'
        ]);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa diperbarui.');
    }

    public function delete($id)
    {
        $this->mhsModel->delete($id);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa dihapus.');
    }
}
