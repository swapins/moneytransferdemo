<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\NationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReconfirmPasswordController;
use App\Http\Controllers\welcomeController;
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



Route::get('/' ,[welcomeController::class,'index']);
Route::get('/getOptions/{selectedValue}',[welcomeController::class,'getOptions'])->name('getOptions');
Route::get('/getResults/{selectedValue}/{selectedValue2}',[welcomeController::class,'getResults'])->name('getOptions');



Route::middleware(['auth', 'reconfirm.password'])->group(function () {
    Route::get('/updateDb', [NationController::class, 'updateNationsDb'])->middleware(['auth', 'verified'])->name('nationsUpdate');
});

Route::middleware('auth')->group(function () {
    Route::get('/reconfirm-password', [ReconfirmPasswordController::class,'showForm'])->name('reconfirm-password-form');
    Route::post('/reconfirm-password', [ReconfirmPasswordController::class,'reconfirm'])->name('reconfirm-password');

    Route::put('/records/{id}/toggleSend', [NationController::class, 'toggleStatusSend']);
    Route::put('/records/{id}/toggleReceive', [NationController::class, 'toggleStatusReceive']);


    Route::get('/dashboard', [dashboardController::class,'index'])->name('dashboard');
    Route::get('/rates', [dashboardController::class,'rates'])->name('rates');
    Route::get('/dashboard/{region}', [dashboardController::class,'index']);

    Route::post('/saveRate',[ExchangeController::class,'saveRate'])->name('saveRate');
    Route::put('/updateRate/{id}',[ExchangeController::class,'updateRate'])->name('updateRate');
    Route::delete('/deleteRate/{id}',[ExchangeController::class,'deleteRate'])->name('deleteRate');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
