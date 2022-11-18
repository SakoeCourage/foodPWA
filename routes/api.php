<?php

use GuzzleHttp\Middleware;
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
    return ([
        'user' => $request->user()
    ]);
});


Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class,'register']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class,'authenticate']);
Route::post('/logout', [\App\Http\Controllers\Auth\UserController::class,'logout']);
Route::post('/adddish',[\App\Http\Controllers\AddDishController::class,'createDish']);
Route::get('/dish/all',[\App\Http\Controllers\AddDishController::class,'index']);
Route::get('/dish/featured',[\App\Http\Controllers\AddDishController::class,'getFeaturedDish']);
Route::get('/dish/getdish/{adddish:slug}',[\App\Http\Controllers\AddDishController::class,'getdishbyslug']);
Route::get('/dish/getdishtypes',[\App\Http\Controllers\DishtypeController::class,'index']);
Route::get('/dish/togglefavorites/{dish}',[\App\Http\Controllers\FavoritesController::class,'togglefavorites']);

Route::get('/notifications/unread',[\App\Http\Controllers\NotificationsController::class, 'index']);
Route::get('/notifications/all',[\App\Http\Controllers\NotificationsController::class, 'getUserNotifications']);
Route::post('/profile/createorupdate', [\App\Http\Controllers\ProfileController::class, 'create']);



