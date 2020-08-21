@section('title', "Sondage Gratuit")

@extends('layouts.auth')


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">QUITTER LE FORMULAIRE GRATUIT</h5>
                </div>
                    <div class="panel-body">
                        <button id="submit" type="button" class="btn btn-bloo pull-right" data-loading-text="Please Wait..." data-complete-text="Submit Form">
                            <a href="{{ route('forms.logout_free') }}">
                                <span class="hidden-xs"><b>ACCUEIL</b></span>
                            </a>

                        </button>
                    </div>
            </div>
        </div>
@endsection


