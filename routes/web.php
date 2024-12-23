<?php

use App\Http\Controllers\CarriersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Carriers;

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

Route::get('/alpine', function () {
    //DB::listen(fn($e) => dump($e->toRawSql()));

    $carries =  Carriers::all();
    dd($carries);
    return view('alpine');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logistics', function () {
    return view('logistics.index');
})->middleware(['auth', 'verified'])->name('logistics');

Route::middleware('auth')->group(function () {
    Route::get('/carriers', [CarriersController::class, 'index'])->name('carriers.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
