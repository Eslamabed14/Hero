<?php

namespace App\Http\Controllers;

use App\Http\Resources\PartnerResource;
use App\Models\Partners;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        $partner = Partners::paginate(5);
        if (count($partner) > 0) {
            return PartnerResource::collection($partner);
        }else {
            return response()->json([
                    'success' => false,
                    'message' => 'there is no partner',
                ],200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'image' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file= $request->file('image');
            $path = 'storage\images\partners' .date('Ym');
            $name = $path . time()."-".$file->getClientOriginalName();
            $file->move($path,$name);
            $data['image']=$name;
        }
        Partners::create($data);
        return response()->json([
            'success'=> true,
            'message'=>'Partner has added successfully',
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partner=Partners::find($id);
        if ($partner) {
            return response()->json([
                'success' => true,
                'partner' => new PartnerResource($partner)
            ],200);
        } else{
            return response()->json([
                'success'=>false,
                'message'=>'NO PARTNER'
            ],404);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $partner = Partners::find($id);
        if ($partner) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $file= $request->file('image');
                $path = 'storage/images/partners' .date('Ym');
                $name = $path . time()."-".$file->getClientOriginalName();
                $file->move($path,$name);
                $data['image']=$name;
            }
            $partner->update($data);
            return response()->json([
                'success'=>true,
                'message'=> ' PARTNER HAS UPDATED SUCCESSFLLY '
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'NO PARTNER TO UPDATE'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partner = Partners::find($id);
        if ($partner) {
            $partner->delete();
            return response()->json([
                'success' => true,
                'message' => 'Partner has deleted successfully'
            ]);
        } else {
            return response()->json([
                'success'=>false,
                'message'=>'NO PARTNER'
            ],404);
        }
    }
}
