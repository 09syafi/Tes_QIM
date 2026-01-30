<?php
namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\MataKuliahModel;
use App\Models\MengajarModel;
use CodeIgniter\HTTP\RedirectResponse;

class Dosen extends BaseController
{
    public function index()
    {
        $model = new DosenModel();
        $q = $this->request->getGet('q');
        if ($q) {
            $data['dosen'] = $model->searchByName($q)->orderBy('nama_dosen','asc')->findAll();
        } else {
            $data['dosen'] = $model->orderBy('nama_dosen','asc')->findAll();
        }
        $data['q'] = $q;
        return view('dosen/index', $data);
    }

    public function create()
    {
        return view('dosen/create');
    }

    public function store()
    {
        $model = new DosenModel();
        $rules = [
            'nama_dosen' => 'required|min_length[3]',
            'nidn'       => 'required|is_unique[dosen.nidn]',
            'prodi'      => 'required',
        ];
        $messages = [
            'nidn' => [
                'is_unique' => 'NIDN sudah terdaftar, tidak boleh sama.'
            ]
        ];

        if (!$this->validate($rules, $messages ?? [])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->save([
            'nama_dosen' => $this->request->getPost('nama_dosen'),
            'nidn' => $this->request->getPost('nidn'),
            'prodi' => $this->request->getPost('prodi'),
        ]);
        return redirect()->to('/dosen')->with('message','Data dosen ditambahkan');
    }

    public function edit($id)
    {
        $model = new DosenModel();
        $data['row'] = $model->find($id);
        if (!$data['row']) return redirect()->to('/dosen')->with('errors',['Dosen tidak ditemukan']);
        return view('dosen/edit', $data);
    }

    public function update($id)
    {
        $model = new DosenModel();
        $rules = [
            'nama_dosen' => 'required|min_length[3]',
            'nidn'       => "required|is_unique[dosen.nidn,id_dosen,{$id}]",
            'prodi'      => 'required',
        ];
        $messages = [
            'nidn' => [
                'is_unique' => 'NIDN sudah terdaftar, tidak boleh sama.'
            ]
        ];

        if (!$this->validate($rules, $messages ?? [])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->update($id, [
            'nama_dosen' => $this->request->getPost('nama_dosen'),
            'nidn'       => $this->request->getPost('nidn'),
            'prodi'      => $this->request->getPost('prodi'),
        ]);
        return redirect()->to('/dosen')->with('message','Data dosen diperbarui');
    }

    public function delete($id)
    {
        $model = new DosenModel();
        $model->delete($id);
        return redirect()->to('/dosen')->with('message','Data dosen dihapus');
    }

    public function mengajar($id)
    {
        $dosenModel = new DosenModel();
        $mkModel = new MataKuliahModel();
        $mengajarModel = new MengajarModel();

        $data['dosen'] = $dosenModel->find($id);
        if (!$data['dosen']) return redirect()->to('/dosen')->with('errors',['Dosen tidak ditemukan']);

        $data['matkul'] = $mkModel->orderBy('nama_mk','asc')->findAll();
        $data['ambil'] = $mengajarModel->getMataKuliahByDosen($id);
        return view('dosen/mengajar', $data);
    }

    public function tambahMengajar($id)
    {
        $mengajarModel = new MengajarModel();
        $id_mk = $this->request->getPost('id_mk');
        if ($id_mk) {
            $mengajarModel->insert(['id_dosen' => $id, 'id_mk' => $id_mk]);
        }
        return redirect()->to('/dosen/mengajar/'.$id)->with('message','Mata kuliah ditambahkan');
    }

    public function hapusMengajar($id, $id_dosen_mk)
    {
        $mengajarModel = new MengajarModel();
        $mengajarModel->delete($id_dosen_mk);
        return redirect()->to('/dosen/mengajar/'.$id)->with('message','Relasi mengajar dihapus');
    }
}
