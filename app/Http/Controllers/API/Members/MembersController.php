<?php

namespace App\Http\Controllers\API\Members;

use App\Http\Controllers\Controller;
use App\Http\Resources\membersDetails;
use App\Models\Members;
use App\Models\Payment;
use Illuminate\Http\Request;
use Validator;

class MembersController extends Controller
{
    public function index()
    {

        $data = membersDetails::collection(Members::whereIn('status', ['members', 'seller'])->get());
        if ($data) {
            $response['status'] = 'sukses';
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            $response['data'] = "empty";
            return response()->json($response);
        }
    }
    public function byId($id)
    {
        $data = membersDetails::collection(Members::where('id', $id)->get());
        // $data = Members::find($id);
        if ($data) {
            $response['status'] = 'sukses';
            $response['data'] = $data;
            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            $response['data'] = 'empty';
            return response()->json($response);
        }
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'no_hp' => 'required|unique:members',
            'alamat' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = Members::create($request->all());
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
            'no_hp' => 'required',
            'alamat' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = Members::find($id);
        $data->name = $request->name;
        $data->no_hp = $request->no_hp;
        $data->alamat = $request->alamat;
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
        // $data = Members::where('id', $id)->delete();
        // $pay = Payment::where('members_id', $id)->delete();
        $data = Members::find($id);
        $data->status = 'trash';
        $data->save();
        if ($data) {
            $response['status'] = 'sukses';
            return response()->json($response);
        } else {
            $response['status'] = 'sukses';
            return response()->json($response);
        }
    }

    public function recycleBin()
    {
        $data = membersDetails::collection(Members::where('status', 'trash')->get());
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
}
