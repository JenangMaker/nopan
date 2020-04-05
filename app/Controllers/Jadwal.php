<?php namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class Jadwal extends Controller
{
    //fungsi tampil Halaman utama jadwal
    public function index()
    {
        return view('jadwal\index');
    }

    //fungsi tampil halaman tambah jadwal
    public function new()
    {
        return view('jadwal\new');
    }

    //fungsi proses penambahan jadwal hasil kiriman dari tambah jadwal
    public function create()
    {
        try {
            if(! $this->validate([
                'jadwal' => 'required',
                'shift' => 'required',
            ],[
                'jadwal' => [
                    'required' => 'Semua harus diisi'
                ],
                'shift' => [
                    'required' => 'Shift harus diisi'
                ]
            ]))
            {
                return view('jadwal\new',[
                    'validation' => $this->validator
                ]);
            }
            else{
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

                return redirect()->to('/jadwal');
            }
        }catch (\Exception $e)
        {
            die($e->getMessage());
        }
    }

    //fungsi proses untuk tabel yang dihasilkan saat memilih jadwal
    //menggunakan ajax sehingga tidak melibatkan halaman dimuat ulang
    public function checkJadwal()
    {
        $data = $this->request->getVar('arr');

        $jumlah = count($data);

        $model = new JadwalModel();

        $temp1 = [];

        $temp2 = [];

        $temp3 = [];

        $temp4 = [];

        for ($i = 0; $i < $jumlah; $i++){
            $result = $model->where('jadwal',$data[$i])->findAll();

            $jumlah2 = count($result);

            $temp1[$i] = '0';
            $temp2[$i] = '0';
            $temp3[$i] = '0';
            $temp4[$i] = '0';

            if(!empty($result)){
                for ($j = 0; $j < $jumlah2; $j++)
                {
                    if ($result[$j]['shift'] == '1'){
                        $temp1[$i] = $result[$j]['shift'];
                    }
                    if ($result[$j]['shift'] == '2'){
                        $temp2[$i] = $result[$j]['shift'];
                    }
                    if ($result[$j]['shift'] == '3'){
                        $temp3[$i] = $result[$j]['shift'];
                    }
                    if ($result[$j]['shift'] == '4'){
                        $temp4[$i] = $result[$j]['shift'];
                    }
                }
            }
        }

        $data2['shift1'] = $temp1;
        $data2['shift2'] = $temp2;
        $data2['shift3'] = $temp3;
        $data2['shift4'] = $temp4;

        $data2['jadwal'] = $data;

        echo json_encode($data2);
    }
}