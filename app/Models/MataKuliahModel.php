<?php
namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table      = 'mata_kuliah';
    protected $primaryKey = 'id_mk';
    protected $allowedFields = ['nama_mk','kode_mk','sks'];
    protected $useTimestamps = false;

    public function searchByName(string $q)
    {
        return $this->like('nama_mk', $q)->orLike('kode_mk', $q);
    }
}
