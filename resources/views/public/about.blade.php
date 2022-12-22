@extends('layouts.app')

@section('content')
<div class="row">
    <div class="card">
      <div class="card-body">
        <h1 class="display-5 text-primary">About</h1>
        
        <p class="mb-2">Hello dear visitor!</p>
        
        <p> Firstly, thank you for visiting this page. </p>

        <p>Thank you for visiting this site. This site aim to: 
            <ol>
                <li>Make engaging short quizzes</li>
                <li>Encourage creators to add more quizzes</li>
            </ol>
        </p>

        <p>
          If you have any questions, please feel free to <a href="{{route('contact')}}">send me a message</a>.
        </p>

      </div>
    </div>
</div>
@endsection