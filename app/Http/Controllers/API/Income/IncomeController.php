<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $data =  DB::table('t_barang')
            ->join('t_master_transaksi', 't_master_transaksi.barang_code', '=', 't_barang.code')
            ->select('t_master_transaksi.id', 't_master_transaksi.barang_code', 't_barang.name', 't_barang.price_in', 't_master_transaksi.sub_total')
            ->get();


        if (count($data) > 0) {
            $res = [];
            foreach ($data as $dt) {
                $res[] = $dt->sub_total;
                $ress[] = $dt->price_in;
            }

            $propit = array_sum($res);
            $capital = array_sum($ress);
            // dd($capital);
            $income = $propit - $capital;

            $response['status'] = 'sukses';
            $response['data'] = $income;

            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            $response['data'] = 0;

            return response()->json($response);
        }
    }
}
