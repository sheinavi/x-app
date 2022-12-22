<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminTestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tests = auth()->user()->tests;

        $data = [
            'tests' => $tests
        ];
        
        return view('admin.tests.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::orderBy('title')->get(),
            'publish_date' => $from_for_val=  date("Y-m-d\TH:i:s", strtotime(date('Y-m-d')))
        ];
        return view('admin.tests.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:tests|max:255',
            'publish_date' => 'date|nullable',
            'expiry_date' => 'date|nullable'
        ]);

        $request->merge(['author_id' => auth()->user()->id]);
        
        if(auth()->user()->hasRole('admin')){
            $request->merge(['is_approved' => 1]);
        }
        

        $test = Test::create($request->except(['featured_image']));

        if($request->hasFile('featured_image')){
            $file= $request->file('featured_image');
            $filename= $test->id.'-'.$file->getClientOriginalName();
            $dir = 'uploads/'.$test->id;

            File::ensureDirectoryExists($dir);
            
            $file->move(public_path($dir), $filename);

            $test->featured_image = 'uploads/'.$test->id.'/'.$filename;
            $test->save();
        }
       
        return redirect()->route('admin.test-items.create',['slug' => $test->slug]);
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
        
        $test = Test::where('slug',$id)
                    ->where('author_id',auth()->user()->id)
                    ->first();
        
        $data = [
            'test' => $test,
            'categories' => Category::orderBy('title')->get()
        ];

        return view('admin.tests.edit')->with($data);
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
        $validated = $request->validate([
            'publish_date' => 'date|nullable',
            'expiry_date' => 'date|nullable'
        ]);
        
        $test = Test::find($id);
        $test->update($request->except(['featured_image']));

        if($request->hasFile('featured_image')){
            $file= $request->file('featured_image');
            $filename= $test->id.'-'.$file->getClientOriginalName();
            $dir = 'uploads/'.$test->id;

            File::ensureDirectoryExists($dir);
            
            $file->move(public_path($dir), $filename);

            $test->featured_image = 'uploads/'.$test->id.'/'.$filename;
            $test->save();
        }
       
        return redirect()->route('admin.tests.index');
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
