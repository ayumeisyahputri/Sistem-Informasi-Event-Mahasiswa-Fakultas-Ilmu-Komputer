<?php namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id_event';

    protected $allowedFields = [
        'nama_event',
        'deskripsi',
        'penyelenggara',
        'deadline_pendaftaran',
        'kapasitas' 
    ];
}
