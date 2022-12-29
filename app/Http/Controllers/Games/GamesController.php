<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index(){
        return view('public.games.index');
    }

    public function math(){
        return view('public.games.math');
    }
}
