<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/series');
});

Route::get('/series', [SeriesController::class, 'index'])->name('list_series');
Route::get('/series/create', [SeriesController::class, 'create'])->name('create_serie')->middleware('auth');
Route::post('/series/create', [SeriesController::class, 'store'])->middleware('auth');
Route::delete('/series/destroy/{id}', [SeriesController::class, 'destroy'])->middleware('auth');
Route::post('/series/edit/{id}', [SeriesController::class, 'edit'])->middleware('auth');

Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index']);
Route::post('/seasons/{season}/episodes/watch', [EpisodesController::class, 'watch'])->middleware('auth');

Route::get('/series/{seasonId}/seasons', [SeasonController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'signin']);

Route::get('/signup', [SignupController::class, 'create']);
Route::post('/signup', [SignupController::class, 'store']);

Route::get('/logout', function(){
    Auth::logout();

    return redirect('/auth');
});