<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\ProCat;
use Illuminate\Http\Request;

class ProCatController extends Controller
{
    public function index()
    {
        $appcat = ProCat::all();
        if (count($appcat) > 0) {
            return response()->json([
             'success' => true,   
             'appcat' => CategoryResource::collection($appcat)
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet'
            ],200);
        }
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        ProCat::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Category has been created successfully'
        ],200);
    }

    
    public function show($id)
    {
        $appcat = ProCat::find($id);
        if($appcat){
            return response()->json([
                'success' => true,
                'message' => new CategoryResource($appcat)
            ] , 200 );
        } else{
            return response()->json([
                'success' => false,
                'message' => 'there is no such category'
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $appcat = ProCat::find($id);
        if($appcat){
            $request->validate([
                'name' => 'required'
            ]);
            $data = $request->all();
            $appcat->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Category has been updated successfully'
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'there is no such category'
            ],404);
        }
    }

    public function destroy($id)
    {
        $appcat = ProCat::find($id);
        if($appcat){
            $appcat->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category has been deleted successfully'
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'there is no such category'
            ],404);
        }
    }
}
