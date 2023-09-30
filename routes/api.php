<?php

use App\Http\Controllers\Api\ApiController;
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
Route::get("product/list",[ApiController::class,"productList"]);
Route::post("product/create",[ApiController::class,"productCreate"]);
Route::put("edit/category/{id}",[ApiController::class,"editCategory"]);
Route::delete("delete",[ApiController::class,"delete"]);    
