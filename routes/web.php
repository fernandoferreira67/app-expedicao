<?php

use App\Http\Controllers\CarriersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PackagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Carrier;

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

    return view('logistics.packages.signatura');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/logistics', function () {
    return view('logistics.index');
})->middleware(['auth', 'verified'])->name('logistics');


Route::middleware('auth')->group(function () {
    Route::get('/carriers', [CarriersController::class, 'index'])->name('carriers.index');
    Route::get('/carriers/create', [CarriersController::class, 'create'])->name('carriers.show');
    Route::post('/carriers/store', [CarriersController::class, 'store'])->name('carriers.store');
    Route::get('/carriers/edit/{id}', [CarriersController::class, 'edit'])->name('carriers.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/logistics/packages', [PackagesController::class, 'index'])->name('packages.index');
    Route::get('/logistics/packages/create', [PackagesController::class, 'create'])->name('packages.create');
    Route::post('/logistics/packages/open', [PackagesController::class, 'open'])->name('packages.open');
    Route::get('/logistics/packages/{id}', [PackagesController::class, 'show'])->name('packages.show');
    Route::post('/logistics/packages/store', [PackagesController::class, 'store'])->name('packages.store');
    Route::post('/logistics/packages/readAccessKey', [PackagesController::class, 'readAccessKey'])->name('packages.readAccessKey');
});

require __DIR__.'/auth.php';
