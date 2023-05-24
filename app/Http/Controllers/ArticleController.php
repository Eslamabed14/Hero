<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $article = Article::paginate(5);
        if(count($article) > 0){
            return ArticleResource::collection($article);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No articles yet'
            ] , 200);
        }
    }

    public function store(Request $request)
    {
        $request -> validate([
            'title'  => 'required',
            'desc'   => 'required',
            'image'  => 'required',
            'banner' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request -> file('image');
            $path = 'storage/images/articles/images/' . date('Ymd');
            $name = $path . time(). ' - ' . $file->getClientOriginalName();
            $file -> move($path,$name);
            $data['image'] = $name;
        }
        if ($request->hasFile('banner')) {
            $file = $request -> file('banner');
            $path = 'storage/images/articles/banners/' . date('Ymd');
            $name = $path . time(). ' - ' . $file->getClientOriginalName();
            $file -> move($path,$name);
            $data['banner'] = $name;
        }
        Article::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Article created successfully'
        ],200);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if($article) {
            return response()->json([
                'success' => true,
                'article' => new ArticleResource($article)
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Article to be shown'
            ],404);
        }
    }

    public function update(Request $request , $id)
    {
        $article = Article::find($id);
        if ($article) {
            $request ->validate([
                'title' => 'required',
                'desc'  => 'required',
            ]);
            $data = $request ->all();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = 'storage/images/articles/images/'. date('Ymd');
                $name = $path . time() . " - " .$file-> getClientOriginalName();
                $file->move($path,$name);
                $data['image'] = $name;
            }
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $path = 'storage/images/articles/banners/'. date('Ymd');
                $name = $path . time() . " - " .$file-> getClientOriginalName();
                $file->move($path,$name);
                $data['banner'] = $name;
            }
            $article->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Article updated successfully'
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'No Article to be updated'
            ] , 404);
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return response()->json([
                'success' => true,
                'message' => 'Article Deleted Successfully'
            ] , 200 );
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No Article to be Deleted'
            ] , 404);
        }
    }
}
