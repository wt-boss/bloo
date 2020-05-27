@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <a href="{{route('take_survey',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-primary" value="Passer ce questionnaire"/></a>
                            <a href="{{route('questionnaire.edit',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-warning" value="Editer questionnaire"/></a>
                            <form action="/questionnaire/{{$questionnaire->id}}}}" method="post" class="col-3">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn  btn-danger float-right" value="Supprimser cette question"/>
                            </form>
                            <a href="{{route('questionnaire.stat',[$questionnaire->id])}}" class="col-3"> <input type="button" class="btn btn-info float-right" value="Statistique questionnaire"/></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="titre">Titre</label>
                                <input type="text" class="form-control" name="titre" id="titre" aria-describedby="titre" value="{{$questionnaire->title}}" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="objectif">Objectif</label>
                                <input type="text" class="form-control" id="objectif" name="objectif" value="{{$questionnaire->purpose}}" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="date_start">Date de debut</label>
                                <input type="text" class="form-control" name="date_start" id="date_start" aria-describedby="titre" value="{{$questionnaire->date_start}}" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="date_end">Date de fin</label>
                                <input type="text" class="form-control" id="date_end" name="date_end" value="{{$questionnaire->date_end}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Questions</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse($questionnaire->questions as $question)
                                <li class="list-group-item d-flex justify-content-between">{{$question->question}}
                                    <form action="/questionnaires/{{ $questionnaire->id}}/questions/{{$question->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimser cette question</button>
                                    </form>
                                </li>
                            @empty
                                <li class="list-group-item">Pas de question dans ce formulaire</li>
                            @endforelse
                        </ul>
                        <br>
                        {!! Form::open(['route' => ['question.store',$questionnaire->id]]) !!}
                        {!! Form::token();!!}
                        <h5 class="text-uppercase text-justify">Ajouter une question</h5>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir votre option</label>
                            <select class="form-control" name="questions[question_type]" id="question_type">
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="textarea">Textarea</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio Buttons</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">question</label>
                            <input type="text" class="form-control" name="questions[question]" >
                        </div>
                        <span class="form-g"></span>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '.delete-option', function() {
            $(this).parent(".input-field").remove();
        });
        // will replace .form-g class when referenced
        var material = '<div class="form-group input-field input-g">' +
            '<input name="answers[][answer]" id="nom_option[]" type="text" class="form-control"  placeholder="Entrer option">' +
            '<span style="float:right; cursor:pointer;"class="delete-option badge badge-danger">Supprimer</span>' +
            '<span class="add-option badge badge-info" style="cursor:pointer;">Ajouter une autre</span>' +
            '</div>';

        // for adding new option
        $(document).on('click', '.add-option', function() {
            $(".form-g").append(material);
        });
        // allow for more options if radio or checkbox is enabled
        $(document).on('change', '#question_type', function() {
            var selected_option = $('#question_type :selected').val();
            if (selected_option === "radio" || selected_option === "checkbox") {
                $(".form-g").html(material);
            } else {
                $(".input-g").remove();
            }
        });
    </script>
    @endsection


