<?php

namespace App\Http\Controllers;

use Share;
use Carbon\Carbon;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $test = Test::where('slug',$slug)
                    ->where('is_public',1)
                    ->whereDate('publish_date','<=',Carbon::now())
                    ->where(function ($q){
                        $q->whereNull('expiry_date');
                        $q->orWhereDate('expiry_date','>=',Carbon::now());
                    });

        if( !Auth::check() ){
            $test = $test->where('is_approved',1);  
        }

        $test = $test->first();
       
        

        if($test){

            $shareComponent = Share::page(
                route('test.show',['slug' => $test->slug]),
                $test->title,
            )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->pinterest()        
            ->reddit();

            $data = [
                'test' => $test,
                'items' => $test->items,
                'shareComponent' => $shareComponent
            ];

            

            return view('public.tests.show')->with($data);
        }else{
            return abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
