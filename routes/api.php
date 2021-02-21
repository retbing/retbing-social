<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserPublicInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Image;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::delete('delete/{id}', [AuthController::class,'deleteUser']);
    Route::post('me', [AuthController::class,'me']);
});

Route::group([
'middleware' => 'api'
], function () {
    Route::post('users', [UserPublicInfoController::class, 'store'])->name('users.store');
});