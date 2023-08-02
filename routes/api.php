<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;




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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Auths
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

//categories
Route::apiResource('/categories', App\Http\Controllers\API\CategoryController::class);
Route::get('/categories', [\App\Http\Controllers\API\CategoryController::class, 'searchCategory']);

//locations
Route::apiResource('/locations', App\Http\Controllers\API\LocationController::class);

//assets
Route::apiResource('/assets', App\Http\Controllers\API\AssetController::class);

//demands
Route::apiResource('/demands', App\Http\Controllers\API\DemandController::class);

//entry_items
Route::apiResource('/entry_items', App\Http\Controllers\API\Entry_ItemController::class);

//monitors
Route::apiResource('/monitors', App\Http\Controllers\API\MonitorController::class);


