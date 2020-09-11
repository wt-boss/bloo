@section('title', "Sondage Gratuit")

@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-flat">
                <img src="{{asset('assets/images/bloo_logo2.png')}}">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <h5>@lang('Sucess_create')</h5>
                    </div>
                </div>
                <div class="panel-body">
                    <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo " data-loading-text="Please Wait..." data-complete-text="Submit Form">
                        <a style="color: #fff;" href="{{ route('home') }}">
                            @lang('home')
                        </a>
                    </button>
                    <button  style="background-color: #0065a1;" id="submit" type="button" class="btn btn-bloo pull-right" data-loading-text="Please Wait..." data-complete-text="Submit Form">
                        <a style="color: #fff;" href="{{ route('forms.logout_free') }}">
                            @lang('login')
                        </a>
                    </button>
                </div>
            </div>
        </div>
@endsection


