<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPublicInfoController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('auth')->group(
    function () {
        Route::post('register', [AuthController::class,'register']);
        Route::post('login', [AuthController::class,'login']);
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::delete('{id}', [AuthController::class, 'deleteUser']);
        Route::get('me', [AuthController::class, 'me']);
    }
);


Route::prefix('users')->group(function () {
    Route::post('', [UserPublicInfoController::class, 'store'])->name('users.store');
    Route::get('', [UserPublicInfoController::class, 'index'])->name('users.index');

    Route::prefix('/{user_id}')->group(function () {
        Route::get('', [UserPublicInfoController::class, 'show'])->name('users.show');
        Route::post('/follow', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('/unfollow', [FollowController::class, 'destroy'])->name('follow.destroy');
        Route::get('/followers', [FollowController::class, 'followers'])->name('follow.followers');
        Route::get('/followings', [FollowController::class, 'followings'])->name('follow.followings');
    });
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::post('/', [PostController::class, 'store']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
});