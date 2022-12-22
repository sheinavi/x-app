@extends('emails.layout')

@section('content')
        
<p> <strong>Thank you for contacting us. We received this message: </strong> </p>

<p> <span style="font-size:20px;color:gray">&quot;</span> {{$content}} <span style="font-size:20px;color:gray">&quot;</span> </p>

<p> <strong>We will get back at you as soon as possible.</strong> </p>

@endsection

