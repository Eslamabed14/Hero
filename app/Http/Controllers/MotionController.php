<?php

namespace App\Http\Controllers;

use App\Http\Resources\MotionResource;
use App\Models\Motion;
use Illuminate\Http\Request;

class MotionController extends Controller
{
    
    public function index()
    {
        $motion = Motion::paginate(5);
        if(count($motion) > 0){
            return MotionResource::collection($motion);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No motion video yet'
            ] ,200);
        }
    }

    public function store(Request $request)
    {
        $request ->validate([
            'link' => 'required',
            'cat_id' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'storage/images/motion/' . date('Y-m-d');
            $name = $path . time() . " - " . $image->getClientOriginalName();
            $image->move($path,$name);
            $data['image'] = $name;
        }
        $motion = Motion::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Motion video has been added successfully'
        ] ,200);
    }

    public function show($id)
    {
        $motion = Motion::find($id);
        if ($motion) {
            return response()->json([
                'success' => true,
                'message' => new MotionResource($motion)
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Videos yet to show'
            ],404);
        }
    }

    public function update(Request $request,$id)
    {
        $motion = Motion::find($id);
        if ($motion) {
            $request ->validate([
                'link' => 'required',
                'cat_id' => 'required',
            ]);
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = 'storage/images/motion/' . date('Y-m-d');
                $name = $path . time() . " - " . $image->getClientOriginalName();
                $image->move($path,$name);
                $data['image'] = $name;
            }
            $motion->update($data);
            return response()->json([
                'success' => true,
                'message' =>'Video has been updated succesfully'
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No video yet to update'
            ],404);
        }
    }

    public function destroy($id)
    {
        $motion = Motion::find($id);
        if ($motion) {
            $motion->delete();
            return response()->json([
                'success' => true,
                'message' =>'Video has been deleted succesfully'
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No video yet to delete'
            ],404);
        }
    }
}
