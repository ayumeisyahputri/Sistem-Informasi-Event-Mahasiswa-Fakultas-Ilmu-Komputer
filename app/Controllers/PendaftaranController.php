<?php namespace App\Controllers;

use App\Models\PendaftaranModel;
use App\Models\EventModel;
use App\Models\MahasiswaModel;

class PendaftaranController extends BaseController
{
    protected $pendaftaranModel;
    protected $eventModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->pendaftaranModel = new PendaftaranModel();
        $this->eventModel = new EventModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    // =======================
    // LIST / RIWAYAT MAHASISWA
    // =======================
    public function index()
    {
        $user = session()->get('user');
        if (!$user) return redirect()->to('/login');

        $data['pendaftaran'] = $this->pendaftaranModel
            ->where('id_mahasiswa', $user['id_mahasiswa'])
            ->orderBy('tanggal_daftar', 'DESC')
            ->findAll();

        echo view('layout/header');
        echo view('mahasiswa/daftar_history', $data);
        echo view('layout/footer');
    }

    // =======================
    // FORM DAFTAR EVENT
    // =======================
    public function create($id_event)
    {
        $user = session()->get('user');
        if (!$user) return redirect()->to('/login');

        $event = $this->eventModel->find($id_event);
        if (!$event) return redirect()->back()->with('error', 'Event tidak ditemukan.');

        // Hitung kuota tersisa
        $count = $this->pendaftaranModel->where('id_event', $id_event)->countAllResults();
        $sisaKuota = $event['kapasitas'] - $count;

        // Cek apakah mahasiswa sudah mendaftar event ini
        $sudah = $this->pendaftaranModel
            ->where([
                'id_event' => $id_event,
                'id_mahasiswa' => $user['id_mahasiswa']
            ])
            ->first();

        $data = [
            'event'        => $event,
            'sisa_kuota'   => $sisaKuota,
            'sudah_daftar' => $sudah ? true : false
        ];

        echo view('layout/header');
        echo view('mahasiswa/daftar_event', $data);
        echo view('layout/footer');
    }

    // =======================
    // PROSES DAFTAR
    // =======================
    public function store()
    {
        helper(['form', 'url']);
        $user = session()->get('user');
        if (!$user) return redirect()->to('/login');

        $id_event = $this->request->getPost('id_event');
        $event = $this->eventModel->find($id_event);

        if (!$event)
            return redirect()->back()->with('error', 'Event tidak ada.');

        // Sudah daftar?
        $exists = $this->pendaftaranModel
            ->where([
                'id_event' => $id_event,
                'id_mahasiswa' => $user['id_mahasiswa']
            ])
            ->first();
        if ($exists)
            return redirect()->back()->with('error', 'Anda sudah mendaftar event ini.');

        // Kuota penuh?
        $count = $this->pendaftaranModel->where('id_event', $id_event)->countAllResults();
        if ($count >= $event['kapasitas'])
            return redirect()->back()->with('error', 'Kuota event sudah penuh.');

        // Validasi file KTM
        $file = $this->request->getFile('ktm');
        if (!$file->isValid())
            return redirect()->back()->with('error', 'File KTM belum diupload.');

        $allowed = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($file->getClientMimeType(), $allowed))
            return redirect()->back()->with('error', 'Hanya JPG/PNG/PDF yang diizinkan.');

        if ($file->getSize() > 3 * 1024 * 1024)
            return redirect()->back()->with('error', 'File maksimal 3MB.');

        // Simpan KTM
        $fileName = $file->getRandomName();
        $file->move(FCPATH . 'uploads/ktm', $fileName);

        // Simpan pendaftaran
        $this->pendaftaranModel->insert([
            'id_event'       => $id_event,
            'id_mahasiswa'   => $user['id_mahasiswa'],
            'tanggal_daftar' => date('Y-m-d'),
            'bukti_upload'   => $fileName,
            'status'         => 'Menunggu'
        ]);

        return redirect()->to('/pendaftaran')
            ->with('success', 'Pendaftaran berhasil!');
    }

    // =======================
    // DOWNLOAD BUKTI PENDAFTARAN (BUKAN KTM)
    // =======================
    public function download($id)
    {
        $data = $this->pendaftaranModel->find($id);
        if (!$data) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $user = session()->get('user');
        if ($data['id_mahasiswa'] != $user['id_mahasiswa'] && session()->get('role') != 'admin')
            return redirect()->back()->with('error', 'Tidak ada akses.');

        // Ambil data tambahan
        $mhs = $this->mahasiswaModel->find($data['id_mahasiswa']);
        $event = $this->eventModel->find($data['id_event']);

        // Buat isi bukti
        $html = "
            <h2>Bukti Pendaftaran Event</h2>
            <p><b>Nama:</b> {$mhs['nama']}</p>
            <p><b>NIM:</b> {$mhs['nim']}</p>
            <p><b>Event:</b> {$event['nama_event']}</p>
            <p><b>Penyelenggara:</b> {$event['penyelenggara']}</p>
            <p><b>Tanggal Daftar:</b> {$data['tanggal_daftar']}</p>
            <p><b>Status:</b> {$data['status']}</p>
            <hr>
            <p>Terima kasih sudah mendaftar event mahasiswa.</p>
        ";

        $filename = "bukti_pendaftaran_{$id}.html";
        $path = FCPATH . "uploads/bukti/" . $filename;

        // Pastikan folder ada
        if (!is_dir(FCPATH . 'uploads/bukti'))
            mkdir(FCPATH . 'uploads/bukti', 0777, true);

        file_put_contents($path, $html);

        return $this->response->download($path, null);
    }
}
