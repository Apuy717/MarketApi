<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\getItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\TransaksiResource;
use App\Models\Barang;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = TransaksiResource::collection(Transaksi::all());
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['data'] = "empty";
            return response()->json($response);
        }
    }

    public function ShowById($id)
    {
        // $data = Transaksi::find($id);
        $data = TransaksiResource::collection(Transaksi::where('id', $id)->get());
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['data'] = "empty";
            return response()->json($response);
        }
    }

    public function store(Request $request)
    {
        $g = '#ANS_';
        $gen = $g . '' . date('dmyhis');
        $dataP = Transaksi::create(['code_transaksi' => $gen, 'user_id' => 1]);
        $parrent = DB::table('t_transaksi')->max('id');
        $prn = Transaksi::find($parrent);
        $dateTime = date('d:m:Y H:i:s');

        $datas = [];
        foreach ($request->json()->all() as $cb) {
            $sub[] =  $cb['sub_total'];
            $datas[] = ["transaksi_code" => $prn->code_transaksi, 'barang_code' => $cb['barang_code'], 'quantity' => $cb['quantity'], 'sub_total' => $cb['sub_total'], 'created_at' => $dateTime, 'updated_at' => $dateTime];
        }
        $total_sub = (array_sum($sub));

        DB::table('t_master_transaksi')->insert($datas);
        $prn->total = $total_sub;
        $prn->save();
        $response['status'] = 'sukses';
        $response['data'] = $prn;
        $response['items'] = $datas;
        return response()->json($response);
    }

    public function getItems($code)
    {
        $data = getItemResource::collection(Barang::where('code', $code)->get());
        // dd($data);
        if (count($data) > 0) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['data'] = "empty";
            return response()->json($response);
        }
    }
    public function update()
    {
    }

    public function delete()
    {
    }
}
