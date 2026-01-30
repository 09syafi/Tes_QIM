<?php
namespace App\Controllers;

use App\Models\MengajarModel;

class Home extends BaseController
{
    public function index()
    {
        $q = $this->request->getGet('q');
        $mengajar = new MengajarModel();
        $data['q'] = $q;
        $data['rows'] = $mengajar->getDosenWithMatkul($q);
        return view('home', $data);
    }
}
