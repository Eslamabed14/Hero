<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = Team::paginate(5);
        if (count($team)> 0) {
            return TeamResource::collection($team);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'No Team yet'
            ],200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'job' => 'required',
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = 'storage/images/team' . date('Ymd');
            $name = $path .time()." - " .$file->getClientOriginalName();
            $file->move($path,$name);
            $data['image'] = $name;
        }
        Team::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Member added successflly'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $team = Team::find($id);
        if ($team) {
            return response()->json([
                'success' => true,
                'team' => new TeamResource($team)
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'message' => 'NO member'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id )
    {
        $team = Team::find($id);
        if($team){
            $request->validate([
                'name'=>'required',
                'job'=>'required',
            ]);
            $data= $request->all();
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $path = 'storage/images/team'.date('Ymd');
                $name = $path . time(). " - ". $file->getClientOriginalName();
                $file-> move($path,$name);
                $data['image'] = $name;
            }
            $team->update($data);
            return response()->json([
                'success' => true,
                'message' => ' Member updated successfully'
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'no member to update'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team=Team::find($id);
        if ($team) {
            $team->delete();
            return response()->json([
                'success' => true,
                'message' => 'DELETED SUCCESSFULLY'
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'no member to Delete'
            ],404);
        }
    }
}
