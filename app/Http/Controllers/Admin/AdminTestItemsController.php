<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\Choice;
use App\Models\TestItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminTestItemsController extends Controller
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
    public function create($slug)
    {
        $test = Test::where('slug',$slug)->first();

        if(!$test) return abort('404');
        
        $data = [
            'test_id' => $test->id,
            'test_title' => $test->title
        ];

        return view('admin.tests.items.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $test_item = TestItem::create(['test_id' => $request->test_id,'question' => $request->question]);

        if($test_item){
            if($request->hasFile('featured_image')){
                $file= $request->file('featured_image');
                $filename= $test_item->id.'-'.$file->getClientOriginalName();
                $dir = 'uploads/'.$test_item->id;

                File::ensureDirectoryExists($dir);
                
                $file->move(public_path($dir), $filename);

                $test_item->featured_image = 'uploads/'.$test_item->id.'/'.$filename;
                $test_item->save();
            }
        }

        if($request->has('choices')){
            foreach($request->choices as $key => $val){
                $choice = [
                    'test_item_id' => $test_item->id,
                    'text' => $val,
                    'is_correct_answer' => $request->correct_answer == $key ? 1 : 0
                ];

                Choice::create($choice);
            }
        }

        if($request->action == "add_more"){
            return redirect()->route('admin.test-items.create',['slug' => $test_item->test->slug]);
        }

        if($request->action == "save"){
            return redirect()->route('admin.tests.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
