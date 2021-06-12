<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\{DashboardController, DataBukuController};

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

// Views
Route::get('/', function() {
    return Inertia::render('Dashboard');
})->name('/');
Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::get('/data-buku', function() {
    return Inertia::render('DataBuku');
})->name('books.index');


// API
Route::get('/api/books', [DataBukuController::class, 'index'])->name('api.books');
Route::post('/api/books/store', [DataBukuController::class, 'store'])->name('api.books.store');
Route::delete('/api/books/delete', [DataBukuController::class, 'destroy'])->name('api.books.destroy');
Route::put('/api/books/update', [DataBukuController::class, 'update'])->name('api.books.update');
