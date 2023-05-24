<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function index()
    {
        $order = Order::paginate(10);
        if (count($order) > 0) {
            return OrderResource::collection($order);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Orders yet'
            ],200);
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json([
                'success' => true , 
                'message' => 'Order Deleted successfully'
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No Orders yet to delete'
            ], 404);
        }
    }
}
