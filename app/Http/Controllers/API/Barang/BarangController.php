<?php

namespace App\Http\Controllers\Api\Barang;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Unit;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\BarangResource;
use App\Models\suppilerBarang;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $data = BarangResource::collection(Barang::all());

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

    public function byId($id)
    {
        $data = BarangResource::collection(Barang::where('id', $id)->get());
        $response['status'] = "sukses";
        $response['data'] = $data;
        return response()->json($response);
    }

    public function store(Request $request, $idSup)
    {
        // dd($request->suppiler_id);
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:t_barang',
            'name' => 'required',
            'price_in' => 'required',
            'price_seller' => 'required',
            'price_members' => 'required',
            'price_out' => 'required',
            'expired' => 'required',
            'stock' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = Barang::create($request->all());
        $idBarang = DB::table('t_barang')->max('id');
        $suppiler = suppilerBarang::create(['barang_id' => $idBarang, 'suppiler_id' => $idSup]);
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data and $suppiler;
            return response()->json($response);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price_in' => 'required',
            'price_seller' => 'required',
            'price_members' => 'required',
            'price_out' => 'required',
            'expired' => 'required',
            'stock' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = Barang::find($id);
        $data->name = $request->name;
        $data->price_in = $request->price_in;
        $data->price_seller = $request->price_seller;
        $data->price_members = $request->price_members;
        $data->price_out = $request->price_out;
        $data->expired = $request->expired;
        $data->stock = $request->stock;
        $data->category_id = $request->category_id;
        $data->unit_id = $request->unit_id;
        $data->status = $request->status;
        $data->information = $request->information;
        $data->save();

        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function delete($id)
    {
        $data = Barang::where('id', $id)->delete();
        $suppiler = suppilerBarang::where('barang_id', $id)->delete();
        if ($data and $suppiler) {
            $response['status'] = "sukses";
            $response['data'] = $data and $suppiler;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function categoryGet()
    {
        $data = Category::all();
        $unit = Unit::all();
        if ($data) {
            $response['status'] = "sukses";
            $response['category'] = $data;
            $response['unit'] = $unit;
            return response()->json($response);
        } else {
            $response['status'] = "sukses";
            $response['category'] = "empty";
            $response['unit'] = "empty";

            return response()->json($response);
        }
    }

    public function storeCatgeory(Request $request)
    {
        $data = Category::create($request->all());
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function storeUnit(Request $request)
    {
        $data = Unit::create($request->all());
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function deleteUnit($id)
    {
        $data = Unit::find($id);
        $data->delete();
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }
    public function byCode($code)
    {
        $data = BarangResource::collection(Barang::where('code', $code)->get());
        $response['status'] = 'sukses';
        $response['data'] = $data;
        return response()->json($response);
    }
}
