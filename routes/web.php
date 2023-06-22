<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Models\Complaint;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Complaints routes
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store')->middleware('auth');
Route::get('/complaints', function () {
    return view('create-complaint');
})->middleware(['auth', 'verified'])->name('create-complaint');
Route::put('/complaints/{status}', [ComplaintController::class, 'update'])->name('complaints.update')->middleware('auth');

require __DIR__.'/auth.php';
