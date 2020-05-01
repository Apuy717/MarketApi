<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Transaksi_master;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $tmt = 't_master_transaksi';
        $tb = 't_barang';
        $tc = 't_category';
        $tr = 't_transaksi';
        $us = 'users';

        $data = DB::table($tr)
            ->join('t_master_transaksi', 't_master_transaksi.transaksi_code', '=', 't_transaksi.code_transaksi')
            ->join($us, $us . '.id', '=', $tr . '.user_id')
            ->join($tb, $tb . '.code', '=', $tmt . '.barang_code')
            ->join($tc, $tc . '.id', '=', $tb . '.category_id')
            ->select($tr . '.code_transaksi', $us . '.name as nama kasir', 'role', $tb . '.code', $tb . '.name as nama barang', 'category', 'price_out', 'quantity', 'total as total bayar', $tr . '.created_at as tgl')
            ->get();

        $response['status'] = "sukses";
        $response['data'] = $data;
        return response()->json($response);
    }

    public function ShowById($id)
    {
        $data = Transaksi::find($id);
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data and $data->Transaksi_master;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['data'] = "empty";
            return response()->json($response);
        }
    }

    public function byId(Request $request)
    {
        $code = $request->code_barang;
        $tmt = 't_master_transaksi';
        $tb = 't_barang';
        $tc = 't_category';
        $tr = 't_transaksi';
        $us = 'users';

        // $data = DB::table($tr)
        //     ->join('t_master_transaksi', 't_master_transaksi.transaksi_code', '=', 't_transaksi.code_transaksi')
        //     ->join($us, $us . '.id', '=', $tr . '.user_id')
        //     ->join($tb, $tb . '.code', '=', $tmt . '.barang_code')
        //     ->join($tc, $tc . '.id', '=', $tb . '.category_id')
        //     ->select($tr . '.code_transaksi', $us . '.name as nama kasir', 'role', $tb . '.code', $tb . '.name as nama barang', 'category', 'price_out', 'quantity', 'total as total all', $tr . '.created_at as tgl')
        //     ->where($tr . '.code_transaksi', $code)
        //     ->get();
        $data = Transaksi::find($code);
        $response['status'] = "sukses";
        $response['data'] = $data;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $g = '#ANS_';
        $gen = $g . '' . date('dmyhis');
        $dataP = Transaksi::create(['code_transaksi' => $gen, 'user_id' => 1]);
        $parrent = DB::table('t_transaksi')->max('id');
        $prn = Transaksi::find($parrent);

        $datas = [];
        foreach ($request->json()->all() as $cb) {
            $sub[] =  $cb['sub_total'];
            $datas[] = ["transaksi_code" => $prn->code_transaksi, 'barang_code' => $cb['barang_code'], 'quantity' => $cb['quantity'], 'sub_total' => $cb['sub_total']];
        }
        $total_sub = (array_sum($sub));

        DB::table('t_master_transaksi')->insert($datas);
        $prn->total = $total_sub;
        $prn->save();
        $response['status'] = 'sukses';
        $response['dataP'] = $prn;
        $response['dataC'] = $datas;
        return response()->json($response);
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
