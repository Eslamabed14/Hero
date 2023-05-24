<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicesResource;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $service=Services::paginate(5);
        if (count($service)> 0) {
            return ServicesResource::collection($service);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Provided service Yet'
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'desc' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = 'storage/images/services/'. date('Ymd');
            $name =$path . time(). " - " . $file->getClientOriginalName();
            $file->move($path,$name);
            $data['image']=$name;
        }
        Services::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Service add successfully'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service=Services::find($id);
        if ($service) {
            return response()->json([
                'success' => true,
                'message' => new ServicesResource($service)
            ],200);
        } else{
            return response()->json([
                'success' => false,
                'message' => 'Cannot find the service'
            ],404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Services::find($id);
        if ($service) {
            $request -> validate([
                'name' => 'required',
                'desc' => 'required',
            ]);
            $data = $request->all();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = 'storage/images/services/'. date('Ymd');
                $name = $path . time(). " - " . $file->getClientOriginalName();
                $file->move($path,$name);
                $data['image'] = $name;
            }
            $service -> update($data);
            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully'
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Cannot updated the service'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Services::find($id);
        if ($service) {
            $service->delete();
            return response()->json([
                'success' => true,
                'message' => 'Service Deleted Successfully'
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cannot deleted the service'
            ],404);
        }
    }
}
