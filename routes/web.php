<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::get('logowanie', [HomeController::class, 'logowanieIndex'])->name('login');
Route::post('logowanie', [HomeController::class, 'logowaniePost']);

Route::get('wyloguj', [HomeController::class, 'wyloguj']);

Route::get('rejestracja', [HomeController::class, 'rejestracjaIndex'])->name('register');
Route::post('rejestracja', [HomeController::class, 'rejestracjaPost']);

Route::get('rozmowa/{id}', [HomeController::class, 'rozmowa'])->middleware(['auth', 'uczestnik']);
Route::get('rozmowa/stworz/{user_id}', [HomeController::class, 'rozmowaStworz'])->middleware('auth');

Route::get('szukaj', [HomeController::class, 'szukaj'])->middleware('auth');
