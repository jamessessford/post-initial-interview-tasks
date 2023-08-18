<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\NoteController;

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

Route::middleware('auth:sanctum')->group(function () {

    //Complaints
    Route::prefix('complaints')->group(function (){
        Route::get('/', [ComplaintController::class, 'index']);
        Route::get('/${id}', [ComplaintController::class, 'show']);
        Route::put('/${id?}', [ComplaintController::class, 'upsert']);
        Route::delete('/{id}', [ComplaintController::class, 'destroy']);
    });

    Route::prefix('notes')->group(function (){
        Route::put('/${id?}', [NoteController::class, 'upsert']);
        Route::delete('/{id}', [NoteController::class, 'destroy']);
    });
});
