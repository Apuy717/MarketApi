<?php

namespace App\Http\Controllers\API\Suppiler;

use App\Http\Controllers\Controller;
use App\Http\Resources\suppilerResource;
use App\Models\Suppiler;
use App\Models\suppilerBarang;
use Illuminate\Http\Request;
use Validator;

class suppilerController extends Controller
{
    public function index()
    {
        $data = Suppiler::all();
        if ($data) {
            $response['status'] = 'success';
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = 'success';
            $response['data'] = 'empty';
            return response()->json($response);
        }
    }

    public function byId($id)
    {
        $data = suppilerResource::collection(Suppiler::where('id', $id)->get());
        if (count($data) > 0) {
            $response['status'] = 'success';
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = 'success';
            $response['data'] = 'empty';
            return response()->json($response);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company' => 'required|unique:suppiler',
            'contact' => 'required|unique:suppiler',
            'region' => 'required',
            'status' => 'required',
            'information' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = Suppiler::create($request->all());
        if ($data) {
            $response['status'] = "sukses";
            $response['data'] = $data;
            return response()->json($response);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company' => 'required|unique:suppiler',
            'contact' => 'required|unique:suppiler',
            'region' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = Suppiler::find($id);
        $data->name = $request->name;
        $data->company = $request->company;
        $data->contact = $request->contact;
        $data->region = $request->region;
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
        $data = Suppiler::where('id', $id)->delete();
        $sup = suppilerBarang::where('suppiler_id', $id)->delete();
        if ($data and $sup) {
            $response['status'] = 'sukses';
            $response['data'] = $data and $sup;
            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            $response['data'] = $data;
            return response()->json($response);
        }
    }
}
