<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProgrammingResource;
use App\Models\Programming;
use Illuminate\Http\Request;

class ProgrammingController extends Controller
{
    
    public function index()
    {
        $apps = Programming::paginate(5);
        if (count($apps) > 0 ) {
            return ProgrammingResource::collection($apps);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No Apps yet'
            ],200);
        }
    }

    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
            'pages' => 'required|numeric',
            'downloads' => 'required|numeric',
            'customers' => 'required|numeric',
            'country' => 'required|numeric',
            'b_head' => 'required',
            'b_body' => 'required',
            'b_image' => 'required',
            'c_name' => 'required',
            'c_opinion' => 'required',
            'c_logo' => 'required',
            'cat_id' => 'required',
        ]);
        $data = $request->except('images');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'storage/images/apps/' . date('Y-m-d');
            $name = $path . time(). " - ". $file->getClientOriginalName();
            $file->move($path,$name);
            $data['image'] = $name;
        } 
        if ($request->hasFile('b_image')) {
            $file = $request->file('b_image');
            $path = 'storage/images/apps/' . date('Y-m-d');
            $name = $path . time(). " - ". $file->getClientOriginalName();
            $file->move($path,$name);
            $data['b_image'] = $name;
        } 
        if ($request->hasFile('c_logo')) {
            $file = $request->file('c_logo');
            $path = 'storage/images/apps/' . date('Y-m-d');
            $name = $path . time(). " - ". $file->getClientOriginalName();
            $file->move($path,$name);
            $data['c_logo'] = $name;
        } 
        $app = Programming::create($data);
        return response()->json([
            'success' => true,
            'message' => 'App has been created successfully'
        ] , 200);
    }

    public function show($id)
    {
        $apps = Programming::find($id);
        if($apps){
            return response()->json([
                'success' => true,
                'message' => new ProgrammingResource($apps)
            ]);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'No App'
            ],404);
        }
    }

    public function update(Request $request, $id)
    {
        $apps = Programming::find($id);
        if ($apps) {
            $request -> validate([
                'title' => 'required',
                //'image' => 'required',
                'price' => 'required|numeric',
                'desc' => 'required',
                'pages' => 'required|numeric',
                'downloads' => 'required|numeric',
                'customers' => 'required|numeric',
                'country' => 'required|numeric',
                'b_head' => 'required',
                'b_body' => 'required',
                //'b_image' => 'required',
                'c_name' => 'required',
                'c_opinion' => 'required',
                //'c_logo' => 'required',
                'cat_id' => 'required',
            ]);
            $data = $request->except('images');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = 'storage/images/apps/' . date('Y-m-d');
                $name = $path . time(). " - ". $file->getClientOriginalName();
                $file->move($path,$name);
                $data['image'] = $name;
            } 
            if ($request->hasFile('b_image')) {
                $file = $request->file('b_image');
                $path = 'storage/images/apps/' . date('Y-m-d');
                $name = $path . time(). " - ". $file->getClientOriginalName();
                $file->move($path,$name);
                $data['b_image'] = $name;
            } 
            if ($request->hasFile('c_logo')) {
                $file = $request->file('c_logo');
                $path = 'storage/images/apps/' . date('Y-m-d');
                $name = $path . time(). " - ". $file->getClientOriginalName();
                $file->move($path,$name);
                $data['c_logo'] = $name;
            }
            $apps->update($data);
            return response()->json([
                'success' => true,
                'message' =>  'App has been updated successfully'
            ] ,200); 
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No App'
            ],404);
        }
    }

    public function destroy($id)
    {
        $apps = Programming::find($id);
        if($apps){
            $apps->delete();
            return response()->json([
                'success' => true,
                'message' => 'App has been Updated successfully'
            ] , 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No App'
            ],404);
        }
    }
}
