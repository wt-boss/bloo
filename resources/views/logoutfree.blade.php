@section('title', "Sondage Gratuit")

@extends('layouts.auth')


@section('content')








    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <div class="panel-heading">

                    <div class="panel-title" >


                    <h5 >QUITTER LE FORMULAIRE GRATUIT</h5>
                </div>
                    <div class="panel-body">
                        <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo pull-right" data-loading-text="Please Wait..." data-complete-text="Submit Form">
                            <a style="color: #fff;" href="{{ route('forms.logout_free') }}">
                                <b>ACCUEIL</b>
                            </a>

                        </button>
                    </div>
            </div>
        </div>
@endsection


