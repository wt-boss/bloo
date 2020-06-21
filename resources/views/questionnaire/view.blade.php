



@extends('layouts.frontend.app')

@section('content')

<div class="hero-wrap">
    <div class="overlay"></div>
    <div class="circle-bg"></div>
    <div class="circle-bg-2"></div>
    <div class="container-fluid">
        <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{$questionnaire->purpose}}</p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">{{$questionnaire->title}}</h1>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form  action="/surveys/{{$questionnaire->id}}-{{Str::slug($questionnaire->title)}}" method="post">
                                @csrf
                                @foreach($questionnaire->questions as $key=>$question)
                                    <div class="card mt-4">
                                        <div class="card-header"><strong>Question {{ $key+1 }} - {{ $question->question }}</strong></div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @if($question->question_type === 'text')
                                                    <div class="form-group">
                                                        <label for="reponse">Reponse</label>
                                                        <input type="text" class="form-control" id="reponse"  name="responsest[{{$key}}][answer]" >
                                                        <input type="hidden" name="responsest[{{$key}}][question_id]" value="{{$question->id}}">
                                                        <input type="hidden" name="responsest[{{$key}}][answer_id]" value="">

                                                    </div>
                                                    <br>
                                                @elseif($question->question_type === 'number')
                                                    <div class="form-group">
                                                        <label for="reponse">Reponse</label>
                                                        <input type="number" class="form-control" id="reponse"  name="responsest[{{$key}}][answer]" >
                                                        <input type="hidden" name="responsest[{{$key}}][question_id]" value="{{$question->id}}">
                                                        <input type="hidden" name="responsest[{{$key}}][answer_id]" value="">
                                                    </div>
                                                    <br>
                                                @elseif($question->question_type === 'textarea')
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Reponse</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="responsest[{{$key}}][answer]"></textarea>
                                                        <input type="hidden" name="responsest[{{$key}}][question_id]" value="{{$question->id}}">
                                                        <input type="hidden" name="responsest[{{$key}}][answer_id]" value="">
                                                    </div>
                                                    <br>
                                                    @elseif($question->question_type === 'checkbox')
                                                    @foreach($question->answers as $val => $answer)
                                                        <label for="answer{{$answer->id}}">
                                                            <li class="list-group-item">
                                                                <input type="checkbox" name="responsesm[{{$key}}][{{$val}}][answer_id]" id="answer{{$answer->id}}"
                                                                       class="mr-2" value="{{$answer->id}}" >
                                                                {{$answer->answer}}
                                                                <input type="hidden" name="responsesm[{{$key}}][{{$val}}][question_id]" value="{{$question->id}}">
                                                                <input type="hidden" name="responsesm[{{$key}}][{{$val}}][answer]" value="">
                                                            </li>
                                                        </label>
                                                    @endforeach
                                                    <br>
                                                @elseif($question->question_type === 'radio')
                                                    @foreach($question->answers as $answer)
                                                        <label for="answer{{$answer->id}}">
                                                            <li class="list-group-item">
                                                                <input type="radio" name="responses[{{$key}}][answer_id]" id="answer{{$answer->id}}"
                                                                       {{old('responses.'. $key. '.answer_id') == $answer->id ? 'checked': ''}}
                                                                       class="mr-2" value="{{$answer->id}}" >
                                                                {{$answer->answer}}
                                                                <input type="hidden" name="responses[{{$key}}][question_id]" value="{{$question->id}}">
                                                                <input type="hidden" name="responses[{{$key}}][answer]" value="">
                                                            </li>
                                                        </label>
                                                    @endforeach
                                                    <br>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                                <br>
                                <div class="card">
                                    <div class="card-header">Vos information</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name"> Votre nom </label>
                                            <input type="text" name="survey[name]" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                                            @error('survey[name]')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email"> Votre email Email </label>
                                            <input type="email" name="survey[email]" class="form-control" id="email" aria-describedby="nameHelp" placeholder="Enter Email">

                                            @error('survey[email]')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                    </div>
                                 </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <br>



@endsection
