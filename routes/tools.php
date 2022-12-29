<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/','ToolsController@index')->name('tools.home');