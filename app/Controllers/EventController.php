<?php namespace App\Controllers;

use App\Models\EventModel;

class EventController extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    // tampil semua event
    public function index()
    {
        $data['event'] = $this->eventModel->orderBy('deadline_pendaftaran','ASC')->findAll();

        echo view('layout/header');
        echo view('event/index', $data);
        echo view('layout/footer');
    }

    public function detail($id)
    {
        $data['event'] = $this->eventModel->find($id);

        echo view('layout/header');
        echo view('event/detail', $data);
        echo view('layout/footer');
    }

    // HANYA ADMIN YANG BISA AKSES HALAMAN INI
    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/event')->with('error', 'Anda bukan admin.');
        }

        echo view('layout/header');
        echo view('event/create');
        echo view('layout/footer');
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/event')->with('error', 'Anda bukan admin.');
        }

        // SIMPAN EVENT
        $this->eventModel->save([
            'nama_event' => $this->request->getPost('nama_event'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'penyelenggara' => $this->request->getPost('penyelenggara'),
            'deadline_pendaftaran' => $this->request->getPost('deadline_pendaftaran'),
        ]);

        // NOTIFIKASI EVENT BARU (dari HEAD)
        $notifModel = new \App\Models\NotifikasiModel();
        $notifModel->insert([
            'user_id'   => 0,  
            'judul'     => 'Event Baru',
            'pesan'     => 'Event "' . $this->request->getPost('nama_event') . '" telah ditambahkan.',
            'is_read'   => 0,
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/event')->with('success', 'Event ditambahkan.');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/event')->with('error', 'Anda bukan admin.');
        }

        $data['event'] = $this->eventModel->find($id);

        echo view('layout/header');
        echo view('event/edit', $data);
        echo view('layout/footer');
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/event')->with('error', 'Anda bukan admin.');
        }

        $this->eventModel->update($id, [
            'nama_event' => $this->request->getPost('nama_event'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'penyelenggara' => $this->request->getPost('penyelenggara'),
            'deadline_pendaftaran' => $this->request->getPost('deadline_pendaftaran'),
        ]);

        return redirect()->to('/event')->with('success', 'Event diperbarui.');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/event')->with('error', 'Anda bukan admin.');
        }

        $this->eventModel->delete($id);

        return redirect()->to('/event')->with('success', 'Event dihapus.');
    }
}