<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [BrandController::class, 'index'])->name('home');
// Route::get('/home', [BrandController::class, 'create']);

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([])->group(function () {
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::delete('brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::put('brands/{id}', [BrandController::class, 'update'])->name('brands.update');

    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}', [ItemController::class, 'edit'])->name('items.edit');
    Route::delete('items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::put('items/{id}', [ItemController::class, 'update'])->name('items.update');
});
