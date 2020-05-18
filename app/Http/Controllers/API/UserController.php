<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;
            $response['status'] = true;
            $response['data'] = $user;
            $response['token'] = $token;
            return response()->json($response);
        } else {
            return response()->json(['error' => 'email dan password salah '], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout(Request $request)
    {
        $user = User::find($request->id);
        $user->tokens()->where('tokenable_id', $request->id)->delete();
        $response['status'] = true;
        $response['data'] = "Sukses Logout All Devices";

        return response()->json($response);
    }

    public function details()
    {
        $user = User::all();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
