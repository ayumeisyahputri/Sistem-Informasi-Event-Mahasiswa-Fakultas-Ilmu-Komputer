<?php namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $allowedFields = ['id_mahasiswa','pesan','link','tanggal','status_baca'];
    protected $useTimestamps = false;

    // helper: create notification
    public function createNotif($data)
    {
        return $this->insert($data);
    }

    public function countUnreadFor($id_mahasiswa)
    {
        return $this->where('id_mahasiswa', $id_mahasiswa)
                    ->where('status_baca', 'unread')
                    ->countAllResults();
    }
}