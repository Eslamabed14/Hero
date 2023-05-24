<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashRegister(Request $request){
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'number' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json([
            'success' => true,
            'user' => $user 
        ],200);
    }

    public function dashLogin(Request $request){
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $data =$request->all();

        if (Auth::attempt(['email' => $request->email , 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->userType == 'admin') {
                return response()->json([
                    'success' => true,
                    'user' => new UserResource(Auth::user()),
                ],200);
            } else {
                return response()->json([
                    'password' => ['عفوا, انت لست مسؤول وليس مصرح لك بالدخول الى لوحة التحكم']
                ], 404);
            }
            return response()->json([
                'password' => ['تحقق من الإيميل والرقم السري!']
            ] , 404);
        }
    }

    public function logOut(){
        Auth::logout();
    }

    public function users(){
        $users = User::paginate(5);
        if (count($users) > 0 ) {
            return UserResource::collection($users);
        }
    }

    public function delUser($id){
        $user =User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User has been deleted successfully'
            ] ,200);
        } else {
            return response()->json([
                'success' => false,
                'message' => ' no user to delete!'
            ], 404);
        }
    }

    public function show($id){
    $user =User::find($id);
    if ($user) {
    return response()->json([
        'success' => true,
        'user' => new UserResource($user),
    ],200);
         } else {
            return response()->json([
                'success' => false,
                'message' => ' no user to show!'
            ], 404);
         }
     }

     public function update(Request $request,$id){
        $user =User::find($id);
        if ($user){
         $data = $request->all();
         $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id,
            'number' => 'required',
        ]);
        $user->update($data);
        return response()->json([
            'success' => true,
            'user' => new UserResource($user),
        ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => ' no user !'
            ], 404);
        }
     }
}
