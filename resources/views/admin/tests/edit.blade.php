@extends('admin.layouts.admin',['title' => 'Create'])

@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Test | {{$test->title}}</h1>
</div>
@endsection

@section('content')
    <p class="sr-only">Edit</p> 

    <form action="{{route('admin.tests.update',['test' => $test])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row mb-3">

            <div class="d-flex justify-content-center">
                <img src="{{asset($test->featured_image)}}" class="test-banner" id="preview_image" alt="">
            </div>
            <div class="col-auto">
                <label for="featured_image" class="form-label">Upload New Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control" value="" oninput="preview_image.src=window.URL.createObjectURL(this.files[0])" accept="image/*">
                <small> Upload an engaging and relevant image describing this test. </small>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                
                    <label for="title" class="form-label required">Title</label>
                    <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" name="title" value="{{$test->title}}" id="title" required>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                
            </div>

            <div class="col-md-6 mb-3">
                <label for="category_id" class="form-label required">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        @if ($category->id == $test->category_id)
                            <option value="{{$category->id}}" selected> {{$category->title}} </option>
                        @else
                            <option value="{{$category->id}}"> {{$category->title}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3 col-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Write a short description of this test">{!! $test->description !!}</textarea>
            </div>
            
        </div>

        <div class="row align-items-center mb-3">
            <div class="col-auto">
                <div class="form-check form-switch form-check-inline">
                    <input class="form-check-input" type="checkbox" id="is_age_restricted" {{$test->min_age == null ? '':'checked'}} >
                    <label class="form-check-label" for="is_age_restricted">Age-restricted?</label>
                </div>
            </div>
            <div class="col-auto">
                    <label for="min_age" class="col-form-label">Minimum Age Required:</label>
            </div>
            <div class="col-auto">
                <input type="number" class="form-control" name="min_age" id="min_age" min="3" value="{{$test->min_age}}" {{$test->min_age == null ? 'disabled':''}}>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="publish_date" class="form-label required">Publish Date</label>
                <input type="datetime-local" class="form-control @if($errors->has('publish_date')) is-invalid @endif" name="publish_date" id="publish_date" value="{{$test->publish_date}}" required>
                @if ($errors->has('publish_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('publish_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="expiry_date" class="form-label">Expires On</label>
                <input type="datetime-local" class="form-control @if($errors->has('expiry_date')) is-invalid @endif" name="expiry_date" id="expiry_date" value="{{$test->expiry_date == null ? null: $test->expiry_date}}" >
                @if ($errors->has('expiry_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('expiry_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-md-9">
                <button type="submit" class="btn btn-primary btn-user btn-block">Save</button>
            </div>
            
        </div>
    </form>
@endsection

@push('scripts')
    
    <script>
        $(function(){
            $("#is_age_restricted").on('change',function(){
                if($(this).is(':checked')){
                    $("#min_age").prop("disabled",false).attr("required", true);
                    if($("#min_age").val() == ""){
                        $("#min_age").val('18');
                    }
                } else {
                    $("#min_age").prop("disabled",true).attr("required", false);
                }
            });
        });
    </script>

@endpush