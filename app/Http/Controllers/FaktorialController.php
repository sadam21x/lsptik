<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class FaktorialController extends Controller
{
    /**
     * Function untuk menampilkan view halaman perhitungan faktorial
     * @return view
     */
    public function index()
    {
        return view('faktorial');
    }

    /**
     * Function untuk menyimpan histori perhitungan ke dalam file csv
     * @param Request
     * @return (json) response 
     */
    public function store(Request $request)
    {
        $bilangan = $request->bilangan;
        $pangkat = $request->pangkat;
        $hasil = $request->hasil;

        $tanggal = date('d/m/Y');
        $jam = date('H:i:s');
        $jenis_perhitungan = 'Faktorial';

        $data = array(
            $tanggal,
            $jam,
            $jenis_perhitungan,
            $bilangan,
            $hasil
        );

        try {
            $file_open = fopen(base_path().'/public/assets/csv/histori_perhitungan_faktorial.csv', 'a');
            fputcsv($file_open, $data);
            fclose($file_open);

            $response['code'] = 1;

            return response()->json($response);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $response['code'] = 0;
            $response['msg'] = $msg;

            return response()->json($response);
        }
    }

    /**
     * Function untuk membaca file csv histori perhitungan
     * kemudian menyimpan datanya dalam bentuk array
     * @return (json) response
     */
    public function read_csv()
    {
        try {
            $file_open = fopen(base_path().'/public/assets/csv/histori_perhitungan_faktorial.csv', 'r');
            $data = [];

            if($file_open !== false){
                while(!feof($file_open)){
                    $row = fgetcsv($file_open);
                    array_push($data, $row);
                }
            }
            
            fclose($file_open);

            $response['code'] = 1;
            $response['content'] = $data;

            return response()->json($response);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $response['code'] = 0;
            $response['msg'] = $msg;

            return response()->json($response);
        }
    }

}
