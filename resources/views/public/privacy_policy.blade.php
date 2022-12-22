@extends('layouts.app')

@section('content')
<div class="row">
    <div class="card">
      <div class="card-body">
        <h1 class="display-5 text-primary">Privacy Policy</h1>  
        <p> 
            This privacy policy describes processing of information provided or collected. 
            
            <br><br>
            For registered users (contributors/creators and administrators), we collect the 
            following data: Full name, email, password. We have no control over data collected
            and provided by third-party apps linked to our platform. 
            <br><br>
            For guests, we might save cookies to your browser, but not save these data in our
            database.
            <br><br>
            We will not sell or distribute data collected in this site.
            <br><br>If you have any more clarifications, please send us a message through our 
            <a href="{{route('contact')}}"> contact us page </a>.
        </p>
      </div>
    </div>
</div>
@endsection