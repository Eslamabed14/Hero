<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
        $product = Product::paginate(5);
        if (count($product) > 0) {
            return ProductResource::collection($product);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Products yet'
            ],200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'advs' => 'required',
            'image' => 'required',
            'price' => 'required |numeric',
            'cat_id' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'storage/images/products/' . date('Ymd');
            $name = $path . time() . " - " . $file->getClientOriginalName();
            $file->move($path,$name);
            $data['image']=$name;
        }
        Product::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Product added successfully'
        ],200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'success' => true,
                'message' => new ProductResource($product)
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Products yet to show'
            ],404);
        }
    }
   
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $request->validate([
                'title' => 'required',
                'desc' => 'required',
                'advs' => 'required',
                'price' => 'required |numeric',
                'cat_id' => 'required',
            ]);
            $data = $request->all();
             if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'storage/images/products/' . date('Ymd');
            $name = $path . time() . " - " . $file->getClientOriginalName();
            $file->move($path,$name);
            $data['image']=$name;
             }
             $product->update($data);
             return response()->json([
                'success' => true,
                'message' => 'Product added successfully'
            ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'No Products yet to update'
                ],404);
            }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Products yet to delete'
            ],404);
        }
    }
}
