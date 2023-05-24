<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function order(Request $request)
    {
        $validator = Validator ::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric',
            'desc' => 'required',
            'field' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ] , 404);
        }
        $data = $request->all();
        Order::create($data);
         return response()->json([
            'success' => true,
            'message' => 'Your order has been sent successfully'
        ], 200);
    }

    public function contact(Request $request)
    {
        $validator = Validator ::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required',
              // 'email' => 'email'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ] , 404);
        }
        $data = $request->all();
        Contact::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Your contact request has been sent successfully'
        ], 200);
    }
}
