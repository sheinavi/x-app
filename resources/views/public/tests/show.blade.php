@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
          @include('public.tests.parts.scoreboard')
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-body">
                  <h1> {{$test->title}} </h1>
                  
                  <div class="row" id="description-box">
                    <div class="col-md-6">
                      <img src="{{asset($test->featured_image)}}" class="test-banner" alt="">
                    </div>
                    <div class="col-md-6">
                      <p> {!! $test->description  !!} </p>
                    </div>
                    <div class="col-md-12 d-grid mt-5">
                      <button class="btn btn-block btn-outline-success btn-lg start"> Start </button>
                    </div>
                  </div>

                  @foreach ($items as $item)
                      <div class="row test-item d-none one-question" id="item-{{$item->id}}" data-val="{{$item->correct_answer->id}}" > 
                          <div class="col-12">
                              <h3> {{$item->question}} </h3>
                          </div>
                          <div class="col-md-6 text-center">
                              <img src="{{asset($item->featured_image)}}" class="question-image" alt="">
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

                          

                          <div class="col-md-4 offset-md-4 d-grid mt-3">
                              <button class="go-next btn btn-primary btn-block" type="button"> Next </button>
                          </div>
                      </div>
                  @endforeach

                  <div id="finish" class="d-none">FINISH</div>
            </div>
          </div>
        </div>
    </div>
    

@endsection

@push('styles')
    <style>
      .is-correct-answer{
        border: 1px solid green;
      }

      .choice-container:hover{
          background-color: blue;
          cursor: pointer;
      }

      .form-check-label{
        display:block;
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

            $('button.go-next').on('click',function(){
                $(this).prop("disabled",true);
                //add timer ?

                $('#item-'+active_question).find('.is-correct').addClass('is-correct-answer');

                if ($('input:radio[name=choice_'+active_question+']').is(':checked')) {
                  
                  let selected = $('input:radio[name=choice_'+active_question+']:checked').val();

                  showCorrectAnswer();

                  if(selected == $('#item-'+active_question).data('val')) {
                    score++;
                    toastr.success('Your answer is correct!')
                  }else{
                    toastr.error('Sorry, your answer is incorrect.');
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
                  $('#finish').removeClass('d-none');
                }

                console.log('active: '+active_question);
            }

            function updateScoreBoard(){
              $('span#score').text(score);
            }
      });
    </script>
@endpush