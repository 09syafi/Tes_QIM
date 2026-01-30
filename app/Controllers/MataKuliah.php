<?php
namespace App\Controllers;

use App\Models\MataKuliahModel;

class MataKuliah extends BaseController
{
    public function index()
    {
        $model = new MataKuliahModel();
        $q = $this->request->getGet('q');
        if ($q) {
            $data['matkul'] = $model->searchByName($q)->orderBy('nama_mk','asc')->findAll();
        } else {
            $data['matkul'] = $model->orderBy('nama_mk','asc')->findAll();
        }
        $data['q'] = $q;
        return view('mk/index', $data);
    }

    public function create()
    {
        return view('mk/create');
    }

    public function store()
    {
        $model = new MataKuliahModel();
        $rules = [
            'nama_mk' => 'required|min_length[2]',
            'kode_mk' => 'required|is_unique[mata_kuliah.kode_mk]',
            'sks'     => 'required|is_natural_no_zero',
        ];
        $messages = [
            'kode_mk' => [
                'is_unique' => 'Kode MK sudah terdaftar, tidak boleh sama.'
            ]
        ];

        if (!$this->validate($rules, $messages ?? [])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->save([
            'nama_mk' => $this->request->getPost('nama_mk'),
            'kode_mk' => $this->request->getPost('kode_mk'),
            'sks'     => (int)$this->request->getPost('sks'),
        ]);
        return redirect()->to('/mata-kuliah')->with('message','Data mata kuliah ditambahkan');
    }

    public function edit($id)
    {
        $model = new MataKuliahModel();
        $data['row'] = $model->find($id);
        if (!$data['row']) return redirect()->to('/mata-kuliah')->with('errors',['Mata kuliah tidak ditemukan']);
        return view('mk/edit', $data);
    }

    public function update($id)
    {
        $model = new MataKuliahModel();
        $rules = [
            'nama_mk' => 'required|min_length[2]',
            'kode_mk' => "required|is_unique[mata_kuliah.kode_mk,id_mk,{$id}]",
            'sks'     => 'required|is_natural_no_zero',
        ];
        $messages = [
            'kode_mk' => [
                'is_unique' => 'Kode MK sudah terdaftar, tidak boleh sama.'
            ]
        ];

        if (!$this->validate($rules, $messages ?? [])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->update($id, [
            'nama_mk' => $this->request->getPost('nama_mk'),
            'kode_mk' => $this->request->getPost('kode_mk'),
            'sks'     => (int)$this->request->getPost('sks'),
        ]);
        return redirect()->to('/mata-kuliah')->with('message','Data mata kuliah diperbarui');
    }

    public function delete($id)
    {
        $model = new MataKuliahModel();
        $model->delete($id);
        return redirect()->to('/mata-kuliah')->with('message','Data mata kuliah dihapus');
    }
}
