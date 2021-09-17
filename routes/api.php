<?php

use App\Models\Rozmowa;
use App\Models\User;
use App\Models\Wiadomosc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function(){
    return User::all();
});

Route::get('user/{id}', function($id){
    return User::findOrFail($id);
});

Route::get('user/{id}/rozmowy', function($id){
    return User::find($id)->uczestnik;
});

Route::get('user/{id}/wiadomosci', function($id){
    return User::find($id)->wiadomosci;
});

Route::get('rozmowa/{id}/wiadomosci', function($id){
    return Rozmowa::find($id)->wiadomosci;
});

Route::get('rozmowa/{id}/uczestnicy', function($id){
    $tab = [];
    foreach(Rozmowa::find($id)->uczestnicy as $uczestnik)
    {
        $tab[] = $uczestnik->user;
    }

    return $tab;
});
