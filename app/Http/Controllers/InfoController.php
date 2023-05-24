<?php

namespace App\Http\Controllers;

use App\Http\Resources\InfoResource;
use App\Models\Article;
use App\Models\Graphic;
use App\Models\GraphicCat;
use App\Models\Info;
use App\Models\Motion;
use App\Models\MotionCat;
use App\Models\Partners;
use App\Models\ProCat;
use App\Models\Product;
use App\Models\Programming;
use App\Models\Services;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
   
    public function index()
    {
        $info = Info::find(1);
        if ($info) {
            return response()->json([
                'success' => true,
                'info' => new InfoResource($info)
            ] ,200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No info yet'
            ] ,200);
        }
    }

    public function all(){
        $users = User::all();
        $team = Team::all();
        $articles = Article::all();
        $partners = Partners::all();
        $graphics = Graphic::all();
        $graphicsCats = GraphicCat::all();
        $motions = Motion::all();
        $motionsCats = MotionCat::all();
        $appCats = ProCat::all();
        $apps = Programming::all();
        $products = Product::all();
        $services = Services::all();

        return response()->json([
            'success' => true,
            'users' => count($users),
            'team' => count($team),
            'article' => count($articles),
            'partners' => count($partners),
            'graphics' => count($graphics),
            'graphicCats' => count($graphicsCats),
            'motions' => count($motions),
            'motionCats' => count($motionsCats),
            'appcats' => count($appCats),
            'apps' => count($apps),
            'products' => count($products),
            'services' => count($services),
        ],200);
    }

    public function update(Request $request)
    {
        $info = Info::find(1);
        $request->validate([
            'views' => 'required|numeric',
            'projects' => 'required|numeric',
            'customers' => 'required|numeric',
            'empolyees' => 'required|numeric',
            'email' => 'required|email',
            'number' => 'required|numeric',
        ]);
        $info->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'info has been updated successfully'
        ] , 200);
    }
}
