<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use GuzzleHttp\Middleware;
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


// Route::controller(SeriesController::class)->group(function () {
    //     Route::get('/series', 'index')->name('series.index');
    //     Route::get('/series/create', 'create')->name('series.create');
    //     Route::post('/series/salvar', 'store')->name('series.store');
    //     Route::delete('/series/destroy/{series}', 'destroy')->name('series.destroy');
    // });
    
Route::resource('/series', SeriesController::class) // Cria todas as rotas com o padrão acima
    ->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);

Route::middleware('autenticador')->group(function () {
    Route::get('/', function () {
        return redirect('/series');
    });
        
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
    
    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
});



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');