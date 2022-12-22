@extends('layouts.app')

@section('content')
<div class="row">
    <div class="card">
      
      <div class="card-body">
        <h1 class="display-5 text-primary">Contact</h1>  
        <div class="row mt-5">  
          <div class="col">
            <h3>Information</h3>
            <p>Contact us for partnerships, suggestions, contributions, or when you just have so much time in your hands.
              Use the form at the right side or directly email support@quizcrashers.com .
              <br>
              We will try our best to get back to you the soonest possible time.
            </p>
          </div>        
          <div class="col">
            <h3>How Can We Help?</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{route('contact_us_submit')}}">
              
              @csrf

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Your Email Address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Message</label>
                <textarea name="message" rows="5" class="form-control" required></textarea>
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

          </div>

          

        </div>
        
        
        



      </div>
    </div>
</div>
@endsection