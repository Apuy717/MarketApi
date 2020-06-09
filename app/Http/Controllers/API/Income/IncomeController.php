<?php

namespace App\Http\Controllers\API\Income;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {

        $bln1 = date('m');
        $bln2 = date('m');
        // if ($bln1 >= $bln2) {
        //     dd('cukup');
        // } else {
        //     dd('sudah lebih');
        // }
        //add comment

        $start_date = '01:' . $bln1 . ':2020 00:00:00';
        $end_date =  '30:' . $bln2 . ':2020 23:59:00';

        $data =  DB::table('t_barang')
            ->join('t_master_transaksi', 't_master_transaksi.barang_code', '=', 't_barang.code')
            ->select('t_master_transaksi.id', 't_master_transaksi.barang_code', 't_barang.name', 't_barang.price_in', 't_master_transaksi.quantity', 't_master_transaksi.sub_total', 't_master_transaksi.created_at')
            ->whereBetween('t_master_transaksi.created_at', array($start_date, $end_date))->get();



        if (count($data) > 0) {
            $res = [];
            foreach ($data as $dt) {
                $quanty[] =  $dt->quantity;
                $res[] = $dt->sub_total;
                $ress[] = $dt->price_in * $dt->quantity;
            }

            $propit = array_sum($res);
            $capital = array_sum($ress);
            // dd($capital);
            $income = $propit - $capital;

            $response['status'] = 'sukses';
            $response['data'] = $income;
            $response['tgl'] = 'dari tgl :' . $start_date . ' ' . 'sampai tgl :' . $end_date;

            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            $response['data'] = 0;

            return response()->json($response);
        }
    }
}
