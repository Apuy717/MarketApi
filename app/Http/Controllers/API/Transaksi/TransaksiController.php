<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Resources\getItemMembers;
use App\Http\Resources\getItemResource;
use App\Http\Resources\getItemSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\TransaksiResource;
use App\Models\Barang;
use App\Models\Payment;
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

    public function store(Request $request, $params = null)
    {
        $g = '#ANS_';
        $gen = $g . '' . date('dmyhis');
        Transaksi::create(['code_transaksi' => $gen, 'user_id' => 1, 'members_id' => $params]);
        $parrent = DB::table('t_transaksi')->max('id');
        $prn = Transaksi::find($parrent);
        $dateTime = date('d:m:Y H:i:s');

        $datas = [];
        foreach ($request->json()->all() as $cb) {
            $cb[] = $cb;
            $sub[] =  $cb['sub_total'];
            $datas[] = ["transaksi_code" => $prn->code_transaksi, 'barang_code' => $cb['barang_code'], 'quantity' => $cb['quantity'], 'sub_total' => $cb['sub_total'], 'created_at' => $dateTime, 'updated_at' => $dateTime];
            $stock =  DB::table('t_barang')->where('code', $cb['barang_code'])->select('stock')->get();
            $stockUpdate = $stock[0]->stock - ($cb['quantity']);
            DB::table('t_barang')->where('code', $cb['barang_code'])->update(['stock' => $stockUpdate]);
        }

        $total_sub = (array_sum($sub));
        if ($total_sub > 20000) {
            Payment::create(['members_id' => $params, 'saldo_pay' => 500]);
        }

        DB::table('t_master_transaksi')->insert($datas);
        $prn->total = $total_sub;
        $prn->save();
        $response['status'] = 'sukses';
        $response['data'] = $prn;
        $response['items'] = $datas;
        return response()->json($response);
    }

    public function storeUmum(Request $request)
    {
        $g = '#ANS_';
        $gen = $g . '' . date('dmyhis');
        Transaksi::create(['code_transaksi' => $gen, 'user_id' => 1, 'members_id' => 1]);
        $parrent = DB::table('t_transaksi')->max('id');
        $prn = Transaksi::find($parrent);
        $dateTime = date('d:m:Y H:i:s');

        $datas = [];
        foreach ($request->json()->all() as $cb) {
            $cb[] = $cb;
            $sub[] =  $cb['sub_total'];
            $datas[] = ["transaksi_code" => $prn->code_transaksi, 'barang_code' => $cb['barang_code'], 'quantity' => $cb['quantity'], 'sub_total' => $cb['sub_total'], 'created_at' => $dateTime, 'updated_at' => $dateTime];
            $stock =  DB::table('t_barang')->where('code', $cb['barang_code'])->select('stock')->get();
            $stockUpdate = $stock[0]->stock - ($cb['quantity']);
            DB::table('t_barang')->where('code', $cb['barang_code'])->update(['stock' => $stockUpdate]);
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

    public function getItemsMembers($code)
    {
        $data = getItemMembers::collection(Barang::where('code', $code)->get());
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

    public function getItemSeller($code)
    {
        $data = getItemSeller::collection(Barang::where('code', $code)->get());
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
