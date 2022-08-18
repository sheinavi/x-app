<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Category;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        
        $tests = Test::where('is_public',1)
                        ->where('is_approved',1)
                        ->inRandomOrder()
                        ->paginate(20);

        $data = [
            'tests' => $tests,
            'categories' => Category::whereHas('tests')->orderBy('title')->get()
        ];
        
        return view('public.index')->with($data);
    }

    public function about(){
        return view('public.about');
    }

    public function contact(){
        return view('public.contact');
    }

    public function privacyPolicy(){
        return view('public.privacy_policy');
    }
}
