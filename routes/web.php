<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\NoteController;

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

Route::prefix('dashboard')->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/complaint}',[ComplaintController::class, 'index'])->name('complaint.index');
    Route::get('/complaint/new', [ComplaintController::class, 'new'])->name('complaint.new');
    Route::post('/complaint/create', [ComplaintController::class, 'create'])->name('complaint.create');
    Route::get('/complaint/{id}',[ComplaintController::class, 'edit'])->name('complaint.edit');
    Route::get('/complaint/view/{id}',[ComplaintController::class, 'view'])->name('complaint.view');
    Route::get('/complaint/note/add/{id}',[NoteController::class, 'new'])->name('note.add');
    Route::post('/complaint/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/complaint/update', [ComplaintController::class, 'update'])->name('complaint.update');


})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
