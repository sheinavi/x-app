@extends('admin.layouts.admin')

@section('content')
<h4>Add Questions to <span class="text-primary"> {{$test_title}} </span> </h4>

    <form action="{{route('admin.test-items.store')}}" class="mt-5" enctype='multipart/form-data' method="POST">
        @csrf

        <div class="row">
            <div class="col mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" name="question" id="question" class="form-control" required>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-6">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input type="file" name="featured_image" id="featured_image" class="form-control" oninput="preview_image.src=window.URL.createObjectURL(this.files[0])" accept="image/*" required>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{asset('images/placeholder-featured-image.png')}}" class="question-image" id="preview_image" alt="">
            </div>
        </div>

        <hr>
        <h4>Add Choices</h4>

        <div id="choices_container">
            <div class="row one-choice mb-3">
                <div class="col-md-3 text-right">Choice #1</div>
                <div class="col-md-6"> <input type="text" name="choices[]" class="form-control" required> </div>
                <div class="col-md-3"> 
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="correct_answer" id="option1" value=0 checked required>
                        <label class="form-check-label" for="option1">Correct Answer</label>
                    </div> 
                </div>
            </div>
        
            <div class="row one-choice mb-3">
                <div class="col-md-3 text-right">Choice #2</div>
                <div class="col-md-6"> <input type="text" name="choices[]" class="form-control" required> </div>
                <div class="col-md-3 "> 
                    <div class="form-check m-auto">
                        <input class="form-check-input" type="radio" name="correct_answer" id="option2" value=1 required>
                        <label class="form-check-label" for="option2">Correct Answer</label>
                    </div> 
                </div>
            </div>

            <div class="row one-choice mb-3">
                <div class="col-md-3 text-right">Choice #3</div>
                <div class="col-md-6"> <input type="text" name="choices[]" class="form-control" required> </div>
                <div class="col-md-3 "> 
                    <div class="form-check m-auto">
                        <input class="form-check-input" type="radio" name="correct_answer" id="option3" value=2 required>
                        <label class="form-check-label" for="option3">Correct Answer</label>
                    </div> 
                </div>
            </div>

            <div class="row one-choice mb-3">
                <div class="col-md-3 text-right">Choice #4</div>
                <div class="col-md-6"> <input type="text" name="choices[]" class="form-control" required> </div>
                <div class="col-md-3 "> 
                    <div class="form-check m-auto">
                        <input class="form-check-input" type="radio" name="correct_answer" id="option4" value=3 required>
                        <label class="form-check-label" for="option4">Correct Answer</label>
                    </div> 
                </div>
            </div>

        </div>

        <input type="hidden" name="test_id" value="{{$test_id}}">
        <input type="hidden" name="action" value="save">

        <div class="row">
            <div class="col-md-3 offset-md-6">
                <button type="button" data-val="add_more" class="submitForm btn btn-primary btn-block btn-user"> Save and Add More </button>
            </div>

            <div class="col-md-3">
                <button type="submit" data-val="save" class="btn btn-info btn-block btn-user"> Save </button>
            </div>
        </div>
        
    
    </form>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('button.submitForm').on('click',function(){
                $('input[name=action]').val('add_more');
                $('form').trigger('submit');
            });
        });
    </script>
@endpush