<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

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
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/home', [BrandController::class, 'create'])->name('home');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands', [BrandController::class, 'edit'])->name('brands.edit');
    Route::get('/brands', [BrandController::class, 'destroy'])->name('brands.destroy');
});
