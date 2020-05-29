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
                <div class="card-header">Acceuil</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        Bienvenue M.{{ auth()->user()->name}} Vous etes connecté.
                    <a href="{{route('questionnaire.create')}}" class="btn btn-primary float-right" >Créer un questionnaire</a>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Mes questionnaires</div>
                <div class="card-body">
                   <a  href="{{route('questionnaire.free')}}">
                       <input type="submit" class="btn btn-info" value="creer un sondage gratuit">
                   </a>
                    <a  href="{{route('questionnaire.login_free')}}">
                        <input type="submit" class="btn btn-info" value="voir mon sondage gratuit">
                    </a>
                    <ul class="list-group">
                      @forelse($questionnaires as $questionnaire)
                          <li class="list-group-item">
                              <div>
                                  <small class="font-weight-bold">Voir de ce questionnaire</small>
                                  <p><a href="{{route('questionnaire.show',[$questionnaire->id])}}">{{$questionnaire->title}}</a></p>
                                  <small class="font-weight-bold">Partager l'url de ce questionnaire</small>
                                  <p><a href="{{route('take_survey',[$questionnaire->id])}}">{{route('questionnaire.show',[$questionnaire->id])}}</a></p>
                              </div>
                          </li>
                          @empty
                          <li class="list-group-item">
                              <div>
                                  <p>Vous n'avez pas encore de questionnaire</p>
                              </div>
                          </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
