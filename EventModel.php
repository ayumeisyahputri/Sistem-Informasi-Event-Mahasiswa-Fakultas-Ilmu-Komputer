<?php namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id_event';
    protected $allowedFields = [
        'nama_event','deskripsi','penyelenggara','lokasi',
        'tanggal_event','deadline_pendaftaran','kapasitas','created_at','updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
