<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'number' => 'required|numeric',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ] , 404);
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json([
            'success' => true,
            'user' =>  new UserResource($user)
        ] , 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'email' => 'required|email|exists:users,email',
           'password' => 'required'  
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ] , 404);
        } 
        
        if (Auth::attempt(['email' => $request->email , 'password' => $request->password])){
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'user' =>  new UserResource($user)
            ] , 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => ' The provided credentials are incorrect.'
            ] , 404);
        }
    }
}
