<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/','GamesController@index')->name('games.home');
Route::get('/math','GamesController@math')->name('games.math');