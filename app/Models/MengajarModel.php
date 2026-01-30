<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

class MengajarModel extends Model
{
    protected $table      = 'mengajar';
    protected $primaryKey = 'id_dosen_mk';
    protected $allowedFields = ['id_dosen','id_mk'];
    protected $useTimestamps = false;

    public function getMataKuliahByDosen($idDosen)
    {
        return $this->db->table('mengajar m')
            ->select('m.id_dosen_mk, mk.id_mk, mk.nama_mk, mk.kode_mk, mk.sks')
            ->join('mata_kuliah mk','mk.id_mk=m.id_mk')
            ->where('m.id_dosen', $idDosen)
            ->get()->getResultArray();
    }

    public function getDosenWithMatkul(?string $q=null)
    {
        $builder = $this->db->table('dosen d')
            ->select('d.id_dosen, d.nama_dosen, d.nidn, d.prodi, GROUP_CONCAT(mk.nama_mk ORDER BY mk.nama_mk SEPARATOR \'; \' ) AS matkul')
            ->join('mengajar m','m.id_dosen=d.id_dosen','left')
            ->join('mata_kuliah mk','mk.id_mk=m.id_mk','left')
            ->groupBy('d.id_dosen');

        if ($q) {
            $builder->groupStart()
                ->like('d.nama_dosen', $q)
                ->orLike('mk.nama_mk', $q)
                ->groupEnd();
        }
        return $builder->get()->getResultArray();
    }
}
