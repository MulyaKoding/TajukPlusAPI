<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\VideoController;

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

Route::post('register', [AccountController::class, 'register']);
Route::post('login', [AccountController::class, 'login']);
Route::resource('news', NewsController::class);
Route::resource('video', VideoController::class);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AccountController::class, 'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
