<?php
namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'id_dosen';
    protected $allowedFields = ['nama_dosen','nidn','prodi'];
    protected $useTimestamps = false;

    public function searchByName(string $q)
    {
        return $this->like('nama_dosen', $q);
    }
}
