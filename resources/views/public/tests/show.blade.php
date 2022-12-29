@extends('layouts.app', ['social_thumbnail' => asset($test->featured_image), 'title' => $test->title,  'meta_description' => $test->title.' '.$test->description ])

@section('content')
    <div class="row">
        
        <div class="col-md-10">
          <div class="card">
            <div class="card-body" id="begin">
                  
                  <div class="row mb-3">
                    <div class="col-12 col-md-6"><h1 class="mb-3"> {{$test->title}} </h1></div>
                    <div class="col-12 col-md-6">
                      @include('public.tests.parts.scoreboard')
                    </div>
                  </div>
                  
                  
                  <div class="row" id="description-box">
                    <div class="col-md-6 text-center">
                      <img loading="lazy" src="{{asset($test->featured_image)}}" class="test-banner w-100 h-75" alt="">
                    </div>
                    <div class="col-md-6">
                      <p> {!! $test->description  !!} </p>
                      <div class="d-grid"><button class="mt-5 btn btn-block btn-primary btn-lg start"> Start </button></div>
                    </div>
                    
                  </div>

                  @foreach ($items as $item)
                      <div class="row test-item d-none one-question" id="item-{{$item->id}}" data-val="{{$item->correct_answer->id}}" > 
                          
                          <div class="col-md-6 text-center">
                              <h3 class="text-success fw-bold"> {{$item->question}} </h3>
                              <img loading="lazy" src="{{asset($item->featured_image)}}" class="question-image w-100" alt="">
                          </div>
                          <div class="col-md-6">
                              
                              <div class="col correct-answer-text h3 d-none"><p class="my-2"> Correct Answer: </p></div>
                              @foreach ($item->choices as $choice)
                                <label class="form-check-label" for="{{$choice->id}}">
                                    <div class="form-check choice-container p-3 border border-secondary {{$choice->is_correct_answer == 1 ? 'is-correct':''}}">
                                      
                                      <input class="form-check-input d-none" type="radio" name="choice_{{$item->id}}" id="{{$choice->id}}" value="{{$choice->id}}" >
                                      
                                        {{$choice->text}}
                                      
                                    </div>
                                </label>
                              @endforeach
                          </div>

                          

                          <div class="col-md-6 offset-md-6 d-grid mt-3 d-none">
                              <button class="go-next btn btn-primary btn-block" type="button"> Check My Answer </button>
                          </div>
                      </div>
                  @endforeach

                  
            </div>

            @include('public.tests.parts.finish')


          </div>
        </div>
        <div class="d-none d-md-block col-md-2 "> @include('public.adspace.vertical') </div>
    </div>
    
    <div class="row my-2 text-center d-none d-md-block">
      @include('public.adspace.horizontal')
    </div>

    <div class="row" id="relatedTests"> </div>
@endsection

@push('styles')
    <style>
      .is-correct-answer{
        border: 1px solid green;
      }

      .choice-container:hover{
          background-color: #fd7e14; /*orange-500*/
          cursor: pointer;
      }

      .form-check-label{
        display:block;
      }

      div#social-links {
                margin: 0 auto;
                max-width: 500px;
            }
            div#social-links ul li {
                display: inline-block;
            }          
            div#social-links ul li a {
                padding: 10px;
                border: 1px solid #ccc;
                margin: 1px;
                font-size: 30px;
                color: #4267B2;
                background-color: #ccc;
            }

    </style>
@endpush

@push('scripts')
    <script>
      $(function(){
        
            let containers = [];
            let active_question = null;
            let score = 0;
            let total_items = 0;

            $("div.one-question").each(function(){
               let id =  ($(this).attr('id')).split("-");
                containers.push(id[1]);
                total_items = containers.length;
            });

            $('button.start').on('click',function(){
                $('#description-box').addClass('d-none');
                showNextQuestion();
            });

            $('input:radio').change(function(){
                  $('input:radio[name=choice_'+active_question+']').parent('.choice-container').removeClass('bg-primary').addClass('border-secondary').removeClass('text-white');
                  $('input:radio[name=choice_'+active_question+']:checked').parent('.choice-container').removeClass('border-secondary').addClass('bg-primary').addClass('text-white');
            });

            $('.form-check-input').on('click',function(){
              console.log('selected');
              $(this).closest('.one-question').find('button.go-next').trigger('click');
            });

            $('button.go-next').on('click',function(){
                
                //add timer ?
                let thisBtn = $(this);

                $('#item-'+active_question).find('.is-correct').addClass('is-correct-answer');

                if ($('input:radio[name=choice_'+active_question+']').is(':checked')) {
                  
                  thisBtn.prop("disabled",true);

                  let selected = $('input:radio[name=choice_'+active_question+']:checked').val();

                  showCorrectAnswer();

                  if(selected == $('#item-'+active_question).data('val')) {
                    score++;
                    toastr.success('Your answer is correct!',{ fadeAway: 1000 })
                  }else{
                    toastr.error('Sorry, your answer is incorrect.',{ fadeAway: 1000 });
                  }
                  updateScoreBoard();

                  setTimeout(() => {
                    showNextQuestion();
                  }, 2000);

                }else{
                  alert("answer please");
                }
                
            });

            function showCorrectAnswer(){
              
              $('#item-'+active_question).find('.correct-answer-text').removeClass('d-none');
              $('#item-'+active_question).find('.choice-container').addClass('d-none');
              $('#item-'+active_question).find('.is-correct').removeClass('d-none').addClass('bg-success text-white');
              

            }

            function showNextQuestion(){
                if(containers.length > 0){
                  let active_container = containers[0];
                  $('.one-question').addClass('d-none');
                  $('#item-'+active_container).removeClass('d-none');
                  containers = containers.filter(x => x !== active_container);
                  active_question = active_container;
                }else{
                  $('.one-question').addClass('d-none');
                  $('#begin').addClass('d-none');
                  $('#finish').removeClass('d-none');
                }

                console.log('active: '+active_question);
            }

            function updateScoreBoard(){
              $('span#score').removeClass('text-danger').addClass('text-success');
              $('span#final_score').text(score);
              $('span#score').text(score);
            }
      });
    </script>
@endpush