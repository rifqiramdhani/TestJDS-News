<?php
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthController;

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


Route::group(['prefix' => 'auth'], function () {
    Route::group([ 'middleware' => 'auth:api' ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
    
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
});

Route::group([ 'middleware' => 'auth:api' ], function() {
    Route::post('post', [PostController::class, 'store'])->middleware('isadmin');
    Route::put('post/{id}', [PostController::class, 'update'])->middleware('isadmin');
    Route::delete('post/{id}', [PostController::class, 'destroy'])->middleware('isadmin');


    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comment', [CommentController::class, 'store']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);

});

/* POST ROUTER */
Route::get('posts', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);

