<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\PlaceController;

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
Route::put('updateuser/{id}', [AccountController::class, 'update_data_user']);
Route::post('updatepassword/{id}',[AccountController::class, 'update_password']);
Route::put('updateBankAccount/{id}',[AccountController::class, 'update_bank_account']);
Route::delete('deleteNews/{id}',[NewsController::class, 'delete_news']);
Route::get('listNews/{id}', [NewsController::class, 'list']);
Route::resource('news', NewsController::class);
Route::resource('video', VideoController::class);
Route::get('provinces', [PlaceController::class, 'getProvinces']);
Route::get('cities/{id}', [PlaceController::class, 'getCities']);
Route::get('districts/{id}', [PlaceController::class, 'getDistricts']);
Route::get('subdistricts/{id}', [PlaceController::class, 'getSubdistricts']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AccountController::class, 'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
