<?php namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\Controller;

class Jadwal extends Controller
{
    public function index()
    {
        return view('jadwal\index');
    }

    public function new()
    {
        return view('jadwal\new');
    }

    public function create()
    {
        $jadwal = $this->request->getVar('jadwal');
        $shift = $this->request->getVar('shift');

        $jumlah = count($jadwal);

        $model = new JadwalModel();

        try {
            for ($i = 0; $i < $jumlah; $i++){
                $items = array(
                    'jadwal' => $jadwal[$i],
                    'shift' => $shift[$i],
                );
                $save = $model->insert($items);
            }
        } catch (\Exception $e){
            die($e->getMessage());
        }

        return redirect('/jadwal');
    }

    public function checkJadwal()
    {
        $data = $this->request->getVar('arr');
        echo json_encode($data);
    }
}