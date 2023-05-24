<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\MotionCat;
use Illuminate\Http\Request;

class MotionCatController extends Controller
{
    public function index()
    {
        $cats = MotionCat::all();
        if (count($cats) > 0) {
            return response()->json([
                'suceess' => true,
                'cats' => CategoryResource::collection($cats)
            ] ,200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet'
            ],200);
        }
    }

    public function store(Request $request)
    {
        $request ->validate([
            'name' => 'required',
        ]);
        $data = $request->all();
        MotionCat::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Category has been added successfully'
        ],200);
    }

    public function show($id)
    {
        $cat = MotionCat::find($id);
        if ($cat){
            return response()->json([
                'success' => true,
                'cat' => new CategoryResource($cat)
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet'
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $cat = MotionCat::find($id);
        if ($cat){
            $request ->validate([
                'name' => 'required',
            ]);
            $data = $request->all();
            $cat->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Category has been Updated successfully'
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet to Update'
            ],404);
        }
    }
    

    public function destroy($id)
    {
        $cat = MotionCat::find($id);
        if ($cat){
            $cat->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category has been deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet to delete'
            ],404);
        }
    }
}
