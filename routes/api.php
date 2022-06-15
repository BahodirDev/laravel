<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FiltersController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class,'user']);
Route::post('/postsItem',[UserController::class,'posts']);
Route::post('/client',[UserController::class,'client']);
Route::get('/data',[UserController::class,'data']);
Route::post('/login',[UserController::class,'login']);
Route::get('/info',[ClientController::class,'info']);
Route::get('/detail/{id}',[ClientController::class,'detail']);
Route::get('/all',[ClientController::class,'all']);
Route::put('/update/{id}',[ClientController::class,'update']);
Route::put('/update2/{id}',[ClientController::class,'update2']);
Route::put('/Liked/{id}',[ClientController::class,'Liked']);
Route::put('/unLiked/{id}',[ClientController::class,'unLiked']);
Route::delete('/delete/{id}',[ClientController::class,'delete']);
// likes row
Route::post('/IsLiked',[LikesController::class,'IsLiked']);
Route::post('/NotLiked',[LikesController::class,'NotLiked']);
Route::get('/filterLiked/{id}',[LikesController::class,'filterLiked']);
Route::get('/dataLikes',[LikesController::class,'LikesPosts']);
Route::get('/AddLike/{id}',[LikesController::class,'AddLike']);
Route::get('/RemoveLike/{id}',[LikesController::class,'RemoveLike']);
// filters
Route::get('/search/{name}',[FiltersController::class,'filters']);
Route::get('/findPlace/{name}',[FiltersController::class,'findPlace']);
// Comments
Route::post('/addComments',[CommentsController::class,'addComments']);
Route::post('/delComments',[CommentsController::class,'delComments']);
Route::get('/getComments/{id}',[CommentsController::class,'getComments']);
Route::post('/sort',[FiltersController::class,'sortPrice']);