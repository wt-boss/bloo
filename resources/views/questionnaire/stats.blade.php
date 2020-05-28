@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{$questionnaire->title}} || {{$questionnaire->purpose}}</div>
                    <div class="card-body">
                        <form  action="/surveys/{{$questionnaire->id}}-{{Str::slug($questionnaire->title)}}" method="post">
                            @csrf
                            @foreach($questionnaire->questions as $key=>$question)
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <div class="row">
                                            <p class="col-9"><strong>Question {{ $key+1 }} - {{ $question->question }}</strong></p>
                                            <p class="col-3 font-italic">Nombre de reponse : {{$question->responses->count()}} </p>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                          @if($question->question_type === 'checkbox')
                                                @foreach($question->answers as $val => $answer)
                                                    <label for="answer{{$answer->id}}">
                                                        <li class="list-group-item d-flex justify-content-between ">
                                                            <div>{{$answer->answer}}</div>
                                                            <p class="badge badge-success">{{ intval(($answer->responses->count())*100 /$question->responses->count()) }}%</p>
                                                        </li>
                                                    </label>
                                                @endforeach
                                                <br>
                                            @elseif($question->question_type === 'radio')
                                                @foreach($question->answers as $answer)
                                                    <label for="answer{{$answer->id}}">
                                                        <li class="list-group-item d-flex justify-content-between ">
                                                            <div>{{$answer->answer}}</div>
                                                            <p class="badge badge-success">{{ intval(($answer->responses->count())*100 /$question->responses->count()) }}%</p>
                                                        </li>
                                                    </label>
                                                @endforeach
                                                <br>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
