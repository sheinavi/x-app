@extends('admin.layouts.admin')

@push('styles')
    <style>
        img.thumbnail{
            max-width:100px;
        }
    </style>
@endpush

@section('content')
<h4> Edit Test Item </h4>

<form action="{{route('admin.test-items.update',['test_item' => $item])}}" class="mt-5" enctype='multipart/form-data' method="POST">
    @csrf
    @method('put')

    <div class="row">
        <div class="col mb-3">
            <label for="question" class="form-label">Question</label>
            <input type="text" name="question" id="question" value="{{$item->question}}" class="form-control" required>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-md-6">
            <label for="featured_image" class="form-label">Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" class="form-control" oninput="preview_image.src=window.URL.createObjectURL(this.files[0])" accept="image/*">
        </div>
        <div class="col-md-6 text-center">
            <img src="{{asset($item->featured_image)}}" class="question-image" id="preview_image" alt="">
        </div>
    </div>

    <hr>
    <h4>Add Choices</h4>

    <div id="choices_container">
       @foreach ($item->choices as $choice)
        <div class="row one-choice mb-3">
            <div class="col-md-3 text-right">Choice {{$start}}</div>
            <div class="col-md-6"> <input type="text" name="choices[{{$choice->id}}]" class="form-control" value="{{$choice->text}}" required> </div>
            <div class="col-md-3 "> 
                <div class="form-check m-auto">
                    <input class="form-check-input" type="radio" name="correct_answer" id="option{{$choice->id}}" value="{{$choice->id}}" {{$correct_answer_id == $choice->id ? "checked":""}} required>
                    <label class="form-check-label" for="option{{$choice->id}}">Correct Answer</label>
                </div> 
            </div>
        </div>
       @endforeach

    </div>

    <div class="row">
        <div class="col-md-3 offset-md-6">
            &nbsp;
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-info btn-block btn-user"> Update </button>
        </div>
    </div>
    

</form>
@endsection

@push('scripts')
    <script>
        $(function(){
            
        });
    </script>
@endpush