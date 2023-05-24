<?php

namespace App\Http\Controllers;

use App\Http\Resources\GraphicResource;
use App\Models\Graphic;
use Illuminate\Http\Request;

class GraphicController extends Controller

{
    public function index()
    {
        $graphic = Graphic::paginate(5);
        if(count($graphic) > 0){
            return GraphicResource::collection($graphic);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No photos yet'
            ] ,200);
        }
    }

    public function store(Request $request)
    {
        $request ->validate([
            'image' => 'required',
            'cat_id' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'storage/images/graphics/' . date('Y-m-d');
            $name = $path . time() . " - " . $image->getClientOriginalName();
            $image->move($path,$name);
            $data['image'] = $name;
        }
        $graphic = Graphic::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Graphic image has been added successfully'
        ] ,200);
    }

    public function show($id)
    {
        $graphic = Graphic::find($id);
        if ($graphic) {
            return response()->json([
                'success' => true,
                'message' => new GraphicResource($graphic)
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Graphics yet to show'
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $graphic = Graphic::find($id);
        if ($graphic) {
            $request ->validate([
                'cat_id' => 'required',
            ]);
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = 'storage/images/graphics/' . date('Y-m-d');
                $name = $path . time() . " - " . $image->getClientOriginalName();
                $image->move($path,$name);
                $data['image'] = $name;
            }
            $graphic->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Graphic image has been updated successfully'
            ] ,200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Graphics yet to updated'
            ],404);
        }
    }

    public function destroy($id)
    {
        $graphic = Graphic::find($id);
        if ($graphic) {
            $graphic->delete();
            return response()->json([
                'success' => true,
                'message' => 'Graphic image has been deleted successfully'
            ] ,200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Graphics yet to delete'
            ],404);
        }
    }
}
