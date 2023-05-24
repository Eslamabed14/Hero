<?php

use App\Http\Controllers\Api\GetController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GraphicCatController;
use App\Http\Controllers\GraphicController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MotionCatController;
use App\Http\Controllers\MotionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ProCatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgrammingController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('isAdmin')->get('/Authenticated' , function () {
    return true;
});

Route::post('/dashlogin', [AuthController::class ,'dashlogin']);
Route::post('/dashlogin', [AuthController::class ,'logOut']);

// website apis:
Route::get('/team', [GetController::class ,'team']);
Route::get('/info', [GetController::class ,'info']);
Route::get('/services', [GetController::class ,'services']);
Route::get('/partners', [GetController::class ,'partners']);
Route::get('/articles', [GetController::class ,'articles']);
Route::get('/article/{id}', [GetController::class ,'article']);
Route::get('/apps', [GetController::class ,'apps']);
Route::get('/app/{id}', [GetController::class ,'app']);
Route::get('/products', [GetController::class ,'products']);
Route::get('/product/{id}', [GetController::class ,'product']);
Route::get('/moitons', [GetController::class ,'moitons']);
Route::get('/graphics', [GetController::class ,'graphics']);
Route::post('/order' , [PostController::class , 'order']);
Route::post('/contact' , [PostController::class , 'contact']);


// dashboard api
Route::group(['middleware' => 'isAdmin'] , function(){
    //users
    Route::get('users' , [AuthController::class , 'users']);
    Route::get('user/show/{id}' , [AuthController::class , 'show']);
    Route::post('user/add' , [AuthController::class , 'dashRegister']);
    Route::post('user/edit/{id}' , [AuthController::class , 'update']);
    Route::post('user/delete/{id}' , [AuthController::class , 'delUser']);

    // info
    Route::get('/info' , [InfoController::class , 'index']);
    Route::get('/all' , [InfoController::class , 'all']);
    Route::post('/info/update' , [InfoController::class , 'update']);

    // partners 
    Route::get('/partners' , [PartnersController::class , 'index']);
    Route::get('/partner/show/{id}' , [PartnersController::class , 'show']);
    Route::post('/partner/store' , [PartnersController::class , 'store']);
    Route::post('/partner/update/{id}' , [PartnersController::class , 'update']);
    Route::post('/partner/destroy/{id}' , [PartnersController::class , 'destroy']);

    //teams
    Route::get('/team' , [TeamController::class , 'index']);
    Route::get('/team/show/{id}' , [TeamController::class , 'show']);
    Route::post('/team/store' , [TeamController::class , 'store']);
    Route::post('/team/update/{id}' , [TeamController::class , 'update']);
    Route::post('/team/destroy/{id}' , [TeamController::class , 'destroy']);
    
    //contacts
    Route::get('/contacts' , [ContactController::class , 'index']);
    Route::post('/contact/destroy/{id}' , [ContactController::class , 'destroy']);

    // orders
    Route::get('/orders' , [OrderController::class , 'index']);
    Route::post('/order/destroy/{id}' , [OrderController::class , 'destroy']);

    //services
    Route::get('/services' , [ServicesController::class , 'index']);
    Route::get('/service/show/{id}' , [ServicesController::class , 'show']);
    Route::post('/service/store' , [ServicesController::class , 'store']);
    Route::post('/service/update/{id}' , [ServicesController::class , 'update']);
    Route::post('/service/destroy/{id}' , [ServicesController::class , 'destroy']);

    //articles
    Route::get('/articles' , [ArticleController::class , 'index']);
    Route::get('/article/show/{id}' , [ArticleController::class , 'show']);
    Route::post('/article/store' , [ArticleController::class , 'store']);
    Route::post('/article/update/{id}' , [ArticleController::class , 'update']);
    Route::post('/article/destroy/{id}' , [ArticleController::class , 'destroy']);

    //app cats
    Route::get('/Appcats' , [ProCatController::class , 'index']);
    Route::get('/Appcat/show/{id}' , [ProCatController::class , 'show']);
    Route::post('/Appcat/store' , [ProCatController::class , 'store']);
    Route::post('/Appcat/update/{id}' , [ProCatController::class , 'update']);
    Route::post('/Appcat/destroy/{id}' , [ProCatController::class , 'destroy']);

    //apps
    Route::get('/Apps' , [ProgrammingController::class , 'index']);
    Route::get('/app/show/{id}' , [ProgrammingController::class , 'show']);
    Route::post('/app/store' , [ProgrammingController::class , 'store']);
    Route::post('/app/update/{id}' , [ProgrammingController::class , 'update']);
    Route::post('/app/destroy/{id}' , [ProgrammingController::class , 'destroy']);

    //Product cats
    Route::get('/cats' , [CategoryController::class , 'index']);
    Route::get('/cat/show/{id}' , [CategoryController::class , 'show']);
    Route::post('/cat/store' , [CategoryController::class , 'store']);
    Route::post('/cat/update/{id}' , [CategoryController::class , 'update']);
    Route::post('/cat/destroy/{id}' , [CategoryController::class , 'destroy']);

    //Products
    Route::get('/products' , [ProductController::class , 'index']);
    Route::get('/product/show/{id}' , [ProductController::class , 'show']);
    Route::post('/product/store' , [ProductController::class , 'store']);
    Route::post('/product/update/{id}' , [ProductController::class , 'update']);
    Route::post('/product/destroy/{id}' , [ProductController::class , 'destroy']);

    //Motion cats
    Route::get('/motioncats' , [MotionCatController::class , 'index']);
    Route::get('/motioncat/show/{id}' , [MotionCatController::class , 'show']);
    Route::post('/motioncat/store' , [MotionCatController::class , 'store']);
    Route::post('/motioncat/update/{id}' , [MotionCatController::class , 'update']);
    Route::post('/motioncat/destroy/{id}' , [MotionCatController::class , 'destroy']);

    //Motions
    Route::get('/Motions' , [MotionController::class , 'index']);
    Route::get('/Motion/show/{id}' , [MotionController::class , 'show']);
    Route::post('/Motion/store' , [MotionController::class , 'store']);
    Route::post('/Motion/update/{id}' , [MotionController::class , 'update']);
    Route::post('/Motion/destroy/{id}' , [MotionController::class , 'destroy']);

    //Graphic cats
    Route::get('/graphiccats' , [GraphicCatController::class , 'index']);
    Route::get('/graphiccat/show/{id}' , [GraphicCatController::class , 'show']);
    Route::post('/graphiccat/store' , [GraphicCatController::class , 'store']);
    Route::post('/graphiccat/update/{id}' , [GraphicCatController::class , 'update']);
    Route::post('/graphiccat/destroy/{id}' , [GraphicCatController::class , 'destroy']);

    //Graphics
    Route::get('/graphics' , [GraphicController::class , 'index']);
    Route::get('/graphic/show/{id}' , [GraphicController::class , 'show']);
    Route::post('/graphic/store' , [GraphicController::class , 'store']);
    Route::post('/graphic/update/{id}' , [GraphicController::class , 'update']);
    Route::post('/graphic/destroy/{id}' , [GraphicController::class , 'destroy']);
});