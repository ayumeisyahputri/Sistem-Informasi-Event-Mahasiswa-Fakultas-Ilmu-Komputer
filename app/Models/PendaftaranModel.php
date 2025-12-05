<?php namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table = 'pendaftaran_event';
    protected $primaryKey = 'id_pendaftaran_event';
    protected $allowedFields = ['id_event','id_mahasiswa','tanggal_daftar','bukti_upload','status'];
}
