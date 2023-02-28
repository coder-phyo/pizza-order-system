<?php

use App\Http\Controllers\Api\RouteController;
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

// GET
Route::get('pizza/data/list', [RouteController::class, 'pizzaDataList']); # READ

// POST
Route::post('create/category', [RouteController::class, 'categoryCreate']); # CREATE
Route::post('create/contact', [RouteController::class, 'createContact']);   # CREATE

Route::get('category/delete/{id}', [RouteController::class, 'categoryDelete']); # DELETE
Route::get('pizza/data/list/{id}', [RouteController::class, 'categoryDetail']); # READ
Route::post('category/update', [RouteController::class, 'categoryUpdate']);     # UPDATE
