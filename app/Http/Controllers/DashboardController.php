<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Function yang berfungsi untuk menampilkan view halaman dashboard
     * beserta data-data yang diperlukan
     * @return view
     */
    public function index()
    {
        $faktorial = [];
        $perpangkatan = [];
        $read_faktorial = $this->read_faktorial_csv();
        $read_perpangkatan = $this->read_perpangkatan_csv();

        if($read_faktorial['code'] == 1){
            $faktorial = $read_faktorial['content'];
        }
        
        if($read_perpangkatan['code'] == 1){
            $perpangkatan = $read_perpangkatan['content'];
        }

        $total_perhitungan_faktorial = count($faktorial);
        $total_perhitungan_perpangkatan = count($perpangkatan);
        $total_perhitungan = $total_perhitungan_faktorial + $total_perhitungan_perpangkatan;

        if($total_perhitungan != 0){
            $presentase_faktorial = ($total_perhitungan_faktorial / $total_perhitungan) * 100;
            $presentase_perpangkatan = ($total_perhitungan_perpangkatan / $total_perhitungan) * 100;
        } else {
            $presentase_faktorial = 0;
            $presentase_perpangkatan = 0;
        }

        return view('dashboard', compact(
            'total_perhitungan_faktorial',
            'total_perhitungan_perpangkatan',
            'total_perhitungan',
            'presentase_faktorial',
            'presentase_perpangkatan'
        ));
    }

    /**
     * Function yang berfungsi untuk membaca file csv histori perhitungan faktorial
     * kemudian data dikelola untuk dimasukkan ke dalam array
     * @return arr
     */
    private function read_faktorial_csv()
    {
        try {
            $file_open = fopen(base_path().'/public/assets/csv/histori_perhitungan_faktorial.csv', 'r');
            $data = [];
            $result = [];

            if($file_open !== false){
                while(!feof($file_open)){
                    $row = fgetcsv($file_open);
                    array_push($data, $row);
                }
            }
            
            fclose($file_open);

            for($i = 0; $i < count($data); $i++){
                if($data[$i] != false){
                    $tmp_arr_content = [
                        'tanggal' => $data[$i][0],
                        'jam' => $data[$i][1],
                        'jenis_perhitungan' => $data[$i][2],
                        'input' => $data[$i][3],
                        'output' => $data[$i][3],
                    ];

                    array_push($result, $tmp_arr_content);
                }
            }            

            $response['code'] = 1;
            $response['content'] = $result;

            return $response;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $response['code'] = 0;
            $response['msg'] = $msg;

            return $response;
        }
    }
    
    /**
     * Function yang berfungsi untuk membaca file csv histori perhitungan perpangkatan
     * kemudian data dikelola untuk dimasukkan ke dalam array
     * @return arr
     */
    private function read_perpangkatan_csv()
    {
        try {
            $file_open = fopen(base_path().'/public/assets/csv/histori_perhitungan_perpangkatan.csv', 'r');
            $data = [];
            $result = [];

            if($file_open !== false){
                while(!feof($file_open)){
                    $row = fgetcsv($file_open);
                    array_push($data, $row);
                }
            }
            
            fclose($file_open);

            for($i = 0; $i < count($data); $i++){
                if($data[$i] != false){
                    $tmp_arr_content = [
                        'tanggal' => $data[$i][0],
                        'jam' => $data[$i][1],
                        'jenis_perhitungan' => $data[$i][2],
                        'input' => $data[$i][3],
                        'output' => $data[$i][3],
                    ];

                    array_push($result, $tmp_arr_content);
                }
            }            

            $response['code'] = 1;
            $response['content'] = $result;

            return $response;
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $response['code'] = 0;
            $response['msg'] = $msg;

            return $response;
        }
    }
}
