<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(5);
        if (count($category)> 0) {
            return CategoryResource::collection($category);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet'
            ],200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        Category::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Category added successfully'
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'success' => true,
                'message' => new CategoryResource($category)
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Categories yet'
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $request->validate(['name' => 'required']);
            $data = $request->all();
            $category ->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Category has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such category'
            ], 404);
        }
      
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['success'=> true, 'message' => 'Category has been deleted successfully'],200);
        } else{
            return response()->json(['success'=>false,'message'=>'No category to delete'],404);
        }
    }
}
