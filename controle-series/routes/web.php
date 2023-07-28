<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
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
    return redirect('/series');
});

// Route::controller(SeriesController::class)->group(function () {
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/create', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series.store');
//     Route::delete('/series/destroy/{series}', 'destroy')->name('series.destroy');
// });

Route::resource('/series', SeriesController::class) // Cria todas as rotas com o padrão acima
    ->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
