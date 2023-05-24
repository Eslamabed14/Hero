<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GraphicResource;
use App\Http\Resources\InfoResource;
use App\Http\Resources\MotionResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProgrammingResource;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\TeamResource;
use App\Models\Article;
use App\Models\Category;
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

class GetController extends Controller
{
    public function team()
    {
        $team =Team::all();
        if (count($team) > 0) {
            return response()->json([
                'success' => true,
                'team' => TeamResource::collection($team)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'team' => []
            ], 200);
        }
    } // team

    public function info() 
    {
        $info = Info::find(1);
        if ($info) {
            return response()->json([
                'success' => true,
                'team' => new InfoResource($info)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'info' => []
            ], 200);
        }
    } // info

    public function services()
    {
        $services = Services::all();
        if (count($services) > 0) {
            return response()->json([
                'success' => true,
                'service' => ServicesResource::collection($services)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'services' => []
            ], 200);
        }
    } // services

    public function partners()
    {
        $partners = Partners::all();
        if (count($partners) > 0) {
            return response()->json([
                'success' => true,
                'partners' => PartnerResource::collection($partners)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'services' => []
            ], 200);
        } 
    } // Partners

    public function articles()
    {
        $articles = Article::paginate(5);
        if (count($articles) > 0) {
            return ArticleResource::collection($articles);
        } else {
            return response()->json([
                'success' => false,
                'articles' => []
            ], 200);
        }
    } // articles

    public function article($id)
    {
        $article = Article::find($id);
        if ($article) {
            return response()->json([
                'success' => true,
                'article' => new ArticleResource($article)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'article' => []
            ], 200);
        }
    } //article{id}

    public function apps()
    {
        $apps = Programming::all();
        $cats = ProCat::all();
        if (count($apps) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'apps' => ProgrammingResource::collection($apps), 
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'apps' => []
            ], 200);
        }
    } // apps

    public function app($id)
    {
      $app = Programming::find($id);
      if ($app) {
            return response()->json([
                'success' => true,
                'app' => new ProgrammingResource($app)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No App'
            ], 200);
        }
    } //app{id}
    
    public function products()
    {
        $cats = Category::all();
        $products = Product::all();
        if (count($cats) > 0 && count($products)) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'products' => ProductResource::collection($products),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No products yet'
            ], 200);
        }
    } // products

    public function product($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'success' => true,
                'product' => new ProductResource($product),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'product' => []
            ], 200);
        }
    } // product{id}

    public function moitons()
    {
        $motions = Motion::all();
        $cats = MotionCat::all();
        if (count($motions) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'motions' => MotionResource::collection($motions),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'motions' => []
            ], 200);
        }
    } // motions

    public function graphics()
    {
        $graphics = Graphic::all();
        $cats = GraphicCat::all();
        if (count($graphics) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'graphics' => GraphicResource::collection($graphics),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'graphics' => []
            ], 200);
        }
    } //graphics
}
