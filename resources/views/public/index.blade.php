@extends('layouts.app')

@push('styles')
    <style>
      #search-container{
        background-color: #adb5bd;
        background-image: linear-gradient(180deg, #adb5bd 10%, #e9ecef 100%);
        background-size: cover;
      }

      img.homepage-test-thumbnail{
        width: 100%;
        height: 150px;
      }

      .form-select.search_category{
        max-width:20%;
      }

    </style>
@endpush

@section('content')

<div class="row" id="search-container">
  <form action="" class="col-12 px-0">
    <div class="input-group mb-3">
      <input type="text" name="key" value="{{request()->key ?? ''}}" class="form-control" placeholder="Search Quizzes" aria-describedby="search">
      
        <select name="category_id" class="form-select search_category">
          <option value=""> Any Category </option>
          @foreach ($categories as $category)
              @if (request()->category_id == $category->id)
                  <option value="{{$category->id}}" selected> {{$category->title}} </option>
              @else
                <option value="{{$category->id}}"> {{$category->title}} </option>
              @endif
          @endforeach
        </select>
        
      <button class="btn btn-primary" type="submit" id="search">Search</button>
      <a href="/" class="btn btn-outline-secondary d-none d-md-block">Clear Selection</a>
      <a href="/" class="btn btn-outline-secondary d-none d-md-block">Random Quizzes</a>

    </div>
  </form>
</div>

          <div class="row">
            @if ( $tests->count() > 0)
              @foreach ($tests as $test)
                  <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card" style="w-100">
                      
                      <img src="{{asset($test->featured_image)}}" class="homepage-test-thumbnail m-auto pt-2" alt="{{$test->title}}">
                      
                      <div class="card-body">
                        
                        <a href="{{route('test.show',['slug' => $test->slug])}}">
                          <h5 class="card-title text-primary">{{$test->title}}</h5>
                        </a>

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