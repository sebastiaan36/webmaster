<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagespeedController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\Dashboard;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('pagespeed', PagespeedController::class);
    Route::resource('domain', DomainController::class);
    //Route::resource('link', LinkController::class);
    // all links have a domain, make the route reflect that
    Route::resource('domain.link', LinkController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
});


require __DIR__.'/auth.php';
