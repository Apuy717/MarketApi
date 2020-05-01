<?php

namespace App\Http\Controllers\Api\Barang;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Category;
use App\Models\Unit;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $data = DB::table('t_barang')
            ->join('t_category', 't_category.id', '=', 't_barang.category_id')
            ->join('t_unit', 't_unit.id', '=', 't_barang.unit_id')
            ->select('t_barang.*', 't_category.category', 't_unit.unit')
            ->get();

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
        $data = DB::table('t_barang')
            ->join('t_category', 't_category.id', '=', 't_barang.category_id')
            ->join('t_unit', 't_unit.id', '=', 't_barang.unit_id')
            ->where('t_barang.id', $id)
            ->select('t_barang.*', 't_category.category', 't_unit.unit')
            ->get();


        $response['status'] = "sukses";
        $response['data'] = $data;
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'price_in' => 'required',
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
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'price_in' => 'required',
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
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function cek()
    {
        $data = Barang::all();
        $response['sukses'] = "sukses";
        $response['data'] = $data;
        return response()->json($response);
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
}
