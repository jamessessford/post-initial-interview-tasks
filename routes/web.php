<?php

use App\Http\Controllers\Complaints;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\Complaints\SubmitComplaintRequest;
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

// redirect the user to the dashboard allowing breeze to redirect to the login page if required
Route::redirect('/', '/dashboard')->middleware(['auth', 'verified'])->name('home');

// display the complain logging page
Route::get('/logcomplaints', function(){
    return view('complaints.logcomplaint');
})->middleware(['auth', 'verified'])->name('logcomplaint');

Route::post('/submit', [Complaints::class, 'submitComplaint'])->middleware(['auth', 'verified'])->name('submitcomplaint');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
