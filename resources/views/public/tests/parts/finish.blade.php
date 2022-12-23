<div class="d-none card-body" id="finish">

    <div class="row">
        <div class="col-12">
            <h1> {{$test->title}} </h1>
        </div>

        <div class="col-md-6 text-center">
            <img src="{{asset($test->featured_image)}}" class="test-banner" alt="">
        </div>
        
        <div class="col-md-6 text-center">
            <p class="display-6">You got <span id="final_score" class="text-success"> {{$test->items->count()}} </span> out of <strong> {{$test->items->count()}} </strong>.</p>
            <p>Next: Challenge your friends! Send this link <pre> {{route('test.show',['slug' => $test->slug])}} </pre> or click button below: </p>
            {!! $shareComponent !!}
        </div>

    </div>
</div>