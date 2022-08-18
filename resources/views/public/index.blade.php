@extends('layouts.app')

@push('styles')
    <style>
      #search-container{
        background-color: #adb5bd;
        background-image: linear-gradient(180deg, #adb5bd 10%, #e9ecef 100%);
        background-size: cover;
      }


    </style>
@endpush

@section('content')

<div class="row" id="search-container">
  <form action="" class="col-12">
    <div class="input-group my-3">
      <input type="text" class="form-control" placeholder="Search Quizzes" aria-describedby="search">
      
        <select name="category_id" class="form-select">
          <option value=""> Any Category </option>
          @foreach ($categories as $category)
              @if (request()->category_id == $category->id)
                  <option value="{{$category->id}}" selected> {{$category->title}} </option>
              @else
                <option value="{{$category->id}}"> {{$category->title}} </option>
              @endif
          @endforeach
        </select>
     
      <button class="btn btn-outline-primary" type="button" id="search">Search</button>
    </div>
  </form>
</div>

   
      

          

          <div class="row">
            @if ( $tests->count() > 0)
              @foreach ($tests as $test)
                  <div class="col-md-3">
                    <div class="card" style="w-100">
                      <img src="{{asset($test->featured_image)}}" class="card-img-top" alt="{{$test->title}}">
                      <div class="card-body">
                        <h5 class="card-title">{{$test->title}}</h5>
                        <p class="card-text">{!! $test->description !!}.</p>
                        <a href="{{route('test.show',['slug' => $test->slug])}}" class="btn btn-primary">START</a>
                      </div>
                    </div>
                  </div>
              @endforeach
            @else 
              <div class="col text-center">
                <p class="display-6">No tests available as of the moment.</p>
              </div>
            @endif
          </div>

@endsection