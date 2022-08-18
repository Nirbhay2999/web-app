<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/create', function () {
        return view('create');
    });
    Route::get('/index', function () {
        return view('index');
    });
    Route::post('store',[ProductController::class,'store'])->name('store');
    Route::post('create',[ProductController::class,'create'])->name('create');
    Route::get('index',[ProductController::class,'index'])->name('index');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');
    Route::post('update/{id}',[ProductController::class,'update'])->name('update');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('delete');
    Route::delete('deleteMultiple',[ProductController::class,'deleteMultiple'] )->name('deleteMultiple');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
