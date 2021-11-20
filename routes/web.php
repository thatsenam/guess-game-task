<?php

use App\Http\Controllers\GamesController;
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

Route::get('/', [GamesController::class, 'index'])->name('index');
Route::post('/check_guess', [GamesController::class, 'guess'])->name('check_guess');
Route::get('/initialize_game', [GamesController::class, 'initialize'])->name('initialize');
Route::get('/results', [GamesController::class, 'results'])->name('results');
